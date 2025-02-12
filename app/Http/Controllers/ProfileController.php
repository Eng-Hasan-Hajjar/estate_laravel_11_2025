<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->validate([
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_receipt' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $user=$request->user();
        
         // حذف الصور القديمة إذا تم رفع صورة جديدة
    if ($request->hasFile('profile_image')) {
        if ($user->profile_image) {
            Storage::disk('public')->delete($user->profile_image);
        }
        $user->profile_image = $request->file('profile_image')->store('users/profile_images', 'public');
    }

    if ($request->hasFile('payment_receipt')) {
        if ($user->payment_receipt) {
            Storage::disk('public')->delete($user->payment_receipt);
        }
        $user->payment_receipt = $request->file('payment_receipt')->store('users/payment_receipts', 'public');
    }


    $user->save();
        //$request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
