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
                    <a href="{{ route('themeList') }}" class="{{ Request::is('themes*') ? 'active' : '' }}">
                        <span class="icon"><img src="{{ asset('images/icon-1.png') }}" alt=""></span>Themes
                    </a>
                </li>
                <li>
                    <a href="{{route('surahList')}}" class="{{ Request::is('sura*') ? 'active' : '' }}">
                        <span class="icon"><img src="{{ asset('images/icon-2.png') }}" alt=""></span>Suras
                    </a>
                </li>
                <li>
                    <a href="{{route('surahDetailList')}}" class="{{ Request::is('details*') ? 'active' : '' }}">
                        <span class="icon"><img src="{{ asset('images/icon-2.png') }}" alt=""></span>Sura Details
                    </a>
                </li>
{{--                <li>--}}
{{--                    <a href="{{route('resourceList')}}" class="{{ Request::is('resource*') ? 'active' : '' }}">--}}
{{--                        <span class="icon"><img src="{{ asset('images/resource-icon.png') }}" alt=""></span>Resources--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="{{route('suburbList')}}" class="{{ Request::is('suburb*') ? 'active' : '' }}">--}}
{{--                        <span class="icon"><img src="{{ asset('images/suburb.png') }}" alt=""></span>Suburbs--}}
{{--                    </a>--}}
{{--                </li>--}}
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
