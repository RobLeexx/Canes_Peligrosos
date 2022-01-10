<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'rol' =>['required', 'string', 'max:15'],
            'paterno' => ['required'],
            'materno' => ['required'],
            'nombres' => ['required'],
            'username' =>['required', 'string', 'max:15', 'unique:users'],
            'numContacto' => ['required'],
            'grado' => ['required'],
            'departamento' => ['required'],
            'director' => ['required'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $user = User::create([
            'rol' => $input['rol'],
            'paterno' => $input['paterno'],
            'materno' => $input['materno'],
            'nombres' => $input['nombres'],
            'username' => $input['username'],
            'numContacto' => $input['numContacto'],
            'grado' => $input['grado'],
            'departamento' => $input['departamento'],
            'director' => $input['director'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        return $user;
    }
}
