
<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-6">Select a company</h1>

        <div class="grid gap-4">
            @foreach($companies as $company)
                <form method="POST" action="{{ route('companies.setCurrent') }}">
                    @csrf
                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                    <button class="w-full text-left p-4 bg-white rounded-xl shadow hover:shadow-md">
                        <div class="font-semibold">{{ $company->name }}</div>
                        <div class="text-sm text-gray-500">
                            Role: {{ $company->pivot->role }}
                        </div>
                    </button>
                </form>
            @endforeach
        </div>
    </div>
</x-app-layout>
