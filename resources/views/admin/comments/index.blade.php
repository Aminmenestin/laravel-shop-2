@extends('admin.layouts.master')

@section('title')
    index comments
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="d-flex flex-column text-center flex-md-row justify-content-md-between mb-4">
                <h5 class="font-weight-bold mb-3 mb-md-0">لیست کامنت ها ({{ $comments->total() }})</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کاربر</th>
                            <th>نام محصول</th>
                            <th>متن کامنت</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $key => $comment)
                            <tr>
                                <th>
                                    {{ $comments->firstItem() + $key }}
                                </th>
                                <th>
                                    {{-- <a href="{{  }}"> --}}
                                    {{ $comment->user->name == null ? $comment->user->cellphone : $comment->user->name }}
                                    {{-- </a> --}}
                                </th>
                                <th>
                                    <a href="{{ route('admin.products.show', ['product' => $comment->product->id]) }}">
                                        {{ $comment->product->name }}
                                    </a>
                                </th>
                                <th>
                                    {{ Str::limit($comment->text  , 50)}}
                                </th>
                                <th class="{{ $comment->getRawOriginal('approved') ? 'text-success' : 'text-danger' }}">
                                    {{ $comment->approved }}
                                </th>
                                <th>
                                    <div class="dropdown">
                                        <button class="btn btn-outline-info dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-expanded="false">
                                            عملیات
                                        </button>
                                        <div class="dropdown-menu ">
                                            <a class="dropdown-item"
                                                href="{{ route('admin.comments.show', ['comment' => $comment->id]) }}">نمایش</a>
                                            <a class="dropdown-item" href="{{ route('admin.comments.approve', ['comment' => $comment->id]) }}"">تایید کامنت</a>
                                            <a class="dropdown-item" href="{{ route('admin.comments.delete', ['comment' => $comment->id]) }}"">حذف کامنت </a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $comments->render() }}
            </div>

        </div>

    </div>
@endsection
