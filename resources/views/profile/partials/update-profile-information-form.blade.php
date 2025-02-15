<section>
    <header>
        <div class="" style="float: right">
            @if(auth()->user()->profile_image)
            <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" 
            class="w-16 h-16 rounded-full border-2 border-gray-300 shadow-md" 
            alt="Profile Picture">
            @else
                <p>No profile picture uploaded.</p>
            @endif
        </div>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
      
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>


        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Profile Picture & Payment Receipt') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Upload  your profile picture and payment receipt.') }}
        </p>
        <div class="flex items-center space-x-8">
            <!-- صورة الملف الشخصي -->
            <div>
                <label for="profile_image" class="block text-sm font-medium text-gray-700">Profile Picture</label>
                <input type="file" name="profile_image" id="profile_image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('profile_image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
        
                @if(auth()->user()->profile_image)
                    <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" width="100" class="mt-2 rounded-lg shadow-md border border-gray-300">
                @endif
            </div>
        
            <!-- إيصال الدفع -->
            <div>
                <label for="payment_receipt" class="block text-sm font-medium text-gray-700">Payment Receipt</label>
                <input type="file" name="payment_receipt" id="payment_receipt" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('payment_receipt')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
        
                @if(auth()->user()->payment_receipt)
                    <img src="{{ asset('storage/' . auth()->user()->payment_receipt) }}" width="100" class="mt-2 rounded-lg shadow-md border border-gray-300">
                @endif
            </div>
        </div>
        




        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
