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

                                    <a href="#profile" class="active" data-toggle="tab">
                                        <i class="sli sli-user ml-1"></i>
                                        پروفایل
                                    </a>

                                    <a href="#orders" data-toggle="tab">
                                        <i class="sli sli-basket ml-1"></i>
                                        سفارشات
                                    </a>

                                    <a href="#address" data-toggle="tab">
                                        <i class="sli sli-map ml-1"></i>
                                        آدرس ها
                                    </a>

                                    <a href="#wishlist" data-toggle="tab">
                                        <i class="sli sli-heart ml-1"></i>
                                        لیست علاقه مندی ها
                                    </a>

                                    <a href="#comments" data-toggle="tab">
                                        <i class="sli sli-bubble ml-1"></i>
                                        نظرات
                                    </a>

                                    <a href="login.html">
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
                                    <div class="tab-pane fade show active" id="profile" role="tabpanel">
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
                                                                <input type="text" name="first-name" id="first-name" value="{{auth()->user()->name}}" />
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
                                                        <input type="email" name="email" id="email" value="{{auth()->user()->email}}" />
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
                                    <div class="tab-pane fade" id="orders" role="tabpanel">
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
                                                            <th> عملیات </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td> 22 تیر 1399 </td>
                                                            <td>Pending</td>
                                                            <td>
                                                                30000
                                                                تومان
                                                            </td>
                                                            <td><a href="#" data-toggle="modal"
                                                                    data-target="#ordersDetiles" class="check-btn sqr-btn ">
                                                                    نمایش جزئیات </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td> 22 تیر 1399 </td>
                                                            <td>Approved</td>
                                                            <td>
                                                                50000
                                                                تومان
                                                            </td>
                                                            <td><a href="#" data-toggle="modal"
                                                                    data-target="#ordersDetiles" class="check-btn sqr-btn ">
                                                                    نمایش جزئیات </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td> 22 تیر 1399 </td>
                                                            <td>On Hold</td>
                                                            <td>
                                                                20000
                                                                تومان
                                                            </td>
                                                            <td><a href="#" data-toggle="modal"
                                                                    data-target="#ordersDetiles" class="check-btn sqr-btn ">
                                                                    نمایش جزئیات </a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="address" role="tabpanel">
                                        <div class="myaccount-content address-content">
                                            <h3> آدرس ها </h3>

                                            <div>
                                                <address>
                                                    <p>
                                                        <strong> علی شیخ </strong>
                                                        <span class="mr-2"> عنوان آدرس : <span> منزل </span> </span>
                                                    </p>
                                                    <p>
                                                        خ شهید فلان ، کوچه ۸ فلان ،فرعی فلان ، پلاک فلان
                                                        <br>
                                                        <span> استان : تهران </span>
                                                        <span> شهر : تهران </span>
                                                    </p>
                                                    <p>
                                                        کدپستی :
                                                        89561257
                                                    </p>
                                                    <p>
                                                        شماره موبایل :
                                                        89561257
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

                                            <div>
                                                <address>
                                                    <p>
                                                        <strong> علی شیخ </strong>
                                                        <span class="mr-2"> عنوان آدرس : <span> محل کار </span>
                                                        </span>
                                                    </p>
                                                    <p>
                                                        خ شهید فلان ، کوچه ۸ فلان ،فرعی فلان ، پلاک فلان
                                                        <br>
                                                        <span> استان : تهران </span>
                                                        <span> شهر : تهران </span>
                                                    </p>
                                                    <p>
                                                        کدپستی :
                                                        89561257
                                                    </p>
                                                    <p>
                                                        شماره موبایل :
                                                        89561257
                                                    </p>

                                                </address>
                                                <a href="#" class="check-btn sqr-btn ">
                                                    <i class="sli sli-pencil"></i>
                                                    ویرایش آدرس
                                                </a>
                                            </div>

                                            <hr>

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
@endsection
