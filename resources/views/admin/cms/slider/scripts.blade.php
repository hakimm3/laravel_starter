@push('js')
    <script>
        let table = $('#table').DataTable({
            responsive: true,
            autoWidth: false,
            serverSide: true,
            siteSave: true,
            ajax: {
                url: "",
                data: function(data) {
                    data.status = $('#status').val();
                }
            },
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

        function create() {
            setCreate('Create Slider');
        }

        function store() {
            var formData = new FormData();
            formData.append('id', $('#id').val());
            formData.append('image', $('#image')[0].files[0]) ?? null;
            formData.append('title', $('#title').val());
            formData.append('description', $('#description').val());
            formData.append('status', $('#status').val());

            sendStore("{{ route('cms.slider.store') }}", "POST", formData);
        }

        function edit(id) {
            $.ajax({
                url: "{{ route('cms.slider.edit', ':id') }}".replace(':id', id),
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#exampleModal').modal('show');
                    $('#exampleModal .modal-title').text('Edit Slider');
                    $('#id').val(data.data.id);
                    $('#title').val(data.data.title);
                    $('#description').val(data.data.description);
                    $('#status').val(data.data.status);
                },
                error: function(data) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.responseJSON.message,
                    });
                }
            });
        }

        function destroy(id) {
            sendDestroy("{{ route('cms.slider.destroy', ':id') }}".replace(':id', id));
        }

        // filter
        $('#status').on('change', function() {
            table.ajax.url("{{ route('cms.slider.index') }}?status=" + $(this).val()).load();
        });
    </script>
@endpush
