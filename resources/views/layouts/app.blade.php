<div class="min-h-screen bg-gray-100">
  @include('layouts.navigation')

  <!-- Page Heading -->
  <header class="bg-white shadow sticky top-0 z-10">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex items-center gap-4">
      {{ $header }}
    </div>
  </header>

  <!-- Page Content -->
  <main>
    {{ $slot }}
  </main>
</div>
