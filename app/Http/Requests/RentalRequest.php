<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class RentalRequest extends FormRequest
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
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        // $validate_rules = [
        //     'user_id' => 'required',
        //     'book_id' => 'required',
        //     'ship_date' => 'required'];

        // return $validate_rules;
        return true;
    }
}
