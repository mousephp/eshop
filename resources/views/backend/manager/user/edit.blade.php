@extends('backend.layouts.master')
@section('title','E-SHOP || User Create')

@section('main-content')
@include('backend.partials.content-header', ['router' => 'user.index', 'name' => 'User', 'key' => 'Edit'])
	<div class="row">
		<div class="col-md-9 offset-md-2">			
			<form class="form-horizontal" action="{{route('user.update',$user->id)}}" method="post">
				@csrf
				@method('PUT')
				<div class="form-group ">
					<label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
					<div class="col-sm-8 ">
						<input  class="form-control" type="text" value="{{$user->name}}"  name="name" placeholder="Nhập Username">
						@if ($errors->has('name'))
						<p class="text-danger">{{ $errors->first('name') }}</p>
						@endif
					</div>
				</div>
				<div class="form-group ">
					<label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-8">
						<input class="form-control" type="email" value="{{$user->email}}" id="example-text-input" name="email" placeholder="Nhập Email">
						@if ($errors->has('email'))
						<p class="text-danger">{{ $errors->first('email') }}</p>
						@endif
					</div>
				</div>
				<div class="form-group ">
					<label for="example-text-input" class="col-sm-3 col-form-label">Nhập mật khẩu cũ</label>
					<div class="col-sm-8">
						<input class="form-control" type="password"  value="" id="typepass" name="user_password" placeholder="Nhập Password">
						<a href="javascript:;void(0)" style="position: absolute;top: 28%;right: 20px;color: #333;"><i class="fa fa-eye" id="show-password" onclick="showPassword(this)"></i></a>

						@if ($errors->has('user_password'))
						<p class="text-danger">{{ $errors->first('user_password') }}</p>
						@endif
					</div>
				</div>	
				<div class="form-group ">
					<label for="example-text-input" class="col-sm-5 col-form-label"> Nhập lại mật khẩu mới</label>
					<div class="col-sm-8">
						<input class="form-control" type="password"  value=""  id="typepass1" name="user_password_new" placeholder="Nhập lại Password">
						<a href="javascript:;void(0)" style="position: absolute;top: 29%;right: 20px;color: #333;"><i class="fa fa-eye show-password" onclick="showPassword1(this)"></i></a>
						@if ($errors->has('user_password_new'))
						<p class="text-danger">{{ $errors->first('user_password_new') }}</p>
						@endif
					</div>
				</div>	
				<div class="form-group ">
					<label for="example-text-input" class="col-sm-5 col-form-label">Xác nhận mật khẩu mới</label>
					<div class="col-sm-8">
						<input class="form-control" type="password"  value=""  id="typepass2" name="user_password_again" placeholder="Xác nhận mật khẩu mới">
						<a href="javascript:;void(0)" style="position: absolute;top: 30%;right: 20px;color: #333;"><i class="fa fa-eye show-password" onclick="showPassword2(this)"></i></a>
						@if ($errors->has('user_password_again'))
						<p class="text-danger">{{ $errors->first('user_password_again') }}</p>
						@endif
					</div>
				</div>	

				<div class="form-group ">
					<select class="form-control" id="exampleFormControlSelect1" name="roles[]" multiple="multiple">
						@foreach ($roles as $key => $role)	
							@if($user->name == 'admin')
								{{-- <?php continue; ?> --}}
								<option value="{{$role->id}}" {{$listRoleOfUser->contains($role->id) ? 'selected' :''}}>
									{{$role->display_name}}
								</option>
							@endif
							@if($user->name != 'admin')			
								<option value="{{$role->id}}" {{$listRoleOfUser->contains($role->id) ? 'selected' :''}} @if($role->name == 'admin') <?php  continue; ?> @endif>
									{{$role->display_name}}
								</option>
							@endif
						@endforeach
					</select>
				</div>

				<div class="form-group text-center">
					<div class="col-sm-8">	
						<input type="reset" value="Nhập lại"  class="btn btn-lg btn-danger">
						<input type="submit" value="Sửa user" class="btn btn-lg btn-success">
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