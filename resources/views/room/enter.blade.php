<x-layout>
    <div class=" bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
    <form action="{{ route('room.enterStore') }}" method="POST" class="max-w-md mx-auto mt-8 p-6 bg-white shadow-md rounded">
        @csrf  <!-- CSRF protection -->
    
        <div class="mb-4">
            <label for="room_name" class="block text-sm font-medium text-gray-700">Room Token:</label>
            <input type="text" id="room_name" name="room_token" required
                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                   @error('error')
                   <span><strong style="color: red">The token is invalid or has expired.</strong></span>
                       
                   @enderror
                </div>
    
        <button type="submit"
                class="w-full bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Enter Room
        </button>
    </form>
    </div>
</x-layout>