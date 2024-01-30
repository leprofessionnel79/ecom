<?php

namespace App\Http\Livewire\Frontend;


use Livewire\Component;
use App\Models\Wishlist;

class WishlistShow extends Component
{
    public function removeWishlistItem(int $wishlistId)
    {
        $locale = app()->getLocale();

        Wishlist::where('user_id',auth()->user()->id)->where('id',$wishlistId)->delete();
        $this->emit('wishlistAddedUpdated');
        $this->dispatchBrowserEvent('message',[
           'text'=>$locale=='en'?'WishList Item Removed Successfully':($locale=='ar'?'تم إزالة المنتج من المفضله':''),
           'type'=> 'success',
           'status'=> 200
        ]);
    }

    public function render()
    {
        $wishlist = Wishlist::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show',[
            'wishlist'=>$wishlist]);
    }
}
