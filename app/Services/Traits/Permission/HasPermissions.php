<?php

namespace App\Services\Traits\Permission;


use App\Models\Permission;

trait HasPermissions
{

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function givePermissionTo($permissions)
    {
        $permissions = $this->getAllPermission($permissions);

        if ($permissions->isEmpty()) return $this;

        $this->permissions()->syncWithoutDetaching($permissions);

    }

    public function refreshPermissionTo($permissions)
    {
        $permissions = $this->getAllPermission($permissions);

        if ($permissions->isEmpty()) return $this;

        $this->permissions()->sync($permissions);
    }

    public function detachPermissionTo($permissions)
    {
        $permissions = $this->getAllPermission($permissions);

        if ($permissions->isEmpty()) return $this;

        $this->permissions()->detach($permissions);
    }

    public function hasPermission($permission)
    {
        return $this->permissions->contains('name', $permission) ||
            $this->hasPermissionThroughRole($permission);
    }

    private function hasPermissionThroughRole($permission)
    {
        $roles = $this->roles;

        foreach ($this->getPermission($permission)->roles as $row) {
            if ($roles->contains('name', $row->name)) return true;
        }

        return false;
    }

    private function getPermission($permission)
    {
        return Permission::where('name', $permission)->first();
    }

    private function getAllPermission($permissions)
    {
        return Permission::whereIn('name', $permissions)->get();
    }
}
