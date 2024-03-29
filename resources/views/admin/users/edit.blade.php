@extends('layouts.admin')

@section('title','Edit User')

@section('content')

<div class="row">

    <div class="col-md-12">

        @if (session('message'))
           <div class="alert alert-success text-center">{{session('message')}}</div>
        @endif

        @if ($errors->any())
        <ul class="alert alert-warning">
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif

     <div class="card">
         <div class="card-header">
             <h3>{{__('customlang.editUser')}}
                 <a href="{{url('admin/users')}}" class="btn btn-danger btn-sm text-white float-end">
                    {{__('customlang.back')}}
                </a>
             </h3>
         </div>
         <div class="card-body">

            <form action="{{url('admin/users/'.$user->id)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>{{__('customlang.name')}}</label>
                        <input type="text" name="name" value="{{$user->name}}" class="form-control"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>{{__('customlang.email')}}</label>
                        <input type="text" name="email" readonly value="{{$user->email}}" class="form-control"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>{{__('customlang.password')}}</label>
                        <input type="text" name="password" class="form-control"/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>{{__('customlang.selectRole')}}</label>
                        <select name="role_as" class="form-control">
                           <option value="">{{__('customlang.selectRole')}}</option>
                           <option value="0" {{$user->role_as=='0'?'selected':''}}>{{__('customlang.user')}}</option>
                           <option value="1" {{$user->role_as=='1'?'selected':''}}>{{__('customlang.admin')}}</option>
                        </select>
                    </div>
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-primary text-white">{{__('customlang.update')}}</button>
                    </div>
                </div>
            </form>
         </div>
    </div>
  </div>
</div>

@endsection
