<!-- Modal -->
<div class="modal fade" id="modalImport" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="modalImportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalImportLabel">Import User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-import">
                    <div class="form-group">
                        <label for="">File <span class="text-danger">*</span></label>
                        <input type="file" name="file" id="file" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="submitImport()">Save</button>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script>
        function showModalImport() {
            $('#modalImport').modal('show');
            $('#form-import').trigger('reset');
        }

        function submitImport() {
            // send ajax
            let formData = new FormData();
            formData.append('file', $('#file').prop('files')[0]);
            $.ajax({
                url: "{{ route('user-management.users.import') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#modalImport').modal('hide');
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
                    // let error_message = '<ul>';
                    // $.each(data.responseJSON.errors, function(key, value) {
                    //     error_message += '<li>' + value + '</li>';
                    // });
                    // error_message += '</ul>';
                    console.log(data.responseJSON.errors)

                    var error_message = "";
                    var title = "";
                    if(data.responseJSON.errors) {
                        title = "Validation Error";
                        $.each( data.responseJSON.errors, function( key, value ) {
                            error_message +="<li>"+value+"</li>";
                        });
                    } else {
                        title = "Server Error";
                        error_message = "Error Message: "+data.responseJSON.message
                    }
                    Swal.fire({
                        icon: 'error',
                        title: title,
                        html: error_message,
                    });
                }
            });
        }
    </script>
@endpush
