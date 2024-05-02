<x-app-layout>
    <div class="container mx-auto py-8 px-10">
        <h1 class="text-3xl font-semibold mb-4 text-center">All Advertisements</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($advertisements as $advertisement)
                <div class="bg-blue-100 rounded-lg shadow-md p-4 col-span-2 border border-gray-500 border-solid border-2 relative">
                    <h2 class="text-lg font-semibold mb-2">{{ $advertisement->titel }}</h2>
                    <p class="text-gray-600">{{ $advertisement->beschrijving }}</p>
                    <p class="text-gray-700 mt-2">Price: €{{ $advertisement->prijs }}</p>
                    <p class="text-gray-500 absolute bottom-0 right-0 p-2">{{ $advertisement->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $advertisements->links() }}
        </div>
    </div>
</x-app-layout>
