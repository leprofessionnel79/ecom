<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFormRequest;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(SliderFormRequest $request)
    {
        $locale = app()->getLocale();

        $validatedData = $request->validated();

        if($request->hasFile('image')){
          $file = $request->file('image');
          $ext = $file->getClientOriginalExtension();
          $fileName = time().'.'.$ext;
          $file->move('uploads/sliders/',$fileName);
          $validatedData['image']="uploads/sliders/$fileName";
        }

        $validatedData['status']=$request->status == true ?'1':'0';

        Slider::create([
          'title'=>$validatedData['title'],
          'description'=>$validatedData['description'],
          'image'=>$validatedData['image'],
          'status'=>$validatedData['status'],
        ]);

        if($locale=='ar'){
            return redirect('admin/sliders')->with('message','تم إضافة السلايد بنجاح');
        }
        return redirect('admin/sliders')->with('message','Slider Added Successfully');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit',compact('slider'));
    }

    public function update(SliderFormRequest $request,Slider $slider )
    {
        $locale = app()->getLocale();

        $validatedData = $request->validated();

        if($request->hasFile('image')){

          $dstination = $slider->image;
          if(File::exists($dstination)){
             File::delete($dstination);
          }
          $file = $request->file('image');
          $ext = $file->getClientOriginalExtension();
          $fileName = time().'.'.$ext;
          $file->move('uploads/sliders/',$fileName);
          $validatedData['image']="uploads/sliders/$fileName";
        }

        $validatedData['status']=$request->status == true ?'1':'0';

        Slider::where('id',$slider->id)->update([
          'title'=>$validatedData['title'],
          'description'=>$validatedData['description'],
          'image'=>$validatedData['image'] ?? $slider->image,
          'status'=>$validatedData['status'],
        ]);

        if($locale=='ar'){
            return redirect('admin/sliders')->with('message','تم تحديث السلايد بنجاح');
        }
        return redirect('admin/sliders')->with('message','Slider Updated Successfully');
    }

    public function destroy(Slider $slider)
    {
        $locale = app()->getLocale();
        if($slider->count()>0){
            $dstination = $slider->image;
            if(File::exists($dstination)){
               File::delete($dstination);
            }

            $slider->delete();

            if($locale=='ar'){
             return redirect('admin/sliders')->with('message','تم حذف السلايد بنجاح');
            }
            return redirect('admin/sliders')->with('message','Slider Deleted Successfully');

        }
        return redirect('admin/sliders')->with('message','Somthin went wrong');

    }
}
