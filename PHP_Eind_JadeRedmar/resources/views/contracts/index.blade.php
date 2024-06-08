@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Contracts</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">File Path</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">User</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contracts as $contract)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $contract->id }}</td>
                            <td class="flex flex-row items-center">
                                <a href="{{ route('contracts.download', ['id' => $contract->id]) }}" class="underline">{{ $contract->file_path }}</a>
                            </td>
                        <td class="px-6 py-4">{{ $contract->user->name }}</td>
                        <td class="px-6 py-4">
                            @if($contract->is_accepted === null)
                                Pending
                            @else
                                {{ $contract->is_accepted ? 'Accepted' : 'Rejected' }}
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($contract->is_accepted === null)
                                <form action="{{ route('contracts.approve', $contract->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Approve</button>
                                </form>
                                <form action="{{ route('contracts.reject', $contract->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Reject</button>
                                </form>
                            @else
                                {{ $contract->is_accepted ? 'Approved' : 'Rejected' }}
                            @endif
                        </td>                       
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
