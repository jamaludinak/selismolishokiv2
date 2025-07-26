<!-- Create Modal -->
<div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full animate-fade-in">
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-4 rounded-t-lg">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-user-plus mr-2"></i>
                    Tambah Pelanggan
                </h3>
            </div>
            <form id="createForm" action="{{ route('pelanggan.store') }}" method="POST" class="p-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-user mr-1 text-orange-500"></i>
                            Nama Pelanggan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                               placeholder="Masukkan nama pelanggan">
                    </div>
                    
                    <div>
                        <label for="noHP" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-phone mr-1 text-green-500"></i>
                            No. HP <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="noHP" name="noHP" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                               placeholder="Masukkan nomor HP">
                    </div>

                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-map-marker-alt mr-1 text-blue-500"></i>
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea id="alamat" name="alamat" rows="3" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                                  placeholder="Masukkan alamat lengkap"></textarea>
                    </div>

                    <div>
                        <label for="keluhan" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-exclamation-triangle mr-1 text-red-500"></i>
                            Keluhan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="keluhan" name="keluhan" rows="3" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                                  placeholder="Masukkan keluhan pelanggan"></textarea>
                    </div>
                </div>
                
                <div class="flex space-x-3 mt-6">
                    <button type="button" onclick="closeCreateModal()" 
                            class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition duration-200">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition duration-200">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 modal-backdrop hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full animate-fade-in">
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-6 py-4 rounded-t-lg">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Edit Pelanggan
                </h3>
            </div>
            <form id="editForm" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label for="edit_nama" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-user mr-1 text-orange-500"></i>
                            Nama Pelanggan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit_nama" name="nama" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                               placeholder="Masukkan nama pelanggan">
                    </div>
                    
                    <div>
                        <label for="edit_noHP" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-phone mr-1 text-green-500"></i>
                            No. HP <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="edit_noHP" name="noHP" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                               placeholder="Masukkan nomor HP">
                    </div>

                    <div>
                        <label for="edit_alamat" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-map-marker-alt mr-1 text-blue-500"></i>
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <textarea id="edit_alamat" name="alamat" rows="3" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                  placeholder="Masukkan alamat lengkap"></textarea>
                    </div>

                    <div>
                        <label for="edit_keluhan" class="block text-sm font-medium text-gray-700 mb-1">
                            <i class="fas fa-exclamation-triangle mr-1 text-red-500"></i>
                            Keluhan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="edit_keluhan" name="keluhan" rows="3" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500"
                                  placeholder="Masukkan keluhan pelanggan"></textarea>
                    </div>
                </div>
                
                <div class="flex space-x-3 mt-6">
                    <button type="button" onclick="closeEditModal()" 
                            class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition duration-200">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition duration-200">
                        <i class="fas fa-save mr-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>