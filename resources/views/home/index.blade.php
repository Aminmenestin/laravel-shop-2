@extends('home.layouts.master')

@section('title', 'Home')

@push('customjs')
    <script type="text/javascript">
        function activeClass(targetCategory) {

            $.ajax({
                type: "GET",
                url: "{{ route('home.parent_categories') }}",
                success: function(response) {
                    $.each(response, function(indexInArray, category) {
                        $(`#product-category-${category.id}`).removeClass('active');
                        $(`#product-category-${targetCategory}`).addClass('active');
                    });
                }
            });
        }

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

    <div class="slider-area section-padding-1">
        <div class="slider-active owl-carousel nav-style-1">
            @foreach ($sliders->where('banner_position', 1) as $slider)
                <div class="single-slider slider-height-1 bg-paleturquoise">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6 text-right">
                                <div class="slider-content slider-animated-1">
                                    <h1 class="animated">{{ $slider->title }}</h1>
                                    <p class="animated">
                                        {{ $slider->description }}
                                    </p>
                                    <div class="slider-btn btn-hover">
                                        <a class="animated" href="{{ $slider->button_link }}">
                                            <i class="sli sli-basket-loaded"></i>
                                            {{ $slider->button }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
                                <div class="slider-single-img slider-animated-1">
                                    <a href="{{ $slider->button_link }}">
                                        <img class="animated" src="{{ env('BANNER_UPLOAD_PATH') . $slider->image }}"
                                            alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="banner-area pt-100 pb-65">
        <div class="container">
            <div class="row">

                @foreach ($sliders->where('banner_position', 2) as $slider)
                    <div class="col-lg-4 col-md-4">
                        <div class="single-banner mb-30 scroll-zoom">
                            <a href="product-details.html">
                                <img style="width: 350px; height: 323px; object-fit: cover" class="animated"
                                    src="{{ env('BANNER_UPLOAD_PATH') . $slider->image }}" alt="" /></a>
                            <div class="banner-content-2 banner-position-5">
                                <h4>{{ $slider->title }}</h4>
                                <h5>{{ $slider->description }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="product-area pb-70">
        <div class="container">
            <div class="section-title text-center pb-40">
                <h2> لورم ایپسوم </h2>
                <p>
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و
                    متون
                    بلکه روزنامه و مجله
                </p>
            </div>
            <div class="product-tab-list nav pb-60 text-center flex-row-reverse">

                @foreach ($parent_categories as $key => $category)
                    <a id="product-category-{{ $category->id }}" class="{{ $key == 0 ? 'active' : '' }}"
                        onclick="activeClass({{ $category->id }});" href="#category-id-{{ $category->id }}"
                        data-toggle="tab">
                        <h4>{{ $category->name }}</h4>
                    </a>
                @endforeach
            </div>
            <div class="tab-content jump-2">

                @foreach ($parent_categories as $key => $category)
                    <div id="category-id-{{ $category->id }}" class="tab-pane {{ $key == 0 ? 'active' : '' }}">
                        <div class="ht-products product-slider-active owl-carousel">
                            @foreach ($category->Randchildren as $children)
                                {{-- {{dd($children->products->take(1))}} --}}
                                @foreach ($children->Randproducts->take(5) as $product)
                                    @include('home.commons.product')
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="testimonial-area pt-80 pb-95 section-margin-1" style="background-image: url(home/img/bg/bg-1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 ml-auto mr-auto">
                    <div class="testimonial-active owl-carousel nav-style-1">
                        <div class="single-testimonial text-center">
                            <img src="home/img/testimonial/testi-1.png" alt="" />
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                                چاپگرها و
                                متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
                                نیاز و
                                کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته،
                                حال و
                                آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت
                            </p>
                            <div class="client-info">
                                <img src="home/img/icon-img/testi.png" alt="" />
                                <h5>لورم ایپسوم</h5>
                            </div>
                        </div>
                        <div class="single-testimonial text-center">
                            <img src="home/img/testimonial/testi-2.png" alt="" />
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                                چاپگرها و
                                متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
                                نیاز و
                                کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته،
                                حال و
                                آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت
                            </p>
                            <div class="client-info">
                                <img src="home/img/icon-img/testi.png" alt="" />
                                <h5>لورم ایپسوم</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-area pt-95 pb-70">
        <div class="container">
            <div class="section-title text-center pb-60">
                <h2>لورم ایپسوم</h2>
                <p>
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و
                    متون
                    بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است
                </p>
            </div>
            <div class="arrivals-wrap scroll-zoom">
                <div class="ht-products product-slider-active owl-carousel">

                    @foreach ($products->random(1) as $product)
                        @include('home.commons.product')
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="banner-area pb-120">
        <div class="container">
            <div class="row">
                {{-- @foreach ($sliders->where('banner_position', 3)->random(2) as $slider)
                    <div class="col-lg-6 col-md-6 text-right">
                        <div class="single-banner mb-30 scroll-zoom">
                            <a href="{{ $slider->button_link }}"><img
                                    style="width: 540px ; height: 303px; object-fit: cover"
                                    src="{{ env('BANNER_UPLOAD_PATH') . $slider->image }}" alt="" /></a>
                            <div class="banner-content banner-position-3">
                                <h2>{{ $slider->title }}</h2>
                                <h4>{{ $slider->description }}</h4>
                                <a href="{{ $slider->button_link }}">{{ $slider->button }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach --}}
            </div>
        </div>
    </div>

    <div class="feature-area" style="direction: rtl;">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature text-right mb-40">
                        <div class="feature-icon">
                            <img src="home/img/icon-img/free-shipping.png" alt="" />
                        </div>
                        <div class="feature-content">
                            <h4>لورم ایپسوم</h4>
                            <p>لورم ایپسوم متن ساختگی</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature text-right mb-40 pl-50">
                        <div class="feature-icon">
                            <img src="home/img/icon-img/support.png" alt="" />
                        </div>
                        <div class="feature-content">
                            <h4>لورم ایپسوم</h4>
                            <p>24x7 لورم ایپسوم</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature text-right mb-40">
                        <div class="feature-icon">
                            <img src="home/img/icon-img/security.png" alt="" />
                        </div>
                        <div class="feature-content">
                            <h4>لورم ایپسوم</h4>
                            <p>لورم ایپسوم متن ساختگی</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('home.commons.modal')

@endsection
