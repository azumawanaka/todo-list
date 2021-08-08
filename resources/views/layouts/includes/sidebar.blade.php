
<ul class="navbar-nav w-20 my-4 justify-content-between">
    <li class="nav-item {{ (request()->is('user_lists')) ? 'active' : '' }}">
        <a class="nav-link bg-dark pl-4 text-white rounded-link" href="{{ route('user.home') }}">
            <i class="fa fa-tasks"></i>
            <span>Task</span></a>
    </li>
    <li class="nav-item {{ (request()->is('user_lists')) ? 'active' : '' }}">
        <a class="nav-link pl-4 text-dark rounded-link" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fa fa-sign-out"></i>
            <span>Logout</span></a>
    </li>
</ul>
