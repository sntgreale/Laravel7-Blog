<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials._head')
    </head>
    <body>
        @include('partials._nav')
        <br>
        <div class="container"> <!-- Start of Container -->
            @include('partials._messages')
            @yield('content')
            @include('partials._footer')
        </div> <!-- End of Container -->
        @include('partials._javascript')
    </body>
</html>