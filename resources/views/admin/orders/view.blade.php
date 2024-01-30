@extends('layouts.admin')

@section('title','My Orders Details')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
          <div class="alert alert-success mb-3 text-center">{{session('message')}}</div>
        @endif
     <div class="card">
         <div class="card-header">
             <h3>{{__('customlang.myOrderDetails')}}</h3>
         </div>
            <div class="card-body">
                    <h4 class="text-primary">
                        <i class="fa fa-shopping-cart text-dark"></i> {{__('customlang.myOrderDetails')}}
                        <a href="{{url('admin/orders')}}" class="btn btn-danger text-white btn-sm float-end mx-1" >{{__('customlang.back')}}</a>
                        <a href="{{url('admin/invoice/'.$order->id.'/generate')}}" class="btn btn-primary btn-sm float-end mx-1">
                          <span class="fa fa-download"></span> {{__('customlang.downloadInvoice')}}
                        </a>
                        <a href="{{url('admin/invoice/'.$order->id)}}" target="_blank" class="btn btn-warning btn-sm float-end mx-1">
                            <span class="fa fa-eye"></span> {{__('customlang.viewInvoice')}}
                        </a>
                        <a href="{{url('admin/invoice/'.$order->id.'/mail')}}" class="btn btn-info btn-sm float-end mx-1">
                            <span class="fa fa-envelope"></span> {{__('customlang.sendInvoiceViaEmail')}}
                        </a>
                    </h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>{{__('customlang.orderDetails')}}</h5>
                            <hr>
                            <h6>{{__('customlang.orderID')}}: {{$order->id}}</h6>
                            <h6>Tracking Id/No.: {{$order->tracking_no}}</h6>
                            <h6>{{__('customlang.orderDate')}}: {{$order->created_at->format('d-m-Y h:i A')}}</h6>
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
                                <td width="10%">{{$appSetting->currency}} {{$orderItem->price}}</td>
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

        <div class="card border mt-3">
            <div class="card-body">
                <h4>Order Process (Order Status Updates)</h4>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        <form action="{{url('admin/orders/'.$order->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <label>{{__('customlang.updateOrderStatus')}}</label>
                            <div class="input-group">
                                <select name="order_status" class="form-select">
                                    <option value="">{{__('customlang.selectAllStatus')}}</option>
                                    <option value="in progress" {{Request::get('status')=='in progress' ? 'selected':''}}>In Progress</option>
                                    <option value="completed" {{  Request::get('status')=='completed' ? 'selected':''}}>Completed</option>
                                    <option value="pending" {{Request::get('status')=='pending' ? 'selected':''}}>Pending</option>
                                    <option value="canceled" {{   Request::get('status')=='canceled' ? 'selected':''}}>Canceled</option>
                                    <option value="out-for-delivery" {{   Request::get('status')=='out-for-delivery' ? 'selected':''}}>Out for Delivery</option>
                                </select>
                                <button type="submit" class="btn btn-primary text-white">{{__('customlang.update')}}</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-7">
                        <br/>
                        <h4 class="mt-3">{{__('customlang.currentOrderStatus')}}: <span class="text-uppercase">{{$order->status_message}}</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
