@extends('layouts.app_beckend')
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
            <x-admin.data-table-component id="table">
                @slot('header')
                    <button class="btn btn-primary my-2 btn-md" onclick="create()"><i class="fa fa-plus-circle"></i> Create</button>
                @endslot
                @slot('columns')
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Photo</th>
                    <th>Roles</th>
                @endslot
            </x-admin.data-table-component>
        @endslot
    </x-admin.layout-component>

    <x-admin.modal-form-component>
        @slot('modalBody')
            <form action="" id="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="">Department</label>
                    <select name="department_id" id="department" class="form-control">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Role</label>
                    <select name="roles[]" id="role" class="form-control" multiple>
                        <option value="">--Select Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
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
    {{-- select2 --}}
    <script src="{{ asset('asset_template/plugins/select2/js/select2.min.js') }}"></script>

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
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'department',
                    name: 'department'
                },
                {
                    data: 'photo',
                    name: 'photo'
                },
                {
                    data: 'roles',
                    name: 'roles'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,

                }
            ]
        })

        function destroy(id) {
            Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    dangerMode: true,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        var url = "{{ route('user-management.users.destroy', ':id') }}";
                        url = url.replace(':id', id);

                        $.ajax({
                            url: url,
                            type: "DELETE",
                            data: {
                                "id": id
                            },
                            dataType: "JSON",
                            success: function(data) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: "Data Succesfully Deleted",
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true,
                                });
                                table.ajax.reload()
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert('Error deleting data');
                            }
                        });
                    }
                });
        }
    </script>
    <script>
        // select 2

        $('#role').select2({
            theme: 'bootstrap4',
            placeholder: 'Select Role',
            allowClear: true
        })

        $('#department').select2({
            theme: 'bootstrap4',
            placeholder: 'Select Department',
            allowClear: true
        })
    </script>
@endpush
@include('admin.user-management.user.create')
