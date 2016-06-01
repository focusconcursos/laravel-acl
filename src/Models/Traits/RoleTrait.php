<?php

namespace Mahesvaran\LaravelAcl\Traits;

use Config;
use Mahesvaran\LaravelAcl\Models\Role;

trait RoleTrait
{

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getRoleListAttribute()
    {
        return $this->roles->lists('id')->all();
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        if ($role instanceof Role) {
            if ($this->hasRole($role->name)) {
                return true;
            }
        }
        foreach ($role as $r) {
            if ($this->hasRole($r->name)) {
                return true;
            }
        }
        return false;
    }

    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

    public function isSuperAdmin()
    {
        // put here your own logic here for super admin
        // ex:
        // return $this->email === 'superadmin@domain.com';
        return $this->hasRole(Config::get('role.SUPERADMIN'));
    }
}
