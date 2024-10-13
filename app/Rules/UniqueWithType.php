<?php

namespace App\Rules;

use App\Models\Cottage;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule; 
use Illuminate\Http\Request;

class UniqueWithType implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value, $data, Request $request)
    {
        
        $type = $request->input('type');
        $number = $request->input('number');

        $count = Cottage::where('type', $type)->where('number', $number)->count();

        return $count === 0;
    }

    public function message()
    {
        return 'The number is already taken with this cottage type';
    }
}
