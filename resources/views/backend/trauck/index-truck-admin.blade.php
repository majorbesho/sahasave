@extends('backend.layouts.master')

@section('content')
    <div class="container">
        <h1>Trucks List</h1>
        <a href="{{ route('carriertrucks.create') }}" class="btn btn-primary mb-3">Create New Truck</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

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
                            <a href="{{ route('carriertrucks.show', $truck->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('carriertrucks.edit', $truck->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('carriertrucks.destroy', $truck->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
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

        <!-- Pagination -->
        {{ $trucks->links('pagination::bootstrap-4') }}
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-details');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const loadId = this.getAttribute('data-load-id');
                    const detailsRow = document.getElementById(`details-${loadId}`);
                    const url = this.getAttribute('data-url');

                    if (detailsRow.style.display === 'none') {
                        fetch(url)
                            .then(response => response.json())
                            .then(data => {
                                detailsRow.innerHTML = `
                                <td colspan="7">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">تفاصيل الحمولة #${loadId}</h5>
                                            <p class="card-text"><strong>الوصف:</strong> ${data.description}</p>
                                            <p class="card-text"><strong>نوع الشحنة:</strong> ${data.shipment}</p>
                                            <p class="card-text"><strong>طريقة الدفع:</strong> ${data.paymentType}</p>
                                            <p class="card-text"><strong>حالة الدفع:</strong> ${data.paymentStatus}</p>
                                            <p class="card-text"><strong>تاريخ التسليم:</strong> ${data.dropDate}</p>
                                            <p class="card-text"><strong>ملاحظات:</strong> ${data.loadNotes}</p>
                                        </div>
                                    </div>
                                </td>
                            `;
                                detailsRow.style.display = 'table-row';
                                this.textContent = '-';
                            })
                            .catch(error => console.error('Error fetching details:', error));
                    } else {
                        detailsRow.style.display = 'none';
                        this.textContent = '+';
                    }
                });
            });
        });
    </script>
@endsection
