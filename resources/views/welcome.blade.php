<!DOCTYPE html>
<html>
    <head>
        <title>Larify</title>
        
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/6.0.5/foundation.min.css">
        <link rel="stylesheet" href="/css/app.css">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.min.js"></script>


        <link href="https://fonts.googleapis.com/css?family=Lato:400" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 300;
                font-family: 'Lato';
                color:#333;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>

<div class="top-bar">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="menu-text">Larify</li>
      <li class="has-submenu">
        <a href="/spotify">The Playlist</a>
      </li>
      <li><a href="/spotify/search">Add Track</a></li>
      <li><a href="#">Rules</a></li>
      <li><a href="/account">My Account</a></li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <li><a href="/auth/login">Login</a></li>
      <li><a href="/auth/logout">Logout</a></li>

      <!--<li><input type="search" placeholder="Search"></li>-->
      <!--<li><button type="button" class="button">Search</button></li>-->
    </ul>
  </div>
</div>

<div class="container">

                @yield('content')
</div>
    </body>
</html>
