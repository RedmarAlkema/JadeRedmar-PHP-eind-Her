<!-- resources/views/advertisements/show.blade.php -->

<x-app-layout>
    <div class="container mx-auto py-8 px-10 items-center justify-between relative">
        <h1 class="text-3xl text-center font-semibold mb-4">{{ $advertisement->titel }}</h1>
        <div class="bg-gray-100 h-100 w-100 text-center justify-between"> foto </div>
        <div class="text-center">
            <p class="text-gray-600 mb-4">{{ $advertisement->beschrijving }}</p>
            <p class="text-gray-700 font-semibold">Price: €{{ $advertisement->prijs }}</p>
            <p class="text-gray-500 mt-2">Posted: {{ $advertisement->created_at->diffForHumans() }}</p>
        </div>
    </div>
</x-app-layout>
