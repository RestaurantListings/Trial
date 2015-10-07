@extends('app')

@section('banner')
<!-- Banner Section - Begins -->
<div class="home-banner">
    <div class="container home-banner-image">
        <div class="home-headline">
            <!--<h1>Order from +300 cities in USA</h1>-->
            <h1>IF THERE IS FOOD, WE WILL FIND IT</h1>
            <h2>Find Your Favourite Restaurants and Favourite Dishes</h2>

        </div>
        <div class="locator-form">
            <div id="info" style="display:none;">
                <p id="info_speak_now">Speak now.</p>
                <p id="info_no_speech">No speech was detected. You may need to adjust your
                    <a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
                        microphone settings</a>.</p>
                <p id="info_no_microphone" style="display:none">
                    No microphone was found. Ensure that a microphone is installed and that
                    <a href="//support.google.com/chrome/bin/answer.py?hl=en&amp;answer=1407892">
                        microphone settings</a> are configured correctly.</p>
                <p id="info_allow">Click the "Allow" button above to enable your microphone.</p>
                <p id="info_denied">Permission to use microphone was denied.</p>
                <p id="info_blocked">Permission to use microphone is blocked. To change,
                    go to chrome://settings/contentExceptions#media-stream</p>
                <p id="info_upgrade">Web Speech API is not supported by this browser.
                    Upgrade to <a href="//www.google.com/chrome">Chrome</a>
                    version 25 or later.</p>
            </div>
            <!--<form action="http://restaurantlistings.com/dev/public/search" method="post">-->
            {!! Form::open(array('name'=>'home_search','route'=>'search','novalidate'=>'')) !!}
            <!--{!! Form::open(array('url'=>'search_by_voice','method'=>'POST', 'id'=>'myform')) !!}-->
            <div id="the-basics">
                {!! Form::text('restaurant_name', null, ['class'=>'typehead', 'placeholder'=>'Restaurant Name', 'id'=>'restaurant_name']) !!}
                <span class="or-span">OR</span>
                {!! Form::text('state', null, ['class'=>'typehead', 'placeholder'=>'State of USA', 'id'=>'state']) !!}
                {!! Form::text('city', null, ['class'=>'typehead', 'placeholder'=>'City', 'id'=>'city']) !!}
                <span class="or-span">OR</span>
                {!! Form::text('zip', null, ['class'=>'typehead', 'placeholder'=>'Zip Code', 'id'=>'zip']) !!}
            </div>
            <div id="results" style="display:none;">
                <span id="final_span" class="final"></span>
                <span id="interim_span" class="interim"></span>
                <input name="restaurant_name_voice" id="restaurant_name_voice" type="hidden" />
                <p>
            </div>
            <div id="div_language" style="display:none;">
                <select id="select_language" onchange="updateCountry()"></select>
                &nbsp;&nbsp;
                <select id="select_dialect"></select>
            </div>

            <div class="search-btn">
                <button type="submit">SEARCH NOW</button>
                <span id="start_button" onclick="show_text();startButton(event);" class="voice-btn"><img id="start_img" src="assets/img/mic.gif" alt="Start"></span>
            </div>


            </form>
        </div>
    </div>
</div>
@endsection

@section('cuisine')
<!-- Category/Cuisine Section -->
<div class="cuisine-section">
    <div class="container">
        <h2>Choose From Your Favourite Cuisine</h2>
        <div class="cuisine-wrapper">
            <div class="home-cuisine-box pizza-cuisine">
                <h3>Pizza</h3>
            </div>
            <div class="home-cuisine-box sushi-cuisine">
                <h3>Sushi</h3>
            </div>
            <div class="home-cuisine-box indian-cuisine">
                <h3>Indian</h3>
            </div>
            <div class="home-cuisine-box chineese-cuisine">
                <h3>Chineese</h3>
            </div>
            <div class="home-cuisine-box thai-cuisine">
                <h3>Thai</h3>
            </div>
        </div>
    </div>
</div>
@endsection

@section('recent_restaurant')
<!-- New Restaurants -->
<div class="new-restaurants-section">
    <div class="container">
        <h2>Restaurants Listed Recently</h2>
        <div class="content-wrapper">
            @foreach($recent_restaurants as $r)

            <div class="new-restaurant-box">
                <div class="nr-logo">
                    <img src="{{ $r->img_one }}" alt="Restaurant Name" width="100%" />
                </div>
                <div class="nr-info">
                    <h3>{{ $r->name }}</h3>
                    <h4>{{ $r->categories }}</h4>
                    <div class="rating">
                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                        <p class="review"><span>111&nbsp;</span>Reviews</p>
                    </div>
                    <p>{{ $r->address_1.' '.$r->address_2}} <br/>{{$r->city->city.' '.$r->state->state.' '.$r->zip }} </p>
                    <p>Phone number {{ $r->phone }}</p>
                </div>
                <div class="nr-quicklinks">
                    <a href="../public/restaurants/{{ $r->permalink }}" class="visit-btn">VISIT</a>
                    <a href="#" class="order-btn">ORDER</a>
                </div>
            </div>

            @endforeach

        </div>
    </div>
