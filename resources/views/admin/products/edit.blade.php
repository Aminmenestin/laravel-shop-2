@extends('admin.layouts.master')

@section('title')
    - edit products
@endsection

@section('script')
    <script type="module">
        $('#brandSelect').selectpicker({
            'title': 'انتخاب برند'
        });
        $('#tagSelect').selectpicker({
            'title': 'انتخاب تگ'
        });

        let variations = @json($productVariations);

        variations.forEach(variation => {

            const dtp1Instance = new mds.MdsPersianDateTimePicker(document.getElementById(`variationDateOnSaleFrom-${variation.id}`), {
                targetTextSelector: `[data-name="variationInputDateOnSaleFrom-${variation.id}"]`,
                // targetDateSelector: `[data-name="variationInputDateOnSaleFrom-${variation.id}"]`,
                enableTimePicker: true,
                textFormat: 'yyyy-MM-dd HH:mm:ss',
            });
            const dtp1Instance2 = new mds.MdsPersianDateTimePicker(document.getElementById(`variationDateOnSaleTo-${variation.id}`), {
                targetTextSelector: `[data-name="variationInputDateOnSaleTo-${variation.id}"]`,
                // targetDateSelector: `[data-name="variationInputDateOnSaleFrom-${variation.id}"]`,
                enableTimePicker: true,
                textFormat: 'yyyy-MM-dd HH:mm:ss',
            });


            // $(`#variationDateOnSaleFrom-${variation.id}`).MdPersianDateTimePicker({
            //     targetTextSelector: `#variationInputDateOnSaleFrom-${variation.id}`,
            //     englishNumber: true,
            //     enableTimePicker: true,
            //     textFormat: 'yyyy-MM-dd HH:mm:ss',
            // });

            // $(`#variationDateOnSaleTo-${variation.id}`).MdPersianDateTimePicker({
            //     targetTextSelector: `#variationInputDateOnSaleTo-${variation.id}`,
            //     englishNumber: true,
            //     enableTimePicker: true,
            //     textFormat: 'yyyy-MM-dd HH:mm:ss',
            // });
        });
    </script>
@endsection


