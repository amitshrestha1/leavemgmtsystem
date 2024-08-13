<div>
    <x-slot name='title'>
        Leave Entitlement
    </x-slot>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Entitlement</h4>

                <form class="forms-sample"wire:submit='create_entitlement'>
                    <div class="form-group">
                        <label for="userselect">Select User</label><br>
                        @error('user_id')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <select class="form-control select2"wire:model.live='user_id'>
                            <option disabled value="null" selected>Select User</option>
                            @foreach ($users as $item)
                                <option value='{{ $item->id }}'>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="userselect">Select Leave Type</label><br>
                        @error('leave_type_id')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <select class="form-control"wire:model.live='leave_type_id'>
                            <option disabled value="null" selected>Select Type</option>
                            @foreach ($leave_types as $item)
                                <option value='{{ $item->id }}'>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="days">Days</label><br>
                        @error('days')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control" id="exampleInputUsername1" name="name"
                            placeholder="Days"wire:model.live='days'>
                    </div>
                    <button type="submit" class="text-white btn btn-primary me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
