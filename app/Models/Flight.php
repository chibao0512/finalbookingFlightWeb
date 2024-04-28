<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $table = 'flights';
    public $timestamps = true;

    const STATUS = [
        1 => 'Hoạt động',
        2 => 'Tạm ngưng',
    ];

    const CLASS_STATUS = [
        1 => 'btn-success',
        2 => 'btn-default',
    ];

    protected $fillable = [
        'plane_id',
        'start_location_id',
        'start_airport_id',
        'end_location_id',
        'end_airport_id',
        'code_no',
        'start_day',
        'start_time',
        'end_day',
        'end_time',
        'price',
        'price_vip',
        'taxes_fees',
        'status',
        'type',
        'tax_percentage',
        'expense',
        'baby_ticket',
        'created_at',
        'updated_at',
    ];

    const TYPES = [
        1 => 'Một chiều',
        2 => 'Khứ hồi'
    ];

    const TICKET_CLASS = [
        1 => 'Vé thường',
        2 => 'Vé vip',
    ];

    /**
     * @param $request
     * @param string $id
     * @return mixed
     */
    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['_token', 'images']);

        if ($id) {
            return $this->find($id)->update($params);
        }
        return $this->create($params);
    }

    public function plane()
    {
        return $this->belongsTo(Plane::class, 'plane_id', 'id');
    }

    public function start_location()
    {
        return $this->belongsTo(Location::class, 'start_location_id', 'id');
    }

    public function end_location()
    {
        return $this->belongsTo(Location::class, 'end_location_id', 'id');
    }

    public function start_airport()
    {
        return $this->belongsTo(Airport::class, 'start_airport_id', 'id');
    }

    public function end_airport()
    {
        return $this->belongsTo(Airport::class, 'end_airport_id', 'id');
    }
}
