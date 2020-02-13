
@extends('layouts.admin')

@section('contents')

    @include('partials.admin-sidebar')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View Partners</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">View Users</li>
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
                            <h3 class="card-title">View Partners Table</h3><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Send Notification</button>
                        </div>



                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Image</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($users as $partner)
                                    <tr>
                                        <td><input type="checkbox" name="users[]"class="single-check" value="{{$partner->id}}"></td>
                                        <td>{{$partner->name}}</td>
                                        <td>{{$partner->mobile}}</td>
                                        <td>{{$partner->email}}</td>
                                        <td>{{$partner->address}}</td>
                                        <td><img src="{{$partner->image}}" height="50" width="50"></td>



                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{$users->links()}}
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
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Notification Form</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('admin.notification.send')}}" id="notification-form">
                        @csrf
                        <div class="row">
                        <label>Title</label>
                        <input type="text" name="title" required id="title">
                        </div>
                        <div class="row">
                        <label>Description</label>
                        <textarea name="description" required id="description"></textarea>
                        <input type="hidden" name="receipents" id="receipents">
                        </div>
                            <button type="button" onclick="sendnotification()">Send</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
    function sendnotification(){
        if($("#title").val()=='' || $("#description").val()=='')
            return
        var contacts=[]
        $('.single-check').each(function(){
        if($(this).is(':checked')){

            contacts.push($(this).val())
        }
        })

        $("#receipents").val(contacts)
        $("#notification-form").submit()
        return true
    }
    </script>
@endsection
