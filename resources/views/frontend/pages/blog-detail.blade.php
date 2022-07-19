@extends('frontend.layouts.master')

@section('title','E-TECH || Blog Detail page')

@section('main-content')
<!-- Breadcrumbs -->
@include('frontend.partials.breadcrumb', ['name' => 'Home', 'key' => 'Blog Single Sidebar'])
<!-- End Breadcrumbs -->

<!-- Start Blog Single -->
<section class="blog-single section">
    <div class="container">
        <div class="row">

        {{-- blog-single --}}
        @include('frontend.blog-detail.blog_single')
        {{-- end blog-single --}}

        {{-- main-sidebar --}}
        @include('frontend.blog-detail.main_sidebar')
        {{-- end main-sidebar --}}
        </div>
    </div>
</section>
<!--/ End Blog Single -->
@endsection


@push('styles')
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=5f2e5abf393162001291e431&product=inline-share-buttons' async='async'></script>
@endpush
@push('scripts')
<script>
    $(document).ready(function() {

        (function($) {
            "use strict";

            $('.btn-reply.reply').click(function(e) {
                e.preventDefault();
                $('.btn-reply.reply').show();

                $('.comment_btn.comment').hide();
                $('.comment_btn.reply').show();

                $(this).hide();
                $('.btn-reply.cancel').hide();
                $(this).siblings('.btn-reply.cancel').show();

                var parent_id = $(this).data('id');
                var html = $('#commentForm');
                $(html).find('#parent_id').val(parent_id);
                $('#commentFormContainer').hide();
                $(this).parents('.comment-list').append(html).fadeIn('slow').addClass('appended');
            });

            $('.comment-list').on('click', '.btn-reply.cancel', function(e) {
                e.preventDefault();
                $(this).hide();
                $('.btn-reply.reply').show();

                $('.comment_btn.reply').hide();
                $('.comment_btn.comment').show();

                $('#commentFormContainer').show();
                var html = $('#commentForm');
                $(html).find('#parent_id').val('');

                $('#commentFormContainer').append(html);
            });

        })(jQuery)
    })

</script>
@endpush
