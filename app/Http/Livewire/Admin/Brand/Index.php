<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use Illuminate\Support\Str;

class Index extends Component
{
    public $name,$slug,$status;


    public function rules()
    {
        return [
         'name'=>'required|string',
         'slug'=>'required|string',
         'status'=>'nullable'
        ];
    }

    public function resetInput()
    {
        $this->name = null;
        $this->slug = null;
        $this->status = null;

    }
    public function storeBrand()
    {
        $validatedData = $this->validate();
        Brand::create([
            'name'=>$this->name,
            'slug'=>Str::slug($this->slug),
            'status'=>$this->status == true ? '1':'0',
        ]);
        session()->flash('message','Brand Added Successfully');
        $this->dispatchBrowserEvent('close_modal');
        $this->resetInput();
    }
    public function render()
    {
        return view('livewire.admin.brand.index')
                      ->extends('layouts.admin')
                      ->section('content');
    }
}
