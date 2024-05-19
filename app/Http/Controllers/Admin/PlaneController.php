<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plane;
use App\Models\AirlineCompany;
use App\Http\Requests\PlaneRequest;
use Illuminate\Support\Facades\DB;


class PlaneController extends Controller
{
    protected $plane;
    /**
     * constructor.
     */
    public function __construct(Plane  $plane)
    {
        view()->share([
            'plane_active' => 'active',
            'data_airline_active' => 'active',
            'airline_companies' => AirlineCompany::all(),
            'status' => $plane::STATUS,
            'classStatus' => $plane::CLASS_STATUS,

        ]);

        $this->plane = $plane;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //location;
        $planes = Plane::with('airline_company');

        if ($request->name) {
            $planes->where('name', 'like', '%'.$request->name.'%')->orWhere('code_no', $request->name);
        }

        $planes = $planes->orderByDesc('id')->paginate(NUMBER_PAGINATION);

        return view('admin.plane.index', compact('planes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.plane.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaneRequest $request)
    {
        //
        DB::beginTransaction();
        try {
            $this->plane->createOrUpdate($request);
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
        $plane = Plane::findOrFail($id);

        if (!$plane) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.plane.edit', compact('plane'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlaneRequest $request, $id)
    {
        //
        //
        DB::beginTransaction();
        try {
            $this->plane->createOrUpdate($request, $id);
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
        $plane = AirlineCompany::find($id);
        if (!$plane) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $plane->delete();
            return redirect()->back()->with('success', 'Delete Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
