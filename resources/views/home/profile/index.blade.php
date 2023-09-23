@extends('home.layouts.master')


@section('title', 'صفحه پروفایل')


@section('script')
    <script>
        $('#error').hide();

        $('#profileForm').on('submit', function(e) {
            e.preventDefault();

            let firstName = $('#first-name').val();
            let lastName = $('#last-name').val();
            let email = $('#email').val();


            $.ajax({
                type: "POST",
                url: "{{ route('home.profile.update') }}",
                data: {
                    firstName: firstName,
                    lastName: lastName,
                    email: email,
                    "_token": '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#error').fadeOut();
                    console.log(response);

                    Swal.fire({
                        icon: 'success',
                        text: response,
                        timer: 2000
                    })
                },
                error: function(response) {
                    console.log(response)
                    $('#error').fadeIn();
                    $('#errorul').empty();
                    $.each(response.responseJSON.errors, function(indexInArray, valueOfElement) {

                        let li = $("<li/>", {
                            text: valueOfElement[0],
                        });

                        $('#errorul').append(li)

                    });

                },
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
                    <li class="active"> پروفایل </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- my account wrapper start -->
    <div class="my-account-wrapper pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row text-right" style="direction: rtl;">
                            <div class="col-lg-3 col-md-4">
                                <div class="myaccount-tab-menu nav" role="tablist">

                                    <a href="#profile" class="{{request()->is('profile') ? 'active' : ''}}" data-toggle="tab">
                                        <i class="sli sli-user ml-1"></i>
                                        پروفایل
                                    </a>

                                    <a href="#orders" class="{{request()->is('profile/orders') ? 'active' : ''}}" data-toggle="tab">
                                        <i class="sli sli-basket ml-1"></i>
                                        سفارشات
                                    </a>

                                    <a href="#address" class="{{request()->is('profile/address') ? 'active' : ''}}" data-toggle="tab">
                                        <i class="sli sli-map ml-1"></i>
                                        آدرس ها
                                    </a>

                                    <a href="#wishlist" class="{{request()->is('profile/wishlist') ? 'active' : ''}}" data-toggle="tab">
                                        <i class="sli sli-heart ml-1"></i>
                                        لیست علاقه مندی ها
                                    </a>

                                    <a href="#comments" class="{{request()->is('profile/comments') ? 'active' : ''}}" data-toggle="tab">
                                        <i class="sli sli-bubble ml-1"></i>
                                        نظرات
                                    </a>

                                    <a href="{{route('logout')}}">
                                        <i class="sli sli-logout ml-1"></i>
                                        خروج
                                    </a>

                                </div>
                            </div>
                            <!-- My Account Tab Menu End -->
                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade {{request()->is('profile') ? 'show active' : ''}} " id="profile" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3> پروفایل </h3>
                                            <div class="account-details-form">
                                                <form id="profileForm">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="first-name" class="required">
                                                                    نام
                                                                </label>
                                                                <input type="text" name="first-name" id="first-name"
                                                                    value="{{ auth()->user()->name }}" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="last-name" class="required">
                                                                    نام خانوادگی
                                                                </label>
                                                                <input type="text" name="last-name" id="last-name" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="email" class="required"> ایمیل </label>
                                                        <input type="email" name="email" id="email"
                                                            value="{{ auth()->user()->email }}" />
                                                    </div>

                                                    <div id="error" class="alert alert-danger">
                                                        <ul id="errorul">
                                                        </ul>
                                                    </div>

                                                    <div class="single-input-item">
                                                        <button type="submit" class="check-btn sqr-btn "> تبت تغییرات
                                                        </button>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade {{request()->is('profile/orders') ? 'show active' : ''}}" id="orders" role="tabpanel">
                                        @if ($orders->isEmpty())
                                            <div class="alert alert-danger">
                                                <p>
                                                    سفارشی برای شما ثبت نشده است
                                                </p>
                                            </div>
                                        @else
                                            <div class="myaccount-content">
                                                <h3>سفارشات</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th> سفارش </th>
                                                                <th> تاریخ </th>
                                                                <th> وضعیت </th>
                                                                <th> جمع کل </th>
                                                                <th> شماره تراکنش </th>
                                                                <th> عملیات </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($orders as $key => $order)
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td> {{ verta($order->created_at)->format('Y/m/d') }}
                                                                    </td>
                                                                    <td
                                                                        class="{{ $order->getRawOriginal('status') ? 'text-success' : 'text-danger' }}  ">
                                                                        {{ $order->status }}</td>
                                                                    <td>
                                                                        {{ $order->total_amount }}
                                                                        تومان
                                                                    </td>
                                                                    <td>
                                                                        @if ($order->transaction->ref_id == null)
                                                                        -
                                                                        @else
                                                                        {{ $order->transaction->ref_id }}
                                                                        @endif
                                                                    </td>
                                                                    <td><a href="#" data-toggle="modal"
                                                                            data-target="#ordersDetiles-{{ $order->id }}"
                                                                            class="check-btn sqr-btn ">
                                                                            نمایش جزئیات </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade {{request()->is('profile/address') ? 'show active' : ''}}" id="address" role="tabpanel">
                                        <div class="myaccount-content address-content">
                                            <h3> آدرس ها </h3>


                                            @foreach ($addresses as $address)
                                            <div>
                                                <address>
                                                    <p>
                                                        <strong> {{$address->user->name }}</strong>
                                                        <span class="mr-2"> عنوان آدرس : <span> {{$address->title}} </span> </span>
                                                    </p>
                                                    <p>
                                                        {{$address->address}}
                                                        <br>
                                                        <span style="margin-left: 15px"> استان : {{App\Models\Provinces::find($address->province_id)->title }} </span>
                                                        <span> شهر : {{App\Models\Provinces::find($address->province_id)->title }} </span>
                                                    </p>
                                                    <p>
                                                        کدپستی :
                                                        {{$address->postal_code}}
                                                    </p>
                                                    <p>
                                                        شماره موبایل :
                                                        {{$address->number}}
                                                    </p>

                                                </address>
                                                <a href="#" class="check-btn sqr-btn collapse-address-update">
                                                    <i class="sli sli-pencil"></i>
                                                    ویرایش آدرس
                                                </a>

                                                <div class="collapse-address-update-content">

                                                    <form action="#">

                                                        <div class="row">

                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    عنوان
                                                                </label>
                                                                <input type="text" required="" name="title">
                                                            </div>
                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    شماره تماس
                                                                </label>
                                                                <input type="text">
                                                            </div>
                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    استان
                                                                </label>
                                                                <select class="email s-email s-wid">
                                                                    <option>Bangladesh</option>
                                                                    <option>Albania</option>
                                                                    <option>Åland Islands</option>
                                                                    <option>Afghanistan</option>
                                                                    <option>Belgium</option>
                                                                </select>
                                                            </div>
                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    شهر
                                                                </label>
                                                                <select class="email s-email s-wid">
                                                                    <option>Bangladesh</option>
                                                                    <option>Albania</option>
                                                                    <option>Åland Islands</option>
                                                                    <option>Afghanistan</option>
                                                                    <option>Belgium</option>
                                                                </select>
                                                            </div>
                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    آدرس
                                                                </label>
                                                                <input type="text">
                                                            </div>
                                                            <div class="tax-select col-lg-6 col-md-6">
                                                                <label>
                                                                    کد پستی
                                                                </label>
                                                                <input type="text">
                                                            </div>

                                                            <div class=" col-lg-12 col-md-12">
                                                                <button class="cart-btn-2" type="submit"> ویرایش
                                                                    آدرس
                                                                </button>
                                                            </div>

                                                        </div>

                                                    </form>

                                                </div>

                                            </div>

                                            <hr>
                                            @endforeach

                                            <button class="collapse-address-create mt-3" type="submit"> ایجاد آدرس
                                                جدید </button>
                                            <div class="collapse-address-create-content">

                                                <form action="#">

                                                    <div class="row">

                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>
                                                                عنوان
                                                            </label>
                                                            <input type="text" required="" name="title">
                                                        </div>
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>
                                                                شماره تماس
                                                            </label>
                                                            <input type="text">
                                                        </div>
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>
                                                                استان
                                                            </label>
                                                            <select class="email s-email s-wid">
                                                                <option>Bangladesh</option>
                                                                <option>Albania</option>
                                                                <option>Åland Islands</option>
                                                                <option>Afghanistan</option>
                                                                <option>Belgium</option>
                                                            </select>
                                                        </div>
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>
                                                                شهر
                                                            </label>
                                                            <select class="email s-email s-wid">
                                                                <option>Bangladesh</option>
                                                                <option>Albania</option>
                                                                <option>Åland Islands</option>
                                                                <option>Afghanistan</option>
                                                                <option>Belgium</option>
                                                            </select>
                                                        </div>
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>
                                                                آدرس
                                                            </label>
                                                            <input type="text">
                                                        </div>
                                                        <div class="tax-select col-lg-6 col-md-6">
                                                            <label>
                                                                کد پستی
                                                            </label>
                                                            <input type="text">
                                                        </div>

                                                        <div class=" col-lg-12 col-md-12">

                                                            <button class="cart-btn-2" type="submit"> ثبت آدرس
                                                            </button>
                                                        </div>



                                                    </div>

                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="wishlist" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3> لیست علاقه مندی ها </h3>
                                            <form class="mt-3" action="#">
                                                <div class="table-content table-responsive cart-table-content">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th> تصویر محصول </th>
                                                                <th> نام محصول </th>
                                                                <th> حذف </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="product-thumbnail">
                                                                    <a href="#"><img
                                                                            src="assets/img/cart/cart-3.svg"
                                                                            alt=""></a>
                                                                </td>
                                                                <td class="product-name"><a href="#"> لورم ایپسوم
                                                                    </a>
                                                                </td>
                                                                <td class="product-name">
                                                                    <a href="#"> <i class="sli sli-trash"
                                                                            style="font-size: 20px"></i> </a>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="product-thumbnail">
                                                                    <a href="#"><img
                                                                            src="assets/img/cart/cart-4.svg"
                                                                            alt=""></a>
                                                                </td>
                                                                <td class="product-name"><a href="#"> لورم ایپسوم
                                                                        متن
                                                                    </a>
                                                                </td>
                                                                <td class="product-name">
                                                                    <a href="#"> <i class="sli sli-trash"
                                                                            style="font-size: 20px"></i> </a>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td class="product-thumbnail">
                                                                    <a href="#"><img
                                                                            src="assets/img/cart/cart-5.svg"
                                                                            alt=""></a>
                                                                </td>
                                                                <td class="product-name"><a href="#"> لورم ایپسوم
                                                                    </a>
                                                                </td>
                                                                <td class="product-name">
                                                                    <a href="#"> <i class="sli sli-trash"
                                                                            style="font-size: 20px"></i> </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="comments" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3> نظرات </h3>
                                            <div class="review-wrapper">

                                                @if ($comments->first())
                                                    @foreach ($comments as $comment)
                                                        <div class="single-review">
                                                            <div class="review-img">
                                                                <img src="assets/img/product-details/client-1.jpg"
                                                                    alt="">
                                                            </div>
                                                            <div class="review-content w-100 text-right">
                                                                <p class="text-right">
                                                                    {{ $comment->text }}
                                                                </p>
                                                                <div class="review-top-wrap">
                                                                    <div class="review-name d-flex align-items-center">
                                                                        <h4>
                                                                            برای محصول :
                                                                        </h4>
                                                                        <a class="mr-1"
                                                                            href="{{ route('home.product.details', [$comment->product->slug]) }}"
                                                                            style="color:#ff3535;">
                                                                            {{ $comment->product->name }} </a>
                                                                    </div>
                                                                    <div>
                                                                        در تاریخ :
                                                                        {{ verta($comment->created_at)->format('Y.m.d') }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="alert alert-danger">
                                                        <span>
                                                            نظری برای نمایش وجود ندارد
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div> <!-- Single Tab Content End -->

                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->


    @if ($orders->first() != null)
        @foreach ($orders as $key => $order)
            <!-- Modal Order -->
            <div class="modal fade" id="ordersDetiles-{{ $order->id }}" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12" style="direction: rtl;">
                                    <form action="#">
                                        <div class="table-content table-responsive cart-table-content">
                                            <table>
                                                <thead>
                                                    <tr>
                                                        <th> تصویر محصول </th>
                                                        <th> نام محصول </th>
                                                        <th> فی </th>
                                                        <th> تعداد </th>
                                                        <th> قیمت کل </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->orderItems as $orderItem)
                                                        <tr>
                                                            <td class="product-thumbnail">
                                                                <a href="{{route('home.product.details' , ['product' =>$orderItem->product->slug ])}}"><img
                                                                        style="width: 140px;height: 100px; object-fit: cover"
                                                                        src="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $orderItem->product->primary_image }}"
                                                                        alt=""></a>
                                                            </td>
                                                            <td class="product-name"><a href="{{route('home.product.details' , ['product' =>$orderItem->product->slug ])}}">
                                                                    {{ $orderItem->product->name }}</a>
                                                                    <div>
                                                                        {{ $orderItem->product->variations->first()->attribute->name    }}</a>
                                                                        :
                                                                        {{ $orderItem->product->variations->first()->value }}</a>
                                                                    </div>
                                                            </td>
                                                            <td class="product-price-cart"><span class="amount">
                                                                    {{ number_format($orderItem->price) }}
                                                                    تومان
                                                                </span></td>
                                                            <td class="product-quantity">
                                                                {{ $orderItem->quantity }}
                                                            </td>
                                                            <td class="product-subtotal">
                                                                {{ number_format($orderItem->subtotal) }}
                                                                تومان
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>


                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal end -->
        @endforeach
    @endif


@endsection
