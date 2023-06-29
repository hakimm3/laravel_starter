<li class="nav-item">
    <a href="#" class="nav-link {{ request()->is('authorization/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-key"></i>
      <p>
        Authorization
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('authorization.role.index') }}" class="nav-link {{ Route::is('authorization.role.index') ? 'active' : ''}}">
          <i class="far fa-circle nav-icon"></i>
          <p>Role</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('authorization.permission.index') }}" class="nav-link {{ Route::is('authorization.permission.index') ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Permission</p>
        </a>
      </li>
    </ul>
  </li>