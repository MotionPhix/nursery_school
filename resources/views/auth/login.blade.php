<x-guest-layout>
    <x-auth-card>

        <x-splade-form
          action="{{ route('login') }}"
          autocomplete="off"
          class="space-y-4"
          novalidate>

            <x-splade-input
              id="email"
              type="email" name="email"
              :label="__('Email')"
              required
              autofocus />

            <x-splade-input id="password" type="password" name="password" :label="__('Password')" required autocomplete="current-password" />

            <div class="flex items-center justify-between">

              <x-splade-checkbox id="remember_me" name="remember" :label="__('Remember me')" />

              @if (Route::has('password.request'))
                <Link class="underline text-sm text-gray-600 dark:text-gray-300 dark:hover:text-gray-100 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </Link>
              @endif

            </div>

            <x-splade-submit
              class="mt-3 bg-lime-500 hover:bg-opacity-85 dark:text-gray-800"
              :label="__('Log in')" />

        </x-splade-form>

    </x-auth-card>
</x-guest-layout>
