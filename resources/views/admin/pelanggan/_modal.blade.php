<div id="pelangganModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-4 rounded-t-lg">
                <h3 id="modalTitle" class="text-lg font-semibold flex items-center">
                    <i class="fas fa-user-plus mr-2"></i> Tambah/Edit Pelanggan
                </h3>
            </div>
            <form id="pelangganForm" method="POST" class="p-6">
                @csrf
                <input type="hidden" name="pelanggan_id" id="pelanggan_id">
                @foreach (['nama' => 'Nama', 'noHP' => 'No. HP', 'alamat' => 'Alamat', 'keluhan' => 'Keluhan'] as $name => $label)
                    <div class="mb-4">
                        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                        @if($name === 'alamat' || $name === 'keluhan')
                            <textarea id="{{ $name }}" name="{{ $name }}" rows="3" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm"></textarea>
                        @else
                            <input type="text" id="{{ $name }}" name="{{ $name }}" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500 sm:text-sm">
                        @endif
                    </div>
                @endforeach
                <div class="flex justify-end space-x-3 mt-4">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>