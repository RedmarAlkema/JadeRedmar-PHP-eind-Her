<!-- resources/views/advertisements/show.blade.php -->

<x-app-layout>
    <div class="flex flex-col items-center justify-center mt-8">
        <!-- Advertisement Title -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-semibold">{{ $advertisement->titel }}</h1>
        </div>
        
        <!-- Advertisement Image -->
        <div class="bg-gray-400 h-64 w-64 flex items-center justify-center mb-8">
            <span class="text-black">foto</span>
        </div>
        
        <!-- Advertisement Description and Price -->
        <div class="text-center mb-8">
            <p class="text-gray-600 mb-4">{{ $advertisement->beschrijving }}</p>
            <p class="text-gray-700 font-semibold">Price: €{{ $advertisement->prijs }}</p>
            <p class="text-gray-500 mt-2">Posted: {{ $advertisement->created_at->diffForHumans() }}</p>
        </div>
        
        <!-- Add to Cart Form -->
        <form action="{{ route('cart.add', $advertisement->id) }}" method="POST" class="mb-8">
            @csrf
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Add to Cart</button>
        </form>
        
        <!-- Product Properties -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Product Properties</h2>
            <table class="table-auto border-collapse border border-gray-400">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Property</th>
                        <th class="border border-gray-300 px-4 py-2">Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Property 1</td>
                        <td class="border border-gray-300 px-4 py-2">Value 1</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">Property 2</td>
                        <td class="border border-gray-300 px-4 py-2">Value 2</td>
                    </tr>
                    <!-- Add more properties as needed -->
                </tbody>
            </table>
        </div>
        
        <!-- Leave a Review Form -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Leave a Review</h2>
            <form action="{{ route('review.store', $advertisement->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="rating" class="block text-gray-700">Rating</label>
                    <select name="rating" id="rating" class="border rounded px-2 py-1">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="comment" class="block text-gray-700">Comment</label>
                    <textarea name="comment" id="comment" rows="4" class="border rounded px-2 py-1 w-full"></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit Review</button>
            </form>
        </div>
    </div>
</x-app-layout>
