@extends('frontend.layouts.master')

@section('content')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>




    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sx-12"></div>
            <div class="col-lg-4 col-md-4 col-sx-12"></div>
            <div class="col-lg-4 col-md-4 col-sx-12"></div>
        </div>
    </div>
    <div class="container-fluid" style="background: #062E39 ;padding-bottom: 10%">
        <div class="row">
            <div class="" id="tab-btn1">
                <div class="">
                    {{-- <div class="tab-content-box-item-img"
                        style="background-image: url({{ asset('4/assets/images/backgrounds/quote-v1-bg2.jpg') }});">
                    </div> --}}
                    <div class="quotes-wrapper">
                        <div class="quotes-wrapper-inner">
                            <div class="title-box">
                                <h2>Shipment Point</h2>
                            </div>

                            <div class="quotes-weight">
                                <form class="contact-form quote-one__form" action="{{ route('postrequest.for.Quote') }}"
                                    method="post">
                                    @csrf
                                    <div class="row">


                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <div class="input-box">
                                                <label>Name</label>
                                                <input type="text" name="name" placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <div class="input-box">
                                                <label>Email Name</label>
                                                <input type="email" name="email" placeholder="Email Address">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <div class="input-box">
                                                <label>Phone Number</label>
                                                <input type="text" name="phone" placeholder="Mobile Num">
                                            </div>
                                        </div>




                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <div class="input-box">
                                                <label>SahaSave.com</label>
                                                <div class="select-box">
                                                    <select class="selectmenu wide" name="cat_id">
                                                        {{-- <option selected="selected">SahaSave.com Type
                                                        </option> --}}
                                                        @foreach (\App\Models\Category::get() as $brand)
                                                            <option value="{{ $brand->id }}" selected="selected">
                                                                {{ $brand->title }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <div class="input-box">
                                                <label>Weight</label>
                                                <input type="text" name="weight" placeholder="Weight">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <div class="input-box">
                                                <label>Lenght</label>
                                                <input type="number" name="lenght" placeholder="Lenght">
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <div class="input-box">
                                                <label>origin</label>
                                                <input type="text" name="origin" placeholder="origin">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <div class="input-box">
                                                <label>destination</label>
                                                <input type="text" name="destination" placeholder="destination">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <div class="input-box">
                                                <label>date</label>
                                                <input type="datetime-local" name="date">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <div class="input-box">
                                                <label>price</label>
                                                <input type="text" name="price" placeholder="price">
                                            </div>
                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8">
                                            <div class="input-box">
                                                <label>Notice</label>
                                                <textarea id="summernote" name="notice" placeholder="Enter drop Notes">
                                                    {{ old('notice') }}
                                                </textarea>


                                            </div>
                                        </div>

                                    </div>



                                    <div class="col-xl-12">
                                        <div class="quote-two__btn">
                                            {{-- <a href="{{ route('gaddyourload') }}" class="thm-btn"> --}}

                                            <button type="submit" class="thm-btn">
                                                Request For A Quote
                                                <i class="icon-right-arrow21"></i>
                                                <span class="hover-btn hover-bx"></span>
                                                <span class="hover-btn hover-bx2"></span>
                                                <span class="hover-btn hover-bx3"></span>
                                                <span class="hover-btn hover-bx4"></span>
                                            </button>
                                            {{-- </a> --}}
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $('#summernote').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 100
        });
    </script>
@endsection
