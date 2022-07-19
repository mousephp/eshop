@extends('backend.layouts.master')
@section('title','E-SHOP || User Create')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'user.index', 'name' => 'User', 'key' => 'Create'])
	<div class="row">
		<div class="col-md-9 offset-md-2">			
			<form class="form-horizontal" action="{{route('user.store')}}" method="post">
				@csrf
				<div class="form-group ">
					<label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
					<div class="col-sm-8 ">
						<input class="form-control" type="text" value="{{old('name')}}"  name="name" placeholder="Nhập Username">
						@if ($errors->has('name'))
						<p class="text-danger">{{ $errors->first('name') }}</p>
						@endif
					</div>
				</div>
				<div class="form-group ">
					<label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-8">
						<input class="form-control" type="email"  value="{{old('email')}}" id="example-text-input" name="email" placeholder="Nhập Email">
						@if ($errors->has('email'))
						<p class="text-danger">{{ $errors->first('email') }}</p>
						@endif
					</div>
				</div>
				<div class="form-group ">
					<label for="example-text-input" class="col-sm-2 col-form-label">Password</label>
					<div class="col-sm-8">
						<input class="form-control" type="password"  id="typepass" name="password" placeholder="Nhập Password">
						<a href="javascript:;void(0)" style="position: absolute;top: 29%;right: 20px;color: #333;"><i class="fa fa-eye" id="show-password" onclick="showPassword(this)"></i></a>
						@if ($errors->has('password'))
						<p class="text-danger">{{ $errors->first('password') }}</p>
						@endif
					</div>
				</div>	
				<div class="form-group ">
					<label for="example-text-input" class="col-sm-5 col-form-label"> Nhập lại Password</label>
					<div class="col-sm-8">
						<input class="form-control" type="password" id="typepass1" name="password_confirmation" placeholder="Nhập lại Password">
						<a href="javascript:;void(0)" style="position: absolute;top: 30%;right: 20px;color: #333;"><i class="fa fa-eye show-password" onclick="showPassword1(this)"></i></a>
						@if ($errors->has('password_confirmation'))
						<p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
						@endif
					</div>
				</div>

				<div class="form-group">
					<select class="form-control" id="exampleFormControlSelect1" name="roles[]" multiple="multiple">
						@foreach ($roles as $key => $role)	
						<option value="{{$role->id}}">{{$role->display_name}}</option>
						@endforeach
					</select>
				</div>
	
				<div class="form-group text-center">
					<div class="col-sm-8">	
						<input type="reset" value="Nhập lại"  class="btn btn-lg btn-danger">
						<input type="submit" value="Thêm user" class="btn btn-lg btn-success">
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
</script> 
