@extends('admin.layouts.master')

@section('title')
    - create categories
@endsection

@section('script')
    <script type="module">
        $('#attribute_ids').selectpicker({
            'title': 'انتخاب ویژگی'
        });

        $('#attributeIsFilterSelect').selectpicker({
            'title': 'انتخاب ویژگی'
        });

        $('#variationSelect').selectpicker({
            'title': 'انتخاب متغییر'
        });


        $('#attribute_ids').change(function(){

            let selectedAttributes = $(this).val();
            let attributes = @json($attributes);

            let attributeForFilter = [];

            attributes.map((attribute) => {
                $.each(selectedAttributes , function(i,element){
                    if( attribute.id == element ){
                        attributeForFilter.push(attribute);
                    }
                });
            });

            $("#attributeIsFilterSelect").find("option").remove();
            $("#variationSelect").find("option").remove();
            attributeForFilter.forEach((element)=>{
                let attributeFilterOption = $("<option/>" , {
                    value : element.id,
                    text : element.name,
                });

                let variationOption = $("<option/>" , {
                    value : element.id,
                    text : element.name
                });

                $("#attributeIsFilterSelect").append(attributeFilterOption);
                $("#attributeIsFilterSelect").selectpicker('refresh');

                $("#variationSelect").append(variationOption);
                $("#variationSelect").selectpicker('refresh');
            });


        });





        $('#form').submit(function(e){

            e.preventDefault();

            $.ajax("{{route('admin.categories.store')}}" , {
            type: 'POST',
            data:{name : $('#name').val() , parent_id: $('#parent_id').val() , is_active:$('#is_active').val() , icon:$('#icon').val() , description:$('#description').val()  , slug :$('#slug').val()  , attribute_ids:$('#attribute_ids').val() , attribute_is_filter_ids: $('#attributeIsFilterSelect').val() , variation_id:$('#variationSelect').val() , _token:"{{csrf_token()}}" },
            success:function(response){

                $('#inputErrorText').empty();
                $('#inputError').fadeOut();

                $('#name').val('');
                $('#slug').val('');
                $('#icon').val('');
                $('#description').val('');


                $.ajax('{{route("admin.updateParentCategory")}}' , {
                    type: 'GET',
                    success:function(response){

                        $('#parent_id').empty();

                        let withoutParent = $("<option/>" , {
                                text : 'بدون والد ',
                                value : 0,
                                });

                        $('#parent_id').append(withoutParent);

                        $.each(response , function(key , val){
                            let option = $("<option/>" , {
                                text : val.name,
                                value : val.id,
                                });


                            $('#parent_id').append(option)
                        })
                    },
                    error:function(response){
                        console.log(response)
                    }
                })


                $('#attribute_ids').selectpicker('deselectAll');
                $('#attributeIsFilterSelect').selectpicker('deselectAll');
                $('#variationSelect').selectpicker('deselectAll');

                $('#attribute_ids').selectpicker('render');
                $('#attributeIsFilterSelect').selectpicker('render');
                $('#variationSelect').selectpicker('render');

                $('#attribute_ids').selectpicker('refresh');
                $('#attributeIsFilterSelect').selectpicker('refresh');
                $('#variationSelect').selectpicker('refresh');


                $('#name').removeClass('border border-danger');
                console.log(response)
                Swal.fire({
                        title: 'عالی',
                        icon: 'success',
                        text: 'دسته بندی شما با موفقیت ایجاد شد',
                        timer: 2000
                    })
            },
            error: function (response) {

                $('#inputError').addClass('alert alert-danger');
                $('#inputError').fadeIn();

                $('#inputErrorText').empty();


                if(response.responseJSON.errors == undefined ){
                    let li = $("<li/>" , {
                    text : response.responseJSON.message,
                    });

                    $('#inputErrorText').append(li);
                }
                else{

                    $.each(response.responseJSON.errors , function(key, val){

                    let li = $("<li/>" , {
                    text : val,
                    });

                    $('#inputErrorText').append(li);

                    });

                }

            }
            });

            });


    </script>
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">ایجاد دسته بندی</h5>
            </div>
            <hr>

            <div id="inputError">
                <ul class="list-group" id="inputErrorText">

                </ul>
            </div>

            <form id="form">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="slug">نام انگلیسی</label>
                        <input class="form-control" id="slug" type="text">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="parent_id">والد</label>
                        <select class="form-control" id="parent_id">
                            <option value="0">بدون والد</option>
                            @foreach ($parentCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
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

                    <div class="form-group col-md-3 ">
                        <label for="attribute_ids">ویژگی</label>
                        <select id="attribute_ids" class="form-control" multiple data-live-search="true">
                            @foreach ($attributes as $attribute)
                                <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                            @endforeach
                        </select>

                    </div>

                    <div class="form-group col-md-3">
                        <label for="attribute_is_filter_ids">انتخاب ویژگی های قابل فیلتر</label>
                        <select id="attributeIsFilterSelect" class="form-control" multiple data-live-search="true">
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="attribute_is_filter_ids">انتخاب ویژگی متغیر</label>
                        <select id="variationSelect" class="form-control" data-live-search="true">
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="icon">آیکون</label>
                        <input class="form-control" id="icon" type="text">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description"></textarea>
                    </div>

                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ثبت</button>
                <a href="{{ url()->previous() }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>
@endsection
