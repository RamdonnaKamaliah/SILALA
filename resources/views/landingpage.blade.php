<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layout_landing.patrial_landing.link')

    <title>SILALA</title>
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
     <!-- style -->
    <link rel="stylesheet" href="{{ asset('assets_landing/css/landingpage.css') }}">

</head>
<body class="bg-gray-50 font-sans text-slate-700">

    <!-- Navbar -->
    <x-navbarlanding></x-navbarlanding>
  
    <!-- Hero Section -->
    @include('layout_landing.patrial_landing.hero')

    <!-- Section Hijau -->
<section class="bg-[#F5ECD5] dark:bg-[#A4B465] pt-32 pb-16 px-4 md:px-8 rounded-t-[50px]" id="tentang">
  <div class="max-w-7xl mx-auto space-y-12">

    <!-- Quote Box -->
    <div class="flex justify-center px-2">
      <div class="quote-box relative bg-white rounded-2xl shadow-xl px-6 md:px-10 py-8 max-w-3xl w-full text-center border-4 border-[#626F47]
                  opacity-0 translate-y-10 transition-all duration-700 ease-out">
        <span class="absolute -top-4 right-6 text-black text-3xl">
          <i class="fa-solid fa-quote-left"></i>
        </span>

        <p class="text-gray-700 text-lg leading-relaxed font-medium italic">
          "Lorem Ipsum is simply dummy text of the printing and typesetting
      industry. Lorem Ipsum has been the industry's standard dummy text
      ever since the 1500s, when an unknown printer took a galley of type
      and scrambled it to make a type specimen book."
        </p>

        <span class="absolute -bottom-4 left-6 text-black text-3xl">
          <i class="fa-solid fa-quote-right"></i>
        </span>
      </div>
    </div>

    <!-- Judul Section -->
    <div class="text-center" id="rekomendasi">
      <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 dark:text-white">
        Rekomendasi Buku Best Seller
      </h2>
      <p class="mt-2 text-gray-600 dark:text-white text-base">
        Pilihan buku terbaik untuk menambah wawasan dan inspirasi
      </p>
    </div>

    <!-- Grid Card -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
      <!-- CARD TEMPLATE -->
      @foreach ([
        ['buku1.jpg','Statistika Peternakan','Indah Hanaco','★★★★☆','+20'],
        ['buku2.jpg','Buku Saku Pelaksanaa Kie','J. Anderson','★★★★☆','+35'],
        ['buku3.jpg','Statistika Peternakan','Indah Hanaco','★★★★★','+50'],
        ['buku4.jpg','Budidaya Peternakan','J. Anderson','★★★★☆','+20'],
        ['buku2.jpg','Buku Saku Pelaksanaa Kie','J. Anderson','★★★★☆','+35'],
        ['buku3.jpg','Statistika Peternakan','Indah Hanaco','★★★★★','+50'],
      ] as [$img,$title,$author,$rating,$users])
      <article class="recommend-card bg-[#A4B465] dark:bg-white rounded-xl p-5 md:p-6 flex flex-col sm:flex-row items-center sm:items-start gap-4 md:gap-5 w-full h-full
                      opacity-0 translate-y-10 transition-all duration-700 ease-out">
        <div class="cover w-28 h-40 md:w-32 md:h-44 flex-shrink-0">
          <img src="{{ asset('assets/'.$img) }}" alt="{{ $title }} - cover" class="w-full h-full object-cover rounded-lg shadow-md">
        </div>
        <div class="meta text-center sm:text-left">
          <h3 class="text-lg md:text-xl font-semibold text-white dark:text-gray-900">{{ $title }}</h3>
          <p class="text-sm md:text-base text-gray-100 dark:text-gray-900 mt-1">By {{ $author }}</p>
          <div class="mt-3 flex justify-center sm:justify-start items-center gap-2">
            <div class="text-yellow-400 text-base">{{ $rating }}</div>
            <div class="text-sm text-gray-200 dark:text-gray-900 flex items-center"><i class="fa fa-user mr-1"></i>{{ $users }}</div>
          </div>
        </div>
      </article>
      @endforeach
    </div>
  </div>
</section>

    @include('layout_landing.patrial_landing.footer')

    <script src="{{ asset('assets_landing/js/landingpage.js') }}"></script>
</body>
</html>