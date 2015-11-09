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
    <title>{{ $meta_title }} </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $meta_description }}"/>
    <meta name="keyword" content="{{ $meta_keywords }}"/>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins)-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon1.png') }}" type="image/png">
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
<!--                        <li style="margin-top:7px;"><a href="/" class="sign-in-btn">Sign In</a></li>-->
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
                <li><a href="{{ action('WelcomeController@index') }}">Write an anonymous review</a></li>
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
    <div class="container" style="height:170px;">
        <div class="footer-quicklinks">
            <h4>About</h4>
            <ul>
                <li><a href="{{ action('WelcomeController@index') }}">About Us</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Why Us</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Terms of Service</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Privacy Policy</a></li>
            </ul>
        </div>
        <div class="footer-quicklinks">
            <h4>Help</h4>
            <ul>
                <li><a href="{{ action('WelcomeController@index') }}">FAQ</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Advertise</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Content Guidelines</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Business Support</a></li>
            </ul>
        </div>
        <div class="footer-quicklinks">
            <h4>More</h4>
            <ul>
                <li><a href="{{ action('WelcomeController@index') }}">Careers</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Newsletter Subscription</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Contact Us</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">Investors</a></li>
            </ul>
        </div>
        <div class="footer-newsletter">
            <!--
            <h4>Free Newsletter</h4>
            <form>
                <input type="email" name="newsletter" placeholder="Enter Email" />
                <input class="newsletter-btn" type="submit" value="SUBSCRIBE NEWSLETTER" />
            </form>-->
        </div>
    </div>
    <div class="container copyright">
        <p>Copyright &copy; 2015 Restaurant Listings. Restaurant Listings burst and related marks are registered trademarks of Restaurant Listings.</p>
        <p>By using this site, you agree to these Privacy Policy and Terms & Conditions.</p>
    </div>
</footer>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('mobile_assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/filter_functions.js') }}"></script>


</body>
</html>