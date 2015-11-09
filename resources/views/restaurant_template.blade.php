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
    @foreach($data['restaurant'] as $r)
    <title>{{ $r->name.' | '.$r->city->city.', '.$r->zip }} Restaurant Listings</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <meta name="description" content="{{ $r->name }} in {{ $r->city->city }}, {{ $r->zip }} {{ $r->categories }} Online Order, Get Menu, Reviews, Contact, Location Maps, Directions"/>
    @endforeach
    <!-- jQuery (necessary for Bootstraps JavaScript plugins)-->
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
                        <!--<li style="margin-top:7px;"><a href="/" class="sign-in-btn">Sign In</a></li>-->
                        <li><a href="{{ action('WelcomeController@index') }}"><span class="fb_icon"></span></a></li>
                        <li><a href="{{ action('WelcomeController@index') }}"><span class="t_icon"></span></a></li>
                        <li><a href="{{ action('WelcomeController@index') }}"><span class="gp_icon"></span></a></li>

                    </ul>
                </li>

            </ul>
        </div>
        <div id="main-nav">
            <ul>
                <li><a href="{{ action('WelcomeController@index') }}">Home</a></li>
                <li><a href="{{ action('WelcomeController@index') }}">About Us</a></li>
                <!--<li><a href="/">Invite Friends</a></li>-->
                <li><a href="{{ action('WelcomeController@index') }}">Write an anonymous review</a></li>
                <!--<li><a href="/">Events</a></li>-->
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
    <div class="container center_with_border white-background" style="display:flex;overflow:hidden;padding-left:0px;">
        @yield('scorecard_section')
        @yield('recent_review_section')
        <div class="rest_detailed_info_section col-md-4">
            @yield('working_hours_section')
            @yield('specialities_section')
            <!--@yield('other_info_section')
            @yield('also_viewed_restaurant_section')-->
        </div>
    </div>
</div>
<!-- Restaurant Review & Detail Info Section Ends -->

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
            </form>
            -->
        </div>
    </div>
    <div class="container copyright">
        <p>Copyright &copy; 2015 Restaurant Listings. Restaurant Listings burst and related marks are registered trademarks of Restaurant Listings.</p>
        <p>By using this site, you agree to these Privacy Policy and Terms & Conditions.</p>
    </div>
</footer>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('mobile_assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/typehead.bundle.js') }}"></script>
<script>
    var bestPictures = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '../data/films/post_1960.json',
        remote: {
            url: '../data/films/queries/%QUERY.json',
            wildcard: '%QUERY'
        }
    });

    $('#remote .typeahead').typeahead(null, {
        name: 'best-pictures',
        display: 'value',
        source: bestPictures
    });
    function request_online_order(id){

        $.ajax({
            url: '<?php echo url("restaurants/request_online_order"); ?>',
            type: "post",
            data: {'id':id, '_token': $('input[name=_token]').val()},
            success: function(data){
               // alert('Thanks for requesting. Will let this know to the store owner.<button>Alert Me When Available</button>');
               $('.restaurant_quicklinks').append('<p class="alert alert-success alert-dismissible"">Thanks for requesting. Will let this know to the store owner. <a href="#" class="alert-link" data-toggle="modal" data-target="#onlineOrderRequestModal">Alert Me When Available</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></p>');

            }
        });
    }

</script>

</body>
</html>