<div class="sidebar-menu">
    <button class="sidebar-close-btn" aria-label="Close sidebar">
        <i class="ti-close"></i>
    </button>
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('support.dashboard') }}">
                {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
            </a>
        </div>
    </div>

    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ request()->routeIs('support.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('support.dashboard') }}" aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span>{{__('Dashboard')}}</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('support.orders*') ? 'active' : '' }}">
                        <a href="{{ route('support.orders') }}" aria-expanded="true">
                            <i class="ti-shopping-cart"></i>
                            <span>{{__('Orders')}}</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('support.customers*') ? 'active' : '' }}">
                        <a href="{{ route('support.customers') }}" aria-expanded="true">
                            <i class="ti-user"></i>
                            <span>{{__('Customers')}}</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('support.export') }}" aria-expanded="true">
                            <i class="ti-download"></i>
                            <span>{{__('Export Data')}}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

