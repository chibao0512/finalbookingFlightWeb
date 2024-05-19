<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    protected $category;
    /**
     * constructor.
     */
    public function __construct(Category  $category)
    {
        view()->share([
            'category_active' => 'active',
            'data_article_active' => 'active',
            'parents' => $category->getParents(),
            'status' => $category::STATUS,
            'show_home' => Category::SHOW_HOME
        ]);
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $categories = Category::with('parent');
        if ($request->name) {
            $categories->where('name', 'like', '%'.$request->name.'%');
        }
        $categories = $categories->orderByDesc('id')->paginate(NUMBER_PAGINATION);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        //
        DB::beginTransaction();
        try {
            $this->category->createOrUpdate($request);
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
        $category = Category::findOrFail($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        DB::beginTransaction();
        try {
            $this->category->createOrUpdate($request, $id);
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
        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $category->delete();
            return redirect()->back()->with('success', 'Delete succesfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
