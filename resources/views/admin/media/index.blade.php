@extends('layout_admin.admin')

@section('pageTitle', 'Admin Dashboard - Data Buku')
@section('content')

    <div class="p-6">
        <h2 class="text-2xl font-semibold mb-6">Galeri Foto Buku</h2>

        {{-- Grid Galeri --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">
            @forelse ($gambar as $g)
                <div class="bg-white shadow rounded-xl overflow-hidden border border-gray-200">

                    <img src="{{ asset($g->foto_buku) }}" class="w-full h-36 object-cover">

                    <div class="p-3">
                        <p class="text-xs text-gray-700 truncate">{{ $g->nama_file }}</p>

                        <form action="{{ route('admin.media.destroy', $g->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')

                            <button
                                class="w-full bg-red-500 hover:bg-red-600 text-white text-xs py-1.5 rounded-lg transition">
                                Hapus
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <p class="text-gray-500 col-span-full text-center">Belum ada gambar.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $gambar->links() }}
        </div>
    </div>

@endsection
