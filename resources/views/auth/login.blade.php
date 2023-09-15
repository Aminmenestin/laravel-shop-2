@extends('home.layouts.master')

@section('title')
    صفحه ای وزود
@endsection


@section('script')
    <script>
        $('#error').hide();
        $('#checkOtpForm').hide();
        $('#resent').hide();

        $('#loginForm').on('submit', function(e) {
            e.preventDefault();

            let cell_phone = $('#cellphoneInput').val();

            $.ajax({
                type: "POST",
                url: "{{ url('/login') }}",
                data: {
                    cell_phone: cell_phone,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    console.log(response)

                    Swal.fire({
                        icon: 'success',
                        text: 'رمز یک بار مصرف برای شما ارسال شد',
                        timer: 2000
                    })

                    $('#loginForm').fadeOut();
                    $('#error').hide();
                    $('#checkOtpForm').fadeIn();
                    $('#otpcode').html(response.otp);
                    timer();

                    login_token = response.login_token;

                },
                error: function(response) {

                    console.log(response)

                    $('#error').fadeIn();
                    $('#errorText').html(response.responseJSON.message);
                },
            });

        })

        function resentOTP() {
            let cell_phone = $('#cellphoneInput').val();

            $('#checkOtpInput').val('');
            $('#error').hide();

            $.ajax({
                type: "POST",
                url: "{{ url('/login') }}",
                data: {
                    cell_phone: cell_phone,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    Swal.fire({
                        icon: 'success',
                        text: 'رمز یک بار مصرف برای شما ارسال شد',
                        timer: 2000
                    })

                    $('#otpcode').html(response.otp);
                    $('#resent').hide();
                    timer();
                    $('#timer').fadeIn();

                    login_token = response.login_token;

                },
                error: function(response) {

                    $('#error').fadeIn();
                    $('#errorText').html('response.responseJSON.message');
                },
            });
        }


        $('#checkOtpForm').on('submit', function(e) {
            e.preventDefault();

            let otp = $('#checkOtpInput').val();

            $.ajax({
                type: "POST",
                url: "{{ url('/checkOTP') }}",
                data: {
                    otp: otp,
                    login_token: login_token,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {

                    Swal.fire({
                        icon: 'success',
                        text: 'با موفقیت وارد شدید',
                        timer: 2000
                    })

                    window.location = "{{ route('home.index') }}";

                },
                error: function(response) {

                    $('#error').fadeIn();
                    $('#errorText').html(response.responseJSON.message);
                },
            });
        })

        function timer() {
            var timeLimitInMinutes = 2;
            var timeLimitInSeconds = timeLimitInMinutes * 60;
            var timerElement = document.getElementById('timer');

            function startTimer() {
                timeLimitInSeconds--;
                var minutes = Math.floor(timeLimitInSeconds / 60);
                var seconds = timeLimitInSeconds % 60;

                if (timeLimitInSeconds < 0) {
                    clearInterval(timerInterval);
                    $('#resent').fadeIn();
                    $('#timer').hide();
                    timerElement.textContent = '00:00';
                }

                if (minutes < 10) {
                    minutes = '0' + minutes;
                }
                if (seconds < 10) {
                    seconds = '0' + seconds;
                }

                timerElement.textContent = minutes + ':' + seconds;
            }

            var timerInterval = setInterval(startTimer, 1000);
        }
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
                    <li class="active"> ورود </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="login-register-area pt-100 pb-100" style="direction: rtl;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a class="active" data-toggle="tab" href="#lg1">
                                <h4> ورود </h4>
                            </a>
                        </div>
                        <div class="tab-content">


                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <div id="error" style="text-align: right" class="alert alert-danger">
                                            <span id="errorText">
                                            </span>
                                        </div>
                                        <form id="loginForm">

                                            <input id="cellphoneInput" placeholder="شماره تلفن همراه" type="text">

                                            <div class="input-error-validation">
                                                <strong></strong>
                                            </div>

                                            <div class="button-box d-flex justify-content-between">
                                                <button type="submit">ارسال</button>
                                            </div>
                                        </form>
                                        <form id="checkOtpForm">

                                            <input id="checkOtpInput" placeholder="رمز یک بار مصرف" type="text">

                                            <div class="input-error-validation">
                                                <strong></strong>
                                            </div>

                                            <div class="button-box d-flex justify-content-between">
                                                <button style=" height: 54.33px; border-radius: 0.25rem;"
                                                    type="submit">ورود</button>
                                                <button id="resent" onclick="resentOTP()"
                                                    style=" height: 54.33px; border-radius: 0.25rem;" type="button">ارسال
                                                    مجدد</button>
                                                <div id="timer" style="padding: 13px 30px 14px; color: #000"
                                                    class="alert alert-info">

                                                </div>
                                            </div>
                                            <span class="ml-1" id="otpcode"></span>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
