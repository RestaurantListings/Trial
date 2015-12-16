<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 9/14/15
 * Time: 3:26 PM
 */
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();

?>
<!Doctype html>
<html>
<head>
    <title>Order Food Online| Food Delivery | Restaurant Listings| </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Americas Largest Restaurant Online Ordering Food Site. Millions of unbiased food reviews."/>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins)-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png">
    <title>Restaurant Listings</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}" media="all">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />


</head>
<body>
<header>
    <div class="container" style="width:1000px;">
        <div id="header-logo">
            <a href="{{ action('WelcomeController@index') }}">Restaurant Listings</a>
        </div>
        <div id="secondary-nav">
            <ul>
                <li class="social-icon">
                    <ul>
                        <!--<li style="margin-top:7px;"><a href="/" class="sign-in-btn">Sign In</a></li>-->
                        <li><a href="/"><span class="fb_icon"></span></a></li>
                        <li><a href="/"><span class="t_icon"></span></a></li>
                        <li><a href="/"><span class="gp_icon"></span></a></li>

                    </ul>
                </li>

            </ul>
        </div>
        <div id="main-nav">
            <ul>
                <li><a href="{{ action('WelcomeController@index') }}">Home</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">About Us</a></li>
                <!--<li><a href="{{ action('WelcomeController@index') }}">Invite Friends</a></li>-->
                <li><a href="{{ url('write-a-review') }}">Write An Anonymous Review</a></li>
                <!--<li><a href="{{ action('WelcomeController@index') }}">Events</a></li>-->
            </ul>
        </div>

    </div>
</header>
@yield('banner')
@yield('cuisine')
@yield('recent_restaurant')
@yield('content')

<footer>
    <div class="container" style="height:230px;">
        <div class="footer-quicklinks">
            <h4>User Terms and Privacy Policy</h4>
            <ul>
                <li><a href="{{ action('WelcomeController@index') }}">Terms & Conditions</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Privacy Policy</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Cookie Policy</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">About our ads</a></li>
            </ul>
        </div>
        <div class="footer-quicklinks">
            <h4>Businesses</h4>
            <ul>
                <li><a href="{{ action('WelcomeController@index') }}">Add Restaurant</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Claim your listing</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Online Ordering</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Advertise</a></li>
            </ul>
        </div>
        <div class="footer-quicklinks">
            <h4>About</h4>
            <ul>
                <li><a href="{{ action('WelcomeController@index') }}">About Restaurant Listings</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Why Us</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Careers</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Press</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Contact Us</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Investors</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Feedback</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Sitemap</a></li>
            </ul>
        </div>
        <div class="footer-newsletter">
            <!--
            <h4>Free Newsletter</h4>
            <form>
                <input type="email" name="newsletter" placeholder="Enter Email" />
                <input class="newsletter-btn" type="submit" value="SUBSCRIBE NEWSLETTER" />
            </form>
            -->
        </div>
    </div>
    <div class="container copyright">
        <p>© 2016Restaurant Listings. All rights reserved.<br>
        Restaurant Listings, the Restaurant Listings.  Logo and all other Restaurant Listings. Marks contained herein are trademarks of Restaurant Listings. and/or Restaurant Listings. Affiliated companies.All other marks contained herein are the property of their respective owners.</p>
        <br>
        <p>By using this site, you agree to these Privacy Policy and Terms & Conditions.</p>
    </div>
</footer>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="http://maps.google.com/maps/api/js"></script>
<script src="{{ asset('mobile_assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/filter_functions.js') }}"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">




</body>
</html>