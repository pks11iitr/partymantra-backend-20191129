
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
                        <div class="card-body">
                            <form method="get" action="{{route('admin.orders')}}">
                                <label>Select Partner</label>
                                <select name="partner">
                                    <option value="0" >Select Partner</option>
                                    @foreach($partners as $p)
                                        <option value="{{$p->id}}" @if($p->id==$partner){{'selected'}}@endif>{{$p->name}}</option>
                                    @endforeach
                                </select>
                                <label>Date From</label>
                                <input type="date" name="datefrom" value="{{$datefrom??''}}">
                                <label>Date To</label>
                                <input type="date" name="dateto" value="{{$dateto??''}}">
                                <button type="submit">Search</button>
                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>OrderID</th>
                                    <th>Organizer Name</th>
                                    <th>Customer Mobile</th>
                                    <th>Total Amount</th>
                                    <th>Order Status</th>
                                    <th>Date</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($orders as $order)
                                    <tr>
                                            <td>{{$order->refid}}</td>
                                            <td>{{$order->details[0]->partner->name??''}}</td>
                                            <td>{{$order->customer->mobile}}</td>

                                            <td>{{$order->total}}</td>
                                            <td>{{$order->payment_status}}</td>
                                            <td>
                                                {{$order->updated_at}}
                                            </td>
                                        <td><a href="{{route('admin.orders.details', ['id'=>$order->id])}}">View</a></td>
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

    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>

@endsection

