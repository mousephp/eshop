@extends('user.layouts.master')
@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Change Password</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('member.change.password') }}">
                        @csrf
                        @method('put')

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" autocomplete="current-password">
                                @error('current_password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="current-password">
                                @error('new_password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>
                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" autocomplete="current-password">
                                @error('new_confirm_password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
