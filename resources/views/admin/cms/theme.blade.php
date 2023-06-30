@extends('layouts.app_beckend')

@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Theme Settings
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Theme Settings</li>
        @endslot
        @slot('content')
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('cms.theme.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                            <input class="form-check-input" type="checkbox" name="dark_mode"
                                @if (App\Models\Setting::get('dark_mode') == 1) checked @endif> <label class="form-check-label"
                                for="SwitchCheckSizemd">Dark Mode</label>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-color-input" class="col-md-3 col-form-label">Sidebar & Primary Color</label>
                            <div class="col-md-1">
                                <input class="form-control form-control-color mw-100" type="color"
                                    value="{{ App\Models\Setting::get('color_sidebar') ?? '#556ee6' }}" name="color_sidebar">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-color-input" class="col-md-3 col-form-label">Top Sidebar</label>
                            <div class="col-md-1">
                                <input class="form-control form-control-color mw-100" type="color"
                                    value="{{ App\Models\Setting::get('color_sidebar_brand') ?? '#556ee6' }}"
                                    name="color_sidebar_brand">
                            </div>
                        </div>

                        <hr>

                        <div class="row mt-4">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary w-md">Save</button>
                                <button type="button" class="btn btn-warning"
                                    onclick="window.location.reload()">Cancel</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        @endslot
    </x-admin.layout-component>
@endsection
