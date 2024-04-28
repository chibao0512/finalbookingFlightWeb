<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirlineCompany extends Model
{
    use HasFactory;

    protected $table = 'airline_companies';
    public $timestamps = true;

    protected $fillable = [
        'code_no',
        'name',
        'logo',
        'show_home',
        'sort',
        'status',
        'created_at',
        'updated_at',
    ];

    const SHOW_HOME = [
        0 => 'Ẩn',
        1 => 'Hiển thị'
    ];

    /**
     * @param $request
     * @param string $id
     * @return mixed
     */
    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['_token', 'images']);

        if ($request->images) {
            $image = upload_image('images');
            if ($image['code'] == 1)
                $params['logo'] = $image['name'];
        }

        if ($id) {
            return $this->find($id)->update($params);
        }
        return $this->create($params);
    }

    public function planes()
    {
        return $this->hasMany(Plane::class, 'airline_company_id', 'id');
    }
}
