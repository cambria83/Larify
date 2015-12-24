<?php

namespace App\Services;

require '../vendor/autoload.php';

class Spotify {
    
    // Creds
    protected $clientID = 'ac705b84f9a948c48874b2c0fd4d5dd9';
    protected $clientSecret = 'c1ee3c7ff4d74e1a88952d84f89d50d7';

    
    function call($post, $url, $header, $method) {
        
        // Handle POST, PUT, DELETE etc.
        $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL,$url);
            
            // Determine Method
            switch($method) {
            
            case "POST":
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
            break;
            
            case "DELETE":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
            break;
                }
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header );
            
            // receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            $server_output = json_decode(curl_exec ($ch), true);
            
            curl_close ($ch);
        
        return $server_output;
    
    
    }

 function login() {
     
     // Basic Authenticate with Spotify
     
     $url = 'https://accounts.spotify.com/api/token';
     $post = 'grant_type=client_credentials';
     $headers = array(
            "Accept: */*",
            "Content-Type: application/x-www-form-urlencoded",
            "User-Agent: runscope/0.1",
            "Authorization: Basic " . base64_encode($this->clientID . ":" . $this->clientSecret));

     
     $result = $this->call($post, $url, $headers, 'POST');
     return $result;
 }
 
 function login2() {
     
     // Authentication with second method
     
     // Check first for things that could be wrong
  if (strcmp(\Session::get('login_key'), \Input::get('state')) != 0) {
    return "Incorrect state. This request is invalid.";
  } else if (!empty(\Input::get('error'))) {
    return "Some kind of error occurred.";
  }
     
     
     $postUrl = 'https://accounts.spotify.com/api/token';
  $params = array(
    'grant_type' => 'authorization_code',
    'code' => \Input::get('code'),
    'redirect_uri' => 'https://larify-cambria83.c9users.io/spotify/auth/',
    'client_id' => $this->clientID,
    'client_secret' => $this->clientSecret,
  );

  // use key 'http' even if you send the request to https://...
  $options = array(
      'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
          'method'  => 'POST',
          'content' => http_build_query($params),
      ),
  );
  $context  = stream_context_create($options);
  $result = json_decode(file_get_contents($postUrl, false, $context));
  
    \Session::put('access_token', $result->access_token);
  return \Redirect::to('/');
     
 }
 
 function auth() {
  
  // Set the perissions required for Larify   
  $scopes = 'playlist-modify-public playlist-modify-private playlist-read-private user-read-email';

  $params = array(
    'client_id' => 'ac705b84f9a948c48874b2c0fd4d5dd9',
    'response_type' => 'code',
    'redirect_uri' => 'https://larify-cambria83.c9users.io/spotify/auth/',
    'scope' => $scopes,
  );
  
return \Redirect::to('https://accounts.spotify.com/authorize?' . http_build_query($params));     
     
 }
 
 function search_track($data) {
     
     // Search for tracks to add to the playlist
     
    $params = array(
        "q" => "track:" . $data['track'] . " artist:" . $data['artist'],
        "type" => "track",
        );
     
     $url = 'https://api.spotify.com/v1/search?' . http_build_query($params);
     
          $headers = array(
            "Accept: */*",
            "Content-Type: application/x-www-form-urlencoded",
            "User-Agent: runscope/0.1",
            );
     
    $result = $this->call(null, $url, $headers, 'GET');
     
     return $result;
    
 }
 
 function get_playlist() {
     
     // Gets the playlist - So we can see what's on it!
     $token = $this->login();
     
     $url = "https://api.spotify.com/v1/users/cambria83/playlists/5tuAzZO2CQDxDwr7PbQARU?fields=tracks.items(added_at,added_by.id)';";
     $headers = array(
            "Accept: */*",
            "Content-Type: application/x-www-form-urlencoded",
            "User-Agent: runscope/0.1",
            "Authorization: Bearer " . $token['access_token']);
            
    $result = $this->call(null, $url, $headers, 'GET');
    return $result;
     
 }
 
 function add_track($trackURI) {
     
     // The Add action requires extra Auth
     $auth = $this->auth();
     
     $headerStr = "Authorization: Bearer ". \Session::get('access_token');
     
     $url = "https://api.spotify.com/v1/users/cambria83/playlists/5tuAzZO2CQDxDwr7PbQARU/tracks";
     $post = json_encode(array("uris" => [$trackURI]));
     $headers = array(
            "Accept: */*",
            "Content-Type: application/json",
            "User-Agent: runscope/0.1",
            $headerStr
            );
            
    $result = $this->call($post, $url, $headers, 'POST');
    
    return $result;
     
     
 }
 
 function delete_track($trackURI) {
     
     // The delete action requires extra Auth
     $auth = $this->auth();
     
     $headerStr = "Authorization: Bearer ". \Session::get('access_token');
     
     $url = "https://api.spotify.com/v1/users/cambria83/playlists/5tuAzZO2CQDxDwr7PbQARU/tracks";
     $post = json_encode(array("tracks" => [array( "uri" => $trackURI )]));
     $headers = array(
            "Accept: */*",
            "Content-Type: application/json",
            "User-Agent: runscope/0.1",
            $headerStr
            );
            
    $result = $this->call($post, $url, $headers, 'DELETE');
     
     
 }

}

?>
