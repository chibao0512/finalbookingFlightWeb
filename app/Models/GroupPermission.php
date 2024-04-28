<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPermission extends Model
{
    //
    protected $table = 'group_permission';

    protected $fillable = [
        'name', 'description','created_at','updated_at'
    ];

    public function permissions() {
        return $this->hasMany(Permission::class, 'group_permission_id','id');
    }


}
