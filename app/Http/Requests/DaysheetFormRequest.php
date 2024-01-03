<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DaysheetFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(auth()->user()->client_id != null) {
            if(auth()->user()->client_id != request()->daysheetId){
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'selectedClient' => 'required',
            'site' => 'required',
            'jobNumber' => 'required',
            'startDate' => 'required|date',
            'startTime' => 'required',
            'finishDate' => 'required|date',
            'finishTime' => 'required',
            'issueFault' => 'required',
            'resolution' => 'required',
            'mileage' => 'required|numeric'
        ];
    }
}
