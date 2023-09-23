@extends('home.layouts.master')


@section('script')
    <script>
        $('.minus').click(function() {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;

            let cartId = $(this).attr("data-id");

            let quantity = $(`#quantity-${cartId}`).val();

            if (count >= 1) {

                submit(cartId, quantity, 'minus');
            }

            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();



            let price = $(this).attr("data-price")

            let totalPrice = price * count;

            $(`#totalPrice-${cartId}`).empty();
            $(`#totalPrice-${cartId}`).html(toPersianNum(formatNumber(totalPrice)));
            return false;
        });

        $('.plus').click(function(e) {

            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) + 1;


            let cartId = $(this).attr("data-id");

            let quantity = $(`#quantity-${cartId}`).val();


            if (count <= $(this).attr("data-max")) {

                submit(cartId, quantity, 'plus');
            }

            count = count >= $(this).attr("data-max") ? $(this).attr("data-max") : count;
            $input.val(count);
            $input.change();



            let price = $(this).attr("data-price")

            let totalPrice = price * count;

            $(`#totalPrice-${cartId}`).empty();
            $(`#totalPrice-${cartId}`).html(toPersianNum(formatNumber(totalPrice)));
            return false;
        });

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }


        function submit(id, quantity, type) {
            $.ajax({
                type: "POST",
                url: "{{ route('home.cart.update') }}",
                data: {
                    cartId: id,
                    quantity: quantity,
                    type: type,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('home.cart.info') }}",
                        success: function(response) {

                            $('#shiping').html(toPersianNum(formatNumber(response.shiping)));
                            $('#totalamount').html(toPersianNum(formatNumber(response
                                    .totalamount)) +
                                ' تومان');
                            $('#finalamount').html(toPersianNum(formatNumber(response
                                .finalamount)) + ' تومان');
                            $('#totalesaleamount').html(toPersianNum(formatNumber(
                                response.totalesaleamount)) + ' تومان');

                            $('#headertotalprice').html(toPersianNum(formatNumber(response
                                .finalamount)));
                            $('#cardtotalprice').html(toPersianNum(formatNumber(response
                                .finalamount)));

                        }
                    });

                    $(`#headerQuantity-${id}`).html(response[id].quantity + ' x ' +
                        toPersianNum(formatNumber(
                            response[id].price)));
                }
            });
        }


        function reload() {
            location.reload();
        }
    </script>
@endsection


