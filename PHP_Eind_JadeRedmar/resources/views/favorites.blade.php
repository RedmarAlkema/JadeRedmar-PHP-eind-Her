<!-- resources/views/favorites.blade.php -->

<x-app-layout>
    <div class="container mx-auto py-8 px-10 bg-gray-200">
        <h1 class="text-3xl font-semibold mb-4 text-center">Favorites</h1>
        
        <!-- Search form -->
        <form action="{{ route('favorites.index') }}" method="GET" class="mb-4">
            <div class="flex items-center">
                <input type="text" name="search" placeholder="Search by title" class="border rounded px-2 py-1 mr-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Search</button>
            </div>
        </form>

        <!-- Sort by dropdown -->
        <form action="{{ route('favorites.index') }}" method="GET" class="mb-4">
            <div class="flex items-center">
                <span class="mr-2">Sort by:</span>
                <select name="sort_by" class="border rounded px-2 py-1">
                    <option value="">None</option>
                    <option value="price_asc">Price (Low to High)</option>
                    <option value="price_desc">Price (High to Low)</option>
                    <option value="date_asc">Date (Old to New)</option>
                    <option value="date_desc">Date (New to Old)</option>
                    <option value="title_asc">Title (A to Z)</option>
                    <option value="title_desc">Title (Z to A)</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded ml-2">Sort</button>
            </div>
        </form>

        <!-- Favorite advertisement list -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse ($favorites as $favorite)
                <div class="bg-blue-100 rounded-lg shadow-md p-4 col-span-2 border border-gray-500 border-solid border-2 relative">
                    <h2 class="text-lg font-semibold mb-2">{{ $favorite->advertisement->titel }}</h2>
                    <p class="text-gray-600">{{ $favorite->advertisement->beschrijving }}</p>
                    <p class="text-gray-700 mt-2">Price: €{{ $favorite->advertisement->prijs }}</p>
                    <p class="text-gray-500 absolute bottom-0 right-0 p-2">{{ $favorite->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-center col-span-full">You have no favorites yet.</p>
            @endforelse
        </div>        

        <!-- Pagination links -->
        <div class="mt-8">
            {{ $favorites->links() }}
        </div>
    </div>
</x-app-layout>
