<x-guest-layout>
    <x-auth-card>
        <x-splade-form
          action="{{ route('register') }}"
          class="space-y-4"
          novalidate>

            <x-splade-input id="first_name" type="text" name="first_name" :label="__('First name')" required autofocus />

            <x-splade-input id="last_name" type="text" name="last_name" :label="__('Last name')" required autofocus />

            <x-splade-input id="email" type="email" name="email" :label="__('Email')" required />

            <x-splade-input id="password" type="password" name="password" :label="__('Password')" required autocomplete="new-password" />

            <x-splade-input id="password_confirmation" type="password" name="password_confirmation" :label="__('Confirm Password')" required />

            <div class="flex items-center justify-end">
                <Link class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </Link>

                <x-splade-submit class="ml-4 bg-lime-500 hover:bg-opacity-80 dark:text-gray-700" :label="__('Register')" />
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>