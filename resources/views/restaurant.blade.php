<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 7/14/15
 * Time: 9:58 PM
 */
?>
@extends('restaurant_template')

@section('restaurant_info_header')

    @foreach($data['restaurant'] as $r)
        <div class="restaurants_info_row_one">
            <div class="rest_info_column_one col-md-8">
                <h1 itemprop="name">{{ $r->name }}</h1>
                <div class="col-md-6 address-info">
                    <p><strong>
                            {{ $r->address_1.', '.$r->address_2}}<br>
                            {{ $r->city->city.', '.$r->state->short.', '.$r->zip }}
                        </strong>
                    </p>
                    <p>{{ $r->phone }} &nbsp;&nbsp;<a href="{{ $r->website }}">Website</a></p>
                </div>
                <div class="col-md-6 align-right">
                    <div class="clearfix" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating" style="margin-bottom:25px;">
                        <div class="rating-large" style="margin-rightt:10px;">
                            <img src="../assets/images/rating.png" alt="4" />
                            <meta itemprop="ratingValue" content="4">
                        </div>
                        <span class="review-count rating-qualifier" style="float:right;margin-right:10px;">
                            <span itemprop="reviewCount" style="font-family:roboto-regular;font-weight:normal;">123 reviews</span>
                        </span>
                        <br/>
                        <span class="item-cuisine-type floatRight">{{ $r->categories }}</span>
                    </div>


                </div>

            </div>

            <div class="rest_info_column_three col-md-4">
                <div class="rest_info_column_one col-md-12" style="padding-left:0px;">
                    <div class="rest_address_info">
                        <div class="restaurant_directions">
                            <img alt="Map" src="https://maps.googleapis.com/maps/api/staticmap?center={{$r->latitude}},{{$r->longitude}}&zoom=14&size=280x135&key=AIzaSyBacStrf5mzwW6qrjvEcFq3pIVWH-bEvy0" height="135" width="100%">
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="restaurants_info_row_two">
            <div class="restaurant_quicklinks">
                <ul class="restaurant_quicklinks_main">
                    <li>
                        <a href="#" class="btn-rl-default">Write An Anonymous Review</a>
                    </li>
                    <!--
                    <li>
                        <a href="#">Upload Images</a>
                    </li>
                    <li>
                        <a href="#">Invite</a>
                    </li>
                    <li>
                        <a href="#">Share</a>
                    </li>
                    -->
                    <li>
                        {!! Form::open(array('name'=>'home_search','class'=>'basic-search','novalidate'=>'')) !!}
                        </form>
                        <button class="request_order_btn btn-rl-default" type="button" onclick="request_online_order(<?php echo $r->id; ?>);">Request Online Ordering</button>
                    </li>
                    <li>

                        <p><strong>{{ $r->request_order }}</strong> People Requested</p>

                    </li>
                </ul>

                <!-- Online Order Request Modal Begins-->
                <div class="modal fade" id="onlineOrderRequestModal" tabindex="-1" role="dialog" aria-labelledby="onlineOrderRequestModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            {!! Form::open(array('name'=>'request_online_ordering','class'=>'request','route'=>'request_online_ordering','method'=>'post','novalidate'=>'')) !!}
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Online Ordering - Request Form </h4>
                            </div>
                            <div class="modal-body">

                                    <div class="form-group">
                                        <label for="guest_first_name">First Name</label>
                                        <input type="text" class="form-control" name="guest_first_name" value="" placeholder="First Name" />
                                        <label for="guest_last_name">Last Name</label>
                                        <input type="text" class="form-control" name="guest_last_name" value="" placeholder="Last Name" />
                                        <label for="guest_email">Email Address</label>
                                        <input type="email" class="form-control" name="guest_email" value="" placeholder="Email Address" required />
                                        <input type="hidden" name="r_t" value="1" />
                                        <input type="hidden" name="rlink" value="{{ $r->permalink }}" />
                                        <input type="hidden" name="r_id" value="{{ $r->id }}" />
                                        </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Alert Me!</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Online Ordering Request Modal Ends-->

            </div>

            <!--
            <div class="rest_info_column_two col-md-8">
                <div class="restaurants_images">
                    <img src="{{ $r->img_one }}" width="30%" />
                    <img src="{{ $r->img_two }}" width="30%" />
                    <img src="{{ $r->img_three }}" width="30%" />
                </div>
            </div>
            -->
        </div>
    @endforeach
@endsection



