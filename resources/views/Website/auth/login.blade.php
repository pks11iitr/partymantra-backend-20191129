@extends('Website.layout')
@section('contents')
    <!-- page container Starts-->
    <section class="pagecrumb-wallet bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4 event">
                    <h3 class="text-center section-heading">LOGIN</h3>
                    @if ($message = Session::get('error'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($errors->has('mobile'))
                        <?php //var_dump($errors)?>
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{$errors->first('mobile')}}
                        </div>
                    @endif
                    <form class="py-3" method="post" action="{{route('login')}}">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> Mobile Number</label>
                            <input name="mobile" type="text" class="form-control" id="exampleInputmobile" placeholder="Enter Mobile No..." maxlength = "10">
                        </div>

{{--                        <div class="form-group form-check">--}}
{{--                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember" checked>--}}
{{--                            <label class="form-check-label" for="exampleCheck1">Stay Logged In</label>--}}
{{--                        </div>--}}
                        <button type="submit" class="btn btn-form btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- page container Ends-->
@endsection
