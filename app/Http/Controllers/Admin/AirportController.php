<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\Location;
use App\Http\Requests\AirportRequest;

class AirportController extends Controller
{
    //
    protected $airport;
    /**
     * constructor.
     */
    public function __construct(Airport $airport, Location $location)
    {
        view()->share([
            'airport_active' => 'active',
            'data_location_active' => 'active',
            'locations' => $location::all(),

        ]);
        $this->airport = $airport;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //airport;
        $airports = Airport::with('location');
        if ($request->name) {
            $airports->where('name', 'like', '%'.$request->name.'%')->orWhere('code_no', $request->name);
        }

        $airports = $airports->orderByDesc('id')->paginate(NUMBER_PAGINATION);
        return view('admin.airport.index', compact('airports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.airport.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AirportRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $this->airport->createOrUpdate($request);
            \DB::commit();
            return redirect()->back()->with('success', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
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
        $airport = Airport::findOrFail($id);

        if (!$airport) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.airport.edit', compact('airport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AirportRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $this->airport->createOrUpdate($request, $id);
            \DB::commit();
            return redirect()->back()->with('success', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
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
        $airport = Airport::find($id);
        if (!$airport) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $airport->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }

    public function getByLocation(Request $request)
    {
        if ($request->ajax()) {
            $location_id = $request->location_id;
            $type = $request->type;

            $airports = Airport::where('location_id', $location_id)->get();

            $html = view("admin.airport.location", compact('airports', 'type'))->render();

            return response([
                'html' => $html,
                'type' => $type,
                'code' => 200
            ]);
        }
    }
}
