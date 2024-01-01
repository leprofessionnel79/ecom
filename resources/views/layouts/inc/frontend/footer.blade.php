
    <div>
        <div class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="footer-heading">{{$appSetting->website_name}}</h4>
                        <div class="footer-underline"></div>
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                        </p>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading">{{__('customlang.quickLinks')}}</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2"><a href="{{url('/')}}" class="text-white">{{__('customlang.homePage')}}</a></div>
                        <div class="mb-2"><a href="{{url('/about-us')}}" class="text-white">{{__('customlang.aboutUs')}}</a></div>

                        <div class="mb-2"><a href="{{url('/contact-us')}}" class="text-white">{{__('customlang.contactUs')}}</a></div>
                        <div class="mb-2"><a href="{{url('/blogs')}}" class="text-white">Blogs</a></div>
                        <div class="mb-2"><a href="" class="text-white">Sitemaps</a></div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading">{{__('customlang.shopNow')}}</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2"><a href="{{url('/collections')}}" class="text-white">{{__('customlang.allCategories')}}</a></div>
                        <div class="mb-2"><a href="{{url('/')}}" class="text-white">{{__('customlang.homePage')}}</a></div>
                        <div class="mb-2"><a href="{{url('/new-arrivals')}}" class="text-white">{{__('customlang.newArrivalProducts')}}</a></div>
                        <div class="mb-2"><a href="{{url('/featured-products')}}" class="text-white">{{__('customlang.featuredProducts')}}</a></div>
                        <div class="mb-2"><a href="{{url('/cart')}}" class="text-white">{{__('customlang.cart')}}</a></div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading">{{__('customlang.reachUs')}}</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2">
                            <p>
                                <i class="fa fa-map-marker"></i>  {{$appSetting->address??'address'}}
                            </p>
                        </div>
                        <div class="mb-2">
                            <a href="" class="text-white">
                                <i class="fa fa-phone"></i> {{$appSetting->phone1??'phone 1'}}
                            </a>
                        </div>
                        <div class="mb-2">
                            <a href="" class="text-white">
                                <i class="fa fa-envelope"></i> {{$appSetting->email1??'email 1'}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <p class=""> &copy; 2024 - SAMADI- Ecommerce. All rights reserved.</p>
                    </div>
                    <div class="col-md-4">
                        <div class="social-media">
                            Get Connected:
                            @if ($appSetting->facebook)
                            <a href="{{$appSetting->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a>
                            @endif
                            @if ($appSetting->twitter)
                            <a href="{{$appSetting->twitter}}" target="_blank"><i class="fa fa-twitter"></i></a>
                            @endif
                            @if ($appSetting->instagram)
                            <a href="{{$appSetting->instagram}}" target="_blank"><i class="fa fa-instagram"></i></a>
                            @endif
                            @if ($appSetting->youtube)
                            <a href="{{$appSetting->youtube}}" target="_blank"><i class="fa fa-youtube"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
