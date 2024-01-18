<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item {{Request::is('admin/dashboard')?'active':''}}">
        <a class="nav-link" href="{{url('admin/dashboard')}}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">{{__('customlang.dashBoard')}}</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('admin/orders')?'active':''}}">
        <a class="nav-link" href="{{url('admin/orders')}}">
          <i class="mdi mdi-sale menu-icon"></i>
          <span class="menu-title">{{__('customlang.orders')}}</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('admin/category*')?'active':''}}">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="{{Request::is('admin/category*')?'true':'false'}}" aria-controls="ui-basic">
          <i class="mdi  mdi-view-list menu-icon"></i>
          <span class="menu-title">{{__('customlang.categorise')}}</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{Request::is('admin/category*')?'show':''}}" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{Request::is('admin/category/create')?'active':''}}" href="{{url('admin/category/create')}}">{{__('customlang.addCategory')}}</a></li>
            <li class="nav-item"> <a class="nav-link {{Request::is('admin/category')||Request::is('admin/category/*/edit')?'active':'' }}" href="{{url('admin/category/')}}">{{__('customlang.viewCategory')}}</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{Request::is('admin/products*')?'active':''}}">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic1" aria-expanded="{{Request::is('admin/products*')?'true':'false'}}" aria-controls="ui-basic1">
          <i class="mdi  mdi-plus-circle menu-icon"></i>
          <span class="menu-title">{{__('customlang.products')}}</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{Request::is('admin/products*')?'show':''}}" id="ui-basic1">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{Request::is('admin/products/create')?'active':''}}" href="{{url('admin/products/create')}}">{{__('customlang.addProduct')}}</a></li>
            <li class="nav-item"> <a class="nav-link {{Request::is('admin/products')||Request::is('admin/products/*/edit')?'active':'' }}" href="{{url('admin/products')}}">{{__('customlang.viewProducts')}}</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{Request::is('admin/brands')?'active':''}}">
        <a class="nav-link" href="{{url('admin/brands')}}">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">{{__('customlang.brands')}}</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('admin/colors')?'active':''}}">
        <a class="nav-link" href="{{url('admin/colors')}}">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">{{__('customlang.colors')}}</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('admin/users*')?'active':''}}">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic2" aria-expanded="{{Request::is('admin/users*')?'true':'false'}}" aria-controls="ui-basic2">
          <i class="mdi mdi-account-supervisor menu-icon"></i>
          <span class="menu-title">{{__('customlang.users')}}</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse {{Request::is('admin/users*')?'show':''}}" id="ui-basic2">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link {{Request::is('admin/users/create')?'active':''}}" href="{{url('admin/users/create')}}">{{__('customlang.addUser')}}</a></li>
            <li class="nav-item"> <a class="nav-link {{Request::is('admin/users')||Request::is('admin/users/*/edit')?'active':'' }}" href="{{url('admin/users')}}">{{__('customlang.viewUsers')}}</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{Request::is('admin/sliders')?'active':''}}">
        <a class="nav-link" href="{{url('admin/sliders')}}">
          <i class="mdi mdi-view-carousel menu-icon"></i>
          <span class="menu-title">{{__('customlang.homeSlider')}}</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('admin/settings')?'active':''}}">
        <a class="nav-link" href="{{url('admin/settings')}}">
          <i class="mdi mdi-settings menu-icon"></i>
          <span class="menu-title">{{__('customlang.siteSetting')}}</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('langConverter')?'active':''}}">
        <a class="nav-link" href="{{url('langConverter/en')}}">
          <i class="mdi mdi-settings menu-icon"></i>
          <span class="menu-title">english</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('langConverter')?'active':''}}">
        <a class="nav-link" href="{{url('langConverter/ar')}}">
          <i class="mdi mdi-settings menu-icon"></i>
          <span class="menu-title">العربيه</span>
        </a>
      </li>
    </ul>
  </nav>
