<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 7/14/15
 * Time: 9:58 PM
 */
?>
@extends('mobile_write_review_template')

@section('write_a_review_form')

@foreach($restaurant as $r)
<div class="restaurants_info_row_one">
    <div class="rest_info_column_one col-md-12">
        <div class="col-md-12 address-info">
            <h2 itemprop="name">{{ $r->name }}</h2>
            <p><strong>
                    {{ $r->address_1.', '.$r->address_2 }}<br>
                    {{ $r->city->city.', '.$r->state->short.', '.$r->zip }}
                </strong>
            </p>
            <p>{{ $r->phone }} <br><a href="{{ $r->website }}">{{ $r->website }}</a></p>
            <p><b><span class="item-cuisine-type floatRight">{{ $r->categories }}</span></b></p>
            <br>
        </div>
    </div>
</div>
<div class="container">
    <h4>Write your review about this restaurant</h4>
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
        <button class="full-width-btn btn-rl-default">Submit</button>
<br>
    <br>
    </form>
</div>
@endforeach
@endsection


