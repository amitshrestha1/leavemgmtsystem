<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}"wire:navigate>
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @can('Permission')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.permissionmanagement' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.permissionmanagement') }}"wire:navigate>
                    <i class="fa-solid fa-list fa-2xl menu-icon"></i>
                    <span class="menu-title">User Permissions</span>
                </a>
            </li>
        @endcan
        @can('User')
            <li
                class="nav-item {{ Route::currentRouteName() == 'admin.user' || Route::currentRouteName() == 'admin.edituser' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.user') }}"wire:navigate>
                    <i class="fa-solid fa-user fa-2xl menu-icon"></i>
                    <span class="menu-title">Users</span>
                </a>
            </li>
        @endcan
        @can('Department')
            <li
                class="nav-item {{ Route::currentRouteName() == 'admin.department' || Route::currentRouteName() == 'admin.editdepartment' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.department') }}"wire:navigate>
                    <i class="fa-solid fa-building-user fa-2xl menu-icon"></i>
                    <span class="menu-title">Departments</span>
                </a>
            </li>
        @endcan
        @can('LeaveType')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.type' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.type') }}"wire:navigate>
                    <i class="fa-solid fa-arrow-right-from-bracket fa-2xl menu-icon"></i>
                    <span class="menu-title">Leave Types</span>
                </a>
            </li>
        @endcan
        @can('Holiday')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.holiday' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.holiday') }}"wire:navigate>
                    <i class="fa-solid fa-heart fa-2xl menu-icon"></i>
                    <span class="menu-title">Holidays</span>
                </a>
            </li>
        @endcan
        @can('HolidayMode')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.mode' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.mode') }}"wire:navigate>
                    <i class="fa-solid fa-font-awesome fa-2xl menu-icon"></i>
                    <span class="menu-title">Holiday Mode</span>
                </a>
            </li>
        @endcan
        @can('UserLeaveBalance')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.userleavebalance' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.userleavebalance') }}"wire:navigate>
                    <i class="fa-solid fa-check fa-2xl menu-icon"></i>
                    <span class="menu-title">User Leave Balances</span>
                </a>
            </li>
        @endcan
        @can('LeaveEntitlement')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.leaveentitlement' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.leaveentitlement') }}"wire:navigate>
                    <i class="fa-solid fa-ribbon fa-2xl menu-icon"></i>
                    <span class="menu-title">Leave Entitlement</span>
                </a>
            </li>
        @endcan
        @can('Leave')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.leave' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.leave') }}"wire:navigate>
                    <i class="fa-solid fa-envelope fa-2xl menu-icon"></i>
                    <span class="menu-title">Leave Application</span>
                </a>
            </li>
        @endcan
        @can('Calendar')
            <li class="nav-item {{ Route::currentRouteName() == 'admin.calendar' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.calendar') }}"wire:navigate wire:load>
                    <i class="fa-solid fa-calendar-days fa-2xl menu-icon"></i>
                    <span class="menu-title">Calendar</span>
                </a>
            </li>
        @endcan
        @livewire('admin.auth.logout')

    </ul>
</nav>
