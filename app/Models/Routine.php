<?php

namespace App\Models;
use App\Models\RoutineNames;
use \App\Models\UserRoutines;
use App\Models\Interfaces\Routinable;
use Illuminate\Support\Facades\Validator;

class Routine implements Routinable
{

    public function __construct($array = null)
    {
        if ($array){
            $this->user_id = $array['user_id'];
            $this->name = $array['name'];
            $this->time_start = $array['time_start'];
            $this->time_stop = $array['time_stop'];
            $this->date = $array['date'];
        }

    }
    public function validate(){
        Validator::make(

        );
    }

    public $user_id;
    public $name;
    public $time_start;
    public $time_stop;
    public $date;

    public static function findForUser($user,$date_start = null,$date_stop = null): array
    {
        $all_routines = UserRoutines::where('user_id',$user);
        if (isset($date_start)) $all_routines->where('routines_date','>=',$date_start);
        if (isset($date_stop)) $all_routines->where('routines_date','<=',$date_stop);
        $routine_info = $all_routines->get()->toArray();
        if ($all_routines){
            $routine_ids = array_column($routine_info,'routine_ids');
            $routine_ids = array_map(function ($id_row){
                return explode(',',$id_row);
            },$routine_ids);

            $actual_ids = [];

            array_walk_recursive($routine_ids,function ($id) use (&$actual_ids) {

                $actual_ids[]= $id;
            });

            $actual_ids = array_unique($actual_ids);
            $routine_names = RoutineNames::find($actual_ids,['id','name'])->toArray();
            $result = self::toFormat($routine_info,$routine_names);
            return $result;

        }
        return [];
    }
    public function save($name_id = false)
    {

        if (!$name_id) {
            $routine_name = RoutineNames::where('name',$this->name)->first();
            if (!$routine_name){
                $routine_name = new RoutineNames();
                $routine_name->name = $this->name;
                $routine_name->save();
            }
            $name_id = $routine_name->id;
        }
        $routine_of_user = UserRoutines::where('user_id',$this->user_id)->where('routines_date',$this->date)->first();
        if (!$routine_of_user) {
            $routine_of_user = new UserRoutines();
            $routine_of_user->user_id = $this->user_id;
            $routine_of_user->routine_ids = $name_id;
            $routine_of_user->routines_time = $this->time_start.'-'.$this->time_stop;
            $routine_of_user->routines_date = $this->date;
        } else {
            $routine_of_user->routine_ids .= ','.$name_id;
            $routine_of_user->routines_time .= ','.$this->time_start.'-'.$this->time_stop;
        }
        if ($routine_of_user->save()) {
            return true;
        } else {
            return false;
        }

    }
    private static function toFormat($array_of_ids, $array_of_names){
        $resulting_array = [];
        foreach ($array_of_ids as $element){
            $ids_at_date = explode(',',$element['routine_ids']);
            $ids_time = array_map(function ($time_pair){
                return explode('-',$time_pair);
            },explode(',',$element['routines_time']));
            $array_of_names = array_combine(
                array_column($array_of_names,'id'),
                array_column($array_of_names,'name')
            );

            foreach ($ids_at_date as $key => $id){
                $array[] = [
                    'routine_id'=> $id,
                    'name'=> $array_of_names[$id],
                    'time_start'=>$ids_time[$key][0],
                    'time_stop' => $ids_time[$key][1],
                    'date'=>$element['routines_date']
                ];
            }
            $resulting_array[] = $array;

        }
        return $resulting_array;
    }
}