<x-app-layout>
    <div class="container mx-auto py-8 px-10 bg-gray-200">
        <h1 class="text-3xl font-semibold mb-8">Your Pickup Schedule</h1>
        
        @if($purchases->isEmpty())
        <div class="p=ml-20">
            <p>You have no scheduled pickups.</p>
        </div>
        @else
            <table class="table-auto w-full mb-8 text-center">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Product</th>
                        <th class="px-4 py-2">Start Time</th>
                        <th class="px-4 py-2">End Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($purchases as $purchase)
                        <tr>
                            <td class="border px-4 py-2">{{ $purchase->advertisement->titel }}</td>
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($purchase->advertisement->start_time)->format('d-m-Y H:i') }}</td>
                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($purchase->advertisement->end_time)->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
