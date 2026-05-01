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
                        <span class="icon"><i class="bi bi-book fs-5"></i></span>Surahs
                    </a>
                </li>
                <li>
                    <a href="{{route('surahDetailList')}}" class="{{ request()->routeIs('surahDetailList', 'surahDetailCreate', 'surahDetailEdit') ? 'active' : '' }}">
                        <span class="icon"><i class="bi bi-journal-text fs-5"></i></span>Surah Details
                    </a>
                </li>
                <li>
                    <a href="{{route('verseList')}}" class="{{ request()->routeIs('verseList', 'verseCreate', 'verseEdit') ? 'active' : '' }}">
                        <span class="icon"><i class="bi bi-list-ol fs-5"></i></span>Verses
                    </a>
                </li>
                <li>
                    <a href="{{route('verseDetailList')}}" class="{{ request()->routeIs('verseDetailList', 'verseDetailCreate', 'verseDetailEdit') ? 'active' : '' }}">
                        <span class="icon"><i class="bi bi-card-text fs-5"></i></span> Verse Details
                    </a>
                </li>
                <li>
                    <a href="{{ route('themeList') }}" class="{{ request()->routeIs('themeList', 'createTheme', 'editTheme') ? 'active' : '' }}">
                        <span class="icon"><i class="bi bi-palette fs-5"></i></span>Themes
                    </a>
                </li>
                <li>
                    <a href="{{route('reciterList')}}" class="{{ request()->routeIs('reciterList', 'reciterCreate', 'reciterEdit') ? 'active' : '' }}">
                        <span class="icon"><i class="bi bi-mic fs-5"></i></span>Reciters
                    </a>
                </li>
                <li>
                    <a href="{{route('translationList')}}" class="{{ request()->routeIs('translationList', 'translationCreate', 'translationEdit') ? 'active' : '' }}">
                        <span class="icon"><i class="bi bi-translate fs-5"></i></span>Translations
                    </a>
                </li>
                <li>
                    <a href="{{route('audioFileList')}}" class="{{ request()->routeIs('audioFileList', 'audioFileCreate', 'audioFileEdit') ? 'active' : '' }}">
                        <span class="icon"><i class="bi bi-file-earmark-music fs-5"></i></span>Audio Files
                    </a>
                </li>
                <li>
                    <a href="{{route('verseTranslationList')}}" class="{{ request()->routeIs('verseTranslationList', 'verseTranslationCreate', 'verseTranslationEdit') ? 'active' : '' }}">
                        <span class="icon"><i class="bi bi-blockquote-left fs-5"></i></span>Verse Translations
                    </a>
                </li>
                <li>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="icon"><i class="bi bi-box-arrow-right fs-5"></i></span>Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
