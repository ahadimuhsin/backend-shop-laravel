<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,
    shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="Muhsin Ahadi">
    <link rel="shortcut icon" href="{{ asset('assets/img/company.png') }}"
    type="image/x-icon">
    <title>{{ $title ?? config('app.name') }} - Admin</title>

    {{-- CSS --}}
    <link rel="stylesheet" href=" {{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
    <link
href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
rel="stylesheet">
    {{-- Template CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/sb-admin-2.min.css') }}">
</head>

<body style="background-color: #e2e8f0">
    <div class="container">
        @yield('content')
    </div>

    
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
</body>
</html>
