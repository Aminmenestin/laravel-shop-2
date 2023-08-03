@extends('admin.layouts.master')

@section('title')
   - create attributes
@endsection


@section('script')


<script type="module">

    $('#form').submit(function(e){

        e.preventDefault();

    $.ajax("{{route('admin.attributes.store')}}" , {
        type: 'POST',
        data:{name : $('#name').val() , _token:"{{csrf_token()}}" },
        success:function(response){
            $('#error').fadeOut();
            $('#name').val('');
            $('#name').removeClass('border border-danger');
            console.log(response)
            Swal.fire({
                    title: 'عالی',
                    icon: 'success',
                    text: 'ویژگی شما با موفقیت ایجاد شد',
                    timer: 2000
                })
        },
        error: function (response) {
            console.log(response)
            $('#error').addClass('alert alert-danger');
            $('#name').addClass('border border-danger');
            $('#error').fadeIn();
            $('#errorText').html(response.responseJSON.message);
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
                <h5 class="font-weight-bold">ایجاد ویژگی</h5>
            </div>
            <hr>

           <div id="error">
                <span id="errorText"></span>
           </div>

            <form id="form">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name"  type="text">
                    </div>
                </div>

                <button class="btn btn-outline-primary mt-3">ثبت</button>
                <a href="{{ url()->previous() }}" class="btn btn-dark mt-3 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
