<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CalendarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
          'name'=>'required|string',
          'time_start'=>'required|date_format:H:i',
          'time_stop'=> 'required|date_format:H:i|after:time_start',
          'date'=>'required|date',
        ];
        switch ($this->getMethod()){
            case 'POST':
                return $rules;
        }
        return [
          'method'=>  Rule::in(['POST'])
        ];
    }
}
