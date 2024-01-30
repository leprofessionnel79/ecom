@extends('layouts.admin')



@section('content')

<div class="row">

    <div class="col-md-12">

        @if (session('message'))
           <div class="alert alert-success text-center">{{session('message')}}</div>
        @endif

     <div class="card">
         <div class="card-header">
             <h3>{{__('customlang.sliderList')}}
                 <a href="{{url('admin/sliders/create')}}" class="btn btn-primary btn-sm text-white float-end">
                    {{__('customlang.addSlider')}}
                </a>
             </h3>
         </div>
         <div class="card-body">
           <table class="table table-bordered table-striped">
             <thead>
                <tr>
                    <th>ID</th>
                    <th>{{__('customlang.title')}}</th>
                    <th>{{__('customlang.description')}}</th>
                    <th>{{__('customlang.image')}}</th>
                    <th>{{__('customlang.status')}}</th>
                    <th>Action</th>
                </tr>
             </thead>
             <tbody>
                @foreach ($sliders as $slider )

                <tr>
                    <td>{{$slider->id}}</td>
                    <td>{{$slider->title}}</td>
                    <td style="">{{$slider->description}}</td>
                    <td>
                        <img src="{{asset("$slider->image")}}" style="width:70px;height:70px" alt="Slider" >
                    </td>
                    <td>{{$slider->status =='0'? 'Visible':'Hidden'}}</td>
                    <td>
                        <a href="{{url('admin/sliders/'.$slider->id.'/edit')}}" class="btn btn-success btn-sm text-white">{{__('customlang.edit')}}</a>
                        <a href="{{url('admin/sliders/'.$slider->id.'/delete')}}" onclick="return confirm('Are You Sure You Want Delete This Slider ?')" class="btn btn-danger btn-sm text-white">{{__('customlang.delete')}}</a>
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
