@extends('home.layouts.master');


@section('title')
    صفحه محصولات
@endsection


@section('script')
    <script type="module">
        $('#error').hide();

        $('.variationSelect').on('change', function() {


            let variation = JSON.parse(this.value);

            $('.variationPriceDivMain').empty();

            if (variation.is_sale == 1) {
                let spanSale = $('<span />', {
                    class: 'new',
                    text: toPersianNum(number_format(variation.sale_price)) + ' تومان'
                })
                let spanprice = $('<span />', {
                    class: 'old',
                    text: toPersianNum(number_format(variation.price)) + ' تومان'
                })
                $('.variationPriceDivMain').append(spanSale);
                $('.variationPriceDivMain').append(spanprice);
            } else {
                let spanSale = $('<span />', {
                    class: 'new',
                    text: toPersianNum(number_format(variation.price)) + ' تومان'
                })
                $('.variationPriceDivMain').append(spanSale);
            }

            $('.quantityInputMain').attr('data-max', variation.quantity);
            $('.quantityInputMain').val(1);

        })


        $("#review").rating({
            "click": function(e) {
                $('#ratestar').val(e.stars)
            }
        });


        $('#commentForm').on('submit', function(e) {
            e.preventDefault();

            let product = @json($product)

            let rate = $('#ratestar').val();
            let comment = $('#comment').val();

            $.ajax({
                type: "POST",
                url: `{{ env('APP_URL') }}/product/${product.slug}`,
                data: {
                    'comment': comment,
                    'rate': rate,
                    '_token': '{{ csrf_token() }}'
                },
                success: function(response) {

                    console.log(response);

                    $('#error').fadeOut();

                    $('#comment').val('')
                    $('#ratestar').val('')

                    $("#review").rating({
                        "value": 0,
                        "click": function(e) {
                            $('#ratestar').val(e.stars)
                        }
                    });

                    Swal.fire({
                        icon: 'success',
                        text: 'کامنت شما با موفقیت ثبت شد',
                        timer: 2000
                    })
                },
                error: function(response) {

                    console.log(response);

                    $('#error').fadeIn();
                    $('#errorul').empty();

                    $.each(response.responseJSON.errors, function(indexInArray, valueOfElement) {

                        if (indexInArray == 'auth') {
                            $('#error').hide();
                            Swal.fire({
                                icon: 'error',
                                text: valueOfElement,
                                timer: 2000
                            })
                        } else {

                            let li = $("<li/>", {
                                text: valueOfElement[0],
                            });

                            $('#errorul').append(li)
                        }

                    });
                }
            });

        })
    </script>
