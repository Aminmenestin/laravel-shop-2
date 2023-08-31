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
                                <form class="pro-sidebar-search-form" action="#">
                                    <input type="text" placeholder="... جستجو ">
                                    <button>
                                        <i class="sli sli-magnifier"></i>
                                    </button>
                                </form>
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
                            @foreach ($attribitues as $attribute)
                                <h4 class="pro-sidebar-title">{{ $attribute->name }}</h4>
                                <div class="sidebar-widget-list mt-20">
                                    <ul>
                                        @foreach ($attribute->attribiuteValue as $attributeValue)
                                            <li>
                                                <div class="sidebar-widget-list-left">
                                                    <input type="checkbox" value=""> <a
                                                        href="#">{{ $attributeValue->value }}</a>
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
                                                <input type="checkbox" value=""> <a href="#">{{$variatioValue->value}}</a>
                                                <span class="checkmark"></span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- content -->
                <div class="col-lg-9 order-1 order-sm-1 order-md-2">
                    <!-- shop-top-bar -->
                    <div class="shop-top-bar" style="direction: rtl;">

                        <div class="select-shoing-wrap">
                            <div class="shop-select">
                                <select>
                                    <option value=""> مرتب سازی </option>
                                    <option value=""> بیشترین قیمت </option>
                                    <option value=""> کم ترین قیمت </option>
                                    <option value=""> جدیدترین </option>
                                    <option value=""> قدیمی ترین </option>
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

                        <div class="pro-pagination-style text-center mt-30">
                            <ul class="d-flex justify-content-center">
                                <li><a class="prev" href="#"><i class="sli sli-arrow-left"></i></a></li>
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a class="next" href="#"><i class="sli sli-arrow-right"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
