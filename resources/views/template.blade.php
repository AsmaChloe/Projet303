<!DOCTYPE html>
<html lang="fr">
 <head>
 <title>@yield('titre')</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
 </head>
 <body>
    @include('menu')
    @yield('contenu')
    @include('footer')
 </body>
</html>