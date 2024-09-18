<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('', 'Login Form') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    @include('sweetalert::alert')
    {{-- <div id="overlay" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 bg-cover">
        <img src={{ asset('assets/cover.jpg') }} alt="Overlay Image" class="">
    </div> --}}
    <div id="overlay" class="fixed inset-0 flex items-center justify-center z-50 overflow-hidden">
        <video autoplay loop muted class="absolute w-full h-full object-cover">
            <source src="{{ asset('assets/0916.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <div class="min-h-screen sm:justify-center items-center pt-6 sm:pt-0 bg-cover bg-center"
        style="background-image: url('assets/cover.jpg');">
        {{-- <div class="flex justify-end">
            <a class="underline mt-12 text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Log in to Admin Panel?') }}
            </a>
        </div> --}}
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 lg:py-24 py-0">
            <div class="bg-white/80 backdrop-blur-sm shadow-sm sm:rounded-lg">
                <div class="p-10">
                    <h2 class="text-2xl font-semibold leading-7 text-gray-900">Visitor Attendance</h2>
                    <p class="mt-1 text-lg leading-6 text-gray-600 border-b border-gray-200 pb-3">Please fill in your
                        details to record your
                        visit.</p>
                    <form action="{{ route('visitors.store') }}" method="POST">
                        @csrf
                        <div class="mt-10 grid grid-cols-1 gap-x-8 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="first-name" class="block text-lg font-medium leading-6 text-gray-900">First
                                    Name</label>
                                <div class="mt-2">
                                    <input type="text" name="first_name" id="first-name" required
                                        autocomplete="given-name"
                                        class="block w-full rounded-lg border-gray-300 py-3 px-4 text-gray-900 shadow-sm focus:ring-2 focus:ring-indigo-600 sm:text-lg sm:leading-6"
                                        placeholder="Ilagay ang iyong pangalan">
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="last-name" class="block text-lg font-medium leading-6 text-gray-900">Last
                                    Name</label>
                                <div class="mt-2">
                                    <input type="text" name="last_name" id="last-name" required
                                        autocomplete="family-name"
                                        class="block w-full rounded-lg border-gray-300 py-3 px-4 text-gray-900 shadow-sm focus:ring-2 focus:ring-indigo-600 sm:text-lg sm:leading-6"
                                        placeholder="Ilagay ang iyong Apelyido">
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="gender"
                                    class="block text-lg font-medium leading-6 text-gray-900">Gender</label>
                                <div class="mt-2">
                                    <select id="gender" name="gender" required
                                        class="block w-full rounded-lg border-gray-300 py-3 px-4 text-gray-900 shadow-sm focus:ring-2 focus:ring-indigo-600 sm:text-lg sm:leading-6">
                                        <option value="" selected disabled>Ano ang iyong kasarian</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="barangay"
                                    class="block text-lg font-medium leading-6 text-gray-900">Barangay</label>
                                <div class="mt-2">
                                    <select id="barangay" name="barangay" required
                                        class="block w-full rounded-lg border-gray-300 py-3 px-4 text-gray-900 shadow-sm focus:ring-2 focus:ring-indigo-600 sm:text-lg sm:leading-6">
                                        <option value="" selected disabled>Saan barangay ka nakatira</option>
                                        @foreach ($barangays as $barangay)
                                            <option value="{{ $barangay }}">{{ $barangay }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="purok"
                                    class="block text-lg font-medium leading-6 text-gray-900">Purok</label>
                                <div class="mt-2">
                                    <select id="purok" name="purok" required
                                        class="block w-full rounded-lg border-gray-300 py-3 px-4 text-gray-900 shadow-sm focus:ring-2 focus:ring-indigo-600 sm:text-lg sm:leading-6">
                                        <option value="" selected disabled>Ano ang iyong Purok</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">Purok {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="purpose" class="block text-lg font-medium leading-6 text-gray-900">Purpose
                                    of
                                    Visit</label>
                                <div class="mt-2">
                                    <select id="purpose" name="purpose" required
                                        class="block w-full rounded-lg border-gray-300 py-3 px-4 text-gray-900 shadow-sm focus:ring-2 focus:ring-indigo-600 sm:text-lg sm:leading-6"
                                        onchange="toggleOtherPurpose()">
                                        <option value="" selected disabled>Ano ang iyong layunin ng pagbisita
                                        </option>
                                        <option value="Medical">Medical</option>
                                        <option value="Education">Education</option>
                                        <option value="Burial">Burial</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div id="otherPurposeField" class="sm:col-span-3 hidden">
                                <label for="other_purpose"
                                    class="block text-lg font-medium leading-6 text-gray-900">Specify Other
                                    Purpose</label>
                                <div class="mt-2">
                                    <input type="text" name="other_purpose" id="other_purpose"
                                        class="block w-full rounded-lg border-gray-300 py-3 px-4 text-gray-900 shadow-sm focus:ring-2 focus:ring-indigo-600 sm:text-lg sm:leading-6">
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 flex items-center justify-end gap-x-6">
                            <button type="submit"
                                class="rounded-lg bg-indigo-600 px-5 py-3 text-lg font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Record
                                Attendance</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function toggleOtherPurpose() {
                const purposeSelect = document.getElementById('purpose');
                const otherPurposeField = document.getElementById('otherPurposeField');
                otherPurposeField.classList.toggle('hidden', purposeSelect.value !== 'Others');
            }
        </script>
    </div>
</body>
<script>
    let timer;
    const overlay = document.getElementById('overlay');

    function resetTimer() {
        clearTimeout(timer);
        overlay.style.display = 'none';
        timer = setTimeout(showOverlay, 60000);
    }

    function showOverlay() {
        overlay.style.display = 'flex';
    }

    // Event listeners for user activity
    window.onload = resetTimer;
    document.onkeypress = resetTimer;
    document.onclick = resetTimer;
    document.ontouchstart = resetTimer;
</script>

</html>
