<?php

namespace App\Http\ViewComposer;
use Illuminate\View\View;
use App\Models\Location;
use App\Models\Flight;
use App\Models\AirlineCompany;
use App\Models\User;


class LocationComposer
{
    public function compose(View $view)
    {
        $types = Flight::TYPES;
        $locations = Location::all();
        $airlines = AirlineCompany::all();
        $number_user = User::where(['type' => User::TYPE_USER, 'status' => User::ACTIVE])->count();
        $number_location = $locations->count();
        $number_airlines = $airlines->count();
        $ticket_class = Flight::TICKET_CLASS;

        $view->with(['locations' => $locations, 'number_location' => $number_location, 'types' => $types, 'airlines' => $airlines, 'number_airlines' => $number_airlines, 'number_user' => $number_user, 'ticket_class' => $ticket_class]);
    }
}