<?php
namespace App\Http\Controllers\Calendar;

use App\Http\Requests\CalendarRequest;
use App\Models\Routine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends \App\Http\Controllers\Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        return view('calendar.view');
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
    public function show($date){

        $routines = Routine::findForUser(Auth::user()->getAuthIdentifier(),$date,$date);
        return response()->json($routines);
    }


}