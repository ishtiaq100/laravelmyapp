@if (session('success'))
    <div class="mb-4 rounded-md bg-green-50 p-4 border border-green-200">
        <p class="text-sm text-green-800 font-medium">
            {{ session('success') }}
        </p>
    </div>
@endif

@if (session('error'))
    <div class="mb-4 rounded-md bg-red-50 p-4 border border-red-200">
        <p class="text-sm text-red-800 font-medium">
            {{ session('error') }}
        </p>
    </div>
@endif

@if (session('warning'))
    <div class="mb-4 rounded-md bg-yellow-50 p-4 border border-yellow-200">
        <p class="text-sm text-yellow-800 font-medium">
            {{ session('warning') }}
        </p>
    </div>
@endif

@if (session('info'))
    <div class="mb-4 rounded-md bg-blue-50 p-4 border border-blue-200">
        <p class="text-sm text-blue-800 font-medium">
            {{ session('info') }}
        </p>
    </div>
@endif