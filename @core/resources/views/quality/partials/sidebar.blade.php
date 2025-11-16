<div class="sidebar-menu">
    <button class="sidebar-close-btn" aria-label="Close sidebar">
        <i class="ti-close"></i>
    </button>
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('quality.dashboard') }}">
                {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
            </a>
        </div>
    </div>

    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{ request()->routeIs('quality.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('quality.dashboard') }}" aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span>{{__('Dashboard')}}</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('quality.followups*') ? 'active' : '' }}">
                        <a href="{{ route('quality.followups') }}" aria-expanded="true">
                            <i class="ti-check-box"></i>
                            <span>{{__('Quality Followups')}}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

