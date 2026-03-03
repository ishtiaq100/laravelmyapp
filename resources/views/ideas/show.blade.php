<x-layout>

    <!-- Idea Header -->
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-6">

        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $idea->title }}
                </h1>

                <p class="text-gray-600 mt-2">
                    {{ $idea->description ?? 'No description provided.' }}
                </p>
            </div>

            <span class="px-3 py-1 text-sm rounded-full
                {{ $idea->status->value === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                {{ $idea->status->value === 'completed' ? 'bg-green-100 text-green-800' : '' }}">
                {{ ucfirst($idea->status->value) }}
            </span>
        </div>

        <!-- Links -->
        @if (!empty($idea->links))
            <div class="mt-4">
                <h3 class="font-semibold text-gray-700">Related Links</h3>
                <ul class="list-disc list-inside text-indigo-600">
                    @foreach ($idea->links as $link)
                        <li>
                            <a href="{{ $link }}" target="_blank" class="hover:underline">
                                {{ $link }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Steps Section -->
    <div class="max-w-4xl mx-auto mt-6 bg-white rounded-lg shadow p-6">

        <h2 class="text-xl font-bold text-gray-800 mb-4">
            Steps
        </h2>

        <!-- Add Step -->
        <form method="POST"
              action="{{ route('ideas.steps.store', $idea) }}"
              class="flex gap-3 mb-6">
            @csrf

            <input type="text"
                   name="description"
                   placeholder="Add a new step..."
                   class="flex-1 rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                   required>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                Add
            </button>
        </form>

        <!-- Steps List -->
        @if ($idea->steps->count())
            <ul class="space-y-3">
                @foreach ($idea->steps as $step)
                    <li class="flex items-center justify-between border rounded p-3">

                        <div class="flex items-center gap-3">
                            <!-- Toggle Completed -->
                            <form method="POST" action="{{ route('steps.update', $step) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="completed" value="{{ $step->completed ? 0 : 1 }}">
                                <input type="checkbox"
                                       onchange="this.form.submit()"
                                       {{ $step->completed ? 'checked' : '' }}>
                            </form>

                            <span class="{{ $step->completed ? 'line-through text-gray-400' : '' }}">
                                {{ $step->description }}
                            </span>
                        </div>

                        <!-- Delete Step -->
                        <form method="POST" action="{{ route('steps.destroy', $step) }}">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-600 hover:underline text-sm">
                                Delete
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">
                No steps added yet.
            </p>
        @endif
    </div>

</x-layout>