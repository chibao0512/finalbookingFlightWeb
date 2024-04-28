<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    use HasFactory;

    protected $table = 'planes';
    public $timestamps = true;

    const STATUS = [
        1 => 'Hoạt động',
        2 => 'Bảo trì',
        3 => 'Đã bị hỏng'
    ];

    const CLASS_STATUS = [
        1 => 'btn-success',
        2 => 'btn-warning',
        3 => 'btn-danger',
    ];

    protected $fillable = [
        'airline_company_id',
        'code_no',
        'name',
        'number_seats',
        'number_seats_vip',
        'content',
        'status',
        'created_at',
        'updated_at',
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

    public function airline_company()
    {
        return $this->belongsTo(AirlineCompany::class,'airline_company_id', 'id');
    }

    public function flights()
    {
        return $this->hasMany(Flight::class, 'plane_id', 'id');
    }
}
