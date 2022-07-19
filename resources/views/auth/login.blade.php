<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<html lang="en">
<head>
    <base href="{{asset('backend')}}/">
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    {{--recaptcha --}}
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="{{route('login')}}" method="post">
                                        @csrf
                                        @method('post')
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user  @error('name') is-invalid @enderror" value='admin@gmail.com' id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email">
                                            @if ($errors->has('email'))
                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" value='123456' id="exampleInputPassword" placeholder="Password" name="password">
                                            @if ($errors->has('password'))
                                            <p class="text-danger">{{ $errors->first('password') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember" value="Remember Me" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember Me</label>
                                            </div>
                                        </div>
                                        {{-- <div class="form-group">
                                            <div class="col-md-offset-4 col-md-6">
                                                <div class="g-recaptcha" data-sitekey="jI6_WlGNB0mafrGJbbxLIZPV" data-callback="YourOnSubmitFn"></div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="form-group">
                                            <label for="captcha">Captcha</label>
                                            {!! NoCaptcha::renderJs() !!}
                                            {!! NoCaptcha::display() !!}
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        </div> --}}

                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                    </form>
                                    <hr>

                                    <a href="{{--route('auth.google')--}}" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i> Login with Google
                                    </a>
                                    <a href="{{-- url('/auth/redirect/facebook') --}}" class="btn btn-facebook btn-user btn-block">
                                        <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                    </a>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{--route('forgot-password')--}}">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{route('admin.register')}}">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>



    <script type="text/javascript" src="{{asset('backend/vendor/toastr/toastr.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/toastr/toastr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/toastr/toastr.css')}}">

    <script type="text/javascript">
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'success') }}";
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}", {
                    timeOut: 2000
                });
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
        @endif

        @if(Session::has('error'))
        var type = "{{ Session::get('alert-type', 'warning') }}";
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('error') }}", {
                    timeOut: 2000
                });
                break;

            case 'warning':
                toastr.warning("{{ Session::get('error') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('error') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('error') }}");
                break;
        }
        @endif

    </script>

</body>

</html>
