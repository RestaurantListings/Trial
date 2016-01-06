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

<div class="search-section">
    <div class="container">
        <div class="basic-search-wrapper col-md-12">
            {!! Form::open(array('name'=>'home_search','class'=>'basic-search','id'=>'basic-search','route'=>'search','novalidate'=>'')) !!}
            <div class="input-group col-md-4 floatLeft">
                <span class="input-group-addon" id="basic-location-icon"><span class="location-arrow-search"></span></span>
                <input type="text" class="form-control" aria-describedby="basic-location-icon" id="locations" name="location" placeholder="City, State or Zip" value="" />

            </div>
            <div class="input-group col-md-6 floatLeft">
                <span class="input-group-addon" id="basic-keywords-icon"><span class="glyphicon glyphicon-search"></span></span>
                <input type="text" name="keywords" class="form-control" aria-describedby="basic-keywords-icon" id="keywords" placeholder="Restaurant Name or Cuisine or Keywords" value="{{ Input::get('keywords') }}" />
            </div>
            <input class="text-search-btn" type="submit" name="Submit" value="Search" onclick="search_type='Search'" style="vertical-align:top;" />
            <button id="start_button" class="voice-search-btn" type="submit" name="Voice" onclick="search_type='Voice'" style="margin-left:10px;background-size:20px 32px;background-position:0 0;line-height:0px;" >
                <img id="start_img" src="mic.gif" alt="Start" style="height:32px;">
            </button>
            </form>
        </div>
    </div>
</div>
<div class="breadcrumb-section">
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
<script>
    function request_online_order(id){

        $.ajax({
            url: '<?php echo url("restaurants/request_online_order"); ?>',
            type: "post",
            data: {'id':id, '_token': $('input[name=_token]').val()},
            success: function(data){
               // alert('Thanks for requesting. Will let this know to the store owner.<button>Alert Me When Available</button>');
               $('#request_message').append('<p class="alert alert-success alert-dismissible"">Thanks for requesting. Will let this know to the store owner. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></p>');

            }
        });
    }

</script>
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
<style type="text/css">
    .calculator_div
    {
        font-family:verdana, arial, sans-serif;

        padding:5px;
        width:330px;
        margin:auto;
    }

    .calculator_div label
    {
        display:block;
        float:left;
        width:150px;
        margin-bottom:0px;
    }
    .calculator_div select{width:300px;}
    .label
    {
        display:inline;
        float:none;
        width:75px;
        font-size:11px;

    }
    .warning
    {
        background:yellow;
        border:1pt solid red;
        padding:5px;
        font-weight:bold;
    }

    #table{

        width:100%;

    }

    #row  {
        height:20px;
        width:100%;
    }
    .rowheader
    {
        padding:5px;
        font-size:14px;
        font-weight:bolder;
        color:white;
        text-align:center;
    }
</style>
<script language="javascript">
    function IsNumber(fldId)
    {
        var fld=document.getElementById(fldId).value;

        if(isNaN(fld))
        {
            document.getElementById(fldId).value=fld.substring(0, fld.length-1);
            var newvalue=document.getElementById(fldId).value;
            IsNumber(fldId);
        }

        return;
    }


    function FtToCm(ftfld,infld,savefld)
    {
        var ft=document.getElementById(ftfld).value;
        var inch=document.getElementById(infld).value;

        if(!isNaN(ft) && !isNaN(inch))
        {
            var allinch= ft * 12;
            allinch= parseInt(allinch) + parseInt(inch);

            var cm =allinch * 2.54;

            document.getElementById(savefld).value=Math.round(cm);
        }
        else
        {
            document.getElementById("feet").value=ft.substring(0, ft.length-1);
            document.getElementById("inch").value=inch.substring(0, inch.length-1);
        }
        //form2.field.value =lbs;
        //alert(field);
        return;
    }

    function CmToFt(cm,ftfld,infld)
    {
        if(!isNaN(cm))
        {
            var newcm=cm * 0.3937;

            var ft = newcm / 12;
            var remain= newcm % 12;
            var inchs= remain;

            document.getElementById(ftfld).value=Math.round(ft);
            document.getElementById(infld).value=Math.round(inchs);
        }
        else
        {
            document.getElementById("cm").value=cm.substring(0, cm.length-1);
        }
        //form2.field.value =lbs;
        //alert(field);
        return;
    }

    function KgToLbs(kg,field)
    {
        if(!isNaN(kg))
        {
            var lbs= kg * 2.2;
            document.getElementById(field).value=Math.round(lbs);
        }
        else
        {
            document.getElementById("kg").value=kg.substring(0, kg.length-1);
        }
        //form2.field.value =lbs;
        //alert(field);
        return;
    }

    function LbsToKg(lbs,field)
    {
        if(!isNaN(lbs))
        {
            var kg= lbs / 2.2;
            document.getElementById(field).value=Math.round(kg);
        }
        else
        {
            document.getElementById("lbs").value=lbs.substring(0, lbs.length-1);
        }
        return;
    }
    function validateForm(frm)
    {

        age=frm.age.value;
        kg=frm.kg.value;
        cm=frm.cm.value;

        if(age=="" || kg=="" || cm=="" )
        {
            alert('Error: all fields are required!');
            return false;
        }

        return;
    }

    function showHide(fldshow,fldhide,label,labelfld)
    {
        var myTextelemShow = document.getElementById(fldshow);
        var myTextelemLabel = document.getElementById(labelfld);
        var myTextelemHide = document.getElementById(fldhide);
        if(myTextelemShow.style.display == 'none')
        {
            myTextelemShow.style.display = 'inline' ;
            myTextelemLabel.innerHTML = label;
        }
        if(myTextelemHide.style.display != 'none')
        {
            myTextelemHide.style.display = 'none';
        }
    }
</script>

</body>
</html>