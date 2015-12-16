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
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png">
    <title>Restaurant Listings</title>
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/css/typehead.css') }}" />
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
<script src="{{ asset('mobile_assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/filter_functions.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/typehead.bundle.js') }}"></script>
<script>
    function goToCuisine(){
        window.location = "category/"+document.getElementById('typehead-cuisine').value;
    }
</script>
<script>
    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;
            document.getElementById('suggestive-cuisine').innerHTML = "";
            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        };
    };

    var states = ['Afghan', 'African', 'Airport Lounges ', 'American (New)', 'American (Traditional)', 'Arabian', 'Argentine', 'Armenian', 'Asian Fusion', 'Australian', 'Austrian', 'Bagels', 'Bakeries', 'Bangladeshi', 'Barbeque', 'Bars', 'Basque', 'Bed & Breakfast', 'Beer', 'Beer Gardens', 'Belgian', 'Brazilian', 'Breakfast & Brunch', 'Breweries', 'Brewing Supplies', 'British', 'Bubble Tea', 'Buffets', 'Burgers', 'Burmese', 'Butcher', 'Cafes', 'Cafeteria', 'Cajun/Creole', 'Cambodian', 'Candy Stores', 'Cantonese', 'Caribbean', 'Catalan', 'Caterers', 'Champagne Bars', 'Cheese Shops', 'Cheesesteaks', 'Chicken Shop', 'Chicken Wings', 'Chinese', 'Chocolatiers & Shops', 'Cocktail Bars', 'Coffee & Tea', 'Colombian', 'Comfort Food', 'Country Clubs', 'Creperies', 'Cuban', 'Cupcakes', 'Czech', 'Delis', 'Department Stores', 'Desserts', 'Dim Sum', 'Diners', 'Discount Store', 'Distilleries', 'Dive Bars', 'Dive Shops ', 'Do-It-Yourself Food', 'Dominican', 'Donuts', 'Drugstores', 'Egyptian', 'Ethic Grocery', 'Ethnic Food', 'Falafel', 'Farmers Market', 'Fast Food', 'Festivals', 'Filipino', 'Fish & Chips', 'Fondue', 'Food', 'Food Court', 'Food Delivery Services', 'Food Stands', 'Food Tours', 'Food Trucks', 'French', 'Fruits & Veggies', 'Gastropubs', 'Gay Bars', 'Gelato', 'German', 'Gluten-Free', 'Greek', 'Grocery', 'Haitian', 'Halal', 'Hawaiian', 'Health Markets', 'Hookah Bars', 'Hot Dogs', 'Hot Pot', 'Hungarian', 'Iberian ', 'Ice Cream & Frozen Yogurt', 'Indian', 'Indonesian', 'Internal Medicine', 'Irish', 'Irish Pub', 'Italian', 'Japanese', 'Juice Bars & Smoothies', 'Korean', 'Kosher', 'Landmarks & Historical Buildings', 'Latin American', 'Lebanese', 'Live/Raw Food', 'Macarons ', 'Mags', 'Malaysian', 'Meat Shops', 'Mediterranean', 'Mexican', 'Middle Eastern', 'Modern European', 'Mongolian', 'Moroccan', 'Movers', 'Nutritionists', 'Organic Stores', 'Pakistani', 'Pasta Shops', 'Persian/Iranian', 'Personal Chefs', 'Peruvian', 'Pizza', 'Polish', 'Pool & Billiards', 'Portuguese', 'Poutineries', 'Pretzels', 'Print Media ', 'Pubs', 'Puerto Rican', 'Ramen', 'Restaurants', 'Russian', 'Salad', 'Salvadoran', 'Sandwiches', 'Sardinian ', 'Scandinavian', 'Scottish', 'Seafood', 'Seafood Markets', 'Senegalese', 'Shanghainese', 'Shaved Ice', 'Singaporean', 'Slovakian ', 'Soul Food', 'Soup', 'South African', 'Southern', 'Spanish', 'Specialty Food', 'Sports Bars', 'Sri Lankan', 'Stadiums & Arenas', 'Steakhouses', 'Street Vendors', 'Supper Clubs ', 'Sushi Bars', 'Szechuan', 'Taiwanese', 'Tapas Bars', 'Tapas/Small Plates', 'Teppanyaki', 'Tex-Mex', 'Thai', 'Thrift Stores', 'Tours', 'Trinidadian', 'Trivia Hosts', 'Turkish', 'Tuscan', 'Ukrainian', 'Uzbek', 'Vegan', 'Vegetarian', 'Venezuelan', 'Vietnamese', 'Walking Tours ', 'Wine & Spirits'
    ];

    $('#the-basics .typeahead').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'states',
            source: substringMatcher(states)
        });
</script>
<style>
    .btn-rl-default{padding:10px;}
    .twitter-typeahead .tt-hint{height: 37px !important;font-size: 14px !important;vertical-align: baseline !important;font-weight:normal !important;}
    #typehead-cuisine{height: 37px !important;font-size: 14px !important;vertical-align: baseline !important;}
    #suggestive-cuisine .category a span{font-family: lato-regular ;font-size: 14px;font-weight: normal;}
</style>
</body>
</html>