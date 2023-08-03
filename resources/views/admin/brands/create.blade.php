@extends('admin.layouts.master')


@section('title', '- create brand')


@section('script')

    <script type="module">

    $('#brandForm').submit(function(e){

         e.preventDefault();

         $.ajax("{{route('admin.brands.store')}}" , {
            type: 'POST',
            data: {name : $('#nameInput').val() , is_active : $('#is_active').val() , _token : "{{ csrf_token() }}"} ,
            success: function(response , status){
                $('#inputError').fadeOut();
                $('#nameInput').val('');
                $('#is_active').val(1);

                Swal.fire({
                    title: 'عالی',
                    icon: 'success',
                    text: 'برند شما با موفقیت ایجاد شد',
                    timer: 2000
                })
            },
            error: function(response){
                $('#inputError').addClass('alert alert-danger');
                $('#inputError').fadeIn();
                $('#inputErrorText').html(response.responseJSON.message);
            }
         })


    })


</script>

@endsection


@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد برند</h5>
            </div>
            <hr>

            @error('name')
                @include('admin.commons.error')
            @enderror

            <div id="inputError">
                <span id="inputErrorText"></span>
            </div>

            <form id="brandForm">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input id="nameInput" class="form-control" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select id="is_active" class="form-control">
                            <option value="1" selected>فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </div>
                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{url()->previous()}}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>
@endsection
