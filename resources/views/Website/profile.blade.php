@extends('Website.layout')
@section('contents')
<!-- Breadcrumb Starts-->
<section class="py-2" style="background:#ec7160;">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center py-4">
                <h2 class="pagebrumb text-white">My Acount </h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Starts-->
<!-- Mobile Search Ends-->
<!-- page container Starts-->
<section class="p-4">
    <div class="container py-5 event bg-light">
        <h2 class="heading"><i class="fa fa-user" aria-hidden="true"></i> Profile Details<span class="float-right"><a href="" class="btn btn-form btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profile</a></span></h2><br>
        <div class="row">
            <div class="col-md-3 col-sm-12 col-xs-12 text-center py-4">
                <img class="rounded-circle reviewer" src="http://standaloneinstaller.com/upload/avatar.png">
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12">
                <form>
                    <div class="form-group row">
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
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-4">
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
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped">
                                    <tbody>
                                    @foreach($wallethistory as $h)
                                    <tr>
                                        @if($h->type=='Debit')
                                        <td scope="col" class="pt-4"><span class="ricon py-3 px-4 h4 rounded-circle border border-success text-center"><i class="fa fa-inr" aria-hidden="true"></i>Put red color</span></td>
                                        @else
                                            <td scope="col" class="pt-4"><span class="ricon py-3 px-4 h4 rounded-circle border border-success text-center"><i class="fa fa-inr" aria-hidden="true"></i></span></td>
                                        @endif
                                        <td scope="col"><strong>{{$h->description}}</strong><br>
                                            <small>{{date('D, M d, Y H:iA', strtotime($h->updated_at))}}</small></td>
                                        <td scope="col">₹ {{$h->amount}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(isset($ordersdetail))
                    <div class="tab-pane fade @if(Route::currentRouteName()=='website.order.history'){{'show active'}}@endif" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                        @foreach($ordersdetail as $order)
                        <div class="row reviews mb-2">
                            <div class="col-3">
                                <img src="{{$order['image']}}" class="rounded img-fluid" style="height:180px;">
                            </div>
                            <div class="col-9 p-2">
                                <h4 class="heading">{{$order['title']}}<span class="float-right"><a href="" class="btn btn-success btn-sm">{{$order['payment_status']}}</a></span></h4>
                                <p>₹ {{$order['total']}}</p>
                                <p><i class="fa fa-calendar" aria-hidden="true"></i>{{$order['datetime']}}</p>
                                <div class="row">
                                    <div class="col-4 p-2">
                                        <a href="" class="btn btn-form btn-block">Cancel</a>
                                    </div>
                                    <div class="col-4 p-2">
                                        <a href="{{route('website.order.details', ['id'=>$order['id']])}}" class="btn btn-form btn-block">View More</a>
                                    </div>
                                    <div class="col-4 p-2">
                                        <a href="" class="btn btn-form btn-block">Review</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    @endif
                </div>
            </div>

        </div>
</section>
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
