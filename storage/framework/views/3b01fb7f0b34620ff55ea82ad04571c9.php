<?php $__env->startSection('title', 'Beranda User'); ?>

<?php $__env->startSection('content'); ?>
<!-- Filter dan Pencarian -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
  <div class="flex flex-col sm:flex-row sm:items-start gap-4 sm:gap-6 w-full md:w-auto">

    <!-- Kolom Riwayat -->
    <div class="flex flex-col gap-2">
      <div class="flex items-center gap-2">
        <input type="radio" name="riwayat" id="pinjam" checked class="accent-green"
          onclick="window.location.href='/riwayatbuku'">
        <label for="pinjam" class="text-green font-semibold text-sm">Riwayat Pinjam</label>
      </div>
      <div class="flex items-center gap-2">
        <input type="radio" name="riwayat" id="baca" class="accent-green"
          onclick="window.location.href='/riwayatbaca'">
        <label for="baca" class="text-green font-semibold text-sm">Riwayat Baca</label>
      </div>
    </div>

    <!-- Wrapper Dropdown + Badge -->
    <div class="flex items-center gap-3">
      <!-- Dropdown Status -->
      <div class="relative" id="dropdownWrapper">
        <!-- Tombol -->
        <button id="dropdownButton"
          class="bg-white border border-white px-4 py-3 rounded-xl 
                     text-green text-sm font-semibold flex items-center gap-2
                     shadow-lg shadow-green/50">
          Status Peminjaman
          <span class="iconify w-6 h-6 transition duration-200" data-icon="mdi:chevron-down"></span>
        </button>

        <!-- Menu Dropdown -->
        <div id="dropdownMenu"
     class="absolute z-50 mt-2 left-0 w-52 shadow-lg rounded-lg overflow-hidden hidden">

  <a href="<?php echo e(route('user.riwayatbuku')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold bg-white text-green-600 hover:bg-gray-100 cursor-pointer">
    <span class="iconify" data-icon="mdi:format-list-bulleted" style="font-size:18px;"></span>
    Semua Status
  </a>

  <a href="?status=sudah" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold bg-green-300 text-green-900 hover:bg-green-400 cursor-pointer">
    <span class="iconify" data-icon="mdi:check" style="font-size:18px;"></span>
    Sudah Dikembalikan
  </a>

  <a href="?status=pinjam" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold bg-yellow-300 text-yellow-900 hover:bg-yellow-400 cursor-pointer">
    <span class="iconify" data-icon="mdi:clock-outline" style="font-size:18px;"></span>
    Sedang Dipinjam
  </a>

  <a href="?status=belum" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold bg-red-300 text-red-900 hover:bg-red-400 cursor-pointer">
    <span class="iconify" data-icon="mdi:close" style="font-size:18px;"></span>
    Terlambat
  </a>
</div>
</div>

      <!-- ✅ Badge Hanya Muncul Jika Ada request()->status -->
      <?php if(request()->has('status')): ?>
      <?php if(request()->status == 'sudah'): ?>
      <span class="inline-flex items-center gap-1 bg-primary text-green px-3 py-2 rounded-lg text-sm font-semibold">
        <span class="iconify" data-icon="mdi:check"></span> Sudah Dikembalikan
      </span>
      <?php elseif(request()->status == 'pinjam'): ?>
      <span class="inline-flex items-center gap-1 bg-yellow-300 text-yellow-900 px-3 py-2 rounded-lg text-sm font-semibold">
        <span class="iconify" data-icon="mdi:clock-outline"></span> Sedang Dipinjam
      </span>
      <?php elseif(request()->status == 'belum'): ?>
      <span class="inline-flex items-center gap-1 bg-red-300 text-red-900 px-3 py-2 rounded-lg text-sm font-semibold">
        <span class="iconify" data-icon="mdi:close"></span> Terlambat
      </span>
      <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>

  <?php
  $bukuSedangDipinjam = $riwayat->where('status', 'dipinjam')->count() > 0;
  ?>

 <button
  <?php if($bukuSedangDipinjam): ?>
    onclick="bukaModalPengembalian()"
  <?php else: ?>
    disabled
  <?php endif; ?>
  class="
    w-full md:w-64 rounded-full border px-4 py-3 text-sm
    flex items-center justify-center gap-2 transition-colors
    <?php echo e($bukuSedangDipinjam
        ? 'bg-primary border-primary text-white hover:bg-[#8fa055] cursor-pointer'
        : 'bg-gray-400 border-gray-400 text-white font-semibold cursor-not-allowed'); ?>

  "
