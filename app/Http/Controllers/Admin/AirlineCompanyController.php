<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AirlineCompany;
use App\Http\Requests\AirlineCompanyRequest;
use Illuminate\Support\Facades\DB; // Import the DB facade

class AirlineCompanyController extends Controller
{
    //
    protected $airlineCompany;
    /**
     * constructor.
     */
    public function __construct(AirlineCompany $airlineCompany)
    {
        view()->share([
            'airline_company_active' => 'active',
            'data_airline_active' => 'active',
            'show_home' => AirlineCompany::SHOW_HOME
        ]);
        $this->airlineCompany = $airlineCompany;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //airline_companies;
        $airline_companies = AirlineCompany::select('*');
        if ($request->name) {
            $airline_companies->where('name', 'like', '%'.$request->name.'%')->orWhere('code_no', $request->name);
        }

        $airline_companies = $airline_companies->orderByDesc('id')->paginate(NUMBER_PAGINATION);
        return view('admin.airline_company.index', compact('airline_companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.airline_company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AirlineCompanyRequest $request)
    {
        //
        DB::beginTransaction();
        try {
            $this->airlineCompany->createOrUpdate($request);
            DB::commit();
            return redirect()->back()->with('success', 'Save Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $airlineCompany = AirlineCompany::findOrFail($id);

        if (!$airlineCompany) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.airline_company.edit', compact('airlineCompany'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AirlineCompanyRequest $request, $id)
    {
        //
        DB::beginTransaction();
        try {
            $this->airlineCompany->createOrUpdate($request, $id);
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
        $airlineCompany = AirlineCompany::find($id);
        if (!$airlineCompany) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $airlineCompany->delete();
            return redirect()->back()->with('success', 'Delete successfully');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
