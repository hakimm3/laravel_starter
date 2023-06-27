<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user-cog"></i>
      <p>
        User Management
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('user-management.users.index') }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Master User</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('user-management.department.index') }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Master Department</p>
        </a>
      </li>
    </ul>
  </li>