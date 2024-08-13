<?php

namespace App\Livewire\Admin\RolesandPermission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class Permissionmanagement extends Component
{
    // use HasRoles;
    public $roles, $permissions;
    protected $listeners = ['checked'=>'assignrole','unchecked'=>'revokerole'];
    public function mount(){
        $this->roles = Role::where('name','!=','SuperAdmin')->get();
        $this->permissions = Permission::all();
    }

    public function assignrole($roleId, $permissionId)
    {
        $role = Role::find($roleId);
        $permission = Permission::find($permissionId);
    
        if ($role && $permission) {
            $role->givePermissionTo($permission);
            // session()->flash('success', 'Permission assigned to role successfully.');
        } else {
            // session()->flash('error', 'Role or permission not found.');
        }
    } 

    public function revokerole($roleId, $permissionId)
    {
        $role = Role::find($roleId);
        $permission = Permission::find($permissionId);
        if ($role && $permission) {
            $role->revokePermissionTo($permission);
            // session()->flash('success', 'Permission assigned to role successfully.');
        } else {
            // session()->flash('error', 'Role or permission not found.');
        }
    }

    public function render()
    {
        return view('livewire.admin.rolesand-permission.permissionmanagement');
    }
}
