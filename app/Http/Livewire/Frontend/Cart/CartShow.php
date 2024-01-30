<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart , $totalPrice=0;

    public function decrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        $locale = app()->getLocale();

        if($cartData)
        {

            if($cartData->productColor()->where('id', $cartData->product_color_id)->exists())
            {
                $productColor =  $cartData->productColor()->where('id', $cartData->product_color_id)->first();


                if($cartData->quantity <= 1){
                    $this->dispatchBrowserEvent('message', [
                        'text' => $locale=='ar'?'الكميه لا يمكن أن تكون أقل من 1' :'Quantity cannot be less than 1',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
                else{
                    if($productColor->quantity >= $cartData->quantity)
                    {
                            $cartData->decrement('quantity');
                        $this->dispatchBrowserEvent('message', [
                        'text' =>$locale=='ar'? 'تم تحديث الكميه':'Quantity Updated',
                        'type' => 'success',
                        'status' => 200
                        ]);

                    }else
                    {
                        $this->dispatchBrowserEvent('message', [
                            'text' =>$locale=='en'? 'Only '.$productColor->quantity.' Quantity Available':($locale=='ar'?'فقط '.$productColor->quantity.' متوفره':''),
                            'type' => 'success',
                            'status' => 200
                            ]);
                    }
                }

            }else
            {
                if($cartData->quantity <= 1){

                    $this->dispatchBrowserEvent('message', [
                        'text' =>$locale=='ar'?'الكميه لا يمكن أن تكون أقل من 1' :'Quantity cannot be less than 1',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
                else{
                    if($cartData->product->quantity >= $cartData->quantity){
                        $cartData->decrement('quantity');
                        $this->dispatchBrowserEvent('message', [
                        'text' => $locale=='ar'? 'تم تحديث الكميه':'Quantity Updated',
                        'type' => 'success',
                        'status' => 200
                        ]);
                    }else{
                        $this->dispatchBrowserEvent('message', [
                            'text' =>$locale=='en'? 'Only '.$cartData->product->quantity.' Quantity Available':($locale=='ar'?'فقط '.$cartData->product->quantity.' متوفره':''),
                            'type' => 'success',
                            'status' => 200
                            ]);
                         }

                    }
              }

        }else
        {
            $this->dispatchBrowserEvent('message', [
                'text' => $locale=='en'? 'Something went wrong!!' :'حدث خطأما!!',
                'type' => 'error',
                'status' => 404
                ]);

        }
    }




    public function incrementQuantity(int $cartId)
    {
        $cartData = Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        $locale = app()->getLocale();

        if($cartData)
        {
            if($cartData->productColor()->where('id', $cartData->product_color_id)->exists())
            {
                $productColor =  $cartData->productColor()->where('id', $cartData->product_color_id)->first();
                if($productColor->quantity > $cartData->quantity)
                {
                        $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                    'text' => $locale=='ar'? 'تم تحديث الكميه':'Quantity Updated',
                    'type' => 'success',
                    'status' => 200
                    ]);

                }else
                {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only '.$productColor->quantity.' Quantity Available',
                        'type' => 'success',
                        'status' => 200
                        ]);
                }

            }else
            {
                if($cartData->product->quantity > $cartData->quantity){
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                    'text' => $locale=='ar'? 'تم تحديث الكميه':'Quantity Updated',
                    'type' => 'success',
                    'status' => 200
                    ]);
                }else{
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Only '.$cartData->product->quantity.' Quantity Available',
                            'type' => 'success',
                            'status' => 200
                            ]);
                    }
              }


        }else
        {
            $this->dispatchBrowserEvent('message', [
                'text' =>$locale=='en'? 'Something went wrong!!' :'حدث خطأما!!',
                'type' => 'error',
                'status' => 404
                ]);

        }
    }

    public function removeCartItem(int $cartId)
    {
        $cartRemoveData = Cart::where('user_id',auth()->user()->id)->where('id',$cartId)->first();
        $locale = app()->getLocale();

        if($cartRemoveData)
        {
            $cartRemoveData->delete();

            $this->emit('CartAddedUpdated');

            $this->dispatchBrowserEvent('message', [
            'text' =>$locale=='ar'?'تم إزالة الماده':($locale=='en'?'Cart Item Remved Successfully':''),
            'type' => 'success',
            'status' => 200
            ]);
        }else
        {
            $this->dispatchBrowserEvent('message', [
                'text' =>$locale=='en'? 'Something went wrong!!' :'حدث خطأما!!',
                'type' => 'error',
                'status' => 500
                ]);

        }
    }

    public function render()
    {
        $this->cart = Cart::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show',[
            'cart'=> $this->cart
        ]);
    }


}
