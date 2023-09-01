<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistCount extends Component
{
    public $wishlistCount;

    

    protected $listeners = ['wishlistAddedUpdated' => 'checkWishlist'];

    public function checkWishlist()
    {
        if(Auth::check()){
           return $this->wishlistCount=Wishlist::where('user_id',auth()->user()->id)->count();
        }else{
            return $this->wishlistCount=0;
        }
    }
    public function render()
    {
       $this->wishlistCount=$this->checkWishlist();
        return view('livewire.frontend.wishlist-count',[
            'wishlistCount'=>$this->wishlistCount
        ]);
    }
}
