@props([
    'categories' => \App\Models\Category::all(),
    'selectedCategory' => null,
])

<div>
    <label for="category" class="block text-sm text-gray-500 dark:text-gray-300">
        Category
    </label>

    <select id="category" name="category" required
        class="block py-2.5 px-0 w-64 font-mono text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">

        @foreach ($categories as $category)
            <option value="{{ ucwords($category->name) }}" @selected($selectedCategory == ucwords($category->name))>{{ ucwords($category->name) }}
            </option>
        @endforeach
    </select>

    @error('category')
        <p class="text-xs text-red-400 font-semibold">{{ $message }}</p>
    @enderror
</div>
