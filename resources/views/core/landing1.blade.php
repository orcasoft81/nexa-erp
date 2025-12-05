<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nexa ERP</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;700&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        .handwriting { font-family: 'Caveat', cursive; }
        .ui-font { font-family: 'Inter', system-ui, sans-serif; }

        /* Brush highlight behind words */
        .brush { position: relative; display: inline-block; padding: 0 .35em; }
        .brush::before{
            content:""; position:absolute; inset:-.12em -.12em -.18em -.12em;
            background:#fbbf24; border-radius:999px; transform: rotate(-1.8deg);
            z-index:-1; filter: saturate(1.1);
        }

        /* Scribble underline */
        .scribble { position: relative; display:inline-block; }
        .scribble::after{
            content:""; position:absolute; left:-2%; right:-2%;
            bottom:-0.12em; height:0.32em; background:#38bdf8;
            border-radius:999px; transform: rotate(-2deg);
            z-index:-1; opacity:.9;
        }
    </style>
</head>

<body class="ui-font bg-white text-slate-900">

{{-- Sticky Odoo-like navbar (same content/links) --}}
<header class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-slate-100">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between py-4">

        {{-- Logo --}}
        <a href="{{ route('landing') }}" class="flex items-center gap-2">
            <div class="text-3xl font-extrabold tracking-tight text-purple-700">nexa</div>
        </a>

        {{-- Desktop menu --}}
        <ul class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
            <li><a href="{{ route('modules.index') }}" class="hover:text-slate-900 transition">Apps</a></li>
            <li><a href="#" class="hover:text-slate-900 transition">Industries</a></li>
            <li><a href="#" class="hover:text-slate-900 transition">Community</a></li>
            <li><a href="#" class="hover:text-slate-900 transition">Pricing</a></li>
            <li><a href="#" class="hover:text-slate-900 transition">Help</a></li>
        </ul>

        {{-- Right actions --}}
        <div class="hidden md:flex items-center gap-3">
            <a href="{{ route('login') }}"
               class="text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
                Sign in
            </a>

            <a href="{{ route('modules.index') }}"
               class="inline-flex items-center rounded-lg bg-purple-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-800 transition">
                Try it free
            </a>
        </div>

        {{-- Mobile menu button --}}
        <button id="menuBtn"
                class="md:hidden inline-flex items-center justify-center p-2 rounded-md hover:bg-slate-100 transition"
                aria-label="Open menu">
            <svg class="w-6 h-6 text-slate-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </nav>

    {{-- Mobile menu panel --}}
    <div id="mobileMenu" class="md:hidden hidden pb-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-xl border border-slate-200 bg-white shadow-sm p-3">
                <ul class="flex flex-col gap-2 text-sm font-semibold text-slate-700">
                    <li><a class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition" href="{{ route('modules.index') }}">Apps</a></li>
                    <li><a class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition" href="#">Industries</a></li>
                    <li><a class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition" href="#">Community</a></li>
                    <li><a class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition" href="#">Pricing</a></li>
                    <li><a class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition" href="#">Help</a></li>
                </ul>

                <div class="mt-3 flex items-center gap-3 px-2">
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900 transition">
                        Sign in
                    </a>
                    <a href="{{ route('modules.index') }}"
                       class="ml-auto inline-flex items-center rounded-lg bg-purple-700 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-purple-800 transition">
                        Try it free
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>