>
  <span class="iconify" data-icon="mdi:camera" style="font-size:20px;"></span>
  Pengembalian Mandiri
</button>
</div>

<!-- Table -->
<div class="mt-6 bg-white rounded-3xl shadow-sm overflow-x-auto">
  <?php if($riwayat->count() > 0): ?>
  <table class="min-w-full text-sm text-[#2E2E2E] border-collapse border border-yellow-100">
    <thead class="bg-cream text-green font-semibold text-left">
      <tr>
        <th class="py-3 px-4 border-gray-200">Buku</th>
        <th class="py-3 px-4 border-gray-200">Tanggal Pinjam</th>
        <th class="py-3 px-4 border-gray-200">Batas Pinjam</th>
        <th class="py-3 px-4 border-gray-200">Keterangan</th>
        <th class="py-3 px-4">Status</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-yellow-100">
      <?php $__currentLoopData = $riwayat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
      $buku = $data->buku;
      $status = strtolower($data->status);
      $tanggalPinjam = \Carbon\Carbon::parse($data->tanggal_pinjam)->translatedFormat('d F Y');
      $tanggalKembali = \Carbon\Carbon::parse($data->tanggal_kembali)->translatedFormat('d F Y');

      // Gunakan accessor dari model
      $hariTelat = $data->hari_telat;
      $isTerlambat = $data->is_terlambat;
      ?>
      <tr class="hover:bg-[#FFF8E8] transition">
        <td class="py-4 px-4 relative min-w-[220px]">
          <!-- 🔗 UBAH: Tambahkan link ke detail buku -->
          <a href="<?php echo e(route('user.detailbuku', ['id' => $buku->id, 'from' => 'riwayatbuku'])); ?>"
            class="flex items-center gap-3 hover:no-underline group">
            <img src="<?php echo e(asset('storage/' . $buku->foto_buku ?? 'assets/default-cover.jpg')); ?>"
              alt="Buku"
              class="w-[60px] h-[80px] object-cover rounded-lg shadow-lg flex-shrink-0 group-hover:shadow-xl transition-shadow duration-200">
            <div class="min-w-0">
              <p class="font-semibold text-sm leading-snug group-hover:text-green transition-colors duration-200">
                <?php echo e($buku->judul_buku); ?>

              </p>
              <p class="text-green text-xs font-medium"><?php echo e($buku->penulis); ?></p>
            </div>
          </a>
          <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-orange_200"></span>
        </td>

        <td class="py-4 px-4 whitespace-nowrap relative">
          <?php echo e($tanggalPinjam); ?>

          <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-orange_200"></span>
        </td>

        <td class="py-4 px-4 whitespace-nowrap relative">
          <?php echo e($tanggalKembali); ?>

          <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-orange_200"></span>
        </td>
        <td class="py-4 px-4 text-gray-800 font-medium whitespace-nowrap relative">
          <?php if($data->keterangan && str_contains(strtolower($data->keterangan), 'teguran') && $data->metode_pengembalian == 'mandiri'): ?>
          <!-- Tampilkan Keterangan Teguran dari Admin (Hanya untuk pengembalian mandiri) -->
          <div class="flex flex-col gap-2">
            <span class="text-red-600 text-xs font-semibold break-words bg-red-50 px-3 py-2 rounded-lg border border-red-200">
              <div class="flex items-center gap-2 mb-1">
                <i class="fas fa-exclamation-triangle"></i>
                <span class="font-bold">PERLU FOTO ULANG</span>
              </div>
              <div class="text-[11px] text-gray-600">
                <?php echo e($data->keterangan); ?>

              </div>
            </span>

            <!-- Status dengan teks "lakukan foto kembali" -->
            <div class="flex items-center gap-2 text-sm">
              <?php if($status === 'menunggu_konfirmasi'): ?>
              <button data-id="<?php echo e($data->id); ?>" data-judul="<?php echo e($data->buku->judul_buku); ?>" onclick="bukaModalFotoUlang(this)"
                class="bg-primary text-white px-3 py-1.5 rounded-lg hover:bg-green text-xs font-semibold transition-all duration-200 flex items-center gap-2">
                <i class="fas fa-camera"></i>
                lakukan foto kembali
              </button>
              <?php endif; ?>
            </div>
          </div>
          <?php else: ?>
          <!-- Tampilkan informasi normal -->
          <?php if($status === 'dipinjam'): ?>
          <?php if($isTerlambat): ?>
          <div class="text-red-600">
            Telat <?php echo e($hariTelat); ?> Hari
          </div>
          <div class="text-xs text-orange-500 mt-1">
            <i class="fas fa-exclamation-circle mr-1"></i>
            Harap segera kembalikan
          </div>
          <?php else: ?>
          <span class="text-sm">Masih Dipinjam</span>
          <?php endif; ?>
         <?php elseif($status === 'menunggu_konfirmasi'): ?>
  <span class="text-yellow-600 text-sm flex flex-col items-center">
    <span>
      <i class="fas fa-clock mr-1"></i>
      Menunggu Konfirmasi Admin
    </span>

    <?php if($data->metode_pengembalian == 'mandiri'): ?>
      <span class="text-xs bg-primary text-white px-2 py-0.5 rounded-full w-fit mt-1">
        Mandiri
      </span>
    <?php endif; ?>
          <?php else: ?>
          <?php if($data->keterangan && str_contains($data->keterangan, 'Terlambat')): ?>
          <span class="text-red-500">Terlambat</span>
          <?php else: ?>
          <span class="text-green-600">Tepat Waktu</span>
          <?php endif; ?>
          <?php endif; ?>
          <?php endif; ?>
          <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-orange_200"></span>
        </td>
        <td class="py-4 px-4 whitespace-nowrap relative">
          <?php if($status === 'dipinjam'): ?>
          <?php if($isTerlambat): ?>
          <div class="flex items-start relative">
            <span class="iconify text-red-600 w-4 h-4 absolute -left-4 mt-1" data-icon="mdi:alert-circle-outline"></span>
            <div>
              <span class="inline-flex items-center bg-yellow-50 text-red-800 px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
                Terlambat
              </span>
              <span class="block mt-1 text-[11px] text-orange-500 italic">*Peringatan keterlambatan</span>
            </div>
          </div>
          <?php else: ?>
          <div class="flex items-center relative">
            <span class="iconify text-yellow-600 w-4 h-4 absolute -left-4 self-center" data-icon="mdi:clock-outline"></span>
            <span class="inline-flex items-center bg-white text-yellow-600 px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
              Sedang Dipinjam
            </span>
          </div>
          <?php endif; ?>
          <?php elseif($status === 'menunggu_konfirmasi'): ?>
          <div class="flex items-center relative">
            <span class="iconify text-yellow-700 w-4 h-4 absolute -left-4 self-center" data-icon="mdi:clock-alert-outline"></span>
            <span class="inline-flex items-center bg-[#FFEBC6] text-yellow-700 px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
              Menunggu Konfirmasi
            </span>
          </div>
          <?php else: ?>
          <div class="flex items-center relative">
            <span class="iconify text-green_dark w-4 h-4 absolute -left-4 self-center" data-icon="mdi:check"></span>
            <span class="inline-flex items-center bg-[#CCF6C2] text-green_dark px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
              Sudah Dikembalikan
            </span>
          </div>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
  <?php else: ?>
  <div class="text-center py-12">
    <div class="text-green text-lg font-semibold mb-2">
      <?php if(request()->has('status')): ?>
      Tidak ada data untuk status yang dipilih
      <?php else: ?>
      Belum ada riwayat peminjaman
      <?php endif; ?>
    </div>
    <p class="text-gray-500 text-sm">Silakan pinjam buku terlebih dahulu</p>
  </div>
  <?php endif; ?>
