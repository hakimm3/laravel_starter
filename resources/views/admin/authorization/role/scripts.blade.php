@push('js')
    <script>
        let table = $('#table').DataTable({
            responsive: true,
            autoWidth: false,
            serverSide: true,
            stateSave: true,
            ajax: {
                url: '',
                data: function(d) {
                    d.status = $('#status').val();
                }
            },
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
                    data: 'status',
                    name: 'status',
                    class: 'text-center',
                    orderable: false,
                    searchable: false,
                    width: '10%'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class: 'text-center',
                    width: '20%'
                }
            ]
        })

        function create() {
            setCreate('Create Roles')
        }

        function store() {
            sendStore("{{ route('authorization.role.store') }}", "POST", new FormData($('#form')[0]))
        }

        function edit(id) {
            $.ajax({
                url: "{{ route('authorization.role.edit', ':id') }}".replace(':id', id),
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#exampleModal').modal('show')
                    $('.modal-title').text("Edit Roles")
                    $('#id').val(data.data.id)
                    $('#name').val(data.data.name)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

        function destroy(id) {
            sendDestroy("{{ route('authorization.role.destroy', ':id') }}".replace(':id', id))
        }

        $('#status').change(function() {
            table.ajax.url("{{ route('authorization.role.index') }}" + "?status=" + $(this).val()).load()
        });
    </script>
@endpush
