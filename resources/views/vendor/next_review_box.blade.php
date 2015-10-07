<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 7/23/15
 * Time: 6:33 PM
 */
?>


<div class="rest_review_section col-md-9">
    <div style="width:100%;margin-top:30px;">
        <img src="../assets/img/graph.jpg" alt="" />
    </div>
    <h2>Recent Reviews about </h2>
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
                    </div>
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

{!! str_replace('/?', '?', $data['reviews']->render()) !!}
</div>







