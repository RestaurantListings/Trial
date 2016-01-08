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

            <button class="request_order_btn btn-rl-default floatLeft" type="button" data-toggle="modal" data-target="#onlineOrderRequestModal">Request Online Ordering</button>

            <p><strong>&nbsp;&nbsp;&nbsp;&nbsp;{{ $r->request_order }} People Requested</strong></p>
            <p id="request_message"><br></p>
            <br>
            <div class="rest_info_column_one col-md-8">

                <h1 itemprop="name">{{ $r->name }}</h1>
                <div class="col-md-6 address-info">
                    <p><strong>
                            {{ $r->address_1.', '.$r->address_2 }}<br>
                            {{ $r->city->city.', '.$r->state->short.', '.$r->zip }}
                        </strong>
                    </p>
                    <p>{{ $r->phone }} <br><a href="{{ $r->website }}">{{ $r->website }}</a></p>
                    <a href="{{ url('get-directions/'.$r->permalink) }}">Get Drections</a>
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
                            <img alt="Map" src="https://maps.googleapis.com/maps/api/staticmap?center={{$r->latitude}},{{$r->longitude}}&markers=color:red%7Clabel:{{substr($r->name, 0, 1)}}%7C{{$r->latitude}},{{$r->longitude}}&zoom=14&size=280x135&key=AIzaSyBacStrf5mzwW6qrjvEcFq3pIVWH-bEvy0" height="135" width="100%">
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="restaurants_info_row_two">
            <div class="restaurant_quicklinks">
                
                <!-- Online Order Request Modal Begins-->
                <div class="modal fade" id="onlineOrderRequestModal" tabindex="-1" role="dialog" aria-labelledby="onlineOrderRequestModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            {!! Form::open(array('name'=>'request_online_ordering','class'=>'request','onsubmit'=>'return request_online_order('.$r->id.')','route'=>'request_online_ordering','method'=>'post','novalidate'=>'')) !!}
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

    <?php

    ?>
    @if($data['logged_in'] == 1)
        @if($data['do_you_have'] == 1)

        @else
            <!-- Do-you-have Modal Begins -->
            <div class="modal fade" id="doYouHaveModal" tabindex="-1" role="dialog" aria-labelledby="doYouHaveModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Fill this form to get healthy meal suggestions.</h4>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(array('url'=>'account/doyouhaveregister','name'=>'do_you_have_form','method'=>'post', 'id'=>'do-you-have-form')) !!}
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" required />
                                </div>
                            </div>

                            <label for="email-address">Email</label>
                            <input type="email" name="email-address" id="email-address" class="form-control" required />
                            <label for="do-you-have">Do you have the following?</label>
                            <div class="btn-group green-hover" data-toggle="buttons">
                                <label class="btn btn-primary">
                                    <input type="checkbox" name="diabetic" autocomplete="off"> Diabetic
                                </label>
                                <label class="btn btn-primary">
                                    <input type="checkbox" name="cholesterol" autocomplete="off"> Cholesterol
                                </label>
                                <label class="btn btn-primary">
                                    <input type="checkbox" name="hbp" autocomplete="off"> High Blood Pressure
                                </label>
                                <label class="btn btn-primary">
                                    <input type="checkbox" name="weightloss" autocomplete="off"> Weight Loss
                                </label>
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @else
<!-- Do-you-have Modal Begins -->
<div class="modal fade" id="doYouHaveModal" tabindex="-1" role="dialog" aria-labelledby="doYouHaveModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Fill this form to get healthy meal suggestions.</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url'=>'account/doyouhaveregister','name'=>'do_you_have_form','method'=>'post', 'id'=>'do-you-have-form')) !!}
                <div class="row">
                    <div class="col-md-6">
                        <label for="first-name">First Name</label>
                        <input type="text" name="first-name" id="first-name" class="form-control" required />
                    </div>
                    <div class="col-md-6">
                        <label for="last-name">Last Name</label>
                        <input type="text" name="last-name" id="lastname" class="form-control" required />
                    </div>
               </div>

                <label for="email-address">Email</label>
                <input type="email" name="email-address" id="email-address" class="form-control" required />
                <label for="phone-no">Phone No</label>
                <input type="text" name="phone-no" id="phone-no" class="form-control" required />
                <label for="do-you-have">Do you have the following?</label>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <input type="checkbox" name="diabetic" autocomplete="off"> Diabetic
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" name="cholesterol" autocomplete="off"> Cholesterol
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" name="hbp" autocomplete="off"> High Blood Pressure
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" name="weightloss" autocomplete="off"> Weight Loss
                    </label>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary do-you-have-login-btn">Save changes</button>
            </div>
        </div>
    </div>
