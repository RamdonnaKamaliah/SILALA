 <!-- Footer -->
<footer class="dark:bg-white bg-[#A4B465] dark:text-gray-900 text-white border-t border-gray-200">
  <div class="max-w-6xl mx-auto px-6 py-14 grid grid-cols-1 md:grid-cols-3 gap-10 footer-grid">

    <!-- Logo + Deskripsi -->
    <div class="flex flex-col space-y-5">
      <div class="flex items-center space-x-4">
        <img src="{{asset('assets/logo_kementan.png')}}" alt="Logo" class="w-16 h-16">
        <h3 class="text-lg md:text-xl font-bold leading-snug">
          BALAI PENGUJIAN MUTU <br>
          DAN SERTIFIKASI PRODUK HEWAN
        </h3>
      </div>
      <p class="text-base leading-relaxed opacity-90">
        Lembaga resmi yang berkomitmen menjaga kualitas, mutu, 
        serta memberikan layanan pengujian dan sertifikasi produk hewan 
        dengan standar terbaik.
      </p>
    </div>

    <!-- Layanan -->
    <div class="relative">
  <h4 class="text-xl font-semibold mb-5">Layanan</h4>
        <ul class="space-y-3 text-base">
    <!-- Link langsung -->
    <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/magangpklbimbingan-teknis" class="transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Magang/PKL/Bimbingan Teknis</a></li>
    <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/uji-profisiensi" class="transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Uji Profisiensi</a></li>

    <!-- Dropdown 1 -->
    <li class="relative">
      <button class="flex items-center justify-between w-full transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]" onclick="toggleDropdown('mutuDropdown', this)">
        Pengajuan dan Mutu Produk Hewan
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <ul id="mutuDropdown" class="hidden ml-4 mt-2 space-y-2 text-sm">
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/pelayanan-pengujian-keamanan-dan-mutu-produk-hewan" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Pelayanan Pengujian Keamanan dan Mutu Produk Hewan</a></li>
         <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/ivlab--indonesian-veterinary-lab-information-system" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">IVLAB</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/tarif-uji" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Tarif Uji</a></li>
      </ul>
    </li>

    <!-- Dropdown 2 -->
    <li class="relative">
      <button class="flex items-center justify-between w-full transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]" onclick="toggleDropdown('pmkDropdown', this)">
        PMK PHMS
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <ul id="pmkDropdown" class="hidden ml-4 mt-2 space-y-2 text-sm">
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/sebaran-pmk" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Sebaran PMK</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/regulasi-dan-pedoman-pmk" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Regulasi dan Pedoman PMK</a></li>
         <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/materi-kie-pmk" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Materi KIE PMK</a></li>
        <li><a href="https://ditjenpkh.pertanian.go.id/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Info Terkait PMK</a></li>
        <li><a href="https://ditjenpkh.pertanian.go.id/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Pekembangan Kasus PMK</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/buku-saku-pencegahan-dan-pengendalian-pmk" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Buku Saku dan Pengendalian PMK</a></li>
      </ul>
    </li>

    <!-- Link langsung -->
    <li><a href="https://ppid.pertanian.go.id/" class="transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Permohonan Informasi Publik</a></li>
    <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/sewa-fasilitas-dan-aset" class="transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Sewa Fasilitas dan Aset</a></li>
      <!-- Dropdown 3 -->
    <li class="relative">
      <button class="flex items-center justify-between w-full transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]" onclick="toggleDropdown('konsulDropdown', this)">
        Konsultasi dan Pengaduan
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <ul id="konsulDropdown" class="hidden ml-4 mt-2 space-y-2 text-sm">
        <li><a href="https://linktr.ee/HALO_BPMSPH?utm_source=linktree_profile_share&amp;amp;amp;amp;amp;amp;amp;amp;amp;ltsid=d080f820-4b42-4fbd-9da1-c8216578eddb" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Konsultasi</a></li>
        <li><a href="" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Kanal Pelaporan</a></li>
        <li><a href="https://bit.ly/Ikmbpmsph" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Form Survei Kepuasan</a></li>
        <li><a href="https://docs.google.com/forms/d/e/1FAIpQLScqWs9Mcze01bl0q0jDT-bUYtBrOCTz6VAxJpv6JBb1o8NG_g/viewform" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Pendaftaran Pelayan Online</a></li>
        <li><a href="" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">WBS</a></li>
      </ul>
    </li>

 <!-- Dropdown 4 -->
    <li class="relative">
      <button class="flex items-center justify-between w-full transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]" onclick="toggleDropdown('internalDropdown', this)">
        Layanan Internal
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>
      <ul id="internalDropdown" class="hidden ml-4 mt-2 space-y-2 text-sm">
        <li><a href="https://sijitumi.bpmsph.org/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Sistem Mangemen Integrasi</a></li>
        <li><a href="https://sijitumi.bpmsph.org/spip" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">SPIP</a></li>
        <li><a href="https://sakti.kemenkeu.go.id/LL-Zg7BviiuXviBn9TvfiA" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">SAKTI</a></li>
        <li><a href="https://srikandi.arsip.go.id/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">SRIKANDI</a></li>
        <li><a href="https://epersonal.pertanian.go.id/login" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">SINERGI</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/waktu-pelayanan" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Waktu Pelayanan</a></li>
   <li><a href="https://repository.pertanian.go.id/home" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Repositori Publikasi</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/kritik-dan-saran" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Kritik dan Saran</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/perpustakaan-digital-kementan" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Perpustakaan Kementan</a></li>
        <li><a href="https://katalog.inaproc.id/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Katalog Elektronik</a></li>
        <li><a href="https://bpmsph.ditjenpkh.pertanian.go.id/layanan/zona-integritas" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Zona Interasi </a></li>
        <li><a href="https://sirup.lkpp.go.id/sirup/home/swakelolaSatker?idSatker=5521" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Integrasi Rencana Umum Penggadaian</a></li>
        <li><a href="https://spse.inaproc.id/pertanian" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">INAPROC</a></li>
        <li><a href="https://lpse.pertanian.go.id/eproc4/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">LPCE</a></li>
        <li><a href="https://elhkpn.kpk.go.id/portal/user/pengumuman_lhkpn/TlZwa1owaHBNRW94WVhrM1JrdFVkMHBvUlVWc2EwZHVhVmh0TVd4d2RXa3hSakZVVmtSc1ZIZFpVbGRTTDFWSVZsQXJLMmhGTldKSVluZERjVXM0VFE9PQ==" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">LHKPN</a></li>
        <li><a href="https://tvtani.co/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">TV Tani</a></li>
        <li><a href="https://jdih.pertanian.go.id/" class="block hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">JDIH Kementan</a></li>
      </ul>
    </li>
  </ul>
</div>

 <!-- Tautan -->
    <div>
      <h4 class="text-xl font-semibold mb-5">Tautan</h4>
      <ul class="space-y-3 text-base">
        <li><a href="/" class="transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Beranda</a></li>
        <li><a href="#rekomendasi" class="transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Rekomendasi</a></li>
        <li><a href="#panduan" class="transition-colors duration-300 hover:text-[#F5ECD5] dark:hover:text-[#A4B465]">Panduan</a></li>
      </ul>
    </div>
</div>
</footer>

