<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register | Silala</title>
  <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('default/icon_silala.svg')); ?>">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

  <style>
    /* --- Safety box model --- */
    *, *::before, *::after { box-sizing: border-box; }

    :root {
      --overlay: rgba(0,128,0,0.15);
    }

    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      min-height: 100vh;
      position: relative;
      background: url("<?php echo e(asset('assets/bg.png')); ?>") no-repeat center center fixed;
      background-size: cover;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    /* Mobile portrait background override */
    @media (max-width: 768px) {
      body {
        background: url("<?php echo e(asset('assets/big.png')); ?>") no-repeat center center fixed;
        background-size: cover;
      }
    }

    /* overlay */
    body::before{
      content: "";
      position: absolute;
      inset: 0;
      background: var(--overlay);
      z-index: 0;
    }

    /* floating for illustration */
    .floating { animation: float 6s ease-in-out infinite; }
    @keyframes float {
      0% { transform: translateY(0); }
      50% { transform: translateY(-8px); }
      100% { transform: translateY(0); }
    }

    /* custom thin scrollbar for form area (WebKit) */
    .form-scrollable::-webkit-scrollbar { width: 10px; }
    .form-scrollable::-webkit-scrollbar-thumb { background: rgba(15, 118, 110, 0.35); border-radius: 8px; }
    .form-scrollable::-webkit-scrollbar-track { background: transparent; }

    /* Firefox scrollbar */
    .form-scrollable { scrollbar-width: thin; scrollbar-color: rgba(15,118,110,0.35) transparent; }

    /* Make sure page doesn't show behind container */
    .page-wrap { position: relative; z-index: 10; }

    /* --- RESPONSIVE scroll area --- 
       - max-height uses min(420px, calc(100vh - 220px)) so on short screens it adapts.
       - padding-right provides space so content doesn't sit under the scrollbar.
       - scrollbar-gutter keeps layout stable when scrollbar appears (modern browsers).
    */
    .form-scrollable {
      max-height: min(420px, calc(100vh - 220px));
      overflow-y: auto;
      -webkit-overflow-scrolling: touch;
      padding-right: 12px; /* keep content away from scrollbar */
      scrollbar-gutter: stable both-edges;
    }

    /* on very small screens allow more room */
    @media (max-width: 420px) {
      .form-scrollable {
        max-height: calc(100vh - 140px);
      }
    }

    /* Prevent input/select from causing overflow in flex contexts */
    input, select, textarea {
      min-width: 0;
    }

    /* keep container visible above overlay */
    .card-elevated { z-index: 20; }

  </style>
