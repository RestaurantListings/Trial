<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 10/17/15
 * Time: 12:39 AM
 */
?>
@extends('mobile_app')

@section('search_listing')
<div class="container search-listing-section">
    <div class="row">
        <h1>Best Restaurants in<br/>{{ $location }}</h1>
        <div class="col-md-12">
        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#myModal">
            Filter
        </button>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Filter - Redefine the search</h4>
        </div>
        <div class="modal-body">

            <div class="filter-well">
                <!--<ul class="filters-list align-center">

                                        <li class="filters-list-item">
                                            <label for="open_now">
                                                <button class="btn btn-default search_filter" type="button" id="open_now" onclick="filter_option('open_now');">
                                                    Store is Open
                                                </button>
                                                <input type="checkbox" class="hidden" name="open_now" value="1" <?php if(Input::has('open_now')){ echo 'checked';} ?>/>
                                            </label>

                                        </li>
                                        <li class="filters-list-item">
                                            <button class="btn btn-default search_filter" type="button" id="nearest" onclick="filter_option('nearest');">Nearest</button>
                                            <input type="checkbox" class="hidden" name="nearest" value="1" <?php if(Input::has('nearest')){ echo 'checked';} ?>/>
                                        </li>

                    <li class="filters-list-item">
                        <div class="btn-group" role="group" aria-label="...">
                            <button class="btn btn-default search_filter" type="button" id="price_1" onclick="filter_option('price_1');">$</button>
                            <button class="btn btn-default search_filter" type="button" id="price_2" onclick="filter_option('price_2');">$$</button>
                            <button class="btn btn-default search_filter" type="button" id="price_3" onclick="filter_option('price_3');">$$$</button>
                            <button class="btn btn-default search_filter" type="button" id="price_4" onclick="filter_option('price_4');">$$$$</button>
                        </div>
                        <input type="checkbox" class="hidden" name="price_1" value="$" <?php if(Input::has('price_1')){ echo 'checked';} ?> />
                        <input type="checkbox" class="hidden" name="price_2" value="$$" <?php if(Input::has('price_2')){ echo 'checked';} ?> />
                        <input type="checkbox" class="hidden" name="price_3" value="$$$" <?php if(Input::has('price_3')){ echo 'checked';} ?> />
                        <input type="checkbox" class="hidden" name="price_4" value="$$$$" <?php if(Input::has('price_4')){ echo 'checked';} ?> />

                    </li>
                </ul>
                <!--
<div class="filter-set">
<h4>Neightbourhood</h4>
<ul class="main">
    @foreach($filter_options['city'] as $fo_city)
    <li>
        <label class="place radio-check">
            <input name="place" value={{ $fo_city->id }} type="checkbox">
            <span>{{$fo_city->city }}</span>
        </label>
    </li>
    @endforeach
</ul>
</div>
<div class="filter-set">
<h4>Distance</h4>
<ul class="main">
    <li>
        <label class="place radio-check">
            <input name="place" value="1" type="checkbox">
            <span>< 1 mile</span>
        </label>
    </li>
    <li>    <label class="place radio-check">
            <input name="place" value="5" type="checkbox">
            <span>< 5 miles</span>
        </label>
    </li>
    <li>    <label class="place radio-check">
            <input name="place" value="10" type="checkbox">
            <span>< 10 miles</span>
        </label>
    </li>
    <li>    <label class="place radio-check">
            <input name="place" value="20" type="checkbox">
            <span>< 20 miles</span>
        </label>
    </li>
