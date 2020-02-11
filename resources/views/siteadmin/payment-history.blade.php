
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
                            <li class="breadcrumb-item active">Payment History</li>
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
                        <div class="card-body">
                        <form method="get" action="{{route('payment.history')}}">
                            <label>Date From</label>
                            <input type="date" name="datefrom" value="{{$datefrom}}">
                            <label>Date To</label>
                            <input type="date" name="dateto" value="{{$dateto}}">
                            <button type="submit">Search</button>
                        </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Partner Name</th>
                                    <th>Total Bills Amount</th>
                                    <th>Total Paid</th>
                                    <th>Instant Discount</th>
                                    <th>Cashback Discount</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->name??''}}</td>
                                        <td>{{($order->total??0)+($order->instant_discount??0)}}</td>
                                        <td>{{$order->total??0}}</td>
                                        <td>{{$order->instant_discount??0}}</td>

                                        <td>{{$order->cashback_discount??0}}</td>
                                        <td><a href="{{route('admin.orders')}}?partner={{$order->id}}&datefrom={{$datefrom}}&dateto={{$dateto}}">View Details</a></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{ $orders->links() }}
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

