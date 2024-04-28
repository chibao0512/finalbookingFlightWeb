<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChangeLanguageController extends Controller
{
    //
    public function changeLanguage($language)
    {
        Session::put('language', $language);
        return redirect()->back();
    }
}
