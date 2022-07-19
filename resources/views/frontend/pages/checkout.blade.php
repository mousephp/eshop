@extends('frontend.layouts.master')

@section('title','Checkout page')

@section('main-content')

    <!-- Breadcrumbs --> 
    @include('frontend.partials.breadcrumb', ['name' => 'Home', 'key' => 'Checkout'])
    <!-- End Breadcrumbs -->
            
    <!-- Start Checkout -->
    @include('frontend.checkout.checkout')
    <!--/ End Checkout -->
    
    <!-- Start Shop Services Area  -->
    @include('frontend.checkout.shop_service')
    <!-- End Shop Services -->
    
    <!-- Start Shop Newsletter  -->
    @include('frontend.checkout.shop_newsletter')
    <!-- End Shop Newsletter -->

@endsection



@push('styles')
	<style>
		#district{
			display: inline-block !important;
		}
		#ward{
			display: inline-block !important;
		}

		.nice-select{
			display: inline-block !important;
		}

		li.shipping{
			display: inline-flex;
			width: 100%;
			font-size: 14px;
		}
		li.shipping .input-group-icon {
			width: 100%;
			margin-left: 10px;
		}
		.input-group-icon .icon {
			position: absolute;
			left: 20px;
			top: 0;
			line-height: 40px;
			z-index: 3;
		}
	
		.list li{
			margin-bottom:0 !important;
		}
		.list li:hover{
			background:#F7941D !important;
			color:white !important;
		}
		.form-select .nice-select::after {
			top: 14px;
		}
	</style>
@endpush