</ul>
</div>
-->
                <div class="filter-set">
                    <h4>Cuisine Type</h4>
                    <?php $category = Input::has('category') ? Input::get('category') : [] ?>
                    <ul class="main">
                        <li>
                            <label class="category radio-check">
                                <input name="category[]" value="American" type="checkbox" {{in_array('American', $category) ? 'checked' : ''}}>
                                <span>American</span>
                            </label>
                        </li>
                        <li>    <label class="category radio-check">
                                <input name="category[]" value="Breakfast" type="checkbox" {{in_array('Breakfast', $category) ? 'checked' : ''}}>
                                <span>Breakfast</span>
                            </label>
                        </li>
                        <li>    <label class="category radio-check">
                                <input name="category[]" value="Chinese" type="checkbox" {{in_array('Chinese', $category) ? 'checked' : ''}}>
                                <span>Chinese</span>
                            </label>
                        </li>
                        <li>    <label class="category radio-check">
                                <input name="category[]" value="Greek" type="checkbox" {{in_array('Greek', $category) ? 'checked' : ''}}>
                                <span>Greek</span>
                            </label>
                        </li>
                        <li>    <label class="category radio-check">
                                <input name="category[]" value="Indian" type="checkbox" {{in_array('Indian', $category) ? 'checked' : ''}}>
                                <span>Indian</span>
                            </label>
                        </li>
                        <li>    <label class="category radio-check">
                                <input name="category[]" value="Italian" type="checkbox" {{in_array('Italian', $category) ? 'checked' : ''}}>
                                <span>Italian</span>
                            </label>
                        </li>
                        <li>    <label class="category radio-check">
                                <input name="category[]" value="Mexican" type="checkbox" {{in_array('Mexican', $category) ? 'checked' : ''}}>
                                <span>Mexican</span>
                            </label>
                        </li>
                        <li>    <label class="category radio-check">
                                <input name="category[]" value="Pizza" type="checkbox" {{in_array('Pizza', $category) ? 'checked' : ''}}>
                                <span>Pizza</span>
                            </label>
                        </li>
                        <li>    <label class="category radio-check">
                                <input name="category[]" value="Sushi" type="checkbox" {{in_array('Sushi', $category) ? 'checked' : ''}}>
                                <span>Sushi</span>
                            </label>
                        </li>
                        <li>    <label class="category radio-check">
                                <input name="category[]" value="Thai" type="checkbox" {{in_array('Thai', $category) ? 'checked' : ''}}>
                                <span>Thai</span>
                            </label>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#cuisineModal">More Cuisines</a>
                        </li>
                    </ul>
                </div>
                <hr/>
                <!-- Cuisine Modal Begins-->
                <div class="modal fade" id="cuisineModal" tabindex="-1" role="dialog" aria-labelledby="cuisineModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">All Cuisine Type </h4>
                            </div>
                            <div class="modal-body more-cuisine-filter">
                                <div id="the-basics">
                                    <input class="typeahead" type="text" id="typehead-cuisine" placeholder="Cuisine Type">
                                    <span class="btn-rl-default" onclick="return goToCuisine();">Go</span>
                                </div>
                                <ul class="main" id="suggestive-cuisine">
                                    @foreach($cuisine as $c)
                                    <li class="col-md-6">
                                        <label class="category radio-check">
                                            <a style="color:#000;" href="{{ url('category/'.$c->name) }}"><span>{{ $c->name }}</span></a>
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!--
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>-->
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Cuisine Modal Ends-->

                <!--<div class="filter-set">
                    <h4>Features</h4>
                    <?php $features = Input::has('features') ? Input::get('features') : [] ?>
                    <ul class="main">
                        <li>
                            <label class="features radio-check">
                                <input name="features[]" value="Accepts Credit Cards  -- Yes" type="checkbox" {{in_array('Accepts Credit Cards  -- Yes', $features) ? 'checked' : ''}}>
                                <span>Accept Credit Cards</span>
                            </label>
                        </li>
                        <li>    <label class="features radio-check">
                                <input name="features[]" value="Wi-Fi  -- Yes" type="checkbox" {{in_array('Wi-Fi  -- Yes', $features) ? 'checked' : ''}}>
                                <span>Has Wifi</span>
                            </label>
                        </li>
                        <li>    <label class="features radio-check">
                                <input name="features[]" value="Waiter Service  -- Yes" type="checkbox" {{in_array('Waiter Service  -- Yes', $features) ? 'checked' : ''}}>
                                <span>Has Waiter Service</span>
                            </label>
                        </li>
                        <li>    <label class="features radio-check">
                                <input name="features[]" value="Good for Kids  -- Yes" type="checkbox" {{in_array('Good for Kids  -- Yes', $features) ? 'checked' : ''}}>
                                <span>Good For Kids</span>
                            </label>
                        </li>
                        <li>    <label class="features radio-check">
                                <input name="features[]" value="Good for Groups  -- Yes" type="checkbox" {{in_array('Good for Groups  -- Yes', $features) ? 'checked' : ''}}>
                                <span>Good For Groups</span>
                            </label>
                        </li>
                    </ul>
                </div>-->

            </div>
        </div>
        <div class="modal-footer filter-set-btn">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary filter_options_btn">Search</button>

        </div>
        </div>
        </div>
        </div>
        </div>

        @if(count($restaurants)==0)
            <p>Sorry no restaurants matches the request. Try again.</p>
        @else

            @foreach($restaurants as $r)
                <div class="search-results-item">
                    <!--
                    <div class="results-item-logo">
                        <img src="{{ asset('mobile_assets/images/restaurants/rest_1.png') }}" alt="Restaurant Name">
                    </div>-->
                    <div class="results-item-info">
                        <h3><a href="{{ url('restaurants/'.$r->permalink) }}">{{ str_replace('???', '\'', $r->name) }}</a></h3>

                        <!--<p><span class="item-rating"><img src="assets/images/rating.png" alt="2 star"></span></p>-->

                        <address>
                            <span class="address-icon"></span><span class="item-address">{{ $r->address_1.' '.$r->address_2}} <br/>{{$r->city.', '.$r->short.' '.$r->zip }}</span>
                        </address>
                        <span class="phone-number"><span class="phone-icon"></span><span class="item-phone">{{ $r->phone }}</span></span>
                        <p><span class="item-cuisine-type">{{ $r->categories }}</span></p>
                        <div class="result-item-reviews">
                            @foreach( $r->reviews_group as $rev)
                            <p>{{ $rev->review_text }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        <?php
        $keywords = Input::get('keywords');
        echo str_replace('/?', '?', $restaurants->appends(['keywords'=>$keywords,'location'=>$location, Input::except(array('page', 'keywords')) ])->render());
        ?>
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
        //document.forms["home_search"].submit();
    }

</script>
@endsection
