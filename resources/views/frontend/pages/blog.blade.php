@extends('frontend.layouts.master')

@section('title','E-SHOP || Blog Page')

@section('main-content')
<!-- Breadcrumbs -->
@include('frontend.partials.breadcrumb', ['name' => 'Home', 'key' => 'Blog Grid Sidebar'])
<!-- End Breadcrumbs -->

<!-- Start Blog Single -->
<section class="blog-single shop-blog grid section">
    <div class="container">
        <div class="row">
           
            {{-- blog-single --}}
            @include('frontend.blog.single_blog')
            {{-- end blog-single --}}


            {{-- main-sidebar --}}
            @include('frontend.blog.main_sidebar')
            {{-- end main-sidebar --}}

        </div>
    </div>
</section>
<!--/ End Blog Single -->
@endsection

@push('styles')
<style>
    .pagination {
        display: inline-flex;
    }

</style>

@endpush
