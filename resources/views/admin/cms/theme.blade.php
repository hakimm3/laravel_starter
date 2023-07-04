@extends('layouts.app_beckend')

@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Theme Settings
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">CMS</a></li>
            <li class="breadcrumb-item active">Theme Settings</li>
        @endslot
        @slot('content')
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <form action="{{ route('cms.theme.store') }}" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        <div class="mb-3 row">
                            <label for="example-color-input" class="col-md-3 col-form-label">Sidebar</label>
                            <div class="col-md-1">
                                <input class="form-control form-control-color mw-100" type="color"
                                    value="{{ App\Models\Setting::get('color_sidebar') ?? '#007BFF' }}" name="color_sidebar">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-color-input" class="col-md-3 col-form-label">Top Sidebar</label>
                            <div class="col-md-1">
                                <input class="form-control form-control-color mw-100" type="color"
                                    value="{{ App\Models\Setting::get('color_sidebar_brand') ?? '#007BFF' }}"
                                    name="color_sidebar_brand">
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('cms.theme.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>

            </div>
        @endslot
    </x-admin.layout-component>
@endsection
