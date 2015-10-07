<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 7/14/15
 * Time: 7:09 PM
 */
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>@yield('page_title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('page_description')"/>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon1.png') }}" type="image/png">
    <!-- Bootstrap -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('assets/css/style.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body>
<header>
    <div class="container">
        <a href="{{ action('WelcomeController@index') }}" class="header-logo">
            <div class="logo"></div>
        </a>
        <div style="float:left;">
            <div class="header-locator-form">
                <!--<form action="http://restaurantlistings.com/dev/public/search" method="post">-->
                {!! Form::open(array('name'=>'home_search','route'=>'search','novalidate'=>'')) !!}
                <div id="the-basics">
                    {!! Form::text('restaurant_name', null, ['class'=>'typehead', 'placeholder'=>'Restaurant Name', 'id'=>'restaurant_name']) !!}
                    {!! Form::text('city_state', null, ['class'=>'typehead', 'placeholder'=>'City, State', 'id'=>'city_state']) !!}
                    <button type="submit">SEARCH NOW</button>
                </div>

                <div class="search-btn">

                </div>

                </form>
            </div>
            <div class="main-nav">
                <ul>
                    <li>
                        <a href="">Home</a>
                    </li>
                    <li>
                        <a href="">About Us</a>
                    </li>
                    <li>
                        <a href="">Invite Friends</a>
                    </li>
                    <li>
                        <a href="">Write a Review</a>
                    </li>
                    <li>
                        <a href="">Events</a>
                    </li>
                    <li>
                        <a href="">Sign In</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="secondary-nav">
            <ul>
                <li>
                    <a href=""><div class="header_fb_icon"></div></a>
                </li>
                <li>
                    <a href=""><div class="header_t_icon"></div></a>
                </li>
                <li>
                    <a href=""><div class="header_g_icon"></div></a>
                </li>
            </ul>
        </div>

    </div>
</header>

<!-- Restaurant Header Content Begins -->
<div class="restaurants_header">
    <div class="container" style="padding-left:0px;">
        @yield('restaurant_info_header')
    </div>
</div>
<!-- Restaurant Header Contents Ends -->


<!-- Restaurant Review & Detail Info Section Begins -->
<div class="review_detailed_info_section">
    <div class="container center_with_border white-background">
        @yield('scorecard_section')
        @yield('recent_review_section')
        <div class="rest_detailed_info_section col-md-3">
            @yield('working_hours_section')
            @yield('specialities_section')
            @yield('other_info_section')
            @yield('also_viewed_restaurant_section')
        </div>
    </div>
</div>
<!-- Restaurant Review & Detail Info Section Ends -->


<!-- Footer -->
<footer>
    <div class="container">
        <p>Copyright © 2004–2015 Restaurant Listings. Restaurant Listings burst and related marks are registered trademarks of Restaurant Listings. </p>
    </div>
</footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="{{ asset ('assets/js/bootstrap.min.js') }}"></script>

</body>
</html>
