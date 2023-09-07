@extends('home.layouts.master')

@section('title', 'صفحه مقایسه')

@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="index.html"> صفحه ای اصلی </a>
                    </li>
                    <li class="active"> مقایسه محصول </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- compare main wrapper start -->
    <div class="compare-page-wrapper pt-100 pb-100" style="direction: rtl;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Compare Page Content Start -->
                    <div class="compare-page-content-wrap">
                        <div class="compare-table table-responsive">
                            @if (session()->has('compare'))
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="first-column"> محصول </td>
                                            @foreach ($products as $product)
                                                <td class="product-image-title">
                                                    <a href="{{ route('home.product.details', $product->slug) }}"
                                                        class="image">
                                                        <img class="img-fluid"
                                                            src="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image }}"
                                                            alt="Compare Product">
                                                    </a>
                                                    <a href="{{ route('home.categories.show', $product->category->slug) }}"
                                                        class="category"> {{ $product->category->name }} </a>
                                                    <a href="{{ route('home.product.details', $product->slug) }}"
                                                        class="title"> {{ $product->name }} </a>
                                                </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td class="first-column"> توضیحات </td>
                                            @foreach ($products as $product)
                                                <td class="pro-desc">
                                                    <p class="text-right">
                                                        {{ $product->description }}
                                                    </p>
                                                </td>
                                            @endforeach
                                        </tr>

                                        <tr>
                                            <td class="first-column"> ویژگی متغییر </td>
                                            @foreach ($products as $product)
                                                <td class="pro-color">
                                                    {{ $product->category->attributes()->where('is_filter', 1)->where('is_variation', 1)->first()->name }}
                                                    :
                                                    @foreach ($product->variations as $variation)
                                                        {{ $variation->value }}
                                                        {{ $loop->last ? '' : ',' }}
                                                    @endforeach
                                                </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td class="first-column"> ویژگی </td>

                                            @foreach ($products as $product)
                                                <td class="pro-stock">

                                                    @foreach ($product->attributes()->with('attribute')->get() as $attribute)
                                                        {{ $attribute->attribute->name }}
                                                        :
                                                        {{ $attribute->value }}
                                                        <br>
                                                    @endforeach

                                                </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td class="first-column"> امتیاز </td>

                                            @foreach ($products as $product)
                                                <td>
                                                    <div data-rating-stars="5" data-rating-readonly="true"
                                                        data-rating-value="{{ ceil($product->rates->avg('rate')) }}"
                                                        data-rating-input="#dataReadonlyInput">
                                                    </div>
                                                </td>
                                            @endforeach



                                        </tr>
                                        <tr>
                                            <td class="first-column"> حذف </td>
                                            @foreach ($products as $product)
                                                <td class="pro-remove">
                                                    <a href="{{ route('home.compare.delete', $product->id) }}"><i
                                                            class="sli sli-trash"></i></a>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-danger text-center">
                                    <span>
                                        محصولی برای مقایسه وجود ندارد
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Compare Page Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- compare main wrapper end -->
@endsection
