<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('', 'Attendance System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="mb-8">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </div>

        <div class="flex flex-col items-center space-y-4">
            <form action="{{ route('check.pin') }}" method="POST">
                @csrf
                <div class="flex space-x-4 my-3">
                    <input type="password" name="pin_1" maxlength="1"
                        class="w-12 h-12 text-center text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="*" id="pin_1" oninput="moveToNext(this, 'pin_2')" />

                    <input type="password" name="pin_2" maxlength="1"
                        class="w-12 h-12 text-center text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="*" id="pin_2" oninput="moveToNext(this, 'pin_3')" />

                    <input type="password" name="pin_3" maxlength="1"
                        class="w-12 h-12 text-center text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="*" id="pin_3" oninput="moveToNext(this, 'pin_4')" />

                    <input type="password" name="pin_4" maxlength="1"
                        class="w-12 h-12 text-center text-lg border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="*" id="pin_4" oninput="moveToNext(this, '')" />
                </div>
                <div class="text-center">
                    <button
                        class="px-4 py-2 bg-blue-800 text-white font-semibold rounded-lg shadow-md hover:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Submit
                    </button>
                </div>
            </form>

            <a class="underline mt-12 text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Log in to Admin Panel?') }}
            </a>
        </div>
    </div>
</body>
<script>
    function moveToNext(current, nextFieldId) {
        if (current.value.length === 1 && nextFieldId) {
            document.getElementById(nextFieldId).focus();
        }
    }
</script>

</html>
