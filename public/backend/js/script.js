
//dataTable
$(document).ready(function() {  
    // $('#dataTableCurrent').DataTable({
    //     "columnDefs": [
    //         {
    //             "orderable": false,
    //             "targets": [3, 4]
    //         }
    //     ]
    // });
});

//sweetalert
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.dltBtn').click(function (e) {
        var form = $(this).closest('form');
        var dataID = $(this).data('id');
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
            } else {
                swal("Your data is safe!");
            }
        });
    })
})


//summernote
$(document).ready(function() {
    $('#summary').summernote({
        placeholder: "Write short description....."
        , tabsize: 2
        , height: 100
    });
});

$(document).ready(function() {
    $('#description').summernote({
        placeholder: "Write detail description....."
        , tabsize: 2
        , height: 150
    });
});

$(document).ready(function() {
    $('#quote').summernote({
        placeholder: "Write detail Quote....."
        , tabsize: 2
        , height: 100
    });
});


$(document).ready(function() {
    $('#note').summernote({
        placeholder: "Write short description....."
        , tabsize: 2
        , height: 100
    });
});