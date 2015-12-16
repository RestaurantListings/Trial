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
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png">
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
                    <!--<li><a href="{{ action('WelcomeController@index') }}">About</a></li>
                    <li><a href="{{ action('WelcomeController@index') }}">My Profile</a></li>-->
                    <li><a href="{{ url('write-a-review') }}">Write an anonymous review</a></li>
                    <!--<li><a href="{{ action('WelcomeController@index') }}">Claim a Restaurants</a></li>-->
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

                    <input type="text" name="location" placeholder="City, State or Zip" value="{{ Input::get('location') }}" />
                    <input type="text" name="keywords" placeholder="Restaurant Name or Cuisine or Keywords" value="{{ Input::get('keywords') }}" />
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


<footer>
    <div class="container">
        <div class="row">
            <div class="alignCenter">
                <p class="copyright">© 2016 Restaurant Listings. All rights reserved.<br>
                    Restaurant Listings, the Restaurant Listings.  Logo and all other Restaurant Listings. Marks contained herein are trademarks of Restaurant Listings. and/or Restaurant Listings. Affiliated companies. All other marks contained herein are the property of their respective owners.</p>
                <br>
                <p class="copyright">By using this site, you agree to these Privacy Policy and Terms & Conditions</p>
            </div>
            <div class="footer-links">
                <h6>User Terms and Privacy Policy</h6>
                <ul>
                    <li><a href="{{ action('WelcomeController@index') }}">Terms & Conditions</a></li>
                    <li><a href="{{ action('WelcomeController@index') }}">Privacy Policy</a></li>
                    <li><a href="{{ action('WelcomeController@index') }}">Cookie Policy</a></li>
                    <li><a href="{{ action('WelcomeController@index') }}">About our ads</a></li>
                </ul>
                <h6>Businesses</h6>
                <ul>
                    <li><a href="{{ action('WelcomeController@index') }}">Add Restaurant</a></li>
                    <li><a href="{{ action('WelcomeController@index') }}">Claim your listing</a></li>
                    <li><a href="{{ action('WelcomeController@index') }}">Online Ordering</a></li>
                    <li><a href="{{ action('WelcomeController@index') }}">Advertise</a></li>
                </ul>
                <h6>About</h6>
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
        </div>
    </div>
</footer>
    <script src="http://maps.google.com/maps/api/js"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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

</body>
</html>