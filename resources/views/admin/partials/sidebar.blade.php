<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('admin.index') }}">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120"
                     xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87" />
                        <polygon class="st0" points="96,69 33,69 42,51 105,51" />
                        <polygon class="st0" points="78,33 15,33 24,15 87,15" />
                    </g>
                </svg>
            </a>
        </div>

        {{-- Home page --}}
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
                <a class="nav-link " href="{{ route('admin.index') }}">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">{{ __('keywords.home') }}</span>
                </a>
            </li>
        </ul>

        <p class="text-muted nav-heading mt-4 mb-1">
            <span>{{ __('keywords.components') }}</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            {{-- Services --}}
            <li class="nav-item w-100">
                <a class="nav-link {{ request()->is('*/sections*') ? 'text-primary' : '' }}" href="{{ route('admin.sections') }}">
                    <i class="fe fe-codesandbox"></i>
                    <span class="ml-3 item-text">{{ __('keywords.sections') }}</span>
                </a>
            </li>

            {{-- Categories --}}
            <li class="nav-item w-100">
                <a class="nav-link {{ request()->is('*/categor*') ? 'text-primary' : '' }}" href="{{ route('admin.categories') }}">
                    <i class="fe fe-folder"></i>
                    <span class="ml-3 item-text">{{ __('keywords.categories') }}</span>
                </a>
            </li>

            {{-- Members --}}
            <li class="nav-item w-100">
                <a class="nav-link {{ request()->is('*/member*') ? 'text-primary' : '' }}" href="{{ route('admin.members') }}">
                    <i class="fe fe-users"></i>
                    <span class="ml-3 item-text">{{ __('keywords.members') }}</span>
                </a>
            </li>

            {{-- Ads --}}
            <li class="nav-item w-100">
                <a class="nav-link {{ request()->is('*/ad*') ? 'text-primary' : '' }}" href="{{ route('admin.ads') }}">
                    <i class="bi bi-megaphone"></i>
                    <span class="ml-3 item-text">{{ __('keywords.ads') }}</span>
                </a>
            </li>
            {{-- banners --}}
            <li class="nav-item w-100">
                <a class="nav-link {{ request()->is('*/banners*') ? 'text-primary' : '' }}" href="{{ route('admin.banners') }}">
                    <i class="bi bi-megaphone"></i>
                    <span class="ml-3 item-text">{{ __('keywords.banners') }}</span>
                </a>
            </li>

            {{-- Messages --}}
            <li class="nav-item w-100">
                <a class="nav-link {{ request()->is('*/message*') ? 'text-primary' : '' }}" href="{{ route('admin.messages') }}">
                    <i class="fe fe-message-square"></i>
                    <span class="ml-3 item-text">{{ __('keywords.messages') }}</span>
                </a>
            </li>

            {{-- Rating --}}
            <li class="nav-item w-100">
                <a class="nav-link {{ request()->is('*/rating*') ? 'text-primary' : '' }}" href="{{ route('admin.ratings') }}">
                    <i class="fe fe-message-circle"></i>
                    <span class="ml-3 item-text">{{ __('keywords.rating') }}</span>
                </a>
            </li>

            {{-- settings --}}
            <li class="nav-item w-100">
                <a class="nav-link {{ request()->is('*/settings*') ? 'text-primary' : '' }}" href="{{ route('admin.settings') }}">
                    <i class="fe fe-settings"></i>
                    <span class="ml-3 item-text">{{ __('keywords.settings') }}</span>
                </a>
            </li>

            {{-- users --}}
            <li class="nav-item w-100">
                <a class="nav-link {{ request()->is('*/users*') ? 'text-primary' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="bi bi-person"></i>
                    <span class="ml-3 item-text">{{ __('keywords.users') }}</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>