<main class="relative overflow-x-clip">

    {{-- HERO (same text/buttons/price, just better layout) --}}
    <section class="relative">
        {{-- subtle background blobs like Odoo (no content change) --}}
        <div class="absolute inset-0 -z-10">
            <div class="absolute -top-24 -left-24 h-80 w-80 rounded-full bg-purple-100 blur-3xl"></div>
            <div class="absolute -top-10 right-0 h-96 w-96 rounded-full bg-amber-100 blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-16 md:pb-24">
            <div class="relative text-center max-w-4xl mx-auto">
                <h1 class="handwriting text-[2.6rem] sm:text-6xl md:text-7xl font-bold leading-[1.1] tracking-wide">
                    All your business on <span class="brush">one platform.</span>
                </h1>

                <p class="handwriting mt-6 text-3xl sm:text-4xl md:text-5xl font-semibold">
                    Simple, efficient, yet <span class="scribble">affordable!</span>
                </p>

                {{-- CTAs --}}
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('modules.index') }}"
                       class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-purple-700 px-8 py-3.5 text-white font-semibold shadow-md hover:bg-purple-800 transition">
                        Start now - it's free
                    </a>

                    <button
                        class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-white border border-slate-200 px-8 py-3.5 font-semibold text-purple-800 shadow-sm hover:bg-slate-50 transition">
                        Meet an advisor
                        <svg class="ml-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.2l3.71-3.97a.75.75 0 111.1 1.02l-4.25 4.55a.75.75 0 01-1.1 0L5.21 8.29a.75.75 0 01.02-1.08z"
                                  clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                {{-- Price callout — same text, positioned nicer --}}
                <div class="mt-10 md:mt-0 md:absolute md:-right-4 md:top-20 handwriting text-2xl text-purple-900">
                    <div class="relative inline-block">
                        <svg class="hidden md:block absolute -left-24 -top-8 h-24 w-24 text-purple-900"
                             viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="3">
                            <path d="M90 10 C50 20, 50 70, 10 80" />
                            <path d="M12 78 L20 70" />
                            <path d="M12 78 L22 84" />
                        </svg>

                        <p class="leading-snug text-center md:text-left">
                            US$ 7.25 / month<br>
                            for ALL apps
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Smooth curved background (same SVG + section) --}}
    <section class="relative">
        <svg class="absolute inset-x-0 -top-10 w-full h-40 text-slate-100" viewBox="0 0 1440 320" preserveAspectRatio="none">
            <path fill="currentColor" d="M0,160L48,176C96,192,192,224,288,218.7C384,213,480,171,576,165.3C672,160,768,192,864,213.3C960,235,1056,245,1152,234.7C1248,224,1344,192,1392,176L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>

        <div class="relative bg-slate-100 pt-16 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                {{-- Apps grid from DB (same cards/content, better hover) --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6 md:gap-8">
                    @foreach($modules as $module)

                        @php
                            $iconMap = [
                                'accounting' => ['icon'=>'calculator', 'color'=>'text-purple-600'],
                                'sales'      => ['icon'=>'users',      'color'=>'text-pink-600'],
                                'purchase'   => ['icon'=>'refresh',    'color'=>'text-teal-600'],
                                'inventory'  => ['icon'=>'store',      'color'=>'text-amber-600'],
                                'documents'  => ['icon'=>'file',       'color'=>'text-blue-600'],
                                'crm'        => ['icon'=>'users',      'color'=>'text-pink-600'],
                                'pos'        => ['icon'=>'store',      'color'=>'text-amber-600'],
                                'projects'   => ['icon'=>'clipboard',  'color'=>'text-emerald-600'],
                                'timesheets' => ['icon'=>'clock',      'color'=>'text-slate-700'],
                            ];

                            $ui = $iconMap[$module->code] ?? ['icon'=>'file', 'color'=>'text-slate-700'];
                        @endphp

                        <a href="{{ route('modules.show', $module->code) }}"
                           class="group flex flex-col items-center text-center rounded-2xl bg-white p-4 shadow-sm hover:shadow-md hover:-translate-y-1 transition border border-transparent hover:border-slate-100">
                            <div class="h-16 w-16 md:h-18 md:w-18 rounded-xl bg-slate-50 grid place-items-center group-hover:bg-slate-100 transition">
                                @switch($ui['icon'])
                                    @case('calculator')
                                        <svg class="h-8 w-8 {{ $ui['color'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <rect x="4" y="3" width="16" height="18" rx="2"/>
                                            <path d="M8 7h8M8 11h.01M12 11h.01M16 11h.01M8 15h.01M12 15h.01M16 15h.01"/>
                                        </svg>
                                        @break
                                    @case('users')
                                        <svg class="h-8 w-8 {{ $ui['color'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <circle cx="9" cy="8" r="3"/><circle cx="17" cy="8" r="3"/>
                                            <path d="M2 20c1.5-3 5-4 7-4s5.5 1 7 4"/>
                                        </svg>
                                        @break
                                    @case('refresh')
                                        <svg class="h-8 w-8 {{ $ui['color'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <path d="M21 12a9 9 0 10-3.3 6.9"/><path d="M21 3v6h-6"/>
                                        </svg>
                                        @break
                                    @case('store')
                                        <svg class="h-8 w-8 {{ $ui['color'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <path d="M3 9l2-5h14l2 5"/><path d="M5 9v10h14V9"/>
                                            <path d="M9 19v-6h6v6"/>
                                        </svg>
                                        @break
                                    @case('file')
                                        <svg class="h-8 w-8 {{ $ui['color'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <path d="M6 2h9l5 5v15H6z"/><path d="M15 2v5h5"/>
                                        </svg>
                                        @break
                                    @case('clipboard')
                                        <svg class="h-8 w-8 {{ $ui['color'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <rect x="6" y="4" width="12" height="18" rx="2"/>
                                            <path d="M9 4h6v3H9z"/>
                                        </svg>
                                        @break
                                    @case('clock')
                                        <svg class="h-8 w-8 {{ $ui['color'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                            <circle cx="12" cy="12" r="9"/><path d="M12 7v6l4 2"/>
                                        </svg>
                                        @break
                                @endswitch
                            </div>

                            <p class="mt-3 text-sm font-semibold text-slate-800 group-hover:text-slate-900 transition">
                                {{ $module->name }}
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</main>

{{-- Tiny JS for mobile menu --}}
<script>
    const btn = document.getElementById('menuBtn');
    const menu = document.getElementById('mobileMenu');
    btn?.addEventListener('click', () => menu.classList.toggle('hidden'));
</script>

</body>
</html>
