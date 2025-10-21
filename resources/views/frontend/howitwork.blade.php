@extends('frontend.layouts.master')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{asset('frontend/1/css/videopopup.css')}}" type="text/css" >
<script src="{{asset('frontend/1/js/videopopup.js')}}"></script>



@section('content')
    <div class="col-lg-12 center pb-15 "></div>

    {{-- <div class="bg-shape"><img src="{{asset('frontend2/assets/images/elements/inner-hero-shape-2.png')}}" alt="image"></div> --}}
    <div class="container center">
        <div class="row">
            <div class="col-lg-12 center pb-5 ">
                <h1>HOW it work</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 ">
                <div class="howit-img-1">
                    <img class="howit-img-shape1" src="{{ asset('frontend3/images/laptop-removebg-preview.png') }}"
                        alt="" srcset="">
                    <img src="{{ asset('frontend3/images/shaps-bg.png') }}" alt="" srcset="">
                </div>
                <div class="howit-img-shape1">

                </div>
            </div>
            <div class="col-lg-6 center ">
                <a class="signup" href="{{route('user.auth')}}">

                    <h1> sign up</h1>
                </a>
                <a href="#img1" class="about-play">

                    <img src="http://www.clipartbest.com/cliparts/9Tp/enR/9TpenRLTE.svg" height="90">

                </a>
                <!-- lightbox container hidden with CSS -->
                <a href="#_" class="lightbox" id="img1">
                    <div id="videoModal" class="modal hide fade in" tabindex="-1" role="dialog"
                        aria-labelledby="videoModalLabel" aria-hidden="false" style="display: block;">
                        <div class="modal-header">
                            <button type="button" class="close full-height" data-dismiss="modal"
                                aria-hidden="true">X</button>
                            <h3>How To Sing IN </h3>
                        </div>
                        <div class="modal-body">
                            <iframe width="80%" height="80%"  src="https://www.youtube.com/embed/e7eMKW6DZHc" frameborder="0" allowfullscreen>
                            </iframe>
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                </a>
                <p>
                    First step is to simply click on the "Sign Up" button located in the top
                    right corner of the screen. You will then be led to enter your personal
                    information,
                    such as your name, email address, and a password of your choice.
                    Once you have filled out all of the required fields and agreed to our terms and conditions,
                    simply click "Submit" to complete the registration process.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="howit-img-2">
                    <img src="{{ asset('frontend3/images/boxx-removebg-preview.png') }}" alt="" srcset="">
                </div>
                <div class="howit-img-shape1">
                    <img src="{{ asset('frontend3/images/shaps-bg.png') }}" alt="" srcset="">
                </div>
            </div>
            <div class="col-lg-6 center">


                <a class="signup" href="{{route('allbox')}}">

                    <h1 class="open"> Open A Box</h1>
                </a>




                <a href="#img1" class="about-play">

                    <img src="http://www.clipartbest.com/cliparts/9Tp/enR/9TpenRLTE.svg" height="90">

                </a>
                <!-- lightbox container hidden with CSS -->
                <a href="#_" class="lightbox" id="img1">
                    <div id="videoModal" class="modal hide fade in" tabindex="-1" role="dialog"
                        aria-labelledby="videoModalLabel" aria-hidden="false" style="display: block;">
                        <div class="modal-header">
                            <button type="button" class="close full-height" data-dismiss="modal"
                                aria-hidden="true">X</button>
                            <h3>How To Sing IN </h3>
                        </div>
                        <div class="modal-body">
                            <iframe width="80%" height="80%"  src="https://www.youtube.com/embed/e7eMKW6DZHc" frameborder="0" allowfullscreen>
                            </iframe>
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                </a>

                <p>
                    Second step is to choose a product of your choice from the Smart Box Shop which
                    offers a wide range of products including the latest
                    smart devices, high-tech gadgets and then choose a number to enter the
                    draw and wait for the results!
                </p>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">

                <div class="howit-img-3">
                    <img src="{{ asset('frontend3/images/winnerbig-removebg-preview.png') }}" alt="" srcset="">
                </div>
                <div class="howit-img-shape1">
                    <img src="{{ asset('frontend3/images/shaps-bg.png') }}" alt="" srcset="">
                </div>
            </div>
            <div class="col-lg-6 center">



                <a class="signup" href="{{route('winners')}}">
                    <h1 class="win">Win</h1>
                </a>

                <a href="#img1" class="about-play">

                    <img src="http://www.clipartbest.com/cliparts/9Tp/enR/9TpenRLTE.svg" height="90">

                </a>


                <!-- lightbox container hidden with CSS -->
                <a href="#_" class="lightbox" id="img1">
                    <div id="videoModal" class="modal hide fade in" tabindex="-1" role="dialog"
                        aria-labelledby="videoModalLabel" aria-hidden="false" style="display: block;">
                        <div class="modal-header">
                            <button type="button" class="close full-height" data-dismiss="modal"
                                aria-hidden="true">X</button>
                            <h3>How To Sing IN </h3>
                        </div>
                        <div class="modal-body">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/Ms0uDHae8FY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                </a>

                <p>
                    The Third and last step is to check the winning number which might be yours
                    and Congratulations you have won the Smart Box!
                </p>
            </div>
        </div>



        </div>





@endsection


