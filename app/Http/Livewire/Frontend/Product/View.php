<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category , $product ,$productColorSelectedQuantity;

    public function addToWishList($productId)
    {

        if(Auth::check()){
            if(Wishlist::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists()){
                session()->flash('message','already added to wishlist!!');
                return false;
            }else{
                Wishlist::create([
                    'user_id'=>auth()->user()->id,
                    'product_id'=>$productId,
                ]);
                session()->flash('message','Wishlist Added Successfully');
                
            }

        }else{
            session()->flash('message','please login to continue');
            return false;
        }
    }

    public function colorSelected($productColorId)
    {
       $productColor = $this->product->productColors()->where('id',$productColorId)->first();
      $this->productColorSelectedQuantity= $productColor->quantity;

      if($this->productColorSelectedQuantity==0){
        $this->productColorSelectedQuantity='OutOfStock';
      }
    }

    public function mount($category,$product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.view',[
            'category'=> $this->category,
            'product'=> $this->product
        ]);
    }
}
