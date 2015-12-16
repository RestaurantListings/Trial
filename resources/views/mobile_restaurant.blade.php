@extends('mobile_restaurant_template')

@section('restaurant_basic_info')
@foreach($data['restaurant'] as $r)
<div class="container">
    <div class="row">
        &nbsp;&nbsp;&nbsp;<button class="request_order_btn btn-rl-default" type="button" data-toggle="modal" data-target="#onlineOrderRequestModal">Request Online Ordering</button>

    <p><strong>&nbsp;&nbsp;&nbsp;{{ $r->request_order }}</strong> People Requested Online Ordering</p>
        <div class="col-md-12 restaurant_basic_info">
            <h1 itemprop="name">{{ str_replace('???', '\'', $r->name) }}</h1>
            <p><strong>
                    {{ $r->address_1.', '.$r->address_2}}<br>
                    {{ $r->city->city.', '.$r->state->short.', '.$r->zip }}
                </strong>
            </p>
            <?php $to = $r->address_1.', '.$r->address_2.', '.$r->city->city.', '.$r->state->short.', '.$r->zip; ?>
            <p>{{ $r->phone }}</p>
            <p><b>{{$r->categories}}</b></p>
            <p style="margin:10px 0px;"><a href="{{ $r->website }}"  target="_blank">{{ $r->website }}</a></p>
            <!--<p style="margin:10px 0px 0px;"><a href="{{ url('get-directions/'.$r->permalink) }}">Get Directions</a></p>-->
            <p style="margin:10px 0px 0px;"><a href="http://maps.google.com/maps?q=to:<?php echo $to; ?>" target="_blank">Get Directions</a></p>
            <br>
            <!--<p><a href="{{ url('write-a-review/'.$r->permalink) }}" class="btn-rl-default">Write A Review</a></p>-->

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

            <ul class="restaurant_quicklinks_sec">
                <li>
                    {!! Form::open(array('name'=>'home_search','class'=>'basic-search','novalidate'=>'')) !!}


                    </form>
                </li>

            </ul>

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
                                <input type="text" class="form-control" name="guest_first_name" value="" placeholder="First Name" required />
                                <label for="guest_last_name">Last Name</label>
                                <input type="text" class="form-control" name="guest_last_name" value="" placeholder="Last Name" required />
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
        <br>
        <h2 style="font-size:18px;margin-left:15px;">Healthy Meal Suggestions</h2>
        <p style="color:#2ECC71;padding-left:15px;"><em>Sorry, we don't have food suggestions for this restaurant.<br>
                <!-- Button trigger Healthy Food Alert Modal -->

                <button type="button" class="btn btn-sm btn-rl-default" data-toggle="modal" data-target="#healthyFoodAlertModal">
                    Alert Me When Available
                </button> <br>There are 25 other healthy food suggestions in your area.</em></p>

        <div class="col-md-12">

            <div class="healthy-icons">
                <ul>
                    <li class="healthy-icon"><a href="{{ url('/') }}"><span class="cholesterol"></span></a></li>
                    <li class="healthy-icon"><a href="{{ url('/') }}"><span class="blood-pressure"></span></a></li>
                    <li class="healthy-icon"><a href="{{ url('/') }}"><span class="diabetic"></span></a></li>
                    <li class="healthy-icon"><a href="{{ url('/') }}"><span class="weight-loss"></span></a></li>
                </ul>
            </div>
            <p style="display:none;"><a data-toggle="modal" data-target="#bmrModal" class="btn-rl-default"">Calculate Your BMR</a></p>
            <?php if(!empty($_POST['calculator_ok'])):?>
                <div id="table">
                    <br>
                    <div class="rowheader" style="background-color:#4BACE6;">
                        Your BMR is: <?php echo number_format($BMR); ?> calories/day
                    </div>
                    <?php if($calc_mode):?>
                        <div class="rowheader" style="background-color:#4BACE6;">
                            <p>You need <?php echo number_format($energy_needs)?> calories per day.</p>
                        </div>
                    <?php endif;?>
                </div>
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
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">Opening - Close Hours<span class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#all_hours_collapse" aria-expanded="false" aria-controls="all_hours_collapse" style="color:#b82720;"> (See All)</span></div>
                <div class="panel-body">
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
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Specialities<span class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2" href="#all_specialities_collapse" aria-expanded="false" aria-controls="all_specialities_collapse" style="color:#b82720;"> (See All)</span></div>
                <div id="all_specialities_collapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="all_specialities_hours">
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
        </div>
        <div class="col-md-12 restaurant_review_section">
            <a href="{{ url('write-a-review/'.$r->permalink) }}"><div class="full-width-btn btn-rl-default">Write A Review</div></a>
            <br>
            <h2>Recent Reviews about {{ $data['restaurant'][0]['name']}}</h2>
            @foreach($data['restaurant'] as $rr)
                @if(count($rr->restaurant_reviews)==0)
                    <p style="color:#2ECC71;padding-left:15px;"><em>Be the first to review this restaurants.</em></p>
                @else
                    @foreach($rr->restaurant_reviews as $reviews)
                        <div class="rest_review_box" style="width:100%;">
                            <div class="rest_review_info col-md-12">
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
                                    <p>{{ $reviews->review_text }}</p>
                                </div>
                                <br/>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>
</div>
@endforeach
<script>
    function request_online_order(id){

        $.ajax({
            url: '<?php echo url("restaurants/request_online_order"); ?>',
            type: "post",
            data: {'id':id, '_token': $('input[name=_token]').val()},
            success: function(data){
                // alert('Thanks for requesting. Will let this know to the store owner.<button>Alert Me When Available</button>');
                $('.restaurant_basic_info').append('<p class="alert alert-success alert-dismissible"">Thanks for requesting. Will let this know to the store owner. <a href="#" class="alert-link" data-toggle="modal" data-target="#onlineOrderRequestModal">Alert Me When Available</a><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></p>');

            }
        });
    }

</script>

@endsection