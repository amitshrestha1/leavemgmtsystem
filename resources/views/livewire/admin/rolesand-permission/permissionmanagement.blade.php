<div>

    <x-slot name='title'>
        Roles and Permissions
    </x-slot>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-secondary justify-content-between">
                        <h4 class="">Roles And Permission</h4>
                    </ol>
                </nav>
                <div class="pt-3 table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>
                                    Role
                                </th>
                                @foreach ($permissions as $permission)
                                    <th>
                                        {{$permission->name}} Permission
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                               <td>
                                {{$role->name}}
                               </td>
                               @foreach ($permissions as $permission)
                                    <th>
                                        <input type="checkbox" data-role="{{$role->id}}"{{$role->hasPermissionTo($permission->name) ? 'checked': ''}} data-permission="{{$permission->id}}">
                                    </th>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    
    // Add event listener to each checkbox
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const roleId = this.getAttribute('data-role');
            const permissionId = this.getAttribute('data-permission');
            if (this.checked) {
                Livewire.dispatch('checked', {roleId: roleId, permissionId: permissionId});
            } else {
                Livewire.dispatch('unchecked', {roleId: roleId, permissionId: permissionId});
            }
        });
    });
    </script>
@endpush
