@extends('Website.layout')
@section('contents')

    <!-- page container Starts-->
    <section class="py-2">
        <div class="container">

            <div class="row event bg-light" id="view-profile">
                <div class="col-12">
                <h2 class="heading">
                    <i class="fa fa-user" aria-hidden="true"></i> Profile Details
                    <span class="float-right">
                        <a href="javascript:void(0)" class="btn btn-form btn-sm" onclick="$('#update-profile').toggle();$('#view-profile').toggle();">
                            <i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile
                        </a>
                    </span>
                </h2>
                </div>
                <br>
                <div class="col-md-3 col-sm-12 col-xs-12 text-center py-4">
                    <img class="rounded-circle reviewer" src="http://standaloneinstaller.com/upload/avatar.png">
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <form>
                        <div class="row">
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="forname" class="col-md-3 col-sm-6 col-xs-6 col-form-label"><strong> Name :</strong></label>
                                            <label for="forname" class="col-md-7 col-sm-6 col-xs-6 col-form-label">{{$user->name}}</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="forname" class="col-5 col-form-label"><strong> Mobile :</strong></label>
                                            <label for="formobile" class="col-md-7 col-form-label">{{$user->mobile}}</label>
                                          </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="forname" class="col-5 col-form-label"><strong> Email :</strong></label>
                                            <label for="foremail" class="col-md-7 col-form-label">{{$user->email}}</label>
                                          </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="forname" class="col-md-5 col-form-label"><strong>Gender :</strong></label>
                                            <label for="forgender" class="col-md-7 col-form-label">{{$user->gender}}</label>
                                          </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group row">
                                            <label for="forname" class="col-md-5 col-form-label"><strong>Date of Birth :</strong></label>
                                            <label for="fordob" class="col-md-7 col-form-label">{{$user->dob}}</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group row">
                                            <label for="forname" class="col-md-3 col-form-label"><strong>Address :</strong></label>
                                            <label for="foraddress" class="col-md-9 col-form-label">{{$user->address}} </label>
                                        </div>
                                    </div>

                                </div>


                        <!---<div class="form-group row">
                            <label for="forname" class="col-md-3 col-sm-6 col-xs-6 col-form-label"><strong> Name :</strong></label>
                            <label for="forname" class="col-md-7 col-sm-6 col-xs-6 col-form-label">{{$user->name}}</label>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group row">
                                    <label for="forname" class="col-5 col-form-label"><strong> Mobile :</strong></label>
                                    <label for="formobile" class="col-md-7 col-form-label">{{$user->mobile}}</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group row">
                                    <label for="forname" class="col-5 col-form-label"><strong> Email :</strong></label>
                                    <label for="foremail" class="col-md-7 col-form-label">{{$user->email}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group row">
                                    <label for="forname" class="col-md-5 col-form-label"><strong>Gender :</strong></label>
                                    <label for="forgender" class="col-md-7 col-form-label">{{$user->gender}}</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group row">
                                    <label for="forname" class="col-md-5 col-form-label"><strong>Date of Birth :</strong></label>
                                    <label for="fordob" class="col-md-7 col-form-label">{{$user->dob}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="forname" class="col-md-3 col-form-label"><strong>Address :</strong></label>
                            <label for="foraddress" class="col-md-9 col-form-label">{{$user->address}}</label>
                        </div>-->
                    </form>
                </div>
            </div>
            <!--- Update Profile Section Starts --->
            <div class="row event bg-light" id="update-profile" style="display:none">
                <div class="col-12">
                    <h2 class="heading"><i class="fa fa-user" aria-hidden="true"></i> Profile Details<span class="float-right"><a href="javascript:void(0)" class="btn btn-form btn-sm" onclick="$('#update-profile').toggle();$('#view-profile').toggle();">Cancel</a></span></h2>
                    <br>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12 text-center py-4">
                    <img class="rounded-circle reviewer" src="http://standaloneinstaller.com/upload/avatar.png">
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <form action="{{route('website.profile.update')}}" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group row">
                                    <label for="forname" class="col-md-5 col-sm-12 col-xs-12 col-form-label"><strong> Name :</strong></label>
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <input type="text" class="form-control" id="inputtext" name="name" value="{{$user->name}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group row">
                                    <label for="forname" class="col-5 col-form-label"><strong> Mobile:</strong></label>
                                    <div class="col-md-7 col-sm-6 col-xs-6">
                                        <input type="text" class="form-control" id="inputtext" name="" value="{{$user->mobile}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group row">
                                    <label for="forname" class="col-5 col-form-label"><strong> Email:</strong></label>
                                    <div class="col-md-7 col-sm-6 col-xs-6">
                                        <input type="text" class="form-control" id="inputtext" name="email" value="{{$user->email}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group row">
                                    <label for="forname" class="col-md-5 col-form-label"><strong>Date of Birth :</strong></label>
                                    <div class="col-md-7 col-sm-6 col-xs-6">
                                        <input type="date" class="form-control" id="inputtext" name="dob" value="{{$user->dob}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <div class="form-group row">
                                    <label for="forname" class="col-md-5 col-form-label"><strong>Gender :</strong></label>
                                    <div class="col-md-7 col-sm-6 col-xs-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male" @if($user->gender=='male'){{'checked'}}@endif>
                                            <label class="form-check-label" for="inlineRadio1">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female" @if($user->gender=='female'){{'checked'}}@endif>
                                            <label class="form-check-label" for="inlineRadio2">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="other" @if($user->gender=='other'){{'checked'}}@endif>
                                            <label class="form-check-label" for="inlineRadio2">Others</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="forname" class="col-md-2 col-form-label"><strong>Address :</strong></label>
                            <div class="col-md-10">
                                <textarea for="foraddress" class="walletinput form-control" style="font-size: 16px;" name="address">Plot -115, Sector 38A, Noida (201301). </textarea>
                            </div>
                        </div>
                        <button class="btn btn- btn-form btn-block" type="submit">Update</button>
                    </form>
                </div>
            </div>
            <!--- Update Profile Section Ends --->
            <div class="row mt-4 py-4 event bg-light">
                <div class="col-12">
                    <ul class="nav nav-pills nav-justified protab" id="pills-tab" role="tablist">
                        <li class="nav-item pro-item">
                            <a class="nav-link pro-link @if(Route::currentRouteName()=='website.user.profile'){{'active'}}@endif" id="pills-home-tab" href="{{route('website.user.profile')}}" role="tab" aria-controls="pills-home" aria-selected="true">Wallet</a>
                        </li>
                        <li class="nav-item pro-item">
                            <a class="nav-link pro-link @if(Route::currentRouteName()=='website.order.history'){{'active'}}@endif" id="pills-profile-tab" href="{{route('website.order.history')}}" role="tab" aria-controls="pills-profile" aria-selected="false">Order History</a>
                        </li>
                    </ul>
                    <div class="tab-content px-2 bg-white" id="pills-tabContent">
                        @if(isset($wallethistory))
                            <div class="tab-pane fade @if(Route::currentRouteName()=='website.user.profile'){{'show active'}}@endif" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <div class="row">
                                    <div class="col-12 text-center py-4">
                                        <h2 class="pagebrumb-wallet heading">Total balane </h2>
                                        <p class="h4">₹ {{$balance??0}}</p>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-form" onclick='$("#add-balance-div").toggle()'><i class="fa fa-plus" aria-hidden="true"></i> Add Money</a>
                                    </div>
                                    <div class="col-12 text-center py-4" id="add-balance-div" style="display:none">
                                        <form action="{{route('website.wallet.recharge')}}" method="post">
                                            <h2 class="pagebrumb-wallet heading">Add Balance </h2>
                                            <input type="text" class="walletinput" name="amount" value="" placeholder="₹ Amount" id="amount">
                                            <div class="row text-center py-4">
                                                <div class="col-4"><a class="btn btn-form btn-block wallet-amount" href="#" role="button" amount="1000"><i class="fa fa-plus" aria-hidden="true"></i> ₹1000</a></div>
                                                <div class="col-4"><a class="btn btn-form btn-block wallet-amount" href="#" role="button" amount="2000"><i class="fa fa-plus" aria-hidden="true"></i> ₹2000</a></div>
                                                <div class="col-4"><a class="btn btn-form btn-block wallet-amount" href="#" role="button" amount="5000"><i class="fa fa-plus" aria-hidden="true"></i> ₹5000</a></div>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-form">Add Money</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="wallethistory">
                                    @foreach($wallethistory as $h)
                                    <div class="row mb-2 py-2 reviews">
                                        @if($h->type=='Debit')
                                        <div class="col-3">
                                            <p class="py-2"><span class="ricon py-3 px-4 h4 rounded-circle border border-danger text-danger text-center"><i class="fa fa-inr" aria-hidden="true"></i></span></p>
                                            </p>
                                        </div>
                                        @else
                                        <div class="col-3">
                                            <p class="py-2"><span class="ricon py-3 px-4 h4 rounded-circle border text-success border-success text-center"><i class="fa fa-inr" aria-hidden="true"></i></span></p>
                                            </p>
                                        </div>
                                        @endif
                                        <div class="col-6">
                                            <p class="h2"><strong>{{$h->description}}</strong></p>
                                            <p><small>{{date('D, M d, Y H:iA', strtotime($h->updated_at))}}</small></p>
                                        </div>
                                        <div class="col-3 py-2">
                                            <p>₹ {{$h->amount}}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>



                                <!---<div class="row">
                                    <div class="col-12">


                                        <table class="table table-striped">
                                            <tbody>
                                            @foreach($wallethistory as $h)
                                                <tr>
                                                    @if($h->type=='Debit')
                                                        <td scope="col" class="pt-4"><span class="ricon py-3 px-4 h4 rounded-circle border border-danger text-danger text-center"><i class="fa fa-inr" aria-hidden="true"></i></span></td>
                                                    @else
                                                        <td scope="col" class="pt-4"><span class="ricon py-3 px-4 h4 rounded-circle border border-success text-success text-center"><i class="fa fa-inr" aria-hidden="true"></i></span></td>
                                                    @endif
                                                    <td scope="col"><strong>{{$h->description}}</strong><br>
                                                        <small>{{date('D, M d, Y H:iA', strtotime($h->updated_at))}}</small>
                                                    </td>
                                                    <td scope="col">₹ {{$h->amount}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>-->
                            </div>
                        @endif
                        @if(isset($ordersdetail))
                            <div class="tab-pane fade @if(Route::currentRouteName()=='website.order.history'){{'show active'}}@endif" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                @foreach($ordersdetail as $order)
                                    <div class="row reviews mb-2">
                                        <div class="col-3 py-2">
                                            <img src="{{$order['image']}}" class=" order-image rounded img-fluid">
                                        </div>
                                        <div class="col-9 p-2">
                                            <div class="row">
                                                <div class="col-9">
                                                    <h5 class="heading">{{$order['title']}}</h5>
                                                </div>
                                                <div class="col-3">
                                                    <span class="float-right"><a href="" class="btn btn-success btn-small">{{$order['payment_status']}} {{$order['confirmed']??''}}</a></span>
                                                </div>
{{--                                                <div class="col-12"><p>Booking ID: {{$order['id']}}</p></div>--}}
                                                <div class="col-12"><p>₹ {{$order['total']}}</p></div>
                                                <div class="col-12"><p><strong>Booking Id</strong> : {{$order['id']}}</p></div>
                                                <div class="col-12"<p><i class="fa fa-calendar" aria-hidden="true"></i>{{$order['datetime']}}</p></div>
                                            </div>
                                        </div>
                                                <div class="col-4 p-2">
                                                    <a href="" data-toggle="modal" data-target="#cancle" class="btn btn-form btn-block" onclick="$('#cancel-form').attr('action', '{{route('website.order.cancel', ['id'=>$order['id']])}}')">Cancel</a>
                                                </div>
                                                <div class="col-4 p-2">
                                                    <a href="{{route('website.order.details', ['id'=>$order['id']])}}" class="btn btn-form btn-block">View More</a>
                                                </div>
                                                <div class="col-4 p-2">
                                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#review" class="btn btn-form btn-block" onclick="$('#review-form').attr('action', '{{route('website.submit.review', ['id'=>$order['oid']])}}')">Review</a>
                                                </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </section>
    <!-- Review Popup Start-->
    <div class="modal fade bd-example-modal-lg" id="review" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row event-section">
                            <div class="col-10"><h2 class="heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Leave Your Reviews</h2></div>
                            <div class="col-2 text-right"><span class="text-right">
                      <a href="" type="btn close btn-close btn-lg btn-light" data-dismiss="modal">X</a></span></div>
                            <div class="col-12 py-4 reviews">
                                <form method="post" action="" id="review-form">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Your Review</label>
                                        <div class="col-sm-9">
                                            <textarea name="comment" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Rating</label>
                                        <div class="col-sm-9">
                                            <div class="rating">
                                                <input type="radio" id="star10" name="rating" value="5" /><label for="star10" title="Rocks!">5 stars</label>
                                                <input type="radio" id="star9" name="rating" value="4" /><label for="star9" title="Rocks!">4 stars</label>
                                                <input type="radio" id="star8" name="rating" value="3" /><label for="star8" title="Pretty good">3 stars</label>
                                                <input type="radio" id="star7" name="rating" value="2" /><label for="star7" title="Pretty good">2 stars</label>
                                                <input type="radio" id="star6" name="rating" value="1" /><label for="star6" title="Meh">1 star</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-form btn-block">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Review Popup End-->
    <!-- Cancle order Popup Start-->
    <div class="modal fade bd-example-modal-lg" id="cancle" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="row event-section">
                            <div class="col-10"><h2 class="heading"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Leave Your Comment</h2></div>
                            <div class="col-2 text-right"><span class="text-right">
                      <a href="" type="btn close btn-close btn-lg btn-light" data-dismiss="modal">X</a></span></div>

                            <div class="col-12 py-4 reviews">
                                <form action="" method="post" id="cancel-form">
                                    <div class="form-group mb-2">
                                        <label for="exampleInputtext"><strong>Reason to canle the order</strong></label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="reason_id" id="exampleRadios1" value="1" checked>
                                            <label class="form-check-label" for="exampleRadios1">
                                                Want to change booking date
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="reason_id" id="exampleRadios2" value="2">
                                            <label class="form-check-label" for="exampleRadios2">
                                                Changed my mind
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group py-2">
                                        <label for="exampleInputtext h5" class="mb-3"><strong>Write Us your experience with us</strong></label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="reason_text"></textarea>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-form btn-block">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cancle Order Popup End-->
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){

            $('.wallet-amount').click(function(){
                $("#amount").val($(this).attr('amount'))
            })

        });
    </script>
@endsection
<!-- page container Ends-->
