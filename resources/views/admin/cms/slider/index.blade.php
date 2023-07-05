@extends('layouts.app_beckend')
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
            <x-admin.data-table-component id="table">
                @slot('header')
                    <button class="btn btn-success my-2 btn-md" onclick="create()"><i class="fa fa-plus"></i> Create</button>
                @endslot
                @slot('filter')
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
                @endslot
                @slot('columns')
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                @endslot
            </x-admin.data-table-component>
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

@push('js')
    <script>
        let table = $('#table').DataTable({
            responsive: true,
            autoWidth: false,
            serverSide: true,
            ajax: '',
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'status',
                    name: 'status',
                    class: 'text-center',
                    width: '10%'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class: 'text-center'
                },
            ]
        });

        function destroy(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#556ee6',
                cancelButtonColor: '#f46a6a',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('cms.slider.destroy', ':id') }}".replace(':id', id),
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $('#table').DataTable().ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                            });
                        },
                        error: function(data) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message,
                            });
                        }
                    });
                }
            })
        }

        function restore(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to restore this data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#556ee6',
                cancelButtonColor: '#f46a6a',
                confirmButtonText: 'Yes, restore it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('cms.slider.restore', ':id') }}".replace(':id', id),
                        type: "GET",
                        success: function(response) {
                            $('#table').DataTable().ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                            });
                        },
                        error: function(data) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message,
                            });
                        }
                    });
                }
            })
        }
    </script>
    <script>
        $('#status').on('change', function() {
            table.ajax.url("{{ route('cms.slider.index') }}?status=" + $(this).val()).load();
        });
    </script>
@endpush
@include('admin.cms.slider.create')