</div>

<!-- ====== MODAL PENGEMBALIAN MANDIRI (DILUAR NAV & MAIN) ====== -->
<div
  id="pengembalianModal"
  class="
    fixed inset-0 z-[1050] flex items-center justify-center
    bg-black/40 p-4
    <?php echo e($showPengembalianModal ?? false ? '' : 'hidden'); ?>

  "
>
  <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden relative">
    <!-- Header -->
    <div class="bg-green text-white text-center py-3 font-semibold text-lg">
      Pengembalian Mandiri
    </div>

    <!-- Isi Modal -->
    <div class="p-6 space-y-4 text-sm text-gray-800 max-h-[80vh] overflow-y-auto">

      <!-- Dropdown Pilihan Buku -->
      <div>
        <label class="font-semibold mb-1 block">Judul Buku</label>
        <select id="selectBukuModal"
          class="w-full bg-yellow-300 rounded-full px-4 py-2 text-sm text-center shadow-sm focus:outline-none">
          <option value="">-- Pilih Buku --</option>
          <?php $__currentLoopData = $riwayat->where('status','dipinjam'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($item->id); ?>">
            <?php echo e($item->buku->judul_buku); ?>

          </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
      </div>

      <!-- Pilihan Kamera -->
      <div>
        <label class="font-semibold mb-1 block">TAMPILAN LAYAR FOTO</label>
        <div class="grid grid-cols-2 gap-3">
          <button id="btnKameraDepan" onclick="pilihKamera('user')"
            class="w-full bg-yellow-300 border border-yellow-200 text-gray-800 py-2 rounded-full flex items-center justify-center gap-2 hover:bg-yellow-400 transition-colors">
            <span class="iconify" data-icon="mdi:camera-front"></span>
            Kamera Depan
          </button>
          <button id="btnKameraBelakang" onclick="pilihKamera('environment')"
            class="w-full bg-yellow-300 border border-yellow-200 text-gray-800 py-2 rounded-full flex items-center justify-center gap-2 hover:bg-yellow-400 transition-colors">
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
          <p class="text-red-600 flex items-center gap-1">
            <i class="fa-solid fa-triangle-exclamation"></i>
            Pastikan sampul buku terlihat jelas
          </p>
          <p class="text-red-600 flex items-center gap-1">
            <i class="fa-solid fa-triangle-exclamation"></i>
            Cahaya cukup untuk hasil foto yang baik
          </p>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex gap-3">
          <!-- Tombol Ambil Foto (Muncul saat kamera aktif) -->
          <button id="btnAmbilFoto" onclick="ambilFoto()"
            class="flex-1 bg-primary text-gray-800 font-semibold text-sm px-5 py-2 rounded-full shadow-md hover:opacity-90 transition flex items-center justify-center gap-1">
            <span class="iconify" data-icon="mdi:camera"></span>
            Ambil Foto
          </button>

          <!-- Tombol Kirim Foto (Muncul setelah ambil foto) -->
          <button
  id="btnKirimFoto"
  onclick="kirimFoto()"
  class="flex-1 bg-green text-white font-semibold text-sm px-5 py-2 rounded-full shadow-md hover:opacity-90 transition items-center justify-center gap-1 <?php echo e($showBtnKirim ?? false ? 'flex' : 'hidden'); ?>"
>
  <span class="iconify" data-icon="mdi:send"></span>
  Kirim Foto
</button>
        </div>
      </div>

      <!-- Tombol Batal (selalu tampil) -->
      <div class="flex justify-end gap-3 pt-4">
        <button type="button" onclick="tutupModal()" class="bg-red-600 text-white font-semibold text-sm px-5 py-2 rounded-full shadow-md hover:opacity-90 transition">
          Batal
        </button>
      </div>

    </div>
  </div>
</div>
<!-- ====== MODAL FOTO ULANG PENGEMBALIAN ====== -->
<div
  id="fotoUlangModal"
  class="
    fixed inset-0 z-[1050] flex items-center justify-center
    bg-black/40 p-4
    <?php echo e($showFotoUlangModal ?? false ? '' : 'hidden'); ?>

  "
>
  <div class="bg-white w-full max-w-md rounded-2xl shadow-xl overflow-hidden relative">
    <!-- Header -->
    <div class="bg-yellow-600 text-white text-center py-3 font-semibold text-lg" id="fotoUlangTitle">
      Foto Ulang Pengembalian
    </div>

    <!-- Isi Modal -->
    <div class="p-6 space-y-4 text-sm text-gray-800 max-h-[80vh] overflow-y-auto">

      <!-- Info Buku untuk Foto Ulang -->
      <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
        <div class="flex items-center gap-2 mb-2">
          <i class="fas fa-exclamation-triangle text-yellow-600"></i>
          <span class="font-semibold text-yellow-800">Foto Ulang Diperlukan</span>
        </div>
        <p class="text-sm font-semibold text-gray-700" id="judulBukuUlang">Judul Buku</p>
        <p class="text-xs text-gray-600 mt-1" id="keteranganTeguran"></p>
      </div>

      <!-- Pilihan Kamera -->
      <div>
  <label class="font-semibold mb-1 block">TAMPILAN LAYAR FOTO</label>
  <div class="grid grid-cols-2 gap-3">
    <button id="btnKameraDepanUlang" onclick="pilihKameraUlang('user')"
      class="w-full bg-yellow-300 border border-yellow-200 text-gray-800 py-2 rounded-full flex items-center justify-center gap-2 hover:bg-yellow-400 transition-colors">
      <span class="iconify" data-icon="mdi:camera-front"></span>
      Kamera Depan
    </button>
    <button id="btnKameraBelakangUlang" onclick="pilihKameraUlang('environment')"
      class="w-full bg-yellow-300 border border-yellow-200 text-gray-800 py-2 rounded-full flex items-center justify-center gap-2 hover:bg-yellow-400 transition-colors">
      <span class="iconify" data-icon="mdi:camera-rear"></span>
      Kamera Belakang
    </button>
  </div>
</div>

      <!-- Area Kamera & Preview -->
      <div id="kameraAreaUlang" class="hidden">
        <!-- Area Kamera/Preview -->
        <div class="relative bg-black rounded-xl overflow-hidden mb-4" style="height: 280px;">
          <!-- Video Kamera -->
          <video id="kameraStreamUlang" autoplay
            class="w-full h-full object-cover absolute inset-0 z-10"></video>

          <!-- Preview Foto (Muncul Setelah Ambil Foto) -->
          <div id="previewContainerUlang" class="absolute inset-0 z-20 hidden">
            <img id="previewFotoUlang" src="" class="w-full h-full object-cover">
          </div>

          <!-- Overlay Teks -->
          <div class="absolute inset-0 flex items-center justify-center z-30 pointer-events-none">
            <div class="text-white text-center bg-black/50 px-4 py-3 rounded-lg">
              <p class="text-lg font-semibold mb-1" id="judulBukuKameraUlang">Judul Buku</p>
              <p class="text-sm opacity-90">Arahkan kamera ke sampul buku</p>
            </div>
          </div>

          <!-- Canvas untuk Menangkap Foto (Tersembunyi) -->
          <canvas id="fotoCanvasUlang" class="hidden"></canvas>
        </div>

        <!-- Peringatan -->
        <div class="text-[13px] space-y-1 mb-4">
          <p class="text-red 600 flex items-center gap-1">
            <i class="fa-solid fa-triangle-exclamation"></i>
            Pastikan sampul buku terlihat jelas
          </p>
          <p class="text-red-600 flex items-center gap-1">
            <i class="fa-solid fa-triangle-exclamation"></i>
            Cahaya cukup untuk hasil foto yang baik
          </p>
        </div>

        <!-- Tombol Aksi -->
        <div class="flex gap-3">
          <!-- Tombol Ambil Foto (Muncul saat kamera aktif) -->
          <button id="btnAmbilFotoUlang" onclick="ambilFotoUlang()"
            class="flex-1 bg-primary text-gray-800 font-semibold text-sm px-5 py-2 rounded-full shadow-md hover:opacity-90 transition flex items-center justify-center gap-1">
            <span class="iconify" data-icon="mdi:camera"></span>
            Ambil Foto
          </button>

          <!-- Tombol Kirim Foto (Muncul setelah ambil foto) -->
          <button
  id="btnKirimFotoUlang"
  onclick="kirimFotoUlang()"
  class="flex-1 bg-yellow-600 text-white font-semibold text-sm px-5 py-2 rounded-full shadow-md hover:opacity-90 transition items-center justify-center gap-1 <?php echo e($showBtnKirimFotoUlang ?? false ? 'flex' : 'hidden'); ?>"
>
  <span class="iconify" data-icon="mdi:send"></span>
  Kirim Foto Ulang
</button>
        </div>
      </div>

      <!-- Tombol Batal (selalu tampil) -->
      <div class="flex justify-end gap-3 pt-4">
        <button onclick="tutupModalUlang()" class="bg-red-600 text-white font-semibold text-sm px-5 py-2 rounded-full shadow-md hover:opacity-90 transition">
          Batal
        </button>
      </div>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/user/riwayatbuku.blade.php ENDPATH**/ ?>