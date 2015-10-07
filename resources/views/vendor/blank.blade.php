<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 7/23/15
 * Time: 11:24 PM
 */
?>
@foreach($data['reviews'] as $rr)
        <p>
            <span class="review_author">Shelly A.</span>
            <br/>
            <span class="review_author_loc">Albuquerque, NM</span>
            <!--<br/>
            Reviewed <span class="review_author_highlight">45</span> Restaurants
            <br/>
            <span class="review_author_highlight">1234</span> Reviews
            <br/>
            <span class="review_author_highlight">4</span> Followers-->
        </p>

                <meta itemprop="ratingValue" content="{{ $rr->rating }}">


        Reviewed on 7/14/2015 10:10 AM

            <p>{{ $rr->text }}</p>

@endforeach


<?php  echo 'Page loaded in ' . microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'] . ' seconds!'; ?>




--------------------------------------------------------------------------------------------------------------------------






