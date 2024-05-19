<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Http\Requests\LocationRequest;
use Illuminate\Support\Facades\DB;


class LocationController extends Controller
{
    protected $location;
    /**
     * constructor.
     */
    public function __construct(Location  $location)
    {
        view()->share([
            'location_active' => 'active',
            'data_location_active' => 'active',
        ]);
        $this->location = $location;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //location;
        $locations = Location::select('*');
        if ($request->name) {
            $locations->where('name', 'like', '%'.$request->name.'%')->orWhere('code_no', $request->name);
        }

        $locations = $locations->orderByDesc('id')->paginate(NUMBER_PAGINATION);
        return view('admin.location.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocationRequest $request)
    {
        //
        DB::beginTransaction();
        try {
            $this->location->createOrUpdate($request);
            DB::commit();
            return redirect()->back()->with('success', 'Create new data successfully');
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
        $location = Location::findOrFail($id);

        if (!$location) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.location.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocationRequest $request, $id)
    {
        //
        DB::beginTransaction();
        try {
            $this->location->createOrUpdate($request, $id);
            DB::commit();
            return redirect()->back()->with('success', 'Update data successfully');
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
        $location = Location::find($id);
        if (!$location) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $location->delete();
            return redirect()->back()->with('success', 'Delete Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
