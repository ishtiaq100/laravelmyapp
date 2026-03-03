<x-layout>

    <div class="max-w-7xl mx-auto px-4 py-6">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                My Ideas
            </h1>

            <a href="{{ route('ideas.create') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                + New Idea
            </a>
        </div>

        <!-- Flash Messages -->
      

        <!-- Ideas Grid -->
        @if($ideas->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">

                @foreach($ideas as $idea)
                    <div class="bg-white shadow rounded-lg p-5 flex flex-col justify-between">

                        <!-- Idea Header -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-2">
                                {{ $idea->title }}
                            </h2>

                            @if($idea->description)
                                <p class="text-sm text-gray-600 mb-3 line-clamp-3">
                                    {{ $idea->description }}
                                </p>
                            @endif

                            <!-- Status -->
                            <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full
                                @if($idea->status->value === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($idea->status->value === 'in_progress') bg-blue-100 text-blue-800
                                @else bg-green-100 text-green-800
                                @endif
                            ">
                                {{ $idea->status->label() }}
                            </span>
                        </div>

                        <!-- Footer -->
                        <div class="mt-4 flex items-center justify-between text-sm text-gray-500">

                            <!-- Steps Count -->
                            <span>
                                {{ $idea->steps->count() }} Steps
                            </span>

                            <!-- Actions -->
                            <div class="flex gap-3">
                                <a href="{{ route('ideas.show', $idea) }}"
                                   class="text-indigo-600 hover:underline">
                                    View
                                </a>

                                <a href="{{ route('ideas.edit', $idea) }}"
                                   class="text-gray-600 hover:underline">
                                    Edit
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white shadow rounded-lg p-10 text-center">
                <p class="text-gray-600 mb-4">
                    You haven’t created any ideas yet.
                </p>

                <a href="{{ route('ideas.create') }}"
                   class="inline-block px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Create your first idea
                </a>
            </div>
        @endif

    </div>

</x-layout>