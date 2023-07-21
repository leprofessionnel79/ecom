<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index',compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create',compact('categories','brands'));
    }

    public function store(ProductFormRequest $request)
    {
       $validatedData = $request->validated();

       $category = Category::findOrFail($validatedData['category_id']);
       $product = $category->products()->create([
           'category_id'=>$validatedData['category_id'],
           'name'=>$validatedData['name'],
           'slug'=>Str::slug($validatedData['slug']),
           'brand'=>$validatedData['brand'],
           'small_description'=>$validatedData['small_description'],
           'description'=>$validatedData['description'],
           'original_price'=>$validatedData['original_price'],
           'selling_price'=>$validatedData['selling_price'],
           'quantity'=>$validatedData['quantity'],
           'trending'=>$request->trending == true?'1':'0',
           'status'=>$request->status == true?'1':'0',
           'meta_title'=>$validatedData['meta_title'],
           'meta_keyword'=>$validatedData['meta_keyword'],
           'meta_description'=>$validatedData['meta_description'],
       ]);

       if($request->hasFile('image')){
        $uploadPath = 'uploads/products/';

        $i=1;
        foreach($request->file('image') as $imageFile){
            $extention = $imageFile->getClientOriginalExtension();
            $fileName = time().$i++.'.'.$extention;
            $imageFile->move($uploadPath ,$fileName);
            $finalImagePathName = $uploadPath.$fileName;

            $product->productImages()->create([
                'product_id'=>$product->id,
                'image'=>$finalImagePathName,
              ]);

        }
       }
       return redirect('admin/products')->with('message','Product Added Successfully');
    }

    public function edit($product_id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::findOrFail($product_id);
        return view('admin.products.edit',compact('categories','brands','product'));
    }

    public function update(ProductFormRequest $request ,$product_id)
    {
        $validatedData = $request->validated();
        $product = Category::findOrFail($validatedData['category_id'])
                       ->products()->where('id',$product_id)->first();

        if($product)
        {
            $product->update([
                'category_id'=>$validatedData['category_id'],
                'name'=>$validatedData['name'],
                'slug'=>Str::slug($validatedData['slug']),
                'brand'=>$validatedData['brand'],
                'small_description'=>$validatedData['small_description'],
                'description'=>$validatedData['description'],
                'original_price'=>$validatedData['original_price'],
                'selling_price'=>$validatedData['selling_price'],
                'quantity'=>$validatedData['quantity'],
                'trending'=>$request->trending == true?'1':'0',
                'status'=>$request->status == true?'1':'0',
                'meta_title'=>$validatedData['meta_title'],
                'meta_keyword'=>$validatedData['meta_keyword'],
                'meta_description'=>$validatedData['meta_description'],
            ]);

            if($request->hasFile('image')){
                $uploadPath = 'uploads/products/';

                $i=1;
                foreach($request->file('image') as $imageFile){
                    $extention = $imageFile->getClientOriginalExtension();
                    $fileName = time().$i++.'.'.$extention;
                    $imageFile->move($uploadPath ,$fileName);
                    $finalImagePathName = $uploadPath.$fileName;

                    $product->productImages()->create([
                        'product_id'=>$product->id,
                        'image'=>$finalImagePathName,
                      ]);

                }
               }
               return redirect('admin/products')->with('message','Product Updated Successfully');
        }
        else
        {
           return redirect('admin/products')->with('message','No Sush Product ID Found');
        }

    }
}
