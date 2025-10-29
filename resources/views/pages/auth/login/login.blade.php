<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login</title>
        <link rel="stylesheet" href="{{ asset('user/vendors/typicons.font/font/typicons.css') }}">
        <link rel="stylesheet" href="{{ asset('user/vendors/css/vendor.bundle.base.css') }}">
        <link rel="stylesheet" href="{{ asset('user/css/vertical-layout-light/style.css') }}">
        <link rel="shortcut icon" href="{{ asset('user/images/favicon.png') }}" />
    </head>

    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="content-wrapper d-flex align-items-center auth px-0">
                    <div class="row w-100 mx-0">
                        <div class="col-lg-4 mx-auto">
                            <div class="auth-form-light px-sm-5 px-4 py-5 text-left">
                                <div class="brand-logo">
                                    <img src="{{ asset('user/images/logo.svg') }}" alt="logo">
                                </div>
                                <h4>Hello! let's get started</h4>
                                <h6 class="font-weight-light">Sign in to continue.</h6>
                                <form class="pt-3" method="POST" action="{{ route('login.post') }}">
                                    @csrf
                                    @include('partials.alert')
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="text" class="form-control form-control-lg" id="email"
                                            name="email" placeholder="Email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control form-control-lg" id="password"
                                            name="password" placeholder="Password" required>
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit"
                                            class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                            SIGN IN
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- base:js -->
        <script src="../../vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- inject:js -->
        <script src="../../js/off-canvas.js"></script>
        <script src="../../js/hoverable-collapse.js"></script>
        <script src="../../js/template.js"></script>
        <script src="../../js/settings.js"></script>
        <script src="../../js/todolist.js"></script>
        <!-- endinject -->
    </body>

</html>
