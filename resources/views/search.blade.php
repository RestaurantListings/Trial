@extends('app')

@section('content')
<div class="search-content">
    <div class="container">
        <div class="search-listings">
            <h2>Recommended Restaurants For You</h2>

            @foreach($recent as $r)

            <div class="search-listings-box">
                <div class="sl-image">
                    <img src="{{ $r->img_one }}" alt="" />
                </div>
                <div class="sl-info">
                    <h3>{{ $r->name }}</h3>
                    <p>Breakfast, Chineese</p>
                    <div class="rating">
                        <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                    </div>
                </div>
                <div class="sl-links">
                    <div>
                        <a href="{{ action('WelcomeController@index') }}/restaurants/{{ $r->permalink }}" class="sl-view">View Restaurants</a>
                    </div>
                    <div>
                        <a href="#" class="sl-order">Order Now</a>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
    </div>
</div>
@endsection