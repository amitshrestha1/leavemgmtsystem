<div>
    <x-slot name="title">
        Create Department
    </x-slot>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Create Department</h4>
            
            <form class="forms-sample"wire:submit='create_department'>
              <div class="form-group">
                <label for="exampleInputUsername1">Department Name</label><br>
                @error('department_id') <span class="error text-danger">{{ $message }}</span> @enderror
                <input type="text" class="form-control" id="exampleInputUsername1" name="name" placeholder="Name" value="{{ old('name') }}"wire:model.live='name'>
              </div>
              <button type="submit" class="text-white btn btn-primary me-2">Submit</button>
            </form>
          </div>
        </div>
      </div>
</div>

