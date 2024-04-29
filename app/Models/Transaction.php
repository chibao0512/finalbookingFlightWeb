<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    public $timestamps = true;

    const VNP_URL = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    const VNP_HASH_SECRET = "YVVVDXXUGTGPFEVRUBWEXKIIYNNFUUTZ";
    const VNP_TMN_CODE = "B6D7F86K";

    const STATUS = [
        1 => 'Processing',
        2 => 'Wait for payment',
        3 => 'Completly payment',
        4 => 'Cancelled',
        5 => 'Waiting for progressing'
    ];

    const CLASS_STATUS = [
        1 => 'btn-secondary',
        2 => 'btn-primary',
        3 => 'btn-success',
        4 => 'btn-danger',
    ];

    protected $fillable = [
        'flight_id',
        'user_id',
        'code_no',
        'name',
        'phone',
        'email',
        'adult',
        'children',
        'baby',
        'start_location_id',
        'end_location_id',
        'start_day',
        'end_day',
        'price',
        'baby_ticket',
        'expense',
        'tax_percentage',
        'ticket_class',
        'taxes_fees',
        'total_money',
        'status',
        'created_at',
        'updated_at',
    ];


    public function flight()
    {
        return $this->belongsTo(Flight::class, 'flight_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function start_location()
    {
        return $this->belongsTo(Location::class, 'start_location_id', 'id');
    }

    public function end_location()
    {
        return $this->belongsTo(Location::class, 'end_location_id', 'id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'transaction_id', 'id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'transaction_id', 'id');
    }

    /**
     * @param $request
     * @param string $id
     * @return mixed
     */
    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['_token']);

        if ($id) {
            return $this->find($id)->update($params);
        }
        return $this->create($params);
    }

}
