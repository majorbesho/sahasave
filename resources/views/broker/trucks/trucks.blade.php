@extends('broker.minlayout.master')


@section('content')
    <div class="col-lg-8 col-xl-9">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row filter_bg">
            <!-- فلتر التوفر (Availabilities) -->
            <div class="col-lg-8 col-xl-9">
                <label for="availability_filter">Availability</label>
                <select name="availability_filter" id="availability_filter" class="form-control">
                    <option value="">Select Availability</option>
                    <option value="available">Available</option>
                    <option value="not_available">Not Available</option>
                </select>
            </div>

            <!-- فلتر التقييمات (Ratings) -->
            <div class="col-lg-8 col-xl-9">
                <label for="rating_filter">Rating</label>
                <select name="rating_filter" id="rating_filter" class="form-control">
                    <option value="">Select Rating</option>
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars &amp; Up</option>
                    <option value="3">3 Stars &amp; Up</option>
                    <option value="2">2 Stars &amp; Up</option>
                    <option value="1">1 Star &amp; Up</option>
                </select>
            </div>

            <!-- فلتر العلامة التجارية (Brand) -->
            <div class="col-lg-8 col-xl-9">
                <label for="brand_filter">Brand</label>
                <select name="brand_filter" id="brand_filter" class="form-control">
                    <option value="">Select Brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- زر البحث -->
            <div class="col-lg-8 col-xl-9">
                <button id="search_btn" class="btn btn-primary">Search</button>
            </div>
        </div>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Brand</th>
                    <th>Categories</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($trucks as $truck)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $truck->title }}</td>
                        <td>{{ $truck->brand->name ?? 'N/A' }}</td>
                        <td>
                            @if ($truck->cat && count($truck->cat) > 0)
                                @foreach ($truck->cat as $category)
                                    <span class="badge bg-secondary">{{ $category->title }}</span>
                                @endforeach
                            @endif

                        </td>
                        <td>{{ $truck->price }} $</td>
                        <td>{{ ucfirst($truck->status) }}</td>
                        <td>
                            <a href="{{ route('carriertrucks.show', $truck->id) }}" class="btn btn-info btn-sm">RFQ</a>
                            <a href="{{ route('carriertrucks.edit', $truck->id) }}" class="btn btn-warning btn-sm">Book</a>
                            <form action="{{ route('carriertrucks.destroy', $truck->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Reservation</button>
                            </form>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary toggle-details" data-load-id="{{ $truck->id }}"
                                data-url="{{ route('trucks.details', $truck->id) }}">
                                +
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $trucks->links('pagination::bootstrap-4') }}
    </div>
    <!-- Pagination -->


    <script>
        document.getElementById('search_btn').addEventListener('click', function() {
            const availabilityFilter = document.getElementById('availability_filter').value;
            const ratingFilter = document.getElementById('rating_filter').value;
            const brandFilter = document.getElementById('brand_filter').value;

            // بناء رابط البحث مع الفلاتر
            const url = new URL(window.location.href);
            url.searchParams.set('availability_filter', availabilityFilter);
            url.searchParams.set('rating_filter', ratingFilter);
            url.searchParams.set('brand_filter', brandFilter);

            // إعادة تحميل الصفحة مع الفلاتر
            window.location.href = url.toString();
        });
    </script>
@endsection
