@extends('frontend.layouts.master')


@section('content')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>


<script
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly"
defer
></script>

<div class="inner-hero-section style--five">
</div>
<!-- inner-hero-section end -->

<!-- user section start -->
<div class=" pb-120 mt-100">
    <div class="container ">
        <div class="row getin">
            <div class="col-lg-12  ">
                <div class="getheader center">  <h1 class="right" >Get In Touch</h1> </div>

            <div class="get-img">
                <img src="{{asset('frontend3/images/getin.png')}}" alt="" width="250px" height="250px">
            </div>
            </div>
        </div>
    </div>
    <div class="container pb-150">
        <div class="row">
        <div class="col-lg-8 col-md-6 pt-100">
            <form action="">


                    <div class="card-body get-in-touch">
                        <div class="form-group">
                            <label for="firstname">First Name</label>
                            <input type="text" name="firstname"
                            class="form-control" id="exampleInputEmail1"
                            placeholder="Enter firstname..." >
                        </div>
                        <div class="form-group">
                            <label for="LastName">Last Name</label>
                            <input type="text" name="LastName"
                            class="form-control" id="exampleInputEmail1"
                            placeholder="Enter Last Name...." >
                        </div>
                        <div class="form-group">
                            <label for="companyname">Comapny Name</label>
                            <input type="text" name="companyname"
                            class="form-control" id="exampleInputEmail1"
                            placeholder="Enter companyname" >
                        </div>
                        <div class="form-group">
                            <label for="companyemail">Company Email</label>
                            <input type="email" name="youtube"
                            class="form-control" id="exampleInputEmail1"
                            placeholder="Enter Company Email.. name@company.com" >
                        </div>

                        <div class="form-group">
                            <label for="jobtitle">job title</label>
                            <input type="jobtitle" name="jobtitle" class="form-control" id="exampleInputEmail1"
                            placeholder="Enter jobtitle...." >
                        </div>


                        <div class="form-group">
                            <label for="Country">Country</label>
                            <input type="Country" name="Country"
                            class="form-control" id="exampleInputEmail1"
                            placeholder="Enter Country...." >
                        </div>

                        <div class="form-group">
                            <label for="content">content</label>
                            <textarea id="summernote" name="content" placeholder="Enter content...." ></textarea>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

            </form>

        </div>
    </div>
</div>


<script>


    // Initialize and add the map
let map;

async function initMap() {
  // The location of Uluru
  const position = { lat: -25.344, lng: 131.031 };
  // Request needed libraries.
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

  // The map, centered at Uluru
  map = new Map(document.getElementById("map"), {
    zoom: 4,
    center: position,
    mapId: "DEMO_MAP_ID",
  });

  // The marker, positioned at Uluru
  const marker = new AdvancedMarkerElement({
    map: map,
    position: position,
    title: "Uluru",
  });
}

initMap();


</script>
@endsection

