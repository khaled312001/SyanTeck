<div class="sidebar-menu">
    <button class="sidebar-close-btn" aria-label="Close sidebar">
        <i class="ti-close"></i>
    </button>
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('finance.dashboard') }}">
                {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
            </a>
        </div>
    </div>

    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ request()->routeIs('finance.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('finance.dashboard') }}" aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span>{{__('Dashboard')}}</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('finance.invoices*') ? 'active' : '' }}">
                        <a href="{{ route('finance.invoices') }}" aria-expanded="true">
                            <i class="ti-receipt"></i>
                            <span>{{__('Invoices')}}</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('finance.reports') ? 'active' : '' }}">
                        <a href="{{ route('finance.reports') }}" aria-expanded="true">
                            <i class="ti-bar-chart"></i>
                            <span>{{__('Reports')}}</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('finance.statistics') ? 'active' : '' }}">
                        <a href="{{ route('finance.statistics') }}" aria-expanded="true">
                            <i class="ti-stats-up"></i>
                            <span>{{__('Statistics')}}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

