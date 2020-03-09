<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="The Party Mantra">
    <meta name="keywords" content="the party mantra">
    <meta name="author" content="UIdeck">

    <title>The Party Mantra</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('theme/css/plugins/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/plugins/main.css')}}">
    <link rel="stylesheet" href="{{mix('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/plugins/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/plugins/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/plugins/animate.css')}}">
    <link rel="stylesheet" href="{{asset('theme/css/plugins/responsive.css')}}">


    <!-- Fonts icons -->
    <link rel="stylesheet" href="{{asset('theme/css/plugins/font-awesome.min.css')}}">

</head>

<body>
<div class="black">
    <div class="container py-5">
        <span class="close"><a href="#" class="white"><i class="fa fa-times" aria-hidden="true"></i></a></span>
        <div class="row py-5">
            <div class="col-md-12">
                <h3 class="text-center section-heading">Sign In</h3>

                <form class="py-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-form btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="locdiv">
    <div class="container py-5">

        <div class="row py-5">
            <div class="col-md-12 py-5">
                <h3 class="text-center section-heading">Select City</h3>
                <form class="py-3">
                    <div class="form-group">
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Choose your location">
                    </div>
                    <button type="submit" class="btn btn-form btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<section class="header">
    <div class="top-menu">
        <div class="container">
            <div class="row">
                <div class="searchform col-8 left py-2">
                    <form action="#" method="post" novalidate="novalidate">
                        <div class="row">
                            <div class="col-3 p-0">
                                <select class="forminput form-control search-slt" id="exampleFormControlSelect1">
                                    <option>Select</option>
                                    <option>Party</option>
                                    <option>Event</option>
                                    <option>Dinning</option>
                                </select>
                            </div>
                            <div class="col-6 p-0">
                                <input type="text" class="forminput form-control" name="x" placeholder="Search term...">
                            </div>
                            <div class="col-3 p-0">
                                <button type="button" class="btn btn-form btn-block"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="toplinks col-md-4 col-sm-12">
                    @if(!auth()->user())
                    <a class="white" href="{{route('login')}}"><i class="fa fa-user"></i> Sign in</a>
                    @else
                        <a class="white" href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-user"></i> Sign out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endif
                    <a href="#"><i class="fa fa-question-circle"></i> Help</a>
                    <a id="clickloc" href="#"><i class="fa fa-globe"></i> Select City</a>
                    <!--
                    <a class="dropdown">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> Sign In
                      </a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i> My Profile</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                      </div>
                    </a>
                    -->
                </div>

            </div>
        </div>
    </div>
    <!-- navbar-default -->
    <nav class="navbar navbar-expand-lg nabar-fixed navbar-light bg-default">
        <div class="container">

            <div class="col-5 logobox">
                <a class="" href="{{env('APP_URL')}}"><img class="logo" src="{{asset('theme/img/tplogo.png')}}" alt="logo"></a>
            </div>
            <div class="col-7 text-right">
                <ul class="list-inline py-3 menu">
                    <li class="list-inline-item"><a href="{{env('APP_URL')}}" class=""><i class="fa fa-bolt" aria-hidden="true"></i> Club Events</a></li>
                    <li class="list-inline-item"><a href="{{env('APP_URL')}}?type=restaurant" class=""><i class="fa fa-cutlery" aria-hidden="true"></i> Dinning</a></li>
                    <li class="list-inline-item"><a href="{{env('APP_URL')}}?type=party" class=""><i class="fa fa-glass" aria-hidden="true"></i> Parties</a></li>
                </ul>
            </div>


            <!-- Mobile Menu Starts
                <div class="col-12 mobilemenu text-center">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="" class=""><i class="fa fa-bolt" aria-hidden="true"></i> Club Events</a></a></li>
                        <li class="list-inline-item"><a href="" class=""><i class="fa fa-cutlery" aria-hidden="true"></i> Dinning</a></a></li>
                        <li class="list-inline-item"><a href="" class=""><i class="fa fa-glass" aria-hidden="true"></i> Parties</a></a></li>
                    </ul>
                    <ul class="nav nav-pills nav-justified">
                      <li class="nav-item">
                        <a class="nav-link active" href="#">Active</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Much longer nav link</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                      </li>
                    </ul>
                </div>
             -->
            <div class="col-12 mobilemenu text-center">
                <ul class="nav nav-pills nav-justified">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('website.home')}}"><i class="fa fa-bolt" aria-hidden="true"></i> Club Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('website.home')}}?type=restaurant"><i class="fa fa-cutlery" aria-hidden="true"></i>  Dinning</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('website.home')}}?type=party"><i class="fa fa-glass" aria-hidden="true"></i> Parties</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</section>
<!-- Mobile Search Starts -->
<section class="mobilesearch">
    <div class="container">
        <div class="row">
            <div class="mobform col-12 left py-2">
                <form action="#" method="post" novalidate="novalidate">
                    <div class="row">
                        <div class="col-3 p-0">
                            <select class="forminput form-control search-slt" id="exampleFormControlSelect1">
                                <option>Select</option>
                                <option>Party</option>
                                <option>Event</option>
                                <option>Dinning</option>
                            </select>
                        </div>
                        <div class="col-6 p-0">
                            <input type="text" class="forminput form-control" name="x" placeholder="Search term...">
                        </div>
                        <div class="col-3 p-0">
                            <button type="button" class="btn btn-form btn-block"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Mobile Search Ends-->
<!-- Carousel Starts -->
@include('Website.partials.carousal')
<!-- Carousel Ends -->

