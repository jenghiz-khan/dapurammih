<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', "Dapur Ammih")</title>
    @vite('resources/css/app.css')

    @yield('css')
</head>

<body class="dark:bg-gray-800">
    @include('template.navbar')

    @yield('content')


    @stack('scripts')

    <script>
        const userPref = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        if (userPref === 'dark' || (!userPref && systemPrefersDark)) {
            document.documentElement.classList.add('dark');
        }

        if (userPref === 'light') {
            document.documentElement.classList.remove('dark');
        }

    </script>
    <script>
        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }

    </script>
</body>

</html>
