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
                <!--<ul class="restaurant_quicklinks_main">
                    <li>
                        {!! Form::open(array('name'=>'home_search','class'=>'basic-search','novalidate'=>'')) !!}
                        </form>

                    </li>

                </ul>-->

                <!-- Calculate Modal Begins-->
                <div class="modal fade" id="bmrModal" tabindex="-1" role="dialog" aria-labelledby="bmrModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Calculate your BMR </h4>
                            </div>
                            <div class="modal-body">
                                <?php
                                $calc_mode=1;
                                if(!empty($_POST['calculator_ok']))
                                {
                                    // session storage
                                    foreach($_POST as $key=>$var) $_SESSION["calc_bmr_".$key]=$var;

                                    $inch=$_POST["feet"]*12+$_POST["inch"];

                                    if($_POST["gender"]=='male')
                                    {
                                        $BMR=66 + (6.3 * $_POST["lbs"]) + (12.9 * $inch) - (6.8 * $_POST["age"]);
                                    }
                                    else
                                    {
                                        $BMR=655 + (4.3 * $_POST["lbs"]) + (4.7 * $inch) - (4.7 * $_POST["age"]);
                                    }

                                    // activity?
                                    if($calc_mode)
                                    {
                                        $extra_energy=$BMR*$_POST["activity"];
                                        $energy_needs=round($BMR+$extra_energy);
                                    }
                                }
                                ?>

                                <div class="calculator_div">
                                        <form method="post" name="form1" onsubmit="return validateForm(this);">
                                        {!! Form::open(array('name'=>'bmr_form','class'=>'request','onsubmit', 'return validateForm(this);','method'=>'post','novalidate'=>'')) !!}
                                        <p><label>Your age:</label>
                                            <input type="text" size="7"  name="age" id="age" onkeyup="IsNumber(this.id)" value="<?php echo session('calc_bmr_age');?>" >
                                        </p>
                                        <p><label>Gender:</label>
                                            <input id="gender"  name="gender" type="radio" value="male" <?php if(session('calc_bmr_gender')=="male") echo "checked"; else { if(!Session::has('calc_bmr_gender')) echo "checked";}?> /> <label style="width:75px;display:inline;float:none;">Male</label>
                                            <input id="gender"  name="gender" type="radio" value="female" <?php if(session('calc_bmr_gender')=="female") echo "checked"; ?>/> <label style="width:75px;display:inline;float:none;">Female</label>

                                        </p>
                                        <p><label>Your weight:</label>
                                            <input id="weight" name="weight" type="radio" value="lbs" onclick="showHide('lbs','kg','Lbs','labelw');" <?php if(session('calc_bmr_weight')=="lbs") echo "checked"; else { if(!Session::has('calc_bmr_weight')) echo "checked";}?> />
                                            <label style="width:75px;display:inline;float:none;">lbs</label>
                                            <input id="weight"  name="weight" type="radio" value="kg" onclick="showHide('kg','lbs','kg','labelw');" <?php if(session('calc_bmr_weight')=="kg") echo "checked"; ?> />
                                            <label style="width:75px;display:inline;float:none;">kg</label>

                                        </p>
                                        <p><label >&nbsp;</label>
                                            <input type="text" name="lbs" id="lbs" size="4" onkeyup="LbsToKg(this.value,'kg');" value="<?php echo session('calc_bmr_lbs');?>">
                                            <input type="text" name="kg" id="kg" size="4" onkeyup="KgToLbs(this.value,'lbs');" style="display:none;" value="<?php echo session('calc_bmr_kg'); ?>">

					<span id="labelw">
					<?php if(session("calc_bmr_weight")=="kg"):?>
                        kg
                        <SCRIPT LANGUAGE="javascript">
                            showHide('kg','lbs','kg','labelw');
                        </SCRIPT>
                    <?php else:?>lbs<?php endif;?>
					</span>
                                        </p>


                                        <p><label>Your height:</label>
                                            <input id="height"  name="height" type="radio" value="cm" onclick="showHide('cm','feet','CM','labelh');showHide('cm','inch','CM','labelh');" <?php if(session("calc_bmr_height")=="cm") echo "checked"; else { if(!Session::get('calc_bmr_heigth')) echo "checked";}?> />
                                            <label style="width:75px;display:inline;float:none;">cm</label>
                                            <input id="height" name="height" type="radio" value="feet" onclick="showHide('feet','cm','feet/inch','labelh');showHide('inch','cm','feet/inch','labelh');" <?php if(session("calc_bmr_height")=="feet") echo "checked"; ?> />
                                            <label style="width:75px;display:inline;float:none;">feet/inch</label>

                                        </p>
                                        <p><label >&nbsp;</label>
                                            <input type="text" name="cm" id="cm" size="4" onkeyup="IsNumber(this.id);CmToFt(this.value,'feet','inch');" value="<?php echo session("calc_bmr_cm");?>">
                                            <input type="text" name="feet" id="feet" size="4" onkeyup="IsNumber(this.id);FtToCm('feet','inch','cm');" style="display:none;" value="<?php echo session("calc_bmr_feet"); ?>">
                                            <input type="text" name="inch" id="inch" size="4" onkeyup="IsNumber(this.id);FtToCm('feet','inch','cm');" style="display:none;" value="<?php echo session("calc_bmr_inch"); ?>">
					<span id=labelh >
					<?php if(session("calc_bmr_height")=="feet"):?>
                        feet/inch
                        <SCRIPT LANGUAGE="javascript">
                            showHide('feet','cm','feet/inch','labelh');
                            showHide('inch','cm','feet/inch','labelh');
                        </SCRIPT>
                    <?php else:?>cm<?php endif;?>
                   </span>
                                        </p>

                                        <?php if($calc_mode==1):?>
                                            <p><label>Daily Activity:</label> <select name="activity">
                                                    <option value="0.2" <?php if(session("calc_bmr_activity")=="0.2") echo "selected"?>>No sport/exercise</option>
                                                    <option value="0.375" <?php if(session("calc_bmr_activity")=="0.375") echo "selected"?>>Light activity (sport 1-3 times per week)</option>
                                                    <option value="0.55" <?php if(session("calc_bmr_activity")=="0.55") echo "selected"?>>Moderate activity (sport 3-5 times per week)</option>
                                                    <option value="0.725" <?php if(session("calc_bmr_activity")=="0.725") echo "selected"?>>High activity (everyday exercise)</option>
                                                    <option value="0.9" <?php if(session("calc_bmr_activity")=="0.9") echo "selected"?>>Extreme activity (professional athlete)</option>
                                                </select></p>
                                        <?php endif;?>

                                        <div style="text-align:center;clear:both;"><input type="submit" value="Calculate!"></div>
                                        <input type="hidden" name="calculator_ok" value="1">
                                    </form>




                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- BMR Modal Ends-->

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
@endsection



@section('recent_review_section')
<div class="rest_review_section col-md-8" style="background-color:#ffffff;">
    <br>
    <h2>Healthy Meal suggestions</h2>
    <p style="color:#2ECC71;padding-left:15px;"><em>Sorry, we don't have food suggestions fot this restaurant. &nbsp;&nbsp;&nbsp;&nbsp;<!-- Button trigger Healthy Food Alert Modal -->
            <button type="button" class="btn btn-sm btn-rl-default" data-toggle="modal" data-target="#healthyFoodAlertModal" style="float:right;">
                Alert Me When Available
            </button> <br/>There are 25 other healthy food suggestions in your area.</em></p><br>

    <div class="col-md-12">
        <div class="healthy-icons">
            <ul>
                <li class="healthy-icon"><a href="{{ url('/') }}"><span class="cholesterol"></span></a></li>
                <li class="healthy-icon"><a href="{{ url('/') }}"><span class="blood-pressure"></span></a></li>
                <li class="healthy-icon"><a href="{{ url('/') }}"><span class="diabetic"></span></a></li>
                <li class="healthy-icon"><a href="{{ url('/') }}"><span class="weight-loss"></span></a></li>
            </ul>
        </div>

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

