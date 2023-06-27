<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-key"></i>
      <p>
        Authorization
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('authorization.role.index') }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Master Role</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('authorization.permission.index') }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Master Permission</p>
        </a>
      </li>
    </ul>
  </li>