@extends('home.layouts.master')

@section('title', 'فروشگاه')

@push('customjs')
    <script type="text/javascript">
        $('.variationSelect').on('change', function() {

            let variation = JSON.parse(this.value);

            $('.variationPriceDiv').empty();

            if (variation.is_sale == 1) {
                let spanSale = $('<span />', {
                    class: 'new',
                    text: toPersianNum(number_format(variation.sale_price)) + ' تومان'
                })
                let spanprice = $('<span />', {
                    class: 'old',
                    text: toPersianNum(number_format(variation.price)) + ' تومان'
                })
                $('.variationPriceDiv').append(spanSale);
                $('.variationPriceDiv').append(spanprice);
            } else {
                let spanSale = $('<span />', {
                    class: 'new',
                    text: toPersianNum(number_format(variation.price)) + ' تومان'
                })
                $('.variationPriceDiv').append(spanSale);
            }

            $('.quantityInput').attr('data-max', variation.quantity);
            $('.quantityInput').val(1);

        })




        function filter() {

            let attributes = @json($attributes);

            attributes.map(attribute => {

                let attributeValue = $(`.attribute-${attribute.id}:checked`).map(function() {
                    return this.value;
                }).get().join('-');

                if (attributeValue == '') {
                    $(`#form-attribute-${attribute.id}`).prop('disabled', true);
                } else {
                    $(`#form-attribute-${attribute.id}`).val(attributeValue);
                }
            })



            let variation = $('.variation:checked').map(function() {
                return this.value;
            }).get().join('-')

            if (variation == '') {
                $('#form-variation').prop('disabled', true);
            } else {
                $('#form-variation').val(variation);
            }




            let sortFilter = $('#sortFilter').val();

            if (sortFilter == 'default') {
                $('#form-sort').prop('disabled', true);
            } else {
                $('#form-sort').val(sortFilter);
            }

            let search = $('#searchInput').val();

            if (search == '') {
                $('#form-search').prop('disabled', true);
            } else {
                $('#form-search').val(search);
            }

            $('#filterForm').submit();

        }


        $('#filterForm').on('submit', function(e) {

            e.preventDefault();

            let currentUrl = '{{ url()->current() }}';

            let url = currentUrl + '?' + decodeURIComponent($(this).serialize());

            $(location).attr('href', url);

        });


        function uncheckAll() {

            let category = @json($category);

            let Baseurl = '{{ route('home.categories.show', ':slug') }}';

            Baseurl = Baseurl.replace(':slug', category.slug)

            window.location.href = Baseurl;

        }

        $('#pagination li a').map(function(){
            
          let decodeUrl = decodeURIComponent($(this).attr('href'));

            if($(this).attr('href') != undefined){
                $(this).attr('href' , decodeUrl )
            }
        })

    </script>
@endpush()

