@extends('layouts.app_beckend')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Profile
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item active">Profile</li>
        @endslot
        @slot('content')
            <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="name" class="form-control" id="name" value="{{ auth()->user()->name }}" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" placeholder="Email">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button onclick="update()" class="btn btn-primary">Update</button>
                    </div>
            </div>
        @endslot
    </x-admin.layout-component>
@endsection

@push('js')
    <script>
        function update(){
            // send ajax
            $.ajax({
                url: "{{ route('profile.update') }}",
                type: "PUT",
                data: {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true,
                    })
                },
                error: function (data, xhr, textStatus, errorThrown) {
                    let error_message = '<ul>';
                    $.each(data.responseJSON.errors, function (key, value) {
                        error_message += '<li>' + value + '</li>';
                    });
                    error_message += '</ul>';
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        html: error_message,
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    })
                }
            });
        }
    </script>
@endpush