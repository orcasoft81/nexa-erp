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

        /* Scope protection from any global styles */
        .landing-scope a{ color: inherit !important; text-decoration: none !important; }
        .landing-scope a:hover{ text-decoration: none !important; }
        .landing-scope svg{ width:auto !important; height:auto !important; }

        .soft-shadow{ box-shadow: 0 10px 30px rgba(15,23,42,.08); }
        .soft-shadow-lg{ box-shadow: 0 18px 45px rgba(15,23,42,.12); }
    </style>
</head>

<body class="ui-font bg-white text-slate-900 landing-scope">

{{-- NAVBAR (Odoo-like) --}}
<header class="sticky top-0 z-50 bg-white/90 backdrop-blur border-b border-slate-100">
    <nav class="max-w-7xl mx-auto px-6 lg:px-8 flex items-center justify-between h-16">
        <a href="{{ route('landing') }}" class="flex items-center gap-2">
            <div class="text-2xl font-extrabold tracking-tight text-purple-700">nexa</div>
        </a>

        <ul class="hidden md:flex items-center gap-10 text-[15px] font-semibold text-slate-700">
            <li><a href="{{ route('modules.index') }}" class="hover:text-slate-900 transition">Apps</a></li>
            <li><a href="#" class="hover:text-slate-900 transition">Industries</a></li>
            <li><a href="#" class="hover:text-slate-900 transition">Community</a></li>
            <li><a href="#" class="hover:text-slate-900 transition">Pricing</a></li>
            <li><a href="#" class="hover:text-slate-900 transition">Help</a></li>
        </ul>

        <div class="hidden md:flex items-center gap-4">
            <a href="{{ route('login') }}" class="text-[15px] font-semibold text-slate-700 hover:text-slate-900 transition">
                Sign in
            </a>
            <a href="{{ route('modules.index') }}"
               class="inline-flex items-center rounded-md bg-purple-700 px-4 py-2 text-[15px] font-semibold text-white soft-shadow hover:bg-purple-800 transition">
                Try it free
            </a>
        </div>

        <button id="menuBtn" class="md:hidden p-2 rounded-lg hover:bg-slate-100 transition" aria-label="Open menu">
            <svg class="w-6 h-6 text-slate-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </nav>

    {{-- Mobile menu --}}
    <div id="mobileMenu" class="md:hidden hidden pb-4 px-6">
        <div class="rounded-xl border border-slate-200 bg-white soft-shadow p-3">
            <ul class="flex flex-col gap-2 text-sm font-semibold text-slate-700">
                <li><a class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition" href="{{ route('modules.index') }}">Apps</a></li>
                <li><a class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition" href="#">Industries</a></li>
                <li><a class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition" href="#">Community</a></li>
                <li><a class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition" href="#">Pricing</a></li>
                <li><a class="block px-3 py-2 rounded-lg hover:bg-slate-100 transition" href="#">Help</a></li>
            </ul>
            <div class="mt-3 flex items-center gap-3 px-2">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-slate-900 transition">
                    Sign in
                </a>
                <a href="{{ route('modules.index') }}"
                   class="ml-auto inline-flex items-center rounded-md bg-purple-700 px-4 py-2 text-sm font-semibold text-white soft-shadow hover:bg-purple-800 transition">
                    Try it free
                </a>
            </div>
        </div>
    </div>
</header>

