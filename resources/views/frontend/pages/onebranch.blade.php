

@extends('frontend.layouts.master')


@section('content')

	<!-- Google Map
		============================================= -->
		<section id="map"  class="gmap slider-parallax vh-60"
        data-address="Melbourne, Australia"
         data-markers='[{address: "Melbourne, Australia",
         html: $("#map").html(),
          icon:{ image: "{{asset('frontend/img/logo175x55.png')}}",
          iconsize: [32, 39],
          iconanchor: [32,39] } }]'>
        </section>
		<div id="map-marker-1" class="d-none">
            <div style="width: 300px;">
                {{-- <h4 class="mb-2">Hi! We are <span>Envato!</span></h4> --}}
                {{-- <p class="mb-0" style="font-size:1rem;">Our mission is to help people to
                    <strong>earn</strong> and to <strong>learn</strong> online. We operate
                     <strong>marketplaces</strong> where hundreds of thousands of
                     people buy and sell digital goods every day.
                    </p> --}}
                    </div>
                    </div>


		<!-- Page Sub Menu

		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container">

					<div class="row gutter-40 col-mb-80">
						<!-- Postcontent
						============================================= -->
						<div class="postcontent col-lg-9">

							<h3>Send us an Email</h3>

							<div class="form-widget">

								<div class="form-result"></div>

								<form class="mb-0" id="template-contactform" name="template-contactform"

                                action="include/form.php" method="post">

									<div class="form-process">
										<div class="css3-spinner">
											<div class="css3-spinner-scaler"></div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-4 form-group">
											<label for="template-contactform-name">Name <small>*</small></label>
											<input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control required" />
										</div>

										<div class="col-md-4 form-group">
											<label for="template-contactform-email">Email <small>*</small></label>
											<input type="email" id="template-contactform-email" name="template-contactform-email" value="" class="required email sm-form-control" />
										</div>

										<div class="col-md-4 form-group">
											<label for="template-contactform-phone">Phone</label>
											<input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" />
										</div>

										<div class="w-100"></div>

										<div class="col-md-8 form-group">
											<label for="template-contactform-subject">Subject <small>*</small></label>
											<input type="text" id="template-contactform-subject" name="subject" value="" class="required sm-form-control" />
										</div>

										

										<div class="w-100"></div>

										<div class="col-12 form-group">
											<label for="template-contactform-message">Message <small>*</small></label>
											<textarea class="required sm-form-control" id="template-contactform-message" name="template-contactform-message" rows="6" cols="30"></textarea>
										</div>

										<div class="col-12 form-group d-none">
											<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
										</div>

										<div class="col-12 form-group">
											<button class="button button-3d m-0" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">Send Message</button>
										</div>
									</div>

									<input type="hidden" name="prefix" value="template-contactform-">

								</form>
							</div>

						</div><!-- .postcontent end -->

						<!-- Sidebar
						============================================= -->
						<div class="sidebar col-lg-3">

							<address>
								<strong>{{$onebranch->tele}}</strong><br>
								{{$onebranch->tele}}
							</address>
							<abbr title="Phone Number"><strong>Phone:</strong></abbr> {{$onebranch->tele}}<br>
							<abbr title="Fax"><strong>Fax:</strong>
                            </abbr> {{$onebranch->tele}}<br>
							<abbr title="Email Address"><strong>Email:</strong></abbr> {{$onebranch->email}}

							<div class="widget border-0 pt-0">

								{{-- <div class="fslider customjs testimonial twitter-scroll twitter-feed"
                                data-username="envato"
                                 data-count="3" data-animation="slide" data-arrows="false">
									<i class="i-plain i-small color icon-twitter mb-0" style="margin-right: 15px;"></i>
									<div class="flexslider" style="width: auto;">
										<div class="slider-wrap">
											<div class="slide"></div>
										</div>
									</div>
								</div> --}}

							</div>

							{{-- <div class="widget border-0 pt-0">

								<a href="#" class="social-icon si-small si-dark si-facebook">
									<i class="icon-facebook"></i>
									<i class="icon-facebook"></i>
								</a>

								<a href="#" class="social-icon si-small si-dark si-twitter">
									<i class="icon-twitter"></i>
									<i class="icon-twitter"></i>
								</a>

								<a href="#" class="social-icon si-small si-dark si-dribbble">
									<i class="icon-dribbble"></i>
									<i class="icon-dribbble"></i>
								</a>

								<a href="#" class="social-icon si-small si-dark si-forrst">
									<i class="icon-forrst"></i>
									<i class="icon-forrst"></i>
								</a>

								<a href="#" class="social-icon si-small si-dark si-pinterest">
									<i class="icon-pinterest"></i>
									<i class="icon-pinterest"></i>
								</a>

								<a href="#" class="social-icon si-small si-dark si-gplus">
									<i class="icon-gplus"></i>
									<i class="icon-gplus"></i>
								</a>

							</div> --}}

						</div><!-- .sidebar end -->
					</div>

				</div>
			</div>
		</section><!-- #content end -->

        <script type="text/javascript">
            function initMap() {
              const myLatLng = { lat: {{$onebranch->googleL}}, lng: {{$onebranch->googleE}} };
              const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 5,
                center: myLatLng,
              });

              new google.maps.Marker({
                position: myLatLng,
                map,
                title: "Hello Rajkot!",
              });
            }

            window.initMap = initMap;
        </script>

        <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" >
        </script>



@endsection
