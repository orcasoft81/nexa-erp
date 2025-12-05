<x-guest-layout>
    <form method="POST" action="{{ route('register.module.store', $module->code) }}">
        @csrf

        {{-- Selected module banner --}}
        @if(isset($module))
            <div class="mb-4 rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm">
                You’re joining to activate:
                <span class="font-semibold text-slate-900">{{ $module->name }}</span>
            </div>
        @endif



        <!-- Name -->
        <div>
            <x-input-label for="name" value="Full Name" />
            <x-text-input id="name" class="block mt-1 w-full"
                          type="text" name="name" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="block mt-1 w-full"
                          type="email" name="email" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirm Password" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password" name="password_confirmation" required />
        </div>

        {{-- Company Section --}}
        <div class="mt-8 border-t pt-6">
            <h3 class="font-semibold mb-4">Company Details</h3>

            <div>
                <x-input-label for="company_name" value="Company Name" />
                <x-text-input id="company_name" class="block mt-1 w-full"
                              type="text" name="company_name" required />
                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
            </div>

            <div class="mt-4 grid grid-cols-2 gap-3">
                <div>
                    <x-input-label for="country" value="Country" />
                    <x-text-input id="country" class="block mt-1 w-full"
                                  type="text" name="country" />
                </div>
                <div>
                    <x-input-label for="city" value="City" />
                    <x-text-input id="city" class="block mt-1 w-full"
                                  type="text" name="city" />
                </div>
            </div>

            <div class="mt-4">
                <x-input-label for="address" value="Address" />
                <x-text-input id="address" class="block mt-1 w-full"
                              type="text" name="address" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="ms-4">
                Create Account & Start Trial
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
