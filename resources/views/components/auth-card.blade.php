<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
  <div>
    @isset($logo)
      {{ $logo }}
    @else
      <Link href="/">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
      </Link>
    @endisset
  </div>

  <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg text-gray-700 bg-gray-200 dark:bg-gray-600 dark:text-gray-400">
    {{ $slot }}
  </div>
</div>
