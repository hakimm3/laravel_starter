@push('js')
    <script>
        function create(){
            $('#exampleModal').modal('show');
            $('#exampleModal form')[0].reset();
            $('#id').val('')
            $('#exampleModal .modal-title').text('Create Slider');
        }

        function store(){
            var formData = new FormData();
            formData.append('id', $('#id').val());
            formData.append('image', $('#image')[0].files[0]) ?? null;
            formData.append('title', $('#title').val());
            formData.append('description', $('#description').val());
            formData.append('status', $('#status').val());

            $.ajax({
                url: "{{ route('cms.slider.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    $('#exampleModal').modal('hide');
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
                error: function(data){
                    let error_message = '<ul>'
                    $.each(data.responseJSON.errors, function(key, value) {
                        error_message += '<li>' + value + '</li>'
                    });
                    error_message += '</ul>'
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: error_message,
                    });
                }
            });
        }

        function edit(id){
            $.ajax({
                url: "{{ route('cms.slider.edit', ':id') }}".replace(':id', id),
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#exampleModal').modal('show');
                    $('#exampleModal .modal-title').text('Edit Slider');
                    $('#id').val(data.data.id);
                    $('#title').val(data.data.title);
                    $('#description').val(data.data.description);
                    $('#status').val(data.data.status);
                },
                error: function(data){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.responseJSON.message,
                    });
                }
            });
        }
    </script>
@endpush