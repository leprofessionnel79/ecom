@extends('layouts.app')

@section('title','Thank You For Shopping')

@section('content')


  <div class="py-3 pyt-md-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                @if (session('message'))
                <h5 class="alert alert-success text-center">{{ session('message')}}</h5>
                @endif
                <div class="p-4 shadow bg-white">
                    <h4>{{__('customlang.thankYouForShoppingWithSamadiEcommerce')}}</h4>
                    <a href="{{url('collections')}}" class="btn btn-primary">{{__('customlang.shopNow')}}</a>
                </div>
            </div>
        </div>
    </div>

  </div>




@endsection
