@extends('frontend.layouts.master')


@section('content')
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{ asset('4/assets/images/backgrounds/page-header-bg.jpg') }})">
        </div>
        <div class="page-header__pattern"><img src="{{ asset('4/assets/images/pattern/page-header-pattern.png') }}"
                alt=""></div>
        <div class="container">
            <div class="page-header__inner">
                <h2>Search</h2>
                <ul class="thm-breadcrumb">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><span class="icon-right-arrow21"></span></li>
                    <li>Search</li>
                </ul>
            </div>
        </div>
    </section>


    <style>
        .search-container {
            background-color: #fff;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1200px;
            margin: 1rem;
        }

        .search-container h2 {
            text-align: center;
            margin-bottom: 1rem;
            color: #333;
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: flex-end;
        }

        .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        .form-group label {
            font-weight: 500;
            color: #555;
            margin-bottom: 0.25rem;
        }

        .form-control {
            border-radius: 5px;
            padding: 0.5rem;
            width: 100%;

        }

        .btn-primary {
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 500;
            width: 100%;

        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }

            .form-group {
                flex: 1 1 auto;
            }

            .btn-primary {
                margin-top: 10px;
            }
        }
    </style>

    <div class="container-fluid" style="padding-top: 5%; padding-bottom: 5% ">
        <div class="row"
            style=" display: flex;
                    flex-wrap: nowrap;
                    align-items: center;
                    align-content: space-between;
                    flex-direction: row;">


            <form action="{{ route('searchresultx') }}" method="post"class="searchForm">
                @csrf
                <div class="form-row">
                    <!-- Origin -->
                    {{-- <div class="form-group">
                        <label for="origin">Origin</label>
                        <input type="text" name="location_from" id="location_from" value="{{ request('location_from') }}"
                            style="width: 100%;
                                background-color: #fff;
                                font-size: 16px;
                                border: none;
                                outline: none;
                                height: 44px;
                                padding-left: 9px;
                                padding-right: 4px;">
                    </div> --}}

                    <div class="form-group">
                        <label for="destination">Country Or City</label>
                        <input type="text" name="location_to" name="destination" id="location_to"
                            value="{{ request('location_to') }}"
                            style="width: 100%;
                                background-color: #fff;
                                font-size: 16px;
                                border: none;
                                outline: none;
                                height: 44px;
                                    padding-left: 9px;
                                padding-right: 4px;">
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="input-box">
                            <label for="origin" style="color: #0a0a0a">SahaSave.com</label>
                            <div class="select-box" style="color: #0a0a0a">
                                <select class="selectmenu wide" name="cat_id"
                                    style="width: 100%;
                                font-size: 16px;
                                height: 44px;
                                padding-left: 9px;
                                padding-right: 4px;">
                                    <option value="" selected disabled>SahaSave.com Type</option>
                                    @foreach (\App\Models\Category::get() as $brand)
                                        <option value="{{ $brand->id }}">
                                            {{ $brand->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Weight -->
                    <div class="form-group">
                        <label for="weight">Weight</label>
                        <input type="number" name="weight" id="weight" value="{{ request('weight') }}"
                            style="width: 100%;
                    background-color: #fff;
                    font-size: 16px;
                    border: none;
                    outline: none;
                    height: 44px;
                    padding-left: 9px;
                    padding-right: 4px;">
                    </div>

                    <!-- Length -->
                    <div class="form-group">
                        <label for="length">Length</label>
                        <input type="number" class="form-control" id="length" value="{{ request('length') }}">
                    </div>

                    <!-- Destination -->


                    <!-- Date -->
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date"
                            value="{{ request('date') }}">
                    </div>

                    <!-- Price -->
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" id="price"
                            value="{{ request('price') }}">
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>

            </form>


            {{-- <div class="col-lg-12 col-md-12 col-xs-6">

                <form action="{{ route('searchresult') }}" method="post"class="searchForm">
                    @csrf
                    <!-- Location From -->

                    <label for="location_from">Location From:</label>
                    <input type="text" name="location_from" id="location_from" value="{{ request('location_from') }}">
                    <!-- Location To -->
                    <label for="location_to">Location To:</label>
                    <input type="text" name="location_to" id="location_to" value="{{ request('location_to') }}">
                    <!-- Weight -->
                    <label for="weight">Weight:</label>
                    <input type="number" name="weight" id="weight" value="{{ request('weight') }}">
                    <!-- Location From -->
                    <label for="name">name :</label>
                    <input type="text" name="name" id="name" value="{{ request('name') }}">
                    <!-- Truck Type -->
                    <label for="truck_type">Truck Type:</label>
                    <select name="truck_type" id="truck_type">
                        @foreach (\App\Models\Category::get() as $brand)
                            <option value="{{ $brand->id }}" selected="selected">
                                {{ $brand->title }}
                            </option>
                        @endforeach
                    </select>
                    <!-- Submit Button -->
                    <button type="submit" class="thm-btn">
                        Search
                        <i class="icon-right-arrow21"></i>
                        <span class="hover-btn hover-bx"></span>
                        <span class="hover-btn hover-bx2"></span>
                        <span class="hover-btn hover-bx3"></span>
                        <span class="hover-btn hover-bx4"></span>
                    </button>
                </form>
            </div> --}}

        </div>
    </div>
    <div class="container">
        <div class="row">
            <h1 style="color: #000">Search Results</h1>
            <div id="results"></div>
            @if (isset($results) && $results->isEmpty())
                <h2 class="" style="color:#000;">No results found.</h2>
            @elseif(isset($results))
                <table style="color: #000" class="styled-table">
                    <thead>
                        <tr>
                            <th>Location From</th>
                            <th>Location To</th>
                            <th>Weight</th>
                            <th>lenght</th>
                            <th>Truck Type</th>
                            <th>Contact Info</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($results as $truck)
                            <tr>
                                <td>{{ $truck->location_country }} </td>
                                <td>{{ $truck->location_city }}</td>
                                <td>{{ $truck->weight }}</td>
                                <td>{{ $truck->length }}</td>

                                <td> {{ $truck->truck_type_name }}</td>

                                <td>
                                    <a href="https://wa.me/1234567890" target="_blank" class="icon-link" title="WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>

                                    <!-- Email Icon -->
                                    <a href="mailto:example@example.com" class="icon-link" title="Email">
                                        <i class="fas fa-envelope"></i>
                                    </a>

                                    <!-- Details Icon -->
                                    <a href="#" class="icon-link" title="Details" data-toggle="modal"
                                        data-target="#contactModal">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            {{-- @if ($results->isEmpty())
                <p>No results found.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Location From</th>
                            <th>Location To</th>
                            <th>Weight</th>
                            <th>Truck Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $truck)
                            <tr>
                                <td>{{ $truck->location_from }}</td>
                                <td>{{ $truck->location_to }}</td>
                                <td>{{ $truck->weight }}</td>
                                <td>{{ $truck->truck_type }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endsection --}}

        </div>
    </div>
    <div class="space" style="height: 20px;"></div>
    <script>
        $(document).ready(function() {
            // Handle form submission
            $('#searchForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting

                const formData = $(this).serialize();

                // Send AJAX request
                $.ajax({
                    url: '{{ route('searchresultx') }}', // Route to handle the search
                    type: 'GET',
                    data: formData,
                    success: function(response) {
                        // Display results in the results container
                        $('#results').html(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
