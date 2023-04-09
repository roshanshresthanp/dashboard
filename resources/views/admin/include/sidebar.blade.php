<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <li class="menu-item" aria-haspopup="true">
                <a href="{{route('dashboard')}}" class="menu-link">
                    <span class="svg-icon menu-icon fas fa-tachometer-alt">
                    </span>
                    <i class="fa fa-tachometer" aria-hidden="true"></i>

                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            
            <li class="menu-section ">
                <h4 class="menu-text">User Management</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>

            <li class="menu-item {{ str_contains(Route::currentRouteName(), "users") ? "menu-item-active" : '' }}" aria-haspopup="true">
                <a href="{{route('users.index')}}" class="menu-link">
                    <span class="svg-icon menu-icon fas fa-user-cog">
                    </span>
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
                        <li class="menu-item {{request()->is('*/roles/*') ? 'menu-item-active' : ''}}" aria-haspopup="true">
                            <a href="{{route('roles.index')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Roles</span>
                            </a>
                        </li>
                        <li class="menu-item {{request()->is('*/permissions/*') ? 'menu-item-active' : ''}}" aria-haspopup="true">
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
            <li class="menu-item " aria-haspopup="true">
                <a href="{{route('customers.index')}}" class="menu-link">
                    <span class="svg-icon menu-icon fas fa-user-friends">
                    </span>
                    <span class="menu-text">Customers</span>
                </a>
            </li>

            <li class="menu-section">
                <h4 class="menu-text">Clothes</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>

            <li class="menu-item menu-item-submenu {{ str_contains(Route::currentRouteName(), "cloth-types") ? "menu-item-open menu-item-here" : "" }} " aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon fas fa-tshirt">
                    </span>
                    <span class="menu-text">Cloth type</span>
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
                        <li class="menu-item {{Route::is('cloth-types.create') ? 'menu-item-active' : ''}}" aria-haspopup="true">
                            <a href="{{route('cloth-types.create')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Add type</span>
                            </a>
                        </li>
                        <li class="menu-item {{Route::is('cloth-types.index') ? 'menu-item-active' : ''}}" aria-haspopup="true">
                            <a href="{{route('cloth-types.index')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">View Cloth type</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="menu-item menu-item-submenu {{ str_contains(Route::currentRouteName(), "promo-codes") ? "menu-item-open menu-item-here" : "" }} " aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon fas fa-search-dollar">
                    </span>
                    <span class="menu-text">Promo Codes</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item {{Route::is('promo-codes.create') ? 'menu-item-active' : ''}}" aria-haspopup="true">
                            <a href="{{route('promo-codes.create')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Add Promo code</span>
                            </a>
                        </li>
                        <li class="menu-item {{Route::is('promo-codes.index') ? 'menu-item-active' : ''}}" aria-haspopup="true">
                            <a href="{{route('promo-codes.index')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">View Promo code</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-item menu-item-submenu {{ str_contains(Route::currentRouteName(), "promo-codes") ? "menu-item-open menu-item-here" : "" }} " aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <span class="svg-icon menu-icon fab fa-rocketchat">
                    </span>
                    <span class="menu-text">Enquiries</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item {{Route::is('promo-codes.create') ? 'menu-item-active' : ''}}" aria-haspopup="true">
                            <a href="{{route('promo-codes.create')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">Enquiry</span>
                            </a>
                        </li>
                        <li class="menu-item {{Route::is('promo-codes.index') ? 'menu-item-active' : ''}}" aria-haspopup="true">
                            <a href="{{route('promo-codes.index')}}" class="menu-link">
                                <i class="menu-bullet menu-bullet-dot">
                                    <span></span>
                                </i>
                                <span class="menu-text">View Promo code</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="menu-section">
                <h4 class="menu-text">ORDERS</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>

            <li class="menu-item menu-item-active" aria-haspopup="true">
                <a href="#" class="menu-link">
                    <span class="svg-icon menu-icon fab fa-opencart">
                    </span>
                    {{-- <i class="fa fa-tachometer" aria-hidden="true"></i> --}}
                    <span class="menu-text">Orders</span>
                </a>
            </li>
            <li class="menu-item menu-item-active" aria-haspopup="true">
                <a href="#" class="menu-link">
                    <span class="svg-icon menu-icon far fa-money-bill-alt">
                    </span>
                    {{-- <i class="fa fa-tachometer" aria-hidden="true"></i> --}}
                    <span class="menu-text">Transactions</span>
                </a>
            </li>

            <li class="menu-section">
                <h4 class="menu-text">Logs</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>

            <li class="menu-item {{Route::is('smsLog') ? 'menu-item-active' : ''}}" aria-haspopup="true">
                <a href="{{route('smsLog')}}" class="menu-link">
                    <span class="svg-icon menu-icon fas fa-sms">
                    </span>
                    <span class="menu-text">SMS</span>
                </a>
            </li>
            {{-- <li class="menu-item {{Route::is('emailLog') ? 'menu-item-active' : ''}}" aria-haspopup="true">
                <a href="{{route('emailLog')}}" class="menu-link">
                    <span class="svg-icon menu-icon fas fa-mail-bulk">
                    </span>
                    <span class="menu-text">Email</span>
                </a>
            </li> --}}
            <li class="menu-item {{Route::is('activityLog') ? 'menu-item-active' : ''}}" aria-haspopup="true">
                <a href="{{route('activityLog')}}" class="menu-link">
                    <span class="svg-icon menu-icon fab fa-uncharted">
                    </span>
                    <span class="menu-text">Activity</span>
                </a>
            </li>
        </ul>
    </div>
    <!--end::Menu Container-->
</div>
