<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{
    //
    public function articles(Request $request)
    {
        $articles = Article::with('user');

        if ($request->keyword) {
            $articles->where('name', 'like', '%'.$request->keyword.'%');
        }

        $articles = $articles->orderBy('id')->paginate(12);

        $viewData = [
            'query' => $request->query(),
            'articles' => $articles,
        ];

        return view('page.category.index', $viewData);
    }

    public function index(Request $request, $id)
    {

        $category = Category::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        $articles = Article::with('user')->where('category_id', $id)->paginate(12);

        $viewData = [
            'query' => $request->query(),
            'category' => $category,
            'articles' => $articles,
        ];

        return view('page.category.index', $viewData);
    }

    public function articleDetail(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }
        $viewData = [
            'query' => $request->query(),
            'article' => $article,
        ];

        return view('page.category.detail', $viewData);
    }
}
