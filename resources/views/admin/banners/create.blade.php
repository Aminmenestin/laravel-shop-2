@extends('admin.layouts.master')

@section('title')
    - create Banner
@endsection

@section('script')
    <script>
        // Show File Name
        $('#banner_image').change(function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
    </script>
@endsection
@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ایجاد بنر</h5>
            </div>
            <hr>
            @include('admin.commons.error')

            <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">

                    <div class="form-group col-md-3">
                        <label for="primary_image"> انتخاب تصویر </label>
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="banner_image">
                            <label class="custom-file-label" for="banner_image"> انتخاب فایل </label>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="title">عنوان</label>
                        <input class="form-control" id="title" name="title" type="text"
                            value="{{ old('title') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="description">متن</label>
                        <input class="form-control" id="description" name="description" type="text"
                            value="{{ old('description') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="priority">الویت</label>
                        <input class="form-control" id="priority" name="priority" type="number"
                            value="{{ old('priority') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1" selected>فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </div>


                    <div class="form-group col-md-3">
                        <label for="banner_position">نوع بنر</label>
                        <select class="form-control" id="banner_position" name="banner_position">
                          <option value="1">اسلایدر اصلی</option>
                          <option value="2">اسلایدر شماره 2</option>
                          <option value="3">اسلایدر شماره 3</option>
                          <option value="4">اسلایدر شماره 4</option>
                        </select>
                      </div>

                    <div class="form-group col-md-3">
                        <label for="button">متن دکمه</label>
                        <input class="form-control" id="button" name="button" type="text"
                            value="{{ old('button') }}">
                    </div>

                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ url()->previous() }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>
@endsection
