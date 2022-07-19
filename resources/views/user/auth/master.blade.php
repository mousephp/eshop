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

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    {{--recaptcha --}}
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body class="bg-gradient-primary">


    {{--  --}}
    @section('content')

    @show
    {{--  --}}


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
        @if(Session::has('success'))
        var type = "{{ Session::get('alert-type', 'success') }}";
        switch (type) {
            case 'success':
                toastr.info("{{ Session::get('success') }}", {
                    timeOut: 2000
                });
                break;
        }
        @endif

        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'message') }}";
        switch (type) {
            case 'success':
                toastr.info("{{ Session::get('message') }}", {
                    timeOut: 2000
                });
                break;
        }
        @endif

        @if(Session::has('error'))
        var type = "{{ Session::get('alert-type', 'error') }}";
        switch (type) {
            case 'error':
                toastr.error("{{ Session::get('error') }}", {
                    timeOut: 2000
                });
                break;
        }
        @endif

    </script>

</body>

</html>
