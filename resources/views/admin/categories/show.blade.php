@extends('admin.layouts.master')

@section('title')
   - show attributes
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-md-5 bg-white">
            <div class="mb-4">
                <h5 class="font-weight-bold">دسته بندی : {{ $category->name }}</h5>
            </div>
            <hr>

            <div class="row">
                <div class="form-group col-md-3">
                    <label>نام</label>
                    <input class="form-control" type="text" value="{{ $category->name }}" disabled>
                </div>

                <div class="form-group col-md-3">
                    <label>نام انگلیسی</label>
                    <input class="form-control" type="text" value="{{ $category->slug }}" disabled>
                </div>

                <div class="form-group col-md-3">
                    <label>والد</label>
                        <input class="form-control" type="text" value="{{$category->parent->name}}" disabled>
                </div>

                <div class="form-group col-md-3">
                    <label>وضعیت</label>
                    <input class="form-control" type="text" value="{{ $category->is_active }}" disabled>
                </div>

                <div class="form-group col-md-3">
                    <label>آیکون</label>
                    <input class="form-control" type="text" value="{{ $category->icon }}" disabled>
                </div>

                <div class="form-group col-md-3">
                    <label>تاریخ ایجاد</label>
                    <input class="form-control" type="text" value="{{ verta($category->created_at) }}" disabled>
                </div>

                <div class="form-group col-md-12">
                    <label>توضیحات</label>
                    <textarea class="form-control" disabled>{{ $category->description }}</textarea>
                </div>

                <div class="col-md-12">
                    <hr>

                    <div class="row">

                        <div class="col-md-3">
                            <label>ویژگی ها</label>
                            <div class="form-control div-disabled">
                               @foreach ($category->attributes as  $attribute)
                                    {{$attribute->name}} {{$loop->last ? '' : ','}}
                               @endforeach
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>ویژگی های قابل فیلتر</label>
                            <div class="form-control div-disabled">
                                @foreach ($category->attributes()->where('is_filter' , 1)->get() as  $attribute)
                                {{$attribute->name}} {{$loop->last ? '' : ','}}
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label>ویژگی متغیر</label>
                            <div class="form-control div-disabled">
                                {{$category->attributes()->where('is_variation' , 1)->get()->first()->name}}
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <a href="{{ url()->previous() }}" class="btn btn-dark mt-5">بازگشت</a>

        </div>

    </div>

@endsection
