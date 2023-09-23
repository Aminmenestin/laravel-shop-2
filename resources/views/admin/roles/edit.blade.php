@extends('admin.layouts.master')

@section('title')
    edit roles
@endsection

@section('script')
    <script type="module">
        $('#select-all').click(function(e) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });
    </script>
@endsection

@section('content')

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش نقش {{ $role->name }}</h5>
            </div>
            <hr>

            @include('admin.commons.error')

            <form action="{{ route('admin.roles.update', ['role' => $role->id]) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="name">نام نمایشی</label>
                        <input class="form-control" name="display_name" type="text" value="{{ $role->display_name }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" name="name" type="text" value="{{ $role->name }}">
                    </div>

                    <div class="accordion col-md-12 mt-3 " id="accordionPermission">
                        <div class="card">
                            <div class="card-header p-1 d-flex align-items-center" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-right" type="button" data-toggle="collapse"
                                        data-target="#collapsePermission" aria-expanded="true" aria-controls="collapseOne">
                                        مجوز های دسترسی
                                    </button>
                                </h2>
                                <input style="margin-right: 155px" type="checkbox" id="select-all" class="form-check-input" />
                                <label style="padding-right: 20px;padding-top: 5px " class="form-check-label mr-3"
                                for="select-all">انتخاب همه</label>
                            </div>

                            <div id="collapsePermission" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionPermission">
                                <div class="card-body row">
                                    @foreach ($permissions as $permission)
                                        <div class="form-group form-check col-md-3">
                                            <input type="checkbox" class="form-check-input"
                                                id="permission_{{ $permission->id }}" name="{{ $permission->name }}"
                                                value="{{ $permission->name }}"
                                                {{ in_array( $permission->id , $role->permissions->pluck('id')->toArray() ) ? 'checked' : '' }}
                                                >
                                            <label style="padding-right: 10px;padding-top: 3px" class="form-check-label mr-3"
                                                for="permission_{{ $permission->id }}">{{ $permission->display_name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>

@endsection
