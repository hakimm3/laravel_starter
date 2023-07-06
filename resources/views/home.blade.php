@extends('layouts.app')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Welcome to Dashboard {{ auth()->user()->name }}
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        @endslot
        @slot('content')
            <x-admin.box-component>
               @slot('header')
                   <h1>Dashboard</h1>
               @endslot
               @slot('body')
                   
               @endslot
               @slot('footer')
                   
               @endslot
            </x-admin.box-component>
        @endslot
    </x-admin.layout-component>
@endsection
