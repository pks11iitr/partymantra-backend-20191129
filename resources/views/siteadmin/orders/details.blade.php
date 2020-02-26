
@extends('layouts.admin')

@section('contents')
    @include('partials.admin-sidebar')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View Orders</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">View Orders Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>OrderID</th>
                                    <th>Customer Name</th>
                                    <th>Customer Mobile</th>
                                    <th>Organizer Name</th>
                                    <th>Type</th>
                                    <th>Total Amount</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$order->refid}}</td>
                                        <td>{{$order->customer->name??''}}</td>
                                        <td>{{$order->customer->mobile??''}}</td>
                                        <td>{{$order->details[0]->partner->name??''}}</td>
                                        <td>{{$order->details[0]->optional_type??'eventbook'}}</td>
                                        <td>{{$order->total}}</td>
                                        <td>{{$order->payment_status}}@if($order->payment_status=='cancel-request')<br><a href="{{route('admin.orders.cancelapprove', ['id'=>$order->id])}}">approve</a>@endif</td>
                                        <td>
                                            {{$order->updated_at}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Item Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $pass=0;
                                    $total=0;
                                @endphp
                                @foreach($order->details as $item)
                                    <tr>
                                        @if(!empty($item->other))
                                            <td>{{$item->other->package_name??$item->other->name}}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{$item->price}}</td>
                                        <td>{{$item->no_of_pass}}</td>
                                        <td>{{$item->no_of_pass*$item->price}}</td>
                                    </tr>
                                    @php
                                        $pass=$pass+$item->no_of_pass;
                                        if($item->optional_type=='billpay')
                                            $total=$item->price;
                                        else
                                            $total=$total+$item->no_of_pass*$item->price;
                                    @endphp
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><b>Total Amount</b></td>
                                    <td><b>{{$total}}</b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><b>Total Paid</b></td>
                                    <td><b>{{$order->total}}</b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><b>Instant Discount</b></td>
                                    <td><b>{{$order->instant_discount}}</b></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

@endsection

