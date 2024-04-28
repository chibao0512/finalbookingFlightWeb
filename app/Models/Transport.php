<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;
    protected $table = 'transports';
    public $timestamps = true;

    protected $fillable = [
        'airline_company_id',
        'title',
        'price',
        'weight',
        'created_at',
        'updated_at',
    ];

}
