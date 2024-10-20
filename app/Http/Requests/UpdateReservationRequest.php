<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
            'name'                  =>  ['string', 'required'],
            'contact'               =>  ['string', 'required'],
            'status'                =>  ['required'],
            'payment'               =>  ['required'],
            'date_booked'           =>  ['date', 'required'],
            'rc'                    =>  ['array', 'required'],
            'rc.*.cottage_id'       =>  ['integer', 'required'],
            'rc.*.reservation_id'   =>  ['integer'],
            'rc.*.quantity'         =>  ['integer', 'required']  
        ];
    }
}
