@extends('backend.layouts.master')
@section('title','E-SHOP || Update Password')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'user.index', 'name' => 'User', 'key' => 'Update - Password'])
	<div class="row">
		<div class="col-md-9 offset-md-2">			
			<form class="form-horizontal" action="{{route('updatePasswordId')}}" method="post">
				@csrf				
				<div class="form-group ">
					<label for="example-text-input" class="col-sm-3 col-form-label">Nhập mật khẩu cũ</label>
					<div class="col-sm-8">
						<input class="form-control" type="password"  value="" id="typepass" name="user_password" placeholder="Nhập mật khẩu cũ">
						<a href="javascript:;void(0)" style="position: absolute;top: 28%;right: 20px;color: #333;"><i class="fa fa-eye" id="show-password" onclick="showPassword(this)"></i></a>
						@if ($errors->has('user_password'))
						<p class="text-danger">{{ $errors->first('user_password') }}</p>
						@endif
					</div>
				</div>	
				<div class="form-group ">
					<label for="example-text-input" class="col-sm-5 col-form-label">Nhập lại mật khẩu mới</label>
					<div class="col-sm-8">
						<input class="form-control" type="password"  value="" id="typepass1" name="user_password_new" placeholder="Nhập lại mật khẩu mới">
		          		<a href="javascript:;void(0)" style="position: absolute;top: 29%;right: 20px;color: #333;"><i class="fa fa-eye show-password" onclick="showPassword1(this)"></i></a>
						@if ($errors->has('user_password_new'))
						<p class="text-danger">{{ $errors->first('user_password_new') }}</p>
						@endif
					</div>
				</div>	
				<div class="form-group ">
					<label for="example-text-input" class="col-sm-5 col-form-label">Xác nhận mật khẩu mới</label>
					<div class="col-sm-8">
						<input class="form-control" type="password"  value="" id="typepass2" name="user_password_again" placeholder="Xác nhận mật khẩu mới">
		        		<a href="javascript:;void(0)" style="position: absolute;top: 30%;right: 20px;color: #333;"><i class="fa fa-eye show-password" onclick="showPassword2(this)"></i></a>
						@if ($errors->has('user_password_again'))
						<p class="text-danger">{{ $errors->first('user_password_again') }}</p>
						@endif
					</div>
				</div>					
				<div class="form-group text-center">
					<div class="col-sm-8">	
						<input type="reset" value="Nhập lại"  class="btn btn-lg btn-danger">
						<input type="submit" value="Sửa" class="btn btn-lg btn-success">
					</div>
				</div>	
			</form>
		</div>
	</div>
@endsection


<script> 
    //geeksforgeeks.org/show-hide-password-using-javascript/ 
    function showPassword(button) { 
        var temp = document.getElementById("typepass"); 
        if (temp.type === "password") { 
            temp.type = "text"; 
        }else { 
            temp.type = "password"; 
        } 
    } 
	function showPassword1(button) { 
        var temp = document.getElementById("typepass1"); 
        if (temp.type === "password") { 
            temp.type = "text"; 
        }else { 
            temp.type = "password"; 
        } 
    } 
	function showPassword2(button) { 
        var temp = document.getElementById("typepass2"); 
        if (temp.type === "password") { 
            temp.type = "text"; 
        }else { 
            temp.type = "password"; 
        } 
    } 
</script> 