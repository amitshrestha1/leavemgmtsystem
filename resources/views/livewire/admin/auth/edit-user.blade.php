<div>
    <x-slot name="title">
        Edit User
    </x-slot>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Staff</h4>
                <form class="forms-sample" wire:submit='updateUser' enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label><br>
                        @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control" name="name" placeholder="Name"wire:model.live='name'>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label><br>
                        @error('email')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <input type="email" class="form-control" id="exampleInputEmail3" name="email"
                            placeholder="Email"wire:model.live='email'>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Password</label><br>
                        @error('password')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <input type="password" class="form-control" id="exampleInputPassword4"
                            placeholder="Password"wire:model.live='password'>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Confirm Password</label><br>
                        @error('password_confirmation')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <input type="password" class="form-control" id="exampleInputPassword4"
                            name="password_confirmation" placeholder="Password"wire:model.live='password_confirmation'>
                    </div>
                    <div class="form-group">
                        <label>Profile Picture</label><br>
                        @error('image')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
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
                        <select class="form-control" id="exampleSelectGender"wire:model.live='department_id'>
                            <option disabled value="null">Select Department</option>
                            @foreach ($department as $name)
                                <option value={{ $name->id }}>{{ $name->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Role</label><br>
                        @error('role_id')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror
                        <select class="form-control" id="exampleSelectGender"wire:model.live='role_id'>
                            <option disabled value="null">Select Role</option>
                            @foreach ($role as $role)
                                <option value={{ $role->id }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                    <a class="btn btn-danger me-2" href="{{route('admin.user')}}"wire:navigate>Cancel</a>
                </form>
            </div>
            
        </div>
