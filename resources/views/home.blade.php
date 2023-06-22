@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Dashboard
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        @endslot
        @slot('content')
            <x-admin.box-component>
                @slot('title')
                    Dashboard
                @endslot
                @slot('boxBody')
                    
                @endslot
            </x-admin.box-component>
        @endslot
    </x-admin.layout-component>
@endsection