@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{ route('home.index') }}">صفحه ای اصلی</a>
                    </li>
                    <li class="active">فروشگاه </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="shop-area pt-95 pb-100">
        <div class="container">
            <div class="row flex-row-reverse text-right">

                <!-- sidebar -->
                <div class="col-lg-3 order-2 order-sm-2 order-md-1">
                    <div class="sidebar-style mr-30">
                        <div class="sidebar-widget">
                            <h4 class="pro-sidebar-title">جستجو </h4>
                            <div class="pro-sidebar-search mb-50 mt-25">
                                <div class="pro-sidebar-search-form">
                                    <input id="searchInput" type="text" placeholder="... جستجو "
                                        value="{{ request()->has('search') ? request()->search : '' }}">
                                    <button type="button" onclick="filter()">
                                        <i class="sli sli-magnifier"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-widget">
                            <h4 class="pro-sidebar-title"> دسته بندی </h4>
                            <div class="sidebar-widget-list mt-30">
                                <ul>
                                    <li>
                                        {{ $category->parent->name }}
                                    </li>
                                    @foreach ($category->parent->children as $childCategory)
                                        <li>
                                            <a style="{{ $category->id == $childCategory->id ? 'color: #ff5e32' : '' }} "
                                                href="{{ route('home.categories.show', $childCategory->slug) }}">
                                                {{ $childCategory->name }}
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <hr>


                        <div class="sidebar-widget mt-30">
                            @foreach ($attributes as $attribute)
                                <h4 class="pro-sidebar-title">{{ $attribute->name }}</h4>
                                <div class="sidebar-widget-list mt-20">
                                    <ul>
                                        {{-- {{dd(request()->has('attribute.'.$attribute->id))}} --}}
                                        @foreach ($attribute->attribiuteValue as $attributeValue)
                                            <li>
                                                <div class="sidebar-widget-list-left">
                                                    <input class="attribute-{{ $attribute->id }}" type="checkbox"
                                                        value="{{ $attributeValue->value }}"
                                                        {{ request()->has('attribute.' . $attribute->id) && in_array($attributeValue->value, explode('-', request()->attribute[$attribute->id])) ? 'checked' : '' }}>
                                                    <a href="#">{{ $attributeValue->value }}</a>
                                                    <span class="checkmark"></span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                        <div class="sidebar-widget mt-30">
                            <h4 class="pro-sidebar-title">{{ $variation->name }} </h4>
                            <div class="sidebar-widget-list mt-20">
                                <ul>
                                    @foreach ($variation->variationValue as $variatioValue)
                                        <li>
                                            <div class="sidebar-widget-list-left">
                                                <input class="variation" type="checkbox"
                                                    {{ request()->has('variation') && in_array($variatioValue->value, explode('-', request('variation'))) ? 'checked' : '' }}
                                                    value="{{ $variatioValue->value }}"> <a
                                                    href="#">{{ $variatioValue->value }}</a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div>
                            <button type="button" onclick="uncheckAll()" class="btn btn-outline-danger">حذف فیلتر
                                ها</button>
                            <button onclick="filter()" class="btn btn-outline-dark">اعمال فیلتر</button>
                        </div>
                    </div>
                </div>
                <!-- content -->
                <div class="col-lg-9 order-1 order-sm-1 order-md-2">
                    <!-- shop-top-bar -->
                    <div class="shop-top-bar" style="direction: rtl;">

                        <div class="select-shoing-wrap">
                            <div class="shop-select">
                                <select class="form-control" id="sortFilter" onchange="filter()">
                                    <option value="default"> مرتب سازی </option>
                                    <option value="Max"
                                        {{ request()->has('sortBy') && request()->sortBy == 'Max' ? 'selected' : '' }}>
                                        بیشترین قیمت </option>
                                    <option value="Min"
                                        {{ request()->has('sortBy') && request()->sortBy == 'Min' ? 'selected' : '' }}> کم
                                        ترین قیمت </option>
                                    <option value="Latest"
                                        {{ request()->has('sortBy') && request()->sortBy == 'Latest' ? 'selected' : '' }}>
                                        جدیدترین </option>
                                    <option value="Oldest"
                                        {{ request()->has('sortBy') && request()->sortBy == 'Oldest' ? 'selected' : '' }}>
                                        قدیمی ترین </option>
                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="shop-bottom-area mt-35">
                        <div class="tab-content jump">

                            <div class="row ht-products" style="direction: rtl;">
                                @foreach ($products as $product)
                                    <div class="col-xl-4 col-md-6 col-lg-6 col-sm-6">
                                        @include('home.commons.product')
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <div id="pagination" class="pro-pagination-style text-center mt-30">
                           {{$products->withQueryString()->links('home.commons.pagination')}}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <form id="filterForm">
        @foreach ($attributes as $attribute)
            <input type="hidden" name="attribute[{{ $attribute->id }}]" id="form-attribute-{{ $attribute->id }}">
        @endforeach
        <input type="hidden" name="variation" id="form-variation">
        <input type="hidden" name="sortBy" id="form-sort">
        <input type="hidden" name="search" id="form-search">
    </form>

@endsection
