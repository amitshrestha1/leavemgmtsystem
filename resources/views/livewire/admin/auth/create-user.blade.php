<div>
    <x-slot name="title">
        Create User</x-slot>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Staff</h4>
                <form class="forms-sample" wire:submit='create_user' enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label><br>
                        @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control" id="exampleInputName1" name="name"
                            placeholder="Name" value="{{ old('name') }}" wire:model.live='name'>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label><br>
                        @error('email')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <input type="email" class="form-control" id="exampleInputEmail3" name="email"
                            placeholder="Email" value="{{ old('email') }}"wire:model.live='email'>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Password</label><br>
                        @error('password')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" placeholder="Password"
                                value="{{ old('password') }}" id="myInput"wire:model.live='password'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Confirm Password</label><br>
                        @error('password_confirmation')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <input type="password" class="form-control" id="myInput1" name="password_confirmation"
                            placeholder="Confirm Password" value="{{ old('password_confirmation') }}"
                            wire:model.live='password_confirmation'>
                    </div>
                    <div class="form-group">
                        <label>Profile Picture</label>
                        <div class="input-group col-xs-12">
                            <input class="form-control file-upload-info" placeholder="Upload Image" name="image"
                                type="file" id="image" accept="image/*" wire:model.live='image'>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Department</label><br>
                        @error('department_id')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <select class="form-control sb" id="selectbox" wire:model.live='department_id' id="department">
                            <option disabled value="null" selected>Select Department</option>
                            @foreach ($department as $dept)
                                <option value="{{ $dept->id }} ">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Role</label><br>
                        @error('role_id')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <select class="form-control" id="exampleSelectGender"wire:model.live='role_id'>
                            <option disabled value="null" selected>Select Role</option>
                            @foreach ($role as $role)
                                <option value="{{ $role->id }} ">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="text-white btn btn-primary me-2">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
   
@endpush