<main class="relative overflow-x-clip">

    {{-- HERO (wide & centered like Odoo) --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 pt-16 pb-10 md:pb-16">
        <div class="text-center max-w-6xl mx-auto relative">
            <h1 class="handwriting text-[3.2rem] sm:text-7xl md:text-8xl font-bold leading-[1.05] tracking-wide">
                All your business on <span class="brush">one platform.</span>
            </h1>

            <p class="handwriting mt-6 text-4xl sm:text-5xl md:text-6xl font-semibold">
                Simple, efficient, yet <span class="scribble">affordable!</span>
            </p>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('modules.index') }}"
                   class="inline-flex items-center justify-center rounded-md bg-purple-700 px-8 py-3.5 text-white font-semibold soft-shadow hover:bg-purple-800 transition">
                    Start now - it's free
                </a>

                <button
                    class="inline-flex items-center justify-center rounded-md bg-white border border-slate-200 px-8 py-3.5 font-semibold text-purple-800 soft-shadow hover:bg-slate-50 transition">
                    Meet an advisor
                    <svg class="ml-2 h-4 w-4 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M5.23 7.21a.75.75 0 011.06.02L10 11.2l3.71-3.97a.75.75 0 111.1 1.02l-4.25 4.55a.75.75 0 01-1.1 0L5.21 8.29a.75.75 0 01.02-1.08z"
                              clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            {{-- price callout --}}
            <div class="mt-8 md:mt-0 md:absolute md:right-6 md:top-[62%] handwriting text-2xl text-purple-900">
                <div class="relative inline-block pl-10">
                    <svg class="hidden md:block absolute -left-5 -top-8 h-24 w-24 text-purple-900"
                         viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="3">
                        <path d="M10 20 C40 10, 70 20, 90 40" />
                        <path d="M88 38 L80 36" />
                        <path d="M88 38 L84 46" />
                    </svg>

                    <p class="leading-snug text-center md:text-left">
                        US$ 7.25 / month<br>
                        for ALL apps
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- MODULES SECTION (logo cards like Odoo grid) --}}
    <section class="relative">
        {{-- big soft arc --}}
        <div class="absolute inset-x-0 top-6 -z-10 h-[520px] md:h-[560px] bg-slate-100 rounded-[100%/65%]"></div>

        <div class="max-w-6xl mx-auto px-6 lg:px-8 pt-14 pb-20">
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-x-8 gap-y-12 place-items-center">
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
                        $ui = $iconMap[$module->code] ?? ['icon'=>'file','color'=>'text-slate-700'];
                    @endphp

                    <a href="{{ route('modules.show', $module->code) }}"
                       class="group w-[120px] sm:w-[130px] text-center select-none">
                        <div
                            class="mx-auto h-20 w-20 rounded-2xl bg-white border border-slate-200 soft-shadow grid place-items-center
                                   transition-all duration-200
                                   group-hover:soft-shadow-lg group-hover:-translate-y-1 group-hover:border-slate-300">
                            @switch($ui['icon'])
                                @case('calculator')
                                    <svg class="h-9 w-9 {{ $ui['color'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <rect x="4" y="3" width="16" height="18" rx="2"/>
                                        <path d="M8 7h8M8 11h.01M12 11h.01M16 11h.01M8 15h.01M12 15h.01M16 15h.01"/>
                                    </svg>
                                    @break
                                @case('users')
                                    <svg class="h-9 w-9 {{ $ui['color'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <circle cx="9" cy="8" r="3"/><circle cx="17" cy="8" r="3"/>
                                        <path d="M2 20c1.5-3 5-4 7-4s5.5 1 7 4"/>
                                    </svg>
                                    @break
                                @case('refresh')
                                    <svg class="h-9 w-9 {{ $ui['color'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path d="M21 12a9 9 0 10-3.3 6.9"/><path d="M21 3v6h-6"/>
                                    </svg>
                                    @break
                                @case('store')
                                    <svg class="h-9 w-9 {{ $ui['color'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path d="M3 9l2-5h14l2 5"/><path d="M5 9v10h14V9"/>
                                        <path d="M9 19v-6h6v6"/>
                                    </svg>
                                    @break
                                @case('clipboard')
                                    <svg class="h-9 w-9 {{ $ui['color'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <rect x="6" y="4" width="12" height="18" rx="2"/>
                                        <path d="M9 4h6v3H9z"/>
                                    </svg>
                                    @break
                                @case('clock')
                                    <svg class="h-9 w-9 {{ $ui['color'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <circle cx="12" cy="12" r="9"/><path d="M12 7v6l4 2"/>
                                    </svg>
                                    @break
                                @default
                                    <svg class="h-9 w-9 {{ $ui['color'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                        <path d="M6 2h9l5 5v15H6z"/><path d="M15 2v5h5"/>
                                    </svg>
                            @endswitch
                        </div>

                        <div class="mt-3 text-sm font-semibold text-slate-800 group-hover:text-slate-900 transition">
                            {{ $module->name }}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- PRODUCTS --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
        <div class="text-center max-w-3xl mx-auto">
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Products</h2>
            <p class="mt-3 text-slate-600">
                Choose what fits your business today, and add more when you grow.
            </p>
        </div>

        <div class="mt-10 grid md:grid-cols-3 gap-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 soft-shadow hover:soft-shadow-lg transition">
                <h3 class="text-lg font-bold">Nexa Suite</h3>
                <p class="mt-2 text-sm text-slate-600">
                    All core apps bundled in one subscription.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 soft-shadow hover:soft-shadow-lg transition">
                <h3 class="text-lg font-bold">Nexa Cloud</h3>
                <p class="mt-2 text-sm text-slate-600">
                    Fully hosted, secure, and always updated.
                </p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 soft-shadow hover:soft-shadow-lg transition">
                <h3 class="text-lg font-bold">Nexa Enterprise</h3>
                <p class="mt-2 text-sm text-slate-600">
                    Advanced governance, SSO, audit logs, and SLA.
                </p>
            </div>
        </div>
    </section>

    {{-- FEATURES --}}
    <section class="bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Features</h2>
                <p class="mt-3 text-slate-600">
                    Everything you need to run your company smoothly.
                </p>
            </div>

            <div class="mt-10 grid md:grid-cols-3 gap-6">
                <div class="rounded-2xl bg-white p-6 soft-shadow">
                    <h3 class="font-bold">Modular apps</h3>
                    <p class="mt-2 text-sm text-slate-600">Install only what you need.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 soft-shadow">
                    <h3 class="font-bold">Unified data</h3>
                    <p class="mt-2 text-sm text-slate-600">One database, no duplication.</p>
                </div>
                <div class="rounded-2xl bg-white p-6 soft-shadow">
                    <h3 class="font-bold">Fast onboarding</h3>
                    <p class="mt-2 text-sm text-slate-600">Be productive in days, not months.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- PARTNERS --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
        <div class="text-center max-w-3xl mx-auto">
            <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Partners</h2>
            <p class="mt-3 text-slate-600">
                Trusted by implementation teams and service providers.
            </p>
        </div>

        <div class="mt-10 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6 place-items-center">
            @for($i=1; $i<=6; $i++)
                <div
                    class="h-14 w-32 rounded-xl bg-white border border-slate-200 grid place-items-center text-slate-500 text-sm font-semibold soft-shadow">
                    Partner {{ $i }}
                </div>
            @endfor
        </div>
    </section>
