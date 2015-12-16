<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 7/14/15
 * Time: 9:58 PM
 */
?>
@extends('write_review_template')

@section('restaurant_info_header')

@foreach($restaurant as $r)
<div class="restaurants_info_row_one">
    <div class="rest_info_column_one col-md-8">
        <h1 itemprop="name">{{ $r->name }}</h1>
        <div class="col-md-6 address-info">
            <p><strong>
                    {{ $r->address_1.', '.$r->address_2 }}<br>
                    {{ $r->city->city.', '.$r->state->short.', '.$r->zip }}
                </strong>
            </p>
            <p>{{ $r->phone }} &nbsp;&nbsp;<a href="{{ $r->website }}">{{ $r->website }}</a></p>
            <p><span class="item-cuisine-type floatRight">{{ $r->categories }}</span></p>
        </div>

    </div>

    <div class="rest_info_column_three col-md-4">
        <div class="rest_info_column_one col-md-12" style="padding-left:0px;">
            <div class="rest_address_info">
                <div class="restaurant_directions">
                    <img alt="Map" src="https://maps.googleapis.com/maps/api/staticmap?center={{$r->latitude}},{{$r->longitude}}&markers=color:red%7Clabel:{{substr($r->name, 0, 1)}}%7C{{$r->latitude}},{{$r->longitude}}&zoom=14&size=280x135&key=AIzaSyBacStrf5mzwW6qrjvEcFq3pIVWH-bEvy0" height="135" width="100%">
                </div>


            </div>
        </div>
    </div>
</div>
<div class="container">
    <h2>Review about this restaurant</h2>
    <br>
    {!! Form::open(array('name'=>'write_review_form','class'=>'write_review_form','route'=>'write-a-review/submit','novalidate'=>'')) !!}
    <label>How do you express this restaurant?</label>
    <br>
    <span id="emofive" class="floatLeft emotions emofive"><input type="radio" name="rating" value="five" onclick="activate_emotion(value);" /></span>
    <span id="emofour" class="floatLeft emotions emofour"><input type="radio" name="rating" value="four" onclick="activate_emotion(value);" /></span>
    <span id="emothree" class="floatLeft emotions emothree"><input type="radio" name="rating" value="three" onclick="activate_emotion(value);" /></span>
    <span id="emotwo" class="floatLeft emotions emotwo"><input type="radio" name="rating" value="two" onclick="activate_emotion(value);" /></span>
    <span id="emoone" class="floatLeft emotions emoone"><input type="radio" name="rating" value="one" onclick="activate_emotion(value);" /></span>
        <textarea style="width: 100%;height: 100px;margin-bottom: 20px;margin-top:15px;" name="text"></textarea>
        <br>
        <input type="hidden" name="rid" value="{{ $r->id }}" />
        <input type="hidden" name="rlink" value="{{ $r->permalink }}" />
        <button>Submit</button>
<br>
    <br>
    </form>
</div>
@endforeach
@endsection


