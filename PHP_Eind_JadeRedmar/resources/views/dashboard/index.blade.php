@extends('layouts.dashboard')

@section('content')
<div class="mx-auto px-4 h-screen overflow-y-auto max-w-4xl">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Dashboard</h1>

    <a href="{{ route('advertisements.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-6 inline-block">Create Advertisement</a>

    <form action="{{ route('contracts.upload') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label for="contract" class="block text-gray-700 font-semibold mb-2">Upload Contract (PDF)</label>
            <input type="file" name="contract" id="contract" class="border border-gray-300 rounded-lg px-3 py-2 w-full">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Upload</button>
    </form>

    @if($latestContract)
        <div class="my-8 p-6 bg-gray-200 rounded shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Latest Contract</h2>
            <p><strong>Date:</strong> {{ $latestContract->created_at->format('d-m-Y') }}</p>
            <p><strong>Status:</strong> {{ $latestContract->is_accepted ? 'Approved' : 'Not Approved' }}</p>
        </div>
    @else
        <p class="mt-6 text-gray-700">No contracts uploaded yet.</p>
    @endif

    <form action="{{ route('dashboard.update') }}" method="POST" class="bg-white p-6 rounded shadow-md mb-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="components" class="block text-gray-700">Choose components to customize:</label>
            <select id="components" class="w-full px-3 py-2 border rounded" multiple>
                <option value="background_color" @if($user->background_color) selected @endif>Background Color</option>
                <option value="intro_text" @if($user->intro_text) selected @endif>Introduction Text</option>
                <option value="company_description" @if($user->company_description) selected @endif>Company Description</option>
                <option value="profile_url" @if($user->profile_url) selected @endif>Profile picture URL</option>
                <option value="custom_url" @if($user->custom_url) selected @endif>Custom URL</option>
            </select>
        </div>

        <div id="background_color_input" class="mb-4 @if(!$user->background_color) hidden @endif">
            <label for="background_color" class="block text-gray-700">Background Color (Hex):</label>
            <input type="text" id="background_color" name="background_color" value="{{ old('background_color', $user->background_color) }}" class="w-full px-3 py-2 border rounded">
        </div>

        <div id="intro_text_input" class="mb-4 @if(!$user->intro_text) hidden @endif">
            <label for="intro_text" class="block text-gray-700">Introduction Text:</label>
            <textarea id="intro_text" name="intro_text" rows="4" class="w-full px-3 py-2 border rounded">{{ old('intro_text', $user->intro_text) }}</textarea>
        </div>

        <div id="company_description_input" class="mb-4 @if(!$user->company_description) hidden @endif">
            <label for="company_description" class="block text-gray-700">Company Description:</label>
            <textarea id="company_description" name="company_description" rows="4" class="w-full px-3 py-2 border rounded">{{ old('company_description', $user->company_description) }}</textarea>
        </div>

        <div id="profile_url_input" class="mb-4 @if(!$user->profile_url) hidden @endif">
            <label for="profile_url" class="block text-gray-700">Profile picture URL:</label>
            <input type="text" id="profile_url" name="profile_url" value="{{ old('profile_url', $user->profile_url) }}" class="w-full px-3 py-2 border rounded">
        </div>

        <div id="custom_url_input" class="mb-4 @if(!$user->custom_url) hidden @endif">
            <label for="custom_url" class="block text-gray-700">Custom URL:</label>
            <input type="text" id="custom_url" name="custom_url" value="{{ old('custom_url', $user->custom_url) }}" class="w-full px-3 py-2 border rounded">
        </div>
        
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Customizations</button>
    </form>

    @if ($user->intro_text)
        <div class="mb-6 p-4 bg-white rounded shadow-md" style="background-color: {{ $user->background_color ?? '#fff' }}">
            <h2 class="text-xl font-semibold text-gray-800">Introduction</h2>
            <p>{{ $user->intro_text }}</p>
        </div>
    @endif

    @if ($user->company_description)
        <div class="mb-6 p-4 bg-white rounded shadow-md" style="background-color: {{ $user->background_color ?? '#fff' }}">
            <h2 class="text-xl font-semibold text-gray-800">Company Description</h2>
            <p>{{ $user->company_description }}</p>
        </div>
    @endif

    @if ($user->custom_url)
        <div class="mb-6 p-4 bg-white rounded shadow-md" style="background-color: {{ $user->background_color ?? '#fff' }}">
            <h2 class="text-xl font-semibold text-gray-800">Custom URL</h2>
            <div class="text-blue-500">
                <img src="{{ $user->custom_url }}" alt="">
            </div>
        </div>
    @endif

    @if ($user->profile_url)
        <div class="mb-6 p-4 bg-white rounded shadow-md" style="background-color: {{ $user->background_color ?? '#fff' }}">
            <h2 class="text-xl font-semibold text-gray-800">Profile URL</h2>
            <div class="text-blue-500">
                <img src="{{ $user->profile_url }}" alt="">
            </div>
        </div>
    @endif

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const componentsSelect = document.getElementById('components');
        const componentsMap = {
            'background_color': document.getElementById('background_color_input'),
            'intro_text': document.getElementById('intro_text_input'),
            'company_description': document.getElementById('company_description_input'),
            'custom_url': document.getElementById('custom_url_input'),
            'profile_url': document.getElementById('profile_url_input'),
        };

        componentsSelect.addEventListener('change', function() {
            const selectedOptions = Array.from(this.selectedOptions).map(option => option.value);

            Object.keys(componentsMap).forEach(key => {
                if (selectedOptions.includes(key)) {
                    componentsMap[key].classList.remove('hidden');
                } else {
                    componentsMap[key].classList.add('hidden');
                }
            });
        });

        const event = new Event('change');
        componentsSelect.dispatchEvent(event);
    });
</script>
@endsection
