<!-- resources/views/advertisements/show.blade.php -->

<x-app-layout>
    <div class="container mx-auto py-8 px-4 bg-gray-200">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-800">{{ $advertisement->titel }}</h1>
        </div>

        <div class="flex mb-8">
            <div class="w-2/3 pr-8">
            <div class="photo-container mb-8 rounded-lg shadow-lg overflow-hidden bg-gray-300 flex items-center justify-center">
                    <span class="text-black text-2xl">foto</span>
                </div>

                <div class="mb-8">
                    <p class="text-gray-700 text-lg mb-4">{{ $advertisement->beschrijving }}</p>
                    <p class="text-gray-800 font-semibold text-xl mb-2">Price: €{{ $advertisement->prijs }}</p>
                    <p class="text-gray-500">Posted: {{ $advertisement->created_at->diffForHumans() }}</p>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Leave a Review</h2>
                    <form action="{{ route('review.store', $advertisement->id) }}" method="POST">
                        @csrf
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
                            <label for="comment" class="block text-gray-700 mb-2">Comment</label>
                            <textarea name="comment" id="comment" rows="4" class="border border-gray-300 rounded-lg px-3 py-2 w-full"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Submit Review</button>
                        </div>
                    </form>
                </div>

                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 mt-12">Reviews</h2>
                    @foreach($advertisement->reviews as $review)
                        <div class="mb-6 border-b pb-4 relative">
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
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
                                    <p class="text-gray-800 font-semibold">{{ $review->user->name }}</p>
                                </div>
                            </div>
                            <div class="ml-8">
                                <p class="text-gray-800 font-semibold">{{ $review->rating }} stars</p>
                                <p class="text-gray-600">{{ $review->content }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="w-1/3">
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Poster Details</h2>
                    @if ($advertisement->user)
                        <p class="text-gray-700">Name: {{ $advertisement->user->name }}</p>
                        <p class="text-gray-700">Email: {{ $advertisement->user->email }}</p>
                    @else
                        <p class="text-gray-700">Poster details not available</p>
                    @endif
                    <div class="mt-4">
                        <a href="{{ route('seller.show', $advertisement->verkoper_id) }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">View Seller's Page</a>
                    </div>
                </div>

                <div>
                    <form action="{{ route('cart.add', $advertisement->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition duration-300 w-full">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .photo-container {
            position: relative;
            width: 100%;
            padding-top: 100%; /* 1:1 Aspect Ratio */
            background-color: #f3f4f6;
        }
        .photo {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: translate(-50%, -50%);
        }
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
