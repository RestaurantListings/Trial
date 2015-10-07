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
            <h2>Recommended Restaurants For You</h2>



            <div class="search_listing_filter" style="width:100%;height:30px;border:1px solid #cdcdcd;">
                <ul>
                    <li><span>Cuisine</span></li>
                    <li><span>Rating</span></li>
                    <li><span>Prize Range</span></li>
                    <li><span>City</span></li>
                    <li><span>Most Visited</span></li>
                </ul>
            </div>
            <div style="float:left;width:75%;height:600px;">
                <div id="map"></div>
            </div>
            <div style="width:100%; height:600px;background-color:#ededee;">
                <div style="float:left;width:25%;height:100%;" class="search_list">
                    <ul>
                        @foreach($recent as $r)
                        <li>
                            <a href="">
                            <div class="list_image" style="float:left;width:30%;">
                                <img src="{{ $r->img_one }}" alt="" width="100px" />
                            </div>
                            <div style="padding-left:90px;">
                                <h4>{{ $r->name }}</h4>
                                <p>{{ $r->categories }}</p>
                                <?php
                                $rating = $r->rank;
                                switch($rating)
                                {
                                    case 0:
                                        echo "<p>Not Yet Rated</p>";
                                        break;
                                    case 1:
                                        echo "<span>☆</span>";
                                        break;
                                    case 2:
                                        echo "<span>☆</span><span>☆</span>";
                                        break;
                                    case 3:
                                        echo "<span>☆</span><span>☆</span><span>☆</span>";
                                        break;
                                    case 4:
                                        echo "<span>☆</span><span>☆</span><span>☆</span><span>☆</span>";
                                        break;
                                    case 5:
                                        echo "<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>";
                                        break;
                                }
                                ?>
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