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
            <form action="{{ route('cms.theme.store') }}" method="post" enctype="multipart/form-data">
                <x-admin.box-component>
                    @slot('header')
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                                {{ session('success') }}
                            </div>
                        @endif
                    @endslot
                    @slot('body')
                        @csrf
                        <div class="mb-3 row">
                            <label for="example-color-input" class="col-md-3 col-form-label">Sidebar</label>
                            <div class="col-md-1">
                                <input class="form-control form-control-color mw-100" type="color"
                                    value="{{ $setting['color_sidebar'] ?? '#007BFF' }}" name="color_sidebar">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="example-color-input" class="col-md-3 col-form-label">Top Sidebar</label>
                            <div class="col-md-1">
                                <input class="form-control form-control-color mw-100" type="color"
                                    value="{{ $setting['color_sidebar_brand'] ?? '#007BFF' }}" name="color_sidebar_brand">
                            </div>
                        </div>
                    @endslot
                    @slot('footer')
                        <button type="submit" id="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('cms.theme.index') }}" class="btn btn-secondary">Back</a>
                    @endslot
                </x-admin.box-component>
            </form>
        @endslot
    </x-admin.layout-component>
@endsection