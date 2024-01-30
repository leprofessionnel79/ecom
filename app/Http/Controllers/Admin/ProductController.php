<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(16);
        return view('admin.products.index',compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::where('status','0')->get();
        return view('admin.products.create',compact('categories','brands','colors'));
    }

    public function store(ProductFormRequest $request)
    {
       $locale = app()->getLocale();

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
           'featured'=>$request->featured == true?'1':'0',
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
       if($request->colors){
         foreach($request->colors as $key => $color){
            $product->productColors()->create([
                'product_id'=>$product->id,
                'color_id'=>$color,
                'quantity'=>$request->colorquantity[$key]?? 0
            ]);
         }
       }
       if($locale=='ar'){
        return redirect('admin/products')->with('message','تم إضافة المنتج بنجاح');
       }
       return redirect('admin/products')->with('message','Product Added Successfully');
    }

    public function edit($product_id)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::findOrFail($product_id);
        $product_color = $product->productColors->pluck('color_id')->toArray();
        $colors = Color::whereNotin('id',$product_color)->get();

        return view('admin.products.edit',compact('categories','brands','product','colors'));
    }

    public function update(ProductFormRequest $request ,$product_id)
    {
        $locale = app()->getLocale();

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
                'featured'=>$request->featured == true?'1':'0',
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

               if($request->colors){
                foreach($request->colors as $key => $color){
                   $product->productColors()->create([
                       'product_id'=>$product->id,
                       'color_id'=>$color,
                       'quantity'=>$request->colorquantity[$key]?? 0
                   ]);
                }
              }
              if($locale=='ar'){
                return redirect('admin/products')->with('message','تم تحديث المنتج بنجاح');
              }
               return redirect('admin/products')->with('message','Product Updated Successfully');
        }
        else
        {
            if($locale=='ar'){
                return redirect('admin/products')->with('message','لا يوجد رقم معرف مطابق لهذا المنتج');
            }
           return redirect('admin/products')->with('message','No Sush Product ID Found');
        }

    }

    public function destroyImage(int $product_image_id)
    {
        $locale = app()->getLocale();

        $productImage = ProductImage::findOrFail($product_image_id);
        if(File::exists($productImage->image))
        {
            File::delete($productImage->image);
        }
        $productImage->delete();

        if($locale=='ar'){
            return redirect()->back()->with('message','تم حذف صورة المنتج');
        }
        return redirect()->back()->with('message','Product Image Deleted');

    }

    public function destroy(int $product_id)
    {
        $locale = app()->getLocale();

        $product = Product::findOrFail($product_id);
        if($product->productImages){
            foreach($product->productImages as $image)
            {
                if(File::exists($image->image))
                {
                    File::delete($image->image);
                }
            }

        }
        $product->delete();

        if($locale=='ar'){
            return redirect()->back()->with('message','تم حذف المنتج مع كافة الصور المرفقه');
        }
        return redirect()->back()->with('message','Product Deleted With All Its Images');
    }

    public function updateProdColorQty(Request $request , $prod_color_id)
    {
        $locale = app()->getLocale();

        $productColorData = Product::findOrFail($request->product_id)
                     ->productColors()->where('id', $prod_color_id)->first();

        $productColorData->update([
          'quantity'=>$request->qty
        ]);

        if($locale=='ar'){
            return response()->json(['message'=>'تم تحديث الكميه']);
        }

        return response()->json(['message'=>'Product Color Qty Updated']);
    }

    public function deleteProdColor($prod_color_id)
    {
        $locale = app()->getLocale();

        $prodColor = ProductColor::findOrFail($prod_color_id);
        $prodColor->delete();

        if($locale=='ar'){
            return response()->json(['message'=>'تم الحذف بنجاح']);
        }
        return response()->json(['message'=>'Product Color Deleted']);
    }
}
