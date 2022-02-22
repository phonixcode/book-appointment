<!-- begin app-nabar -->
<aside class="app-navbar">
    <!-- begin sidebar-nav -->
    <div class="sidebar-nav scrollbar scroll_light">
        <ul class="metismenu " id="sidebarNav">
            <li class="nav-static-title">-------------------------------</li>

            <li class="{{ request()->is('/') ? 'active' : '' }}">
                <a href="{{ route('user.home') }}" aria-expanded="false">
                    <i class="nav-icon ti ti-calendar"></i>
                    <span class="nav-title">List Appointments</span>
                </a>
            </li>
            <li class="{{ request()->is('appointment/create') ? 'active' : '' }}">
                <a href="{{ route('user.appointment.create') }}" aria-expanded="false">
                    <i class="nav-icon ti ti-calendar"></i>
                    <span class="nav-title">New Appointment</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.logout') }}" aria-expanded="false" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="nav-icon zmdi zmdi-power"></i>
                    <span class="nav-title">Logout</span>
                </a>
                <form action="{{ route('user.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
            </li>
        </ul>
    </div>
    <!-- end sidebar-nav -->
</aside>
<!-- end app-navbar -->
