@extends('layouts.app')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Sliders
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">CMS</a></li>
            <li class="breadcrumb-item active">Sliders</li>
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
                            <th>Image</th>
                            <th>Title</th>
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
            <form action="" id="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" id="image" class="form-control" placeholder="Image">
                </div>
                <div class="form-group">
                    <label for="">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                </div>
                <div class="form-group">
                    <label for="">Description <span class="text-danger">*</span></label>
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                        placeholder="Description"></textarea>
                </div>
                <input type="hidden" name="id" id="id">
            </form>
        @endslot
    </x-admin.modal-form-component>
@endsection

@include('admin.cms.slider.scripts')
