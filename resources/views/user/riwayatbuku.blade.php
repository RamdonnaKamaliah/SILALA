@extends('layout_user.user')

@section('title', 'Beranda User')

@section('content')
    <!-- Filter dan Pencarian -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
      <div class="flex flex-col sm:flex-row sm:items-start gap-4 sm:gap-6 w-full md:w-auto">
        
        <!-- Kolom Riwayat -->
        <div class="flex flex-col gap-2">
          <div class="flex items-center gap-2">
            <input type="radio" name="riwayat" id="pinjam" checked class="accent-[#626F47]"
                   onclick="window.location.href='/riwayatbuku'">
            <label for="pinjam" class="text-[#626F47] font-semibold text-sm">Riwayat Pinjam</label>
          </div>
          <div class="flex items-center gap-2">
            <input type="radio" name="riwayat" id="baca" class="accent-[#626F47]"
                   onclick="window.location.href='/riwayatbaca'">
            <label for="baca" class="text-[#626F47] font-semibold text-sm">Riwayat Baca</label>
          </div>
        </div>

        <!-- Wrapper Dropdown + Badge -->
        <div class="flex items-center gap-3">
          <!-- Dropdown Status -->
          <div class="relative" id="dropdownWrapper">
            <!-- Tombol -->
            <button id="dropdownButton"
              class="bg-white border border-[#E0D6B8] px-4 py-3 rounded-xl 
                     text-[#626F47] text-sm font-semibold flex items-center gap-2
                     shadow-lg shadow-[#C5B78B]/50">
              Status Peminjaman
              <span class="iconify w-6 h-6 transition duration-200" data-icon="mdi:chevron-down"></span>
            </button>

            <!-- Menu Dropdown -->
            <div id="dropdownMenu"
              class="absolute z-50 mt-2 left-0 w-52 shadow-lg rounded-lg overflow-hidden hidden">

              <a href="{{ route('user.riwayatbuku') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold bg-white text-[#626F47] hover:bg-gray-100 cursor-pointer">
                <span class="iconify" data-icon="mdi:format-list-bulleted" style="font-size:18px;"></span>
                Semua Status
              </a>

              <a href="?status=sudah" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold bg-[#98E690] text-[#1C4B1A] hover:bg-[#7FDA77] cursor-pointer">
                <span class="iconify" data-icon="mdi:check" style="font-size:18px;"></span>
                Sudah Dikembalikan
              </a>

              <a href="?status=pinjam" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold bg-[#E8D26E] text-[#5F5311] hover:bg-[#D5C059] cursor-pointer">
                <span class="iconify" data-icon="mdi:clock-outline" style="font-size:18px;"></span>
                Sedang Dipinjam
              </a>

              <a href="?status=belum" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold bg-[#F19E9E] text-[#7E1D1D] hover:bg-[#E57C7C] cursor-pointer">
                <span class="iconify" data-icon="mdi:close" style="font-size:18px;"></span>
                Terlambat
              </a>
            </div>
          </div>

          <!-- ✅ Badge Hanya Muncul Jika Ada request()->status -->
          @if(request()->has('status'))
            @if(request()->status == 'sudah')
              <span class="inline-flex items-center gap-1 bg-[#98E690] text-[#1C4B1A] px-3 py-2 rounded-lg text-sm font-semibold">
                <span class="iconify" data-icon="mdi:check"></span> Sudah Dikembalikan
              </span>
            @elseif(request()->status == 'pinjam')
              <span class="inline-flex items-center gap-1 bg-[#E8D26E] text-[#5F5311] px-3 py-2 rounded-lg text-sm font-semibold">
                <span class="iconify" data-icon="mdi:clock-outline"></span> Sedang Dipinjam
              </span>
            @elseif(request()->status == 'belum')
              <span class="inline-flex items-center gap-1 bg-[#F19E9E] text-[#7E1D1D] px-3 py-2 rounded-lg text-sm font-semibold">
                <span class="iconify" data-icon="mdi:close"></span> Terlambat
              </span>
            @endif
          @endif
        </div>
      </div>

      <button
        onclick="bukaModalPengembalian()"
        class="w-full md:w-64 rounded-full bg-[#a4b465] border border-[#a4b465] px-4 py-3 text-sm text-white flex items-center justify-center gap-2 hover:bg-[#8fa055] transition-colors">
        <span class="iconify" data-icon="mdi:camera" style="font-size:20px;"></span>
        Pengembalian Mandiri
      </button>
    </div>

    <!-- Table -->
    <div class="mt-6 bg-white rounded-3xl shadow-sm overflow-x-auto">
      @if($riwayat->count() > 0)
      <table class="min-w-full text-sm text-[#2E2E2E] border-collapse border border-[#F0EAD2]">
        <thead class="bg-cream text-[#626F47] font-semibold text-left">
          <tr>
            <th class="py-3 px-4 border-[#E6E6E6]">Buku</th>
            <th class="py-3 px-4 border-[#E6E6E6]">Tanggal Pinjam</th>
            <th class="py-3 px-4 border-[#E6E6E6]">Batas Pinjam</th>
            <th class="py-3 px-4 border-[#E6E6E6]">Keterangan</th>
            <th class="py-3 px-4">Status</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-[#F0EAD2]">
          @foreach ($riwayat as $data)
            @php
              $buku = $data->buku;
              $status = strtolower($data->status);
              $tanggalPinjam = \Carbon\Carbon::parse($data->tanggal_pinjam)->translatedFormat('d F Y');
              $tanggalKembali = \Carbon\Carbon::parse($data->tanggal_kembali)->translatedFormat('d F Y');

              // Gunakan accessor dari model
              $hariTelat = $data->hari_telat;
              $isTerlambat = $data->is_terlambat;
            @endphp
            <tr class="hover:bg-[#FFF8E8] transition">
              <td class="py-4 px-4 relative min-w-[220px]">
                <!-- 🔗 UBAH: Tambahkan link ke detail buku -->
                <a href="{{ route('user.detailbuku', ['id' => $buku->id, 'from' => 'riwayatbuku']) }}" 
                   class="flex items-center gap-3 hover:no-underline group">
                  <img src="{{ asset($buku->foto_buku ?? 'assets/default-cover.jpg') }}"
                       alt="Buku"
                       class="w-[60px] h-[80px] object-cover rounded-lg shadow-lg flex-shrink-0 group-hover:shadow-xl transition-shadow duration-200">
                  <div class="min-w-0">
                    <p class="font-semibold text-sm leading-snug group-hover:text-[#626F47] transition-colors duration-200">
                      {{ $buku->judul_buku }}
                    </p>
                    <p class="text-[#626F47] text-xs font-medium">{{ $buku->penulis }}</p>
                  </div>
                </a>
                <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
              </td>

              <td class="py-4 px-4 whitespace-nowrap relative">
                {{ $tanggalPinjam }}
                <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
              </td>

              <td class="py-4 px-4 whitespace-nowrap relative">
                {{ $tanggalKembali }}
                <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
              </td>


              <td class="py-4 px-4 text-[#2E2E2E] font-medium whitespace-nowrap relative">
    @if($data->keterangan && str_contains(strtolower($data->keterangan), 'teguran'))
        <!-- Tampilkan Keterangan Teguran dari Admin -->
        <div class="mb-1">
            <div class="flex flex-col">
                <span class="text-red-600 text-xs font-semibold break-words">
                    <i class="fas fa-exclamation-triangle mr-1"></i>
                    {{ $data->keterangan }}
                </span>
                <!-- Status tetap ditampilkan -->
                <div class="mt-1">
                    @if ($status === 'dipinjam')
                        @if ($isTerlambat)
                            <span class="text-red-600 text-sm">
                                Telat {{ $hariTelat }} Hari
                            </span>
                        @else
                            <span class="text-sm">Masih Dipinjam</span>
                        @endif
                    @elseif ($status === 'menunggu_konfirmasi')
                        <span class="text-sm">Menunggu Konfirmasi Admin</span>
                    @else
                        @if($data->keterangan && str_contains($data->keterangan, 'Terlambat'))
                            <span class="text-orange-500 text-sm">Tepat Waktu (Setelah Teguran)</span>
                        @else
                            <span class="text-sm">Tepat Waktu</span>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @else
        @if ($status === 'dipinjam')
            @if ($isTerlambat)
                Telat {{ $hariTelat }} Hari
                <br><span class="text-xs text-orange-500">Teguran</span>
            @else
                Masih Dipinjam
            @endif
        @elseif ($status === 'menunggu_konfirmasi')
            Menunggu Konfirmasi Admin
        @else
            @if($data->keterangan && str_contains($data->keterangan, 'Terlambat'))
                <span class="text-orange-500">Tepat Waktu (Setelah Teguran)</span>
            @else
                Tepat Waktu
            @endif
        @endif
    @endif
    <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
</td>
              <td class="py-4 px-4 whitespace-nowrap relative">
                @if ($status === 'dipinjam')
                  @if ($isTerlambat)
                    <div class="flex items-start relative">
                      <span class="iconify text-[#B43131] w-4 h-4 absolute -left-4 mt-1" data-icon="mdi:alert-circle-outline"></span>
                      <div>
                        <span class="inline-flex items-center bg-[#FFEBCD] text-[#B43131] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
                          Terlambat
                        </span>
                        <span class="block mt-1 text-[11px] text-orange-500 italic">*Peringatan keterlambatan</span>
                      </div>
                    </div>
                  @else
                    <div class="flex items-center relative">
                      <span class="iconify text-[#A78C1E] w-4 h-4 absolute -left-4 self-center" data-icon="mdi:clock-outline"></span>
                      <span class="inline-flex items-center bg-[#FFF4C6] text-[#A78C1E] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
                        Sedang Dipinjam
                      </span>
                    </div>
                  @endif
                @elseif ($status === 'menunggu_konfirmasi')
                  <div class="flex items-center relative">
                    <span class="iconify text-[#5F5311] w-4 h-4 absolute -left-4 self-center" data-icon="mdi:clock-alert-outline"></span>
                    <span class="inline-flex items-center bg-[#FFEBC6] text-[#5F5311] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
                      Menunggu Konfirmasi
                    </span>
                  </div>
                @else
                  <div class="flex items-center relative">
                    <span class="iconify text-[#2F7A2F] w-4 h-4 absolute -left-4 self-center" data-icon="mdi:check"></span>
                    <span class="inline-flex items-center bg-[#CCF6C2] text-[#2F7A2F] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
                      Sudah Dikembalikan
                    </span>
                  </div>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      @else
        <div class="text-center py-12">
          <div class="text-[#626F47] text-lg font-semibold mb-2">
            @if(request()->has('status'))
              Tidak ada data untuk status yang dipilih
            @else
              Belum ada riwayat peminjaman
            @endif
          </div>
          <p class="text-gray-500 text-sm">Silakan pinjam buku terlebih dahulu</p>
        </div>
      @endif
    </div>

    <!-- ====== MODAL PENGEMBALIAN MANDIRI (DILUAR NAV & MAIN) ====== -->
    <div id="pengembalianModal" class="hidden fixed inset-0 z-[1050] flex items-center justify-center bg-black/40 p-4">
      <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden relative">
        <!-- Header -->
        <div class="bg-[#4C6444] text-white text-center py-3 font-semibold text-lg">
          Pengembalian Mandiri
        </div>

        <!-- Isi Modal -->
        <div class="p-6 space-y-4 text-sm text-[#2E2E2E] max-h-[80vh] overflow-y-auto">

          <!-- Dropdown Pilihan Buku -->
          <div>
            <label class="font-semibold mb-1 block">Judul Buku</label>
            <select id="selectBukuModal" 
                class="w-full bg-[#F6D776] rounded-full px-4 py-2 text-sm text-center shadow-sm focus:outline-none">
                <option value="">-- Pilih Buku --</option>
                @foreach($riwayat->where('status','dipinjam') as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->buku->judul_buku }}
                    </option>
                @endforeach
            </select>
          </div>

          <!-- Pilihan Kamera -->
          <div>
            <label class="font-semibold mb-1 block">TAMPILAN LAYAR FOTO</label>
            <div class="grid grid-cols-2 gap-3">
              <button id="btnKameraDepan" onclick="pilihKamera('user')"
                  class="w-full bg-[#F6D776] border border-[#E0D6B8] text-[#2E2E2E] py-2 rounded-full flex items-center justify-center gap-2 hover:bg-[#e9ca65] transition-colors">
                  <span class="iconify" data-icon="mdi:camera-front"></span>
                  Kamera Depan
              </button>
              <button id="btnKameraBelakang" onclick="pilihKamera('environment')"
                  class="w-full bg-[#F6D776] border border-[#E0D6B8] text-[#2E2E2E] py-2 rounded-full flex items-center justify-center gap-2 hover:bg-[#e9ca65] transition-colors">
                  <span class="iconify" data-icon="mdi:camera-rear"></span>
                  Kamera Belakang
              </button>
            </div>
          </div>

          <!-- Area Kamera & Preview -->
          <div id="kameraArea" class="hidden">
            <!-- Area Kamera/Preview -->
            <div class="relative bg-black rounded-xl overflow-hidden mb-4" style="height: 280px;">
                <!-- Video Kamera -->
                <video id="kameraStream" autoplay 
                    class="w-full h-full object-cover absolute inset-0 z-10"></video>
                
                <!-- Preview Foto (Muncul Setelah Ambil Foto) -->
                <div id="previewContainer" class="absolute inset-0 z-20 hidden">
                    <img id="previewFoto" src="" class="w-full h-full object-cover">
                </div>
                
                <!-- Overlay Teks -->
                <div class="absolute inset-0 flex items-center justify-center z-30 pointer-events-none">
                    <div class="text-white text-center bg-black/50 px-4 py-3 rounded-lg">
                        <p class="text-lg font-semibold mb-1" id="judulBukuKamera">Judul Buku</p>
                        <p class="text-sm opacity-90">Arahkan kamera ke sampul buku</p>
                    </div>
                </div>
                
                <!-- Canvas untuk Menangkap Foto (Tersembunyi) -->
                <canvas id="fotoCanvas" class="hidden"></canvas>
            </div>

            <!-- Peringatan -->
            <div class="text-[13px] space-y-1 mb-4">
                <p class="text-[#DC2626] flex items-center gap-1">
                  <i class="fa-solid fa-triangle-exclamation"></i>
                  Pastikan sampul buku terlihat jelas
                </p>
                <p class="text-[#DC2626] flex items-center gap-1">
                  <i class="fa-solid fa-triangle-exclamation"></i>
                  Cahaya cukup untuk hasil foto yang baik
                </p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex gap-3">
                <!-- Tombol Ambil Foto (Muncul saat kamera aktif) -->
                <button id="btnAmbilFoto" onclick="ambilFoto()"
                    class="flex-1 bg-[#BFEA7C] text-[#2E2E2E] font-semibold text-sm px-5 py-2 rounded-full shadow-md hover:opacity-90 transition flex items-center justify-center gap-1">
                    <span class="iconify" data-icon="mdi:camera"></span>
                    Ambil Foto
                </button>
                
                <!-- Tombol Kirim Foto (Muncul setelah ambil foto) -->
                <button id="btnKirimFoto" onclick="kirimFoto()"
                    class="flex-1 bg-[#4C6444] text-white font-semibold text-sm px-5 py-2 rounded-full shadow-md hover:opacity-90 transition flex items-center justify-center gap-1 hidden">
                    <span class="iconify" data-icon="mdi:send"></span>
                    Kirim Foto
                </button>
            </div>
          </div>

          <!-- Tombol Batal (selalu tampil) -->
          <div class="flex justify-end gap-3 pt-4">
            <button onclick="tutupModal()" class="bg-[#DC2626] text-white font-semibold text-sm px-5 py-2 rounded-full shadow-md hover:opacity-90 transition">
              Batal
            </button>
          </div>

        </div>
      </div>
    </div>
@endsection