</head>
<body>

  <div class="min-h-screen flex items-center justify-center px-4 page-wrap">

    <!-- container -->
    <div class="w-full max-w-4xl grid md:grid-cols-12 grid-cols-1 bg-white/90 rounded-xl overflow-hidden border border-green-100 backdrop-blur-sm relative card-elevated shadow-lg">

      <!-- Form column -->
      <div class="md:col-span-7 px-6 py-6 md:px-10 md:py-8 flex flex-col justify-center">
        <h2 class="text-2xl font-semibold text-green-700 mb-2 text-center flex items-center justify-center gap-2">
          <i class="fas fa-user-plus text-green-600"></i>
          Register SiLala BPMSPH
        </h2>

        <p class="text-sm text-gray-600 mb-4 text-center">
          Isi data berikut untuk membuat akun baru.
        </p>

        <!-- compact card -->
        <div class="mx-auto w-full max-w-md">
          
          <!-- TAMBAHKAN: Google Register Button di sini -->
          <div class="mb-4">
            <a href="<?php echo e(route('google.redirect')); ?>"  
               class="flex items-center justify-center gap-3 w-full py-2 px-4 border border-gray-300 rounded-lg bg-white hover:bg-gray-50 transition mb-3">
              <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google Logo" class="w-5 h-5">
              <span class="font-semibold text-black text-sm">Buat akun dengan Google</span>
            </a>
          </div>

          <div class="flex items-center my-3">
            <div class="flex-grow h-px bg-green-200"></div>
            <span class="px-3 text-green-400 text-xs">atau daftar dengan email</span>
            <div class="flex-grow h-px bg-green-200"></div>
          </div>

          <!-- UPDATED: responsive scrollable form area -->
          <div class="form-scrollable">
            <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>

              <!-- Nama Lengkap -->
              <div>
                <label for="name" class="block text-sm font-medium text-green-700 mb-1">
                  <i class="fa-solid fa-user mr-2"></i>Nama Lengkap
                </label>
                <input id="name" type="text" name="name" value="<?php echo e(old('name')); ?>" required autofocus autocomplete="name"
                  class="block w-full box-border px-3 py-2 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none text-sm" />
                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('name'),'class' => 'mt-1 text-sm text-red-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('name')),'class' => 'mt-1 text-sm text-red-600']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
              </div>

              <!-- No Telepon -->
              <div>
                <label for="phone" class="block text-sm font-medium text-green-700 mb-1">
                  <i class="fa-solid fa-phone mr-2"></i>No Telepon
                </label>
                <input id="phone" type="text" name="phone" value="<?php echo e(old('phone')); ?>" required autocomplete="tel"
                  class="block w-full box-border px-3 py-2 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none text-sm" />
                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('phone'),'class' => 'mt-1 text-sm text-red-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('phone')),'class' => 'mt-1 text-sm text-red-600']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
              </div>

              <!-- Email -->
              <div>
                <label for="email" class="block text-sm font-medium text-green-700 mb-1">
                  <i class="fa-solid fa-envelope mr-2"></i>Email
                </label>
                <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="username"
                  class="block w-full box-border px-3 py-2 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none text-sm" />
                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('email'),'class' => 'mt-1 text-sm text-red-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('email')),'class' => 'mt-1 text-sm text-red-600']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
              </div>

              <!-- Jenis Keanggotaan -->
              <div>
                <label for="membership_type" class="block text-sm font-medium text-green-700 mb-1">Jenis Keanggotaan</label>
                <select id="membership_type" name="membership_type" required
                  class="block w-full box-border px-3 py-2 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none text-sm">
                  <option value="">Pilih Jenis Keanggotaan</option>
                  <option value="karyawan" <?php echo e(old('membership_type') == 'karyawan' ? 'selected' : ''); ?>>Karyawan</option>
                  <option value="magang" <?php echo e(old('membership_type') == 'magang' ? 'selected' : ''); ?>>Magang</option>
                </select>
                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('membership_type'),'class' => 'mt-1 text-sm text-red-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('membership_type')),'class' => 'mt-1 text-sm text-red-600']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
              </div>

              <!-- Jenis Kelamin -->
              <div>
                <label for="gender" class="block text-sm font-medium text-green-700 mb-1">Jenis Kelamin</label>
                <select id="gender" name="gender" required
                  class="block w-full box-border px-3 py-2 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none text-sm">
                  <option value="">Pilih Jenis Kelamin</option>
                  <option value="L" <?php echo e(old('gender') == 'L' ? 'selected' : ''); ?>>Laki-laki</option>
                  <option value="P" <?php echo e(old('gender') == 'P' ? 'selected' : ''); ?>>Perempuan</option>
                </select>
                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('gender'),'class' => 'mt-1 text-sm text-red-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('gender')),'class' => 'mt-1 text-sm text-red-600']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
              </div>

              <!-- Password -->
              <div>
                <label for="password" class="block text-sm font-medium text-green-700 mb-1">
                  <i class="fa-solid fa-lock mr-2"></i>Password
                </label>
                <div class="relative">
                  <input id="password" type="password" name="password" required autocomplete="new-password"
                    class="block w-full box-border px-3 py-2 pr-10 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none text-sm" />
                  <button type="button" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 focus:outline-none" onclick="toggleEye('password','eyePwd')">
                    <i id="eyePwd" class="fa-solid fa-eye"></i>
                  </button>
                </div>
                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password'),'class' => 'mt-1 text-sm text-red-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password')),'class' => 'mt-1 text-sm text-red-600']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
              </div>

              <!-- Confirm Password -->
              <div>
                <label for="password_confirmation" class="block text-sm font-medium text-green-700 mb-1">
                  <i class="fa-solid fa-lock mr-2"></i>Confirm Password
                </label>
                <div class="relative">
                  <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                    class="block w-full box-border px-3 py-2 pr-10 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none text-sm" />
                  <button type="button" class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500 focus:outline-none" onclick="toggleEye('password_confirmation','eyeConfirm')">
                    <i id="eyeConfirm" class="fa-solid fa-eye"></i>
                  </button>
                </div>
                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password_confirmation'),'class' => 'mt-1 text-sm text-red-600']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password_confirmation')),'class' => 'mt-1 text-sm text-red-600']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
              </div>

              <!-- Submit -->
              <div class="flex items-center justify-between mt-2">
                <a href="<?php echo e(route('login')); ?>" class="text-sm text-green-700 hover:underline flex items-center">
                  <i class="fa-solid fa-arrow-left mr-1"></i>Sudah punya akun? Login
                </a>
                <button type="submit"
                  class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg transition flex items-center text-sm">
                  <i class="fa-solid fa-user-plus mr-2"></i>Register
                </button>
              </div>

            </form>
          </div>
        </div>
      </div>

      <!-- Illustration column -->
      <div class="hidden md:flex md:col-span-5 items-center justify-center bg-green-50 p-6">
        <img src="<?php echo e(asset('assets/liber.png')); ?>" alt="Library Illustration" class="w-3/4 floating">
      </div>

    </div>
  </div>

  <!-- AOS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

  <script>
    AOS?.init?.({ duration: 700, easing: 'ease-in-out', once: true, offset: 50 });

    // Toggle show/hide password
    function toggleEye(inputId, iconId) {
      const input = document.getElementById(inputId);
      const icon = document.getElementById(iconId);
      if (!input || !icon) return;
      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      }
    }
  </script>

</body>
</html><?php /**PATH C:\laragon\www\SILALA_BPMSPH\resources\views/auth/register.blade.php ENDPATH**/ ?>