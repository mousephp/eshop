<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-SHOP || DASHBOARD</title>
  
    <!-- Custom fonts for this template-->
    <link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  

    {{-- sweetalert-datatable --}}
    <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
    {{-- <script src="{{asset('backend/vendor/jquery/jquery.js')}}"></script> --}}

    <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/vendor/sweetalert/sweetalert.min.css')}}" />
    <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/vendor/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
    <script src="{{asset('backend/js/script.js')}}"></script>


    <!-- Custom styles for this template-->
    <link href="{{asset('backend/css/sb-admin-2.min.css')}}" rel="stylesheet">
    @stack('styles')
  
</head>