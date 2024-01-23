@extends('layouts.admin')



@section('content')

<div class="row">

   <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h3>{{__('customlang.editCategory')}}
                <a href="{{url('admin/category')}}" class="btn btn-primary btn-sm text-white float-end">{{__('customlang.back')}}</a>
            </h3>
        </div>
        <div class="card-body">
            <form action="{{url('/admin/category/'.$category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

             <div class="row">


                <div class="col-md-6 mb-3">
                 <label>{{__('customlang.name')}}</label>
                  <input type="text" name="name" value="{{$category->name}}" class="form-control"/>
                  @error('name')
                   <small class="text-danger">{{$message}}</small>
                  @enderror
               </div>
               <div class="col-md-6 mb-3">
                <label>{{__('customlang.slug')}}</label>
                 <input type="text" name="slug" value="{{$category->slug}}" class="form-control"/>
                 @error('slug')
                   <small class="text-danger">{{$message}}</small>
                  @enderror
               </div>
               <div class="col-md-6 mb-3">
                <label>{{__('customlang.description')}}</label>
                <textarea name="description" class="form-control" rows="3">{{$category->description}}</textarea>
                @error('description')
                   <small class="text-danger">{{$message}}</small>
                  @enderror
               </div>
               <div class="col-md-6 mb-3">
                <label>{{__('customlang.image')}}</label>
                 <input type="file" name="image" class="form-control"/>
                 <img src="{{asset($category->image)}}" width="60px" height="60px" />

                 @error('image')
                   <small class="text-danger">{{$message}}</small>
                  @enderror
               </div>
               </div>
               <div class="col-md-6 mb-3">
                <label>{{__('customlang.status')}}</label><br/>
                 <input type="checkbox"  name="status" {{$category->status == '1'?'checked':''}}/>
               </div>
               <div class="col-md-12">
                <h4>{{__('customlang.seoTags')}}</h4>
               </div>
               <div class="col-md-12 mb-3">
                <label>{{__('customlang.metaTitle')}}</label>
                 <input type="text" name="meta_title" value="{{$category->meta_title}}" class="form-control"/>
                 @error('meta_title')
                   <small class="text-danger">{{$message}}</small>
                  @enderror
               </div>
               <div class="col-md-6 mb-3">
                <label>{{__('customlang.metaKeyword')}}</label>
                 <textarea name="meta_keyword"  class="form-control" rows="3">{{$category->meta_keyword}}</textarea>
                 @error('meta_keyword')
                   <small class="text-danger">{{$message}}</small>
                  @enderror
               </div>
               <div class="col-md-6 mb-3">
                <label>{{__('customlang.metaDescription')}}</label>
                 <textarea name="meta_description"  class="form-control" rows="3">{{$category->meta_description}}</textarea>
                 @error('meta_description')
                   <small class="text-danger">{{$message}}</small>
                  @enderror
               </div>
               <div class="col-md-12 mb-3">
                 <button type="submit"  class="btn btn-primary float-end text-white">{{__('customlang.update')}}</button>
               </div>
             </div>
            </form>
        </div>
    </div>
   </div>
</div>

@endsection
