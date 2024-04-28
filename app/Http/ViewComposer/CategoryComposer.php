<?php
namespace App\Http\ViewComposer;

use Illuminate\View\View;
use App\Models\Category;


class CategoryComposer
{
    public function compose(View $view) {

        $categories = Category::where(['status' => 1, 'show_home' => 1])->orderBy('id')->get();

        $view->with(['categories' => $categories]);
    }
}