@extends('layouts.app')
@section('title')
    <title>Quran City</title>
@endsection
@section('content')
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
@endsection
