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
                    data: 'code',
                    name: 'code'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'status',
                    name: 'status',
                    class: 'text-center',
                    width: '10%',
                    orderable: false,
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class: 'text-center'
                },
            ]
        })

        function create() {
            setCreate('Create Department')
        }

        function store() {
            sendStore("{{ route('user-management.department.store') }}", "POST", new FormData($('#form')[0]))
        }

        function edit(id) {
            let url = "{{ route('user-management.department.edit', ':id') }}"
            url = url.replace(":id", id)
            $.ajax({
                url: url,
                type: 'get',
                success: function(data) {
                    $('.modal-title').text('Edit Department')
                    $('#exampleModal').modal('show')

                    $('#name').val(data.data.name)
                    $('#code').val(data.data.code)
                    $('#description').val(data.data.description)
                    $('#id').val(data.data.id)
                }
            })
        }

        // filter 
        $('#status').on('change', function() {
            table.ajax.url("{{ route('user-management.department.index') }}?status=" + $(this).val()).load(false);
        });
    </script>
@endpush
