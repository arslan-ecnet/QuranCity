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
                    <a href="{{route('surahList')}}" class="{{ request()->routeIs('surahList', 'surahCreate', 'surahEdit') ? 'active' : '' }}">
                        <span class="icon"><img src="{{ asset('images/icon-2.png') }}" alt=""></span>Surahs
                    </a>
                </li>
                <li>
                    <a href="{{route('surahDetailList')}}" class="{{ request()->routeIs('surahDetailList', 'surahDetailCreate', 'surahDetailEdit') ? 'active' : '' }}">
                        <span class="icon"><img src="{{ asset('images/icon-2.png') }}" alt=""></span>Surah Details
                    </a>
                </li>
                <li>
                    <a href="{{route('verseList')}}" class="{{ request()->routeIs('verseList', 'verseCreate', 'verseEdit') ? 'active' : '' }}">
                        <span class="icon"><img src="{{ asset('images/icon-2.png') }}" alt=""></span>Verses
                    </a>
                </li>
                <li>
                    <a href="{{route('verseDetailList')}}" class="{{ request()->routeIs('verseDetailList', 'verseDetailCreate', 'verseDetailEdit') ? 'active' : '' }}">
                        <span class="icon"><img src="{{ asset('images/icon-2.png') }}" alt=""></span> Verse Details
                    </a>
                </li>
                <li>
                    <a href="{{ route('themeList') }}" class="{{ request()->routeIs('themeList', 'createTheme', 'editTheme') ? 'active' : '' }}">
                        <span class="icon"><img src="{{ asset('images/icon-1.png') }}" alt=""></span>Themes
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
