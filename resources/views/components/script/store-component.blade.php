<script>
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

</script>
