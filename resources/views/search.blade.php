<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 9/14/15
 * Time: 4:55 PM
 */
?>
@extends('app')

@section('content')
<div class="search-section">
    <div class="container">
        <div class="breadcrumb-container">
            <ul class="breadcrumb-item">
                <li class="breadcrub-list">
                   <a href="/"><span>Arizona</span></a>
                    <span class="seperator">></span>
                </li>
                <li class="breadcrub-list">
                    <a href="/"><span>Phoenix</span></a>
                    <span class="seperator">></span>
                </li>
                <li class="breadcrub-list">
                    <a href="/"><span>Restaurants</span></a>
                </li>
            </ul>
        </div>
        <div class="basic-search-wrapper">
            {!! Form::open(array('name'=>'home_search','class'=>'basic-search','route'=>'search','novalidate'=>'')) !!}
                <input type="text" name="keywords" placeholder="Restaurant Name or Cuisine or Keywords " />
                <input type="text" name="location" placeholder="City, State or Zip" />
                <input class="text-search-btn" type="submit" name="Submit" value="Search" />
                <input class="voice-search-btn" type="submit" name="Voice" />
            </form>
        </div>
    </div>
</div>
<div class="search-listing-header">
    <div class="container">
        <div class="search-listing-heading">
            <h2>Best Restaurants in Phoenix, AZ</h2>
        </div>
        <div class="filters">
            <ul class="filters-list">
                <li class="filters-list-item">
                    <a href="/"><span>Cuisine</span></a>
                </li>
                <li class="filters-list-item">
                    <a href="/"><span>Price</span></a>
                </li>
                <li class="filters-list-item">
                    <a href="/"><span>Newest</span></a>
                </li>
                <li class="filters-list-item">
                    <a href="/"><span>Rating</span></a>
                </li>
                <li class="filters-list-item">
                    <a href="/"><span>City</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <div class="container">
        <div class="column-70">
            <div class="search-results">
                @if(count($recent)==0)
                    <p>Sorry no restaurants matches the request. Try again.</p>
                @else

                    @foreach($recent as $r)
                    <div class="search-results-item">
                        <div class="results-item-details">
                            <div class="results-item-logo">
                                <img src="{{ asset('assets/images/restaurants/rest_1.png') }}" alt="Restaurant Name" />
                            </div>
                            <div class="results-item-info">
                                <h3><a href="../public/restaurants/{{ $r->permalink }}" style="color:">{{ $r->name }}</a></h3>
                                <address>
                                    <span class="address-icon"></span><span class="item-address">{{ $r->address_1.' '.$r->address_2}} <br/>{{$r->city->city.', '.$r->state->short.' '.$r->zip }}</span>
                                </address>
                                <span class="phone-number"><span class="phone-icon"></span><span class="item-phone">{{ $r->phone }}</span></span>
                            </div>
                            <div class="results-item-info-two">
                                <p><span class="item-rating"><img src="assets/images/rating.png" alt="2 star" /></span></p>
                                <!--<p><span class="item-review-count">Reviews to be updated</span></p>-->
                                <p><span class="item-cuisine-type">{{ $r->categories }}</span></p>
                            </div>
                        </div>
                        <div class="result-item-reviews">
                            <?php $i = 0; ?>
                            @if(count($r->restaurant_reviews)==0)
                            <p style="color:#2ECC71"><em>Be the first to review this restaurants</em></p>
                            @else

                                @foreach($r->restaurant_reviews as $re)
                                    <?php
                                        if($i >2){
                                            break;
                                        }
                                        $i++;

                                    ?>
                                    <p>{{ shorter($re->text, 300) }}</p>

                                @endforeach
                            @endif
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

        </div>
        <div class="column-30">

            <script type="text/javascript">

                var map;
                function initMap() {
                    <?php
                    $d=0;
                    foreach($recent as $r){
                        if($d ==1){
                        break;
                        }
                        $d++;

                        echo "var map = new google.maps.Map(document.getElementById('map'), {"
                                ."zoom: 3,"
                                ."center: {lat: ".$r->latitude.", lng: ".$r->longitude."}"
                                ."});";
                                }

                    ?>

                    <?php
                    foreach($recent as $r){
                    echo "var marker = new google.maps.Marker({";
                    echo "position: {lat: ".$r->latitude.", lng: ".$r->longitude." },";
                    echo "    map: map,";
                    echo "   title: '".$r->name."'";
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
@endsection