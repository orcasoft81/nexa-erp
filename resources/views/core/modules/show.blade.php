@php
    $colorMap = [
        "purple" => "from-purple-600 to-fuchsia-600",
        "emerald" => "from-emerald-600 to-teal-600",
        "pink" => "from-pink-600 to-rose-600",
        "blue" => "from-blue-600 to-cyan-600",
        "indigo" => "from-indigo-600 to-violet-600",
        "orange" => "from-orange-600 to-amber-600",
        "slate" => "from-slate-700 to-slate-900",
    ];
    $grad = $colorMap[$app['color']] ?? "from-purple-600 to-fuchsia-600";
@endphp

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $app['title'] }}</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@600;700&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        .handwriting { font-family: 'Caveat', cursive; }
        .ui-font { font-family: 'Inter', system-ui, sans-serif; }
        .soft-shadow { box-shadow: 0 0 1px rgba(0,0,0,.03), 0 6px 18px rgba(15,23,42,.06); }
    </style>
</head>

<body class="ui-font bg-white text-slate-900 antialiased">

{{-- Top bar --}}
<header class="sticky top-0 z-30 bg-white/80 backdrop-blur border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <a href="{{ route('landing') }}" class="text-2xl font-extrabold text-purple-700 tracking-tight">
            Nexa
        </a>

        <nav class="hidden md:flex items-center gap-7 text-sm font-semibold text-slate-600">
            <a href="{{ route('landing') }}#apps" class="hover:text-slate-900 transition">Apps</a>
            <a href="{{ route('landing') }}#products" class="hover:text-slate-900 transition">Products</a>
            <a href="{{ route('landing') }}#features" class="hover:text-slate-900 transition">Features</a>
            <a href="#" class="hover:text-slate-900 transition">Pricing</a>
            <a href="#" class="hover:text-slate-900 transition">Help</a>
        </nav>

        <div class="hidden md:flex items-center gap-3">
            <a href="{{ route('login') ?? '#' }}" class="text-sm font-semibold text-slate-700 hover:text-slate-900 transition">
                Sign in
            </a>
            <a href="#" class="inline-flex items-center rounded-lg bg-purple-700 px-4 py-2 text-sm font-semibold text-white soft-shadow hover:bg-purple-800 transition">
                Try it free
            </a>
        </div>

        {{-- Mobile menu button --}}
        <button id="menuBtn" class="md:hidden p-2 rounded-lg hover:bg-slate-100 transition">
            <svg class="w-6 h-6 text-slate-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    {{-- Mobile menu --}}
    <div id="mobileMenu" class="md:hidden hidden px-4 pb-4">
        <div class="rounded-xl border border-slate-200 bg-white soft-shadow p-3">
            <ul class="flex flex-col gap-1 text-sm font-semibold text-slate-700">
                <li><a class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition" href="{{ route('landing') }}#apps">Apps</a></li>
                <li><a class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition" href="{{ route('landing') }}#products">Products</a></li>
                <li><a class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition" href="{{ route('landing') }}#features">Features</a></li>
                <li><a class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition" href="#">Pricing</a></li>
                <li><a class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition" href="#">Help</a></li>
            </ul>
            <div class="mt-3 flex items-center gap-3 px-2">
                <a href="{{ route('login') ?? '#' }}" class="text-sm font-semibold text-slate-700 hover:text-slate-900 transition">
                    Sign in
                </a>
                <a href="{{ route('register.module', $module->code) }}" class="ml-auto inline-flex items-center rounded-md bg-purple-700 px-4 py-2 text-sm font-semibold text-white soft-shadow hover:bg-purple-800 transition">
                    Try it free
                </a>
            </div>
        </div>
    </div>
</header>

