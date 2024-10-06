<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEntranceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'              =>  'string',
            'total'             =>  'numeric',
            'bc'                =>  'array', // bc => Booked Cottages
            'bc.*.entrance_id'  =>  'integer',
            'bc.*.cottage_id'   =>  'integer',
            'bc.*.quantity'     =>  'integer',
            'cc'                =>  'array', // cc => Customers Count
            'cc.*.entrance_id'  =>  'integer',
            'cc.*.customer_id'  =>  'integer',
            'cc.*.count'        =>  'integer' 
        ];
    }
}
