@extends('frontend.layouts.master')
@section('title','E-SHOP || PRODUCT PAGE')

@section('main-content')
<!-- Breadcrumbs -->
    @include('frontend.partials.breadcrumb', ['name' => 'Home', 'key' => 'Shop List'])
<!-- End Breadcrumbs -->


<!-- Product Style -->
    @include('frontend.product-list.product-style')
<!--/ End Product Style 1  -->


<!-- Modal -->
    @include('frontend.product-list.modal')
<!-- Modal end -->

@endsection



@push ('styles')
<style>
    .pagination {
        display: inline-flex;
    }

    .filter_button {
        /* height:20px; */
        text-align: center;
        background: #F7941D;
        padding: 8px 16px;
        margin-top: 10px;
        color: white;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        /*----------------------------------------------------*/
        /*  Jquery Ui slider js
        /*----------------------------------------------------*/
        if ($("#slider-range").length > 0) {
            const max_value = parseInt($("#slider-range").data('max')) || 500;
            const min_value = parseInt($("#slider-range").data('min')) || 0;
            const currency = $("#slider-range").data('currency') || '';
            let price_range = min_value + '-' + max_value;
            if ($("#price_range").length > 0 && $("#price_range").val()) {
                price_range = $("#price_range").val().trim();
            }

            let price = price_range.split('-');
            $("#slider-range").slider({
                range: true
                , min: min_value
                , max: max_value
                , values: price
                , slide: function(event, ui) {
                    $("#amount").val(currency + ui.values[0] + " -  " + currency + ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
        }
        if ($("#amount").length > 0) {
            const m_currency = $("#slider-range").data('currency') || '';
            $("#amount").val(m_currency + $("#slider-range").slider("values", 0) + "  -  " + m_currency + $("#slider-range").slider("values", 1));
        }
    })
</script>
@endpush
