<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    public $timestamps = true;


     const STATUS = [
         0 => 'Bản nháp',
         1 => 'Hiển thị'
     ];

    const SHOW_HOME = [
        0 => 'Ẩn',
        1 => 'Hiển thị'
    ];

    protected $fillable = ['name', 'parent_id', 'slug', 'status', 'show_home'];

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent(){
        return $this->hasOne(self::class, 'id', 'parent_id')->select('id', 'name');
    }

    public function getParents()
    {
        return $this->whereNull('parent_id')->orderByDesc('id')->get();
    }

    public function news()
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }

    /**
     * @param $request
     * @param string $id
     * @return mixed
     */
    public function createOrUpdate($request , $id ='')
    {
        $params = $request->except(['_token', 'submit']);
        $params['slug'] = Str::slug($request->name);
        if ($id) {
           return $this->find($id)->update($params);
        }
        return $this->create($params);
    }
}
