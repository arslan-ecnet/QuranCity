<div class="header d-none d-xl-flex align-items-center justify-content-between px-4" style="background-color: #561E08; padding: 10px 0;">
    <!-- Left: Logo and Title -->
    <div class="d-flex align-items-center">
        <span><img src="images/dashboard-logo.png" alt="Logo" style="height: 40px;"></span>
        <span class="text ms-2 text-white fw-bold">QURAN CITY ADMINISTRATION</span>
    </div>

    <!-- Right: User Info -->
    <div class="d-flex align-items-center">
        <a href="{{ route('profile') }}" class="d-flex align-items-center text-decoration-none">
            <div class="user-img me-2">
                <img src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                     alt="User"
                     style="height: 45px; width: 100px; object-fit: cover; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border: 3px solid #f1f1f1;"
                     class="rounded-circle">
            </div>
            <div class="text-white">
                {{ Auth::user()->name }}<br>
                <small class="">Administrator</small>
            </div>
        </a>

    </div>
</div>
