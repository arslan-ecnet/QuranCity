<div class="logo-title d-flex d-xl-none justify-content-center align-items-center"><span><img
            src="images/dashboard-logo.png" alt=""></span><span class="text">Quran City administration</span></div>

<div class="header d-none d-xl-flex align-items-center">
    <div class="logo d-flex align-items-center"><span><img src="images/dashboard-logo.png" alt=""></span><span
            class="text">Quran City administration</span></div>
    {{--        <form action="#" method="post">--}}
    {{--            <input type="search" class="form-control" placeholder="Search">--}}
    {{--        </form>--}}
    {{--        <a href="#" class="notify"><span class="dot"></span><span class="d-none">Notification</span></a>--}}
    <div class="d-flex user align-items-center">
        {{--            <div class="flex-grow-0">--}}
        {{--                <div class="user-img"><img src="images/user.png" alt=""></div>--}}
        {{--            </div>--}}
        <div class="flex-grow-1">
            {{Auth::user()->name}}<small>Administrator</small>
        </div>
    </div>
    {{--        <a href="#" class="down-arrow"><span class="d-none">Link</span></a>--}}
</div>
