<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function searchProduct(Request $request)
    {
        if($request->search)
        {
          $searchProduct = Product::where('name','LIKE','%'.$request->search.'%')->latest()->paginate(17);
          return view('admin.search-product',compact('searchProduct'));
        }else{
          return redirect()->back()->with('message','Empty Search');
        }

    }
}
