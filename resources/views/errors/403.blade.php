<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron text-center">
			  <h2>Bạn không có quyền thực hiện thao tác này</h2>
			   <a href="{{route('logout')}}" class="btn btn-info btn-lg">
		          <span class="glyphicon glyphicon-log-out"></span> Logout
		        </a>
			</div>
		</div>
	</div>
</div>


  
</body>
</html>