</main>

{{-- FOOTER (dark gray with columns) --}}
<footer class="bg-slate-900 text-slate-200">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12 grid sm:grid-cols-2 md:grid-cols-4 gap-8">

        <div>
            <div class="text-2xl font-extrabold text-white">nexa</div>
            <p class="mt-3 text-sm text-slate-400">
                All your business on one platform.
            </p>
        </div>

        <div>
            <h4 class="font-bold text-white">Product</h4>
            <ul class="mt-3 space-y-2 text-sm text-slate-300">
                <li><a href="#">Apps</a></li>
                <li><a href="#">Pricing</a></li>
                <li><a href="#">Cloud</a></li>
                <li><a href="#">Enterprise</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-bold text-white">Company</h4>
            <ul class="mt-3 space-y-2 text-sm text-slate-300">
                <li><a href="#">About</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Partners</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-bold text-white">Resources</h4>
            <ul class="mt-3 space-y-2 text-sm text-slate-300">
                <li><a href="#">Help</a></li>
                <li><a href="#">Community</a></li>
                <li><a href="#">Docs</a></li>
                <li><a href="#">Security</a></li>
            </ul>
        </div>
    </div>

    <div class="border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-4 text-xs text-slate-500 flex flex-col sm:flex-row justify-between gap-2">
            <div>© 2025 Nexa ERP. All rights reserved.</div>
            <div class="flex gap-4">
                <a href="#" class="hover:text-slate-200">Privacy</a>
                <a href="#" class="hover:text-slate-200">Terms</a>
            </div>
        </div>
    </div>
</footer>

<script>
    const btn = document.getElementById('menuBtn');
    const menu = document.getElementById('mobileMenu');
    btn?.addEventListener('click', () => menu.classList.toggle('hidden'));
</script>

</body>
</html>
