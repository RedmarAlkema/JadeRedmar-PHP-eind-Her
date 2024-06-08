<x-app-layout>
    <div class="container mx-auto py-8 px-4 bg-gray-200">
        <h1 class="text-3xl font-semibold text-center mb-8">Purchase History</h1>
        @if($purchases->count())
            <ul class="list-disc">
                @foreach($purchases as $purchase)
                    <li>
                        <a href="{{ route('advertisement', $purchase->advertisement->id) }}" class="text-blue-500 hover:underline">
                            {{ $purchase->advertisement->titel }}
                        </a>
                        - Quantity: {{ $purchase->quantity }}
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-center">You haven't made any purchases yet.</p>
        @endif
    </div>
</x-app-layout>
