<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>Order Food Online| Food Delivery | Restaurant Listings| </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Americas Largest Restaurant Online Ordering Food Site. Millions of unbiased food reviews."/>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon1.png') }}" type="image/png">
    <!-- Bootstrap -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset ('assets/css/typehead.css') }}" rel="stylesheet">

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

@yield('banner');
@yield('cuisine');
@yield('recent_restaurant');
@yield('content');


<!-- Footer -->
<footer>
    <div class="container">
        <p>Copyright © 2004–2015 Restaurant Listings. Restaurant Listings burst and related marks are registered trademarks of Restaurant Listings. </p>
    </div>
</footer>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="{{ asset ('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset ('assets/js/typehead.bundle.js') }}"></script>
<script>
    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

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

    var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
        'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
        'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
        'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
        'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
        'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
        'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
        'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
        'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
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
