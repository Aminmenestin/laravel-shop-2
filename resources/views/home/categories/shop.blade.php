@extends('home.layouts.master')

@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="index.html">صفحه ای اصلی</a>
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
                                        {{$parent_category->name}}
                                    </li>

                                    @foreach ($parent_category->children as $childCategory)
                                    <li>
                                        <a href="{{route('home.shop' , ['category' =>$childCategory->slug ])}}" class="{{$category->id == $childCategory->id ? 'selected_category' : ''}}">
                                            {{$childCategory->name}}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <hr>

                        <div class="sidebar-widget mt-30">
                            <h4 class="pro-sidebar-title">رنگ </h4>
                            <div class="sidebar-widget-list mt-20">
                                <ul>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">سبز </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">کرم </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">آبی </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">مشکی </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="sidebar-widget mt-30">
                            <h4 class="pro-sidebar-title">سایز </h4>
                            <div class="sidebar-widget-list mt-20">
                                <ul>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">XL </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">L </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">SM </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-widget-list-left">
                                            <input type="checkbox" value=""> <a href="#">XXL </a>
                                            <span class="checkmark"></span>
                                        </div>
                                    </li>
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

                                {{-- @if ($category->parent_id == 0)
                                    @foreach ($category->Randchildren as $childCategory)
                                        @foreach ($childCategory->Randproducts as $product)
                                            <div class="col-xl-4 col-md-6 col-lg-6 col-sm-6">
                                                <!--Product Start-->
                                                <div
                                                    class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                                                    <div class="ht-product-inner">
                                                        <div class="ht-product-image-wrap">
                                                            <a href="product-details.html" class="ht-product-image">
                                                                <img style="width: 269px ;height: 269px; object-fit: cover" src="{{env('PRODUCT_IMAGES_UPLOAD_PATH').$product->primary_image}}"
                                                                    alt="Universal Product Style" />
                                                            </a>
                                                            <div class="ht-product-action">
                                                                <ul>
                                                                    <li>
                                                                        <a href="#" data-toggle="modal"
                                                                            data-target="#exampleModal"><i
                                                                                class="sli sli-magnifier"></i><span
                                                                                class="ht-product-action-tooltip"> مشاهده
                                                                                سریع
                                                                            </span></a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#"><i
                                                                                class="sli sli-heart"></i><span
                                                                                class="ht-product-action-tooltip">
                                                                                افزودن به علاقه مندی ها </span></a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#"><i
                                                                                class="sli sli-refresh"></i><span
                                                                                class="ht-product-action-tooltip">
                                                                                مقایسه </span></a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#"><i class="sli sli-bag"></i><span
                                                                                class="ht-product-action-tooltip"> افزودن
                                                                                به سبد خرید </span></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="ht-product-content">
                                                            <div class="ht-product-content-inner">
                                                                <div class="ht-product-categories">
                                                                    <a href="#">{{$product->category->name}}</a>
                                                                </div>
                                                                <h4 class="ht-product-title text-right">
                                                                    <a href="product-details.html"> {{$product->name}} </a>
                                                                </h4>
                                                                <div class="ht-product-price">
                                                                    <span class="new">
                                                                        55,000
                                                                        تومان
                                                                    </span>
                                                                    <span class="old">
                                                                        75,000
                                                                        تومان
                                                                    </span>
                                                                </div>
                                                                <div class="ht-product-ratting-wrap">
                                                                    <span class="ht-product-ratting">
                                                                        <span class="ht-product-user-ratting"
                                                                            style="width: 100%;">
                                                                            <i class="sli sli-star"></i>
                                                                            <i class="sli sli-star"></i>
                                                                            <i class="sli sli-star"></i>
                                                                            <i class="sli sli-star"></i>
                                                                            <i class="sli sli-star"></i>
                                                                        </span>
                                                                        <i class="sli sli-star"></i>
                                                                        <i class="sli sli-star"></i>
                                                                        <i class="sli sli-star"></i>
                                                                        <i class="sli sli-star"></i>
                                                                        <i class="sli sli-star"></i>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Product End-->
                                            </div>
                                        @endforeach
                                    @endforeach
                                @else
                                @endif
                                 --}}
                                @foreach ($products as $product)
                                    <div class="col-xl-4 col-md-6 col-lg-6 col-sm-6">
                                        <!--Product Start-->
                                        <div
                                            class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
                                            <div class="ht-product-inner">
                                                <div class="ht-product-image-wrap">
                                                    <a href="product-details.html" class="ht-product-image">
                                                        <img style="width: 269px ;height: 269px; object-fit: cover"
                                                            src="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image }}"
                                                            alt="Universal Product Style" />
                                                    </a>
                                                    <div class="ht-product-action">
                                                        <ul>
                                                            <li>
                                                                <a href="#" data-toggle="modal"
                                                                    data-target="#exampleModal"><i
                                                                        class="sli sli-magnifier"></i><span
                                                                        class="ht-product-action-tooltip"> مشاهده
                                                                        سریع
                                                                    </span></a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="sli sli-heart"></i><span
                                                                        class="ht-product-action-tooltip">
                                                                        افزودن به علاقه مندی ها </span></a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="sli sli-refresh"></i><span
                                                                        class="ht-product-action-tooltip">
                                                                        مقایسه </span></a>
                                                            </li>
                                                            <li>
                                                                <a href="#"><i class="sli sli-bag"></i><span
                                                                        class="ht-product-action-tooltip"> افزودن
                                                                        به سبد خرید </span></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="ht-product-content">
                                                    <div class="ht-product-content-inner">
                                                        <div class="ht-product-categories">
                                                            <a href="#">{{ $product->category->name }}</a>
                                                        </div>
                                                        <h4 class="ht-product-title text-right">
                                                            <a href="product-details.html"> {{ $product->name }} </a>
                                                        </h4>
                                                        <div class="ht-product-price">
                                                            <span class="new">
                                                                55,000
                                                                تومان
                                                            </span>
                                                            <span class="old">
                                                                75,000
                                                                تومان
                                                            </span>
                                                        </div>
                                                        <div class="ht-product-ratting-wrap">
                                                            <span class="ht-product-ratting">
                                                                <span class="ht-product-user-ratting"
                                                                    style="width: 100%;">
                                                                    <i class="sli sli-star"></i>
                                                                    <i class="sli sli-star"></i>
                                                                    <i class="sli sli-star"></i>
                                                                    <i class="sli sli-star"></i>
                                                                    <i class="sli sli-star"></i>
                                                                </span>
                                                                <i class="sli sli-star"></i>
                                                                <i class="sli sli-star"></i>
                                                                <i class="sli sli-star"></i>
                                                                <i class="sli sli-star"></i>
                                                                <i class="sli sli-star"></i>
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!--Product End-->
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <div class="pro-pagination-style text-center mt-30">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
