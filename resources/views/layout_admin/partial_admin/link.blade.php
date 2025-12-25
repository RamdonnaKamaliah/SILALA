<!-- ================= FONTS ================= -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- ================= ICON ================= -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- ================= NUCLEO ================= -->
<link rel="stylesheet" href="{{ asset('assets_admin/css/nucleo-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets_admin/css/nucleo-svg.css') }}">

<!-- ================= DATATABLE (GLOBAL) ================= -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- ================= ADMIN GLOBAL ================= -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
<link rel="stylesheet" href="{{ asset('assets_admin/css/admin/admin.css') }}">
<link rel="stylesheet" href="{{ asset('assets_admin/css/navbarAdmin.css') }}">
<link rel="stylesheet" href="{{ asset('assets_admin/css/sidebar.css') }}">

{{-- SLOT CSS PAGE --}}
@stack('styles')
