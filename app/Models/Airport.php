<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;
    protected $table = 'airports';
    public $timestamps = true;

    protected $fillable = [
        'location_id',
        'code_no',
        'name',
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
        $params = $request->except(['_token']);
        if ($id) {
            return $this->find($id)->update($params);
        }
        return $this->create($params);
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }
}
