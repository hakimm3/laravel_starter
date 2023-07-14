@extends('layouts.app')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            User
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User</li>
        @endslot
        @slot('content')
            <x-admin.box-component>
                @slot('header')
                    <div class="row">
                        <div class="col-sm-5 col-md-1">
                            <button class="btn btn-success my-2" onclick="create()"><i class="fa fa-plus"></i> Create</button>
                        </div>
                        <div class="col-sm-5 col-md-8"></div>
                        <div class="col-sm-5 col-md-3 d-flex justify-content-end">
                            <a href="{{ asset('excel_template/ImportUser.xlsx') }}" class="btn bg-purple my-2 mr-2"><i
                                    class="fa fa-download"></i> Download Template</a>
                            <button class="btn bg-orange my-2" onclick="showModalImport()"><i class="fa fa-file-import"></i>
                                Import</button>
                        </div>
                    </div>
                @endslot
                @slot('body')
                    <div class="row">
                        <div class="col-sm-5 col-md-3">
                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-md-4 col-form-label">Status</label>
                                <div class="col-sm-5 col-md-8">
                                    <select name="status" id="status" class="form-control">
                                        <option value="All" selected>All</option>
                                        <option value="Active">Active</option>
                                        <option value="Inctive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <x-admin.data-table-component id="table">
                        @slot('columns')
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Roles</th>
                            <th>Status</th>
                        @endslot
                    </x-admin.data-table-component>
                @endslot
                @slot('footer')
                @endslot
            </x-admin.box-component>
        @endslot
    </x-admin.layout-component>

    <x-admin.modal-form-component>
        @slot('modalBody')
            <form action="" id="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="">Username <span class="text-danger">*</span></label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="">Email <span class="text-danger">*</span></label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="">Department <span class="text-danger">*</span></label>
                    <select name="department_id" id="department" class="form-control">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Role <span class="text-danger">*</span></label>
                    <select name="roles[]" id="role" class="form-control" multiple>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <span>* Password default <b>password</b></span>
                <input type="hidden" name="id" id="id">
            </form>
        @endslot
    </x-admin.modal-form-component>
@endsection


@push('css')
    {{-- select 2 --}}
    <link rel="stylesheet" href="{{ asset('asset_template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset_template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
@push('js')
    <x-script.destroy-component/>
    <x-script.store-component/>
    @include('admin.user-management.user.scripts')
@endpush

@include('admin.user-management.user.import')
