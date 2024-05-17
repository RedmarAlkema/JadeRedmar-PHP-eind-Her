<!-- resources/views/advertisements/show.blade.php -->

<x-app-layout>
    <div class="container mx-auto py-8 px-10">
        <h1 class="text-3xl font-semibold mb-4">{{ $advertisement->titel }}</h1>
        <div class="bg-blue-100 rounded-lg shadow-md p-6 border border-gray-500 border-solid border-2">
            <p class="text-gray-600 mb-4">{{ $advertisement->beschrijving }}</p>
            <p class="text-gray-700 font-semibold">Price: €{{ $advertisement->prijs }}</p>
            <p class="text-gray-500 mt-2">Posted: {{ $advertisement->created_at->diffForHumans() }}</p>
        </div>
    </div>
</x-app-layout>
