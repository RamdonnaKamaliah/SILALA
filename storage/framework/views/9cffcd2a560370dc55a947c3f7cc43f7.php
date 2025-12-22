<!-- Tombol Hamburger -->
<button id="hamburger"
  class="fixed top-4 left-4 z-50 flex flex-col justify-between w-8 h-6 focus:outline-none md:hidden">
  <span class="block w-full h-[3px] bg-green rounded transition-all duration-300"></span>
  <span class="block w-full h-[3px] bg-green rounded transition-all duration-300"></span>
  <span class="block w-full h-[3px] bg-green rounded transition-all duration-300"></span>
</button>

<!-- Overlay Sidebar -->
<div id="sidebar-overlay"
  class="fixed inset-0 bg-black/40 hidden opacity-0 transition-opacity duration-300 z-40 md:hidden pointer-events-none">
</div>

<!-- Sidebar -->
<div id="sidebar"
  class="user-sidebar fixed w-[300px] h-full bg-primary border-l-[10px] border-primary transition-transform duration-500 transform -translate-x-full md:translate-x-0 z-40 md:z-40">
  
  <!-- Header -->
  <div class="sidebar-header flex items-center justify-between px-4 mt-4 mb-6 text-white">
    <div class="flex items-center gap-2">
      <img src="<?php echo e(asset('assets/logo_kementan.png')); ?>" alt="Logo" class="w-12 h-12 rounded-full object-cover" />
     <p class="text-white font-bold text-lg leading-tight">
      PERPUSTAKAAN BPMSPH
      <span class="block text-xs font-normal opacity-90 mt-1">
       SILALA (Sistem Informasi Layanan Literasi & Arsip)<br>
      </span>
</p>
    </div>
  </div>

  <!-- Profil -->
  <ul id="sidebar-menu" class="space-y-3">
    <li class="relative nav-item <?php echo e(request()->routeIs('user.profil') ? 'active' : ''); ?> rounded-l-[50px] hover:bg-white list-none">
      <a href="<?php echo e(route('user.profil')); ?>" class="group relative flex items-center w-full text-greentransition-all duration-300">
        <div
          class="menu-item flex items-center gap-3 border-[2px] border-cream bg-cream rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300
          group-hover:border-transparent group-hover:bg-white">
          
          <!-- Foto Profil -->
          <?php if(Auth::user()->foto_profil): ?>
            <img src="<?php echo e(asset('storage/' . Auth::user()->foto_profil)); ?>" alt="Foto Profil"
              class="w-20 h-20 rounded-full border-2 border-greenobject-cover shadow-md flex-shrink-0" />
          <?php else: ?>
            <img src="<?php echo e(asset('assets/Profile.jpg')); ?>" alt="Foto Profil"
              class="w-20 h-20 rounded-full border-2 border-greenobject-cover shadow-md flex-shrink-0" />
          <?php endif; ?>
          
          <div class="leading-tight flex-1 min-w-0">
            <p class="font-bold text-green text-sm truncate"><?php echo e(Auth::user()->name); ?></p>
            <p class="text-xs opacity-80 -mt-[2px] truncate"><?php echo e(Auth::user()->email); ?></p>
          </div>
        </div>
      </a>
    </li>

    <!-- Menu -->
    <li class="relative nav-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?> rounded-l-[30px] hover:bg-white list-none">
      <a href="<?php echo e(route('dashboard')); ?>" class="group relative flex items-center w-full text-greentransition-colors duration-300">
        <div
          class="menu-item flex items-center gap-3 border-[2px] border-cream bg-cream rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300
          group-hover:border-transparent group-hover:bg-white">
          <span class="iconify text-green" data-icon="mdi:view-grid" data-width="32"></span>
          <span class="whitespace-nowrap text-base font-bold text-green">Dashboard</span>
        </div>
      </a>
    </li>

    <li class="relative nav-item <?php echo e(request()->routeIs('user.daftarbuku', 'user.detailbuku') ? 'active' : ''); ?> rounded-l-[30px] hover:bg-white list-none">
      <a href="<?php echo e(route('user.daftarbuku')); ?>" class="group relative flex items-center w-full text-greentransition-colors duration-300">
        <div
          class="menu-item flex items-center gap-3 border-[2px] border-cream bg-cream rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300
          group-hover:border-transparent group-hover:bg-white">
          <span class="iconify text-green" data-icon="fa-solid:book" data-width="30"></span>
          <span class="whitespace-nowrap text-base font-bold text-green">Buku</span>
        </div>
      </a>
    </li>

    <li class="relative nav-item <?php echo e(request()->routeIs('user.riwayatbuku') ? 'active' : ''); ?> rounded-l-[30px] hover:bg-white list-none">
      <a href="<?php echo e(route('user.riwayatbuku')); ?>" class="group relative flex items-center w-full text-greentransition-colors duration-300">
        <div
          class="menu-item flex items-center gap-3 border-[2px] border-cream bg-cream rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300
          group-hover:border-transparent group-hover:bg-white">
          <span class="iconify text-green" data-icon="mdi:book-lock" data-width="32"></span>
          <span class="whitespace-nowrap text-base font-bold text-green">Riwayat</span>
        </div>
      </a>
    </li>

    <li class="relative nav-item <?php echo e(request()->routeIs('user.favorit') ? 'active' : ''); ?> rounded-l-[30px] hover:bg-white list-none">
      <a href="<?php echo e(route('user.favorit')); ?>" class="group relative flex items-center w-full text-greentransition-colors duration-300">
        <div
          class="menu-item flex items-center gap-3 border-[2px] border-cream bg-cream rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300
          group-hover:border-transparent group-hover:bg-white">
          <span class="iconify text-green" data-icon="mdi:book-heart" data-width="32"></span>
          <span class="whitespace-nowrap text-base font-bold text-green">Favorit</span>
        </div>
      </a>
    </li>

    <li><div class="h-[1px] bg-gray-300 mx-2 rounded"></div></li>

    <li class="relative nav-item rounded-l-[30px] hover:bg-white list-none">
  <form id="logoutForm" action="<?php echo e(route('logout')); ?>" method="POST"> 
    <?php echo csrf_field(); ?> 
    <button type="button" id="logoutButton" class="group relative flex items-center w-full text-red-600 transition-colors duration-300"> 
      <div class="menu-item flex items-center gap-3 rounded-full px-4 py-3 ml-2 w-[230px] justify-start transition-all duration-300"> 
        <i class="fa-solid fa-bookmark text-xl"></i> 
        <span class="whitespace-nowrap text-base font-bold text-red-600">Logout</span> 
      </div> 
    </button> 
  </form> 
</li>
  </ul>
</div><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/components/sidebarUser.blade.php ENDPATH**/ ?>