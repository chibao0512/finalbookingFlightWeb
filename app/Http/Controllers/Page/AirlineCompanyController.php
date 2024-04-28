<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AirlineCompany;
use App\Models\Flight;
use Carbon\Carbon;

class AirlineCompanyController extends Controller
{
    //
    public function index(Request $request)
    {

        $timeNow = Carbon::now()->addHour(2);

        $flights = Flight::with(['start_location', 'end_location', 'plane' => function($query) {
            $query->with('airline_company');
        }])->where('start_day', '>=', $timeNow);

        $airline_company = null;
        if ($request->id) {

            $id = $request->id;

            $flights = $flights->whereIn('plane_id', function ($query) use($id) {
                $query->select('id')->from('planes')->where('airline_company_id', $id);
            });

            $airline_company = AirlineCompany::find($id);
        }

        $flights = $flights->orderBy('start_day')->paginate(12);
        $search = $request->all();

        $viewData = [
            'flights' => $flights,
            'query' => $request->query(),
            'search' => $search,
            'airline_company' => $airline_company
        ];

        return view('page.flight.index', $viewData);
    }
}
