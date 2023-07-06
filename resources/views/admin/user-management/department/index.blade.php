@extends('layouts.app')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Department
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Department</li>
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
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
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
            <form action="" id="form">
                <div class="form-group">
                    <label for="">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="">Code <span class="text-danger">*</span></label>
                    <input type="text" name="code" id="code" class="form-control" placeholder="Code">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                        placeholder="Description"></textarea>
                </div>
                <input type="hidden" name="id" id="id">
            </form>
        @endslot
    </x-admin.modal-form-component>

@endsection
@include('admin.user-management.department.scripts')
