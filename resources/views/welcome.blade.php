<!DOCTYPE html>
<html>
    <head>
        <title>Larify</title>
        
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/foundation/6.0.5/foundation.min.css">
        <link rel="stylesheet" href="/css/app.css">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

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
        <ul class="submenu menu vertical" data-submenu>
          <li><a href="#">One</a></li>
          <li><a href="#">Two</a></li>
          <li><a href="#">Three</a></li>
        </ul>
      </li>
      <li><a href="#">Rules</a></li>
      <li><a href="/account/">My Account</a></li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu">
      <li><input type="search" placeholder="Search"></li>
      <li><button type="button" class="button">Search</button></li>
    </ul>
  </div>
</div>

<div class="container">

                @yield('content')
</div>

    </body>
</html>
