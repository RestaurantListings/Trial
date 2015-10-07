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
        {!! Form::open(array('name'=>'home_search','class'=>'banner-search','route'=>'search','novalidate'=>'')) !!}
            <input type="text" name="keywords" placeholder="Restaurant Name or Cuisine or Keywords " />
            <input type="text" name="location" placeholder="City, State or Zip" />
            <input class="text-search-btn" type="submit" name="Submit" value="Search" />
            <input class="voice-search-btn" type="submit" name="Voice" />
        </form>
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
                    <a href="/">
                        <span class="cuisine-logo pizza"></span>
                        <span class="cuisine-name">Pizza</span>
                    </a>
                </li>
                <li>
                    <a href="/">
                        <span class="cuisine-logo sushi"></span>
                        <span class="cuisine-name">Sushi</span>
                    </a>
                </li>
                <li>
                    <a href="/">
                        <span class="cuisine-logo indian"></span>
                        <span class="cuisine-name">Indian</span>
                    </a>
                </li>
                <li>
                    <a href="/">
                        <span class="cuisine-logo thai"></span>
                        <span class="cuisine-name">Thai</span>
                    </a>
                </li>
                <li>
                    <a href="/">
                        <span class="cuisine-logo chineese"></span>
                        <span class="cuisine-name">Chineese</span>
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
                            <li class="list-visit-btn"><a href="../public/restaurants/{{ $r->permalink }}">Visit</a></li>
                            <li class="list-order-btn"><a href="{{ action('WelcomeController@index') }}">Order</a></li>
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
@endsection
