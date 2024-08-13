<div>
    <x-slot name="title">
        Edit Department
    </x-slot>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Edit Department</h4>
            
            <form class="forms-sample" wire:submit='updateDepartment'>
              <div class="form-group">
                <label for="exampleInputUsername1">Department Name</label><br>
                @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                <input type="text" class="form-control" id="exampleInputUsername1" name="name" placeholder="Name" wire:model.live='name'>
              </div>
              <button type="submit" class="btn btn-primary me-2 text-white">Save Changes</button>
              <a href="{{route('admin.department')}}"wire:navigate class="btn btn-danger me-2 text-white">Cancel</a>
            </form>
          </div>
        </div>
      </div>
</div>
