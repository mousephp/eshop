<!DOCTYPE html>
<html lang="en">
<head>
    <title>Not Found</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

    {{-- <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron text-center">
                    <h2>Trang bạn tìm không tồn tại</h2>
                    <a href="{{route('member.dashboard')}}" class="btn btn-info btn-lg">
                        <span class="glyphicon glyphicon-log-out"></span> Quay lại
                    </a>
                </div>
            </div>
        </div>
    </div> --}}



	<div class="container-fluid">
        <div class="row" style="margin-top:10%">
            <div class="col-md-12">
                <div class="text-center">
                    <div class="error mx-auto" data-text="404">404</div>
                    <p class="lead text-gray-800 mb-5">Page Not Found</p>
                    <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
                    <a href="{{route('home')}}">&larr; Back to Home</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
