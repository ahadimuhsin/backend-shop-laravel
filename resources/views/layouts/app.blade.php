<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="Muhsin Ahadi">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('assets/img/company.png') }}" type="image/x-icon">
    <title>{{ $title ?? config('app.name') }} - Admin</title>

    {{-- CSS --}}
    <link rel="stylesheet" href=" {{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    {{-- Template CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/sb-admin-2.min.css') }}">
    <style>
        .form-control:focus {
            color: #6e707e;
            background-color: #fff;
            border-color: #375dce;
            outline: 0;
            box-shadow: none
        }

        .form-group label {
            font-weight: bold
        }

        #wrapper #content-wrapper {
            background-color: #e2e8f0;
            width: 100%;
            overflow-x: hidden;
        }

        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: #4e73de;
            border-bottom: 1px solid #e3e6f0;
            color: white;
        }
    </style>
    @stack('custom-styles')
</head>

<body id="page-top">
    {{-- Page Wrapper --}}
    <div id="wrapper">
        {{-- Sidebar --}}
        @include('includes.sidebar')
        {{-- End of Sidebar --}}
        {{-- Content Wrapper --}}
        <div id="content-wrapper" class="d-flex flex-column">
            {{-- Main Content --}}
            <div id="content">
                {{-- Topbar --}}
                @include('includes.topbar')
                {{-- End Of Topbar --}}

                {{-- Begin Page Content --}}
                @yield('content')
                {{-- End --}}
            </div>

            {{-- Footer --}}
            @include('includes.footer')
            {{-- End of Footer --}}
        </div>
    </div>

    {{-- Scroll to Top Button --}}
    <a href="#page-top" class="scroll-to-top rounded">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- Logout Modal --}}
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah Yakin Ingin Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    Silakan pilih "Logout" di bawah untuk mengakhiri sesi saat ini
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a href="{{ route('logout') }}" class="btn btn-primary" style="cursor: pointer"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                    <form action="{{ route('logout') }}" id="logout-form" method="post" style="display: none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- JS Section --}}
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('assets/vendor/chart.js/Chart.min.js')}}"></script>
    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{ asset('assets/js/demo/chart-pie-demo.js')}}"></script>
    @stack('custom-scripts')
    <script>
        @if (session()->has('success'))
    swal({
        type: 'success',
        icon: 'success',
        title: 'BERHASIL!',
        text: "{{ session('success') }}",
        timer: 1500,
        showConfirmButton: false,
        showCancelButton: false,
        buttons: false
    });
    @elseif(session()->has('error'))
    swal({
        type: 'error',
        icon: 'error',
        title: 'GAGAL!',
        text: "{{ session('error') }}",
        timer: 1500,
        showConfirmButton: false,
        showCancelButton: false,
        buttons: false
    });
    @endif
    </script>

</body>

</html>
