@extends('layouts.app')

@section('title','My Order Details')

@section('content')

  <div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">

                    <h4 class="text-primary">
                        <i class="fa fa-shopping-cart text-dark"></i>{{__('customlang.myOrderDetails')}}
                        <a href="{{url('orders')}}" class="btn btn-danger btn-sm float-end">{{__('customlang.back')}}</a>
                    </h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>{{__('customlang.orderDetails')}}</h5>
                            <hr>
                            <h6>{{__('customlang.orderID')}}: {{$order->id}}</h6>
                            <h6>Tracking Id/No.: {{$order->tracking_no}}</h6>
                            <h6>Order Date : {{$order->created_at->format('d-m-Y h:i A')}}</h6>
                            <h6>{{__('customlang.paymentMode')}}: {{$order->payment_mode}}</h6>
                            <h6 class="border p-2 text-success">
                                {{__('customlang.orderStatusMessage')}} : <span class="text-uppercase">{{$order->status_message}}</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>{{__('customlang.userDetails')}}</h5>
                            <hr>
                            <h6>{{__('customlang.fullName')}}: {{$order->fullname}}</h6>
                            <h6>{{__('customlang.emailID')}}: {{$order->email}}</h6>
                            <h6>{{__('customlang.phone')}}: {{$order->phone}}</h6>
                            <h6>{{__('customlang.address')}}: {{$order->address}}</h6>
                            <h6>Pin code: {{$order->pincode}}</h6>
                        </div>
                    </div>
                    <br/>
                    <h5>{{__('customlang.orderItems')}}</h5>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Item ID</th>
                                    <th>{{__('customlang.image')}}</th>
                                    <th>{{__('customlang.product')}}</th>
                                    <th>{{__('customlang.price')}}</th>
                                    <th>{{__('customlang.quantity')}}</th>
                                    <th>{{__('customlang.total')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                             @php
                                 $totalPrice = 0;
                             @endphp
                             @foreach ($order->orderItems as $orderItem)
                              <tr>
                                <td width="10%">{{$orderItem->id}}</td>
                                <td width="10%">
                                    @if ($orderItem->product->productImages)
                                        <img src="{{asset($orderItem->product->productImages[0]->image)}}"
                                            style="width: 50px; height: 50px" alt="">
                                        @else
                                        <img src=""
                                            style="width: 50px; height: 50px" alt="">
                                        @endif
                                </td>
                                <td>
                                    {{$orderItem->product->name}}
                                    @if ($orderItem->productColor)
                                        @if ($orderItem->productColor->color)
                                        <span>- {{__('customlang.color')}}: {{ $orderItem->productColor->color->name }}</span>
                                        @endif
                                    @endif
                                </td>
                                <td width="10%">${{$orderItem->price}}</td>
                                <td width="10%">{{$orderItem->quantity}}</td>
                                <td width="10%" class="fw-bold">{{$appSetting->currency}} {{$orderItem->quantity * $orderItem->price}}</td>
                                @php
                                $totalPrice += $orderItem->quantity * $orderItem->price;
                                @endphp
                              </tr>
                             @endforeach
                             <tr>
                                <td colspan="5" class="fw-bold">{{__('customlang.totalAmount')}}:</td>
                                <td colspan="1" class="fw-bold">{{$appSetting->currency}} {{$totalPrice}}</td>
                             </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
