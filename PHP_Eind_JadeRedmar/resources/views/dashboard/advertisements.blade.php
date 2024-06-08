@extends('layouts.dashboard');
@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Create Advertisement</h1>

    <form action="{{ route('advertisements.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title</label>
            <input type="text" id="title" name="title" class="w-full border border-gray-300 p-2 rounded" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea id="description" name="description" class="w-full border border-gray-300 p-2 rounded" required></textarea>
        </div>
        <div class="mb-4">
            <label for="url" class="block text-gray-700">URL</label>
            <input type="url" id="url" name="url" class="w-full border border-gray-300 p-2 rounded">
        </div>
        <div class="mb-4">
            <label for="components" class="block text-gray-700">Components (JSON format)</label>
            <textarea id="components" name="components" class="w-full border border-gray-300 p-2 rounded"></textarea>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create</button>
    </form>
</div>
@endsection
