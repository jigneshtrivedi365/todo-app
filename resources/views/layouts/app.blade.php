<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="Saquib" content="Blade">
    <title>@yield('title')</title>
   @include('includes.head')
</head>
<body>
<div class="container">
   <div id="main" class="row">
        @yield('content')
   </div>
   <footer class="row">
       @include('includes.footer')
   </footer>
</div>
</body>
</html>