</div>
    @endif
<!-- Do-you-have Modal Ends -->
@endsection



@section('recent_review_section')
<!-- Calculate Modal Begins-->
<!-- Cholesterol Modal Begins-->
<div class="modal fade" id="cholesterolModal" tabindex="-1" role="dialog" aria-labelledby="cholesterolModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Fill this to get healthy meals of cholesterol free </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url'=>'suggestions/cholesterol_meals','name'=>'cholesterol_suggestions_form','method'=>'post', 'id'=>'cholesterol_suggestions_form')) !!}
                @if($data['logged_in'] != 1)
                <div class="row">
                    <div class="col-md-6">
                        <label for="first-name">First Name</label>
                        <input type="text" name="first-name" id="first-name" class="form-control" required />
                    </div>
                    <div class="col-md-6">
                        <label for="last-name">Last Name</label>
                        <input type="text" name="last-name" id="lastname" class="form-control" required />
                    </div>
                </div>

                <label for="email-address">Email</label>
                <input type="email" name="email-address" id="email-address" class="form-control" required />
                <label for="phone-no">Phone No</label>
                <input type="text" name="phone-no" id="phone-no" class="form-control" required />
                <label for="do-you-have">Do you have the following?</label>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <input type="checkbox" name="diabetic" autocomplete="off"> Diabetic
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" name="cholesterol" autocomplete="off"> Cholesterol
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" name="hbp" autocomplete="off"> High Blood Pressure
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" name="weightloss" autocomplete="off"> Weight Loss
                    </label>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <select name="age" id="age" class="form-control selectbox-size-one">
                                <?php
                                for($i=18; $i <= 100; $i++)
                                {
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control selectbox-size-one">
                                <option value="m">M</option>
                                <option value="f">F</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="race">Race</label>
                            <select name="race" id="race" class="form-control">
                                <option value="AA">African American</option>
                                <option value="O">Others</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total-cholesterol">Total Cholesterol</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">mg/dL</span>
                                        <input type="text" name="total-cholesterol" id="total-cholesterol" class="form-control inputbox-size-one" value="" placeholder="130-320" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hdl-cholesterol">HDL cholesterol</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">mg/dL</span>
                                        <input type="text" name="hdl-cholesterol" id="hdl-cholesterol" class="form-control inputbox-size-one" value="" placeholder="20-100" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="systolic-blood-pressure">Systolic Blood Pressure</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">mmHg</span>
                                        <input type="text" name="systolic-blood-pressure" id="systolic-blood-pressure" class="form-control inputbox-size-one" value="" placeholder="90-200" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="diastolic-blood-pressure">Diastolic Blood Pressure</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">mmHg</span>
                                        <input type="text" name="diastolic-blood-pressure" id="diastolic-blood-pressure" class="form-control inputbox-size-one" value="" placeholder="30-140" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="treated-hbp">Treated for High Blood Pressure</label>
                            <select name="treated-hbp" id="treated-hbp" class="form-control selectbox-size-one">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="diabetes">Diabetes</label>
                            <select name="diabetes" id="diabetes" class="form-control selectbox-size-one">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="smoker">Smoker</label>
                            <select name="smoker" id="smoker" class="form-control selectbox-size-one">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="body-weight">Body Weight</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">lbs</span>
                                        <input type="text" name="body-weight-lbs" id="body-weight-lbs" class="form-control inputbox-size-one" value="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="body-height">Body Height</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">ft</span>
                                        <input type="text" name="body-height-ft" id="body-height-ft" class="form-control inputbox-size-one floatLeft" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">in</span>
                                        <input type="text" name="body-height-in" id="body-height-in" class="form-control inputbox-size-one floatLeft" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($data['restaurant'] as $r)
                    <input type="hidden" name="rid" id="rid" value="{{ $r->id }}" />
                @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary cholesterol-suggestions-btn">Get Suggestions</button>
            </div>

        </div>
    </div>
</div>
<!-- Cholesterol Modal Ends-->
<!-- High Blood Pressure Modal Begins-->
<div class="modal fade" id="highBPModal" tabindex="-1" role="dialog" aria-labelledby="highBPModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Fill in to get the best meals for High Blood Pressure</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url'=>'suggestions/highbp_meals','name'=>'highbp_suggestions_form','method'=>'post', 'id'=>'highbp_suggestions_form')) !!}
                @if($data['logged_in'] != 1)
                <div class="row">
                    <div class="col-md-6">
                        <label for="first-name">First Name</label>
                        <input type="text" name="first-name" id="first-name" class="form-control" required />
                    </div>
                    <div class="col-md-6">
                        <label for="last-name">Last Name</label>
                        <input type="text" name="last-name" id="lastname" class="form-control" required />
                    </div>
                </div>

                <label for="email-address">Email</label>
                <input type="email" name="email-address" id="email-address" class="form-control" required />
                <label for="phone-no">Phone No</label>
                <input type="text" name="phone-no" id="phone-no" class="form-control" required />
                <label for="do-you-have">Do you have the following?</label>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <input type="checkbox" name="diabetic" autocomplete="off"> Diabetic
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" name="cholesterol" autocomplete="off"> Cholesterol
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" name="hbp" autocomplete="off"> High Blood Pressure
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" name="weightloss" autocomplete="off"> Weight Loss
                    </label>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <select name="age" id="age" class="form-control selectbox-size-one">
                                <?php
                                for($i=18; $i <= 100; $i++)
                                {
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control selectbox-size-one">
                                <option value="m">M</option>
                                <option value="f">F</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="body-weight">Body Weight</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">lbs</span>
                                        <input type="text" name="body-weight-lbs" id="body-weight-lbs" class="form-control inputbox-size-one" value="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="body-height">Body Height</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">ft</span>
                                        <input type="text" name="body-height-ft" id="body-height-ft" class="form-control inputbox-size-one floatLeft" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">in</span>
                                        <input type="text" name="body-height-in" id="body-height-in" class="form-control inputbox-size-one floatLeft" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="systolic-blood-pressure">Systolic Blood Pressure</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">mmHg</span>
                                        <input type="text" name="systolic-blood-pressure" id="systolic-blood-pressure" class="form-control inputbox-size-one" value="" placeholder="90-200" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="diastolic-blood-pressure">Diastolic Blood Pressure</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">mmHg</span>
                                        <input type="text" name="diastolic-blood-pressure" id="diastolic-blood-pressure" class="form-control inputbox-size-one" value="" placeholder="30-140" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="activity">Do you have any of these conditions?</label>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="checkbox" name="heart-attack" autocomplete="off"> Heart attack
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="stroke" autocomplete="off"> Stroke
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="heart-failure" autocomplete="off"> Heart Failure
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="kidney-disease" autocomplete="off"> Kidney disease
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="diabetes" autocomplete="off"> Diabetes
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="smoking" autocomplete="off"> Smoking
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="coronary" autocomplete="off"> Coronary artery disease
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="peripheral" autocomplete="off"> Peripheral vascular disease
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="cholesterol" autocomplete="off"> High Cholesterol
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="family" autocomplete="off"> Family history of heart disease
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="None" autocomplete="off"> None
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="dont-know" autocomplete="off"> I don't know
                        </label>
                    </div>
                </div>
                @foreach($data['restaurant'] as $r)
                <input type="hidden" name="rid" id="rid" value="{{ $r->id }}" />
                @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary highbp-suggestions-btn">Get Suggestions</button>
            </div>

        </div>
    </div>
</div>
<!-- High Blood Modal Ends-->
<!-- Diabetic Modal Begins-->
<div class="modal fade" id="diabeticModal" tabindex="-1" role="dialog" aria-labelledby="diabeticModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Fill in to get the best meals for Diabetics</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url'=>'suggestions/diabetic_meals','name'=>'diabetic_suggestions_form','method'=>'post', 'id'=>'diabetic_suggestions_form')) !!}
                @if($data['logged_in'] != 1)
                <div class="row">
                    <div class="col-md-6">
                        <label for="first-name">First Name</label>
                        <input type="text" name="first-name" id="first-name" class="form-control" required />
                    </div>
                    <div class="col-md-6">
                        <label for="last-name">Last Name</label>
                        <input type="text" name="last-name" id="lastname" class="form-control" required />
                    </div>
                </div>

                <label for="email-address">Email</label>
                <input type="email" name="email-address" id="email-address" class="form-control" required />
                <label for="phone-no">Phone No</label>
                <input type="text" name="phone-no" id="phone-no" class="form-control" required />
                <label for="do-you-have">Do you have the following?</label>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <input type="checkbox" name="diabetic" autocomplete="off"> Diabetic
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" name="cholesterol" autocomplete="off"> Cholesterol
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" name="hbp" autocomplete="off"> High Blood Pressure
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" name="weightloss" autocomplete="off"> Weight Loss
                    </label>
                </div>
                @endif
                <div class="form-group">
                    <label for="do-you-have">Do you have diabetic with High Blood Pressure?</label>
                    <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" name="diabetic-high-bp" value="1" autocomplete="off"> Yes
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="diabetic-high-bp" value="0" autocomplete="off"> No
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <select name="age" id="age" class="form-control selectbox-size-one">
                                <?php
                                for($i=18; $i <= 100; $i++)
                                {
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control selectbox-size-one">
                                <option value="m">M</option>
                                <option value="f">F</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="blood-sugar-reading">Blood Sugar Reading</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">mmol/L</span>
                                        <input type="text" name="blood-sugar-reading" id="blood-sugar-reading" class="form-control inputbox-size-one" value="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="body-weight">Body Weight</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">lbs</span>
                                        <input type="text" name="body-weight-lbs" id="body-weight-lbs" class="form-control inputbox-size-one" value="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="body-height">Body Height</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">ft</span>
                                        <input type="text" name="body-height-ft" id="body-height-ft" class="form-control inputbox-size-one floatLeft" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">in</span>
                                        <input type="text" name="body-height-in" id="body-height-in" class="form-control inputbox-size-one floatLeft" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="diabetes-type">Type of Diabetes</label>
                            <select name="diabetes-type" id="diabetes-type" class="form-control selectbox-size-three">
                                <option value="Type 1">Type 1</option>
                                <option value="Type 2">Type 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="eaten">Eaten in last 2 hours</label>
                            <select name="eaten" id="eaten" class="form-control selectbox-size-three">
                                <option value="yes">YES</option>
                                <option value="no">NO</option>
                            </select>
                        </div>
                    </div>
                </div>
                @foreach($data['restaurant'] as $r)
                <input type="hidden" name="rid" id="rid" value="{{ $r->id }}" />
                @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary diabetic-suggestions-btn">Get Suggestions</button>
            </div>

        </div>
    </div>
</div>
<!-- Diabetic Modal Ends-->
<!-- Weight Los Modal Begins-->
<div class="modal fade" id="weightLossModal" tabindex="-1" role="dialog" aria-labelledby="weightLossModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Fill in to get the best meals for Weight Loss</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('url'=>'suggestions/weight_loss_meals','name'=>'weight_loss_suggestions_form','method'=>'post', 'id'=>'weight_loss_suggestions_form')) !!}
                @if($data['logged_in'] != 1)
                <div class="row">
                    <div class="col-md-6">
                        <label for="first-name">First Name</label>
                        <input type="text" name="first-name" id="first-name" class="form-control" required />
                    </div>
                    <div class="col-md-6">
                        <label for="last-name">Last Name</label>
                        <input type="text" name="last-name" id="lastname" class="form-control" required />
                    </div>
                </div>

                <label for="email-address">Email</label>
                <input type="email" name="email-address" id="email-address" class="form-control" required />
                <label for="phone-no">Phone No</label>
                <input type="text" name="phone-no" id="phone-no" class="form-control" required />
                <label for="do-you-have">Do you have the following?</label>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <input type="checkbox" name="diabetic" autocomplete="off"> Diabetic
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" name="cholesterol" autocomplete="off"> Cholesterol
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" name="hbp" autocomplete="off"> High Blood Pressure
                    </label>
                    <label class="btn btn-primary">
                        <input type="checkbox" name="weightloss" autocomplete="off"> Weight Loss
                    </label>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <select name="age" id="age" class="form-control selectbox-size-one">
                                <?php
                                for($i=18; $i <= 100; $i++)
                                {
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control selectbox-size-one">
                                <option value="m">M</option>
                                <option value="f">F</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="body-weight">Body Weight</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">lbs</span>
                                        <input type="text" name="body-weight-lbs" id="body-weight-lbs" class="form-control inputbox-size-one" value="" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="body-height">Body Height</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">ft</span>
                                        <input type="text" name="body-height-ft" id="body-height-ft" class="form-control inputbox-size-one floatLeft" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">in</span>
                                        <input type="text" name="body-height-in" id="body-height-in" class="form-control inputbox-size-one floatLeft" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                        <label for="activity">Daily Activity</label>
                        <div class="row">
                            <div class="col-md-8">
                                <select id="activity" name="activity" class="form-control">
                                    <option value="0.2" >No sport/exercise</option>
                                    <option value="0.375" >Light activity (sport 1-3 times per week)</option>
                                    <option value="0.55" >Moderate activity (sport 3-5 times per week)</option>
                                    <option value="0.725" >High activity (everyday exercise)</option>
                                    <option value="0.9" >Extreme activity (professional athlete)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="weight-to-achieve">Weight to achieve</label>
                            <div class="input-group">
                                <span class="input-group-addon">lbs</span>
                                <input type="text" name="weight-to-achieve" id="weight-to-achieve" class="form-control inputbox-size-one" required />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="date-to-achieve">Date to achieve</label>
                            <div class="form-group">
                                <div class="col-md-4">
                                    <select name="month-to-achieve" class="form-control">
                                        <option value="01">Jan</option>
                                        <option value="02">Feb</option>
                                        <option value="03">Mar</option>
                                        <option value="04">Apr</option>
                                        <option value="05">May</option>
                                        <option value="06">Jun</option>
                                        <option value="07">Jul</option>
                                        <option value="08">Aug</option>
                                        <option value="09">Sep</option>
                                        <option value="10">Oct</option>
                                        <option value="11">Nov</option>
                                        <option value="12">Dec</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="date-to-achieve" class="form-control">
                                        <?php
                                        $tomorrow = date('d')+1;

                                        for($i=1;$i<32;$i++){
                                            if($i == $tomorrow){
                                                $selected = ' selected="selected"';
                                            }else{
                                                $selected ='';
                                            }
                                            echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="year-to-achieve" class="form-control">
                                        <?php
                                        for($i=2016;$i<2027;$i++){
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



                @foreach($data['restaurant'] as $r)
                <input type="hidden" name="rid" id="rid" value="{{ $r->id }}" />
                @endforeach
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary weight-loss-suggestions-btn">Get Suggestions</button>
            </div>

        </div>
    </div>
</div>
<!-- Weight Loss Modal Ends-->

<div class="rest_review_section col-md-8" style="background-color:#ffffff;">
    <br>
    <h2>Healthy Meal suggestions</h2>
    <div class="col-md-12">
        <div class="healthy-icons">
            <ul>
                <li class="healthy-icon"><a data-toggle="modal" data-target="#cholesterolModal" alt="Cholesterol"><span class="cholesterol"></span></a></li>
                <li class="healthy-icon"><a data-toggle="modal" data-target="#highBPModal" alt="High Blood Pressure"><span class="blood-pressure"></span></a></li>
                <li class="healthy-icon"><a data-toggle="modal" data-target="#diabeticModal" alt="Diabetic"><span class="diabetic"></span></a></li>
                <li class="healthy-icon"><a data-toggle="modal" data-target="#weightLossModal"  alt="Weight Loss"><span class="weight-loss"></span></a></li>
            </ul>
        </div>
    </div>
    <div id="updated_menu" style="inline-block;width:100%;">
    </div>
    <div class="healthy-menu-wrapper">
    @if($data['logged_in'] == 1)
        @foreach($data['restaurant'] as $r)
            @if($r->restaurant_menus->isEmpty())
                <p style="color:#2ECC71;padding-left:15px;"><em>Sorry, we don't have food suggestions fot this restaurant. &nbsp;&nbsp;&nbsp;&nbsp;<!-- Button trigger Healthy Food Alert Modal -->
                        <button type="button" class="btn btn-sm btn-rl-default" data-toggle="modal" data-target="#healthyFoodAlertModal" style="float:right;">
                            Alert Me When Available
                        </button> <br/>There are 25 other healthy food suggestions in your area.</em>
                </p>
            @else
                @if(!$r->restaurant_cholesterol_menus->isEmpty())
                    <div class="panel panel-default panel-healthy-menu">
                        <div class="panel-heading">Cholesterol</div>
                        @foreach($r->restaurant_cholesterol_menus as $rhm)
                            <div class="panel-body">
                                <h5>{{ $rhm->product_name }} <span class="favorite-icon" data-toggle="tooltip" data-placement="top" title="Add to Favorites"></span></h5>
                                <table class="table table-stripped">
                                    <tr>
                                        <th>Calories</th>
                                        <th>Fat</th>
                                        <th>Sodium</th>
                                        <th>Carbs</th>
                                    </tr>
                                    <tr>
                                        <td>{{ $rhm->product_calories }}</td>
                                        <td>{{ $rhm->product_total_fat }} gms</td>
                                        <td>{{ $rhm->product_sodium }} mgs</td>
                                        <td>{{ $rhm->product_carbohydrates }} gms</td>
                                    </tr>
                                </table>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if(!$r->restaurant_weight_loss_menus->isEmpty())
                <div class="panel panel-default panel-healthy-menu">
                    <div class="panel-heading">Weight Loss</div>
                    @foreach($r->restaurant_weight_loss_menus as $rhm)
                    <div class="panel-body">
                        <h5>{{ $rhm->product_name }} <span class="favorite-icon" data-toggle="tooltip" data-placement="top" title="Add to Favorites"></span></h5>
                        <table class="table table-stripped">
                            <tr>
                                <th>Calories</th>
                                <th>Fat</th>
                                <th>Sodium</th>
                                <th>Carbs</th>
                            </tr>
                            <tr>
                                <td>{{ $rhm->product_calories }}</td>
                                <td>{{ $rhm->product_total_fat }} gms</td>
                                <td>{{ $rhm->product_sodium }} mgs</td>
                                <td>{{ $rhm->product_carbohydrates }} gms</td>
                            </tr>
                        </table>
                    </div>
                    @endforeach
                </div>
                @endif
                @if(!$r->restaurant_blood_pressure_menus->isEmpty())
                <div class="panel panel-default panel-healthy-menu">
                    <div class="panel-heading">High Blood Pressure</div>
                    @foreach($r->restaurant_blood_pressure_menus as $rhm)
                    <div class="panel-body">
                        <h5>{{ $rhm->product_name }} <span class="favorite-icon" data-toggle="tooltip" data-placement="top" title="Add to Favorites"></span></h5>
                        <table class="table table-stripped">
                            <tr>
                                <th>Calories</th>
                                <th>Fat</th>
                                <th>Sodium</th>
                                <th>Carbs</th>
                            </tr>
                            <tr>
                                <td>{{ $rhm->product_calories }}</td>
                                <td>{{ $rhm->product_total_fat }} gms</td>
                                <td>{{ $rhm->product_sodium }} mgs</td>
                                <td>{{ $rhm->product_carbohydrates }} gms</td>
                            </tr>
                        </table>
                    </div>
                    @endforeach
                </div>
                @endif
                @if(!$r->restaurant_diabetic_menus->isEmpty())
                <div class="panel panel-default panel-healthy-menu">
                    <div class="panel-heading">Diabetes</div>
                    @foreach($r->restaurant_diabetic_menus as $rhm)
                    <div class="panel-body">
                        <h5>{{ $rhm->product_name }} <span class="favorite-icon" data-toggle="tooltip" data-placement="top" title="Add to Favorites"></span></h5>
                        <table class="table table-stripped">
                            <tr>
                                <th>Calories</th>
                                <th>Fat</th>
                                <th>Sodium</th>
                                <th>Carbs</th>
                            </tr>
                            <tr>
                                <td>{{ $rhm->product_calories }}</td>
                                <td>{{ $rhm->product_total_fat }} gms</td>
                                <td>{{ $rhm->product_sodium }} mgs</td>
                                <td>{{ $rhm->product_carbohydrates }} gms</td>
                            </tr>
                        </table>
                    </div>
                    @endforeach
                </div>
                @endif
            @endif
        @endforeach
    @endif
    </div>
    <br>

    <div class="col-md-12">
        <a data-toggle="modal" data-target="#bmrModal" class="btn btn-sm btn-rl-default" style="display:none;">Calculate your BMR</a>
        <?php if(!empty($_POST['calculator_ok'])):?>
            <br>
            <div id="table">
                <div class="rowheader" style="background-color:#4BACE6;">
                    Your BMR is: <?php echo number_format($BMR); ?> calories/day
                </div>
                <?php if($calc_mode):?>
                    <div class="rowheader" style="background-color:#4BACE6;">
                        <p>You need <?php echo number_format($energy_needs)?> calories per day.</p>
                    </div>
                <?php endif;?>
            </div>
            <br>
        <?php endif;?>
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
    <br>
    <div class="restaurant_quicklinks">
    <ul class="restaurant_quicklinks_main" style="margin-left:15px;">
        <li><a href="{{ url('write-a-review/'.$r->permalink) }}" class="btn-rl-default">Write An Anonymous Review</a></li>
    </ul>
    </div>
    <br>
    <h2>Recent Reviews about {{ $data['restaurant'][0]['name']}}</h2>
    @foreach($data['restaurant'] as $rr)
        @if(count($rr->restaurant_reviews)==0)
            <p style="color:#2ECC71;padding-left:15px;"><em>Be the first to review this restaurants.</em></p>
        @else
            @foreach($rr->restaurant_reviews as $reviews)
                <?php
                if($reviews->review_text != ''){
                    $review_text = $reviews->review_text;
                }else{
                    $review_text = $reviews->text;
                }
                ?>

                <div class="rest_review_box" style="width:100%;">

                    <div class="rest_review_info col-md-12" style="padding-left:20px;padding-right:20px;">

                        <?php
                        switch($reviews->rating){
                            case 0:
                                $rating = 'emoone';
                                break;
                            case 1:
                                $rating = 'emoone';
                                break;
                            case 2:
                                $rating = 'emotwo';
                                break;
                            case 3:
                                $rating = 'emothree';
                                break;
                            case 4:
                                $rating = 'emofour';
                                break;
                            case 5:
                                $rating = 'emofive';
                                break;

                        }
                        ?>

                        <span class="floatLeft emotions {{$rating}} active-emotion"></span>

                        <div class="full_review_text">
                            <p>{{ $review_text }}</p>
                        </div>
                        <br/>
                        <!--<div class="review_quicklinks">
                            <ul class="floatRight">
                                <li>
                                    <a href="#">Thank You</a>
                                </li>
                                <li>
                                    <a href="#">Share</a>
                                </li>
                            </ul>
                        </div>-->
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
            <h4>Opening Hours <span class="glyphicon glyphicon-plus" class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#all_hours_collapse" aria-expanded="false" aria-controls="all_hours_collapse"></span></h4>
            <!--<p><strong>Today 10.00 Am to 10.00 Pm</strong></p>-->
            <?php
            if($r->restaurants_info->hours != NULL){
                $hours = str_replace('||', '<br>',$r->restaurants_info->hours);
                $hours = str_replace('-->', ': ',$hours);
                $hours = str_replace(',Open now', '',$hours);
                $timing = explode('||', $r->restaurants_info->hours);
                $today = '';
                foreach($timing as $t){
                    if(substr($t, 0, 1) == ' '){
                        if(date('D') == substr($t, 1, 3)){
                            $today = $t;
                            break;
                        }
                    }else{
                        if(date('D') == substr($t, 0, 3)){
                            $today = $t;
                            break;
                        }
                    }
                    $hours = str_replace('-->', ':', $t);
                }
                echo str_replace('-->', ':', $today);

                echo '<div id="all_hours_collapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="all_store_hours"><div class="panel-body" style="background-color:#fff;">'.$hours.'</div></div>';
            }else{
                echo '<p style="color:#adadad;">Sorry, Store hours have not been updated. If you are the owner of this restaurants. Please update the store hours.</p>';
            }
            ?>
        </div>
    @endforeach
@endsection
@section('specialities_section')
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
        <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Specialities
            </a>
        </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
        <div class="panel-body">
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
    </div>
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

