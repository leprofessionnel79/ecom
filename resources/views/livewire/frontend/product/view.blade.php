<div>
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if ($product->productImages)
                        {{-- <img src="{{asset($product->productImages[0]->image)}}" class="w-100" alt="Img"> --}}
                        <div class="exzoom" id="exzoom">
                            <div class="exzoom_img_box">
                              <ul class='exzoom_img_ul'>
                                @foreach ($product->productImages as $itemImg)
                                <li><img src="{{asset($itemImg->image)}}"/></li>
                                @endforeach
                              </ul>
                            </div>
                            <div class="exzoom_nav"></div>
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                          </div>
                        @else
                           {{__('customlang.noImageAdded')}}
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{$product->name}}

                        </h4>
                        <hr>
                        <p class="product-path">
                           <a href="{{url('/')}}" style="text-decoration: none">{{__('customlang.homePage')}} </a> /<a href="{{url('/collections/'.$product->category->name)}}" style="text-decoration: none">{{$product->category->name}}</a> /{{$product->name}}
                        </p>
                        <p class="product-path">
                            {{__('customlang.brand')}} : {{$product->brand}}
                        </p>
                        <div>
                            <span class="selling-price">{{$appSetting->currency}} {{$product->selling_price}}</span>
                            <span class="original-price">{{$appSetting->currency}} {{$product->original_price}}</span>
                        </div>
                        <div>
                            @if ($product->productColors->count()>0)
                                    @if ($product->productColors)
                                    @foreach ($product->productColors as $colorItem)
                                        {{-- <input type="radio" name="colorSelection" value="{{$colorItem->id}}" /> {{$colorItem->color->name}} --}}
                                        <label class="colorSelectionLable" style="background-color:{{$colorItem->color->code}}"
                                             wire:click="colorSelected({{$colorItem->id}})"
                                            >
                                            {{$colorItem->color->name}}
                                        </label>
                                    @endforeach
                                    @endif

                                    <div>
                                        @if ($this->productColorSelectedQuantity=='OutOfStock')
                                        <label class="btn-sm py-1 mt-2 text-white bg-danger">{{__('customlang.outOfStock')}}</label>
                                        @elseif ($this->productColorSelectedQuantity >0)
                                        <label class="btn-sm py-1 mt-2 text-white bg-success">{{__('customlang.inStock')}}</label>
                                        @endif
                                    </div>
                            @else
                               @if ($product->quantity)
                               <label class="btn-sm py-1 mt-2 text-white bg-success">{{__('customlang.inStock')}}</label>
                               @else
                               <label class="btn-sm py-1 mt-2 text-white bg-danger">{{__('customlang.outOfStock')}}</label>
                               @endif
                            @endif
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{$this->quantityCount}}" readonly class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{$product->id}})" class="btn btn1">
                                <span wire:loading.remove wire:target="addToCart({{$product->id}})">
                                    <i class="fa fa-shopping-cart">
                                    </i> {{__('customlang.addToCart')}}
                                </span>
                                <span wire:loading wire:target="addToCart">{{__('customlang.adding...')}}</span>
                            </button>
                            <button type="button" wire:click="addToWishList({{$product->id}})" class="btn btn1">
                               <span wire:loading.remove wire:target="addToWishList({{$product->id}})">
                                <i class="fa fa-heart"></i> {{__('customlang.addTowishList')}}
                               </span>
                               <span wire:loading wire:target="addToWishList">{{__('customlang.adding...')}}</span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">{{__('customlang.smallDescription')}}</h5>
                            <p>
                                {!!$product->small_description!!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>{{__('customlang.description')}}</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {!!$product->description!!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- py-3 py-md-5 --}}
    <div class="py-3 py-md-5">
        <div class="container" wire:ignore>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>{{__('customlang.related')}}
                        @if ($category)
                         {{$category->name}}
                        @endif
                        {{__('customlang.products')}}</h3>
                    <div class="underline"></div>
                </div>
                <div class="col-md-12">
                    @if ($category)
                    <div  class="owl-carousel owl-theme four-carousel">
                        @foreach ($category->relatedProducts as $relatedProductItem )
                        <div  class="item mb-3">
                            <div class="product-card" style="border-radius: 0.9em;overflow: hidden">
                                <div class="product-card-img">
                                    @if ($relatedProductItem->productImages->count()>0)
                                    <a href="{{url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug)}}">
                                    <img src="{{asset($relatedProductItem->productImages[0]->image)}}" alt="{{$relatedProductItem->name}}">
                                    </a>
                                    @endif
                                </div>
                                <div class="product-card-body">
                                    <p class="product-brand">{{$relatedProductItem->brand}}</p>
                                    <h5 class="product-name">
                                    <a href="{{url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug)}}">
                                            {{$relatedProductItem->name}}
                                    </a>
                                    </h5>
                                    <div>
                                        <span class="selling-price">{{$appSetting->currency}} {{$relatedProductItem->selling_price}}</span>
                                        <span class="original-price">{{$appSetting->currency}} {{$relatedProductItem->original_price}}</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                        <div class="p-2">
                            <h4>{{__('customlang.noRelatedProductsAvailabe')}}</h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- py-3 py-md-5 bg-white --}}
    <div class="py-3 py-md-5 bg-white">
        <div class="container" wire:ignore>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>{{__('customlang.related')}}
                        @if ($product)
                         {{$product->brand}}
                        @endif
                        {{__('customlang.products')}}</h3>
                    <div class="underline"></div>
                </div>
                <div class="col-md-12">
                    @if ($category)
                    <div  class="owl-carousel owl-theme four-carousel">
                            @foreach ($category->relatedProducts as $relatedProductItem )
                            @if ($relatedProductItem->brand=="$product->brand")
                            <div class="item mb-3">
                                <div class="product-card" style="border-radius:0.9em;overflow:hidden;">
                                    <div class="product-card-img">
                                        @if ($relatedProductItem->productImages->count()>0)
                                        <a href="{{url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug)}}">
                                        <img src="{{asset($relatedProductItem->productImages[0]->image)}}" class="w-100" alt="{{$relatedProductItem->name}}">
                                        </a>
                                        @endif
                                    </div>
                                    <div class="product-card-body">
                                        <p class="product-brand">{{$relatedProductItem->brand}}</p>
                                        <h5 class="product-name">
                                        <a href="{{url('/collections/'.$relatedProductItem->category->slug.'/'.$relatedProductItem->slug)}}">
                                                {{$relatedProductItem->name}}
                                        </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">{{$appSetting->currency}} {{$relatedProductItem->selling_price}}</span>
                                            <span class="original-price">{{$appSetting->currency}} {{$relatedProductItem->original_price}}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                    </div>
                    @else
                        <div class="p-2">
                            <h4>{{__('customlang.noRelatedProductsAvailabe')}}</h4>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')

<script>

    $(window).on('load',function(){
        $('.four-carousel').owlCarousel({
        loop:true,
        margin:10,
        dots:true,
        nav:false,
        responsiveClass:true,
        autoplay:true,
        autoplayHoverPause:true,
        autoPlayTimeout:1000,
        smartSpeed:1000,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            800:{
                items:3
            },
            // 1024:{
            //     items:4
            // },
            // 1100:{
            //     items:5
            // },
            // 1200:{
            //     items:6
            // },
        }
      });
    });

    $(function(){
        $("#exzoom").exzoom({
            "navWidth": 60,
            "navHeight": 60,
            "navItemNum": 5,
            "navItemMargin": 7,
            "navBorder": 1,
            "autoPlay": false,
            "autoPlayTimeout": 2000
        });
     });


</script>



@endpush
