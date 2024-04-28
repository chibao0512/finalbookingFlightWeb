<?php
namespace App\Http\ViewComposer;

use Illuminate\View\View;
use App\Models\Category;
use App\Models\Article;

class SidebarNewComposer
{
    public function compose(View $view) {

        $categories = Category::with('news')->where(['status' => 1])->orderBy('id')->get();
        $articles = Article::with('user')->orderByDesc('id')->limit(12)->get();
        $view->with(['categories' => $categories, 'articles' => $articles]);

    }
}