@endsection


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

    <div class="product-details-area pt-100 pb-95">
        <div class="container">
            <div class="row">

                <div class="col-lg-6 col-md-6 order-2 order-sm-2 order-md-1" style="direction: rtl;">
                    <div class="product-details-content ml-30">
                        <h2 class="text-right">{{ $product->name }}</h2>
                        <div class="product-details-price variationPriceDivMain">
                            @if ($product->quantity_check == null)
                                <div class="not-in-stock">
                                    <p>
                                        ناموجود
                                    </p>
                                </div>
                            @else
                                @if ($product->isSaleCheck)
                                    <span class="new">
                                        {{ number_format($product->isSaleCheck->sale_price) }}
                                        تومان
                                    </span>
                                    <span class="old">
                                        {{ number_format($product->isSaleCheck->price) }}
                                        تومان
                                    </span>
                                @else
                                    <span class="new">
                                        {{ number_format($product->priceCheck->price) }}
                                        تومان
                                    </span>
                                @endif
                            @endif
                        </div>
                        <div class="pro-details-rating-wrap">
                            <div data-rating-stars="5" data-rating-readonly="true"
                                data-rating-value="{{ ceil($product->rates->avg('rate')) }}"
                                data-rating-input="#dataReadonlyInput">
                            </div>
                            <span class="mx-2">|</span>
                            <span> {{ $product->comments->count() }} دیدگاه</span>
                        </div>
                        <p class="text-right">
                            {{ $product->description }}
                        </p>
                        <div class="pro-details-list text-right">
                            <ul class="text-right">
                                @foreach ($product->attributes()->with('attribute')->get() as $attributes)
                                    <li>
                                        {{ $attributes->attribute->name }}
                                        :
                                        {{ $attributes->value }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @if ($product->quantityCheck)
                            @php
                                if ($product->isSaleCheck) {
                                    $productVariationSelected = $product->isSaleCheck;
                                } else {
                                    $productVariationSelected = $product->priceCheck;
                                }
                            @endphp

                            <div class="pro-details-size-color text-right">
                                <div class="pro-details-size w-50">
                                    <span>{{ App\Models\Attribute::find($product->variations->first()->attribute_id)->name }}</span>
                                    <select class="form-control variationSelect" id="variationSelect">
                                        @foreach ($product->variations()->where('quantity', '>', 0)->get() as $variation)
                                            <option
                                                value="{{ json_encode($variation->only(['id', 'quantity', 'sale_price', 'price', 'is_sale'])) }}"
                                                {{ $productVariationSelected->id == $variation->id ? 'selected' : '' }}>
                                                {{ $variation->value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="pro-details-quality">
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box quantityInputMain" type="text" name="qtybutton"
                                        value="1" data-max="{{ $productVariationSelected->quantity }}" />
                                </div>
                                <div class="pro-details-cart">
                                    <a href="#">افزودن به سبد خرید</a>
                                </div>
                                <div class="pro-details-wishlist">
                                    <a title="Add To Wishlist" href="#"><i class="sli sli-heart"></i></a>
                                </div>
                                <div class="pro-details-compare">
                                    <a title="Add To Compare" href="#"><i class="sli sli-refresh"></i></a>
                                </div>
                            </div>
                        @endif

                        @if (!$product->quantityCheck)
                            <div class="pro-details-quality">
                                <div class="pro-details-wishlist">
                                    <a title="Add To Wishlist" href="#"><i class="sli sli-heart"></i></a>
                                </div>
                                <div class="pro-details-compare">
                                    <a title="Add To Compare" href="#"><i class="sli sli-refresh"></i></a>
                                </div>
                            </div>
                        @endif
                        <div class="pro-details-meta">
                            <span>دسته بندی :</span>
                            <ul>
                                <li><a href="#">{{ $product->category->parent->name }}</a></li>
                                <span>,</span>
                                <li><a href="#">{{ $product->category->name }}</a></li>
                            </ul>
                        </div>
                        <div class="pro-details-meta">
                            <span>تگ ها :</span>
                            <ul>
                                @foreach ($product->tags as $tag)
                                    <li><a href="#">{{ $tag->name }} {{ $loop->last ? '' : ',' }} </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 order-1 order-sm-1 order-md-2">
                    <div class="product-details-img">
                        <div class="zoompro-border zoompro-span">
                            <img class="zoompro" src="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image }}"
                                data-zoom-image="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image }}"
                                alt="" />

                        </div>
                        <div id="gallery" class="mt-20 product-dec-slider">
                            <a data-image="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image }}"
                                data-zoom-image="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image }}">
                                <img style="width: 90"
                                    src="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image }}" alt="">
                            </a>
                            @foreach ($product->images as $image)
                                <a data-image="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image }}"
                                    data-zoom-image="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image }}">
                                    <img style="width: 90" src="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image }}"
                                        alt="">
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="description-review-area pb-95">
        <div class="container">
            <div class="row" style="direction: rtl;">
                <div class="col-lg-8 col-md-8">
                    <div class="description-review-wrapper">
                        <div class="description-review-topbar nav">
                            <a data-toggle="tab" href="#des-details1"> توضیحات </a>
                            <a data-toggle="tab" href="#des-details2"> اطلاعات بیشتر </a>
                            <a class="active" data-toggle="tab" href="#des-details3">
                                دیدگاه
                                ({{ $product->comments->count() }})
                            </a>
                        </div>
                        <div class="tab-content description-review-bottom">
                            <div id="des-details1" class="tab-pane">
                                <div class="product-description-wrapper">
                                    <p class="text-justify">
                                        {{ $product->description }}
                                    </p>
                                </div>
                            </div>
                            <div id="des-details2" class="tab-pane">
                                <div class="product-anotherinfo-wrapper text-right">
                                    <ul>
                                        @foreach ($product->attributes()->with('attribute')->get() as $attributes)
                                            <li>
                                                {{ $attributes->attribute->name }}
                                                :
                                                {{ $attributes->value }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div id="des-details3" class="tab-pane active">

                                <div class="review-wrapper">


                                    @if ($product->comments->first())
                                        @foreach ($product->comments as  $comment)
                                            <div class="single-review">
                                                <div class="review-img">
                                                    <img src="" alt="">
                                                </div>
                                                <div class="review-content text-right">
                                                    <p class="text-right">
                                                        {{ $comment->text }}
                                                    </p>
                                                    <div class="review-top-wrap">
                                                        <div class="review-name ml-2">
                                                            <h4> {{ $comment->user->name }} </h4>
                                                        </div>
                                                        <div data-rating-stars="5" data-rating-readonly="true"
                                                            data-rating-value="{{ $comment->rate->rate }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="ratting-form-wrapper text-right">
                                    <span> امتیاز محصول </span>

                                    <div style="font-size: 20px" class="star-box-wrap">
                                        <div id="review"></div>
                                    </div>

                                    <div class="ratting-form">
                                        <form id="commentForm">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="rating-form-style mb-20">
                                                        <label> متن دیدگاه : </label>
                                                        <textarea name="comment" id="comment"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12">
                                                    <div class="form-submit">
                                                        <div id="error" class="alert alert-danger">
                                                            <ul id="errorul">
                                                            </ul>
                                                        </div>
                                                        <input type="submit" value="ارسال">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="rate" id="ratestar">
                                        </form>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="pro-dec-banner">
                        <a href="#"><img src="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image }}"
                                alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-area pb-70">
        <div class="container">
            <div class="section-title text-center pb-60">
                <h2> محصولات مرتبط </h2>
                <p>
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                    چاپگرها و متون بلکه روزنامه و مجله
                </p>
            </div>
            <div class="arrivals-wrap scroll-zoom">
                <div class="ht-products product-slider-active owl-carousel">
                    @foreach ($products as $product)
                        @include('home.commons.product')
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('home.commons.modal')

@endsection
