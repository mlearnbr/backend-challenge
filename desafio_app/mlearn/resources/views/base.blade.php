<!DOCTYPE html>
<html lang="en"><head>

 <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
 <title>Mlearn Desafio</title> 
   <!-- Fonts -->
   <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

<!-- Styles -->
<style>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
</style>

 

 <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
 
 </head>
 <div>    
 <a style="margin: 19px;" href="{{ route('contacts.create')}}" 
 class="btn btn-primary">New contact</a></div>
 <body> 
  <div class="container">    
  @yield('main')  
  </div> 
 <script src="{{ asset('js/app.js') }}" type="text/js"></script>

 
  </body>
  </html>