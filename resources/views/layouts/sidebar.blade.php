@if(isset(Auth::user()->role))
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::segment(1) == 'home' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <!-- Nav Item - Pages Collapse Menu -->
    
    @if(in_array(Auth::user()->role,['teacher','admin']))
    <li class="nav-item {{ Request::segment(1) == 'students' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('students.index')}}">
            <i class="fas fa-fw fa-user"></i>
            <span>Student</span>
        </a>
    </li>
    <li class="nav-item {{ Request::segment(1) == 'attendance' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('attendance.index')}}">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Attdance</span>
        </a>
    </li>
    @elseif(in_array(Auth::user()->role,['admin']))
    <li class="nav-item {{ Request::segment(1) == 'teachers' ? 'active' : '' }}">
        <a class="nav-link" href="{{route('teachers.index')}}">
            <i class="fas fa-chalkboard-teacher"></i>
            <span>Teachers</span>
        </a>
    </li>
    @endif
    <!-- Nav Item - Utilities Collapse Menu -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <!-- Sidebar Message -->
</ul>
@endif