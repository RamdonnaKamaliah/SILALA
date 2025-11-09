<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @include('layout_dashboard.partial_dashboard.link')
  <title>SILALA | Riwayat Buku</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{ asset('assets_user/css/dashboard.css') }}">
</head>
<body class="min-h-screen overflow-hidden font-[Ubuntu,sans-serif] bg-white">
  @include('layout_dashboard.partial_dashboard.header')

  <main class="pt-4 pb-6 px-4 md:px-6 bg-cream
    absolute top-[90px] left-0 right-0 bottom-3 md:left-[320px] md:right-3
    rounded-3xl transition-all duration-300 z-30
    flex flex-col shadow-inner overflow-y-auto">

    <h2 class="text-xl font-semibold text-[#2E2E2E] mb-6">Riwayat Peminjaman</h2>

    @forelse($riwayat as $item)
      <div class="flex items-center bg-white shadow-sm rounded-xl p-4 mb-4">
        <img src="{{ asset('assets/buku3.jpg') }}" alt="Cover"
          class="w-20 h-28 object-cover rounded-lg mr-4">
        <div class="flex-1">
          <h3 class="font-semibold text-[#2E2E2E]">{{ $item->buku->judul ?? '-' }}</h3>
          <p class="text-sm text-[#626F47]">
            Tanggal Pinjam: {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
          </p>
          <p class="text-sm text-[#626F47]">
            Tanggal Kembali: {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
          </p>
          <p class="text-sm text-[#626F47]">
            Status:
            <span class="
              @if($item->status == 'dipinjam') text-yellow-600 
              @elseif($item->status == 'menunggu_konfirmasi') text-blue-600
              @elseif($item->status == 'bermasalah') text-red-600
              @else text-green-600 
              @endif">
              {{ ucfirst(str_replace('_', ' ', $item->status)) }}
            </span>
          </p>

          @if($item->denda > 0)
            <p class="text-sm text-red-600">Denda: Rp{{ number_format($item->denda, 0, ',', '.') }}</p>
          @endif
        </div>

        <div>
          @if($item->status == 'dipinjam')
            <form action="{{ route('user.riwayat.kembalikan', $item->id) }}" method="POST">
              @csrf
              @method('PUT')
              <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-md">
                Kembalikan Buku
              </button>
            </form>
          @elseif($item->status == 'menunggu_konfirmasi')
            <button disabled class="bg-gray-400 text-white px-3 py-2 rounded-md cursor-not-allowed">
              Menunggu Konfirmasi Admin
            </button>
          @elseif($item->status == 'dikembalikan')
            <span class="text-green-600 font-semibold">Selesai</span>
          @elseif($item->status == 'bermasalah')
            <span class="text-red-600 font-semibold">Bermasalah</span>
          @endif
        </div>
      </div>
    @empty
      <p class="text-gray-500">Belum ada riwayat peminjaman.</p>
    @endforelse
  </main>

  <script src="{{ asset('assets_user/js/dashboard.js') }}"></script>
</body>
</html>
