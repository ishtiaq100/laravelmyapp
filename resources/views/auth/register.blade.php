<x-layout>
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-6">Create Account</h2>

    <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
        @csrf

        <input type="text" name="name" placeholder="Name"
            value="{{ old('name') }}"
            class="w-full border rounded px-3 py-2">

        @error('name')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror

        <input type="email" name="email" placeholder="Email"
            value="{{ old('email') }}"
            class="w-full border rounded px-3 py-2">

        @error('email')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror

        <input type="password" name="password" placeholder="Password"
            class="w-full border rounded px-3 py-2">

        @error('password')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror

        <button class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
            Register
        </button>

        <p class="text-sm text-center">
            Already have an account?
            <a href="{{ route('login') }}" class="text-indigo-600">Login</a>
        </p>
    </form>
</div>
</x-layout>