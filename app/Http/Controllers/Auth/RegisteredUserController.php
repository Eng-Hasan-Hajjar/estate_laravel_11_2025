<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'payment_receipt' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // رفع الصور إذا تم توفيرها
        $profileImagePath = $request->hasFile('profile_image') 
        ? $request->file('profile_image')->store('users/profile_images', 'public') 
        : null;

        $paymentReceiptPath = $request->hasFile('payment_receipt') 
        ? $request->file('payment_receipt')->store('users/payment_receipts', 'public') 
        : null;



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_image' => $profileImagePath,
            'payment_receipt' => $paymentReceiptPath,
        ]);
        
        // تعيين الدور الافتراضي "user"
        $defaultRole = Role::where('name', 'user')->first();
        if ($defaultRole) {
            $user->roles()->attach($defaultRole->id);
        }

        event(new Registered($user));
        Auth::login($user);

        // جلب دور المستخدم بعد تسجيل الدخول
        $userRoleId = $user->roles()->first()->id ?? null;

        if ($userRoleId == 3) {
            return redirect(route('indexproperty', absolute: false));
        }
        else{
            return redirect(route('dashboard', absolute: false));
        }




    }
}
