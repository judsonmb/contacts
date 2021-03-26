<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Contacts') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->

        <script src="http://code.jquery.com/jquery-2.0.3.min.js" type="text/javascript">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">

        <script src="{{ mix('js/app.js') }}" defer></script>

        
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
        <nav class="font-sans flex flex-col text-center content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 bg-white shadow sm:items-baseline w-full">
            <div class="mb-2 sm:mb-0 inner">

                <a href="/home" class="text-2xl no-underline text-grey-darkest hover:text-blue-dark font-sans font-bold">Agenda de Contatos</a><br>
                <span class="text-xs text-grey-dark">{{ Auth::user()->name }}</span>

            </div>

            <div class="sm:mb-0 self-center">
                <div class="h-10" style="display: table-cell, vertical-align: middle;">
                <a href="{{ route('contact.create') }}" class="text-md no-underline text-black hover:text-blue-dark ml-2 px-1">CRUD contacts</a>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <!-- @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif -->

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
