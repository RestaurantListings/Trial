<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 10/16/15
 * Time: 2:32 PM
 */
?>
@extends('mobile_app')

@section('home_banner')
<div class="container banner-search">
    <div class="row">
        {!! Form::open(array('name'=>'home_search','class'=>'banner-search','route'=>'search','method'=>'get','novalidate'=>'', 'onSubmit'=>'return startButton(event);')) !!}
        <label>Restaurant Name</label><br/>
        <input type="text" name="keywords" class="banner-search-input" /><br/>
        <label>City, State</label><br/>
        <input type="text" name="location" class="banner-search-input" value="{{ $location['city'].', '.$location['state'] }}" /><br/>
        <div style="width:180px;margin:0px auto;">
            <input class="text-search-btn" type="submit" name="Submit" value="Search" onclick="search_type='Search'" />
            <button id="start_button" class="voice-search-btn" type="submit" name="Voice" onclick="search_type='Voice'" style="display:none;" >
                <img id="start_img" src="mic.gif" alt="Start">
            </button>
        </div>
        </form>
    </div>
</div>
@endsection

@section('home_cuisine')
<div class="container cuisine-section">
    <div class="row">
        <ul>
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
                    <span class="cuisine-logo chineese"></span>
                    <span class="cuisine-name">Chinese</span>
                </a>
            </li>
        </ul>
    </div>
</div>
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
        //start_button.style.display = 'inline-block';
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
        /*if (s) {
            for (var child = info.firstChild; child; child = child.nextSibling) {
                if (child.style) {
                    child.style.display = child.id == s ? 'inline' : 'none';
                }
            }
            info.style.visibility = 'visible';
        } else {
            info.style.visibility = 'hidden';
        }*/
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

