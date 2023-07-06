@extends('layouts.app')
@section('content')
    <x-admin.layout-component>
        @slot('pageHeader')
            Permissions {{ $role->name }}
        @endslot
        @slot('breadcrumb')
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a class="text-dark" href="{{ route('authorization.role.index') }}">Roles</a></li>
            <li class="breadcrumb-item active"><a class="text-dark" href="#">Permission</a></li>
        @endslot
        @slot('content')
            <form action="{{ route('authorization.role-permission', Crypt::encrypt($role->id)) }}" method="post">
                @csrf
                <x-admin.box-component>
                    @slot('header')
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="checkAll"> Check All
                                </label>
                            </div>
                        </div>
                    @endslot
                    @slot('body')
                        @foreach ($permission as $key => $perm)
                            <table class="table table-striped">
                                <thead class="main-header">
                                    <th class="text-uppercase" colspan="{{ $perm->count() }}">{{ $key }}</th>
                                </thead>
                                <tbody>
                                    @foreach ($perm as $action)
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="{{ $action->id }}"
                                                        @if ($role->hasPermissionTo($action['action'] . ' ' . $key)) checked @endif>
                                                    {{ $action['action'] }}
                                                </label>
                                            </div>
                                        </td>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    @endslot
                    @slot('footer')
                        <button type="submit" class="btn btn-primary pull-right mt-2">Save</button>
                        <a href="{{ route('authorization.role.index') }}" class="btn btn-secondary pull-right mr-2 mt-2">Cancel</a>
                    @endslot
                </x-admin.box-component>
            </form>

            {{-- <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Role Name</label>
                            <input type="text" class="form-control" value="{{ $role->name }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="checkAll"> Check All
                                </label>
                            </div>
                        </div>
                        <form action="{{ route('authorization.role-permission', Crypt::encrypt($role->id)) }}" method="post">
                            @csrf
                            @foreach ($permission as $key => $perm)
                                <table class="table table-striped">
                                    <thead class="main-header">
                                        <th class="text-uppercase" colspan="{{ $perm->count() }}">{{ $key }}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($perm as $action)
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permissions[]" value="{{ $action->id }}"
                                                            @if ($role->hasPermissionTo($action['action'] . ' ' . $key)) checked @endif>
                                                        {{ $action['action'] }}
                                                    </label>
                                                </div>
                                            </td>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                            <button type="submit" class="btn btn-primary pull-right mt-2">Save</button>
                            <a href="{{ route('authorization.role.index') }}"
                                class="btn btn-secondary pull-right mr-2 mt-2">Cancel</a>
                        </form>
                    </div>
                </div>
            </div> --}}
        @endslot
    </x-admin.layout-component>
@endsection

@push('css')
    <style>
        label {
            font-weight: 500 !important;
        }
    </style>
@endpush


@push('js')
    {{-- check all --}}
    <script>
        $(document).ready(function() {
            $('#checkAll').click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        });
    </script>
@endpush
