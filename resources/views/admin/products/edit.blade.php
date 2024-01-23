@extends('layouts.admin')



@section('content')

<div class="row">

    <div class="col-md-12">

        @if (session('message'))
             <h5 class="alert alert-success md-2">{{session('message')}}</h5>
        @endif
     <div class="card">
         <div class="card-header">
             <h3>{{__('customlang.editProducts')}}
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


          <form action="{{url('admin/products/'.$product->id)}}" method="POST" enctype="multipart/form-data">
               @csrf
               @method('PUT')
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
                        <button class="nav-link" id="colors-tab" data-bs-toggle="tab" data-bs-target="#colors-tab-pane" type="button" role="tab" >
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

                            <option value="{{$category->id}}" {{$category->id == $product->category->id?'selected':''}}>
                                {{$category->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="mb-3">
                            <label>{{__('customlang.productName')}}</label>
                            <input type="text" name="name" value="{{$product->name}}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>{{__('customlang.productSlug')}}</label>
                            <input type="text" name="slug" value="{{$product->slug}}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>{{__('customlang.selectBrand')}}</label>
                            <select name="brand" class="form-control">
                            @foreach ($brands as $brand)

                                <option value="{{$brand->name}}" {{$brand->name == $product->brand?'selected':''}}>
                                    {{$brand->name}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>{{__('customlang.smallDescription')}}</label>
                            <textarea type="text" name="small_description" class="form-control" rows="4">{{$product->small_description}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>{{__('customlang.description')}}</label>
                            <textarea type="text" name="description" class="form-control" rows="4">{{$product->description}}</textarea>
                        </div>

                    </div>
                    <div class="tab-pane fade border p-3" id="seotag-tab-pane" role="tabpanel" aria-labelledby="seotag-tab" tabindex="0">

                        <div class="mb-3">
                            <label>{{__('customlang.metaTitle')}}</label>
                            <input type="text" name="meta_title" value="{{$product->meta_title}}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>{{__('customlang.metaDescription')}}</label>
                            <textarea type="text" name="meta_description" class="form-control" rows="4">{{$product->meta_description}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>{{__('customlang.metaKeyword')}}</label>
                            <textarea type="text" name="meta_keyword" class="form-control" rows="4">{{$product->meta_keyword}}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>{{__('customlang.originalPrice')}}</label>
                                    <input type="text" name="original_price" value="{{$product->original_price}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>{{__('customlang.sellingPrice')}}</label>
                                    <input type="text" name="selling_price" value="{{$product->selling_price}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>{{__('customlang.quantity')}}</label>
                                    <input type="number" name="quantity" value="{{$product->quantity}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>{{__('customlang.trending')}}</label>
                                    <input type="checkbox" name="trending" {{$product->trending =='1'?'checked':''}} style="width:50px;height:50px;" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>{{__('customlang.featured')}}</label>
                                    <input type="checkbox" name="featured" {{$product->featured =='1'?'checked':''}} style="width:50px;height:50px;" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label>{{__('customlang.status')}}</label>
                                    <input type="checkbox" name="status" {{$product->status =='1'?'checked':''}} style="width:50px;height:50px;" />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                      <div class="mb-3">
                        <label>{{__('customlang.uploadProductImages')}}</label>
                        <input type="file" name="image[]" multiple class="form-control" />
                      </div>
                      <div>
                        @if ($product->productImages)
                        <div class="row">
                            @foreach ($product->productImages as $image )
                            <div class="col-md-2">
                                <img src="{{asset($image->image)}}" style="width:80px;height:80px;"
                                class="me-4 border" alt="Img" />
                                <a href="{{url('admin/product-image/'.$image->id.'/delete')}}" class="d-block">{{__('customlang.remove')}}</a>
                            </div>
                            @endforeach
                        </div>
                        @else
                         <h5>{{__('customlang.noImageAdded')}}</h5>
                        @endif
                      </div>
                    </div>
                    <div class="tab-pane fade border p-3" id="colors-tab-pane" role="tabpanel" tabindex="0">
                        <div class="mb-3">
                            <h4>{{__('customlang.addProductColor')}}</h4>
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
                        <div class="table-responsive">
                          <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>{{__('customlang.colorName')}}</th>
                                    <th>{{__('customlang.quantity')}}</th>
                                    <th>{{__('customlang.delete')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->productColors as $prodColor)
                                    <tr class="prod-color-tr">
                                        <td>
                                            @if ($prodColor->color)
                                            {{$prodColor->color->name}}
                                            @else
                                            {{__('customlang.noColorsFound')}}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="input-group mb-3" style="width:150px;">
                                                <input type="text" value="{{$prodColor->quantity}}" class="productColorQuantity form-control form-control-sm" />
                                                {{-- <button type="button" value="{{$prodColor->id}}" class="updateProductColorBtn btn btn-priamary btn-sm text-white">Update</button> --}}
                                                <button type="button" value="{{$prodColor->id}}" class="updateProductColorBtn btn btn-primary btn-sm text-white">{{__('customlang.update')}}</button>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" value="{{$prodColor->id}}" class="deleteProductColorBtn btn btn-danger btn-sm text-white">{{__('customlang.delete')}}</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary text-white">{{__('customlang.update')}}</button>
                </div>
            </form>
         </div>
     </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $(document).ready(function (){
        $(document).on('click','.updateProductColorBtn',function(){
            var product_id = "{{$product->id}}";
            var prod_color_id = $(this).val();
            var qty = $(this).closest('.prod-color-tr').find('.productColorQuantity').val();
            //alert(prod_color_id);

            if(qty<=0){
                alert('Quantity is rquired');
                return false;
            }

            var data={
                'product_id':product_id,
                'qty':qty
            }

            $.ajax({
               type:"POST",
               url:"/admin/product-color/"+prod_color_id,
               data:data,
               success: function (response){
                  alert(response.message);
               }
            });

        });

        $(document).on('click','.deleteProductColorBtn',function(){

            var prod_color_id = $(this).val();
            var thisClick = $(this);


            $.ajax({
               type:"GET",
               url:"/admin/product-color/"+prod_color_id+"/delete",
               success: function (response){
                thisClick.closest('.prod-color-tr').remove();

                alert(response.message);
               }
            });


          });

     });
    </script>
@endsection
