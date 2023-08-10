@extends('admin.layouts.master')

@section('title')
    edit products Images
@endsection

{{-- @section('script')
    <script>
        // Show File Name
        $('#primary_image').change(function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

        $('#images').change(function() {
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

    </script>
@endsection --}}

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-5 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش تصاویر محصول : {{ $product->name }}</h5>
            </div>
            <hr>

            @include('admin.commons.error')

            {{-- Show Primary Image --}}
            <div class="row">
                <div class="col-12 col-md-12 mb-5">
                    <h5>تصویر اصلی : </h5>
                </div>
                <div class="col-12 col-md-3 mb-5">
                    <div class="card">
                        {{-- {{dd(url(env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image))}} --}}
                        <img class="card-img-top"
                            src="{{ asset('home/img/banner/banner-1.png') }}"
                            alt="">
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-12 col-md-12 mb-5">
                    <h5>تصاویر : </h5>
                </div>

                    <div class="col-md-3">
                        <div class="card">
                            <img style="width: 500px ; height: 500px ; object-fit: cover" class="card-img-top" src="{{ asset('home/img/banner/banner-1.png') }}"
                                alt="">
                            <div class="card-body text-center">
                                {{-- <form action="{{ route('admin.products.images.destroy', ['product' => $product->id]) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger btn-sm mb-3" type="submit">حذف</button>
                                    <input type="hidden" name="image_id" value="{{ $image->id }}">
                                </form> --}}


                                <a class="btn btn-danger btn-sm mb-3" href="" data-confirm-delete="true"> حذف</a>

                                <form action=""
                                    method="post">

                                    <input type="hidden" name="image_id" value="">
                                    <button class="btn btn-primary btn-sm mb-3" type="submit">انتخاب به عنوان تصویر
                                        اصلی</button>
                                </form>
                            </div>
                        </div>
                    </div>

            </div>

            <hr>



            <form action="" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="primary_image"> انتخاب تصویر اصلی </label>
                        <div class="custom-file">
                            <input type="file" name="primary_image" class="custom-file-input" id="primary_image">
                            <label class="custom-file-label" for="primary_image"> انتخاب فایل </label>
                        </div>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="images"> انتخاب تصاویر </label>
                        <div class="custom-file">
                            <input type="file" name="images[]" multiple class="custom-file-input" id="images">
                            <label class="custom-file-label" for="images"> انتخاب فایل ها </label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
                <a href="{{ url()->previous() }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
