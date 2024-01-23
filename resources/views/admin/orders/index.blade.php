@extends('layouts.admin')

@section('title','My Orders')

@section('content')

<div class="row">

    <div class="col-md-12">
     <div class="card">
         <div class="card-header">
             <h3>{{__('customlang.myOrders')}}</h3>
         </div>
         <div class="card-body">

            <form action="" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">{{__('customlang.filterByDate')}}</label>
                        <input type="date" name="date" value="{{Request::get('date') ?? date('Y-m-d') }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">{{__('customlang.filterByStatus')}}</label>
                       <select name="status" class="form-select">
                         <option value="">{{__('customlang.selectAllStatus')}}</option>
                         <option value="in progress" {{Request::get('status')=='in progress' ? 'selected':''}}>In Progress</option>
                         <option value="completed" {{  Request::get('status')=='completed' ? 'selected':''}}>Completed</option>
                         <option value="pending" {{Request::get('status')=='pending' ? 'selected':''}}>Pending</option>
                         <option value="canceled" {{   Request::get('status')=='canceled' ? 'selected':''}}>Canceled</option>
                         <option value="out-for-delivery" {{   Request::get('status')=='out-for-delivery' ? 'selected':''}}>Out for Delivery</option>
                       </select>
                    </div>
                    <div class="col-md-6">
                        <br>
                        <button type="submit" class="btn btn-primary text-white">{{__('customlang.filter')}}</button>
                    </div>
                </div>
            </form>
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
                                 <td><a href="{{url('admin/orders/'.$item->id)}}" class="btn btn-primary text-white btn-sm">{{__('customlang.view')}}</a></td>
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
