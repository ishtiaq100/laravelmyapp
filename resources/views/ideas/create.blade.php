<x-layout>

    <div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-6">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">
            Create New Idea
        </h1>

        <!-- Flash Messages -->
       

        <form method="POST" action="{{ route('ideas.store') }}" class="space-y-6">
            @csrf

            <!-- Idea Title -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Idea Title
                </label>
                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="Enter idea title">

                @error('title')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Description
                </label>
                <textarea name="description"
                          rows="4"
                          class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                          placeholder="Describe your idea">{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Links (comma separated) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Related Links
                </label>
                <input type="text"
                       name="links"
                       value="{{ old('links') }}"
                       placeholder="https://example.com, https://another.com"
                       class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">

                <p class="text-sm text-gray-500 mt-1">
                    Separate multiple links with commas.
                </p>

                @error('links')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Status
                </label>
                <select name="status"
                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>
                    <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>
                        Completed
                    </option>
                </select>

                @error('status')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('ideas.index') }}"
                   class="px-4 py-2 border rounded-md text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                    Create Idea
                </button>
            </div>

        </form>
    </div>

</x-layout>