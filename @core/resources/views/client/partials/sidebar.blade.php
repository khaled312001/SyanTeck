<div class="sidebar-menu">
    <button class="sidebar-close-btn" aria-label="Close sidebar">
        <i class="ti-close"></i>
    </button>
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('client.dashboard') }}">
                {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
            </a>
        </div>
    </div>

    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('client.dashboard') }}" aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span>{{__('Dashboard')}}</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('client.orders*') ? 'active' : '' }}">
                        <a href="{{ route('client.orders') }}" aria-expanded="true">
                            <i class="ti-shopping-cart"></i>
                            <span>{{__('My Orders')}}</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('client.orders.create') ? 'active' : '' }}">
                        <a href="{{ route('client.orders.create') }}" aria-expanded="true">
                            <i class="ti-plus"></i>
                            <span>{{__('New Request')}}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

