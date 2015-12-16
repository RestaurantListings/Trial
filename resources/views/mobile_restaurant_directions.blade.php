<?php
/**
 * Created by PhpStorm.
 * User: Abu Isaac
 * Date: 7/14/15
 * Time: 9:58 PM
 */
?>
@extends('mobile_restaurant_directions_template')

@section('restaurant_basic_info')

    @foreach($data['restaurant'] as $r)
<?php
if($r->address_2 == ''){$r_address_2 = '';}else{$r->address_2 = $r->address_2.', ';}
$restaurant_address = $r->address_1.', '.$r->address_2.$r->city->city.', '.$r->state->short.', '.$r->zip;


?>
        <div class="restaurants_info_row_one">
            <div class="rest_info_column_one col-md-12">
                <div class="directions-form-container">
                <form id="calculate-route" name="calculate-route" action="#" method="get">
                    <div class="form-group">
                        <div class="input-group col-md-12 floatLeft">
                            <span class="input-group-addon" id="basic-addon1">A</span>
                            <input type="text" id="from" name="from" class="form-control" required="required" placeholder="Another address" size="30" value="{{ $restaurant_address }}" />
                        </div>
                        <div class="input-group col-md-12 floatLeft">
                            <span class="input-group-addon" id="basic-addon2">B</span>
                            <input type="text" class="form-control" id="to" name="to" required="required" placeholder="An address" size="30" value="{{ $data['user_location'] }}" />

                        </div>

                        <div class="input-group col-md-12 floatLeft">
                            <input type="submit" class="request_order_btn btn-rl-default" value="Get Direction" />
                            <a id="to-link" href="#">Get my position</a>
                        </div>
                    </div>
                </form>
                    <div id="route">

                    </div>
                    <p id="error"></p>
                </div>
                <div id="map"></div>


            </div>

        </div>
    @endforeach

@endsection