</div>
<!--Review, Dishes, Popular Section -->
<div class="popular-section">
    <div class="container" style="background-color:#fff;">

        <div class="recent-reviews">
            <h3>Recent Reviews</h3>
            <div class="recent-reviews-list">
                <div class="review-user-info">
                    <img src="assets/img/default_profile_image.png" alt="" />
                    <p class="float:left;"><span class="review-author">Tommy</span> reviewed on <i>3/7/2015 5:54pm</i></p>
                    <div class="rating">
                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                    </div>
                </div>
                <p>Well this waiter i got she is indian and she is like the best she is out going laughing with us and she was all over are drinks we did not even have tell her ee needed more drink and she was just the shit and excuse my franch but she is also good good looking too. her name is tessa and i been in here a lot and i might of been out of it but she is an angle and best waiter. if i wss u guys i would give her a raise and one more thing i bet she has one good looking guy because she is sex and hard worker. o my god is that her baby too? Okay god has or i mean u guess just created the most brautiful baby ever.</p>
            </div>
            <div class="recent-reviews-list">
                <div class="review-user-info">
                    <img src="assets/img/default_profile_image.png" alt="" />
                    <p class="float:left;"><span class="review-author">Michele</span> reviewed on <i>3/7/2015 5:54pm</i></p>
                    <div class="rating">
                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                    </div>
                </div>
                <p>The Restaurant is good. The service is fair. </p>
            </div>
            <div class="recent-reviews-list">
                <div class="review-user-info">
                    <img src="assets/img/default_profile_image.png" alt="" />
                    <p class="float:left;"><span class="review-author">Cris</span> reviewed on <i>3/7/2015 5:54pm</i></p>
                    <div class="rating">
                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                    </div>
                </div>
                <p>Second visit at this SmashBurger. Definitely a drop off in service. We arrived around 5 PM on a Sunday. There were four tables full, inside and out. We stepped up right away to order but the...</p>
            </div>
            <div class="recent-reviews-list">
                <div class="review-user-info">
                    <img src="assets/img/default_profile_image.png" alt="" />
                    <p class="float:left;"><span class="review-author">Elizabeth</span> reviewed on <i>2015-03-26 03:44am</i></p>
                    <div class="rating">
                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                    </div>
                </div>
                <p>The Restaurant is good. The service is fair. </p>
            </div>
            <div class="recent-reviews-list">
                <div class="review-user-info">
                    <img src="assets/img/default_profile_image.png" alt="" />
                    <p class="float:left;"><span class="review-author">John Doe</span> reviewed on <i>2015-03-19 10:04pm</i></p>
                    <div class="rating">
                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                    </div>
                </div>
                <p>good restuarent.... nice food.... </p>
            </div>
        </div>
        <!--<div class="popular-dishes">

        </div>-->
        <div class="popular-restaurants">

        </div>
    </div>
</div>
@endsection

