
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
                                    <th>Event</th>
                                    <th>Organizer</th>
                                    <th>User Mobile</th>
                                    <th>Total Amount</th>
                                    <th>Total Pass</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($orders as $order)
                                    <tr>
                                        @foreach($order->details as $item)
                                            <td>{{$item->entity->title}}</td>
                                            <td>{{$item->entity->partner->name}}</td>
                                                <td>{{$order->customer->mobile}}</td>
                                                    <td>{{$item->men+$item->women+$item->couple}}</td>
                                            <td>{{$order->total}}</td>
                                            <td>
                                                {{$order->updated_at}}
                                            </td>
                                        @endforeach                                                                     </tr>
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

