@foreach ($products as $product)
    <!-- Modal -->
    <div class="modal fade" id="modal-{{ $product->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7 col-sm-12 col-xs-12" style="direction: rtl;">
                            <div class="product-details-content quickview-content">
                                <h2 class="text-right mb-4">{{ $product->name }}</h2>
                                <div  class="product-details-price variationPriceDiv-{{$product->id}}">
                                    @if ($product->quantity_check == null)
                                        <div class="not-in-stock">
                                            <p>
                                                ناموجود
                                            </p>
                                        </div>
                                    @else
                                        @if ($product->isSaleCheck)
                                            <span class="new">
                                                {{ number_format($product->isSaleCheck->sale_price) }}
                                                تومان
                                            </span>
                                            <span class="old">
                                                {{ number_format($product->isSaleCheck->price) }}
                                                تومان
                                            </span>
                                        @else
                                            <span class="new">
                                                {{ number_format($product->priceCheck->price) }}
                                                تومان
                                            </span>
                                        @endif
                                    @endif
                                </div>
                                <div class="pro-details-rating-wrap">
                                    <div data-rating-stars="5" data-rating-readonly="true"
                                        data-rating-value="{{ ceil($product->rates->avg('rate')) }}"
                                        data-rating-input="#dataReadonlyInput">
                                    </div>
                                    <span class="mx-2">|</span>
                                    <span>3 دیدگاه</span>
                                </div>
                                <p class="text-right">
                                    {{ $product->description }}
                                </p>
                                <div class="pro-details-list text-right">
                                    <ul class="text-right">
                                        @foreach ($product->attributes()->with('attribute')->get() as $attributes)
                                            <li>
                                                {{ $attributes->attribute->name }}
                                                :
                                                {{ $attributes->value }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @if ($product->quantityCheck)
                                    @php
                                        if ($product->isSaleCheck) {
                                            $productVariationSelected = $product->isSaleCheck;
                                        } else {
                                            $productVariationSelected = $product->priceCheck;
                                        }
                                    @endphp

                                    <form action="{{route('home.cart.add')}}" method="POST">
                                        @csrf
                                        <div class="pro-details-size-color text-right">
                                            <div class="pro-details-size w-50">
                                                <span>{{ App\Models\Attribute::find($product->variations->first()->attribute_id)->name }}</span>
                                                <select name="variation" class="form-control variationSelect" id="variationSelect">
                                                    @foreach ($product->variations()->where('quantity', '>', 0)->get() as $variation)
                                                        <option
                                                            value="{{ json_encode($variation->only(['id' ,'product_id', 'quantity', 'sale_price', 'price', 'is_sale'])) }}"
                                                            {{ $productVariationSelected->id == $variation->id ? 'selected' : '' }}>
                                                            {{ $variation->value }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="productId" value="{{$product->id}}">

                                            </div>
                                        </div>

                                        <div class="pro-details-quality">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box quantityInput" type="text"
                                                    name="qtybutton" value="1"
                                                    data-max="{{ $productVariationSelected->quantity }}" />
                                            </div>
                                            <div class="pro-details-cart">
                                                <button>افزودن به سبد خرید</button>
                                            </div>
                                            <div class="pro-details-wishlist">
                                                <a title="Add To Wishlist" href="#"><i
                                                        class="sli sli-heart"></i></a>
                                            </div>
                                            <div class="pro-details-compare">
                                                <a title="Add To Compare"
                                                    href="{{ route('home.compare.add', $product->id) }}"><i
                                                        class="sli sli-refresh"></i></a>
                                            </div>
                                        </div>
                                    </form>
                                @endif

                                @if (!$product->quantityCheck)
                                    <div class="pro-details-quality">
                                        <div class="pro-details-wishlist">
                                            <a title="Add To Wishlist" href="#"><i class="sli sli-heart"></i></a>
                                        </div>
                                        <div class="pro-details-compare">
                                            <a title="Add To Compare" href="#"><i class="sli sli-refresh"></i></a>
                                        </div>
                                    </div>
                                @endif

                                <div class="pro-details-meta">
                                    <span>دسته بندی :</span>
                                    <ul>
                                        <li><a href="#">{{ $product->category->parent->name }}</a></li>
                                        <span>,</span>
                                        <li><a href="#">{{ $product->category->name }}</a></li>
                                    </ul>
                                </div>
                                <div class="pro-details-meta">
                                    <span>تگ ها :</span>
                                    <ul>
                                        @foreach ($product->tags as $tag)
                                            <li><a href="#">{{ $tag->name }} {{ $loop->last ? '' : ',' }}
                                                </a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="tab-content quickview-big-img">
                                <div id="pro-primary-{{ $product->id }}" class="tab-pane fade show active">
                                    <img src="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image }}"
                                        alt="" />
                                </div>

                                @foreach ($product->images as $image)
                                    <div id="pro-{{ $image->id }}" class="tab-pane fade show">
                                        <img src="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image }}"
                                            alt="" />
                                    </div>
                                @endforeach
                            </div>

                            <!-- Thumbnail Large Image End -->
                            <!-- Thumbnail Image End -->
                            <div class="quickview-wrap mt-15">
                                <div class="quickview-slide-active owl-carousel nav nav-style-2" role="tablist">
                                    <a class="active" data-toggle="tab" href="#pro-primary-{{ $product->id }}"><img
                                            src="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image }}"
                                            alt="" /></a>
                                    @foreach ($product->images as $image)
                                        <a data-toggle="tab" href="#pro-{{ $image->id }}"><img
                                                src="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $image->image }}"
                                                alt="" /></a>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->
@endforeach
