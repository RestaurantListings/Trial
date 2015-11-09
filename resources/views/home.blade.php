@extends('app')

@section('banner')
<div class="fullscreen-bg" id="home-banner">
    <div class="pattern"></div>
    <video loop muted autoplay poster="img/videoframe.jpg" class="fullscreen-bg__video">
        <source src="assets/videos/hero-video.mp4" type="video/mp4">
    </video>
    <div class="container align-center banner-content">
        <h1>If there is food, we will find it!</h1>
        <h2>Find Your Favourite Restaurants and Favourite dishes</h2>
        {!! Form::open(array('name'=>'home_search','class'=>'banner-search','id'=>'banner-search','route'=>'search','method'=>'get','novalidate'=>'', 'onSubmit'=>'return startButton(event);')) !!}
            <div class="input-group col-md-3 floatLeft">
                <span class="input-group-addon" id="basic-location-icon"><span class="glyphicon glyphicon-globe"></span></span>
                <input type="text" class="form-control" aria-describedby="basic-location-icon" id="locations" name="location" placeholder="City, State or Zip" value="{{ $location['city'].', '.$location['state'] }}" />

            </div>
            <div class="input-group col-md-7 floatLeft">
                <span class="input-group-addon" id="basic-keywords-icon"><span class="glyphicon glyphicon-search"></span></span>
                <input type="text" name="keywords" class="form-control" aria-describedby="basic-keywords-icon" id="keywords" placeholder="Restaurant Name or Cuisine or Keywords " />
            </div>
            <input class="text-search-btn" type="submit" name="Submit" value="Search" onclick="search_type='Search'" />
            <!--<input class="voice-search-btn" id="start_img" type="submit" name="Voice" style="display:none;" />-->
            <button id="start_button" class="voice-search-btn" type="submit" name="Voice" onclick="search_type='Voice'" >
                <img id="start_img" src="mic.gif" alt="Start">
            </button>
        </form>
        <div id="info" style="visibility: hidden;">
            <p id="info_start" style="display: inline;"></p>
            <p id="info_speak_now" style="display: none;">Speak now.</p>
            <p id="info_no_speech" style="display: none;">No speech was detected. You may need to adjust your
                <a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
                    microphone settings</a>.</p>
            <p id="info_no_microphone" style="display:none">
                No microphone was found. Ensure that a microphone is installed and that
                <a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
                    microphone settings</a> are configured correctly.</p>
            <p id="info_allow" style="display: none;">Click the "Allow" button above to enable your microphone.</p>
            <p id="info_denied" style="display: none;">Permission to use microphone was denied.</p>
            <p id="info_blocked" style="display: none;">Permission to use microphone is blocked. To change,
                go to chrome://settings/contentExceptions#media-stream</p>
            <p id="info_upgrade" style="display: none;">Voice Search is not supported by this browser.
                Upgrade to <a href="//www.google.com/chrome">Chrome</a>
                version 25 or later.</p>
        </div>
        <div id="results">
            <span id="final_span" class="final"></span>
            <span id="interim_span" class="interim"></span>
            <p>
        </div>
    </div>
</div>
@endsection

@section('cuisine')
<div id="cuisine-section">
    <div class="container align-center">
        <h1>Choose From Your Favourite Cuisine</h1>
        <div id="cuisine-list">
            <ul>
                <li>
                    <a href="{{ url('category/pizza') }}">
                        <span class="cuisine-logo pizza"></span>
                        <span class="cuisine-name">Pizza</span>
                    </a>
                </li>
                <li>
                    <a href="{{  url('category/Sushi') }}">
                        <span class="cuisine-logo sushi"></span>
                        <span class="cuisine-name">Sushi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('category/indian') }}">
                        <span class="cuisine-logo indian"></span>
                        <span class="cuisine-name">Indian</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('category/thai') }}">
                        <span class="cuisine-logo thai"></span>
                        <span class="cuisine-name">Thai</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('category/chinese') }}">
                        <span class="cuisine-logo chinese"></span>
                        <span class="cuisine-name">Chinese</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
@section('recent_restaurant')
<div id="recent-restaurant-section">
    <div class="container align-center">
        <h1>Restaurant Listed Recently</h1>
        <div id="recent-restaurant-list">
            <ul>
                @foreach($recent_restaurants as $r)
                <li class="list-item">

                    <div class="item-banner">
                        <img src="assets/images/restaurants/rest_1.png" alt="" />
                    </div>
                    <div class="item-details">
                        <p><span class="item-title">{{ $r->name }}</span></p>
                        <p><span class="item-cuisine-type">{{ $r->categories }}</span></p>
                        <p><span class="item-rating"><img src="assets/images/rating.png" alt="2 star" /></span></p>
                        <p style="margin-bottom:15px;"><span class="item-review-count">{{ count($r->restaurant_reviews) }} Reviews</span></p>
                        <p class="align-left"><span class="address-icon"></span><span class="item-address">{{ $r->address_1.' '.$r->address_2}} <br/>{{$r->city->city.' '.$r->state->short.' '.$r->zip }}</span></p>
                        <p class="align-left"><span class="phone-icon"></span><span class="item-phone">{{ $r->phone }}</span></p>
                    </div>
                    <div class="list-quicklinks">
                        <ul>
                            <li class="list-visit-btn"><a href="{{ url($r->permalink) }}">Visit</a></li>
                            <li class="list-order-btn"><a href="{{ url($r->permalink) }}">Request Order</a></li>
                        </ul>
                    </div>
                </li>
                @endforeach
             </ul>
        </div>
    </div>
</div>
<div id="recent-reviews-section">
    <div class="container align-center">
        <h1>What Users Have To Say</h1>
        <div id="recent-reviews-list">
            <ul>
                @foreach($recent_reviews as $rr)
                <li class="list-item">
                    <div class="user-profile-pic">
                        <img src="{{ $rr->restaurant['img_one'] }}" alt="Author Name" />
                    </div>
                    <div class="reviews-item">
                        <div class="review-text">
                            <p>{{ shorter($rr->text, 300) }}</p>

                        </div>
                        <div class="review-details">
                            <p>{{ $rr->user_name }} reviewed for {{ $rr->restaurant['name'] }}</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<?php
function shorter($text, $chars_limit)
{
// Check if length is larger than the character limit
if (strlen($text) > $chars_limit)
{
// If so, cut the string at the character limit
$new_text = substr($text, 0, $chars_limit);
// Trim off white space
$new_text = trim($new_text);
// Add at end of text ...
return $new_text . "...";
}
// If not just return the text as is
else
{
return $text;
}
}

?>
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
            showInfo('info_speak_now');
            start_img.src = 'mic-animate.gif';
        };
        recognition.onerror = function(event) {
            if (event.error == 'no-speech') {
                start_img.src = 'mic.gif';
                showInfo('info_no_speech');
                ignore_onend = true;
            }
            if (event.error == 'audio-capture') {
                start_img.src = 'mic.gif';
                showInfo('info_no_microphone');
                ignore_onend = true;
            }
            if (event.error == 'not-allowed') {
                if (event.timeStamp - start_timestamp < 100) {
                    showInfo('info_blocked');
                } else {
                    showInfo('info_denied');
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
                showInfo('info_start');
                return;
            }
            showInfo('');
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
        showInfo('info_upgrade');
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
        showInfo('');
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
        showInfo('');
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
        showInfo('info_allow');
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
        //copy_button.style.display = style;
        //email_button.style.display = style;
        //copy_info.style.display = 'none';
        //email_info.style.display = 'none';
    }

</script>
@endsection
