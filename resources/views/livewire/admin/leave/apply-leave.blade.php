<div>
    <x-slot name='title'>
        Apply Leave
    </x-slot>
    @if (
        (Auth()->user()->role->name == 'Staff') |
            (Auth()->user()->role->name == 'Manager') |
            (Auth()->user()->role->name == 'Head Representative'))
        <div class="row">
            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Apply for Leave</h4>
                        <form class="forms-sample" wire:submit="applyLeave">
                            <div class="form-group">
                                <label for="exampleSelectGender">Leave Type</label><br>
                                @error('type_id')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                                <select class="form-control sb" name="type_id" id="leaveType" wire:model.live='type_id'>
                                    <option selected wire@disabled(true)>Select Type</option>
                                    @foreach ($type as $item)
                                        <option value='{{ $item->id }}'>{{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Type</label><br>
                                @error('typen')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                                <select class="form-control sb" id="typeSelect1" wire:model.live='typen'>
                                    <option disabled value="null" selected>Select Type</option>
                                    <option value="Half Leave">Half Leave</option>
                                    <option value="Full Leave">Full Leave</option>
                                </select>
                            </div>
                            <div class="form-floating">
                                @error('reason')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                                <textarea class="form-control" placeholder="Write your reason" name="reason" id="reason" wire:model.live="reason"></textarea>
                                <label for="floatingTextarea">Reason</label><br>
                            </div>
                            @if ($selected_type == 'Half Leave')
                                <div class="form-group">
                                    <label for="date">On</label><br>
                                    @error('from')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                    <input class="form-control flatpickr" type="text" placeholder="Select a Date"
                                        wire:model.blur='from'wire:change="hello">
                                </div>
                                <input type="hidden" wire:model.live="to" id="to">
                            @else
                                <div class="form-group">
                                    <label for="date">From</label><br>
                                    @error('from')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                    <input class="form-control flatpickr" type="text" placeholder="Select a Date"
                                        data-flatpickr wire:model.live='from'>
                                </div>
                                <div class="form-group">
                                    <label for="date">To</label><br>
                                    @error('to')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" class="form-control flatpickr" placeholder="Select a Date"
                                        name="to" wire:model.live="to">
                                </div>
                            @endif
                            <button class="btn btn-block btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Remaining Leave Days of user</h4>
                        <table class="table table-hover" id="leaveTable">
                            <thead>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>Remaining Days</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($remainingDays as $id => $leaveType)
                                    <tr>
                                        <td>{{ $leaveType['name'] }}</td>
                                        <td>
                                            {{ $leaveType['days'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Apply for Leave</h4>
                        <form class="forms-sample" wire:submit="applyleaveasAdmin">
                            <div class="form-group" wire:ignore>
                                <label for="exampleSelectGender">Apply on Behalf Of</label><br>
                                @error('user_id')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                                <select id="userSelect" class="form-control usersb"
                                    wire:change='updateId'>
                                    <option disabled value="null" selected>Select User</option>
                                    @foreach ($users as $item)
                                        <option value='{{ $item->id }}'>{{ $item->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Leave Type</label><br>
                                @error('type_id')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                                <select class="form-control sb" wire:model.live='type_id'>
                                    <option disabled value="null" selected>Select Type</option>
                                    @foreach ($type as $item)
                                        <option value='{{ $item->id }}'>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Type</label><br>
                                @error('typen')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                                <select class="form-control sb" id="typeSelect" wire:model.live='typen'>
                                    <option disabled value="null" selected>Select Type</option>
                                    <option value="Half Leave">Half Leave</option>
                                    <option value="Full Leave">Full Leave</option>
                                </select>
                            </div>
                            <div class="form-floating">
                                @error('reason')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                                <textarea class="form-control" placeholder="Write your reason" name="reason" id="reason"
                                    wire:model.live="reason"></textarea>
                                <label for="floatingTextarea">Reason</label><br>
                            </div>
                            @if ($selected_type == 'Half Leave')
                                <div class="form-group">
                                    <label for="date">On</label><br>
                                    @error('from')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                    <input class="form-control flatpickr" type="text" placeholder="Select a Date"
                                        data-flatpickr wire:model.blur='from' id="from"wire:change="hello">
                                </div>
                                <input type="hidden" wire:model.live="to" id="to">
                            @else
                                <div class="form-group">
                                    <label for="date">From</label><br>
                                    @error('from')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                    <input class="form-control flatpickr" type="text" placeholder="Select a Date"
                                        data-flatpickr wire:model.live='from' id="from">
                                </div>
                                <div class="form-group">
                                    <label for="date">To</label><br>
                                    @error('to')
                                        <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                    <input type="text" class="form-control flatpickr" placeholder="Select a Date"
                                        name="to" wire:model.live="to" id="to">
                                </div>
                            @endif

                            <div>
                                <button class="text-white btn btn-block btn-primary">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Remaining Leave Days of user</h4>
                        <table class="table table-hover" id="leaveTable">
                            <thead>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>Remaining Days</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($remainingDays1 as $id => $leaveType)
                                    <tr>
                                        <td>{{ $leaveType['name'] }}</td>
                                        <td>
                                            {{ $leaveType['days'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@push('scripts')
    <script>
        document.addEventListener('livewire:navigated',function(){
            $('.usersb').select2();
            $('.usersb').on('change',function(event){
                var array = [event.target.value];
                Livewire.dispatch("SelectedUser",
                array);
            });
        })
        // document.getElementById('userSelect').addEventListener('change', function() {
        //     // Get the selected option
        //     var selectedOption = this.options[this.selectedIndex];

        //     // Get the ID of the selected option
        //     var selectedOptionId = selectedOption.value;
        //     var selectedOptionIdArray = [selectedOptionId];

        //     // Log or use the selected ID as needed
        //     console.log(selectedOptionIdArray);
        //     Livewire.dispatch("SelectedUser",
        //         selectedOptionIdArray);
        // });
        document.getElementById("typeSelect").addEventListener('change', function() {
            // Get the selected option
            var selectedOption = this.options[this.selectedIndex];

            // Get the ID of the selected option
            var selectedOptionId = selectedOption.value;
            var selectedOptionIdArray = [selectedOptionId];

            // Log or use the selected ID as needed
            console.log(selectedOptionIdArray);
            Livewire.dispatch("SelectedType",
                selectedOptionIdArray);
        });
    </script>
    <script>
        document.getElementById("typeSelect1").addEventListener('change', function() {
            // Get the selected option
            var selectedOption = this.options[this.selectedIndex];

            // Get the ID of the selected option
            var selectedOptionId = selectedOption.value;
            var selectedOptionIdArray = [selectedOptionId];

            // Log or use the selected ID as needed
            console.log(selectedOptionIdArray);
            Livewire.dispatch("SelectedType",
                selectedOptionIdArray);
        });
    </script>
@endpush
