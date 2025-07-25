@extends('LandingPage.layouts.app')

@section('title', 'Upload Video Kerusakan')

@section('content')
    <section class="py-24 bg-gray-100 px-6">
        <div class="container mx-auto max-w-lg">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-center">Upload Video Kerusakan (Max 100 MB)</h2>
                <form id="video-upload-form" action="{{ route('video.upload') }}" method="POST" enctype="multipart/form-data" class="mt-8">
                    @csrf
                    <input type="hidden" name="no_resi" value="{{ request()->query('no_resi') }}">
                    <div>
                        <label for="video" class="block text-sm font-semibold leading-6 text-black">Upload Video Kerusakan</label>
                        <input type="file" id="video" name="video" accept="video/*" required class="block w-full rounded-md border-0 px-3 py-2 shadow-sm ring-1 ring-inset ring-blue-300 focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div class="mt-8">
                        <button type="submit" class="block w-full rounded-md px-3.5 py-2.5 text-center text-sm font-semibold text-white" style="background-color: #ea580c;">Upload Video</button>
                    </div>
                    <div id="loading" class="hidden flex items-center justify-center mt-4">
                        <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-orange-600"></div>
                        <span class="ml-2 text-gray-600">Memproses...</span>
                    </div>
                    <div id="progress-text" class="text-center mt-2 text-sm text-gray-700 hidden">0%</div>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('js')
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
                if (xhr.status === 200) {
                    const data = JSON.parse(xhr.responseText);
                    if (data.success) {
                        Swal.fire({
                            title: 'Upload Berhasil',
                            text: 'Video berhasil diupload!',
                            icon: 'success',
                            confirmButtonText: 'Tutup'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Upload Gagal',
                            text: 'Video gagal diupload!',
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

            xhr.send(formData);
        });
    </script>
@endpush
