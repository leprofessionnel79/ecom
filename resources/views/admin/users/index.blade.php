@extends('layouts.admin')

@section('title','Users List')

@section('content')

<div class="row">

    <div class="col-md-12">

        @if (session('message'))
           <div class="alert alert-success text-center">{{session('message')}}</div>
        @endif

     <div class="card">
         <div class="card-header">
             <h3>{{__('customlang.users')}}
                 <a href="{{url('admin/users/create')}}" class="btn btn-primary btn-sm text-white float-end">
                    {{__('customlang.addUser')}}
                </a>
             </h3>
         </div>
         <div class="card-body">
            <table class="table table-borderd table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{__('customlang.name')}}</th>
                        <th>{{__('customlang.email')}}</th>
                        <th>{{__('customlang.role')}}</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if ($user->role_as =='0')
                               <label class="badge btn-primary">{{__('customlang.user')}}</label>
                            @elseif ($user->role_as =='1')
                               <label class="badge btn-success">{{__('customlang.admin')}}</label>
                            @else
                               <label class="badge btn-danger">{{__('customlang.none')}}</label>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('admin/users/'.$user->id.'/edit')}}" class="btn btn-sm btn-success text-white">
                                {{__('customlang.edit')}}
                            </a>
                            <a href="{{url('admin/users/'.$user->id.'/delete')}}" onclick="return confirm('Are you sure , You want delete this data ?')" class="btn btn-sm btn-danger text-white">
                                {{__('customlang.delete')}}
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">{{__('customlang.noUsersAvailable')}}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{$users->links()}}
            </div>
           </div>
         </div>
      </div>
    </div>
</div>

@endsection
