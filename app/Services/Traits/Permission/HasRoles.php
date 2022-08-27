<?php

namespace App\Services\Traits\Permission;


use App\Models\Role;

trait HasRoles
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function giveRoleTo($roles)
    {
        $roles = $this->getAllRoles($roles);

        if ($roles->isEmpty()) return $this;

        $this->roles()->syncWithoutDetaching($roles);

    }

    public function refreshRoleTo($roles)
    {
        $roles = $this->getAllRoles($roles);

        if ($roles->isEmpty()) return $this;

        $this->roles()->sync($roles);
    }

    public function detachRoleTo($roles)
    {

        $roles = $this->getAllRoles($roles);

        if ($roles->isEmpty()) return $this;

        $this->roles()->detach($roles);

    }

    public function hasRole($role)
    {
        return $this->roles->contains('name', $role);
    }

    private function getAllRoles($roles)
    {
        return Role::whereIn('name', $roles)->get();
    }
}
