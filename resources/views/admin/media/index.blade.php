@extends('layout_admin.admin')

@section('pageTitle', 'Admin Dashboard - Media Buku')

@section('content')
    <div class="container mx-auto px-4 py-6">

        {{-- Header Section --}}
        <div class="bg-gradient-to-r from-[#A4B465] to-[#8fa050] rounded-xl shadow-lg p-6 mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">
                        <i class="fas fa-images mr-3"></i>Galeri Media Buku
                    </h1>
                    <p class="text-white/80">Kelola foto dan gambar buku perpustakaan</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-lg">
                        <span class="text-white/90 text-sm">Total Media:</span>
                        <strong class="text-white text-lg ml-2">{{ $media->count() }}</strong>
                    </div>
                    <a href="{{ route('admin.data_buku.create') }}"
                        class="bg-white text-[#A4B465] px-5 py-2.5 rounded-lg font-semibold hover:bg-gray-50 transition shadow-md">
                        <i class="fas fa-plus mr-2"></i>Upload Media
                    </a>
                </div>
            </div>
        </div>

        {{-- Alert Messages --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif

        {{-- Content Section --}}
        @if ($media->isEmpty())
            {{-- Empty State --}}
            <div class="bg-white rounded-xl shadow-sm border-2 border-dashed border-gray-300 p-16">
                <div class="max-w-md mx-auto text-center">
                    <div class="mb-6">
                        <i class="fas fa-folder-open text-gray-300 text-8xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">Belum Ada Media</h3>
                    <p class="text-gray-500 mb-6">
                        Galeri media masih kosong. Mulai dengan mengupload foto buku pertama Anda.
                    </p>
                    <a href="{{ route('admin.data_buku.create') }}"
                        class="inline-block bg-[#A4B465] text-white px-8 py-3 rounded-lg hover:bg-[#8fa050] transition shadow-md">
                        <i class="fas fa-upload mr-2"></i>Upload Media Pertama
                    </a>
                </div>
            </div>
        @else
            {{-- Grid Media --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5">
                @foreach ($media as $item)
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2">

                        {{-- Image Preview --}}
                        <div class="relative w-full h-48 bg-gray-100 group">
                            @if ($item->path_file && Storage::disk('public')->exists($item->path_file))
                                <img src="{{ asset('storage/' . $item->path_file) }}" class="w-full h-full object-cover"
                                    alt="{{ $item->nama_file }}">
                            @else
                                <img src="{{ asset('assets/image_default/image_default_book.jpeg') }}"
                                    class="w-full h-full object-cover opacity-60" alt="Default image">
                            @endif

                            {{-- Overlay saat hover --}}
                            <div
                                class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <a href="{{ asset('storage/' . $item->path_file) }}" target="_blank"
                                    class="bg-white text-gray-800 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-100">
                                    <i class="fas fa-search-plus mr-2"></i>Lihat
                                </a>
                            </div>
                        </div>

                        {{-- Info Card --}}
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800 mb-2 truncate text-sm" title="{{ $item->nama_file }}">
                                {{ $item->nama_file }}
                            </h3>

                            @if ($item->buku)
                                <p class="text-xs text-gray-500 mb-3 line-clamp-2">
                                    <i class="fas fa-book text-[#A4B465] mr-1"></i>
                                    {{ $item->buku->judul_buku }}
                                </p>
                            @else
                                <p class="text-xs text-gray-400 italic mb-3">
                                    <i class="fas fa-info-circle mr-1"></i>Belum digunakan
                                </p>
                            @endif

                            {{-- Actions --}}
                            <div class="flex gap-2">
                                <a href="{{ asset('storage/' . $item->path_file) }}" target="_blank"
                                    class="flex-1 text-center bg-blue-500 text-white px-3 py-2 rounded-lg text-xs font-medium hover:bg-blue-600 transition">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <form action="{{ route('admin.media.destroy', $item->id) }}" method="POST" class="flex-1"
                                    onsubmit="return confirm('⚠️ Yakin ingin menghapus {{ $item->nama_file }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full bg-red-500 text-white px-3 py-2 rounded-lg text-xs font-medium hover:bg-red-600 transition">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination jika perlu --}}
            {{-- <div class="mt-6">
            {{ $media->links() }}
        </div> --}}
        @endif

    </div>
@endsection
