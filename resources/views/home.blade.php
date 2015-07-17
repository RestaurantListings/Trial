@extends('app')

@section('banner')
<!-- Banner Section - Begins -->
<div class="home-banner">
    <div class="container home-banner-image">
        <div class="home-headline">
            <!--<h1>Order from +300 cities in USA</h1>-->
            <h1>IF THERE IS FOOD, WE WILL FIND IT</h1>
            <h2>Find Your Favourite Restaurants and Favourite Dishes</h2>

        </div>
        <div class="locator-form">
            <!--<form action="http://restaurantlistings.com/dev/public/search" method="post">-->
            {!! Form::open(array('name'=>'home_search','route'=>'search','novalidate'=>'')) !!}
            <div id="the-basics">
                {!! Form::text('restaurant_name', null, ['class'=>'typehead', 'placeholder'=>'Restaurant Name', 'id'=>'restaurant_name']) !!}
                <span class="or-span">OR</span>
                {!! Form::text('state', null, ['class'=>'typehead', 'placeholder'=>'State of USA', 'id'=>'state']) !!}
                {!! Form::text('city', null, ['class'=>'typehead', 'placeholder'=>'City', 'id'=>'city']) !!}
                <span class="or-span">OR</span>
                {!! Form::text('zip', null, ['class'=>'typehead', 'placeholder'=>'Zip Code', 'id'=>'zip']) !!}
            </div>

            <div class="search-btn">
                <button type="submit">SEARCH NOW</button>
                <button type="submit" class="voice-btn"></button>
            </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('cuisine')
<!-- Category/Cuisine Section -->
<div class="cuisine-section">
    <div class="container">
        <h2>Choose From Your Favourite Cuisine</h2>
        <div class="cuisine-wrapper">
            <div class="home-cuisine-box pizza-cuisine">
                <h3>Pizza</h3>
            </div>
            <div class="home-cuisine-box sushi-cuisine">
                <h3>Sushi</h3>
            </div>
            <div class="home-cuisine-box indian-cuisine">
                <h3>Indian</h3>
            </div>
            <div class="home-cuisine-box chineese-cuisine">
                <h3>Chineese</h3>
            </div>
            <div class="home-cuisine-box thai-cuisine">
                <h3>Thai</h3>
            </div>
        </div>
    </div>
</div>
@endsection

@section('recent_restaurant')
<!-- New Restaurants -->
<div class="new-restaurants-section">
    <div class="container">
        <h2>Restaurants Listed Recently</h2>
        <div class="content-wrapper">
            @foreach($recent_restaurants as $r)

            <div class="new-restaurant-box">
                <div class="nr-logo">
                    <img src="{{ $r->img_one }}" alt="Restaurant Name" width="100%" />
                </div>
                <div class="nr-info">
                    <h3>{{ $r->name }}</h3>
                    <h4>{{ $r->categories }}</h4>
                    <div class="rating">
                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                        <p class="review"><span>111&nbsp;</span>Reviews</p>
                    </div>
                    <p>{{ $r->address_1.' '.$r->address_2}} <br/>{{$r->city->city.' '.$r->state->state.' '.$r->zip }} </p>
                    <p>Phone number {{ $r->phone }}</p>
                </div>
                <div class="nr-quicklinks">
                    <a href="../public/restaurants/{{ $r->permalink }}" class="visit-btn">VISIT</a>
                    <a href="#" class="order-btn">ORDER</a>
                </div>
            </div>

            @endforeach

        </div>
    </div>
</div>
<!--Review, Dishes, Popular Section -->
<div class="popular-section">
    <div class="container" style="background-color:#fff;">

        <div class="recent-reviews">
            <h3>Recent Reviews</h3>
            <div class="recent-reviews-list">
                <div class="review-user-info">
                    <img src="assets/img/default_profile_image.png" alt="" />
                    <p class="float:left;"><span class="review-author">Tommy</span> reviewed on <i>3/7/2015 5:54pm</i></p>
                    <div class="rating">
                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                    </div>
                </div>
                <p>Well this waiter i got she is indian and she is like the best she is out going laughing with us and she was all over are drinks we did not even have tell her ee needed more drink and she was just the shit and excuse my franch but she is also good good looking too. her name is tessa and i been in here a lot and i might of been out of it but she is an angle and best waiter. if i wss u guys i would give her a raise and one more thing i bet she has one good looking guy because she is sex and hard worker. o my god is that her baby too? Okay god has or i mean u guess just created the most brautiful baby ever.</p>
            </div>
            <div class="recent-reviews-list">
                <div class="review-user-info">
                    <img src="assets/img/default_profile_image.png" alt="" />
                    <p class="float:left;"><span class="review-author">Michele</span> reviewed on <i>3/7/2015 5:54pm</i></p>
                    <div class="rating">
                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                    </div>
                </div>
                <p>The Restaurant is good. The service is fair. </p>
            </div>
            <div class="recent-reviews-list">
                <div class="review-user-info">
                    <img src="assets/img/default_profile_image.png" alt="" />
                    <p class="float:left;"><span class="review-author">Cris</span> reviewed on <i>3/7/2015 5:54pm</i></p>
                    <div class="rating">
                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                    </div>
                </div>
                <p>Second visit at this SmashBurger. Definitely a drop off in service. We arrived around 5 PM on a Sunday. There were four tables full, inside and out. We stepped up right away to order but the...</p>
            </div>
            <div class="recent-reviews-list">
                <div class="review-user-info">
                    <img src="assets/img/default_profile_image.png" alt="" />
                    <p class="float:left;"><span class="review-author">Elizabeth</span> reviewed on <i>2015-03-26 03:44am</i></p>
                    <div class="rating">
                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                    </div>
                </div>
                <p>The Restaurant is good. The service is fair. </p>
            </div>
            <div class="recent-reviews-list">
                <div class="review-user-info">
                    <img src="assets/img/default_profile_image.png" alt="" />
                    <p class="float:left;"><span class="review-author">John Doe</span> reviewed on <i>2015-03-19 10:04pm</i></p>
                    <div class="rating">
                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                    </div>
                </div>
                <p>good restuarent.... nice food.... </p>
            </div>
        </div>
        <!--<div class="popular-dishes">

        </div>-->
        <div class="popular-restaurants">

        </div>
    </div>
</div>
@endsection

