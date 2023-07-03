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
            <a href="{{ route('cms.site.index') }}" class="nav-link {{ Route::is('cms.site.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Site Setting</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('cms.theme.index') }}" class="nav-link {{ Route::is('cms.theme.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Theme</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('cms.slider.index') }}"
                class="nav-link {{ Route::is('cms.slider.index') ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Slider</p>
            </a>
        </li>
    </ul>
</li>
