<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    public $timestamps = true;

    protected $fillable = [
        'transaction_id',
        'money',
        'notes',
        'vnp_response_code',
        'code_vnpay',
        'code_bank',
        'time',
        'created_at',
        'updated_at',
    ];
}
