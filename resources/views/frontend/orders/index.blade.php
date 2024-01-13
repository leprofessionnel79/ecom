@extends('layouts.app')

@section('title','My Orders')

@section('content')

  <div class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="shadow bg-white p-3">
                    <h4 class="mb-4">{{__('customlang.myOrders')}}</h4>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>{{__('customlang.orderID')}}</th>
                                    <th>Traking No</th>
                                    <th>{{__('customlang.userName')}}</th>
                                    <th>{{__('customlang.paymentMode')}}</th>
                                    <th>{{__('customlang.orderDate')}}</th>
                                    <th>{{__('customlang.orderStatusMessage')}}</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @forelse ($orders as $item)
                               <tr>
                                 <td>{{$item->id}}</td>
                                 <td>{{$item->tracking_no}}</td>
                                 <td>{{$item->fullname}}</td>
                                 <td>{{$item->payment_mode}}</td>
                                 <td>{{$item->created_at->format('d-m-Y')}}</td>
                                 <td>{{$item->status_message}}</td>
                                 <td><a href="{{url('orders/'.$item->id)}}" class="btn btn-primary btn-sm">{{__('customlang.view')}}</a></td>
                               </tr>
                             @empty
                              <tr>
                                <td colspan="7">{{__('customlang.noOrdersAvailable')}}</td>
                              </tr>
                             @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
