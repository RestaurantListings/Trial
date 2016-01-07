<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 9/14/15
 * Time: 4:55 PM
 */
?>
@extends('search_template')

@section('content')
<?php /* echo '<pre>'; var_dump(Input::get());echo '</pre>'; */?>
{!! Form::open(array('name'=>'home_search','class'=>'basic-search','route'=>'search','novalidate'=>'')) !!}
<div class="search-section">
    <div class="container">
        <div class="basic-search-wrapper col-md-12">
            <div id="basic-search">
            <div class="input-group col-md-4 floatLeft">
                <span class="input-group-addon" id="basic-location-icon"><span class="location-arrow-search"></span></span>
                <input type="text" class="form-control" aria-describedby="basic-location-icon" id="locations" name="location" placeholder="City, State or Zip" value="{{ $location }}" />

            </div>
            <div class="input-group col-md-6 floatLeft">
                <span class="input-group-addon" id="basic-keywords-icon"><span class="glyphicon glyphicon-search"></span></span>
                <input type="text" name="keywords" class="form-control" aria-describedby="basic-keywords-icon" id="keywords" placeholder="Restaurant Name or Cuisine or Keywords" value="{{ Input::get('keywords') }}" />
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
                @if(!isset($search_state))
                <li class="breadcrumb-list">
                    <a href="/"><span>{{ $location }}</span></a>
                    <span class="seperator">></span>
                </li>
                @else
                <li class="breadcrumb-list">
                    <a href="/"><span>{{ $search_state }}</span></a>
                    <span class="seperator">></span>
                </li>
                <li class="breadcrumb-list">
                    <a href="/"><span>{{ $search_city }}</span></a>
                    <span class="seperator">></span>
                </li>
                @endif
                <li class="breadcrumb-list">
                    <a href="/"><span>Restaurants</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="search-listing-header">
    <div class="container">
        <div class="search-listing-heading">
            <h2>Best Restaurants in {{ $location }}</h2>
        </div>
        <div class="filters">
            <ul class="filters-list">
                <!--
                <li class="filters-list-item">
                    <label for="open_now">
                        <button class="btn btn-default search_filter" type="button" id="open_now" onclick="filter_option('open_now');">
                            Open Now
                        </button>
                        <input type="checkbox" class="hidden" name="open_now" value="1" <?php if(Input::has('open_now')){ echo 'checked';} ?>/>
                    </label>

                </li>
                <li class="filters-list-item">
                    <button class="btn btn-default search_filter" type="button" id="nearest" onclick="filter_option('nearest');">Nearest</button>
                    <input type="checkbox" class="hidden" name="nearest" value="1" <?php if(Input::has('nearest')){ echo 'checked';} ?>/>
                </li>
                -->
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
                <li class="filters-list-item">
                    <button class="btn btn-default search_filter" type="button" id="reservation" onclick="filter_option('reservation');">Reservation</button>
                    <input type="checkbox" class="hidden" name="reservation" value="1" <?php if(Input::has('reservation')){ echo 'checked';} ?> />
                </li>
                <li>
                    <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><span class="glyphicon glyphicon-list"></span></button>
                </li>
            </ul>
        </div>

    </div>
