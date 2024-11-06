<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation-public')

            <!-- Page Content -->
            <main>
                <div class="py-12">
                    <div class="flex flex-col gap-4 mx-auto lg:flex-row max-w-7xl sm:px-6 lg:px-8">
                        <div class="w-full overflow-hidden bg-white shadow-sm lg:w-2/3 dark:bg-gray-800 sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                {{ $slot }}
                            </div>
                        </div>
                        <div class="w-full overflow-hidden bg-white shadow-sm lg:w-1/3 dark:bg-gray-800 sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <div class="flex flex-col space-y-4">
                                    <x-category-widget />
                                    <x-tag-widget />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <script>
            (function() {
            var d = document, s = d.createElement('script');
            s.src = 'https://{{ config("disqus.short_name") }}.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    </body>
</html>