<!-- resources/views/home.blade.php -->

<x-app-layout>
    <div class="container mx-auto py-8 px-10">
        <h1 class="text-3xl font-semibold mb-4 text-center">All Advertisements</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($advertisements as $advertisement)
            <div class="relative">
                    <a href="{{ route('advertisement', $advertisement->id) }}" class="block">
                        <div class="bg-blue-100 rounded-lg shadow-md p-4 col-span-2 border border-gray-500 border-solid border-2 relative">
                            <h2 class="text-lg font-semibold mb-2">{{ $advertisement->titel }}</h2>
                            <p class="text-gray-600">{{ $advertisement->beschrijving }}</p>
                            <p class="text-gray-700 mt-2">Price: €{{ $advertisement->prijs }}</p>
                            <p class="text-gray-500 absolute bottom-0 right-0 p-2">{{ $advertisement->created_at->diffForHumans() }}</p>
                        </div>
                    </a>
                    <button class="favorite-icon absolute top-4 right-4" data-ad-id="{{ $advertisement->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7 heart-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </button>
                </div>
                @php
                dump($advertisement->id);   
                @endphp
            @endforeach
        </div>
        <div class="mt-8">
            {{ $advertisements->links() }}
        </div>
    </div>
</x-app-layout>
