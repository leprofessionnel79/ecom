@extends('layouts.admin')



@section('content')

<div class="row">

    <div class="col-md-12">

        @if (session('message'))
           <div class="alert alert-success text-center">{{session('message')}}</div>
        @endif

     <div class="card">
         <div class="card-header">
             <h3>{{__('customlang.products')}}
                 <a href="{{url('admin/products/create')}}" class="btn btn-primary btn-sm text-white float-end">
                    {{__('customlang.addProducts')}}
                </a>
             </h3>
         </div>
         <div class="card-body">
            <table class="table table-borderd table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{__('customlang.category')}}</th>
                        <th>{{__('customlang.product')}}</th>
                        <th>{{__('customlang.price')}}</th>
                        <th>{{__('customlang.quantity')}}</th>
                        <th>{{__('customlang.status')}}</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>
                            @if($product->category)
                               {{$product->category->name}}
                            @else
                            {{__('customlang.noCategory')}}
                            @endif

                        </td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->selling_price}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->status == '1'? 'Hidden':'Visible'}}</td>
                        <td>
                          <a href="{{url('admin/products/'.$product->id.'/edit')}}" class="btn btn-sm btn-success text-white">{{__('customlang.edit')}}</a>
                          <a href="{{url('admin/products/'.$product->id.'/delete')}}" onclick="return confirm('Are you sure , You want delete this data ?')" class="btn btn-sm btn-danger text-white">{{__('customlang.delete')}}</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">{{__('customlang.noProductsAvailable')}}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{$products->links()}}
            </div>
         </div>
     </div>
     </div>
    </div>
</div>

@endsection
