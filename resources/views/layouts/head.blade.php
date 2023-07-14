<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AdminLTE 3 | Starter</title>

<!-- Google Font: Source Sans Pro -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('/asset_template/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('asset_template/dist/css/adminlte.min.css') }}">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('asset_template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('asset_template/plugins/toastr/toastr.min.css') }}">
{{-- csrf --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- pace --}}
<link rel="stylesheet" href="{{ asset('asset_template/plugins/pace-progress/themes/yellow/pace-theme-flash.css') }}">
{{-- datatable --}}

<style>
    .main-sidebar {
        background-color: {{ $setting['color_sidebar'] ?? 'white' }};
    }

    .main-header {
        background-color: {{ $setting['color_sidebar_brand'] ?? '#007BFF' }};
        color: white;
    }

    .outline-main-header {
        border-top: 3px solid {{ $setting['color_sidebar_brand'] ?? '#007BFF' }};
    }

    .brand-link {
        background-color: {{ $setting['color_sidebar_brand'] ?? '#007BFF' }} !important;
    }

    .bg-color-sidebar {
        background-color: {{ $setting['color_sidebar'] ?? '#007BFF' }} !important;
    }

    .bg-color-sidebar-brand {
        background-color: {{ $setting['color_sidebar_brand'] ?? '#007BFF' }} !important;
    }

    .nav-item>.nav-link.active {
        background-color: {{ $setting['color_sidebar_brand'] ?? '#007BFF' }} !important;
        color: #fff;
    }

    .nav-treeview .nav-item>.nav-link.active {
        background-color: #DBDDE0 !important;
        color: #fff;
    }
</style>

@stack('css')
