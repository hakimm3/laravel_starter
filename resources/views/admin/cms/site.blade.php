@extends('layouts.app_beckend')

@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Site Settings
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">CMS</a></li>
            <li class="breadcrumb-item active">Site Setting</li>
        @endslot

        @slot('content')
            <div class="card card-info">
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Brand Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="brand_name" placeholder="Brand Name"
                                    value="{{ App\Models\Setting::get('brand_name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">App Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="site_name" placeholder="App Name"
                                    value="{{ App\Models\Setting::get('site_name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Site Description</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="site_description"
                                    placeholder="Site Description" value="{{ App\Models\Setting::get('site_description') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="brand_phone" placeholder="Phone"
                                    value="{{ App\Models\Setting::get('brand_phone') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="brand_address" placeholder="Brand Address"
                                    value="{{ App\Models\Setting::get('brand_address') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Logo Small</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="logo_small" placeholder="Logo Small">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Logo Large</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="logo_large" placeholder="Logo Large">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        @endslot
    </x-admin.layout-component>
@endsection

@push('js')
    <script>
        $(function() {
            $('form').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                    url: "{{ route('cms.site.store') }}",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            location.reload();
                        })
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
            });
        });
    </script>
@endpush
