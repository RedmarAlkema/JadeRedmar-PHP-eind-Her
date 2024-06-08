<!-- resources/views/sellers/show.blade.php -->

<x-app-layout>
    <div class="container mx-auto py-8 px-4">
        <!-- Seller information -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">{{ $seller->name }}</h1>
            <p class="text-gray-700">{{ $seller->email }}</p>
        </div>

        <div class="mb-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Advertisements by {{ $seller->name }}</h2>
            <!-- Advertisement search form -->
            <form action="{{ route('seller.show', $seller->id) }}" method="GET" class="mb-4">
                <input type="text" name="search" placeholder="Search advertisements" class="border border-gray-300 rounded-lg px-3 py-2 mr-2">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Search</button>
            </form>
            <!-- Advertisement filter form -->
            <form action="{{ route('seller.show', $seller->id) }}" method="GET" class="mb-4">
                <label for="category" class="block text-gray-700 mb-2">Filter by Category</label>
                <select name="category" id="category" class="border border-gray-300 rounded-lg px-3 py-2 pr-8 mr-2">
                    <option value="">All Categories</option>
                    <option value="Electronics">Electronics</option>
                    <option value="Clothing">Clothing</option>
                    <option value="Furniture">Furniture</option>
                    <!-- Add more options for other categories -->
                </select>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Apply Filter</button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($advertisements as $advertisement)
                    <div class="border rounded-lg p-4 shadow-md bg-white">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $advertisement->titel }}</h3>
                        <p class="text-gray-700">{{ Str::limit($advertisement->beschrijving, 100) }}</p>
                        <p class="text-gray-800 font-semibold mt-2">Price: €{{ $advertisement->prijs }}</p>
                        <a href="{{ route('advertisement', $advertisement->id) }}" class="text-blue-500 hover:underline mt-2 block">View Advertisement</a>
                    </div>
                @endforeach
            </div>
            <!-- Pagination links -->
            {{ $advertisements->links() }}
        </div>

       
        <!-- Leave a review form -->
        <div class="mt-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Leave a Review for {{ $seller->name }}</h3>
            <form action="{{ route('seller.review') }}" method="POST">
                @csrf
                <input type="hidden" name="seller_id" value="{{ $seller->id }}">
                <div class="mb-6">
                    <label for="rating" class="block text-gray-700 mb-2">Rating</label>
                    <div class="flex items-center space-x-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 star" data-value="{{ $i }}">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="rating" value="0">
                </div>
                <div class="mb-6">
                    <label for="content" class="block text-gray-700 mb-2">Comment</label>
                    <textarea name="content" id="content" rows="4" class="border border-gray-300 rounded-lg px-3 py-2 w-full"></textarea>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Submit Review</button>
                </div>
            </form>
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Reviews for {{ $seller->name }}</h2>

            @foreach($sellerReviews as $sellerReview)
                <div class="mb-6 border-b pb-4 relative">
                    <div class="flex items-center">
                        <div class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $sellerReview->review->rating)
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="gold" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="gold" class="w-6 h-6 mr-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <div class="ml-2">
                            <p class="text-gray-800 font-semibold">{{ $sellerReview->review->user->name }}</p>
                        </div>
                    </div>
                    <div class="ml-8">
                        <p class="text-gray-800 font-semibold">{{ $sellerReview->review->rating }} stars</p>
                        <p class="text-gray-600">{{ $sellerReview->review->content }}</p>
                    </div>
                </div>
            @endforeach

        <!-- Pagination links -->
        {{ $sellerReviews->links() }}
    </div>
</div>

    <style>
        .star {
            cursor: pointer;
            stroke: gold;
            fill: none;
        }
        .star.filled {
            fill: gold;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating');
            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const rating = star.getAttribute('data-value');
                    ratingInput.value = rating;
                    stars.forEach(s => s.classList.remove('filled'));
                    for (let i = 0; i < rating; i++) {
                        stars[i].classList.add('filled');
                    }
                });
            });
        });
    </script>
</x-app-layout>
