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
<script>
    //Do-you-have modal on page load function
    $(window).load(function(){
        $('#doYouHaveModal').modal('show');
    });

    $(document).ready(function(){
        $('.all_store_hours').hide();
        $('#all_store_hours').on('click', function() {
            $(this).parent().parent().parent().next().slideToggle(900);
            $(this).children('div.viewBtnImg').toggleClass("changePosition");
        });
        $('.do-you-have-login-btn').click(function(){
            $.ajax({
                url: '<?php echo url("account/doyouhaveregister"); ?>',
                type: "post",
                data: $("#do-you-have-form").serialize(),
                success: function(data){
                    $('#doYouHaveModal').modal('hide');
                }
            });
        });
        $('.cholesterol-suggestions-btn').click(function(){
            var totalCholesterol = document.getElementById('total-cholesterol').value;
            var hdlCholesterol = document.getElementById('total-cholesterol').value;
            var systolicBloodPressure = document.getElementById('systolic-blood-pressure').value;
            var diastolicBloodPressure = document.getElementById('diastolic-blood-pressure').value;
            var errorVal;
            var error_message;
            if(totalCholesterol < 130 && totalCholesterol > 320){
                errorVal = 1;
                error_message = "Total Cholesterol value must between 130 and 320";
            }else{
                if(hdlCholesterol < 20 && hdlCholesterol > 100){
                    errorVal = 1;
                    error_message = "HDL Cholesterol value must between 20 and 100";

                }else{
                    if(systolicBloodPressure < 90 && systolicBloodPressure > 200){
                        errorVal = 1;
                        error_message = "Systolic Blood Pressure value must between 90 and 200";
                    }else{
                        if(diastolicBloodPressure < 30 && diastolicBloodPressure > 140){
                            errorVal = 1;
                            error_message = "Diastolic Blood Pressure value must between 30 and 140";
                        }else{
                            errorVal = 0;
                        }
                    }
                }
            }
            if(errorVal == 0){

                $.ajax({
                    url: '<?php echo url("suggestions/cholesterol_meals"); ?>',
                    type: "post",
                    data: $("#cholesterol_suggestions_form").serialize(),
                    success: function(data){
                        $('#cholesterolModal').modal('hide');
                        $('.healthy-menu-wrapper').hide();

                        $("#updated_menu").html(data);

                    }
                });
            }else{
                alert(error_message);
            }
        });
        $('.highbp-suggestions-btn').click(function(){
            $.ajax({
                url: '<?php echo url("suggestions/highbp_meals"); ?>',
                type: "post",
                data: $("#highbp_suggestions_form").serialize(),
                success: function(data){
                    $('#highBPModal').modal('hide');
                    $('.healthy-menu-wrapper').hide();

                    $("#updated_menu").html(data);

                }
            });
        });
        $('.diabetic-suggestions-btn').click(function(){
            $.ajax({
                url: '<?php echo url("suggestions/diabetic_meals"); ?>',
                type: "post",
                data: $("#diabetic_suggestions_form").serialize(),
                success: function(data){
                    $('#diabeticModal').modal('hide');
                    $('.healthy-menu-wrapper').hide();

                    $("#updated_menu").html(data);

                }
            });
        });
        $('.weight-loss-suggestions-btn').click(function(){
            $.ajax({
                url: '<?php echo url("suggestions/weight_loss_meals"); ?>',
                type: "post",
                data: $("#weight_loss_suggestions_form").serialize(),
                success: function(data){
                    $('#weightLossModal').modal('hide');
                    $('.healthy-menu-wrapper').hide();

                    $("#updated_menu").html(data);

                }
            });
        });
    });
    function show_hours(){
        $('.all_store_hours').show();
    }
</script>

</body>
</html>