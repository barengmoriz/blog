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
        <link href="{{ asset('assets/select2/select2.min.css') }}" rel="stylesheet" />
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
                    confirmButtonColor: "#22c55e",
                })
            @elseif(session('error'))
                Swal.fire({
                    title: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonColor: "#22c55e",
                })
            @endif

            function deleteData({data, dataName, url, message}){
                event.preventDefault();
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                Swal.fire({
                    title: message == undefined ? `Apakah anda yakin data "${dataName}" akan dihapus?` : message,
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
                                confirmButtonColor: "#22c55e",
                            }).then((result) => {
                                if(response.redirect){
                                    window.location.replace(response.redirect)
                                } else {
                                    location.reload();
                                }
                            })
                        })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
            }
        </script>

        <script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/select2/select2.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
        </script>

        <script src="https://cdn.tiny.cloud/1/{{ config('tinymce.api_key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: 'textarea#description',
                plugins: 'code table lists',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
            });
        </script>
    </body>
</html>
