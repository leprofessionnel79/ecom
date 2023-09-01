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
                session()->flash('message','already added to wishlist');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'already added to wishlist',
                    'type' => 'warning',
                    'status' => 409
                ]);
                return false;
            }else{
                Wishlist::create([
                    'user_id'=>auth()->user()->id,
                    'product_id'=>$productId,
                ]);
                $this->emit('wishlistAddedUpdated');
                session()->flash('message','Wishlist Added Successfully');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Wishlist Added Successfully',
                    'type' => 'success',
                    'status' => 200
                ]);

            }

        }else{
            session()->flash('message','please login to continue');
            $this->dispatchBrowserEvent('message', [
                'text' => 'please login to continue',
                'type' => 'info',
                'status' => 401
            ]);
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
