@extends('frontend.layouts.master')

@section('content')
    <style>
        .search-container {
            background-color: #fff;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 900px;
        }

        .search-container h2 {
            text-align: center;
            margin-bottom: 1rem;
            color: #333;
        }

        .form-row {
            display: flex;
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
        }

        .btn-primary {
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 500;
        }
    </style>


    <div class="search-container">
        <h2>Search Parameters</h2>
        <form id="searchForm">
            <div class="form-row">
                <!-- Origin -->
                <div class="form-group">
                    <label for="origin">Origin</label>
                    <input type="text" class="form-control" id="origin" placeholder="Origin">
                </div>

                <!-- Weight -->
                <div class="form-group">
                    <label for="weight">Weight</label>
                    <input type="number" class="form-control" id="weight" placeholder="Weight">
                </div>

                <!-- Length -->
                <div class="form-group">
                    <label for="length">Length</label>
                    <input type="number" class="form-control" id="length" placeholder="Length">
                </div>

                <!-- Destination -->
                <div class="form-group">
                    <label for="destination">Destination</label>
                    <input type="text" class="form-control" id="destination" placeholder="Destination">
                </div>

                <!-- Date -->
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date">
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" placeholder="Price">
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- JavaScript for form handling -->
    <script>
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const origin = document.getElementById('origin').value;
            const weight = document.getElementById('weight').value;
            const length = document.getElementById('length').value;
            const destination = document.getElementById('destination').value;
            const date = document.getElementById('date').value;
            const price = document.getElementById('price').value;

            const searchParams = {
                origin,
                weight,
                length,
                destination,
                date,
                price
            };

            console.log('Search Parameters:', searchParams);

            // Add your search logic here (e.g., send data to a server)
        });
    </script>
@endsection
