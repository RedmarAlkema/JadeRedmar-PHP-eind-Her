@extends('layouts.dashboard');
@section('content')
    <div class="container mx-auto py-8 px-4">
        <h1 class="text-2xl font-semibold mb-4">Create New Advertisement</h1>
        <form action="{{ route('advertisements.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-semibold mb-2">Title</label>
                <input type="text" name="title" id="title" class="border border-gray-300 rounded-lg px-3 py-2 w-full">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" id="description" rows="4" class="border border-gray-300 rounded-lg px-3 py-2 w-full"></textarea>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-semibold mb-2">Price</label>
                <input type="text" name="price" id="price" class="border border-gray-300 rounded-lg px-3 py-2 w-full">
            </div>
            <!-- Add more input fields for other advertisement details -->
            <div>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Create Advertisement</button>
            </div>
        </form>
    </div>
    @endsection

