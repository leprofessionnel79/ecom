<div>

    <div wire:ignore.self class="modal delete_window" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{__('customlang.categoryDelete')}}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
              <form wire:submit.prevent="destroyCategory">

                <div class="modal-body">
                <h6>{{__('customlang.areYouSureYouWantToDeleteThisData')}}</h6>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('customlang.close')}}</button>
                <button type="submit" class="btn btn-primary">{{__('customlang.yesDelete')}}</button>
                </div>

            </form>

            </div>
        </div>
      </div>


    <div class="row">

        <div class="col-md-12">
        @if (session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
                <div class="card-header">
                    <h3>{{__('customlang.category')}}
                        <a href="{{url('admin/category/create')}}" class="btn btn-primary btn-sm float-end">{{__('customlang.addCategory')}}</a>
                    </h3>
                </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{__('customlang.name')}}</th>
                            <th>{{__('customlang.status')}}</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                            @foreach ( $categories as $category )
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->status=='1'?'Hidden':'Visible'}}</td>
                                <td>
                                    <a href="{{url('admin/category/'.$category->id.'/edit')}}" class="btn btn-success text-white">{{__('customlang.edit')}}</a>
                                    <a href="#" wire:click="deleteCategory({{$category->id}})" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger text-white">{{__('customlang.delete')}}</a>
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
                <div>
                    {{$categories->links()}}
                </div>

            </div>
        </div>
        </div>
    </div>
</div>

@push('script')

<script>

    window.addEventListener('close_modal',event =>{

       $('#deleteModal').modal('hide');
    });
</script>

@endpush
