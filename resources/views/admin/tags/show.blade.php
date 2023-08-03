@extends('admin.layouts.master')

@section('title')
    show tags
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">تگ : {{ $tag->name }}</h5>
            </div>
            <hr>

            <div class="row">
                <div class="form-group col-md-3">
                    <label>نام</label>
                    <input class="form-control" type="text" value="{{ $tag->name }}" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label>تاریخ ایجاد</label>
                    <input class="form-control" type="text" value="{{ verta($tag->created_at) }}" disabled>
                </div>

            </div>

            <a href="{{ url()->previous() }}" class="btn btn-dark mt-5">بازگشت</a>

        </div>

    </div>

@endsection
