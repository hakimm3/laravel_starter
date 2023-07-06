@extends('layouts.app')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Roles
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Roles</li>
        @endslot
        @slot('content')
            <x-admin.box-component>
                @slot('header')
                    <button class="btn btn-success my-2 btn-md" onclick="create()"><i class="fa fa-plus"></i> Create</button>
                @endslot
                @slot('body')
                    <div class="row">
                        <div class="col-sm-5 col-md-3">
                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-md-4 col-form-label">Status</label>
                                <div class="col-sm-5 col-md-8">
                                    <select name="status" id="status" class="form-control">
                                        <option value="All">All</option>
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
                <input type="hidden" name="id" id="id">
            </form>
        @endslot
    </x-admin.modal-form-component>
@endsection

@include('admin.authorization.role.scripts')
