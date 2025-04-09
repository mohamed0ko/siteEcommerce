<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */


    public function edit(Request $request): View
    {
        return view('frontend.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Handle photo upload if there's a file
        if ($request->hasFile('photo')) {
            // Store the file in the 'profile_photos' folder and get the file path
            $path = $request->file('photo')->store('profile_photos', 'public');
        }

        // Update the user data
        $user = $request->user();
        $user->fill($request->validated()); // Fill the user data with validated request fields

        // If a new photo is uploaded, store the photo path (as a string) in the database
        if (isset($path)) {
            $user->photo = $path; // Store the photo path in the database
        }

        // Check if the email is being updated
        if ($user->isDirty('email')) {
            $user->email_verified_at = null; // Reset email verification if the email is updated
        }

        // Save the updated user data
        $user->save();

        // Redirect back to the profile page with a success message
        return Redirect::route('profile.edit')->with('success', 'Profile updated successfully.');
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
