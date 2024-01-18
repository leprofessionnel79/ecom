<div wire:ignore.self class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('customlang.addBrand')}}</h5>
          <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form wire:submit.prevent="storeBrand">
            <div class="modal-body">
                <div class="mb-3">
                    <label>{{__('customlang.selectCategory')}}</label>
                    <select wire:model.defer="category_id" required class="form-control">
                        <option value="">--{{__('customlang.selectCategory')}}--</option>
                        @foreach ($categories as $catItem )
                        <option value="{{$catItem->id}}">{{$catItem->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                     <small class="text-anger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                  <label>{{__('customlang.brandName')}}</label>
                  <input type="text" wire:model.defer="name" class="form-control">
                  @error('name')
                   <small class="text-danger">{{$message}}</small>
                  @enderror
                </div>
                <div class="mb-3">
                    <label>{{__('customlang.brandSlug')}}</label>
                    <input type="text" wire:model.defer="slug" class="form-control">
                    @error('slug')
                     <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>{{__('customlang.status')}}</label><br/>
                    <input type="checkbox" wire:model.defer="status" /> Checked={{__('customlang.hidden')}} , Unchecked={{__('customlang.visiable')}}
                    @error('status')
                     <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">{{__('customlang.close')}}</button>
            <button type="submit" class="btn btn-primary">{{__('customlang.save')}}</button>
            </div>
        </form>
      </div>
    </div>
  </div>

{{-- // Brand Update Modal --}}
  <div wire:ignore.self class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('customlang.updateBrand')}}</h5>
          <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div wire:loading class="p-2">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">{{__('customlang.loading...')}}</span>
              </div>{{__('customlang.loading...')}}
        </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="updateBrand">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>{{__('customlang.selectCategory')}}</label>
                            <select wire:model.defer="category_id" required class="form-control">
                                <option value="">--{{__('customlang.selectCategory')}}--</option>
                                @foreach ($categories as $catItem )
                                <option value="{{$catItem->id}}">{{$catItem->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                             <small class="text-anger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                        <label>{{__('customlang.brandName')}}</label>
                        <input type="text" wire:model.defer="name" class="form-control">
                        @error('name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label>{{__('customlang.brandSlug')}}</label>
                            <input type="text" wire:model.defer="slug" class="form-control">
                            @error('slug')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>{{__('customlang.status')}}</label><br/>
                            <input type="checkbox" wire:model.defer="status" style="with=70px;height=70px;"/> Checked={{__('customlang.hidden')}} , Unchecked={{__('customlang.visiable')}}
                            @error('status')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">{{__('customlang.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('customlang.update')}}</button>
                    </div>
                </form>
            </div>
      </div>
    </div>
  </div>

  <div wire:ignore.self class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('customlang.deleteBrand')}}</h5>
          <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div wire:loading class="p-2">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">{{__('customlang.loading...')}}</span>
              </div>{{__('customlang.loading...')}}
        </div>
            <div wire:loading.remove>
                <form wire:submit.prevent="destroyBrand">
                    <div class="modal-body">
                        <h4>{{__('customlang.areYouSureYouWantDelete')}}</h4>
                    </div>
                    <div class="modal-footer">
                    <button type="button" wire:click="closeModal" class="btn btn-secondary" data-bs-dismiss="modal">{{__('customlang.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('customlang.yesDelete')}}</button>
                    </div>
                </form>
            </div>
      </div>
    </div>
  </div>


