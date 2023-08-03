@extends('admin.layouts.master')

@section('title')
    - index banner
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست بنر ها ({{ $banners->total() }})</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.banner.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد بنر
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>متن</th>
                            <th>نوع بنر</th>
                            <th>الویت</th>
                            <th>وضعیت</th>
                            <th>دکمه</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $key => $banner)
                            <tr>
                                <th>
                                    {{ $banners->firstItem() + $key }}
                                </th>
                                <th>
                                    <a target="_blank" href="{{ url(env('BANNER_UPLOAD_PATH') . $banner->image) }}">
                                        <img style="width: 100px ; height: 100px; object-fit: cover"
                                            src="{{ url(env('BANNER_UPLOAD_PATH') . $banner->image) }}" alt="">
                                    </a>
                                </th>
                                <th>
                                    {{ $banner->title }}
                                </th>
                                <th>
                                    {{ $banner->description }}
                                </th>
                                <th>
                                    @switch($banner->banner_position)
                                        @case(1)
                                            اسلایدر اصلی
                                        @break

                                        @case(2)
                                            اسلایدر شماره 2
                                        @break

                                        @case(3)
                                            اسلایدر شماره 3
                                        @break

                                        @case(4)
                                            اسلایدر شماره 4
                                        @break
                                        @default
                                    @endswitch
                                </th>
                                <th>
                                    {{ $banner->priority }}
                                </th>
                                <th>
                                    <span
                                        class="{{ $banner->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                        {{ $banner->is_active }}
                                    </span>
                                </th>
                                <th>
                                    {{ $banner->button }}
                                </th>
                                <th>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="btn btn-sm btn-outline-info "
                                            href="{{ route('admin.banner.edit', ['banner' => $banner->id]) }}">ویرایش</a>

                                        <a class="btn btn-sm btn-outline-danger mr-3"
                                            href="{{ route('admin.banner.destroy', ['banner' => $banner->id]) }}"
                                            data-confirm-delete="true"> حذف</a>

                                    </div>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $banners->render() }}
            </div>
        </div>
    </div>
@endsection
