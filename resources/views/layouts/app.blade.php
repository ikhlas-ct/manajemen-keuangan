<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CelestialUI Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="{{ asset('user/vendors/typicons.font/font/typicons.css') }}">
  <link rel="stylesheet" href="{{ asset('user/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('user/vendors/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('user/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('user/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('user/images/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      @include('partials.navbar')
      </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        @include('partials.setting')
        </div>
      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->

      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        @include('partials.sidebar')
      </nav>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            @yield('content')

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
           @include('partials.footer')
          </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="{{ asset('user/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ asset('user/js/off-canvas.js') }}"></script>
  <script src="{{ asset('user/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('user/js/template.js') }}"></script>
  <script src="{{ asset('user/js/settings.js') }}"></script>
  <script src="{{ asset('user/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="{{ asset('user/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
  <script src="{{ asset('user/vendors/select2/select2.min.js') }}"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="{{ asset('user/js/file-upload.js') }}"></script>
  <script src="{{ asset('user/js/typeahead.js') }}"></script>
  <script src="{{ asset('user/js/select2.js') }}"></script>
  <!-- End custom js for this page-->

    <!-- Yield scripts -->
  @yield('scripts')
</body>

</html>
