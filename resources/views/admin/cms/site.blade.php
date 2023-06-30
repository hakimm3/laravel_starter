@extends('layouts.app_beckend')

@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Site Settings
        @endslot
        @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Site Setting</li>
        @endslot
    </x-admin.layout-component>
@endsection