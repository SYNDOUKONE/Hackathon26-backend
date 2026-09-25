<?php

namespace App\Actions\Fortify;

use App\Models\Etudiant;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::user()->etudiant) {
            Validator::make($input, [
                'nom' => ['required', 'string', 'max:255'],
                'prenom' => ['required', 'string'],
                'classe' => ['required', 'string'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            ])->validateWithBag('updateProfileInformation');

        } else {
            Validator::make($input, [
                'matricule' => ['required'],
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            ])->validateWithBag('updateProfileInformation');
        }

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['matricule'] ?? $user->name,
                'email' => $input['email'],
            ])->save();

            if (Auth::user()->etudiant) {
                $etudiant = Etudiant::where('user_id', $user->id)->first();
                $etudiant->forceFill([
                    'nom' => $input['nom'],
                    'prenom' => $input['prenom'],
                    'classe' => $input['classe']
                ])->save();
            }
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
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
