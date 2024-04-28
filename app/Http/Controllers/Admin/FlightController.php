<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Plane;
use App\Models\Location;
use App\Models\Airport;
use App\Http\Requests\FlightRequest;
use Carbon\Carbon;

class FlightController extends Controller
{
    protected $flight;
    /**
     * constructor.
     */
    public function __construct(Flight  $flight)
    {
        view()->share([
            'flight_active' => 'active',
            'data_airline_active' => 'active',
            'planes' => Plane::where('status', 1)->get(),
            'locations' => Location::all(),
            'airports' => Airport::all(),
            'status' => $flight::STATUS,
            'classStatus' => $flight::CLASS_STATUS,
            'types' => $flight::TYPES

        ]);

        $this->flight = $flight;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $flights = Flight::with(['plane' => function($query) {
            $query->with('airline_company');
        }, 'start_location', 'end_location', 'start_airport', 'end_airport']);

        if ($request->code_no) {
            $flights->where('code_no', $request->code_no);
        }

        if ($request->start_day) {
            $start_day = Carbon::parse($request->start_day)->startOfDay();
            $flights->where('start_day', '>=', $start_day);
        }

        if ($request->end_day) {
            $end_day = Carbon::parse($request->end_day)->endOfDay();
            $flights->where('end_day', '<=', $end_day);
        }

        $flights = $flights->orderByDesc('id')->paginate(NUMBER_PAGINATION);


        return view('admin.flight.index', compact('flights'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.flight.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlightRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $this->flight->createOrUpdate($request);
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
        $flight = Flight::findOrFail($id);

        if (!$flight) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.flight.edit', compact('flight'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FlightRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $this->flight->createOrUpdate($request, $id);
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
        $flight = Flight::findOrFail($id);

        if (!$flight) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $flight->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
