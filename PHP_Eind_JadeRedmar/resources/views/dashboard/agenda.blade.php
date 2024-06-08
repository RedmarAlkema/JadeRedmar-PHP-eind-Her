@extends('layouts.dashboard')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-semibold mb-4">Agenda</h1>
        @if($advertisements->isEmpty())
            <p class="text-center">You have no scheduled pickups.</p>
        @else
            <table class="table-auto w-full mb-8">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Product</th>
                        <th class="px-4 py-2">Start Time</th>
                        <th class="px-4 py-2">End Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($advertisements as $advertisement)
                        <tr>
                            <td class="border px-4 py-2">{{ $advertisement->titel }}</td>
                            <td class="border px-4 py-2">{{ $advertisement->start_time->format('d-m-Y H:i') }}</td>
                            <td class="border px-4 py-2">{{ $advertisement->end_time->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
