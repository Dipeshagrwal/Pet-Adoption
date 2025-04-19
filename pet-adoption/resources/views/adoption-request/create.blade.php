<x-app-layout>

<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">Adoption Request for {{ $pet->name }}</h1>
    <form action="{{ route('adoption-request.store', $pet) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="adopter_name" class="block text-gray-700">Your Name</label>
            <input type="text" name="adopter_name" id="adopter_name" class="w-full px-4 py-2 border rounded-lg" required>
        </div>
        <div class="mb-4">
            <label for="adopter_contact" class="block text-gray-700">Your Contact Number</label>
            <input type="text" name="adopter_contact" id="adopter_contact" class="w-full px-4 py-2 border rounded-lg" required>
        </div>
        <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded-lg">Submit Request</button>
    </form>
</div>
@endsection
</x-app-layout>
