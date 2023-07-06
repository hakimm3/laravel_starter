<script>
    function setCreate(title) {
        $('#exampleModal').modal('show');
        $('#exampleModal form')[0].reset();
        $('#id').val('')
        $('#exampleModal .modal-title').text(title);
    }

    function sendStore(url, method, formData) {
        $.ajax({
            url: url,
            type: method,
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
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
            error: function(data) {
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

    function sendDestroy(url) {
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
                    url: url,
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
</script>
