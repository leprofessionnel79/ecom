<div class="main-navbar shadow-sm  sticky-top">
    <div class="top-navbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                   <a href="{{url('/')}}" style="text-decoration: none"> <h5 class="brand-name">{{$appSetting->website_name??'website name'}}</h5> </a>
                </div>
                <div class="col-md-5 my-auto">
                    <form action="{{url('search')}}" method="GET" role="search">
                        <div class="input-group">
                            <input type="search" name="search" value="{{Request::get('search')}}" placeholder="{{__('customlang.searchYourProduct')}}" class="form-control" />
                            <button class="btn bg-white" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-md-5 my-auto">
                    <ul class="nav justify-content-end">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{App::getlocale()=='ar'?'العربيه':'english'}}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{url('langConverter/en')}}">English</a></li>
                                <li><a class="dropdown-item" href="{{url('langConverter/ar')}}">العربيه</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('cart')}}">
                                <i class="fa fa-shopping-cart"></i> {{__('customlang.cart')}} (<livewire:frontend.cart.cart-count/>)
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('wishlist')}}">
                                <i class="fa fa-heart"></i> {{__('customlang.wishList')}} (<livewire:frontend.wishlist-count/>)
                            </a>
                        </li>
                    @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('customlang.login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('customlang.register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{url('profile')}}"><i class="fa fa-user"></i> {{__('customlang.profile')}}</a></li>
                                <li><a class="dropdown-item" href="{{url('orders')}}"><i class="fa fa-list"></i> {{__('customlang.myOrder')}}</a></li>
                                <li><a class="dropdown-item" href="{{url('wishlist')}}"><i class="fa fa-heart"></i> {{__('customlang.myWishList')}}</a></li>
                                <li><a class="dropdown-item" href="{{url('cart')}}"><i class="fa fa-shopping-cart"></i> {{__('customlang.cart')}}</a></li>
                            <li>
                                <a class="dropdown-item" href="{{route('logout')}}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> {{ __('customlang.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            </ul>
                        </li>
                    @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand d-block d-sm-block d-md-none d-lg-none" href="#">
                SAMADI Ecom
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">{{ __('customlang.homePage')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/collections')}}">{{__('customlang.allCategories')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/new-arrivals')}}">{{__('customlang.newArrivals')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/featured-products')}}">{{__('customlang.featuredProducts')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{__('customlang.electronics')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{__('customlang.fashions')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{__('customlang.accessories')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('langConverter/en')}}">English</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="font-family: cairo;" href="{{url('langConverter/ar')}}">العربيه</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</div>
