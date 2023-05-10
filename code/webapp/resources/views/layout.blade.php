<!doctype html>
<html lang="nl">

<head>
    @include('head')
</head>

<body class="flex">
    <x-navbar />
    <main class="w-full bg-[#ecf0f5]">
        <x-topbar />
        <x-welcome />

        <div class="m-5 bg-white rounded border">
            <div class="border-t-4 rounded border-[#3c8dbc]">
                <div class="m-3">
                    @yield('content')
                </div>
            </div>
        </div>
        @yield('documentation')
    </main>
</body>

</html>
