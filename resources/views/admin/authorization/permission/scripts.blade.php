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
                    class: 'text-center'
                }
            ]
        })

        function create() {
            setCreate('Create Permission')
        }

        function store() {
            sendStore("{{ route('authorization.permission.store') }}", "POST", new FormData($('#form')[0]))
        }

        function edit(id) {
            $.ajax({
                url: "{{ route('authorization.permission.edit', ':id') }}".replace(':id', id),
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#exampleModal').modal('show')
                    $('.modal-title').text('Edit Permission')
                    $('#id').val(data.data.id)
                    $('#name').val(data.data.name)
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

        $('#status').change(function() {
            table.ajax.url("{{ route('authorization.permission.index') }}" + "?status=" + $(this).val()).load()
        });
    </script>
@endpush
