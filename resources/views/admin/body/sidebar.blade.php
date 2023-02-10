@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
$user = Auth::guard('admin')->user();
@endphp

<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-profile">
            <div class="ulogo">
                <a href="{{ route('admin.dashboard') }}">
                    <div class="d-flex align-items-center justify-content-center">
                        <img src="{{ asset('backend/images/logo-dark.png') }}" alt="" width="30" height="30">
                        <h3><b>CMS</b> Management</h3>
                    </div>
                </a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{ ($route == 'dashboard') ? 'active':'' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i data-feather="pie-chart"></i>
                <span>Dashboard</span>
            </a>
            </li>
            @can('manage users')
                <li class="treeview {{ ($prefix == '/admin/users') ? 'active':'' }}" >
                    <a href="#" >
                        <i data-feather="users"></i>
                        <span>Manage User</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ $route == 'admin.user.view' ? 'active' : '' }}"><a href="{{ route('admin.user.view') }}"><i class="ti-more"></i>View User</a></li>
                        <li class="{{ $route == 'admin.user.add' ? 'active' : '' }}"><a href="{{ route('admin.user.add') }}"><i class="ti-more"></i>Add User</a></li>
                    </ul>
                </li>
            @endcan
            @if ($user->can('manage permissions') || $user->can('manage roles'))
                <li class="treeview {{ ($prefix == '/admin/roles') || ($prefix == '/admin/permissions') ? 'active':'' }}" >
                    <a href="#" >
                        <i data-feather="command"></i>
                        <span>Authorilization</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        @can('manage roles')
                            <li class="{{ $route == 'admin.role.view' ? 'active' : '' }}"><a href="{{ route('admin.role.view') }}"><i class="ti-more"></i>Role</a></li>
                        @endcan
                        @can('manage permissions')
                            <li class="{{ $route == 'admin.permission.view' ? 'active' : '' }}"><a href="{{ route('admin.permission.view') }}"><i class="ti-more"></i>Pemission</a></li>
                        @endcan
                    </ul>
                </li>
            @endif
            <li class="treeview {{ ($prefix == '/admin/profiles') ? 'active':'' }}">
                <a href="#">
                    <i data-feather="user"></i> <span>Manage Profile</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.profile.view' ? 'active' : '' }}"><a href="{{ route('admin.profile.view') }}"><i class="ti-more"></i>Your Profile</a></li>
                    <li class="{{ $route == 'admin.password.view' ? 'active' : '' }}"><a href="{{ route('admin.password.view') }}"><i class="ti-more"></i>Change Password</a></li>
                </ul>
            </li>
            <li class="treeview {{ ($prefix == '/admin/setup') ? 'active':'' }}">
                <a href="#">
                    <i data-feather="user"></i> <span>Set Up</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.category.view' ? 'active' : '' }}"><a href="{{ route('admin.category.view') }}"><i class="ti-more"></i>Category</a></li>
                    <li class="{{ $route == 'admin.tag.view' ? 'active' : '' }}"><a href="{{ route('admin.tag.view') }}"><i class="ti-more"></i>Tag</a></li>
                </ul>
            </li>
            <li class="treeview {{ ($prefix == '/admin/posts') ? 'active':'' }}" >
                <a href="#" >
                    <i data-feather="file-text"></i>
                    <span>Manage Post</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ $route == 'admin.post.view' ? 'active' : '' }}"><a href="{{ route('admin.post.view') }}"><i class="ti-more"></i>View Posts</a></li>
                    <li class="{{ $route == 'admin.post.add' ? 'active' : '' }}"><a href="{{ route('admin.post.add') }}"><i class="ti-more"></i>Add Post</a></li>
                </ul>
                </li>
            <li>
            @can('logs')
                <a href="{{ route('admin.log.view') }}">
                    <i data-feather="align-left"></i>
                    <span>Logs</span>
                </a>
            @endcan
            <a href="{{ route('admin.logout') }}">
                <i data-feather="lock"></i>
                <span>Log Out</span>
            </a>
            </li>
        </ul>
    </section>

    <div class="sidebar-footer">

        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>

        <a href="{{ route('admin.logout') }}" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
    </div>
</aside>
