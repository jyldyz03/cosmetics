<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Order; // Add a semicolon here

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
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->update($request->validated());

        return Redirect::to('/profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function delete(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('logout')->with('success', 'Your account has been deleted successfully.');
    }

    /**
     * Display the user's profile index.
     */
    public function index()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)->with('items.product')->get();

        return view('profile.index', compact('orders'));
    }

    /**
     * Handle the password reset request.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        $user = auth()->user();

        // Check the current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'The current password is incorrect.');
        }

        // Update the password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
