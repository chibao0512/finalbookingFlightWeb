<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    public $timestamps = true;

    protected $fillable = [
        'transaction_id',
        'transport_id',
        'flight_id',
        'code_no',
        'gender',
        'type',
        'name',
        'card',
        'seats',
        'birthday',
        'transport_price',
        'transport_weight',
        'type',
        'status',
        'created_at',
        'updated_at',
    ];

    public function flight()
    {
        return $this->belongsTo(Flight::class, 'flight_id', 'id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    public function transport()
    {
        return $this->belongsTo(Transport::class, 'transport_id', 'id');
    }
}
