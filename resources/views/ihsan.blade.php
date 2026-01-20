<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
  </head>
  <body>
<header class="border-b border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
  <div class="mx-auto flex h-16 max-w-7xl items-center gap-8 px-4 sm:px-6 lg:px-8">
    <a href="#" title="" class="flex text-xl">
      <span class="font-bold text-gray-700 dark:text-gray-200">YNTK</span>
      <span class="text-lime-600 dark:text-lime-500">.TS</span>
    </a>

    <div class="flex flex-1 items-center justify-end md:justify-between">
      <nav aria-label="Global" class="hidden md:block">
        <ul class="flex items-center gap-6 text-sm">
          <li>
            <a class="border-b-2 border-lime-500 pb-5 text-sm font-medium text-gray-900 dark:border-lime-400 dark:text-white" href="#"> Dashboard </a>
          </li>

          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75 dark:text-white dark:hover:text-white/75" href="#"> Teams </a>
          </li>

          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75 dark:text-white dark:hover:text-white/75" href="#"> Projects </a>
          </li>

          <li>
            <a class="text-gray-500 transition hover:text-gray-500/75 dark:text-white dark:hover:text-white/75" href="#"> Calendar </a>
          </li>
        </ul>
      </nav>

      <div class="flex items-center gap-4">
        <div class="hidden sm:flex sm:gap-4">

          <a href="#" class="block shrink-0">
            <span class="sr-only">Profile</span>
            <img alt="Man" src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80" class="h-10 w-10 rounded-full object-cover" />
          </a>
        </div>

        <button class="block rounded bg-gray-100 p-2.5 text-gray-600 transition hover:text-gray-600/75 md:hidden dark:bg-gray-800 dark:text-white dark:hover:text-white/75">
          <span class="sr-only">Toggle menu</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</header>
  </body>
</html>