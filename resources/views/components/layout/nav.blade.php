@php
    $isActive = fn ($route) => request()->routeIs($route)
        ? 'text-indigo-600 border-b-2 border-indigo-600'
        : 'text-gray-600 hover:text-indigo-600';
@endphp

<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo -->
            <div class="text-xl font-bold text-indigo-600">
                LaravelApp
            </div>

            <!-- Links -->
            <div class="flex space-x-6 items-center">

                @guest
                    <a href="{{ route('login') }}"
                       class="pb-1 {{ $isActive('login') }}">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="pb-1 {{ $isActive('register') }}">
                        Register
                    </a>
                @endguest

                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="pb-1 {{ request()->is('dashboard') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-600 hover:text-indigo-600' }}">
                        Dashboard
                    </a>
                     <a href="{{ url('/ideas') }}"
                       class="pb-1 {{ request()->is('ideas') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-600 hover:text-indigo-600' }}">
                        Ideas
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-gray-600 hover:text-red-600">
                            Logout
                        </button>
                    </form>
                @endauth

            </div>
        </div>
    </div>
</nav>