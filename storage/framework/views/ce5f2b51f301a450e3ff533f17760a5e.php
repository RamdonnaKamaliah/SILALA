<?php $__env->startSection('title', 'Profile Admin'); ?>

<?php $__env->startSection('content'); ?>

<div class="min-h-screen p-4 md:p-6">

    <div class="max-w-5xl mx-auto">

        <!-- HEADER dengan Gradient -->
        <div class="bg-gradient-to-br from-[#A4B465] via-[#8FA056] to-[#6E7C45] rounded-2xl shadow-xl p-8 mb-6 relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-shield text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-white">
                            
                        </h1>
                        <p class="text-white/90 mt-1 text-sm md:text-base">Kelola biodata Anda dengan mudah</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD PROFILE dengan Design Modern -->
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
            
            <!-- Header Accent -->
            <div class="h-2 bg-gradient-to-r from-[#A4B465] via-[#8FA056] to-[#6E7C45]"></div>

            <div class="p-6 md:p-8">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-8">

                    <!-- FOTO dengan Styling Enhanced -->
                    <div class="relative mx-auto md:mx-0 group">
                        <!-- Glow Effect -->
                        <div class="absolute inset-0 bg-gradient-to-br from-[#A4B465] to-[#6E7C45] rounded-2xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity"></div>
                        
                        <div class="relative w-36 h-36 md:w-44 md:h-44 rounded-2xl overflow-hidden shadow-xl border-4 border-white ring-4 ring-[#A4B465]/20">
                            <img 
                                src="<?php echo e($admin->foto && Storage::disk('public')->exists($admin->foto)
                                    ? asset('storage/'.$admin->foto)
                                    : asset('default/profile_admin.svg')); ?>"
                                class="w-full h-full object-cover"
                            >


                            
                            <!-- Overlay on Hover -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>

                        <!-- Badge -->
                        <div class="absolute -bottom-3 -right-3 bg-gradient-to-br from-[#A4B465] to-[#6E7C45] text-white p-3 rounded-xl shadow-lg">
                            <i class="fas fa-user-cog text-lg"></i>
                        </div>
                    </div>

                    <!-- INFO UTAMA dengan Enhanced Layout -->
                    <div class="flex-1 text-center md:text-left">
                        <div class="flex flex-col md:flex-row md:items-center gap-3 mb-4">
                            <h2 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-[#6E7C45] to-[#A4B465] bg-clip-text text-transparent">
                                <?php echo e($admin->name); ?>

                            </h2>

                            <?php if($admin->role === 'administrator'): ?>
                            <span class="inline-flex items-center gap-1.5 bg-gradient-to-r from-[#A4B465] to-[#8FA056] text-white text-xs font-semibold px-4 py-1.5 rounded-full shadow-md">
                                <i class="fas fa-shield-alt"></i>
                                Administrator
                            </span>
                            <?php endif; ?>
                        </div>

                        <!-- Info Cards -->
                        <div class="space-y-3">
                            <div class="bg-gradient-to-r from-[#F9FBF4] to-[#F2F6E9] rounded-xl p-4 border border-[#DDE6C5]">
                                <div class="flex items-center justify-center md:justify-start gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-[#A4B465] to-[#8FA056] rounded-lg flex items-center justify-center shadow-sm">
                                        <i class="fas fa-envelope text-white"></i>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-xs text-[#8C9E55] font-medium">Email Address</p>
                                        <p class="font-semibold text-[#6E7C45]"><?php echo e($admin->email); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gradient-to-r from-[#F9FBF4] to-[#F2F6E9] rounded-xl p-4 border border-[#DDE6C5]">
                                <div class="flex items-center justify-center md:justify-start gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-[#6E7C45] to-[#5E6A3A] rounded-lg flex items-center justify-center shadow-sm">
                                        <i class="fas fa-phone text-white"></i>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-xs text-[#8C9E55] font-medium">No Telepon</p>
                                        <p class="font-semibold text-[#6E7C45]"><?php echo e($admin->phone ?? '-'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        

                <!-- EDIT BUTTON dengan Enhanced Design -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-end pt-6">
                    <a href="<?php echo e(route('admin.profile.edit')); ?>"
                       class="group relative inline-flex items-center justify-center gap-3 bg-gradient-to-r from-[#A4B465] to-[#8FA056] hover:from-[#8FA056] hover:to-[#6E7C45] text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <!-- Shimmer Effect -->
                        <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
                        
                        <i class="fas fa-edit text-lg relative z-10"></i>
                        <span class="relative z-10">Edit Profile</span>
                        <i class="fas fa-arrow-right text-sm opacity-0 group-hover:opacity-100 -translate-x-2 group-hover:translate-x-0 transition-all duration-300 relative z-10"></i>
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_admin.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\silala_bpmsph\resources\views/admin/profile/index.blade.php ENDPATH**/ ?>