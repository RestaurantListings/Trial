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
                <li><a href="{{ url('write-a-review') }}">Write An Anonymous Review</a></li>
                <!--<li><a href="/">Events</a></li>-->
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
<script src="http://maps.google.com/maps/api/js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
    function calculateRoute(from, to) {
        // Center initialized to Naples, Italy
        var myOptions = {
            zoom: 10,
            center: new google.maps.LatLng(33.43, -112.07),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        // Draw the map
        var mapObject = new google.maps.Map(document.getElementById("map"), myOptions);

        var directionsService = new google.maps.DirectionsService();
        var directionsRequest = {
            origin: to,
            destination: from,
            travelMode: google.maps.DirectionsTravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC
        };
        directionsService.route(
            directionsRequest,
            function(response, status)
            {
                document.getElementById('route').innerHTML = "";
                document.getElementById('error').innerHTML = "";
                if (status == google.maps.DirectionsStatus.OK)
                {
                    new google.maps.DirectionsRenderer({
                        map: mapObject,
                        directions: response
                    });
                    //console.log(response['routes'][0]['legs'][0]['steps'][1]);

                    for(var i in response['routes'][0]['legs'][0]['steps']){
                        console.log(response['routes'][0]['legs'][0]['steps'][i]['maneuver']);
                        $("#route").append('<span class="maneuver maneuver-'+response['routes'][0]['legs'][0]['steps'][i]['maneuver']+'"></span>'+response['routes'][0]['legs'][0]['steps'][i]['instructions']+'<br><hr/>');
                    }
                }
                else
                    $("#error").append("Unable to retrieve your route<br />");
            }
        );
    }

    $(document).ready(function() {
        // If the browser supports the Geolocation API
        if (typeof navigator.geolocation == "undefined") {
            $("#error").text("Your browser doesn't support the Geolocation API");
            return;
        }
        calculateRoute($("#from").val(), $("#to").val());

        $("#from-link, #to-link").click(function(event) {
            event.preventDefault();
            var addressId = this.id.substring(0, this.id.indexOf("-"));

            navigator.geolocation.getCurrentPosition(function(position) {
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({
                            "location": new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
                        },
                        function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK)
                                $("#" + addressId).val(results[0].formatted_address);
                            else
                                $("#error").append("Unable to retrieve your address<br />");
                        });
                },
                function(positionError){
                    $("#error").append("Error: " + positionError.message + "<br />");
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10 * 1000 // 10 seconds
                });
        });

        $("#calculate-route").submit(function(event) {
            event.preventDefault();
            calculateRoute($("#from").val(), $("#to").val());
        });
    });
</script>
<style type="text/css">
    #calculate-route{
        height:65px;
    }
    #map {
        width: 100%;
        height: 600px;
        margin-top: 10px;
        display:block;
    }
</style>
<script>

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
<script>
    var search_type;
    var create_email = false;
    var final_transcript = '';
    var recognizing = false;
    var ignore_onend;
    var start_timestamp;
    if (!('webkitSpeechRecognition' in window)) {
        upgrade();
    } else {
        start_button.style.display = 'inline-block';
        var recognition = new webkitSpeechRecognition();
        recognition.continuous = false;
        recognition.interimResults = true;
        recognition.onstart = function() {
            recognizing = true;
            //showInfo('info_speak_now');
            start_img.src = 'mic-animate.gif';
        };
        recognition.onerror = function(event) {
            if (event.error == 'no-speech') {
                start_img.src = 'mic.gif';
                //showInfo('info_no_speech');
                ignore_onend = true;
            }
            if (event.error == 'audio-capture') {
                start_img.src = 'mic.gif';
                //showInfo('info_no_microphone');
                ignore_onend = true;
            }
            if (event.error == 'not-allowed') {
                if (event.timeStamp - start_timestamp < 100) {
                    //showInfo('info_blocked');
                } else {
                    //showInfo('info_denied');
                }
                ignore_onend = true;
            }
        };
        recognition.onend = function() {
            recognizing = false;
            if (ignore_onend) {
                return;
            }
            start_img.src = 'mic.gif';
            if (!final_transcript) {
                //showInfo('info_start');
                return;
            }
            //showInfo('');
            if (window.getSelection) {
                window.getSelection().removeAllRanges();
                var range = document.createRange();
                range.selectNode(document.getElementById('final_span'));
                window.getSelection().addRange(range);
            }
            if (create_email) {
                create_email = false;
                createEmail();
            }
            alert(final_transcript);
        };
        recognition.onresult = function(event) {
            if (event.results.length > 0) {
                document.getElementById('keywords').value = event.results[0][0].transcript;

                keywords.form.submit();
            }


        };
    }
    function upgrade() {
        start_button.style.visibility = 'hidden';
        start_button.style.display = 'none';
        //showInfo('info_upgrade');
    }
    var two_line = /\n\n/g;
    var one_line = /\n/g;
    function linebreak(s) {
        return s.replace(two_line, '<p></p>').replace(one_line, '<br>');
    }
    var first_char = /\S/;
    function capitalize(s) {
        return s.replace(first_char, function(m) { return m.toUpperCase(); });
    }
    function createEmail() {
        var n = final_transcript.indexOf('\n');
        if (n < 0 || n >= 80) {
            n = 40 + final_transcript.substring(40).indexOf(' ');
        }
        var subject = encodeURI(final_transcript.substring(0, n));
        var body = encodeURI(final_transcript.substring(n + 1));
        window.location.href = 'mailto:?subject=' + subject + '&body=' + body;
    }
    function copyButton() {
        if (recognizing) {
            recognizing = false;
            recognition.stop();
        }
        //copy_button.style.display = 'none';
        //copy_info.style.display = 'inline-block';
        //showInfo('');
    }
    function emailButton() {
        if (recognizing) {
            create_email = true;
            recognizing = false;
            recognition.stop();
        } else {
            createEmail();
        }
        email_button.style.display = 'none';
        email_info.style.display = 'inline-block';
        //showInfo('');
    }
    function startButton(event) {
        if(search_type == 'Search'){
            return true;
        }
        if (recognizing) {
            recognition.stop();
            return;
        }
        final_transcript = ''
        var select_dialect = 'en-US';
        recognition.lang = select_dialect;
        recognition.start();
        ignore_onend = false;
        //final_span.innerHTML = '';
        //interim_span.innerHTML = '';
        //start_img.src = 'mic-slash.gif';
        ///showInfo('info_allow');
        showButtons('none');
        start_timestamp = event.timeStamp;
        return false;

    }
    function showInfo(s) {
        if (s) {
            for (var child = info.firstChild; child; child = child.nextSibling) {
                if (child.style) {
                    child.style.display = child.id == s ? 'inline' : 'none';
                }
            }
            info.style.visibility = 'visible';
        } else {
            info.style.visibility = 'hidden';
        }
    }
    var current_style;
    function showButtons(style) {
        if (style == current_style) {
            return;
        }
        current_style = style;
    }
    function filter_option(val){

        if($('input[name="'+val+'"]').prop("checked") == true){
            $('input[name="'+val+'"]').prop("checked", false);
        }else{
            $('input[name="'+val+'"]').prop("checked", true);
        }
        document.forms["home_search"].submit();
    }

</script>
</body>
</html>