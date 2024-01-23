@extends('layouts.admin')



@section('content')

<div class="row">

    <div class="col-md-12">
     <div class="card">
         <div class="card-header">
             <h3>{{__('customlang.addProducts')}}
                 <a href="{{url('admin/products')}}" class="btn btn-danger btn-sm text-white float-end">
                    {{__('customlang.back')}}
                </a>
             </h3>
         </div>
         <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                    <div>{{$error}}</div>
                    @endforeach
                </div>
            @endif


          <form action="{{url('admin/products')}}" method="POST" enctype="multipart/form-data">
               @csrf
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab" aria-selected="true">
                        {{__('customlang.home')}}
                    </button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="seotag-tab" data-bs-toggle="tab" data-bs-target="#seotag-tab-pane" type="button" role="tab" aria-controls="seotag-tab" aria-selected="false">
                        {{__('customlang.seoTags')}}
                    </button>
                    </li>
                    <li class="nav-item" role="presentation">
                    <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab" aria-selected="false">
                        {{__('customlang.details')}}
                    </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab" aria-selected="false">
                            {{__('customlang.productImage')}}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="color-tab" data-bs-toggle="tab" data-bs-target="#color-tab-pane" type="button" role="tab" aria-controls="color-tab" aria-selected="false">
                            {{__('customlang.productColors')}}
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade border p-3 show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <br/>
                        <div class="mb-3">
                        <label>{{__('customlang.category')}}</label>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)

                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="mb-3">
                            <label>{{__('customlang.productName')}}</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>{{__('customlang.productSlug')}}</label>
                            <input type="text" name="slug" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>{{__('customlang.selectBrand')}}</label>
                            <select name="brand" class="form-control">
                            @foreach ($brands as $brand)

                                <option value="{{$brand->name}}">{{$brand->name}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>{{__('customlang.smallDescription')}}</label>
                            <textarea type="text" name="small_description" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>{{__('customlang.description')}}</label>
                            <textarea type="text" name="description" class="form-control" rows="4"></textarea>
                        </div>

                    </div>
                    <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">

                        <div class="mb-3">
                            <label>{{__('customlang.metaTitle')}}</label>
                            <input type="text" name="meta_title" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>{{__('customlang.metaDescription')}}</label>
                            <textarea type="text" name="meta_description" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>{{__('customlang.metaKeyword')}}</label>
                            <textarea type="text" name="meta_keyword" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>{{__('customlang.originalPrice')}}</label>
                                    <input type="text" name="original_price" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>{{__('customlang.sellingPrice')}}</label>
                                    <input type="text" name="selling_price" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>{{__('customlang.quantity')}}</label>
                                    <input type="number" name="quantity" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>{{__('customlang.trending')}}</label>
                                    <input type="checkbox" name="trending" style="width:50px;height:50px;" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>{{__('customlang.featured')}}</label>
                                    <input type="checkbox" name="featured" style="width:50px;height:50px;" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>{{__('customlang.status')}}</label>
                                    <input type="checkbox" name="status" style="width:50px;height:50px;" />
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                      <div class="mb-3">
                        <label>{{__('customlang.uploadProductImages')}}</label>
                        <input type="file" name="image[]" multiple class="form-control" />
                      </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="color-tab-pane" role="tabpanel" aria-labelledby="color-tab" tabindex="0">
                        <div class="mb-3">
                          <label>{{__('customlang.selectColor')}}</label>
                          <div class="row">
                            @forelse ($colors as $coloritem)
                            <div class="col-md-3">
                               <div class="p-2 border mb-3">
                                {{__('customlang.color')}}:  <input type="checkbox" name="colors[{{$coloritem->id}}]" value="{{$coloritem->id}}" />
                                    {{$coloritem->name}}
                                    <br/>
                                    {{__('customlang.quantity')}}: <input type="number" name="colorquantity[{{$coloritem->id}}]" style="width:70px;border:1px solid" />
                               </div>
                           </div>
                            @empty
                             <div class="col-md-12">
                                <h1>{{__('customlang.noColorsFound')}}</h1>
                             </div>
                            @endforelse

                          </div>
                        </div>
                      </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary text-white">{{__('customlang.submit')}}</button>
                </div>
            </form>
         </div>
     </div>
    </div>
</div>



@endsection
