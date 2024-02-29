<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RoleFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
//        if(!auth()->user()->admin){
//            return false;
//        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $path = explode('/',$this->path());
        if(count($path) > 1){
            return [
                'role' => 'required|unique:roles,role,'.$path[1],
            ];
        } else {
            return [
                'role' => 'required|unique:roles',
            ];
        }

    }
}
