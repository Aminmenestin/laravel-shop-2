@extends('admin.layouts.master')

@section('title')
  - edit {{ $brand->name }}
@endsection


@section('script')
    <script type="module">

    $('#brandForm').submit(function(e){
        e.preventDefault();

    $.ajax("/admin-panel/brands/" + $('#nameInput').attr('data-id') , {
        type: 'PUT',
        data:{ name: $('#nameInput').val() , is_active:$('#is_active').val() , _token : "{{csrf_token()}}" },
        success: function(response , status){
            document.title = "{{env('APP_Name')}}" + ' - edit ' + $('#nameInput').val();
            $('#inputError').fadeOut();
                Swal.fire({
                    title: 'عالی',
                    icon: 'success',
                    text: 'برند شما با موفقیت ایجاد شد',
                    timer: 2000
                    })
        },
        error:function(response){
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
                <h5 class="font-weight-bold">ویرایش برند {{ $brand->name }}</h5>
            </div>
            <hr>

            <div id="inputError">
                <span id="inputErrorText"></span>
            </div>

            <form id="brandForm">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input id="nameInput" class="form-control" type="text" value="{{ $brand->name }}"
                            data-id="{{ $brand->id }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select id="is_active" class="form-control">
                            <option value="1" {{ $brand->getRawOriginal('is_active') == 1 ? 'selected' : '' }}>فعال
                            </option>
                            <option value="0" {{ $brand->getRawOriginal('is_active') == 0 ? 'selected' : '' }}>غیرفعال
                            </option>
                        </select>
                    </div>
                </div>

                <button class="btn btn-outline-success mt-5" type="submit">ویرایش</button>
                <a href="{{url()->previous()}}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>
@endsection
