<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 10/11/15
 * Time: 2:21 PM
 */
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <title>Order Food Online| Food Delivery | Restaurant Listings| </title>
    <meta name="description" content="Americas Largest Restaurant Online Ordering Food Site. Millions of unbiased food reviews."/>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon1.png') }}" type="image/png">
    <link type="text/css" rel="stylesheet" href="{{ asset('mobile_assets/css/bootstrap.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('mobile_assets/css/normalize.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('mobile_assets/css/styles.css') }}" />
</head>
<body>

    <nav class="navbar navbar-default navbar-static-top" id="header-nav">
        <div class="container">
            <div class="navbar-header ">
                <button type="button" class="navbar-toggle collapsed" id="responsive-nav-btn" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ action('WelcomeController@index') }}"><img src="{{ asset('mobile_assets/images/logo.png') }}" alt="Restaurant Listings" /></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ action('WelcomeController@index') }}">Home</a></li>
                    <li><a href="{{ action('WelcomeController@index') }}">About</a></li>
                    <li><a href="{{ action('WelcomeController@index') }}">My Profile</a></li>
                    <li><a href="{{ action('WelcomeController@index') }}">Write a Review</a></li>
                    <li><a href="{{ action('WelcomeController@index') }}">Claim a Restaurants</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    {!! Form::open(array('name'=>'home_search','class'=>'basic-search','route'=>'search','novalidate'=>'')) !!}

    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Search by Restaurants name or cuisines</h4>
                </div>
                <div class="modal-body">
                    <input type="text" name="keywords" placeholder="Restaurant Name or Cuisine or Keywords" value="{{ Input::get('keywords') }}" />
                    <input type="text" name="location" placeholder="City, State or Zip" value="{{ Input::get('location') }}" />
                    <input class="text-search-btn" type="submit" name="Submit" value="Search" onclick="search_type='Search'" style="vertical-align:top;" />
                    <button id="start_button" class="voice-search-btn" type="submit" name="Voice" onclick="search_type='Voice'" style="display:none;margin-left:10px;background-size:20px 32px;background-position:0 0;line-height:0px;" >
                        <img id="start_img" src="mic.gif" alt="Start" style="height:32px;">
                    </button>
                </div>
            </div>
        </div>
    </div>

<!--
    <div class="header-search">
        <a href="/">Search</a>
    </div>
    <div class="header-logo">
        <a href="/"><img src="{{ asset('mobile_assets/images/logo.png') }}" alt="Restaurant Listings" /></a>
    </div>
    <div class="header-more">
        <a href="/">More</a>
        <div>
</header>
-->
@yield('home_banner')
@yield('home_cuisine')
@yield('search_listing')
@yield('restaurant_basic_info')
</form>
<div style="width:100%;height:60px;display:block;">
    &nbsp;
</div>


<footer>
    <div class="container">
        <div class="row">
            <ul class="alignCenter"><!--
                <li>
                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#">
                        <img src="{{ asset('mobile_assets/images/icons/invite-footer.jpg') }}"  alt="" /><br/>
                        <span>Invite</span>
                    </button>
                </li>-->
                <li>
                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#searchModal">
                        <img src="{{ asset('mobile_assets/images/icons/search-footer.jpg') }}"  alt="" /><br/>
                        <span>Search</span>
                    </button>
                </li>
                <li class="search-icon">
                    <button class="btn btn-default footer-voice-btn" type="button" data-toggle="modal" data-target="#">
                        <img src="{{ asset('mobile_assets/images/icons/voice-footer.jpg') }}"  alt="" />
                    </button>
                </li><!--
                <li>
                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#">
                        <img src="{{ asset('mobile_assets/images/icons/msg-footer.jpg') }}"  alt="" /><br/>
                        <span>Message</span>
                    </button>
                </li>-->
                <li>
                    <button class="btn btn-default" type="button" data-toggle="modal" data-target="#">
                        <img src="{{ asset('mobile_assets/images/icons/more-footer.jpg') }}"  alt="" /><br/>
                        <span>More</span>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</footer>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('mobile_assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/filter_functions.js') }}"></script>
</body>
</html>