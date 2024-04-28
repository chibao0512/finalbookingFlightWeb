<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AirlineCompany;
use App\Models\Article;
use App\Models\Airport;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $airlines = AirlineCompany::with(['planes' => function($query) {
            $query->with('flights')->where('status', 1);
        }])->where('show_home', 1)->orderBy('sort', 'DESC')->limit('6')->get();

        $articles = Article::with(['category', 'user'])->whereIn('category_id', function ($query) {
            $query->select('id')->from('categories')->where('status', 1);
        })->where(['status' => 1])->limit(16)->orderBy('id')->get();

        $airports = Airport::with('location')->limit(20)->orderBy('id')->get();

        $viewData = [
            'airlines' => $airlines,
            'articles' => $articles,
            'airports' => $airports,
        ];

        return view('page.home.index', $viewData);
    }
}
