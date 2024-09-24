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

        <link href="{{ asset('assets/sweetalert/sweetalert2.min.css') }}" rel="stylesheet">
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow dark:bg-gray-800">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
        <script>
            @if(session('success'))
                Swal.fire({
                    title: '{{ session('success') }}',
                    icon: 'success',
                })
            @elseif(session('error'))
                Swal.fire({
                    title: '{{ session('error') }}',
                    icon: 'error',
                })
            @endif

            function deleteData({data, dataName, url}){
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                Swal.fire({
                    title: `Apakah Anda Yakin Data ${dataName} Akan Dihapus?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#ef4444",
                    confirmButtonText: "Ya",
                    cancelButtonText: "Batal",
                    preConfirm: async () => {
                        await fetch(url, {
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                            method: 'delete',
                            body: JSON.stringify(data)
                        })
                        .then(res => res.json())
                        .then((response) => {
                            Swal.fire({
                                title: response.message,
                                icon: response.success ? 'success' : 'error',
                            }).then((result) => {
                                location.reload();
                            })
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
            }
        </script>
    </body>
</html>
