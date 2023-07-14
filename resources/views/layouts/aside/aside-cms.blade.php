<li class="nav-item {{ request()->is('cms/*') ? 'menu-is-opening menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->is('cms/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-cog"></i>
        <p>
            CMS
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('cms.site.index') }}" class="nav-link {{ request()->is('cms/site*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Site Setting</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('cms.theme.index') }}" class="nav-link {{ request()->is('cms/theme*') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Theme</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('cms.slider.index') }}"
                class="nav-link {{ request()->is('cms/slider') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Slider</p>
            </a>
        </li>
    </ul>
</li>
