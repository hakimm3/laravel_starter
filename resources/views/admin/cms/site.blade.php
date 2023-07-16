@extends('layouts.app')

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
            <x-admin.box-component>
                @slot('header')
                @endslot
                @slot('body')
                    <form id="form">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Brand Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="brand_name" placeholder="Brand Name"
                                    value="{{ $setting['brand_name'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">App Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="site_name" placeholder="App Name"
                                    value="{{ $setting['site_name'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Site Description</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="site_description" placeholder="Site Description"
                                    value="{{ $setting['site_description'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="brand_phone" placeholder="Phone"
                                    value="{{ $setting['brand_phone'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="brand_address" placeholder="Brand Address"
                                    value="{{ $setting['brand_address'] }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Logo Small</label>
                            <div class="col-sm-10">
                                <img src="{{ asset('storage/setting/'. $setting['logo_small']) }}" class="rounded img-fluid mb-2" width="200px" alt="Logo Small" srcset="">
                                <input type="file" class="form-control" name="logo_small" placeholder="Logo Small">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Logo Large</label>
                            <div class="col-sm-10">
                                <img src="{{ asset('storage/setting/'. $setting['logo_large']) }}" class="rounded img-fluid mb-2" width="200px" alt="Logo Large" srcset="">
                                <input type="file" class="form-control" name="logo_large" placeholder="Logo Large">
                            </div>
                        </div>
                    </form>
                @endslot
                @slot('footer')
                    <button type="submit" id="submit" class="btn btn-success">Save</button>
                @endslot
            </x-admin.box-component>
        @endslot
    </x-admin.layout-component>
@endsection

@push('js')
    <script>
        $(function() {
            $('#submit').on('click', function(e) {
                e.preventDefault();
                let formData = new FormData($('#form')[0]);
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
            });
        });
    </script>
@endpush