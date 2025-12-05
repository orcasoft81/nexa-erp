<x-app-layout>
    <div class="max-w-5xl mx-auto py-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold">
                Applications — {{ $company->name }}
            </h1>

            <a href="{{ route('modules.index') }}"
               class="px-4 py-2 rounded-lg bg-black text-white">
                Add Module
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            @forelse($modules as $module)
                <a href="/{{ $module->code }}"
                   class="p-4 bg-white rounded-xl shadow hover:shadow-md">
                    <div class="font-semibold">{{ $module->name }}</div>
                    <div class="text-sm text-gray-500">{{ $module->description }}</div>
                    <div class="mt-2 text-xs uppercase text-green-600">
                        {{ $module->pivot->status }}
                    </div>
                </a>
            @empty
                <div class="text-gray-500">No modules subscribed yet.</div>
            @endforelse
        </div>
    </div>
</x-app-layout>

