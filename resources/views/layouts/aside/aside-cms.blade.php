<li class="nav-item">
    <a href="#" class="nav-link {{ request()->is('cms/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-cog"></i>
        <p>
            CMS
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link {{ Route::is('authorization.role.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Site Setting</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('authorization.permission.index') }}"
                class="nav-link {{ Route::is('authorization.permission.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Slider</p>
            </a>
        </li>
    </ul>
</li>
