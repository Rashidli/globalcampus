<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('partials.head')
</head>
<body>

<div class="dashboard">
    @include('partials.sidebar')
    <div class="dashboard-body">
        @include('partials.header')

        @yield('content')
    </div>
</div>
@include('partials.footer')
@stack('scripts')
</body>
</html>