@section('voice_script')
<script>
var langs =
    [['Afrikaans',       ['af-ZA']],
        ['Bahasa Indonesia',['id-ID']],
        ['Bahasa Melayu',   ['ms-MY']],
        ['Català',          ['ca-ES']],
        ['Ceština',         ['cs-CZ']],
        ['Deutsch',         ['de-DE']],
        ['English',         ['en-AU', 'Australia'],
            ['en-CA', 'Canada'],
            ['en-IN', 'India'],
            ['en-NZ', 'New Zealand'],
            ['en-ZA', 'South Africa'],
            ['en-GB', 'United Kingdom'],
            ['en-US', 'United States']],
        ['Español',         ['es-AR', 'Argentina'],
            ['es-BO', 'Bolivia'],
            ['es-CL', 'Chile'],
            ['es-CO', 'Colombia'],
            ['es-CR', 'Costa Rica'],
            ['es-EC', 'Ecuador'],
            ['es-SV', 'El Salvador'],
            ['es-ES', 'España'],
            ['es-US', 'Estados Unidos'],
            ['es-GT', 'Guatemala'],
            ['es-HN', 'Honduras'],
            ['es-MX', 'México'],
            ['es-NI', 'Nicaragua'],
            ['es-PA', 'Panamá'],
            ['es-PY', 'Paraguay'],
            ['es-PE', 'Perú'],
            ['es-PR', 'Puerto Rico'],
            ['es-DO', 'República Dominicana'],
            ['es-UY', 'Uruguay'],
            ['es-VE', 'Venezuela']],
        ['Euskara',         ['eu-ES']],
        ['Français',        ['fr-FR']],
        ['Galego',          ['gl-ES']],
        ['Hrvatski',        ['hr_HR']],
        ['IsiZulu',         ['zu-ZA']],
        ['Íslenska',        ['is-IS']],
        ['Italiano',        ['it-IT', 'Italia'],
            ['it-CH', 'Svizzera']],
        ['Magyar',          ['hu-HU']],
        ['Nederlands',      ['nl-NL']],
        ['Norsk bokmål',    ['nb-NO']],
        ['Polski',          ['pl-PL']],
        ['Português',       ['pt-BR', 'Brasil'],
            ['pt-PT', 'Portugal']],
        ['Româna',          ['ro-RO']],
        ['Slovencina',      ['sk-SK']],
        ['Suomi',           ['fi-FI']],
        ['Svenska',         ['sv-SE']],
        ['Türkçe',          ['tr-TR']],
        ['?????????',       ['bg-BG']],
        ['P??????',         ['ru-RU']],
        ['??????',          ['sr-RS']],
        ['???',            ['ko-KR']],
        ['??',             ['cmn-Hans-CN', '??? (????)'],
            ['cmn-Hans-HK', '??? (??)'],
            ['cmn-Hant-TW', '?? (??)'],
            ['yue-Hant-HK', '?? (??)']],
        ['???',           ['ja-JP']],
        ['Lingua latina',   ['la']]];
for (var i = 0; i < langs.length; i++) {
    select_language.options[i] = new Option(langs[i][0], i);
}
select_language.selectedIndex = 6;
updateCountry();
select_dialect.selectedIndex = 6;
showInfo('info_start');
function updateCountry() {
    for (var i = select_dialect.options.length - 1; i >= 0; i--) {
        select_dialect.remove(i);
    }
    var list = langs[select_language.selectedIndex];
    for (var i = 1; i < list.length; i++) {
        select_dialect.options.add(new Option(list[i][1], list[i][0]));
    }
    select_dialect.style.visibility = list[1].length == 1 ? 'hidden' : 'visible';
}
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
    recognition.interimResults = false;
    recognition.onstart = function() {
        recognizing = true;
        showInfo('info_speak_now');
        start_img.src = 'assets/img/mic-animate.gif';
    };
    recognition.onerror = function(event) {
        if (event.error == 'no-speech') {
            start_img.src = 'assets/img/mic.gif';
            showInfo('info_no_speech');
            ignore_onend = true;
        }
        if (event.error == 'audio-capture') {
            start_img.src = 'assets/img/mic.gif';
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
        start_img.src = 'assets/img/mic.gif';
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
            //createEmail();
        }

        getresults(final_transcript);
        document.forms["home_search"].submit();
    };
    recognition.onresult = function(event) {
        var interim_transcript = '';
        for (var i = event.resultIndex; i < event.results.length; ++i) {
            if (event.results[i].isFinal) {
                final_transcript += event.results[i][0].transcript;
            } else {
                interim_transcript += event.results[i][0].transcript;
            }
        }
        final_transcript = capitalize(final_transcript);
        final_span.innerHTML = linebreak(final_transcript);
        interim_span.innerHTML = linebreak(interim_transcript);
        if (final_transcript || interim_transcript) {
            showButtons('inline-block');
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
    if (recognizing) {
        recognition.stop();
        return;
    }
    final_transcript = '';
    recognition.lang = select_dialect.value;
    recognition.start();
    ignore_onend = false;
    final_span.innerHTML = '';
    interim_span.innerHTML = '';
    start_img.src = 'assets/img/mic-slash.gif';
    showInfo('info_allow');
    showButtons('none');
    start_timestamp = event.timeStamp;

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
function show_text(){
    document.getElementById('the-basics').style.display = 'none';
    document.getElementById('results').style.display = 'block';
}
function getresults(string){
    document.getElementById('restaurant_name_voice').value = string;

    /*
    $.ajax({
        url: 'voice',
        type: "post",
        data: {'q':string, '_token': $('input[name=_token]').val()},
        success: function(data){
            alert(data);
        },
        error: function (err) {
            alert(err.responseText);
        }
    });
    */
}
</script>
@endsection

