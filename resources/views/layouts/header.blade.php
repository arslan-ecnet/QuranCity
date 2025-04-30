<header class="header-sm d-flex d-xl-none align-items-center justify-content-between">
    <button type="button" class="menu-btn"><span class="d-none">Menu</span></button>
    <div class="logo"><a href="#"><img src="images/dashboard-logo.png" alt=""></a></div>
    <a href="{{route('profile')}}" class="user"><img src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                                                     alt="User"
                                                     style="height: 45px; width: 100px; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border: 3px solid #f1f1f1;"
                                                     class="rounded-circle"></a>
    <span class="text">Quran City administration</span>
</header>
