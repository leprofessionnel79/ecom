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
       $validatedData= $request->validated();
       Color::create($validatedData);

       return redirect('admin/colors')->with('message','Color Added Successfully');
    }
}
