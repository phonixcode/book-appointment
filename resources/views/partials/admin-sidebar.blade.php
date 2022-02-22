<!-- begin app-nabar -->
<aside class="app-navbar">
    <!-- begin sidebar-nav -->
    <div class="sidebar-nav scrollbar scroll_light">
        <ul class="metismenu " id="sidebarNav">
            <li class="nav-static-title">-------------------------------</li>
            <li class="{{ request()->is('admin') ? 'active' : '' }}">
                <a href="{{ route('admin.home') }}" aria-expanded="false">
                    <i class="nav-icon ti ti-calendar"></i>
                    <span class="nav-title">Appiontments</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/settings') ? 'active' : '' }}">
                <a href="{{ route('admin.settings') }}" aria-expanded="false">
                    <i class="nav-icon ti ti-settings"></i>
                    <span class="nav-title">Settings</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.logout') }}" aria-expanded="false" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="nav-icon zmdi zmdi-power"></i>
                    <span class="nav-title">Logout</span>
                </a>
                <form action="{{ route('admin.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
            </li>
        </ul>
    </div>
    <!-- end sidebar-nav -->
</aside>
<!-- end app-navbar -->
