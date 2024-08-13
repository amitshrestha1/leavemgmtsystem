<div>
    <x-slot name='title'>
        Create Holiday
    </x-slot>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Create Holiday</h4>
            
            <form class="forms-sample" wire:submit='createHoliday'>
              <div class="form-group">
                <label for="exampleInputUsername1">Name</label><br>
                @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                <input type="text" class="form-control" id="exampleInputUsername1" name="name" placeholder="Name" wire:model.live='name'>
              </div>
              <div class="form-group">
                <label for="date">Date</label><br>
                @error('date') <span class="error text-danger">{{ $message }}</span> @enderror
                <input type="text"  class="form-control flatpickr" placeholder="Select a Date" name="date"wire:model.live='date'>
            </div>
              <button type="submit" class="btn btn-primary me-2 text-white">Submit</button>
            </form>
          </div>
        </div>
      </div>
</div>
@push('scripts')
  
@endpush