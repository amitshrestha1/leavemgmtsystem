<div>
    <x-slot name='title'>
        Create LeaveType
    </x-slot>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Create Leave Type</h4>
            
            <form class="forms-sample" wire:submit='createType'>
              <div class="form-group">
                <label for="exampleInputUsername1">Name</label>
                <input type="text" class="form-control" id="exampleInputUsername1" name="name" placeholder="Name"wire:model.live='name'>
              </div>
              <button type="submit" class="btn btn-primary me-2">Submit</button>
            </form>
          </div>
        </div>
      </div>
</div>
