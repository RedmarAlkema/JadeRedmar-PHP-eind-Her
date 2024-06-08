<!-- resources/views/home.blade.php -->

<x-app-layout>
    <div class="container mx-auto py-8 px-10 bg-gray-300">
        <h1 class="text-3xl font-semibold mb-4 text-center">All Advertisements</h1>
        
        <!-- Search form -->
        <form action="{{ route('home') }}" method="GET" class="mb-4">
            <div class="flex items-center">
                <input type="text" name="search" placeholder="Search by title" class="border rounded px-2 py-1 mr-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Search</button>
            </div>
        </form>

        <!-- Sort by dropdown -->
        <form action="{{ route('home') }}" method="GET" class="mb-4">
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

        <!-- Advertisement list -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($advertisements as $advertisement)
                <div class="relative">
                    
                        <div class="bg-blue-100 rounded-lg shadow-md p-4 col-span-2 border border-gray-500 border-solid border-2 relative">
                        <a href="{{ route('advertisement', ['id' => $advertisement->id]) }}">
                            <h2 class="text-lg font-semibold mb-2">{{ $advertisement->titel }}</h2>
                            <p class="text-gray-600">{{ $advertisement->beschrijving }}</p>
                            <p class="text-gray-700 mt-2">Price: €{{ $advertisement->prijs }}  {{$advertisement->eenheid}}</p>
                            <p class="text-gray-500 absolute bottom-0 right-0 p-2">{{ $advertisement->created_at->diffForHumans() }}</p>
                            </a>
                        </div>
                    
                    <form method="POST" action="{{ in_array($advertisement->id, $favoriteAdvertisementIds) ? route('unfavorite', $advertisement->id) : route('favorite', $advertisement->id) }}" class="absolute top-4 right-4">
                        @csrf
                        <button type="submit" class="favorite-icon">
                            @if (in_array($advertisement->id, $favoriteAdvertisementIds))
                                <!-- Heart icon filled -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-7 h-7 heart-icon text-red-500">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41 1.01 4.5 2.09C13.09 4.01 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                            @else
                                <!-- Heart icon outline -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 heart-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                </svg>
                            @endif
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Pagination links -->
        <div class="mt-8">
            {{ $advertisements->links() }}
        </div>
    </div>
</x-app-layout>
