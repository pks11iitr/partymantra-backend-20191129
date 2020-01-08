
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
                                    <th>Event</th>
                                    <th>Organizer Name</th>
                                    <th>Customer Mobile</th>
                                    <th>Total Amount</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$order->order_id}}</td>
                                        <td>{{$order->details[0]->entity->title??''}}</td>
                                        <td>{{$order->details[0]->entity->partner->name??''}}</td>
                                        <td>{{$order->customer->mobile}}</td>

                                        <td>{{$order->total}}</td>
                                        <td>{{$order->payment_status}}</td>
                                        <td>
                                            {{$order->updated_at}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Package Name</th>
                                    <th>Price</th>
                                    <th>No. of pass</th>
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
                                        <td>{{$item->package->package_name}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>{{$item->no_of_pass}}</td>
                                        <td>{{$item->no_of_pass*$item->price}}</td>
                                    </tr>
                                    @php
                                        $pass=$pass+$item->no_of_pass;
                                        $total=$total+$item->no_of_pass*$item->price;
                                    @endphp
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td><b>Total</b></td>
                                    <td><b>{{$pass}}</b></td>
                                    <td><b>{{$total}}</b></td>
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

