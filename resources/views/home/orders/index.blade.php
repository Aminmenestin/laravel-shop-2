@extends('home.layouts.master')


@section('script')
    <script>
        $('#province').on('change', function() {
            $.ajax({
                type: "get",
                url: "{{ route('home.order.citiesInfo') }}",
                data: {
                    provindeId: $(this).val()
                },
                success: function(response) {

                    $('#cities').empty();

                    let optionDefault = $('<option/>', {
                        value: '',
                        text: 'انتخاب شهر'
                    })
                    $('#cities').append(optionDefault);

                    $.each(response, function(indexInArray, city) {


                        let option = $('<option/>', {
                            value: city.id,
                            text: city.title
                        })

                        $('#cities').attr('disabled', false);


                        $('#cities').append(option);
                    });
                }
            });

        })


        $('#addressError').hide();

        $('#addressForm').on('submit', function(e) {
            e.preventDefault();

            let title = $('#title').val();
            let number = $('#number').val();
            let province = $('#province').val();
            let city = $('#cities').val();
            let address = $('#address').val();
            let postalCode = $('#postalCode').val();


            $.ajax({
                type: "POST",
                url: "{{ route('home.profile.address.Create') }}",
                data: {
                    title: title,
                    number: number,
                    province: province,
                    city: city,
                    address: address,
                    postalCode: postalCode,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {

                    $('#addressError').fadeOut();
                    $('#formshower').css("display", "none");
                    Swal.fire({
                        title: 'عالی',
                        icon: 'success',
                        text: response.success,
                        timer: 1000,

                    }).then(() => {
                        location.reload()
                    })


                },
                error: function(response) {

                    console.log(response)

                    $('#formshower').css("display", "block");

                    $('#addressError').empty();
                    $('#addressError').fadeIn();


                    $.each(response.responseJSON.errors, function(indexInArray, valueOfElement) {

                        let li = $('<li/>', {
                            text: valueOfElement[0]
                        })

                        $('#addressError').append(li);
                    });


                }
            });
        })

        $('#addressSelect').on('change' , function(){
            $('#addressInput').val($(this).val())
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
                    <li class="active"> سفارش </li>
                </ul>
            </div>
        </div>
    </div>


    <!-- compare main wrapper start -->
    <div class="checkout-main-area pt-70 pb-70 text-right" style="direction: rtl;">

        <div class="container">

            <div class="customer-zone mb-20">
                <p class="cart-page-title">
                    کد تخفیف دارید؟
                    <a class="checkout-click3" href="#"> میتوانید با کلیک در این قسمت کد خود را اعمال کنید </a>
                </p>
                <div class="checkout-login-info3">
                    <form action="{{ route('home.cart.couponcheck') }}" method="POST">
                        @csrf
                        <input type="text" placeholder="کد تخفیف" name="coupon">
                        <input type="submit" value="اعمال کد تخفیف">
                    </form>
                </div>
            </div>

            <div class="checkout-wrap pt-30">
                <div class="row">

                    <div class="col-lg-7">
                        <div class="billing-info-wrap mr-50">
                            <h3> آدرس تحویل سفارش </h3>

                            <div class="row">
                                <p>
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                    گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است
                                </p>
                                @if ($userAddresses->first() !== null)
                                    <div class="col-lg-6 col-md-6">
                                        <div class="billing-info tax-select mb-20">
                                            <label> انتخاب آدرس تحویل سفارش <abbr class="required"
                                                    title="required">*</abbr></label>

                                            <select class="email s-email s-wid" id="addressSelect">
                                                <option value="">انتخاب آدرس</option>
                                                @foreach ($userAddresses as $userAddresse)
                                                    <option value="{{ $userAddresse->id }}"> {{ $userAddresse->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-lg-6 col-md-6 pt-30">
                                    <button class="collapse-address-create" type="submit"> ایجاد آدرس جدید </button>
                                </div>

                                <div class="col-lg-12">
                                    <div class="collapse-address-create-content" id="formshower">

                                        <form id="addressForm">

                                            <div class="row">

                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        عنوان
                                                    </label>
                                                    <input type="text" name="title" id="title">
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        شماره تماس
                                                    </label>
                                                    <input type="text" name="number" id="number">
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        استان
                                                    </label>
                                                    <select class="email s-email s-wid" id="province" name="province">
                                                        <option value="">انتخاب استان</option>
                                                        @foreach ($provinces->where('parent', 0) as $province)
                                                            <option value="{{ $province->id }}">{{ $province->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        شهر
                                                    </label>
                                                    <select class="email s-email s-wid" id="cities" disabled
                                                        name="cities">
                                                        <option value="">انتخاب شهر</option>
                                                    </select>
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        آدرس
                                                    </label>
                                                    <input type="text" name="address" id="address">
                                                </div>
                                                <div class="tax-select col-lg-6 col-md-6">
                                                    <label>
                                                        کد پستی
                                                    </label>
                                                    <input type="text" name="postalCode" id="postalCode">
                                                </div>

                                                <div class=" col-lg-12 col-md-12">

                                                    <div class="alert alert-danger" id="addressError">
                                                        <ul id="addressErrorUl">

                                                        </ul>
                                                    </div>

                                                    <button class="cart-btn-2" type="submit"> ثبت آدرس جدید
                                                    </button>
                                                </div>



                                            </div>

                                        </form>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="your-order-area">
                            <h3> سفارش شما </h3>
                            <div class="your-order-wrap gray-bg-4">
                                <div class="your-order-info-wrap">
                                    <div class="your-order-info">
                                        <ul>
                                            <li style="display: flex; justify-content: space-between"> محصول <span> تعداد
                                                </span> <span>جمع</span></li>
                                        </ul>
                                    </div>
                                    <div class="your-order-middle">
                                        <ul>

                                            @foreach (\Cart::getContent() as $item)
                                                <li style="display: flex ; justify-content: space-between">

                                                    <div style="display: inline-block">
                                                        {{ $item->name }}

                                                      <div>  {{ App\Models\Attribute::find($item->attributes->attribute_id)->name }}
                                                        : {{ $item->attributes->value }}</div>

                                                        @if ($item->attributes->is_sale)
                                                            <div style="color:#ff3535;">
                                                                {{ App\Models\ProductVariation::find($item->attributes->id)->percent_sale }}%
                                                                تخفیف</div>
                                                        @endif
                                                    </div>



                                                    <span style="margin-left: 10px">
                                                        x{{ number_format($item->quantity) }}
                                                    </span>


                                                    <span>
                                                        {{ number_format($item->price) }}
                                                        تومان
                                                    </span>


                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                    <div class="your-order-info order-subtotal">
                                        <ul>
                                            <li> مبلغ
                                                <span>
                                                    {{ number_format(cardtotalamount()) }}
                                                    تومان
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                    @if (totalesaleamount() > 0)
                                        <div class="your-order-info order-subtotal">
                                            <ul>
                                                <li> مبلغ تخفیف
                                                    <span style="color:#ff3535;">
                                                        {{ number_format(totalesaleamount()) }}
                                                        تومان
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="your-order-info order-shipping">
                                        <ul>
                                            <li> هزینه ارسال
                                                @if (shiping() == 0)
                                                    <span style="color:#ff3535;">
                                                        رایگان
                                                    </span>
                                                @else
                                                    <span id="shiping">
                                                        {{ number_format(shiping()) }}
                                                    </span>
                                                @endif
                                            </li>
                                        </ul>
                                    </div>
                                    @if (session()->exists('coupon'))
                                        <div class="your-order-info order-shipping">
                                            <ul>
                                                <li> مبلغ کد تخفیف
                                                    <span style="color:#ff3535;">
                                                        {{ number_format(session()->get('coupon.amount')) }}
                                                        تومان
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="your-order-info order-total">
                                        <ul>
                                            <li>جمع کل
                                                <span>
                                                    {{ number_format(finalamount()) }}
                                                    تومان </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <form action="{{route('home.payment')}}" method="POST">
                                    @csrf
                                    <div class="payment-method">
                                        <div class="pay-top sin-payment">
                                            <input id="zarinpal" class="input-radio" type="radio" value="zarinpal"
                                                checked="checked" name="payment_method">
                                            <label for="zarinpal"> درگاه پرداخت زرین پال </label>
                                            <div class="payment-box payment_method_bacs">
                                                <p>
                                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                                                    از
                                                    طراحان گرافیک است.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="pay-top sin-payment">
                                            <input id="pay" class="input-radio" type="radio" value="zibal"
                                                name="payment_method">
                                            <label for="pay">درگاه پرداخت زیبال</label>
                                            <div class="payment-box payment_method_bacs">
                                                <p>
                                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده
                                                    از
                                                    طراحان گرافیک است.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Place-order mt-40">

                                        @include('admin.commons.error')

                                        <button type="submit">ثبت سفارش</button>
                                    </div>
                                    <input type="hidden" id="addressInput"  name="address">
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
