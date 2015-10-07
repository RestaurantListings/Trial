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
<!-- SCRIPT FOR GOOGLE MAP API V3 STARTS HERE -->
<style type="text/css">
    .search_listing_filter{background-color:#b50a03;color:#ffffff;}

    .search_listing_filter ul li{list-style-type:none;float:left;margin:0px 20px;width:16%;line-height:30px;}
    .search_list{overflow:scroll;}
    .search_list ul li{list-style-type:none;border-bottom:1px solid #aaaaaa;overflow:hidden;background-color:#EFEFEF;}
    .search_list ul li:hover{background-color:#ffffff;cursor:pointer;}
    .search_list ul li div{width:100%;height:auto;padding:10px;text-align:left;}
    .search_list ul li div.list_image{max-height:80px;overflow:hidden;margin-bottom:10px;}
    .search_list ul li div h4{margin:0px 0px;font-size:15px;}
    .search_list ul li div p{margin:0px 0px;font-size:12px;}
    #map { height: 600px;width:100%; }
    .listing_pagination{width:100%;}
    .listing_pagination ul{text-align:center;}
    .listing_pagination ul li{float:left;margin:0px 10px;color:#b50a03;}
</style>

<script type="text/javascript">

    var map;
    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: {lat: 38.0000, lng: -100.0000}
        });
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

<!-- SCRIPT FOR GOOGLE MAP API V3 STARTS HERE -->
<div class="search-content">
    <div class="container">
        <div class="search-listings">
            <h1>Recommended Restaurants For You</h1>



            <div class="search_listing_filter" style="width:100%;height:30px;border:1px solid #cdcdcd;">
                <ul>
                    <li><span>Cuisine</span></li>
                    <li><span>Rating</span></li>
                    <li><span>Prize Range</span></li>
                    <li><span>City</span></li>
                    <li><span>Most Visited</span></li>
                </ul>
            </div>
            <div style="float:left;width:50%;height:600px;">
                <div id="map"></div>
            </div>
            <div style="width:100%; height:600px;background-color:#ededee;">
                <div style="float:left;width:50%;height:100%;" class="search_list">
                    <ul>
                        @foreach($recent as $r)
                        <li>
                            <a href="../public/restaurants/{{ $r->permalink }}">
                                <div class="list_image" style="float:left;width:18%;height:100%;display:inline-table;">
                                    <img src="{{ $r->img_one }}" alt="" width="100px" />
                                </div>
                                <div style="width:98%;">
                                    <h4 style="color:#333;font-family: trocchi;font-size: 14px;">{{ $r->name }}
                                    <span style="float:right;">
                                            <?php
                                            $rating = $r->rank;
                                            switch($rating)
                                            {
                                                case 0:
                                                    echo '<span style="color:#ff0000;font-style:italic;font-weight:normal;font-size:11px;">Be the first to rate.</span>';
                                                    break;
                                                case 1:
                                                    echo '<img src="assets/images/rating.png" alt="2 star" />';
                                                    break;
                                                case 2:
                                                    echo '<img src="assets/images/rating.png" alt="2 star" />';
                                                    break;
                                                case 3:
                                                    echo '<img src="assets/images/rating.png" alt="2 star" />';
                                                    break;
                                                case 4:
                                                    echo '<img src="assets/images/rating.png" alt="2 star" />';
                                                    break;
                                                case 5:
                                                    echo '<img src="assets/images/rating.png" alt="2 star" />';
                                                    break;
                                            }
                                            ?>
                                        </span>
                                    </h4>
                                    <p style="margin-top:7px;font-family: lato;font-size: 14px;">
                                        <strong><span>{{ $r->address_1 }}, {{ $r->address_2 }}, {{ $r->city['short'] }}, {{ $r->state['short'] }}</span></strong>
                                        <Strong><span style="float:right;margin-top:-5px;" class="item-cuisine-type">{{ $r->categories }}</span></Strong>
                                    </p>
                                    <p style="margin-top:10px;font-family:lato;font-style:italic;font-size:14px;"><span class="icon-comment"></span>Make every kickoff count with the Weekend Lineup menu - this season's playbook of eats and drinks. Try our NEW Lobster & Crab Omelet! </p>
                                    <p style="margin-top:10px;font-family:lato;font-style:italic;font-size:14px;"><span class="icon-comment"></span>We finished with the mango sticky rice with coconut ice cream.  •  I'll be back to try the Corn Fritters and Crying Tiger as well ! </p>
                                    <p style="margin-top:10px;font-family:lato;font-style:italic;font-size:14px;"><span class="icon-comment"></span>That Dutch Crunch bread is the way, the truth, and the light.  •  I highly recommend Meatheadz anytime of the day, everyday!</p>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>


            </div>
            <div class="listing_pagination">
                <ul>
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>6</li>
                    <li>7</li>
                    <li>8</li>
                    <li>9</li>
                    <li>10</li>
                </ul>

            </div>



        </div>
    </div>
</div>
@endsection