<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';

    public $timestamps = true;

    const ACTIVES = [
        1 => 'Xuất bản',
        2 => 'Bản nháp'
    ];
    protected $fillable = [
        'name',
        'slug',
        'show_home',
        'view',
        'description',
        'image',
        'contents',
        'category_id',
        'user_id',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @param $request
     * @param string $id
     * @return mixed
     */
    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['images', '_token']);
        if (isset($request->images) && !empty($request->images)) {
            $image = upload_image('images');
            if ($image['code'] == 1)
                $params['image'] = $image['name'];
        }
        $params['slug'] = Str::slug($request->name);
        $params['user_id'] = \Auth::user()->id;
        if ($id) {
            return $this->find($id)->update($params);
        }
        return $this->create($params);
    }
}
