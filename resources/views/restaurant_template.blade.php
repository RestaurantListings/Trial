<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 9/14/15
 * Time: 3:26 PM
 */
?>
<!Doctype html>
<html>
<head>
    <title>Order Food Online| Food Delivery | Restaurant Listings| </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Americas Largest Restaurant Online Ordering Food Site. Millions of unbiased food reviews."/>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon1.png') }}" type="image/png">
    <title>Restaurant Listings</title>
    <link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

</head>
<body>
<header>
    <div class="container" style="width:1000px;">
        <div id="header-logo">
            <a href="/">Restaurant Listings</a>
        </div>
        <div id="secondary-nav">
            <ul>
                <li class="social-icon">
                    <ul>
                        <li style="margin-top:7px;"><a href="/" class="sign-in-btn">Sign In</a></li>
                        <li><a href="/"><span class="fb_icon"></span></a></li>
                        <li><a href="/"><span class="t_icon"></span></a></li>
                        <li><a href="/"><span class="gp_icon"></span></a></li>

                    </ul>
                </li>

            </ul>
        </div>
        <div id="main-nav">
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/">About Us</a></li>
                <li><a href="/">Invite Friends</a></li>
                <li><a href="/">Write a review</a></li>
                <li><a href="/">Events</a></li>
            </ul>
        </div>

    </div>
</header>

<div class="search-section">
    <div class="container">
        <div class="breadcrumb-container">
            <ul class="breadcrumb-item">
                <li class="breadcrub-list">
                    <a href="/"><span>Arizona</span></a>
                    <span class="seperator">></span>
                </li>
                <li class="breadcrub-list">
                    <a href="/"><span>Phoenix</span></a>
                    <span class="seperator">></span>
                </li>
                <li class="breadcrub-list">
                    <a href="/"><span>Restaurants</span></a>
                </li>
            </ul>
        </div>
        <div class="basic-search-wrapper">
            {!! Form::open(array('name'=>'home_search','class'=>'basic-search','route'=>'search','novalidate'=>'')) !!}
            <input type="text" name="keywords" placeholder="Restaurant Name or Cuisine or Keywords " />
            <input type="text" name="location" placeholder="City, State or Zip" />
            <input class="text-search-btn" type="submit" name="Submit" value="Search" />
            <input class="voice-search-btn" type="submit" name="Voice" />
            </form>
        </div>
    </div>
</div>
<!-- Restaurant Header Content Begins -->
<div class="restaurants_header">
    <div class="container" style="padding-left:0px;">
        @yield('restaurant_info_header')
    </div>
</div>
<!-- Restaurant Header Contents Ends -->

<!-- Restaurant Review & Detail Info Section Begins -->

<div class="review_detailed_info_section">
    <div class="container center_with_border white-background" style="display:flex;overflow:hidden;">
        @yield('scorecard_section')
        @yield('recent_review_section')
        <div class="rest_detailed_info_section col-md-3">
            @yield('working_hours_section')
            @yield('specialities_section')
            @yield('other_info_section')
            <!--@yield('also_viewed_restaurant_section')-->
        </div>
    </div>
</div>
<!-- Restaurant Review & Detail Info Section Ends -->

<footer>
    <div class="container" style="height:170px;">
        <div class="footer-quicklinks">
            <h4>About</h4>
            <ul>
                <li><a href="/">About Us</a></li>
                <li><a href="/">Why Us</a></li>
                <li><a href="/">Terms of Service</a></li>
                <li><a href="/">Privacy Policy</a></li>
            </ul>
        </div>
        <div class="footer-quicklinks">
            <h4>Help</h4>
            <ul>
                <li><a href="/">FAQ</a></li>
                <li><a href="/">Advertise</a></li>
                <li><a href="/">Content Guidelines</a></li>
                <li><a href="/">Business Support</a></li>
            </ul>
        </div>
        <div class="footer-quicklinks">
            <h4>More</h4>
            <ul>
                <li><a href="/">Careers</a></li>
                <li><a href="/">Newsletter Subscription</a></li>
                <li><a href="/">Contact Us</a></li>
                <li><a href="/">Investors</a></li>
            </ul>
        </div>
        <div class="footer-newsletter">
            <h4>Free Newsletter</h4>
            <form>
                <input type="email" name="newsletter" placeholder="Enter Email" />
                <input class="newsletter-btn" type="submit" value="SUBSCRIBE NEWSLETTER" />
            </form>
        </div>
    </div>
    <div class="container copyright">
        <p>Copyright &copy; 2015 Restaurant Listings. Restaurant Listings burst and related marks are registered trademarks of Restaurant Listings.</p>
        <p>By using this site, you agree to these Privacy Policy and Terms & Conditions.</p>
    </div>
</footer>

</body>
</html>