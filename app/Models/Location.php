<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'locations';
    public $timestamps = true;

    protected $fillable = [
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
}
