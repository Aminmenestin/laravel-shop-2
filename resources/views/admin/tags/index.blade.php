@extends('admin.layouts.master')

@section('title')
    index tags
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست تگ ها ({{ $tags->total() }})</h5>
                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.tags.create') }}">
                    <i class="fa fa-plus"></i>
                    ایجاد تگ
                </a>
            </div>

           @if ( $tags->total() > 0  )
           <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $key => $tag)
                        <tr>
                            <th>
                                {{ $tags->firstItem() + $key }}
                            </th>
                            <th>
                                {{ $tag->name }}
                            </th>
                            <th>
                                <a class="btn btn-sm btn-outline-success"
                                    href="{{ route('admin.tags.show', ['tag' => $tag->id]) }}">نمایش</a>
                                <a class="btn btn-sm btn-outline-info mr-3"
                                    href="{{ route('admin.tags.edit', ['tag' => $tag->id]) }}">ویرایش</a>
                                <a class="btn btn-sm btn-outline-danger mr-3"
                                    href="{{ route('admin.tags.destroy', ['tag' => $tag->id]) }}" data-confirm-delete="true" >حذف</a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
           @else

           <div class="d-flex justify-content-center text-danger">
            تگی برای نمایش وجود ندارد!
            </div>

           @endif

            <div class="d-flex justify-content-center mt-5">
                {{ $tags->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </div>
@endsection
