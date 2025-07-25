@extends('pelanggan.layouts.app')

@section('title', 'Upload Video Kerusakan')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
@endpush

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-orange-50 via-blue-50 to-purple-50 py-8">
        <!-- Header with orange color -->
        <div class="bg-orange-500 rounded-lg shadow-lg mb-8 overflow-hidden">
            <div class="px-6 py-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold flex items-center">
                            <i class="fas fa-video mr-3 text-4xl"></i>
                            Upload Video Kerusakan
                        </h1>
                        <p class="text-orange-100 mt-2">Upload video kerusakan untuk membantu teknisi memahami masalah</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('riwayats.index') }}" 
                           class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Riwayat
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4">
                    <h3 class="text-xl font-semibold text-white flex items-center">
                        <i class="fas fa-upload mr-2"></i>
                        Form Upload Video
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="text-center mb-6">
                        <p class="text-gray-600">Upload video kerusakan kendaraan untuk membantu teknisi memahami masalah (Max 100 MB)</p>
                    </div>

            <form id="video-upload-form" action="{{ route('pelanggan.upload.video') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto">
                @csrf
                <input type="hidden" name="no_resi" value="{{ request()->query('no_resi') }}">
                
                <div class="mb-6">
                    <label for="video" class="block text-sm font-semibold text-gray-700 mb-2">Upload Video Kerusakan</label>
                    <input type="file" id="video" name="video" accept="video/*" required 
                           class="block w-full rounded-md border-gray-300 px-3 py-2 shadow-sm ring-1 ring-inset ring-orange-300 focus:ring-2 focus:ring-orange-400">
                    <p class="mt-1 text-xs text-gray-500">Format yang didukung: MP4, MOV, AVI, WMV. Maksimal 100 MB.</p>
                </div>

                <div class="mb-6">
                    <button type="submit" 
                            class="block w-full rounded-md px-4 py-3 text-center text-sm font-semibold text-white bg-orange-600 hover:bg-orange-700 shadow-sm">
                        Upload Video
                    </button>
                </div>

                <div id="loading" class="hidden flex items-center justify-center mb-4">
                    <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-orange-600"></div>
                    <span class="ml-2 text-gray-600">Memproses...</span>
                </div>

                <div id="progress-text" class="text-center text-sm text-gray-700 hidden mb-4">0%</div>

                <div class="text-center">
                    <a href="{{ route('riwayats.index') }}" 
                       class="inline-flex items-center text-orange-600 hover:text-orange-800 text-sm font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Riwayat Reservasi
                    </a>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('video-upload-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const loadingElement = document.getElementById('loading');
            const progressText = document.getElementById('progress-text');

            loadingElement.classList.remove('hidden');
            progressText.classList.remove('hidden');

            const xhr = new XMLHttpRequest();
            xhr.open('POST', this.action, true);

            xhr.upload.addEventListener('progress', function(event) {
                if (event.lengthComputable) {
                    const percentComplete = (event.loaded / event.total) * 100;
                    progressText.textContent = Math.round(percentComplete) + '%';
                }
            });

            xhr.onload = function() {
                loadingElement.classList.add('hidden');
                progressText.classList.add('hidden');
                
                if (xhr.status === 200) {
                    const data = JSON.parse(xhr.responseText);
                    
                    if (data.success) {
                        Swal.fire({
                            title: 'Upload Berhasil',
                            text: 'Video berhasil diupload!',
                            icon: 'success',
                            confirmButtonText: 'Lihat Riwayat Reservasi'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route("riwayats.index") }}';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Upload Gagal',
                            text: data.message || 'Video gagal diupload!',
                            icon: 'error',
                            confirmButtonText: 'Tutup'
                        });
                    }
                } else {
                    Swal.fire({
                        title: 'Upload Gagal',
                        text: 'Terjadi kesalahan pada server!',
                        icon: 'error',
                        confirmButtonText: 'Tutup'
                    });
                }
            };

            xhr.onerror = function() {
                loadingElement.classList.add('hidden');
                progressText.classList.add('hidden');
                Swal.fire({
                    title: 'Upload Gagal',
                    text: 'Terjadi kesalahan jaringan!',
                    icon: 'error',
                    confirmButtonText: 'Tutup'
                });
            };

            xhr.send(formData);
        });
    </script>
@endpush
