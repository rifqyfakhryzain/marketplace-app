<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
  </head>
  <body>
    <header class="border-b border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
  <div class="mx-auto flex h-16 max-w-screen-2xl items-center gap-8 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-1 items-center justify-start gap-4 md:gap-8">
      <a class="flex gap-1 text-teal-600 dark:text-teal-500" href="#">
        <svg class="size-7 text-lime-600 dark:text-lime-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-hexagon-letter-m">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M19.875 6.27a2.225 2.225 0 0 1 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033" />
          <path d="M9 16v-8l3 5l3 -5v8" />
        </svg>
        <span class="text-xl font-medium tracking-wider text-gray-700 dark:text-gray-200">mulio<span class="font-extrabold">node</span></span>
      </a>

      <div class="relative hidden sm:block">
        <label class="sr-only" for="search"> Search </label>

        <input class="h-10 w-full rounded-full border-none bg-gray-100 ps-4 pe-10 text-sm shadow-sm sm:w-64 dark:bg-gray-800 dark:text-white" id="search" type="search" placeholder="Search..." />

        <button type="button" class="absolute end-1 top-1/2 -translate-y-1/2 rounded-full bg-white p-2 text-gray-600 transition hover:text-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:hover:text-gray-200">
          <span class="sr-only">Search</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
        </button>
      </div>
    </div>

    <div class="flex items-center justify-end gap-4">
      <nav aria-label="Global" class="hidden md:block">
        <ul class="flex items-center gap-6 text-sm">
          <li>
            <a class="rounded-md bg-lime-100 px-3 py-2 text-sm font-medium text-lime-700 dark:bg-lime-900/50 dark:text-lime-300" href="#"> Dashboard </a>
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

      <span aria-hidden="true" class="hidden h-6 w-px rounded-full bg-gray-200 md:block dark:bg-gray-700"></span>

      <a href="#" class="block shrink-0">
        <span class="sr-only">Profile</span>
        <img alt="Man" src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80" class="h-10 w-10 rounded-full object-cover" />
      </a>

      <button class="block rounded bg-gray-100 p-2.5 text-gray-600 transition hover:text-gray-600/75 md:hidden dark:bg-gray-800 dark:text-white dark:hover:text-white/75">
        <span class="sr-only">Toggle menu</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </div>
</header>
    <h1 class="text-3xl font-bold underline">
      Hello world!
    </h1>
  </body>
</html>