<main class="relative overflow-x-clip">

    {{-- Hero --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-8">
        <div class="relative rounded-[28px] bg-gradient-to-r {{ $grad }} text-white px-6 sm:px-10 py-10 sm:py-14 overflow-hidden soft-shadow">
            <div class="grid lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7">
                    <p class="handwriting text-2xl opacity-95">App Module</p>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mt-2 leading-[1.05]">
                        {{ $app['title'] }}
                    </h1>

                    <p class="mt-4 text-white/90 text-lg sm:text-xl max-w-2xl">
                        {{ $app['tagline'] }}
                    </p>

                    <div class="mt-7 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('register.module',  $module->code) }}" class="bg-white text-slate-900 rounded-xl px-7 py-3.5 font-semibold shadow-sm hover:bg-white/90 transition">
                            Start using {{ $app['title'] }}
                        </a>
                        <a href="#" class="bg-white/10 border border-white/30 rounded-xl px-7 py-3.5 font-semibold hover:bg-white/15 transition">
                            Book a demo
                        </a>
                    </div>

                    <div class="mt-6 flex items-center gap-3 text-white/90 text-sm">
                        <div class="h-2.5 w-2.5 rounded-full bg-emerald-300"></div>
                        <span>Works seamlessly with other Nexa apps</span>
                    </div>
                </div>

                {{-- Right hero card --}}
                <div class="lg:col-span-5">
                    <div class="rounded-2xl bg-white/10 border border-white/20 p-5 sm:p-6">
                        <div class="rounded-xl bg-white/10 p-4">
                            <p class="text-sm font-semibold text-white/90">Included with Nexa Suite</p>
                            <p class="mt-1 text-2xl font-extrabold handwriting">US$ 7.25 / month</p>
                            <p class="text-white/80">for ALL apps</p>
                        </div>

                        <ul class="mt-4 space-y-2 text-sm text-white/90">
                            <li class="flex gap-2"><span class="font-bold">✓</span> Fast setup, zero clutter</li>
                            <li class="flex gap-2"><span class="font-bold">✓</span> Flexible permissions</li>
                            <li class="flex gap-2"><span class="font-bold">✓</span> Real-time insights</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- decorative blobs --}}
            <div class="absolute -right-16 -top-16 w-60 h-60 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute right-24 -bottom-12 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        </div>
    </section>


    {{-- Features --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex items-end justify-between flex-wrap gap-4">
            <div>
                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    What you can do with {{ $app['title'] }}
                </h2>
                <p class="text-slate-600 mt-2">
                    Everything you need, ready out of the box.
                </p>
            </div>

            <a href="#" class="text-sm font-semibold text-purple-700 hover:text-purple-800 transition">
                View documentation →
            </a>
        </div>

        <div class="mt-7 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($app['features'] as $feature)
                <div class="group bg-white rounded-2xl border border-slate-200 p-6 soft-shadow hover:shadow-lg hover:-translate-y-1 transition">
                    <div class="h-11 w-11 rounded-xl bg-slate-50 grid place-items-center font-bold text-slate-700 group-hover:scale-105 transition">
                        ✓
                    </div>
                    <p class="mt-4 font-semibold text-slate-900 text-base">
                        {{ $feature }}
                    </p>
                    <p class="text-sm text-slate-600 mt-1 leading-relaxed">
                        Built to be simple, fast, and reliable for your team.
                    </p>
                </div>
            @endforeach
        </div>
    </section>


    {{-- Preview / layout block --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-5 rounded-3xl bg-slate-50 p-7 sm:p-8 border border-slate-100">
                <h3 class="text-xl font-bold">Clean workspace</h3>
                <p class="text-slate-600 mt-2 leading-relaxed">
                    A unified layout focused on productivity — less noise, more results.
                </p>

                <ul class="mt-5 space-y-2.5 text-sm text-slate-700">
                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span> Smart filters & quick search</li>
                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span> Custom views per team</li>
                    <li class="flex gap-2"><span class="text-emerald-600 font-bold">✓</span> Real-time collaboration</li>
                </ul>

                <div class="mt-6">
                    <a href="#" class="inline-flex items-center text-sm font-semibold text-slate-900 hover:text-purple-700 transition">
                        See it in action
                        <svg class="ml-1 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="rounded-3xl border border-slate-200 bg-white p-3 sm:p-5 soft-shadow">
                    <div class="h-[280px] sm:h-[360px] rounded-2xl bg-gradient-to-br from-slate-50 to-slate-100 grid place-items-center text-slate-400 text-sm">
                        Module preview screenshot here
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Related / Next steps --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-14">
        <div class="rounded-3xl bg-slate-950 text-white px-6 sm:px-10 py-10 flex flex-col lg:flex-row items-center justify-between gap-6 soft-shadow">
            <div>
                <h3 class="text-2xl font-extrabold tracking-tight">
                    {{ $app['title'] }} is better with Nexa
                </h3>
                <p class="text-white/70 mt-2">
                    Connect your teams, automate work, and scale without switching tools.
                </p>
            </div>
            <div class="flex gap-3">
                <a href="#" class="bg-white text-slate-950 rounded-xl px-6 py-3 font-semibold hover:bg-white/90 transition">
                    Start now
                </a>
                <a href="#" class="border border-white/30 rounded-xl px-6 py-3 font-semibold hover:bg-white/10 transition">
                    Contact sales
                </a>
            </div>
        </div>
    </section>

</main>

<script>
    const btn = document.getElementById('menuBtn');
    const menu = document.getElementById('mobileMenu');
    btn?.addEventListener('click', () => menu.classList.toggle('hidden'));
</script>

</body>
</html>
