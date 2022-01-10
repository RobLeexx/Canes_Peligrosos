<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'rol' => ['required', 'string', 'max:100'],
            'paterno' => ['required', 'string', 'max:100'],
            'materno' => ['required', 'string', 'max:100'],
            'nombres' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'max:50', Rule::unique('users')->ignore($user->id)],
            'numContacto' => ['required', 'string', 'max:100'],
            'grado' => ['required', 'string', 'max:100'],
            'departamento' => ['required', 'string', 'max:100'],
            'director' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
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
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
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
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
