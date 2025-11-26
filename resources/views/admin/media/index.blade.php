@extends('layout_admin.admin')

@section('pageTitle', 'Admin Dashboard - Data Buku')
@section('content')

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @foreach ($media as $item)
            <div
                class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition hover:shadow-lg hover:-translate-y-1">

                {{-- Image Preview --}}
                <div class="w-full h-40">
                    @if ($item->path_file)
                        @if ($item->path_file && Storage::disk('public')->exists($item->path_file))
                            <img src="{{ asset('storage/' . $item->path_file) }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('assets/image_default/image_default_book.jpeg') }}"
                                class="w-full h-full object-cover">
                        @endif
                    @endif
                </div>

                {{-- Info + Actions --}}
                <div class="p-3 flex flex-col gap-2">

                    <p class="text-lg text-gray-700 font-medium truncate">
                        {{ $item->buku?->judul_buku ?? 'Tidak ada judul' }}
                    </p>

                    {{-- Filename --}}
                    <p class="text-xs text-gray-700 font-medium truncate">
                        {{ basename($item->path_file) }}
                    </p>

                    {{-- Delete Button --}}
                    <form action="{{ route('admin.media.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="w-full bg-red-500 hover:bg-red-600 text-white text-xs py-1.5 rounded-lg">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

@endsection
