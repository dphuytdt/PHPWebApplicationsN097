<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}" />
      <title>404 Not Found</title>
      <link rel="stylesheet" href="{{asset('css/auth/404.css')}}" type="text/css"/>
   </head>
   <body>
        <h1>404 Error Page</h1>
        <p class="zoom-area"><b>Book Store</b> Can not find the page you are looking for.</p>
        <section class="error-container">
        <span class="four"><span class="screen-reader-text">4</span></span>
        <span class="zero"><span class="screen-reader-text">0</span></span>
        <span class="four"><span class="screen-reader-text">4</span></span>
        </section>
        <div class="link-container">
        <a  href="{{route('home')}}" class="more-link">Go back to home page</a>
        </div>
   </body>
</html>