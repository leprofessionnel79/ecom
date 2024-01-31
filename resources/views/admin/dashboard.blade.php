@extends('layouts.admin')



@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">

            @if(session('message'))
            <h2 class="alert alert-success">{{session('message')}}</h2>
            @endif
            <div class="me-md-3 me-xl-5">
                <h2>{{__('customlang.dashboard')}}</h2>
                {{-- <p class="mb-md-0">Your analytics dashboard templet.</p> --}}
                <hr>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3">
                      <label>{{__('customlang.totalOrders')}}</label>
                      <h1>{{$totalOrders}}</h1>
                      <a href="{{url('admin/orders')}}" class="text-white">{{__('customlang.view')}}</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-success text-white mb-3">
                      <label>{{__('customlang.todayOrders')}}</label>
                      <h1>{{$todayOrder}}</h1>
                      <a href="{{url('admin/orders')}}" class="text-white">{{__('customlang.view')}}</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-warning text-white mb-3">
                      <label>{{__('customlang.thisMonthOrders')}}</label>
                      <h1>{{$thisMonthOrder}}</h1>
                      <a href="{{url('admin/orders')}}" class="text-white">{{__('customlang.view')}}</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-danger text-white mb-3">
                      <label>{{__('customlang.yearOrders')}}</label>
                      <h1>{{$thisYearOrder}}</h1>
                      <a href="{{url('admin/orders')}}" class="text-white">{{__('customlang.view')}}</a>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3">
                      <label>{{__('customlang.totalProducts')}}</label>
                      <h1>{{$totalProducts}}</h1>
                      <a href="{{url('admin/products')}}" class="text-white">{{__('customlang.view')}}</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-success text-white mb-3">
                      <label>{{__('customlang.totalCategories')}}</label>
                      <h1>{{$totalCategories}}</h1>
                      <a href="{{url('admin/category')}}" class="text-white">{{__('customlang.view')}}</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-warning text-white mb-3">
                      <label>{{__('customlang.totalBrands')}}</label>
                      <h1>{{$totalBrands}}</h1>
                      <a href="{{url('admin/brands')}}" class="text-white">{{__('customlang.view')}}</a>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-3">
                    <div class="card card-body bg-primary text-white mb-3">
                      <label>{{__('customlang.allUsers')}}</label>
                      <h1>{{$totalAllUsers}}</h1>
                      <a href="{{url('admin/users')}}" class="text-white">{{__('customlang.view')}}</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-success text-white mb-3">
                      <label>{{__('customlang.totalUsers')}}</label>
                      <h1>{{$totalUser}}</h1>
                      <a href="{{url('admin/users')}}" class="text-white">{{__('customlang.view')}}</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-body bg-warning text-white mb-3">
                      <label>{{__('customlang.totalAdmins')}}</label>
                      <h1>{{$totalAdmin}}</h1>
                      <a href="{{url('admin/users')}}" class="text-white">{{__('customlang.view')}}</a>
                    </div>
                </div>
            </div>





    </div>
</div>

@endsection
