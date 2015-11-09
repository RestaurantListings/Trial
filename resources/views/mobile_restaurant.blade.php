@extends('mobile_app')

@section('restaurant_basic_info')
@foreach($data['restaurant'] as $r)
<div class="container">
    <div class="row">
        <div class="col-md-12 restaurant_basic_info">
            <h1 itemprop="name">{{ str_replace('???', '\'', $r->name) }}</h1>
            <p><strong>
                    {{ $r->address_1.', '.$r->address_2}}<br>
                    {{ $r->city->city.', '.$r->state->short.', '.$r->zip }}
                </strong>
            </p>
            <p>{{ $r->phone }}</p>
            <p><a href="{{ $r->website }}"  target="_blank">Website</a></p>
            <ul class="restaurant_quicklinks_sec">
                <li>
                    {!! Form::open(array('name'=>'home_search','class'=>'basic-search','novalidate'=>'')) !!}

                    <button class="request_order_btn" type="button" onclick="request_online_order(<?php echo $r->id; ?>);">Request Online Ordering</button>
                    </form>
                </li>
                <li>

                    <p><strong>{{ $r->request_order }}</strong> People Requested Online Ordering</p>

                </li>
            </ul>
            <!-- Online Order Request Modal Begins-->
            <div class="modal fade" id="onlineOrderRequestModal" tabindex="-1" role="dialog" aria-labelledby="onlineOrderRequestModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        {!! Form::open(array('name'=>'request_online_ordering','class'=>'request','route'=>'request_online_ordering','method'=>'post','novalidate'=>'')) !!}
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
        <br>
        <h2 style="font-size:18px;margin-left:15px;">Healthy Food suggestions</h2>
        <p style="color:#2ECC71;padding-left:15px;"><em>Sorry, we don't have best healthy food suggestion for this restaurants.</em></p>

        <div class="col-md-12">

            <!-- Button trigger Healthy Food Alert Modal -->
            <button type="button" class="btn btn-sm btn-rl-default" data-toggle="modal" data-target="#healthyFoodAlertModal">
                Alert Me When Available
            </button>

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
                <div class="panel-heading">Opening - Close Hours</div>
                <div class="panel-body">
                    <?php
                    if($r->restaurants_info->hours != NULL){
                        $hours = str_replace('||', '<br>',$r->restaurants_info->hours);
                        $hours = str_replace('-->', ': ',$hours);
                        $hours = str_replace(',Open now', '',$hours);
                        echo $hours;
                    }else{
                        echo '<p style="color:#adadad;">Sorry, Store hours have not been updated. If you are the owner of this restaurants. Please update the store hours.</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Specialities</div>
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