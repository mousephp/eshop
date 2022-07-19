<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; <a href="https://github.com/Prajwal100" target="_blank">PrajwalRai</a> 2020</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{route('logout')}}">Logout</a>
            </div>
        </div>
    </div>
</div>






<!-- Bootstrap core JavaScript-->
{{-- <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script> --}}
<script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


{{-- bootstrap-select --}}
<script src="{{asset('backend/vendor/bootstrap-select/bootstrap-select.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('backend/vendor/bootstrap-select/bootstrap-select.css')}}" rel="stylesheet">

<!-- Core plugin JavaScript-->
<script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('backend/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
{{-- <script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script> --}}
{{-- <script src="{{asset('backend/js/demo/chart-pie-demo.js')}}"></script> --}}


<script type="text/javascript" src="{{asset('backend/vendor/toastr/toastr.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/toastr/toastr.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/vendor/toastr/toastr.css')}}">

<script type="text/javascript">
    @if(Session::has('success'))
    var type = "{{ Session::get('alert-type', 'success') }}";
    switch (type) {
        case 'success':
            toastr.success("{{ Session::get('success') }}", {
                timeOut: 2000
            });
            break;
    }
    @endif

    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'message') }}";
    switch (type) {
        case 'message':
            toastr.info("{{ Session::get('message') }}", {
                timeOut: 2000
            });
            break;
    }
    @endif

    @if(Session::has('error'))
    var type = "{{ Session::get('alert-type', 'warning') }}";
    switch (type) {
        case 'error':
            toastr.error("{{ Session::get('error') }}", {
                timeOut: 2000
            });
            break;
    }
    @endif

    @if(Session::has('status'))
    var type = "{{ Session::get('alert-type', 'warning') }}";
    switch (type) {
        case 'status':
            toastr.info("{{ Session::get('status') }}", {
                timeOut: 2000
            });
            break;
    }
    @endif

</script>


<!-- include libraries(jQuery, bootstrap) -->
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script> --}}




@stack('scripts')

<script>
    setTimeout(function() {
        $('.alert').slideUp();
    }, 4000);

</script>



