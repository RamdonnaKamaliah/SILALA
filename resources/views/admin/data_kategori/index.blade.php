@extends('layout_admin.admin')

@section('pageTitle', 'Data Kategori')

@section('content')
    <div class="p-4 md:p-6 overflow-x-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-[#A4B465]">Data Kategori</h1>

            {{-- Tombol Tambah Kategori --}}
            <a href="{{ route('admin.data_kategori.create') }}"
                class="bg-blue-500 text-black px-4 py-2 rounded-lg hover:bg-[#8AA24F] transition duration-200">
                + Tambah Buku
            </a>
        </div>

        {{-- Tabel Data Buku --}}
        <div class="overflow-x-auto mt-4">
            <table id="dataTable" class="w-full border border-gray-300 rounded-lg text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>

                        <th class="px-4 py-2 border-b border-gray-300 text-left">Nama Kategori</th>
                        <th class="px-4 py-2 border-b border-gray-300 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_kategori as $kategori)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b border-gray-300">{{ $kategori->nama_kategori }}</td>
                            <td>
                                <form action="{{ route('admin.data_kategori.destroy', $kategori->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                </form>

                                <a href="{{ route('admin.data_kategori.show', $kategori->id) }}">
                                    <button class="text-green-600 hover:text-green-800">Detail</button>
                                </a>

                                <a href="{{ route('admin.data_kategori.edit', $kategori->id) }}">
                                    <button class="text-blue-600 hover:text-blue-800">Edit</button>
                                </a>
                            </td>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
                "pageLength": 5
            });
        });
    </script>
@endpush
