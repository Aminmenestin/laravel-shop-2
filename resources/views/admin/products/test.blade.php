@extends('admin.layouts.master')

@section('title')
   - create products
@endsection

@section('script')
    {{-- <script type="module">
        $('#brandSelect').selectpicker({
            'title': 'انتخاب برند'
        });
        $('#tagSelect').selectpicker({
            'title': 'انتخاب تگ'
        });

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

        $('#categorySelect').selectpicker({
            'title': 'انتخاب دسته بندی'
        });

        $('#attributesContainer').hide();

        $('#categorySelect').on('changed.bs.select', function() {
            let categoryId = $(this).val();

            $.get(`{{ url('/admin-panel/category-attributes/${categoryId}') }}`, function(response,
                status) {
                    console.log(response)
                if (status == 'success') {
                    // console.log(response);

                    $('#attributesContainer').fadeIn();

                    // Empty Attribute Container
                    $('#attributes').find('div').remove();

                    // Create and Append Attributes Input
                    response.attributes.forEach(attribute => {
                        let attributeFormGroup = $('<div/>', {
                            class: 'form-group col-md-3'
                        });
                        attributeFormGroup.append($('<label/>', {
                            for: attribute.name,
                            text: attribute.name
                        }));

                        attributeFormGroup.append($('<input/>', {
                            type: 'text',
                            class: 'form-control',
                            id: attribute.name,
                            name: `attribute_ids[${attribute.id}]`
                        }));

                        $('#attributes').append(attributeFormGroup);

                    });

                    $('#variationName').text(response.variation.name);

                } else {
                    alert('مشکل در دریافت لیست ویژگی ها');
                }
            }).fail(function() {
                alert('مشکل در دریافت لیست ویژگی ها');
            })

            // console.log(categoryId);
        });

        $("#czContainer").czMore();

    </script> --}}


    <script type="module">

        $('#tagSelect').selectpicker({
            title : 'انتخاب تگ'
        })

        $('#categorySelect').selectpicker({
            title : 'انتخاب دسته بندی'
        })
        $('#brandSelect').selectpicker({
            title : 'انتخاب برند'
        })

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


        $('#attributesContainer').hide();

        var global = [];

        $('#categorySelect').change(function(){

            global = [];

            let categoryId = $(this).val();

            $.ajax(`/admin-panel/category-attributes/${categoryId}` , {

                type: "GET",
                success:function(response , status){


                    $('#attributesContainer').fadeIn();

                    $('#attributes').find('div').remove();

                    $.each(response.attributes , function (indexInArray, attribute) {

                         global.push(attribute.id);

                        let attributeFormGroup = $('<div/>', {
                            class: 'form-group col-md-3'
                        });
                        attributeFormGroup.append($('<label/>', {
                            for: attribute.name,
                            text: attribute.name
                        }));

                        attributeFormGroup.append($('<input/>', {
                            type: 'text',
                            class: 'form-control',
                            id: attribute.id,
                            // name: `attribute_ids[${attribute.id}]`
                        }));

                        $('#attributes').append(attributeFormGroup);
                    });

                    // console.log(response.variation[0].name);

                    $('#variationName').html(response.variation.name)


                },
                error:function(response , status){
                    console.log(response);
                },

            })
        })

        $("#czContainer").czMore();



        $('#form').submit(function(e){

            e.preventDefault();

            $.ajax("{{route('admin.products.store')}}"  , {
                type : 'POST',
                data:{ name: $('#name').val() , brand : $('brandSelect').val() , is_active : $('#is_active').val() , tags: $('#tagSelect').val()  , _token:"{{csrf_token()}}" },
                success : function(response ){
                    console.log(response);
                    $('#error').fadeOut();
                },
                error:function(response ){
                    console.log(response);
                    $('#inputErrorText').empty();
                    $('#error').addClass('alert alert-danger');
                    $('#error').fadeIn();
                    $.each(response.responseJSON.errors , function(key, val){

                        let li = $("<li/>" , {
                        text : val,
                        });

                        $('#inputErrorText').append(li);

                        });
                }
            })


        })



    </script>


@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ایجاد محصول</h5>
            </div>
            <hr>

            <div id="error">
                <span id="inputErrorText"></span>
           </div>

            <form id="form">

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="brand_id">برند</label>
                        <select id="brandSelect" class="form-control" data-live-search="true" >
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select class="form-control" id="is_active">
                            <option value="1" selected>فعال</option>
                            <option value="0">غیرفعال</option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="tag_ids">تگ</label>
                        <select id="tagSelect"  class="form-control" multiple data-live-search="true">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description"></textarea>
                    </div>

                    {{-- Product Image Section --}}
                    <div class="col-md-12">
                        <hr>
                        <p>تصاویر محصول : </p>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="primary_image"> انتخاب تصویر اصلی </label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="primary_image">
                            <label class="custom-file-label" for="primary_image"> انتخاب فایل </label>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="images"> انتخاب تصاویر </label>
                        <div class="custom-file">
                            <input type="file" multiple class="custom-file-input" id="images">
                            <label class="custom-file-label" for="images"> انتخاب فایل ها </label>
                        </div>
                    </div>

                    {{-- Category&Attributes Section --}}
                    <div class="col-md-12">
                        <hr>
                        <p>دسته بندی و ویژگی ها : </p>
                    </div>

                    <div class="col-md-12">
                        <div class="row justify-content-center">
                            <div class="form-group col-md-3">
                                <label for="category_id">دسته بندی</label>
                                <select id="categorySelect" class="form-control" data-live-search="true">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id}}">{{ $category->name }} -
                                            {{ $category->parent->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="attributesContainer" class="col-md-12">
                        <div id="attributes" class="row"></div>
                        <div class="col-md-12">
                            <hr>
                            <p>افزودن قیمت و موجودی برای متغیر <span class="font-weight-bold" id="variationName"></span> :
                            </p>
                        </div>

                        <div id="czContainer">
                            <div id="first">
                                <div class="recordset">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>نام</label>
                                            <input class="form-control" id="variation_name"  type="text">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>قیمت</label>
                                            <input class="form-control" id="variation_price"   type="text">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>تعداد</label>
                                            <input class="form-control" id="variation_quantiny"   type="text">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>شناسه انبار</label>
                                            <input class="form-control" id="variation_sku"   type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Delivery Section --}}
                    <div class="col-md-12">
                        <hr>
                        <p>هزینه ارسال : </p>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="delivery_amount">هزینه ارسال</label>
                        <input class="form-control" id="delivery_amount"  type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="delivery_amount_per_product">هزینه ارسال به ازای محصول اضافی</label>
                        <input class="form-control" id="delivery_amount_per_product" type="text">
                    </div>

                </div>

                <button class="btn btn-outline-primary mt-5">ثبت</button>
                <a href="{{ url()->previous() }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