@section('content')
    <div class="breadcrumb-area pt-35 pb-35 bg-gray" style="direction: rtl;">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="{{ route('home.index') }}"> صفحه ای اصلی </a>
                    </li>
                    <li class="active"> سبد خرید </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="cart-main-area pt-95 pb-100 text-right" style="direction: rtl;">
        <div class="container">
            @if (!\Cart::isEmpty())
                <h3 class="cart-page-title"> سبد خرید شما </h3>
            @endif
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                    @if (\Cart::isEmpty())
                        <div class="container cart-empty-content">
                            <div class="row justify-content-center">
                                <div class="col-md-6 text-center">
                                    <i class="sli sli-basket"></i>
                                    <h2 class="font-weight-bold my-4">سبد خرید خالی است.</h2>
                                    <p class="mb-40">شما هیچ کالایی در سبد خرید خود ندارید.</p>
                                    <a href="{{ route('home.index') }}"> صفحه اصلی </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                    <tr>
                                        <th> تصویر محصول </th>
                                        <th> نام محصول </th>
                                        <th> فی </th>
                                        <th> تعداد </th>
                                        <th> قیمت </th>
                                        <th> عملیات </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach (\Cart::getContent() as $item)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="#"><img
                                                        style="width: 100px; height: 100px; object-fit: cover"
                                                        src="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $item->associatedModel->primary_image }}"
                                                        alt=""></a>
                                            </td>
                                            <td class="product-name">
                                                <h4><a
                                                        href="{{ route('home.product.details', $item->associatedModel->slug) }}">{{ $item->name }}</a>
                                                </h4>
                                                <div dir="rtl">
                                                    {{ App\Models\Attribute::find($item->attributes->attribute_id)->name }}
                                                    : {{ $item->attributes->value }}</div>

                                            </td>
                                            <td class="product-price-cart"><span class="amount">
                                                    {{ number_format($item->price) }}
                                                    تومان
                                                    @if ($item->attributes->is_sale)
                                                        <div dir="rtl" style="color:#ff3535;">
                                                            {{ App\Models\ProductVariation::find($item->attributes->id)->percent_sale }}%
                                                            تخفیف</div>
                                                    @endif
                                                </span></td>
                                            <td class="product-quantity">
                                                <div class="number">
                                                    <span class="plus" data-price="{{ $item->price }}"
                                                        data-id="{{ $item->id }}"
                                                        data-max="{{ App\Models\ProductVariation::find($item->attributes->id)->ProductQuantity }}">+</span>
                                                    <input class="quantity-input" readonly type="text"
                                                        id="quantity-{{ $item->id }}" name="quantity"
                                                        value="{{ $item->quantity }}" />
                                                    <span class="minus" data-price="{{ $item->price }}"
                                                        data-id="{{ $item->id }}">-</span>
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                <span id="totalPrice-{{ $item->id }}">
                                                    {{ number_format($item->price * $item->quantity) }}
                                                </span>
                                                تومان
                                            </td>
                                            <td class="product-remove">
                                                <a href="{{ route('home.cart.delete', $item->id) }}"><i
                                                        class="sli sli-close"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cart-shiping-update-wrapper">
                                    <div class="cart-shiping-update">
                                        <a href="#"> ادامه خرید </a>
                                    </div>
                                    <div class="cart-clear">
                                        <button onclick="reload()"> به روز رسانی سبد خرید </button>
                                        <a href="{{ route('home.cart.clear') }}"> پاک کردن سبد خرید </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between">

                            <div class="col-lg-4 col-md-6">
                                <div class="discount-code-wrapper">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gray"> کد تخفیف </h4>
                                    </div>
                                    <div class="discount-code">
                                        <p> لورم ایپسوم متن ساختگی با تولید سادگی </p>
                                        <form action="{{ route('home.cart.couponcheck') }}" method="POST">
                                            @csrf
                                            <input type="text" required="" name="coupon">
                                            <button class="cart-btn-2" type="submit"> ثبت </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12">
                                <div class="grand-totall">
                                    <div class="title-wrap">
                                        <h4 class="cart-bottom-title section-bg-gary-cart"> مجموع سفارش </h4>
                                    </div>

                                    <h5>
                                        مبلغ سفارش :
                                        <span id="totalamount">
                                            {{ number_format(cardtotalamount()) }}
                                            تومان
                                        </span>
                                    </h5>
                                    @if (totalesaleamount() > 0)
                                        <h5>
                                            مبلغ تخفیف :
                                            <span id="totalesaleamount" style="color:#ff3535;">
                                                {{ number_format(totalesaleamount()) }}
                                                تومان
                                            </span>
                                        </h5>
                                    @endif
                                    <div class="total-shipping">
                                        <h5>
                                            هزینه ارسال :
                                            @if (shiping() == 0)
                                                <span>
                                                    رایگان
                                                </span>
                                            @else
                                                <span id="shiping">
                                                    {{ number_format(shiping()) }}
                                                </span>
                                            @endif
                                        </h5>

                                    </div>
                                    @if (session()->exists('coupon'))
                                        <h5>
                                            مبلغ کد تخفیف:
                                            <span style="color:#ff3535;">
                                                {{ number_format(session()->get('coupon.amount')) }}
                                            </span>
                                        </h5>
                                        <hr>
                                    @endif
                                    <h4 class="grand-totall-title">
                                        جمع کل:
                                        <span id="finalamount">
                                            {{ number_format(finalamount()) }}
                                            تومان
                                        </span>
                                    </h4>
                                    <a href="{{route('home.order.index')}}"> ادامه فرآیند خرید </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>


    </div>
@endsection
