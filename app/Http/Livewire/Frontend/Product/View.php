<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $category , $product ,$productColorSelectedQuantity ,$quantityCount=1 ,$productColorId;

    public function addToWishList($productId)
    {
        $locale = app()->getLocale();
        if(Auth::check()){
            if(Wishlist::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists()){
                session()->flash('message','already added to wishlist');
                $this->dispatchBrowserEvent('message', [
                    'text' =>$locale=='en'? 'already added to wishlist':($locale=='ar'?'المنتج موجود في المفضله':''),
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
                    'text' =>$locale=='en'? 'Wishlist Added Successfully':($locale=='ar'?'تم الاضافه للمفضله':''),
                    'type' => 'success',
                    'status' => 200
                ]);

            }

        }else{
            session()->flash('message','please login to continue');
            $this->dispatchBrowserEvent('message', [
                'text' =>$locale=='en'? 'please login to add to cart':($locale=='ar'?'يرجى تسجيل الدخول أولا':''),
                'type' => 'warning',
                'status' => 401
            ]);
            return false;
        }
    }

    public function decrementQuantity()
    {
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }

    }

    public function incrementQuantity()
    {
        if($this->quantityCount < 10){
            $this->quantityCount++;
        }
    }

    public function colorSelected($productColorId)
    {
        $this->productColorId = $productColorId;
       $productColor = $this->product->productColors()->where('id',$productColorId)->first();
      $this->productColorSelectedQuantity= $productColor->quantity;

      if($this->productColorSelectedQuantity==0){
        $this->productColorSelectedQuantity='OutOfStock';
      }
    }

    public function addToCart(int $productId)
    {
        $locale = app()->getLocale();
       if(Auth::check())
       {

          if($this->product->where('id',$productId)->where('status','0')->exists())
          {

            if($this->product->productColors()->count() > 1)
            {
                if($this->productColorSelectedQuantity != NULL)
                {
                    if(Cart::where('user_id',auth()->user()->id)
                    ->where('product_id',$productId)
                    ->where('product_color_id',$this->productColorId)->exists())
                    {
                        $this->dispatchBrowserEvent('message', [
                            'text' =>$locale=='en'? 'Product Already Added' :'المنتج موجود في السله',
                            'type' => 'warning',
                            'status' => 200
                            ]);

                    }
                    else
                    {
                        $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                        if($productColor->quantity > 0)
                        {
                            if($productColor->quantity > $this->quantityCount)
                            {
                                Cart::create([
                                'user_id'=>auth()->user()->id,
                                'product_id'=> $productId,
                                'product_color_id'=> $this->productColorId,
                                'quantity'=> $this->quantityCount
                                ]);

                                $this->emit('CartAddedUpdated');

                                $this->dispatchBrowserEvent('message', [
                                'text' =>$locale=='en'? 'Product Added To Cart' : 'تم اضافة المنتج للسله',
                                'type' => 'success',
                                'status' => 200
                                ]);

                            }
                            else
                            {
                                $this->dispatchBrowserEvent('message', [
                                    'text' =>$locale=='en'? 'Only '.$productColor->quantity.' Quantity Avilable':($locale=='ar'?'فقط '.$productColor->quantity.' متوفره':''),
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }

                        }
                        else
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Out Of Stock',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    }


                }
                else
                {
                    $this->dispatchBrowserEvent('message', [
                        'text' =>$locale=='en'? 'Select Your Product Color' :'اختر لون المنتج',
                        'type' => 'info',
                        'status' => 404
                    ]);
                }

            }
            else
            {

                if(Cart::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists())
                {
                    $this->dispatchBrowserEvent('message', [
                        'text' => $locale=='en'? 'Product Already Added' :'المنتج موجود في السله',
                        'type' => 'warning',
                        'status' => 200
                    ]);
                }
                else
                {
                    if($this->product->quantity > 0)
                    {
                        if($this->product->quantity > $this->quantityCount)
                        {
                            Cart::create([
                                'user_id'=>auth()->user()->id,
                                'product_id'=> $productId,
                                'quantity'=> $this->quantityCount
                                ]);

                                $this->emit('CartAddedUpdated');

                                $this->dispatchBrowserEvent('message', [
                                'text' => $locale=='en'? 'Product Added To Cart' : 'تم اضافة المنتج للسله',
                                'type' => 'success',
                                'status' => 200
                                ]);
                        }
                        else
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => $locale=='en'? 'Only '.$this->product->quantity.' Quantity Avilable':($locale=='ar'?'فقط '.$this->product->quantity.' متوفره':''),
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }

                    }
                    else
                    {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Out Of Stock',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    }
               }
            }

          }
          else
          {
            $this->dispatchBrowserEvent('message', [
                'text' =>$locale=='en'? 'Product dose not exists':($locale=='ar'? 'المنتج غير متوفر':''),
                'type' => 'warning',
                'status' => 404
            ]);

          }

       }
       else
       {
        $this->dispatchBrowserEvent('message', [
                        'text' =>$locale=='en'? 'please login to add to cart':($locale=='ar'?'يرجى تسجيل الدخول أولا':''),
                        'type' => 'warning',
                        'status' => 404
                    ]);
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