@section('content')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-12 col-md-12 mb-4 p-4 bg-white">
            <div class="mb-4 text-center text-md-right">
                <h5 class="font-weight-bold">ویرایش محصول</h5>
            </div>
            <hr>

            @include('admin.commons.error')

            <form action="{{ route('admin.products.update', ['product' => $product]) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-row">

                    <div class="form-group col-md-3">
                        <label for="name">نام</label>
                        <input class="form-control" id="name" name="name" type="text"
                            value="{{ $product->name }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="brand_id">برند</label>
                        <select id="brandSelect" name="brand_id" class="form-control" data-live-search="true">
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="is_active">وضعیت</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="1" {{ $product->getRawOriginal('is_active') == 1 ? 'selected' : '' }}>فعال
                            </option>
                            <option value="0" {{ $product->getRawOriginal('is_active') == 0 ? 'selected' : '' }}>
                                غیرفعال</option>
                        </select>
                    </div>

                    @php
                        $allProductTag = [];
                        foreach ($product->tags as $productTag) {
                            array_push($allProductTag, $productTag->id);
                        }
                    @endphp

                    <div class="form-group col-md-3">
                        <label for="tag_ids">تگ</label>
                        <select id="tagSelect" name="tag_ids" class="form-control" multiple data-live-search="true">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{ in_array($tag->id, $allProductTag) ? 'selected' : '' }}>{{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="description">توضیحات</label>
                        <textarea class="form-control" id="description" name="description" rows="4">{{ $product->description }}</textarea>
                    </div>

                    {{-- Delivery Section --}}
                    <div class="col-md-12">
                        <hr>
                        <p>هزینه ارسال : </p>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="delivery_amount">هزینه ارسال</label>
                        <input class="form-control" id="delivery_amount" name="delivery_amount" type="text"
                            value="{{ $product->delivery_amount }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="delivery_amount_per_product">هزینه ارسال به ازای محصول اضافی</label>
                        <input class="form-control" id="delivery_amount_per_product" name="delivery_amount_per_product"
                            type="text" value="{{ $product->delivery_amount_per_product }}">
                    </div>

                    {{-- Attributes & Variations --}}
                    <div class="col-md-12">
                        <hr>
                        <p>ویژگی ها : </p>
                    </div>

                    @foreach ($productAttributes as $productAttribut)
                        <div class="form-group col-md-3">
                            <label>{{ $productAttribut->attribute->name }}</label>
                            <input class="form-control" type="text"
                                name="attribute_values[{{ $productAttribut->id }}][]"
                                value="{{ $productAttribut->value }}">
                        </div>
                    @endforeach


                    @foreach ($productVariations as $variation)
                        <div class="col-md-12">
                            <hr>
                            <div class="d-flex">
                                <p class="mb-0"> قیمت و موجودی برای متغیر ( {{ $variation->value }} ) :
                                </p>
                                <p class="mb-0 mr-3">
                                    <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse"
                                        data-target="#collapse-{{ $variation->id }}">
                                        نمایش
                                    </button>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="collapse mt-2" id="collapse-{{ $variation->id }}">
                                <div class="card card-body">
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label> قیمت </label>
                                            <input type="text" class="form-control"
                                                name="variation_values[{{ $variation->id }}][price]"
                                                value="{{ $variation->price }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label> تعداد </label>
                                            <input type="text" class="form-control"
                                                name="variation_values[{{ $variation->id }}][quantity]"
                                                value="{{ $variation->quantity }}">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label> sku </label>
                                            <input type="text" class="form-control"
                                                name="variation_values[{{ $variation->id }}][sku]"
                                                value="{{ $variation->sku }}">
                                        </div>

                                        {{-- Sale Section --}}
                                        <div class="col-md-12">
                                            <p> حراج : </p>
                                        </div>

                                        <div style="margin-top: 8px" class="form-group col-md-3">
                                            <label class="mt-1"> قیمت حراجی </label>
                                            <input type="text" name="variation_values[{{ $variation->id }}][sale_price]"
                                                value="{{ $variation->sale_price }}" class="form-control">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class="d-flex align-items-center"> تاریخ شروع حراجی :
                                                <span class="input-group-text mr-1">
                                                    {{ $variation->date_on_sale_from == null ? null : verta($variation->date_on_sale_from) }}
                                                </span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend order-2">
                                                    <span class="input-group-text"
                                                        id="variationDateOnSaleFrom-{{ $variation->id }}">
                                                        <i class="fas fa-clock"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" data-name="variationInputDateOnSaleFrom-{{ $variation->id }}"
                                                    id="variationInputDateOnSaleFrom-{{ $variation->id }}"
                                                    name="variation_values[{{ $variation->id }}][date_on_sale_from]"
                                                    >
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class="d-flex align-items-center"> تاریخ پایان حراجی :
                                                <span class="input-group-text mr-1">
                                                    {{ $variation->date_on_sale_to == null ? null : verta($variation->date_on_sale_to) }}
                                                </span>
                                            </label>

                                            <div class="input-group">
                                                <div class="input-group-prepend order-2">
                                                    <span class="input-group-text"
                                                        id="variationDateOnSaleTo-{{ $variation->id }}">
                                                        <i class="fas fa-clock"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control" data-name="variationInputDateOnSaleTo-{{ $variation->id }}"
                                                    id="variationInputDateOnSaleTo-{{ $variation->id }}"
                                                    name="variation_values[{{ $variation->id }}][date_on_sale_to]"
                                                    >
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>

                <button class="btn btn-outline-primary mt-5" type="submit">ویرایش</button>
                <a href="{{ url()->previous() }}" class="btn btn-dark mt-5 mr-3">بازگشت</a>
            </form>
        </div>

    </div>
@endsection
