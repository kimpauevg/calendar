<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Requests\CalendarRequest;
use App\Models\Routine;
use Illuminate\Http\Request;
use \App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiCalendarController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function store(CalendarRequest $request){
        $routine = new Routine(array_merge($request->post(),[
            'user_id'=>Auth::user()->getAuthIdentifier()
        ]));
        if ($routine->save()){
            return response(null,204);
        }
        else {
            return response(null,203);
        }
    }
    public function get(){
        $routines = Routine::findForUser(Auth::user()->getAuthIdentifier());
        return response()->json($routines);
    }

    //
}
