@extends('layouts.admin')



@section('content')

<div class="row">

    <div class="col-md-12">

        @if (session('message'))
           <div class="alert alert-success">{{session('message')}}</div>
        @endif

     <div class="card">
         <div class="card-header">
             <h3>{{__('customlang.colorList')}}
                 <a href="{{url('admin/colors/create')}}" class="btn btn-primary btn-sm text-white float-end">
                    {{__('customlang.addColor')}}
                </a>
             </h3>
         </div>
         <div class="card-body">
           <table class="table table-bordered table-striped">
             <thead>
                <tr>
                    <th>ID</th>
                    <th>{{__('customlang.colorName')}}</th>
                    <th>{{__('customlang.colorCode')}}</th>
                    <th>{{__('customlang.status')}}</th>
                    <th>Action</th>
                </tr>
             </thead>
             <tbody>
                @foreach ($colors as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->code}}</td>
                        <td>{{$item->status ?'Hidden':'Visible'}}</td>
                        <td>
                            <a href="{{url('admin/colors/'.$item->id.'/edit')}}" class="btn btn-primary btn-sm text-white">{{__('customlang.edit')}}</a>
                            <a href="{{url('admin/colors/'.$item->id.'/delete')}}" onclick="return confirm('Are you sure you want to delete this data?')" class="btn btn-danger btn-sm text-white">{{__('customlang.delete')}}</a>
                        </td>
                    </tr>
                @endforeach
             </tbody>
           </table>
        </div>
    </div>
   </div>
</div>

@endsection
