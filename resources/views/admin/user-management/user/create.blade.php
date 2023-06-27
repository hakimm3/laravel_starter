@push('js')
    <script>
        function create() {
            $('.modal-title').text('Create User')
            $('#exampleModal').modal('show')
            $('#form').trigger('reset')
            $('$department').trigger('reset')
            $('$roles').trigger('reset')
        }

        function store() {
            var formData = new FormData()
            formData.append('id', $('#id').val())
            formData.append('photo', $('#photo').prop('files')[0] ?? '')
            formData.append('name', $('#name').val())
            formData.append('username', $('#username').val())
            formData.append('email', $('#email').val())
            formData.append('department_id', $('#department').val())
            $('#role').val().forEach(function(role) {
                formData.append('roles[]', role)
            })
            formData.append('password', $('#password').val())


            $.ajax({
                url: "{{ route('user-management.users.store') }}",
                type: "POST",
                dataType: "JSON",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#exampleModal').modal('hide')
                    table.ajax.reload()
                    Swal.fire({
                        title: 'Success!',
                        text: 'Data has been saved!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                    })
                },
                error: function(data) {
                    let error_message = '<ul>'
                    $.each(data.responseJSON.errors, function(key, value) {
                        error_message += '<li>' + value + '</li>'
                    })
                    error_message += '</ul>'
                    Swal.fire({
                        title: 'Error!',
                        html: error_message,
                        icon: 'error',
                        showConfirmButton: true,
                    })
                }
            })
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
                        })
                    }
                })
        }
    </script>
@endpush
