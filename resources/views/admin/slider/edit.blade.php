
@extends('layouts.admin')



@section('content')

<div class="row">

    <div class="col-md-12">

        @if (session('message'))
           <div class="alert alert-success">{{session('message')}}</div>
        @endif

     <div class="card">
         <div class="card-header">
             <h3>{{__('customlang.editSlider')}}
                 <a href="{{url('admin/sliders/')}}" class="btn btn-danger btn-sm text-white float-end">
                    {{__('customlang.back')}}
                </a>
             </h3>
         </div>
         <div class="card-body">
            <form action="{{url('admin/sliders/'.$slider->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="">{{__('customlang.title')}}</label>
                    <input type="text" name="title" value="{{$slider->title}}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="">{{__('customlang.description')}}</label>
                    <textarea name="description" class="form-control" rows="3">{{$slider->description}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="">{{__('customlang.image')}}</label>
                    <input type="file" name="image" class="form-control" />
                    <img src="{{asset($slider->image)}}" style="width: 50px;height:50px" alt="Slider">
                </div>
                <div class="mb-3">
                    <label for="">{{__('customlang.status')}}</label> <br/>
                    <input type="checkbox" {{$slider->status == 1?'Checked':''}}
                    style="width:30px;height:30px" name="status" />
                     Checked={{__('customlang.hidden')}} , UnChecked={{__('customlang.visiable')}}
                </div>
                <div class="mb-3">
                <button type="submit" class="btn btn-primary text-white">{{__('customlang.update')}}</button>
                </div>
            </form>
        </div>
    </div>
   </div>
</div>

@endsection
