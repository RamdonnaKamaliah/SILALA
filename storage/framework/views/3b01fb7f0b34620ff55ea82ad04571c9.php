<?php $__env->startSection('title', 'Beranda User'); ?>

<?php $__env->startSection('content'); ?>
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

              <a href="<?php echo e(route('user.riwayatbuku')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold bg-white text-[#626F47] hover:bg-gray-100 cursor-pointer">
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
          <?php if(request()->has('status')): ?>
            <?php if(request()->status == 'sudah'): ?>
              <span class="inline-flex items-center gap-1 bg-[#98E690] text-[#1C4B1A] px-3 py-2 rounded-lg text-sm font-semibold">
                <span class="iconify" data-icon="mdi:check"></span> Sudah Dikembalikan
              </span>
            <?php elseif(request()->status == 'pinjam'): ?>
              <span class="inline-flex items-center gap-1 bg-[#E8D26E] text-[#5F5311] px-3 py-2 rounded-lg text-sm font-semibold">
                <span class="iconify" data-icon="mdi:clock-outline"></span> Sedang Dipinjam
              </span>
            <?php elseif(request()->status == 'belum'): ?>
              <span class="inline-flex items-center gap-1 bg-[#F19E9E] text-[#7E1D1D] px-3 py-2 rounded-lg text-sm font-semibold">
                <span class="iconify" data-icon="mdi:close"></span> Terlambat
              </span>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>

      <!-- Input Pencarian -->
      <div class="relative w-full md:w-64">
        <input type="text" placeholder="Cari Buku..."
          class="w-full rounded-full bg-white border border-[#E0D6B8] pl-4 pr-10 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#C5B78B]" />
        <span class="iconify absolute right-3 top-1/2 -translate-y-1/2 text-[#626F47]" data-icon="mdi:magnify" style="font-size:20px;"></span>
      </div>
    </div>

    <!-- Table -->
    <div class="mt-6 bg-white rounded-3xl shadow-sm overflow-x-auto">
      <?php if($riwayat->count() > 0): ?>
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
                  <img src="<?php echo e(asset($buku->foto_buku ?? 'assets/default-cover.jpg')); ?>"
                       alt="Buku"
                       class="w-[60px] h-[80px] object-cover rounded-lg shadow-lg flex-shrink-0 group-hover:shadow-xl transition-shadow duration-200">
                  <div class="min-w-0">
                    <p class="font-semibold text-sm leading-snug group-hover:text-[#626F47] transition-colors duration-200">
                      <?php echo e($buku->judul_buku); ?>

                    </p>
                    <p class="text-[#626F47] text-xs font-medium"><?php echo e($buku->penulis); ?></p>
                  </div>
                </a>
                <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
              </td>

              <td class="py-4 px-4 whitespace-nowrap relative">
                <?php echo e($tanggalPinjam); ?>

                <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
              </td>

              <td class="py-4 px-4 whitespace-nowrap relative">
                <?php echo e($tanggalKembali); ?>

                <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
              </td>

              <td class="py-4 px-4 text-[#2E2E2E] font-medium whitespace-nowrap relative">
                <?php if($status === 'dipinjam'): ?>
                  <?php if($isTerlambat): ?>
                    Telat <?php echo e($hariTelat); ?> Hari
                    <br><span class="text-xs text-orange-500">Teguran</span>
                  <?php else: ?>
                    Masih Dipinjam
                  <?php endif; ?>
                <?php elseif($status === 'menunggu_konfirmasi'): ?>
                  Menunggu Konfirmasi Admin
                <?php else: ?>
                  <?php if($data->keterangan && str_contains($data->keterangan, 'Terlambat')): ?>
                    <span class="text-orange-500">Tepat Waktu (Setelah Teguran)</span>
                  <?php else: ?>
                    Tepat Waktu
                  <?php endif; ?>
                <?php endif; ?>
                <span class="absolute right-0 top-1/2 -translate-y-1/2 w-px h-20 bg-[#F0EAD2]"></span>
              </td>

              <td class="py-4 px-4 whitespace-nowrap relative">
                <?php if($status === 'dipinjam'): ?>
                  <?php if($isTerlambat): ?>
                    <div class="flex items-start relative">
                      <span class="iconify text-[#B43131] w-4 h-4 absolute -left-4 mt-1" data-icon="mdi:alert-circle-outline"></span>
                      <div>
                        <span class="inline-flex items-center bg-[#FFEBCD] text-[#B43131] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
                          Terlambat
                        </span>
                        <span class="block mt-1 text-[11px] text-orange-500 italic">*Peringatan keterlambatan</span>
                      </div>
                    </div>
                  <?php else: ?>
                    <div class="flex items-center relative">
                      <span class="iconify text-[#A78C1E] w-4 h-4 absolute -left-4 self-center" data-icon="mdi:clock-outline"></span>
                      <span class="inline-flex items-center bg-[#FFF4C6] text-[#A78C1E] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
                        Sedang Dipinjam
                      </span>
                    </div>
                  <?php endif; ?>
                <?php elseif($status === 'menunggu_konfirmasi'): ?>
                  <div class="flex items-center relative">
                    <span class="iconify text-[#5F5311] w-4 h-4 absolute -left-4 self-center" data-icon="mdi:clock-alert-outline"></span>
                    <span class="inline-flex items-center bg-[#FFEBC6] text-[#5F5311] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
                      Menunggu Konfirmasi
                    </span>
                  </div>
                <?php else: ?>
                  <div class="flex items-center relative">
                    <span class="iconify text-[#2F7A2F] w-4 h-4 absolute -left-4 self-center" data-icon="mdi:check"></span>
                    <span class="inline-flex items-center bg-[#CCF6C2] text-[#2F7A2F] px-3 py-1.5 rounded-full text-xs font-semibold min-w-[150px] justify-center shadow-sm">
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
          <div class="text-[#626F47] text-lg font-semibold mb-2">
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
  <?php $__env->stopSection(); ?>
  
<?php echo $__env->make('layout_user.user', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/user/riwayatbuku.blade.php ENDPATH**/ ?>