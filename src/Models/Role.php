<?php

namespace Mahesvaran\LaravelAcl\Models;

use Illuminate\Database\Eloquent\Model;
use Mahesvaran\LaravelAcl\Models\Permission;

class Role extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
    public function getPermissionListAttribute()
    {
        return $this->permissions->lists('id')->all();
    }
    public function givePermissionTo(Permission $permission)
    {
        return $this->permissions()->save($permission);
    }
}
