<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Index</title>
    <link href="style.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/apple-touch-icon-144-precomposed.png">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
</head>

<body>

<header class="header-sm d-flex d-xl-none align-items-center justify-content-between">
    <button type="button" class="menu-btn"><span class="d-none">Menu</span></button>
    <div class="logo"><a href="#"><img src="images/dashboard-logo.png" alt=""></a></div>
    <a href="#" class="user"><img src="images/user.png" alt=""></a>
    <span class="text">Quran City administration</span>
</header>

<div class="sidebar">
    <div class="sidebar-logo d-flex justify-content-center align-items-center">
        <a href="#" class="d-none d-xl-block"><img src="images/logo-icon.png" alt=""></a>
        <button type="button" class="menu-btn d-block d-xl-none"><span class="d-none">Menu</span></button>
    </div>
    <div class="sidebar-body">
        <div class="menu-item">
            <h6>Main</h6>
            <ul id="side-menu" class="menu-body">
                <li><a href="#"><span class="icon"><img src="images/icon-1.png" alt=""></span>Dashboard</a></li>
                <li><a href="#"><span class="icon"><img src="images/icon-2.png" alt=""></span>Quran</a></li>
                <li><a href="#"><span class="icon"><img src="images/icon-3.png" alt=""></span>Quran City</a>
                    <ul>
                        <li><a href="#">About Quran City</a></li>
                        <li><a href="#">Suras</a></li>
                        <li><a href="#">Summarized Sura </a></li>
                        <li><a href="#">Detailed Sura Information</a></li>
                        <li><a href="#">Media</a></li>
                        <li><a href="#">Resources</a></li>
                    </ul>
                </li>
                <li><a href="#"><span class="icon"><img src="images/icon-4.png" alt=""></span>Quran City Administration</a>
                </li>
                <li><a href="#"><span class="icon"><img src="images/icon-5.png" alt=""></span>Push Notifications</a>
                </li>
                <li><a href="#"><span class="icon"><img src="images/icon-4.png" alt=""></span>Administration</a></li>
                <li><a href="#"><span class="icon"><img src="images/icon-6.png" alt=""></span>Profile</a></li>
                <li><a href="#"><span class="icon"><img src="images/icon-7.png" alt=""></span>Logout</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="dash-body">

    <div class="logo-title d-flex d-xl-none justify-content-center align-items-center"><span><img
                src="images/dashboard-logo.png" alt=""></span><span class="text">Quran City administration</span></div>

    <div class="header d-none d-xl-flex align-items-center">
        <div class="logo d-flex align-items-center"><span><img src="images/dashboard-logo.png" alt=""></span><span
                class="text">Quran City administration</span></div>
        <form action="#" method="post">
            <input type="search" class="form-control" placeholder="Search">
        </form>
        <a href="#" class="notify"><span class="dot"></span><span class="d-none">Notification</span></a>
        <div class="d-flex user align-items-center">
            <div class="flex-grow-0">
                <div class="user-img"><img src="images/user.png" alt=""></div>
            </div>
            <div class="flex-grow-1">
                Your Name<small>Administrator</small>
            </div>
        </div>
        <a href="#" class="down-arrow"><span class="d-none">Link</span></a>
    </div>
    <div class="dash-content">

        <div class="date-field  d-none d-xl-flex align-items-center mb-4 mb-md-5">
            <span>Show:</span>
            <input type="text" id="datepicker" placeholder="Today, 29 September 2023">
        </div>

        <div class="content-wrap">
            <div class="row top-content">
                <div class="col-lg-7">
                    <div class="box-content box-shadow p-4 p-md-5">
                        <div class="title mb-4"><h5>Users Registered</h5></div>
                        <div class="full-img"><img src="images/chart.jpg" alt=""></div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="box-content box-shadow box-bg p-4 p-md-5">
                        <div class="title mb-4 d-flex align-items-center"><h5 class="d-flex align-items-center">Goals
                                <span>-16%</span></h5>
                            <button type="button"><span class="d-none">Button</span></button>
                        </div>
                        <div class="text-center"><img src="images/chart-2.png" alt=""></div>
                    </div>

                    <div class="box-content mt-4 box-shadow p-4 p-md-5">
                        <div class="tr d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5>Total Revenue</h5>
                                <h4>$ 650.92</h4>
                            </div>
                            <div class="flex-grow-0">
                                <div class="graphic"><img src="images/graphic.png" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="bottom-content d-flex d-lg-none">

            <div class="box-content p-4 p-md-5 coleql_height">
                <div class="title d-flex align-items-center mb-3"><h5>Top Activities</h5><a href="#">See all</a></div>
                <ul class="top-activity">
                    <li><strong>1. Disability specific?</strong><span>350</span></li>
                    <li><strong>2. CALD specific</strong><span>298</span></li>
                    <li><strong>3. Gentle Exercise</strong><span>237</span></li>
                </ul>
            </div>

            <div class="box-content p-4 p-md-5 coleql_height">
                <div class="title d-flex align-items-center mb-3"><h5>Top Program Centers</h5><a href="#">See all</a>
                </div>
                <ul class="top-programs">
                    <li><strong>1. Andy Robertson</strong><span>25</span><small>Programs</small></li>
                    <li><strong>2. Julie Estell</strong><span>21</span><small>Programs</small></li>
                    <li><strong>3. Rony Suhendra</strong><span>16</span><small>Programs</small></li>
                </ul>
            </div>

            <div class="box-content text-center program p-4 p-md-5 coleql_height">
                <div class="title d-flex align-items-center justify-content-center mb-3"><h5>Total Visitors</h5></div>
                <h2>9523</h2>
                <a href="#" class="d-flex justify-content-center align-items-center">per day<i
                        class="fa-solid fa-angle-down ms-2"></i></a>
            </div>

        </div>

        <div class="bottom-content d-none d-lg-block">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6 mt-4">
                            <div class="box-content p-4 p-md-5 coleql_height">
                                <div class="title d-flex align-items-center mb-3"><h5>Top Activities</h5><a href="#">See
                                        all</a></div>
                                <ul class="top-activity">
                                    <li><strong>1. Disability specific?</strong><span>350</span></li>
                                    <li><strong>2. CALD specific</strong><span>298</span></li>
                                    <li><strong>3. Gentle Exercise</strong><span>237</span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-6 mt-4">
                            <div class="box-content p-4 p-md-5 coleql_height">
                                <div class="title d-flex align-items-center mb-3"><h5>Top Program Centers</h5><a
                                        href="#">See all</a></div>
                                <ul class="top-programs">
                                    <li><strong>1. Andy Robertson</strong><span>25</span><small>Programs</small></li>
                                    <li><strong>2. Julie Estell</strong><span>21</span><small>Programs</small></li>
                                    <li><strong>3. Rony Suhendra</strong><span>16</span><small>Programs</small></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 mt-4 ">
                    <div class="box-content text-center program p-4 p-md-5 coleql_height">
                        <div class="title d-flex align-items-center justify-content-center mb-3"><h5>Total Visitors</h5>
                        </div>
                        <h2>9523</h2>
                        <a href="#" class="d-flex justify-content-center align-items-center">per day<i
                                class="fa-solid fa-angle-down ms-2"></i></a>
                    </div>
                </div>


            </div>
        </div>


    </div>

    <footer class="footer">
        <ul>
            <li>Copyright © 2023 QFatima. All rights reserved.</li>
            <li>Developed by <img src="images/footer-icon.png" alt=""></li>
        </ul>
    </footer>

</div>


<!-- Bootstrap core JavaScript================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.matchHeight-min.js"></script>
<script src="js/custom.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    $(function () {
        $("#datepicker").datepicker();
    });
</script>
</body>
</html>