@yield('contents')


<section class="section" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h5>Quick links</h5>
                <ul class="list-unstyled quick-links">
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Home</a></li>
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>About</a></li>
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Videos</a></li>
                </ul>
            </div>
            <div class="col-4">
                <h5>Quick links</h5>
                <ul class="list-unstyled quick-links">
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Home</a></li>
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>About</a></li>
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Videos</a></li>
                </ul>
            </div>
            <div class="col-4">
                <h5>Quick links</h5>
                <ul class="list-unstyled quick-links">
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Home</a></li>
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>About</a></li>
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
                    <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Get Started</a></li>
                    <li><a href="https://wwwe.sunlimetech.com" title="Design and developed by"><i class="fa fa-angle-double-right"></i>Imprint</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <ul class="list-unstyled list-inline social text-center">
                    <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-google-plus"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void();" target="_blank"><i class="fa fa-envelope"></i></a></li>
                </ul>
            </div>
            </hr>
        </div>
    </div>
</section>
<!-- ./Footer -->
<section class="section lowerfoooter">
    <div class="container">
        <div class="row">
            <div class="col-12 text-justify">
                <h3>Who are we?</h3>
                <p>The Party Mantra is #1 online venues booking platform for events and parties! Our venue experts connect
                    customers to the appropriate venues, and get them best packages on their group parties. We
                    specialize in booking party venues to celebrate corporate party, birthday party, kitty party, family
                    functions or for other special occasions in Delhi NCR and other major cities of India.</p>
                <h3>What do we do?</h3>
                <p>At The Party Mantra, we try our best to find a most suitable venue for your celebration. We give you the best
                    food &amp; drinks packages for your group party. Let our venue experts help you to find the perfect
                    venue for your special occasion best suiting your requirements. We assure you, you’ll get your venue
                    at the best prices without taking the pain of stepping out of the comforts of your house or office.</p>
                <h3>How do we do?</h3>
                <p>We save your time and energy which you might have wasted while searching suitable venue for your
                    party. All you have to do is to visit at www.The Party Mantra.com and book a venue for your party in 3 simple
                    steps:</p>
                <ul class="footlist">
                    <li><i class="fa fa-circle" aria-hidden="true"></i> Browse. Look through the wide variety of venues available at our website and pick whichever
                        place suites your requirement.</li>
                    <li><i class="fa fa-circle" aria-hidden="true"></i> Enquire &amp; Book.
                        <ul class="footlist">
                            <li><i class="fa fa-circle-o" aria-hidden="true"></i> Give us your party requirement and our venue experts will contact you at earliest possible.</li>
                            <li><i class="fa fa-circle-o" aria-hidden="true"></i> Our venue experts will suggest you with short-listed venues based on your requirement at a
                                discounted price.</li>
                            <li><i class="fa fa-circle-o" aria-hidden="true"></i> Book any of our suggested party venues and get a gift vouchers in return.</li>
                        </ul>
                    </li>
                    <li><i class="fa fa-circle" aria-hidden="true"></i> Feedback. Do tell us if you like our services. Your feedback will help us to improve our services.</li>
                </ul>
                <p>Our Venue Experts are ready to assist you by answering questions, making suggestions, and working
                    with you until you pull off a successful party on your special occasion.</p>
                <p>At The Party Mantra, you can exclusively book party venue without any restriction. Plenty of people on the web search on various search engines and type various queries like book my venue etc. They do get party booking platforms to book venue or to book a party of their choice, but they don't get proper satisfaction with the other venues provider. Book a party venue or book a party place of your choice at India's number 1 platform. We have authentic party venues and party places. Our special party venues in India are stupendous and amazing to enjoy with family &amp; friends. </p>
                <p>The Party Mantra is the fastest growing event or venue booking websites in India having more than 35+ categories and more than 500+ restaurants. So, if in case you are searching for party halls or party places in India then The Party Mantra is here to help you out in every query of your booking concerns.  In our website you can easily find your query related to party halls near me or best party halls to organise small parties. So your search ends here at best and popular party, event, restaurants, pubs, clubs, lounge booking sites in India named as The Party Mantra.</p>      </div>
        </div>
    </div>
    </div>


</section>
<section class="copyright bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <p>Copyright 2020 The Party Mantra. All rights reserved.</p>
            </div>
            <div class="col-6 text-right">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="" class="bottomfoot-links">About</a></li>
                    <li class="list-inline-item"><a href="" class="bottomfoot-links">Privacy Policy</a></li>
                    <li class="list-inline-item"><a href="" class="bottomfoot-links">Terms</a></li>
                    <li class="list-inline-item"><a href="" class="bottomfoot-links">Contact</a></li>
                </ul>
            </div>

        </div>
    </div>
</section>


<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="{{asset('theme/js/plugins/jquery.min.js')}}"></script>
<script src="{{asset('theme/js/plugins/popper.min.js')}}"></script>
<script src="{{asset('theme/js/plugins/bootstrap.min.js')}}"></script>
{{--<script src="{{asset('theme/js/plugins/owl.carousel.min.js')}}"></script>--}}
<script src="{{asset('theme/js/plugins/form-validator.min.js')}}"></script>
<script src="{{asset('theme/js/plugins/contact-form-script.js')}}"></script>
<script src="{{mix('js/main.js')}}"></script>
{{--<script src="{{asset('theme/js/plugins/swiper.min.js')}}"></script>--}}
{{--<script src="{{asset('theme/js/plugins/jqery.flexisel.js')}}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>

@yield('scripts')
</body>

</html>
