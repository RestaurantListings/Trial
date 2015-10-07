<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 7/23/15
 * Time: 11:24 PM
 */
?>
@extends('restaurants')


@section('page_title')
@foreach($data['restaurant'] as $d)
{{ $d->name }} | Restaurant Listings |
@endforeach
@endsection


@section('restaurant_info_header')
@foreach($data['restaurant'] as $r)
<div class="restaurants_info_row_one">
    <div class="rest_info_column_one col-md-6">
        <h1 itemprop="name">{{ $r->name }}</h1>
        <p><strong>
                {{ $r->address_1.', '.$r->address_2}}<br>
                {{ $r->city->city.', '.$r->state->state.', '.$r->zip }}
            </strong>
        </p>
        <p>{{ $r->phone }} {{ $r->website }}</p>
    </div>
    <div class="rest_info_column_three col-md-6">
        <div class="restaurant_quicklinks">
            <ul class="restaurant_quicklinks_main">
                <li>
                    <a href="#">Write A Review</a>
                </li>
                <li>
                    <a href="#">Upload Images</a>
                </li>
                <li>
                    <a href="#">Invite</a>
                </li>
                <li>
                    <a href="#">Share</a>
                </li>
            </ul>
            <ul class="restaurant_quicklinks_sec">
                <li>
                    <a href="#">Request Online Ordering</a>
                </li>
                <li>
                    <p><strong>10</strong> People Requested Online Ordering</p>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="restaurants_info_row_two">
    <div class="rest_info_column_one col-md-4" style="padding-left:0px;">
        <div class="rest_address_info">
            <div class="restaurant_directions">
                <img alt="Map" src="../assets/img/staticmap.jpg" height="135" width="100%">
            </div>
            <div class="clearfix" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                <div class="rating-large floatLeft">
                    <img src="../assets/img/4-stars.jpg" alt="4" />
                    <meta itemprop="ratingValue" content="4">
                </div>
                            <span class="review-count rating-qualifier">
                                <span itemprop="reviewCount">&nbsp;&nbsp;<strong>123 reviews</strong></span>
                            </span>
            </div>
            <span class="restaurants_categories">{{ $r->categories }}</span>

        </div>
    </div>
    <div class="rest_info_column_two col-md-8">
        <div class="restaurants_images">
            <img src="../assets/img/l.jpg" width="30%" />
            <img src="../assets/img/l.jpg" width="30%" />
            <img src="../assets/img/l.jpg" width="30%" />

        </div>
    </div>

</div>
@endforeach
@endsection



@section('recent_review_section')
<div class="rest_review_section col-md-9">
    <div style="width:100%;margin-top:30px;">

    </div>
    <h2>Recent Reviews about {{ $data['restaurant'][0]['name']}}</h2>
    <div id="rest_review_box_container">
        @foreach($data['reviews'] as $rr)
        <div class="rest_review_box">
            <div class="rest_review_user_info col-md-3">
                <p>
                    <span class="review_author">Shelly A.</span>
                    <br/>
                    <span class="review_author_loc">Albuquerque, NM</span>
                    <br/>
                    Reviewed <span class="review_author_highlight">45</span> Restaurants
                    <br/>
                    <span class="review_author_highlight">1234</span> Reviews
                    <br/>
                    <span class="review_author_highlight">4</span> Followers
                </p>
            </div>
            <div class="rest_review_info col-md-9">
                <div class="clearfix" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                    <div class="rating-large floatLeft">
                        <meta itemprop="ratingValue" content="{{ $rr->rating }}">
                    </div>
                </div>
                Reviewed on 7/14/2015 10:10 AM

                <div class="full_review_text">
                    <p>{{ $rr->text }}</p>
                </div>
                <div class="review_quicklinks">
                    <ul class="floatRight">
                        <li>
                            <p>3767 People Thanked for this Review</p>
                        </li>
                        <li>
                            <a href="#">Thank You</a>
                        </li>
                        <li>
                            <a href="#">Share</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

@endforeach
    </div>
</div>

<?php  echo 'Page loaded in ' . microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'] . ' seconds!'; ?>
@endsection


@section('working_hours_section')
<div class="open_close_box">
    <h4>Opening - Close Hours +</h4>
    <p><strong>Today 10.00 Am to 10.00 Pm</strong></p>
</div>
@endsection
@section('specialities_section')
<div class="specialities_box">
    <h4>Specialities</h4>
    <ul>
        <li>Online Ordering</li>
        <li>Accepts Credit Cards</li>
        <li>Take Reservations</li>
        <li>Delivery</li>
    </ul>
</div>
@endsection
@section('other_info_section')
<div class="other_info_box">
    <h4>Other Information</h4>
    <ul>
        <li>
            Parking : <span>Yes</span>
        </li>
        <li>
            Parking : <span>Yes</span>
        </li>
        <li>
            Parking : <span>Yes</span>
        </li>
        <li>
            Parking : <span>Yes</span>
        </li>
        <li>
            Parking : <span>Yes</span>
        </li>
        <li>
            Parking : <span>Yes</span>
        </li>
        <li>
            Parking : <span>Yes</span>
        </li>
        <li>
            Parking : <span>Yes</span>
        </li>
    </ul>
</div>
@endsection
@section('also_viewed_restaurant_section')
<div class="also_viewed_box">
    <h4>People Also Visited</h4>
    <div class="also_visited_rest">
        <div class="also_visited_rest_image floatLeft">
            <img src="../assets/img/cup.jpg" width="100%" />
        </div>
        <div class="also_visited_rest_info floatLeft">
            <p>
                <span class="review_author">Restaurant Name</span>
                <br/>
                <span class="review_author_loc">Scottsdale, AZ</span>
                <br/>
                Reviewes: <span class="review_author_highlight">45</span>
                <br/>
                <span>"Very Good Service"</span>
            </p>
        </div>

    </div>
    <div class="also_visited_rest">
        <div class="also_visited_rest_image floatLeft">
            <img src="../assets/img/cup.jpg" width="100%" />
        </div>
        <div class="also_visited_rest_info floatLeft">
            <p>
                <span class="review_author">Restaurant Name</span>
                <br/>
                <span class="review_author_loc">Scottsdale, AZ</span>
                <br/>
                Reviewes: <span class="review_author_highlight">45</span>
                <br/>
                <span>"Very Good Service"</span>
            </p>
        </div>

    </div>
    <div class="also_visited_rest">
        <div class="also_visited_rest_image floatLeft">
            <img src="../assets/img/cup.jpg" width="100%" />
        </div>
        <div class="also_visited_rest_info floatLeft">
            <p>
                <span class="review_author">Restaurant Name</span>
                <br/>
                <span class="review_author_loc">Scottsdale, AZ</span>
                <br/>
                Reviewes: <span class="review_author_highlight">45</span>
                <br/>
                <span>"Very Good Service"</span>
            </p>
        </div>

    </div>
    <div class="also_visited_rest">
        <div class="also_visited_rest_image floatLeft">
            <img src="../assets/img/cup.jpg" width="100%" />
        </div>
        <div class="also_visited_rest_info floatLeft">
            <p>
                <span class="review_author">Restaurant Name</span>
                <br/>
                <span class="review_author_loc">Scottsdale, AZ</span>
                <br/>
                Reviewes: <span class="review_author_highlight">45</span>
                <br/>
                <span>"Very Good Service"</span>
            </p>
        </div>

    </div>
</div>
@endsection

