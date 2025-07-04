@extends('layouts.app')

@section('title','Home Page')

@section('content')

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-inner">

        @foreach ($sliders as $key => $sliderItem)
        <div class="carousel-item {{$key == 0 ?'active':''}}">
            @if ($sliderItem->image)
            <img src="{{asset("$sliderItem->image")}}" class="d-block w-100" alt="...">
            @endif
            {{-- <div class="carousel-caption d-none d-md-block">
            <h5>{{$sliderItem->title}}</h5>
            <p>{{$sliderItem->description}}</p>
            </div> --}}
            <div class="carousel-caption d-none d-md-block">
                <div class="custom-carousel-content">
                    <h1>
                        {!!$sliderItem->title!!}
                    </h1>
                    <p>
                        {!!$sliderItem->description!!}
                    </p>
                    <div>
                        <a href="#" class="btn btn-slider">
                            Get Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">{{__('customlang.previous')}}</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">{{__('customlang.next')}}</span>
    </button>
  </div>

  <div class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h4>{{__('customlang.wELCOMTOsAMADIeCOMMERCE')}}</h4>
                    <div class="underline mx-auto"></div>
                        <p>
                            {{__('customlang.website_description')}}
                        </p>
            </div>
        </div>
    </div>
  </div>

  <div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>{{__('customlang.allCategories')}}</h4>
                <div class="underline mb-4"></div>
            </div>
            @if ($categories??'none')
            <div class="col-md-12">
                <div class="owl-carousel owl-theme four-carousel">
                    @foreach  ($categories as $categoryItem)
                        <div class="item">
                                <div class="category-card" style="border-radius:0.9em;overflow:hidden;">
                                    <a href="{{url('/collections/'.$categoryItem->slug)}}">
                                        <div class="category-card-img">
                                            <img src="{{asset("$categoryItem->image")}}" class="w-100" alt="Laptop">
                                        </div>
                                        <div class="category-card-body">
                                            <h5>{{$categoryItem->name}}</h5>
                                        </div>
                                    </a>
                                </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
  </div>

  <div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>{{__('customlang.trendingProducts')}}</h4>
                <div class="underline mb-4"></div>
            </div>
            @if ($trendingProducts)
            <div class="col-md-12">
                <div class="owl-carousel owl-theme four-carousel">
                    @foreach ($trendingProducts as $productItem )
                    <div class="item">
                        <div class="product-card" style="border-radius:0.9em;overflow:hidden;">
                            <div class="product-card-img">
                                <label class="stock bg-danger">{{__('customlang.new')}}</label>
                                @if ($productItem->productImages->count()>0)
                                <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                <img src="{{asset($productItem->productImages[0]->image)}}" alt="{{$productItem->name}}">
                                </a>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{$productItem->brand}}</p>
                                <h5 class="product-name">
                                <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                        {{$productItem->name}}
                                </a>
                                </h5>
                                <div>
                                    <span class="selling-price">{{$appSetting->currency}} {{$productItem->selling_price}}</span>
                                    <span class="original-price">{{$appSetting->currency}} {{$productItem->original_price}}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4>{{__('customlang.noProductsAvailable')}} </h4>
                </div>
            </div>
            @endif
        </div>
    </div>
  </div>

  <div class="py-5 bg-white">
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <h4>{{__('customlang.newArrivals')}}
                    <a href="{{url('new-arrivals')}}" class="btn btn-warning float-end">{{__('customlang.viewMore')}}</a>
                </h4>
                <div class="underline mb-4"></div>
            </div>
            @if ($newArrivalsProducts)
            <div class="col-md-12">
                <div class="owl-carousel owl-theme four-carousel">
                    @foreach ($newArrivalsProducts as $productItem )
                    <div class="item">
                        <div class="product-card"  style="border-radius:0.9em;overflow:hidden;">
                            <div class="product-card-img">
                                <label class="stock bg-danger">{{__('customlang.new')}}</label>
                                @if ($productItem->productImages->count()>0)
                                <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                <img src="{{asset($productItem->productImages[0]->image)}}" alt="{{$productItem->name}}">
                                </a>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{$productItem->brand}}</p>
                                <h5 class="product-name">
                                <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                        {{$productItem->name}}
                                </a>
                                </h5>
                                <div>
                                    <span class="selling-price">{{$appSetting->currency}} {{$productItem->selling_price}}</span>
                                    <span class="original-price">{{$appSetting->currency}} {{$productItem->original_price}}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4>{{__('customlang.noNewArrivalsAvailable')}} </h4>
                </div>
            </div>
            @endif
        </div>
    </div>
  </div>

  <div class="py-5">
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <h4>{{__('customlang.featuredProducts')}}
                    <a href="{{url('featured-products')}}" class="btn btn-warning float-end">{{__('customlang.viewMore')}}</a>
                </h4>
                <div class="underline mb-4"></div>
            </div>
            @if ($featuredProducts)
            <div class="col-md-12">
                <div class="owl-carousel owl-theme four-carousel">
                    @foreach ($featuredProducts as $productItem )
                    <div class="item">
                        <div class="product-card" style="border-radius:0.9em;overflow:hidden;">
                            <div class="product-card-img">
                                <label class="stock bg-danger">{{__('customlang.new')}}</label>
                                @if ($productItem->productImages->count()>0)
                                <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                <img src="{{asset($productItem->productImages[0]->image)}}" alt="{{$productItem->name}}">
                                </a>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{$productItem->brand}}</p>
                                <h5 class="product-name">
                                <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                                        {{$productItem->name}}
                                </a>
                                </h5>
                                <div>
                                    <span class="selling-price">{{$appSetting->currency}} {{$productItem->selling_price}}</span>
                                    <span class="original-price">{{$appSetting->currency}} {{$productItem->original_price}}</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
            </div>
            @else
            <div class="col-md-12">
                <div class="p-2">
                    <h4>{{__('customlang.noFeaturedProductsAvailable')}} </h4>
                </div>
            </div>
            @endif
        </div>
    </div>
  </div>

@endsection

@section('script')

<script>
    $(window).on('load',function(){
    $('.four-carousel').owlCarousel({
        loop:true,
        margin:7,
        dots:true,
        nav:false,
        autoplay:true,
        autoplayHoverPause:true,
        autoPlayTimeout:1000,
        smartSpeed:1000,
        responsiveClass:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });
});
</script>

@endsection
