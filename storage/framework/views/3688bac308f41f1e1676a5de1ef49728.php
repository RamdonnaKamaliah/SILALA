<!-- ===== Footer ===== -->
  <footer class="bg-[#626F47] text-[#F7EDD6] rounded-t-3xl py-4 px-6 md:px-10 mt-auto
  md:ml-[320px] md:mr-3 transition-all duration-300">
    <div class="flex flex-col md:flex-row items-center md:items-start justify-between gap-3 md:gap-0">
      <?php
                    $footerUser = \App\Models\Setting::getValue('logo_footer_user');
                ?>

                <?php if($footerUser && \Storage::disk('public')->exists('cms/' . $footerUser)): ?>
                    <img src="<?php echo e(asset('storage/cms/' . $footerUser)); ?>" alt="footerUser"
                        class="w-12 h-12 object-contain">
                <?php else: ?>
                    <img src="<?php echo e(asset('assets/logo_kementan.png')); ?>" alt="Hero Image"
                        class="w-12 h-12 object-contain">
                <?php endif; ?>

<div class="flex items-center space-x-3">

        <div class="leading-tight">
          <p class="text-[12px] sm:text-sm font-semibold">
            BALAI PENGUJIAN MUTU DAN SERTIFIKASI PRODUK HEWAN
          </p>
          <p class="text-[11px] sm:text-xs">
            DIREKTORAT JENDERAL PETERNAKAN DAN KESEHATAN HEWAN<br>
            KEMENTERIAN PERTANIAN
          </p>
        </div>
      </div>

      <!-- Kanan -->
      <div class="text-right text-[11px] sm:text-xs md:text-sm leading-snug">
        <p>© 2025 BPMSPH – Balai Pengujian Mutu dan Sertifikasi Produk Hewan</p>
        <p>Kementerian Pertanian Republik Indonesia</p>
        <p>Jl. Raya Pajajaran Kav. E59, Bogor | Telp: (0251) 8321 567</p>
      </div>

    </div>
  </div>
  </footer>
<?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/layout_user/partial_user/footer.blade.php ENDPATH**/ ?>