@section('recent_review_section')
<div class="rest_review_section col-md-8" style="background-color:#ffffff;">
    <br>
    <h2>Healthy Food suggestions</h2>
    <p style="color:#2ECC71;padding-left:15px;"><em>Sorry, we don't have best healthy food suggestion for this restaurants.</em></p>

    <div class="col-md-12">

        <!-- Button trigger Healthy Food Alert Modal -->
        <button type="button" class="btn btn-sm btn-rl-default" data-toggle="modal" data-target="#healthyFoodAlertModal">
            Alert Me When Available
        </button>

        <!-- Healthy Food Alert Modal Ends-->
        <div class="modal fade" id="healthyFoodAlertModal" tabindex="-1" role="dialog" aria-labelledby="healthyFoodAlertModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {!! Form::open(array('name'=>'request_online_ordering','class'=>'request','route'=>'request_online_ordering','method'=>'post','novalidate'=>'')) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Healthy Food Available Alert - Request Form </h4>
                    </div>
                    <div class="modal-body">

                            <div class="form-group">
                                <label for="guest_first_name">First Name</label>
                                <input type="text" class="form-control" name="guest_first_name" value="" placeholder="First Name" />
                                <label for="guest_last_name">Last Name</label>
                                <input type="text" class="form-control" name="guest_last_name" value="" placeholder="Last Name" />
                                <label for="guest_email">Email Address</label>
                                <input type="email" class="form-control" name="guest_email" value="" placeholder="Email Address" required />
                                <input type="hidden" name="r_t" value="2" />
                                <input type="hidden" name="rlink" value="{{ $r->permalink }}" />
                                <input type="hidden" name="r_id" value="{{ $r->id }}" />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Alert Me!</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Healthy Food Alert Modal Ends-->

    </div>
    <br>
    <br>
    <h2>Recent Reviews about {{ $data['restaurant'][0]['name']}}</h2>
    @foreach($data['restaurant'] as $rr)
        @if(count($rr->restaurant_reviews)==0)
            <p style="color:#2ECC71;padding-left:15px;"><em>Be the first to review this restaurants.</em></p>
        @else
            @foreach($rr->restaurant_reviews as $reviews)


                <div class="rest_review_box">

                    <div class="rest_review_info col-md-12" style="padding-left:20px;padding-right:20px;">
                        <div class="clearfix" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                            <div class="rating-large floatLeft">
                                <!--<i class="star-img stars_3_half" title="{{ $rr->rating }} star rating">
                                    <img alt="{{ $rr->rating }} star rating" class="offscreen" src="" height="303" width="84">
                                </i>-->
                                <img src="../assets/images/rating.png" alt="{{ $reviews->rating }}" />
                                <meta itemprop="ratingValue" content="{{ $rr->rating }}">
                            </div>
                            <div style="float:right;height:60px;width:150px;text-align:right;">
                                <?php
                                    if($rr->source == 'yelp')
                                    {
                                    ?>
                                    <a href="{{ $reviews->source_link }}" target="_blank">
                                        <img src="../assets/img/yelp.jpg" alt="" />
                                    </a>
                                    <?php
                                    }
                                if($rr->source == 'tripadvisor')
                                {
                                    ?>
                                    <a href="{{ $reviews->source_link }}" target="_blank">
                                    <img src="../assets/img/tripadvisor.jpg" alt="" />
                                    </a>
                                <?php
                                }
                                if($rr->source == 'urbanspoon')
                                {
                                    ?>
                                    <a href="{{ $reviews->source_link }}" target="_blank">
                                    <img src="../assets/img/zomato.jpg" alt="" />
                                    </a>
                                <?php
                                }
                                if($rr->source == 'rl')
                                {
                                    ?>
                                    <a href="{{ $reviews->source_link }}" target="_blank">
                                    <img src="../assets/img/rl.jpg" alt="" />
                                    </a>
                                <?php
                                }
                                if($rr->source == 'google')
                                {
                                    ?>
                                    <a href="{{ $reviews->source_link }}" target="_blank">
                                    <img src="../assets/img/google.png" alt="" />
                                    </a>
                                <?php
                                }


                                ?>

                            </div>
                        </div>
                        <br/>
                        Reviewed on 7/14/2015 10:10 AM

                        <div class="full_review_text">
                            <p>{{ $reviews->text }}</p>
                        </div>
                        <br/>
                        <div class="review_quicklinks">
                            <ul class="floatRight">
                                <!--<li>
                                    <p>3767 People Thanked for this Review</p>
                                </li>-->
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
        @endif
    @endforeach
</div>
@endsection

@section('working_hours_section')
    @foreach($data['restaurant'] as $r)
        <div class="open_close_box">
            <h4>Opening - Close Hours</h4>
            <!--<p><strong>Today 10.00 Am to 10.00 Pm</strong></p>-->
            <?php
            if($r->restaurants_info->hours != NULL){
                $hours = str_replace('||', '<br>',$r->restaurants_info->hours);
                $hours = str_replace('-->', ': ',$hours);
                $hours = str_replace(',Open now', '',$hours);
                echo $hours;
            }else{
                echo '<p style="color:#adadad;">Sorry, Store hours have not been updated. If you are the owner of this restaurants. Please update the store hours.</p>';
            }
            ?>
        </div>
    @endforeach
@endsection
@section('specialities_section')
<div class="specialities_box">
    <h4>Specialities</h4>
    <?php
    if($r->restaurants_info->more_info != NULL){
        $more_info = str_replace('-->', ':', $r->restaurants_info->more_info);
        $more_info = str_replace('|', '<br>', $more_info);
        echo $more_info;
    }else{
        echo '<p style="color:#adadad;">Sorry, no additional information is available to display.</p>';
    }
    ?>
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
            Take-Out : <span>Yes</span>
        </li>
        <li>
            Ambience : <span>Trendy</span>
        </li>
        <li>
            Good For Kids : <span>Yes</span>
        </li>
        <li>
            Dogs Allowed : <span>No</span>
        </li>
        <li>
            Wifi : <span>No</span>
        </li>
        <li>
            TV : <span>Yes</span>
        </li>
        <li>
            Caters : <span>Yes</span>
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

