<style>
    .sidebar-body .menu-body li a.active {
        background-color: #CAAE78;
        color: #fff;
        font-weight: bold;
    }
</style>

<div class="sidebar">
    <div class="sidebar-logo d-flex justify-content-center align-items-center">
        <a href="/" class="d-none d-xl-block"><img src="{{ asset('images/logo-icon.png') }}" alt=""></a>
        <button type="button" class="menu-btn d-block d-xl-none"><span class="d-none">Menu</span></button>
    </div>
    <div class="sidebar-body">
        <div class="menu-item">
            <h6>Main</h6>
            <ul id="side-menu" class="menu-body">
                <li>
                    <a href="{{ route('themeList') }}" class="{{ Route::currentRouteName() == 'themeList' ? 'active' : '' }}">
                        <span class="icon"><img src="{{ asset('images/icon-1.png') }}" alt=""></span>Theme
                    </a>
                </li>
                <li>
                    <a href="{{route('suraList')}}" class="{{ Request::is('sura*') ? 'active' : '' }}">
                        <span class="icon"><img src="{{ asset('images/icon-2.png') }}" alt=""></span>Suras
                    </a>
                </li>
                <li>
                    <a href="{{route('resourceList')}}" class="{{ Request::is('resource*') ? 'active' : '' }}">
                        <span class="icon"><img src="{{ asset('images/resource-icon.png') }}" alt=""></span>Resources
                    </a>
                </li>
                <li class="{{ Request::is('sura*') ? 'active' : '' }}">
                    <a href="#">
                        <span class="icon"><img src="{{ asset('images/icon-3.png') }}" alt=""></span>Quran City
                    </a>
                    <ul>
                        <li><a href="#">About Quran City</a></li>
                        <li>
                            <a href="{{ route('suraList') }}" class="{{ Route::currentRouteName() == 'suraList' ? 'active' : '' }}">
                                Suras
                            </a>
                        </li>
                        <li><a href="#">Summarized Sura </a></li>
                        <li><a href="#">Detailed Sura Information</a></li>
                        <li><a href="#">Media</a></li>
                        <li>
                            <a href="{{ route('resourceList') }}" class="{{ Route::currentRouteName() == 'resourceList' ? 'active' : '' }}">
                                Resources
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="{{ Request::is('admin*') ? 'active' : '' }}">
                        <span class="icon"><img src="{{ asset('images/icon-4.png') }}" alt=""></span>Quran City Administration
                    </a>
                </li>
                <li>
                    <a href="#" class="{{ Request::is('notifications*') ? 'active' : '' }}">
                        <span class="icon"><img src="{{ asset('images/icon-5.png') }}" alt=""></span>Push Notifications
                    </a>
                </li>
                <li>
                    <a href="#" class="{{ Request::is('administration*') ? 'active' : '' }}">
                        <span class="icon"><img src="{{ asset('images/icon-4.png') }}" alt=""></span>Administration
                    </a>
                </li>
                <li>
                    <a href="#" class="{{ Request::is('profile*') ? 'active' : '' }}">
                        <span class="icon"><img src="{{ asset('images/icon-6.png') }}" alt=""></span>Profile
                    </a>
                </li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="icon"><img src="{{ asset('images/icon-7.png') }}" alt=""></span>Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
