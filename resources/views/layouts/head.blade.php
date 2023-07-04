<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AdminLTE 3 | Starter</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{ asset('/asset_template/plugins/fontawesome-free/css/all.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('asset_template/dist/css/adminlte.min.css') }}">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="{{ asset('asset_template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
{{-- csrf --}}
<meta name="csrf-token" content="{{ csrf_token() }}">
{{-- pace --}}
<link rel="stylesheet" href="{{ asset('asset_template/plugins/pace-progress/themes/yellow/pace-theme-flat-top.css') }}">
{{-- datatable --}}

<style>
    .main-sidebar {
        background-color: {{ App\Models\Setting::get('color_sidebar') ?? '#007BFF' }};
    }

    .main-header {
        background-color: {{ App\Models\Setting::get('color_sidebar_brand') ?? '#007BFF' }};
    }

    .brand-link {
        background-color: {{ App\Models\Setting::get('color_sidebar_brand') ?? '#007BFF' }} !important;
    }

    .bg-color-sidebar {
        background-color: {{ App\Models\Setting::get('color_sidebar') ?? '#007BFF' }} !important;
    }

    .bg-color-sidebar-brand {
        background-color: {{ App\Models\Setting::get('color_sidebar_brand') ?? '#007BFF' }} !important;
    }

    .nav-item>.nav-link.active {
        background-color: {{ App\Models\Setting::get('color_sidebar_brand') ?? '#007BFF' }} !important;
        color: #fff;
    }
</style>

@stack('css')
