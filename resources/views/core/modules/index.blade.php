<x-guest-layout>
    <div class="max-w-6xl mx-auto py-12 px-4">

        {{-- Page Header --}}
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight">Modules</h1>
                <p class="text-gray-600 mt-2">
                    Choose the apps you need. Start free, add more anytime.
                </p>
            </div>

            {{-- Optional search (Alpine-ready) --}}
            <div x-data="{ q: '' }" class="w-full md:w-72">
                <input
                    x-model="q"
                    type="text"
                    placeholder="Search modules..."
                    class="w-full rounded-xl border-gray-200 focus:border-black focus:ring-black"
                />
            </div>
        </div>


        {{-- Modules Grid --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6"
             x-data="{ q: '' }"
             x-init="$watch('q', v => q = v)"
        >
            @forelse($modules as $module)

                {{-- Card --}}
                <div
                    class="bg-white rounded-2xl border shadow-sm hover:shadow-md transition p-6 flex flex-col"
                    x-show="('{{ strtolower($module->name) }} {{ strtolower($module->code) }} {{ strtolower($module->description ?? '') }}')
                            .includes(q.toLowerCase())"
                >
                    {{-- Module Title --}}
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <h2 class="text-xl font-semibold">
                                {{ $module->name }}
                            </h2>
                            <div class="text-xs text-gray-400 uppercase tracking-wide mt-1">
                                {{ $module->code }}
                            </div>
                        </div>

                        {{-- Optional status badge if company context exists --}}
                        @auth
                            @if(session('current_company_id'))
                                @php
                                    $subscribed = optional(
                                        $module->companies()
                                            ->where('companies.id', session('current_company_id'))
                                            ->wherePivotIn('status', ['trialing','active'])
                                            ->first()
                                    )->pivot;
                                @endphp

                                @if($subscribed)
                                    <span class="text-xs px-2 py-1 rounded-full bg-green-50 text-green-700 border border-green-200">
                                        {{ $subscribed->status }}
                                    </span>
                                @else
                                    <span class="text-xs px-2 py-1 rounded-full bg-gray-50 text-gray-600 border">
                                        not subscribed
                                    </span>
                                @endif
                            @endif
                        @endauth
                    </div>

                    {{-- Description --}}
                    <p class="text-gray-600 mt-4 line-clamp-3">
                        {{ $module->description ?? 'No description yet.' }}
                    </p>

                    {{-- Quick highlights (static placeholders you can customize per module later) --}}
                    <ul class="text-sm text-gray-500 mt-4 space-y-1">
                        <li>• Easy setup</li>
                        <li>• Company scoped</li>
                        <li>• Works with your team</li>
                    </ul>

                    {{-- Actions --}}
                    <div class="mt-6 flex items-center gap-3">
                        <a href="{{ route('modules.show', $module->code) }}"
                           class="px-4 py-2 rounded-xl bg-black text-white text-sm font-semibold hover:bg-gray-900 transition">
                            View details
                        </a>

                        @guest
                            <a href="{{ route('register.module', $module->code) }}"
                               class="px-4 py-2 rounded-xl bg-white border text-sm font-semibold hover:bg-gray-50 transition">
                                Join now
                            </a>
                        @endguest

                        @auth
                            @if(session('current_company_id'))
                                {{-- Show subscribe button only if not subscribed --}}
                                @php
                                    $isSubscribed = $module->companies()
                                        ->where('companies.id', session('current_company_id'))
                                        ->wherePivotIn('status', ['trialing','active'])
                                        ->exists();
                                @endphp

                                @if(!$isSubscribed)
                                    <form method="POST" action="{{ route('modules.subscribe', $module->code) }}">
                                        @csrf
                                        <button class="px-4 py-2 rounded-xl bg-white border text-sm font-semibold hover:bg-gray-50 transition">
                                            Subscribe
                                        </button>
                                    </form>
                                @endif
                            @endif
                        @endauth
                    </div>
                </div>

            @empty
                <div class="text-gray-500">
                    No modules found.
                </div>
            @endforelse
        </div>
    </div>
</x-guest-layout>
