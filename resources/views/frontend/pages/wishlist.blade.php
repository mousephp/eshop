@extends('frontend.layouts.master')
@section('title','Wishlist Page')

@section('main-content')
<!-- Breadcrumbs -->
@include('frontend.partials.breadcrumb', ['name' => 'Home', 'key' => 'Wishlist'])
<!-- End Breadcrumbs -->

<!-- Shopping Cart -->
@include('frontend.wishlist.wishlist_cart')
<!--/ End Shopping Cart -->

<!-- Start Shop Services Area  -->
@include('frontend.wishlist.shop_service')
<!-- End Shop Services Area  -->

<!-- Shop Newsletter -->
@include('frontend.layouts.newsletter')
<!-- End Shop Newsletter -->


<!-- Modal -->
@include('frontend.wishlist.modal')
<!-- Modal end -->

@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@endpush
