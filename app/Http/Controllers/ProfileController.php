<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
    * Display the user's profile form.
    */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
    * Create the user's account.
    */
    public function create(): View
    {
        $users = User::all();
        return  view('profile.create', compact('users'));
    }
    /**
    * Update the user's profile information.
    */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            $request->user()->fill($request->validated());

            if ($request->user()->isDirty('email')) {
                $request->user()->email_verified_at = null;
            }

            $request->user()->save();

            session()->flash('success', "Informações alteradas com sucesso");

            return Redirect::route('profile.edit')->with('status', 'profile-updated');

        } catch (ValidationException $e) {
            $errors = $e->errors();
            foreach ($errors as $error) {

                session()->flash('error', $error[0]);
            }
            return Redirect::route('profile.edit')->with('status', 'profile-updated');
        }
    }

    /**
    * Delete the user's account.
    */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
