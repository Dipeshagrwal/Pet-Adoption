<x-app-layout>
    
        <div class="bg-gray-100 min-h-screen p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add New User</h2>

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" id="name" name="name" class="w-full p-3 mt-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="w-full p-3 mt-2 border border-gray-300 rounded-md" required>
                </div>

                <div class="mb-4">
                    <label for="role" class="block text-gray-700">Role</label>
                    <select id="role" name="role" class="w-full p-3 mt-2 border border-gray-300 rounded-md" required>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <button type="submit" class="bg-teal-600 text-white px-6 py-3 rounded-md hover:bg-teal-700">Create User</button>
            </form>
        </div>
    
</x-app-layout>
