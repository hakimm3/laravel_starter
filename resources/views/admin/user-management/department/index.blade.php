@extends('layouts.app_beckend')
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
            <x-admin.data-table-component id="table">
                @slot('header')
                    <button class="btn btn-primary my-2 btn-md" onclick="create()"><i class="fa fa-plus-circle"></i> Create</button>
                @endslot
                @slot('columns')
                    <th>Name</th>
                    <th>Code</th>
                    <th>Description</th>
                @endslot
            </x-admin.data-table-component>
        @endslot
    </x-admin.layout-component>

    <x-admin.modal-form-component>
        @slot('modalBody')
            <form action="" id="form">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="">Code</label>
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
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
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
                        var url = "{{ route('user-management.department.destroy', ':id') }}";
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
@endpush
@include('admin.user-management.department.create')
