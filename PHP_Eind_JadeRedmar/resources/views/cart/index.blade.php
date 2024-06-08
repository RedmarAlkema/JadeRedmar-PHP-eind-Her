<x-app-layout>
    <div class="container mx-auto py-8 px-10 bg-gray-200">
        <h1 class="text-3xl text-center font-semibold mb-8">Your Cart</h1>
        
        @if($cart && $cart->items->count())
            <table class="table-auto w-full mb-8">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Item</th>
                        <th class="px-4 py-2">Quantity</th>
                        <th class="px-4 py-2">Price</th>
                        <th class="px-4 py-2">Total</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart->items as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->advertisement->titel }}</td>
                            <td class="border px-4 py-2">{{ $item->quantity }}</td>
                            <td class="border px-4 py-2">€{{ $item->advertisement->prijs }}</td>
                            <td class="border px-4 py-2">€{{ $item->advertisement->prijs * $item->quantity }}</td>
                            <td class="border px-4 py-2">
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-right">
                <p class="text-2xl font-semibold">Total: €{{ $cart->items->sum(function($item) {
                    return $item->advertisement->prijs * $item->quantity;
                }) }}</p>
                <!-- Checkout button -->
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition duration-300">Checkout</button>
                </form>
            </div>
        @else
            <p class="text-center">Your cart is empty.</p>
        @endif
    </div>
</x-app-layout>
