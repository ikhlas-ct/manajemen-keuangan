<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Manajemen Keuangan')</title>

        <link rel="stylesheet" href="{{ asset('user/vendors/typicons.font/font/typicons.css') }}">
        <link rel="stylesheet" href="{{ asset('user/vendors/css/vendor.bundle.base.css') }}">
        <link rel="stylesheet" href="{{ asset('user/vendors/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('user/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('user/css/vertical-layout-light/style.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


        @yield('styles')
    </head>

    <body>
        <div class="container-scroller">
            <nav class="navbar col-lg-12 col-12 fixed-top d-flex flex-row p-0">
                @include('partials.navbar')
            </nav>
            <div class="container-fluid page-body-wrapper">
                <div class="theme-setting-wrapper">
                    @include('partials.setting')
                </div>
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    @include('partials.sidebar')
                </nav>

                <div class="main-panel">
                    <div class="content-wrapper">
                        @yield('content')

                    </div>
                    <footer class="footer">
                        @include('partials.footer')
                    </footer>
                </div>
            </div>
        </div>
        {{-- scripts --}}
        <script src="{{ asset('user/vendors/js/vendor.bundle.base.js') }}"></script>
        <script src="{{ asset('user/js/off-canvas.js') }}"></script>
        <script src="{{ asset('user/js/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('user/js/template.js') }}"></script>
        <script src="{{ asset('user/js/settings.js') }}"></script>
        <script src="{{ asset('user/js/todolist.js') }}"></script>
        <script src="{{ asset('user/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
        <script src="{{ asset('user/vendors/select2/select2.min.js') }}"></script>
        <script src="{{ asset('user/js/file-upload.js') }}"></script>
        <script src="{{ asset('user/js/typeahead.js') }}"></script>
        <script src="{{ asset('user/js/select2.js') }}"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76A2z02tPqdj+Qf8tO6EYQ1Etrr1cD8lT94WrHftjDbrCEXSU1oBoqyl2QvZ6jI"
        crossorigin="anonymous"></script> --}}

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
        </script>

        @yield('scripts')
    </body>

</html>
