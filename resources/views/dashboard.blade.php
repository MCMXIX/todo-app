<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TODO APPLICATION</title>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ mix('/js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet">
</head>

<body class="w-full bg-cyan-900">
    <div id="dashboard">
    </div>
    <footer>
        <script type="text/javascript">
            window.full_name = '{{ $full_name }}';
            sessionStorage.setItem('full_name', window.full_name);
        </script>    
    </footer>
</body>

</html>
