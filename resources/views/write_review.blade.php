<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 11/11/15
 * Time: 6:23 PM
 */
?>
@extends('search_template')

@section('content')

{!! Form::open(array('name'=>'home_search','class'=>'basic-search','route'=>'search','novalidate'=>'')) !!}
<div class="search-section">
    <div class="container">
        <div class="basic-search-wrapper col-md-12">
            <div id="basic-search">
                <div class="input-group col-md-4 floatLeft">
                    <span class="input-group-addon" id="basic-location-icon"><span class="location-arrow-search"></span></span>
                    <input type="text" class="form-control" aria-describedby="basic-location-icon" id="locations" name="location" placeholder="City, State or Zip" value="" />

                </div>
                <div class="input-group col-md-6 floatLeft">
                    <span class="input-group-addon" id="basic-keywords-icon"><span class="glyphicon glyphicon-search"></span></span>
                    <input type="text" name="keywords" class="form-control" aria-describedby="basic-keywords-icon" id="keywords" placeholder="Restaurant Name or Cuisine or Keywords " />
                </div>
                <input class="text-search-btn" type="submit" name="Submit" value="Search" onclick="search_type='Search'" style="vertical-align:top;" />
                <button id="start_button" class="voice-search-btn" type="submit" name="Voice" onclick="search_type='Voice'" style="margin-left:10px;background-size:20px 32px;background-position:0 0;line-height:0px;" >
                    <img id="start_img" src="mic.gif" alt="Start" style="height:32px;">
                </button>
            </div>
        </div>
    </div>
</div>
<div class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumb-container">
            <ul class="breadcrumb-item">
                <li class="breadcrumb-list">
                    <a href="/">Write A Revew</span></a>
                    <span class="seperator">></span>
                </li>
            </ul>
        </div>
    </div>
</div>

</form>
<div class="content-wrapper">
    <div class="container">
        <div class="col-md-12 search-listing-heading">
            <h2>Write an anonymous review</h2>
            <p>First, find the restaurant which you want to be reviewed.</p>

            {!! Form::open(array('name'=>'review_search','class'=>'review-search','route'=>'write-a-review/search','novalidate'=>'')) !!}
                <div class="input-group col-md-4 floatLeft">
                    <span class="input-group-addon" id="basic-location-icon"><span class="location-arrow-search"></span></span>
                    <input type="text" class="form-control" aria-describedby="basic-location-icon" id="locations" name="location" placeholder="City, State or Zip" value="{{ $location }}" />

                </div>
                <div class="input-group col-md-6 floatLeft">
                    <span class="input-group-addon" id="basic-keywords-icon"><span class="glyphicon glyphicon-search"></span></span>
                    <input type="text" name="keywords" class="form-control" aria-describedby="basic-keywords-icon" id="keywords" placeholder="Restaurant Name or Cuisine or Keywords " />
                </div>
                <input class="text-search-btn" type="submit" name="Submit" value="Search" onclick="search_type='Search'" style="vertical-align:top;" />
            </form>

            @if(isset($restaurants))
            <div class="search-results">
                @if(count($restaurants)==0)
                <p>Sorry no restaurants matches the request. Try again.</p>
                @else

                @foreach($restaurants as $r)
                <?php
                if(isset($_REQUEST['open_now'])){
                    if($r->opened == 'yes'){

                        ?>
                        <div class="search-results-item">
                            <div class="results-item-details">
                                <!--<div class="results-item-logo">
                                    <img src="{{ asset('assets/images/restaurants/rest_1.png') }}" alt="Restaurant Name" />
                                </div>-->
                                <div class="results-item-info">
                                    <h3><a href="../public/restaurants/{{ $r->permalink }}" style="color:">{{ str_replace('???', '\'', $r->name) }}</a></h3>
                                    <address>
                                        <span class="address-icon"></span><span class="item-address">{{ $r->address_1.' '.$r->address_2.'-'.$r->id.'-'.$r->restaurants_id }} <br/>{{ $r->city.', '.$r->short.' '.$r->zip }}</span>
                                    </address>
                                    <span class="phone-number"><span class="phone-icon"></span><span class="item-phone">{{ $r->phone }}</span></span>
                                </div>
                                <div class="results-item-info-two">
                                    <!--<p><span class="item-rating"><img src="assets/images/rating.png" alt="2 star" /></span></p>-->
                                    <!--<p><span class="item-review-count">Reviews to be updated</span></p>-->
                                    @if($r->categories == NULL)
                                    <p></p>
                                    @else
                                    <p><span class="item-cuisine-type">{{ $r->categories }}</span></p>
                                    @endif
                                    @if($r->opened == 'yes')
                                    <p>Store is open now</p>
                                    @endif
                                </div>
                            </div>
                            <div class="result-item-reviews">

                            </div>
                        </div>
                    <?php
                    }
                }else{
                    ?>
                    <div class="search-results-item">
                        <div class="results-item-details">
                            <!--<div class="results-item-logo">
                                <img src="{{ asset('assets/images/restaurants/rest_1.png') }}" alt="Restaurant Name" />
                            </div>-->
                            <div class="results-item-info">
                                <h3><a href="{{ url('restaurants/'.$r->permalink) }}" style="color:">{{ str_replace('???', '\'', $r->name) }}</a></h3>
                                <address>
                                    <span class="address-icon"></span><span class="item-address">{{ $r->address_1.' '.$r->address_2.' '.$r->id.' '.$r->restaurants_id }} <br/>{{$r->city.', '.$r->short.' '.$r->zip }}</span>
                                </address>
                                <span class="phone-number"><span class="phone-icon"></span><span class="item-phone">{{ $r->phone }}</span></span>
                            </div>
                            <div class="results-item-info-two">
                                <a class="request_order_btn btn-rl-default" href="{{ url('write-a-review/'.$r->permalink) }}">Write a review</a>
                                @if($r->categories == NULL)
                                <p></p>
                                @else
                                <p><span class="item-cuisine-type">{{ $r->categories }}</span></p>
                                @endif
                                @if($r->opened == 'yes')
                                <p>Store is open now</p>
                                @endif
                            </div>
                        </div>
                        <div class="result-item-reviews">

                        </div>
                    </div>
                <?php
                }
                ?>
                @endforeach
                @endif
            </div>
            <div class="paginat">

                <?php
                $keywords = Input::get('keywords');
                //echo str_replace('/?', '?', $restaurants->appends(['keywords'=>$keywords,'location'=>$location ])->render());
                echo str_replace('/?', '?', $restaurants->appends(['keywords'=>$keywords,'location'=>$location, Input::except(array('page', 'keywords')) ])->render());

                ?>
            </div>
            @endif
        </div>
    </div>
</div>
<script>
    var stickerTop = parseInt($('.listing-map-wrapper').offset().top);
    $(window).scroll(function() {
        $(".listing-map-wrapper").css((parseInt($(window).scrollTop()) + parseInt($(".listing-map-wrapper").css('margin-top')) > stickerTop) ? {
            position: 'fixed',
            top: '0px'
        } : {
            position: 'relative'
        });
    });
</script>
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
@endsection