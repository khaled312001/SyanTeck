<div class="sidebar-menu">
    <button class="sidebar-close-btn" aria-label="Close sidebar">
        <i class="ti-close"></i>
    </button>
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('technician.dashboard') }}">
                {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
            </a>
        </div>
    </div>

    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ request()->routeIs('technician.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('technician.dashboard') }}" aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span>{{__('Dashboard')}}</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('technician.orders*') ? 'active' : '' }}">
                        <a href="{{ route('technician.orders') }}" aria-expanded="true">
                            <i class="ti-shopping-cart"></i>
                            <span>{{__('My Orders')}}</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('technician.profile*') ? 'active' : '' }}">
                        <a href="{{ route('technician.profile') }}" aria-expanded="true">
                            <i class="ti-user"></i>
                            <span>{{__('Profile')}}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