</div>
<div class="content-wrapper">
    <div class="container">

        <div class="collapse" id="collapseExample">
            <div class="filter-well">
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
                        <li>
                            <label class="category radio-check">
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
                        <li style="float:none;">
                            <a href="#" data-toggle="modal" data-target="#cuisineModal">More Cuisines</a>
                        </li>

                    </ul>
                </div>
                <!-- Cuisine Modal Begins-->
                <div class="modal fade" id="cuisineModal" tabindex="-1" role="dialog" aria-labelledby="cuisineModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            {!! Form::open(array('name'=>'request_online_ordering','class'=>'request','route'=>'request_online_ordering','method'=>'post','novalidate'=>'')) !!}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">All Cuisine Type </h4>
                            </div>
                            <div class="modal-body more-cuisine-filter">
                                <div id="the-basics">
                                    <input class="typeahead" id="typehead-cuisine" type="text" placeholder="Cuisine Type">
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
                                <!--<ul class="main">
                                @foreach($cuisine as $c)
                                        <li class="col-md-6">
                                            <label class="category radio-check">
                                                <input name="category[]" value="{{ $c->name }}" type="checkbox" {{in_array("'.$c->name.'", $category) ? 'checked' : ''}}>
                                                <span>{{ $c->name }}</span>
                                            </label>
                                        </li>
                                @endforeach
                                </ul>-->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Cuisine Modal Ends-->
                <!--
                <div class="filter-set">
                    <h4>Orders</h4>
                    <?php $ordering = Input::has('ordering') ? Input::get('ordering') : [] ?>
                    <ul class="main">
                        <li>
                            <label class="place radio-check">
                                <input name="place" value="online" type="checkbox">
                                <span>Online Ordering</span>
                            </label>
                        </li>
                        <li>    <label class="place radio-check">
                                <input name="place" value="PickUp" type="checkbox">
                                <span>Pickup</span>
                            </label>
                        </li>
                        <li>    <label class="ordering radio-check">
                                <input name="ordering[]" value="Delivery  -/-> Yes" type="checkbox" {{in_array('Delivery  -/-> Yes', $ordering) ? 'checked' : ''}}>
                                <span>Delivery</span>
                            </label>
                        </li>
                        <li>    <label class="place radio-check">
                                <input name="place" value="Take Reservation" type="checkbox">
                                <span>Take Reservation</span>
                            </label>
                        </li>
                    </ul>
                </div>
                -->
                <!--
                <div class="filter-set">
                    <h4>Healthy Food</h4>
                    <?php $healthy = Input::has('healthy') ? Input::get('healthy') : [] ?>
                    <ul class="main">
                        <li>
                            <label class="healthy radio-check">
                                <input name="healthy[]" value="Diabetics" type="checkbox" {{in_array('Diabetics', $healthy) ? 'checked' : ''}}>
                                <span>Diabetics</span>
                            </label>
                        </li>
                        <li>    <label class="healthy radio-check">
                                <input name="healthy[]" value="Cholesterol" type="checkbox" {{in_array('Cholesterol', $healthy) ? 'checked' : ''}}>
                                <span>Cholesterol</span>
                            </label>
                        </li>
                        <li>    <label class="healthy radio-check">
                                <input name="healthy[]" value="Weight Loss" type="checkbox" {{in_array('Weight Loss', $healthy) ? 'checked' : ''}}>
                                <span>Weight Loss</span>
                            </label>
                        </li>
                        <li>    <label class="healthy radio-check">
                                <input name="healthy[]" value="Blood Pressure" type="checkbox" {{in_array('Blood Pressure', $healthy) ? 'checked' : ''}}>
                                <span>Blood Pressure</span>
                            </label>
                        </li>
                        <li>    <label class="healthy radio-check">
                                <input name="healthy[]" value="Gluten Free" type="checkbox" {{in_array('Gluten Free', $healthy) ? 'checked' : ''}}>
                                <span>Gluten Free</span>
                            </label>
                        </li>
                    </ul>
                </div>

                <div class="filter-set">
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
                <div class="filter-set-btn">

                    <button class="filter_options_btn">Search Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</form>
<div class="content-wrapper">
    <div class="container">
        <div class="column-70">
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
                                <h3><a href="{{url('restaurants/'.$r->permalink)}}" style="color:">{{ str_replace('???', '\'', $r->name) }}</a></h3>
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
                            <?php var_dump($r->restaurants_reviews); ?>
                            {{ $r->restaurants_reviews->text }}
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
                                    <h3><a href="{{url('restaurants/'.$r->permalink)}}" style="color:">{{ str_replace('???', '\'', $r->name) }}</a></h3>
                                    <address>
                                        <span class="address-icon"></span><span class="item-address">{{ $r->address_1.' '.$r->address_2 }} <br/>{{$r->city.', '.$r->short.' '.$r->zip }}</span>
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
                                @foreach( $r->reviews_group as $rev)
                                    <p>{{ $rev->review_text }}</p>
                                @endforeach
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
        </div>
        <div class="column-30">

            <script type="text/javascript">

                var map;
                function initMap() {
                    <?php
                    $d=0;
                    foreach($restaurants as $r){
                        if($d ==1){
                        break;
                        }
                        $d++;

                        echo "var map = new google.maps.Map(document.getElementById('map'), {"
                                ."zoom: 10,"
                                ."center: {lat: ".$r->latitude.", lng: ".$r->longitude."}"
                                ."});";
                                }

                    ?>

                    <?php
                    foreach($restaurants as $r){
                    echo "var marker = new google.maps.Marker({";
                    echo "position: {lat: ".$r->latitude.", lng: ".$r->longitude." },";
                    echo "    map: map,";
                    echo "   title: '".$r->name."',";
                    echo "   label: '".substr($r->name, 0, 1)."'";
                    echo "});";
                    echo "marker.addListener('click', function() {";
                    echo 'window.location="restaurants/'.$r->permalink.'"';
                    echo "});";
                    }
                        ?>


                }


            </script>
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCnR5zlgUmcJqO6nP6PxkuZclnWf3TT8EY&callback=initMap">
            </script>
            <div class="listing-map-wrapper">
                <div id="map"></div>
            </div>

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
    <?php
    $cuisine_head = "";
   foreach($cuisine as $c)
   {
       $cuisine_head.= "'".$c->name."', ";
   }
    ?>
    var states = [
        <?php echo $cuisine_head; ?>
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
@endsection