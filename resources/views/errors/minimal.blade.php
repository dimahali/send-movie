<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @vite(['resources/css/app.css'])

</head>
<body class="antialiased">
<div
    class="relative flex items-center justify-center min-h-screen bg-slate-100 dark:bg-slate-900 sm:items-center sm:pt-0">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col items-center gap-3">
            <div class="px-4 text-8xl text-slate-500 tracking-wider">
                @yield('code')
            </div>

            <div class="ml-4 text-lg text-slate-500 uppercase tracking-wider">
                @yield('message')
            </div>
        </div>
    </div>
</div>
</body>
</html>
