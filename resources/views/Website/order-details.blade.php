@extends('Website.layout')
@section('contents')
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif


    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <!-- page container Starts-->
    @if(!empty($data))
        <section class="section bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row px-2">
                            <div class="col-12 event">
                                <div class="row">
                                    <div class="col-9">
                                        <h4 class="heading">{{$data['title']??''}}</h4><h3 class="heading">[{{$data['status']??''}}]</h3>
                                        <p class="mx-2">Booking ID:{{$data['orderid']}}
                                        </p>
                                        <p class="">Address: {{$data['address']??''}}</p>
                                        @if($data['type']=='event')
                                        <div class="date">
                                            <h3><strong><i class="fa fa-calendar" aria-hidden="true"></i> Date & Time</strong></h3>

                                                <p class="mx-2">Starts at: {{$data['startdate']}}</br>
                                                    Ends at: {{$data['enddate']}}
                                                </p>

                                        </div>
                                        @elseif($data['type']=='restaurant')
                                            <div class="date">
                                                <h3><strong><i class="fa fa-calendar" aria-hidden="true"></i> Date & Time</strong></h3>

                                                <p class="mx-2">Date: {{$data['startdate']}}</br>
                                                    Time: {{$data['enddate']}}
                                                </p>

                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-3">
                                        <img src="{{$data['image']}}" class="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 event">
                                <table class="table table-striped table-hover">
                                    <tbody>
                                    @foreach($data['packages'] as $package)
                                        <tr>
                                            <td scope="col">{{$package['package']}}</td>
                                            <td scope="col">
                                                {{$package['pass']}} Pass
                                            </td>
                                            <td scope="col">
                                                Rs.{{$package['price']}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-right">Plateform Fee + Taxes</td>
                                        <td scope="col">
                                            Rs.0
                                        </td>

                                    </tr>
                                    <tr>
                                        <th colspan="2" class="text-right">Total</th>
                                        <th scope="col">
                                            Rs.{{$data['amount']}}
                                        </th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 event">
                                <h3 class="heading mb-3">Special Events Details</h3>
                                <table class="table table-hover table-borderless">
                                    <tbody>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <td scope="col">{{$data['name']??''}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Email</th>
                                        <td scope="col">{{$data['email']??''}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="col">Mobile</th>
                                        <td scope="col">{{$data['mobile']??''}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page container Ends-->

    @endif
@endsection
