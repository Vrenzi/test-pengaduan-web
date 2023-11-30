<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Form Tanggapan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-900">
                    <!-- ... (bagian form lainnya) -->
    <form method="POST" action="{{ route('tanggapan.store') }}">
        @csrf
        <input type="hidden" name="id_pengaduan" value="{{ $id_pengaduan }}">
    
            <div class="mb-4">
                <label for="tanggapan" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">
                    Tanggapan:
                </label>
                    <textarea id="tanggapan" name="tanggapan" rows="4" cols="50" class="border-gray-300 dark:border-gray-600 focus:outline-none focus:border-indigo-500 dark:focus:border-indigo-500 rounded-md w-full px-3 py-2"></textarea>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
