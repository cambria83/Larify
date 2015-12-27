<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SpotifyController extends Controller
{

    function index() {
        
        $access = \Session::get('access_token');
        
        if($access == '') {
            
        $spotify = new \App\Services\Spotify;
        $result = $spotify->auth();
        
        print_r($result);
            
        }
        
        // The Service Index
        
        
        $spotify = new \App\Services\Spotify;
        $auth = $spotify->get_playlist();
        
        $result = json_encode($auth, true);
        
        $array = $auth['tracks']['items'];
        
        return view('spotify.index', compact('array'));
        
    }
    
    function auth() {
    
        $spotify = new \App\Services\Spotify;
        $result = $spotify->login2('authorization_code');
        
        return $result;
        
        
    }
    
    function search(Request $data) {
        
        if($data->artist != '') {
            $spotify = new \App\Services\Spotify;
            $result = $spotify->search_track($data);
            $array = $result['tracks']['items'];
            } else {
            $array = [];
        }
        
        return view('spotify.search', compact('array'));

    }
    
    function add($uri) {
        
        // Add to playlist
        
        $spotify = new \App\Services\Spotify;
        $result = $spotify->add_track($uri);

            print_r($result);        
            // return \Redirect::to('/spotify');
        
    }
    

        function delete($uri) {
        
        // Handle delete requests
        
        $spotify = new \App\Services\Spotify;
        $result = $spotify->delete_track($uri);
        
            // print_r($result);
            return \Redirect::to('/spotify');
    }
}
