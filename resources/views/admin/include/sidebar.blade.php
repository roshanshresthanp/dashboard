<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <li class="menu-item" aria-haspopup="true">
                <a href="index.html" class="menu-link">
                    <span class="svg-icon menu-icon fas fa-tachometer-alt">
                    </span>
                    <i class="fa fa-tachometer" aria-hidden="true"></i>

                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            
            <li class="menu-section">
                <h4 class="menu-text">User Management</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>

            <li class="menu-item" aria-haspopup="true">
                <a href="index.html" class="menu-link">
                    <span class="svg-icon menu-icon fas fa-user-cog">
                    </span>
                    <i class="fa fa-tachometer" aria-hidden="true"></i>

                    <span class="menu-text">Users</span>
                </a>
            </li>

            <li class="menu-item menu-item-submenu {{ str_contains(Route::currentRouteName(), "perm") ? "menu-item-open menu-item-here" : "" }} " aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon fas fa-shield-alt">
                    </span>
                    <span class="menu-text">Roles & Permissions</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        {{-- <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link">
                                <span class="menu-text">Users</span>
                            </span>
                        </li> --}}
                        <li class="menu-item {{request()->is('*/roles') ? 'menu-item-active' : ''}}" aria-haspopup="true">
                            <a href="{{route('roles.index')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Roles</span>
                            </a>
                        </li>
                        <li class="menu-item {{request()->is('*/permissions') ? 'menu-item-active' : ''}}" aria-haspopup="true">
                            <a href="{{route('permissions.index')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Permission</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item menu-item-active" aria-haspopup="true">
                <a href="{{route('customers.index')}}" class="menu-link">
                    <span class="svg-icon menu-icon fas fa-user-friends">
                    </span>
                    <i class="fa fa-tachometer" aria-hidden="true"></i>

                    <span class="menu-text">Customer</span>
                </a>
            </li>
        </ul>
    </div>
    <!--end::Menu Container-->
</div>