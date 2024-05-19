<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;


class ArticleContrller extends Controller
{
    protected $article;
    /**
     * constructor.
     */
    public function __construct(Article  $article, Category $category)
    {
        view()->share([
            'article_active' => 'active',
            'data_article_active' => 'active',
            'actives' => $article::ACTIVES,
            'categories' => $category::get(),
        ]);
        $this->article = $article;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $articles = Article::with(['category', 'user']);

        if ($request->name) {
            $articles->where('name', 'like', '%'.$request->name.'%');
        }

        $articles = $articles->orderByDesc('id')->paginate(NUMBER_PAGINATION);

        return view('admin.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        //
        DB::beginTransaction();
        try {
            $this->article->createOrUpdate($request);
            DB::commit();
            return redirect()->back()->with('success', 'Save Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $article = Article::findOrFail($id);

        if (!$article) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        //
        DB::beginTransaction();
        try {
            $this->article->createOrUpdate($request, $id);
            DB::commit();
            return redirect()->back()->with('success', 'Save Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $article = Article::findOrFail($id);
        if (!$article) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $article->delete();
            return redirect()->back()->with('success', 'Delete succesfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
