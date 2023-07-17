    {{-- select2 --}}
    <script src="{{ asset('asset_template/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        let table = $('#table').DataTable({
            responsive: true,
            autoWidth: false,
            serverSide: true,
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
                    data: 'roles',
                    name: 'roles'
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
                }
            ]
        })

        function create() {
            setCreate('Create User')
            $('#department').val(null).trigger('change')
            $('#role').val(null).trigger('change')
        }

        function store() {
            sendStore("{{ route('user-management.users.store') }}", "POST", new FormData($('#form')[0]))
        }

        function edit(id) {
            $.ajax({
                url: "{{ route('user-management.users.edit', ':id') }}".replace(':id', id),
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('.modal-title').text('Edit User')
                    $('#exampleModal').modal('show')
                    $('#id').val(data.data.id)
                    $('#name').val(data.data.name)
                    $('#username').val(data.data.username)
                    $('#email').val(data.data.email)
                    $('#department').val(data.data.department_id).trigger('change')
                    let roles = []
                    data.data.roles.forEach(function(role) {
                        roles.push(role.name)
                    })
                    $('#role').val(roles).trigger('change')
                    $('#photo').val(data.photo)
                },
                error: function(data) {
                    alert('Error getting data');
                }
            });
        }
        
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

        // filter 
        $('#status').change(function() {
            table.ajax.url("{{ route('user-management.users.index') }}?status=" + $(this).val()).load()
        })
    </script>