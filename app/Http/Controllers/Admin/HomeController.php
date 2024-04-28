<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use App\Models\Transaction;
use App\Models\Flight;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        view()->share([
            'home_active' => 'active',
            'status' => Transaction::STATUS,
            'classStatus' => Transaction::CLASS_STATUS,

        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $number_user = User::where('type', 2)->count('id');
        $number_article = Article::count();

        $start_date = Carbon::now()->startOfDay();
        $end_date = Carbon::now()->endOfDay();

        $transaction_day = Transaction::whereBetween('updated_at', [$start_date, $end_date])->count();
        $flight_day = Flight::whereBetween('start_day', [$start_date, $end_date])->count();

        $month = $request->select_month ? $request->select_month : date('m');
        $year = $request->select_year ? $request->select_year : date('Y');

        // Doanh thu ngày
        $totalMoneyDay = Transaction::whereDay('created_at', date('d'))->whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->where('status', 3)
            ->sum('total_money');

        $mondayLast = Carbon::now()->startOfWeek();
        $sundayFirst = Carbon::now()->endOfWeek();
        $totalMoneyWeed = Transaction::whereBetween('created_at',[$mondayLast,$sundayFirst])
            ->where('status', 3)
            ->sum('total_money');


        // doanh thu thag
        $totalMoneyMonth = Transaction::whereMonth('created_at',$month)->whereYear('created_at', $year)
            ->where('status', 3)
            ->sum('total_money');

        // doanh thu nam
        $totalMoneyYear = Transaction::whereYear('created_at',date('Y'))
            ->where('status', 3)
            ->sum('total_money');

        $transactions = Transaction::with(['flight' => function ($query) {
            $query->with('plane');
        }, 'start_location', 'end_location', 'tickets', 'payment'])->whereIn('status', [1, 3, 5])->orderByDesc('id')->limit(15)->get();

        $viewData = [
            'number_user' => $number_user,
            'number_article' => $number_article,
            'totalMoneyDay' => $totalMoneyDay,
            'totalMoneyWeed' => $totalMoneyWeed,
            'totalMoneyMonth' => $totalMoneyMonth,
            'totalMoneyYear' => $totalMoneyYear,
            'transaction_day' => $transaction_day,
            'flight_day' => $flight_day,
            'transactions' => $transactions,
        ];
        return view('admin.home.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
