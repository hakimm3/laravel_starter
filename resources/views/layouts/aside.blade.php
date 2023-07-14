<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link text-light text-center">
        <span class="brand-text"><b>{{ $setting['site_name'] }}</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="row">
            <div class="col-md-12">
                <div class="image text-center mt-3">
                    @if (auth()->user()->photo)
                        <img src="{{ asset('storage/user/' . auth()->user()->photo) }}" class="img-circle elevation-2"
                            width="50px" alt="User Image">
                    @else
                        <img src="{{ asset('asset_template/dist/img/avatar.png') }}" class="img-circle elevation-2"
                            width="50px" alt="User Image">
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="info text-center text-uppercase text-bold">
                    <a href="{{ route('profile.edit') }}" class="d-block">{{ auth()->user()->name }}</a>
                </div>
            </div>
            {{-- @dd(authRolesName()) --}}
            <div class="col-md-12">
                <div class="info text-center font-weight-light font-italic">
                    <p> {{ auth()->user()->roles->pluck('name')->implode(', ') }} </p>
                </div>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>
                            Notification
                            <span class="right badge badge-danger">3</span>
                        </p>
                    </a>
                </li>
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->

                {{-- cms --}}
                @role('Super User')
                <li class="nav-header">ADMINISTRATOR</li>
                @include('layouts.aside.aside-cms')
                @include('layouts.aside.aside-authorization')
                @include('layouts.aside.aside-user_management')
                @include('layouts.aside.aside-securitty')
                @endrole
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
