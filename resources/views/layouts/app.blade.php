<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Next Project Film') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:wght@700;800&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-zinc-900 bg-zinc-50">

    <div class="min-h-screen bg-zinc-50">

        @include('layouts.navigation')

        <div class="flex flex-col md:ml-64 min-h-screen transition-all duration-300 pt-[72px] md:pt-0">

            @if (isset($header))
                <header class="sticky top-0 z-30 bg-white/60 backdrop-blur-lg shadow-sm border-b border-white/40">
                    <div class="py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="flex-1">
                {{ $slot }}
            </main>

        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.form-delete');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const message = this.getAttribute('data-confirm-message') ||
                        'Data ini akan dihapus secara permanen!';

                    Swal.fire({
                        title: 'Apakah Anda Yakin?',
                        text: message,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        background: '#ffffff',
                        color: '#18181b',
                        width: 'auto', // Biarkan Tailwind yang mengatur lebar
                        padding: '1.25rem',
                        buttonsStyling: false, // Matikan style bawaan swal agar Tailwind bekerja maksimal
                        customClass: {
                            // Lebar 90% di HP, max lebar 400px di laptop
                            popup: 'w-[90%] max-w-sm rounded-3xl border border-zinc-100 shadow-2xl p-4 sm:p-6',
                            title: 'font-bold text-xl sm:text-2xl text-zinc-900',
                            htmlContainer: 'text-sm sm:text-base text-zinc-500 font-medium mt-2',
                            // Tombol berjejer ke bawah di HP, dan menyamping di Laptop
                            actions: 'flex flex-col sm:flex-row-reverse gap-3 w-full mt-6',
                            confirmButton: 'w-full sm:w-auto bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl px-6 py-3 transition-colors',
                            cancelButton: 'w-full sm:w-auto bg-zinc-100 hover:bg-zinc-200 text-zinc-800 font-bold rounded-xl px-6 py-3 transition-colors'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Menghapus...',
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                width: 'auto',
                                customClass: {
                                    popup: 'w-[80%] max-w-xs rounded-2xl p-6 shadow-xl',
                                    title: 'font-bold text-lg text-zinc-900'
                                },
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            });
                            this.submit();
                        }
                    });
                });
            });
        });
    </script>

</body>

</html>
