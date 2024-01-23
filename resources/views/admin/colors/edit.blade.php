
@extends('layouts.admin')



@section('content')

<div class="row">

    <div class="col-md-12">

        @if (session('message'))
           <div class="alert alert-success">{{session('message')}}</div>
        @endif

     <div class="card">
         <div class="card-header">
             <h3>{{__('customlang.editColor')}}
                 <a href="{{url('admin/colors')}}" class="btn btn-danger btn-sm text-white float-end">
                    {{__('customlang.back')}}
                </a>
             </h3>
         </div>
         <div class="card-body">
          <form action="{{url('admin/colors/'.$color->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="">{{__('customlang.colorName')}}</label>
                <input type="text" name="name" value="{{$color->name}}" va class="form-control">
            </div>
            <div class="mb-3">
                <label for="">{{__('customlang.colorCode')}}</label>
                <input type="text" name="code" value="{{$color->code}}" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">{{__('customlang.status')}}</label> <br/>
                <input type="checkbox" {{$color->status?'Checked':''}} style="width:30px;height:30px" name="status" /> Checked={{__('customlang.hidden')}} , UnChecked={{__('customlang.visiable')}}
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
