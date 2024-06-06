<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'birth_date' => [
                'required',
                'string',
                'date'
            ],
            'zip_code' => 'required|size:7|alpha_num|regex:/^[0-9]+$/',
            'address' => 'required',
            'tel' => 'nullable|size:11|alpha_num|regex:/^0[0-9]{9,10}$/u',


            'password' => $this->passwordRules(),
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'birth_date' => $input['birth_date'],
            'zip_code' => $input['zip_code'],
            'address' => $input['address'],
            'tel' => $input['tel'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            // 'two_factor_recovery_codes' => $input['two_factor_recovery_codes'],
            // 'two_factor_confirmed_at' => $input['two_factor_confirmed_at'],
            'is_admin' => $input['is_admin'],
            // 'remember_token' => $input['remember_token'],
        ]);
    }
}
