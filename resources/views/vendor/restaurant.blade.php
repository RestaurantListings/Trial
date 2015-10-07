<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 7/14/15
 * Time: 9:58 PM
 */
?>
@extends('restaurant_template')


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
               <img alt="Map" src="http://maps.google.com/maps/api/staticmap?scale=2&amp;center=33.490310%2C-111.926450&amp;language=en&amp;zoom=15&amp;markers=scale%3A2%7Cshadow%3Afalse%7Cicon%3Ahttp%3A%2F%2Fyelp-images.s3.amazonaws.com%2Fassets%2Fmap-markers%2Fannotation_64x86.png%7C33.490310%2C-111.926450&amp;client=gme-yelp&amp;sensor=false&amp;size=286x135&amp;signature=UqHUGvCA_PyMwxJNTPJssFuPs1E=" height="135" width="100%">
            </div>
            <div class="clearfix" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                <div class="rating-large floatLeft">
                    <!--<i class="star-img stars_3_half" title="3.5 star rating">
                        <img alt="3.5 star rating" class="offscreen" src="" height="303" width="84">
                    </i>-->
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
            <img src="{{ $r->img_one }}" width="30%" />
            <img src="{{ $r->img_two }}" width="30%" />
            <img src="{{ $r->img_three }}" width="30%" />

        </div>
    </div>
</div>
@endforeach
@endsection



@section('recent_review_section')
<div class="rest_review_section col-md-9">
    <div style="width:100%;margin-top:30px;">
        <img src="../assets/img/graph.jpg" alt="" />
    </div>
    <h2>Recent Reviews about {{ $data['restaurant'][0]['name']}}</h2>
    <div id="rest_review_box_container">
        @foreach($data['reviews'] as $rr)
        <div class="rest_review_box">
            <div class="rest_review_user_info col-md-3">
                <!--<div class="rest_review_user_image">
                    <img src="http://s3-media3.fl.yelpcdn.com/photo/uFUXBBKt_GBznUgrRR0STQ/60s.jpg" width="100%" />
                </div>-->
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
                        <!--<i class="star-img stars_3_half" title="{{ $rr->rating }} star rating">
                            <img alt="{{ $rr->rating }} star rating" class="offscreen" src="" height="303" width="84">
                        </i>-->
                        <img src="../assets/img/4-stars.jpg" alt="{{ $rr->rating }}" />
                        <meta itemprop="ratingValue" content="{{ $rr->rating }}">
                    </div><!--
                    <div style="float:right;height:60px;width:150px;text-align:right;">
                        <?php
                        if($rr->source == 'yelp')
                        {
                            ?>
                            <a href="{{ $rr->source_link }}" target="_blank">
                                <img src="../assets/img/yelp.jpg" alt="" />
                            </a>
                        <?php
                        }
                        if($rr->source == 'tripadvisor')
                        {
                            ?>
                            <a href="{{ $rr->source_link }}" target="_blank">
                                <img src="../assets/img/tripadvisor.jpg" alt="" />
                            </a>
                        <?php
                        }
                        if($rr->source == 'urbanspoon')
                        {
                            ?>
                            <a href="{{ $rr->source_link }}" target="_blank">
                                <img src="../assets/img/zomato.jpg" alt="" />
                            </a>
                        <?php
                        }
                        if($rr->source == 'rl')
                        {
                            ?>
                            <a href="{{ $rr->source_link }}" target="_blank">
                                <img src="../assets/img/rl.jpg" alt="" />
                            </a>
                        <?php
                        }
                        if($rr->source == 'google')
                        {
                            ?>
                            <a href="{{ $rr->source_link }}" target="_blank">
                                <img src="../assets/img/google.png" alt="" />
                            </a>
                        <?php
                        }


                        ?>

                    </div>-->
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
    {!! str_replace('/?', '?', $data['reviews']->render()) !!}
    <!--<ul class="pagination">
        <li class="active"></li>
        <li> <a href="next_reviews/{{ $r->id }}"></a></li>

    </ul>
    <!--<ul class="pagination">
        <li class="active"><span>1</span></li>
        <li><a href="{{ action('WelcomeController@index') }}/restaurants/next_reviews/?page=2">2</a></li>
    </ul>-->


</div>
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
            <img src="http://s3-media3.fl.yelpcdn.com/photo/uFUXBBKt_GBznUgrRR0STQ/60s.jpg" width="100%" />
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
            <img src="http://s3-media3.fl.yelpcdn.com/photo/uFUXBBKt_GBznUgrRR0STQ/60s.jpg" width="100%" />
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
            <img src="http://s3-media3.fl.yelpcdn.com/photo/uFUXBBKt_GBznUgrRR0STQ/60s.jpg" width="100%" />
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
            <img src="http://s3-media3.fl.yelpcdn.com/photo/uFUXBBKt_GBznUgrRR0STQ/60s.jpg" width="100%" />
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