 <!--Product Start-->
 <div class="ht-product ht-product-action-on-hover ht-product-category-right-bottom mb-30">
     <div class="ht-product-inner">
         <div class="ht-product-image-wrap">
             <a href="{{route('home.product.details' , $product->slug )}}" class="ht-product-image">
                 <img style="width: 254px; height: 254px; object-fit: cover"
                     src="{{ env('PRODUCT_IMAGES_UPLOAD_PATH') . $product->primary_image }}"
                     alt="Universal Product Style" />
             </a>
             <div class="ht-product-action">
                 <ul>
                     <li>
                         <a href="#" data-toggle="modal" data-target="#modal-{{ $product->id }}"><i
                                 class="sli sli-magnifier"></i><span class="ht-product-action-tooltip"> مشاهده سریع
                             </span></a>
                     </li>
                     <li>
                         <a href="#"><i class="sli sli-heart"></i><span class="ht-product-action-tooltip"> افزودن
                                 به
                                 علاقه مندی ها </span></a>
                     </li>
                     <li>
                         <a href="{{route('home.compare.add' , $product->id)}}"><i class="sli sli-refresh"></i><span class="ht-product-action-tooltip">
                                 مقایسه
                             </span></a>
                     </li>
                 </ul>
             </div>
         </div>
         <div class="ht-product-content">
             <div class="ht-product-content-inner">
                 <div class="ht-product-categories">
                     <a href="{{route('home.categories.show' , $product->category->slug  )}}">{{ $product->category->name }} - {{ $product->category->parent->name }} </a>
                 </div>
                 <h4 class="ht-product-title text-right">
                     <a href="{{route('home.product.details' , $product->slug )}}">{{ $product->name }}</a>
                 </h4>
                 <div class="ht-product-price">

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
                 <div class="ht-product-ratting-wrap">
                     <div data-rating-stars="5" data-rating-readonly="true" data-rating-value="{{ceil($product->rates->avg('rate'))}}"
                         data-rating-input="#dataReadonlyInput">
                     </div>
                 </div>
             </div>

         </div>
     </div>
 </div>
 <!--Product End-->
