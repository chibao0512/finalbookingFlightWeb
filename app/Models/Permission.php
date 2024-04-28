<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Shanmuga\LaravelEntrust\Models\EntrustPermission;

class Permission extends EntrustPermission
{
    use HasFactory;

    protected $table = 'permissions';
    protected $fillable = ['name', 'display_name', 'description', 'group_permission_id', 'created_at', 'updated_at'];

    public function groups()
    {
        return $this->belongsTo(GroupPermission::class, 'group_permission_id', 'id');
    }
}
