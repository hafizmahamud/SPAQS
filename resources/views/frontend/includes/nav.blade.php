<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                <span class="d-none d-md-block dropdown-toggle">{{ $logged_in_user->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                    <h6>{{ $logged_in_user->name }}</h6>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                @if ($logged_in_user->isAdmin())
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ url('admin/dashboard') }}">
                        <i class="bi bi-gear"></i>
                        <span class="menu-title">@lang('Tetapan Pentadbir')</span>
                    </a>
                </li>
                @endif
                <li>
                    <hr class="dropdown-divider">
                </li>
                @if (strpos(Request::url(), 'sisdant') !== false)
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ url('/sisdant/account') }}">
                        <i class="bi bi-person"></i>
                        <span>Akaun Saya</span>
                    </a>
                </li>
                @elseif (strpos(Request::url(), 'tunas') !== false)
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ url('/tunas/account') }}">
                        <i class="bi bi-person"></i>
                        <span>Akaun Saya</span>
                    </a>
                </li>
                @elseif (strpos(Request::url(), 'awas') !== false)
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('/awas/account') }}">
                            <i class="bi bi-person"></i>
                            <span>Akaun Saya</span>
                        </a>
                    </li>
                @else
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ url('account') }}">
                        <i class="bi bi-person"></i>
                        <span>Akaun Saya</span>
                    </a>
                </li>
                @endif
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <x-utils.link :text="__('Logout')" class="dropdown-item" icon="bi bi-box-arrow-right"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <x-slot name="text">
                            @lang('Logout')
                            <x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
                        </x-slot>
                    </x-utils.link>
                </li>
            </ul>
        </li>
    </ul>
</nav>
