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
    <link href="{{ asset ('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset ('assets/css/typehead.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a:link {
            color:#000;
            text-decoration: none;
        }
        a:visited {
            color:#000;
        }
        a:hover {
            color:#33F;
        }
        .button {
            background: -webkit-linear-gradient(top,#008dfd 0,#0370ea 100%);
            border: 1px solid #076bd2;
            border-radius: 3px;
            color: #fff;
            display: none;
            font-size: 13px;
            font-weight: bold;
            line-height: 1.3;
            padding: 8px 25px;
            text-align: center;
            text-shadow: 1px 1px 1px #076bd2;
            letter-spacing: normal;
        }
        .center {
            padding: 10px;
            text-align: center;
        }
        .final {
            color: black;
            padding-right: 3px;
        }
        .interim {
            color: gray;
        }
        .info {
            font-size: 14px;
            text-align: center;
            color: #777;
            display: none;
        }
        .right {
            float: right;
        }
        .sidebyside {
            display: inline-block;
            width: 45%;
            min-height: 40px;
            text-align: left;
            vertical-align: top;
        }
        #headline {
            font-size: 40px;
            font-weight: 300;
        }
        #info {
            font-size: 20px;
            text-align: center;
            color: #777;
            visibility: hidden;
        }
        #results {
            font-size: 14px;
            font-weight: bold;
            border: 1px solid #ddd;
            padding: 5px 15px;
            text-align: left;
            min-height: 40px;
            background-color:#ffffff;
        }
        #start_button {
            border: 0;
            background-color:transparent;
            padding: 0;
        }
    </style>

</head>
<body>
<header>
    <div class="container">
        <a href="{{ action('WelcomeController@index') }}" class="header-logo">
            <div class="logo"></div>
        </a>
        <div style="float:left;">
            @if(Request::url() == action('WelcomeController@index'))

            @else
            <div class="header-locator-form">
                <!--<form action="http://restaurantlistings.com/dev/public/search" method="post">-->
                {!! Form::open(array('name'=>'home_search','route'=>'search','novalidate'=>'')) !!}
                <div id="the-basics">
                    {!! Form::text('restaurant_name', null, ['class'=>'typehead', 'placeholder'=>'Restaurant Name', 'id'=>'restaurant_name']) !!}
                    {!! Form::text('city_state', null, ['class'=>'typehead', 'placeholder'=>'City, State', 'id'=>'city_state']) !!}
                    <button type="submit">SEARCH NOW</button>
                    <button type="submit" class="voice-btn"></button>
                </div>

                <div class="search-btn">
                </div>


                </form>
            </div>
            @endif
            @if(Request::url() == action('WelcomeController@index'))
            <div class="main-nav" style="top:50px;">
            @else
            <div class="main-nav">
            @endif
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
        <p>Copyright © 2015 Restaurant Listings. Restaurant Listings burst and related marks are registered trademarks of Restaurant Listings. </p>
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

@yield('voice_script');


</body>
</html>
