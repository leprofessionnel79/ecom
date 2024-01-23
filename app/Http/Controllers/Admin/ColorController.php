<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;
use App\Models\Color;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.colors.index',compact('colors'));
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(ColorFormRequest $request )
    {
        $locale = app()->getLocale();

       $validatedData= $request->validated();
       $validatedData['status']= $request->status == true?'1':'0';

       Color::create($validatedData);

       if($locale=='ar'){
        return redirect('admin/colors')->with('message','تم إضافة اللون بنجاح');
       }
       return redirect('admin/colors')->with('message','Color Added Successfully');
    }

    public function edit(Color $color)
    {

         return view('admin.colors.edit',compact('color'));
    }

    public function update(ColorFormRequest $request,$color_id)
    {
        $locale = app()->getLocale();

        $validatedData= $request->validated();
        $validatedData['status']= $request->status == true?'1':'0';
        Color::find($color_id)->update($validatedData);

        if($locale=='ar'){
            return redirect('admin/colors')->with('message','تم تحديث اللون بنجاح');
           }
        return redirect('admin/colors')->with('message','Color Updated Successfully');
    }

    public function destroy($color_id)
    {
        $locale = app()->getLocale();

        $color = Color::findOrFail($color_id);
        $color->delete();

        if($locale=='ar'){
            return redirect('admin/colors')->with('message','تم حذف اللون بنجاح');
           }
        return redirect('admin/colors')->with('message','Color Deleted Successfully');
    }
}
