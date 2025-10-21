@extends('broker.minlayout.master')
@section('content')
    <div class="col-lg-8 col-xl-9">
        <h1> My Loads List</h1>
        <a href="{{ route('broker-loads.create') }}" class="btn btn-primary mb-3">Create New Load </a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Address</th>
                    <th>W</th>
                    <th>LoadDate</th>
                    <th>Stat</th>
                    <th>Action</th>
                    <th>+</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loads as $load)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $load->title }}</td>
                        <td>{{ $load->weight }} كجم</td>
                        <td>{{ $load->loadDate }}</td>
                        <td>{{ $load->loadStatus }}</td>
                        <td>
                            <a href="{{ route('loads.show', $load->id) }}" class="btn btn-info btn-sm">عرض</a>
                            {{-- <a href="{{ route('loads.edit', $load->id) }}" class="btn btn-warning btn-sm">تعديل</a> --}}
                            {{-- <form action="{{ route('loads.destroy', $load->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('are you sure?')">Delete</button>
                            </form> --}}
                            <a href="{{ route('loads.show', $load->id) }}" class="btn btn-info btn-sm">BOL</a>
                            <a href="{{ route('loads.show', $load->id) }}" class="btn btn-info btn-sm">BOD</a>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary toggle-details" data-load-id="{{ $load->id }}"
                                data-url="{{ route('load.details', $load->id) }}">
                                +
                            </button>
                        </td>
                    </tr>
                    <!-- Hidden row for details -->
                    <tr id="details-{{ $load->id }}" style="display: none;">
                        <td colspan="7">
                            <!-- Details will be loaded here dynamically -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $loads->links('pagination::bootstrap-4') }}
    </div>



    {{-- <!-- Bootstrap Pagination -->
    {{ $loads->links('pagination::bootstrap-4') }}
    </div> --}}

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
