@extends('carrier.minlayout.master')
@section('content')
    <div class="container">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <ul><i>{{ $error }} </i></ul>
                    @endforeach
                </div>
            @endif
        </div>
    </div>



    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">إضافة شاحنة جديدة</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('carriertrucks.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- المعلومات الأساسية -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">المعلومات الأساسية</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="title" class="form-label">اسم الشاحنة <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="truck_type" class="form-label">نوع الشاحنة <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="truck_type" name="truck_type"
                                            required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="license_plate" class="form-label">رقم اللوحة <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="license_plate" name="license_plate"
                                            required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="capacity" class="form-label">السعة <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="capacity" name="capacity" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">الوصف</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                            </div>

                            <!-- الصور -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">الصور</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="photo" class="form-label">الصورة الرئيسية</label>
                                        <input type="file" class="form-control" id="photo" name="photo"
                                            accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="photos" class="form-label">صور إضافية</label>
                                        <input type="file" class="form-control" id="photos" name="photos[]" multiple
                                            accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <!-- الأبعاد والوزن -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">الأبعاد والوزن</h5>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label for="length" class="form-label">الطول (متر) <span
                                                class="text-danger">*</span></label>
                                        <input type="number" step="0.01" class="form-control" id="length"
                                            name="length" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="width" class="form-label">العرض (متر) <span
                                                class="text-danger">*</span></label>
                                        <input type="number" step="0.01" class="form-control" id="width"
                                            name="width" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="height" class="form-label">الارتفاع (متر) <span
                                                class="text-danger">*</span></label>
                                        <input type="number" step="0.01" class="form-control" id="height"
                                            name="height" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="weight" class="form-label">الوزن (كجم) <span
                                                class="text-danger">*</span></label>
                                        <input type="number" step="0.01" class="form-control" id="weight"
                                            name="weight" required>
                                    </div>
                                </div>
                            </div>

                            <!-- الموقع -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">الموقع</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="location_country" class="form-label">الدولة <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="location_country"
                                            name="location_country" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="location_city" class="form-label">المدينة <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="location_city"
                                            name="location_city" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="latitude" class="form-label">خط العرض</label>
                                        <input type="number" step="0.000001" class="form-control" id="latitude"
                                            name="latitude">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="longitude" class="form-label">خط الطول</label>
                                        <input type="number" step="0.000001" class="form-control" id="longitude"
                                            name="longitude">
                                    </div>
                                </div>
                            </div>

                            <!-- السعر والحالة -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">السعر والحالة</h5>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="price" class="form-label">السعر <span
                                                class="text-danger">*</span></label>
                                        <input type="number" step="0.01" class="form-control" id="price"
                                            name="price" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="offer_price" class="form-label">سعر العرض</label>
                                        <input type="number" step="0.01" class="form-control" id="offer_price"
                                            name="offer_price">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="condition" class="form-label">الحالة <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" id="condition" name="condition" required>
                                            @foreach ($conditions as $condition)
                                                <option value="{{ $condition }}">
                                                    {{ __('trucks.condition_' . $condition) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">حالة التوفر</label>
                                        <select class="form-select" id="status" name="status">
                                            @foreach ($statuses as $status)
                                                <option value="{{ $status }}">{{ __('trucks.status_' . $status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- المواصفات الفنية -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">المواصفات الفنية</h5>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="specification[engine_type]" class="form-label">نوع المحرك</label>
                                        <input type="text" class="form-control" id="specification[engine_type]"
                                            name="specification[engine_type]">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="specification[fuel_type]" class="form-label">نوع الوقود</label>
                                        <input type="text" class="form-control" id="specification[fuel_type]"
                                            name="specification[fuel_type]">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="specification[transmission]" class="form-label">ناقل الحركة</label>
                                        <input type="text" class="form-control" id="specification[transmission]"
                                            name="specification[transmission]">
                                    </div>
                                </div>
                            </div>

                            <!-- أوقات التوفر -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2">أوقات التوفر</h5>
                                <div id="availabilities-container">
                                    <div class="availability-item row mb-3">
                                        <div class="col-md-5">
                                            <label class="form-label">تاريخ البدء</label>
                                            <input type="date" class="form-control"
                                                name="availabilities[0][start_date]">
                                        </div>
                                        <div class="col-md-5">
                                            <label class="form-label">تاريخ الانتهاء</label>
                                            <input type="date" class="form-control"
                                                name="availabilities[0][end_date]">
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger remove-availability">حذف</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="add-availability" class="btn btn-secondary">إضافة وقت
                                    توفر</button>
                            </div>

                            <!-- أزرار الحفظ والإلغاء -->
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">حفظ الشاحنة</button>
                                <a href="{{ route('carriertrucks.index') }}" class="btn btn-outline-secondary">إلغاء</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // إضافة وقت توفر جديد
        document.getElementById('add-availability').addEventListener('click', function() {
            const container = document.getElementById('availabilities-container');
            const index = container.children.length;

            const newItem = document.createElement('div');
            newItem.className = 'availability-item row mb-3';
            newItem.innerHTML = `
            <div class="col-md-5">
                <label class="form-label">تاريخ البدء</label>
                <input type="date" class="form-control" name="availabilities[${index}][start_date]">
            </div>
            <div class="col-md-5">
                <label class="form-label">تاريخ الانتهاء</label>
                <input type="date" class="form-control" name="availabilities[${index}][end_date]">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-availability">حذف</button>
            </div>
        `;

            container.appendChild(newItem);
        });

        // حذف وقت توفر
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-availability')) {
                e.target.closest('.availability-item').remove();
            }
        });
    </script>


    {{-- <div class="container">
        <div class="col-12"></div>
        <h1 class="mb-4">Create New Truck</h1>
        <form action="{{ route('carriertrucks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Column 1 -->
                <div class="col-md-6">
                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <!-- Photo -->
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label mb-2 d-block">Status</label>
                        <select class="form-select w-100" id="status" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                    </div>

                    <!-- Offer Price -->
                    <div class="mb-3">
                        <label for="offer_price" class="form-label">Offer Price</label>
                        <input type="number" class="form-control" id="offer_price" name="offer_price" step="0.01">
                    </div>

                    <!-- Condition -->
                    <div class="mb-3">
                        <label for="condition" class="form-label mb-2 d-block">Condition</label>
                        <select class="form-select w-100" id="condition" name="condition">
                            <option value="new">New</option>
                            <option value="used">Used</option>
                            <option value="refurbished">Refurbished</option>
                        </select>
                    </div>

                    <!-- Brand -->
                    <div class="mb-3">
                        <label for="brand_id" class="form-label">Brand</label>
                        <select class="form-control" id="brand_id" name="brand_id">
                            <option value="">Select Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="cat_id" class="form-label">Category</label>
                        <select class="form-control" id="cat_id" name="cat_id">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Column 2 -->
                <div class="col-md-6">
                    <!-- Truck Type -->
                    <div class="mb-3">
                        <label for="truck_type" class="form-label">Truck Type</label>
                        <input type="text" class="form-control" id="truck_type" name="truck_type">
                    </div>

                    <!-- License Plate -->
                    <div class="mb-3">
                        <label for="license_plate" class="form-label">License Plate</label>
                        <input type="text" class="form-control" id="license_plate" name="license_plate">
                    </div>

                    <!-- Capacity -->
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacity (kg)</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" step="0.01">
                    </div>

                    <!-- Trucks Category -->
                    <div class="mb-3">
                        <label for="trucks_category" class="form-label">Trucks Category</label>
                        <input type="text" class="form-control" id="trucks_category" name="trucks_category">
                    </div>

                    <!-- Location Country -->
                    <div class="mb-3">
                        <label for="location_country" class="form-label">Location Country</label>
                        <input type="text" class="form-control" id="location_country" name="location_country">
                    </div>

                    <!-- Location City -->
                    <div class="mb-3">
                        <label for="location_city" class="form-label">Location City</label>
                        <input type="text" class="form-control" id="location_city" name="location_city">
                    </div>

                    <!-- Latitude -->
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="number" class="form-control" id="latitude" name="latitude" step="0.00000001">
                    </div>

                    <!-- Longitude -->
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="number" class="form-control" id="longitude" name="longitude" step="0.00000001">
                    </div>

                    <!-- Length -->
                    <div class="mb-3">
                        <label for="length" class="form-label">Length</label>
                        <input type="number" class="form-control" id="length" name="length" step="0.01">
                    </div>

                    <!-- Width -->
                    <div class="mb-3">
                        <label for="width" class="form-label">Width</label>
                        <input type="number" class="form-control" id="width" name="width" step="0.01">
                    </div>

                    <!-- Height -->
                    <div class="mb-3">
                        <label for="height" class="form-label">Height</label>
                        <input type="number" class="form-control" id="height" name="height" step="0.01">
                    </div>

                    <!-- Weight -->
                    <div class="mb-3">
                        <label for="weight" class="form-label">Weight</label>
                        <input type="number" class="form-control" id="weight" name="weight" step="0.01">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Create Truck</button>
            </div>
        </form>
    </div> --}}
@endsection


















{{-- @extends('carrier.minlayout.master')



@section('content')


    <div class="container">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <ul><i>{{ $error }} </i></ul>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <div class="container">
        <div class="col-12"></div>
        <h1 class="mb-4">Create New Truck</h1>
        <form action="{{ route('carriertrucks.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Column 1 -->
                <div class="col-md-6">
                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <!-- Photo -->
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                    </div>

                    <!-- Status -->
                    <div class="row">
                        <div class="mb-3">
                            <label for="status" class="form-label mb-2 d-block">Status</label>
                            <select class="form-select w-100" id="status" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01"
                                required>
                        </div>

                        <!-- Offer Price -->
                        <div class="mb-3">
                            <label for="offer_price" class="form-label">Offer Price</label>
                            <input type="number" class="form-control" id="offer_price" name="offer_price" step="0.01">
                        </div>

                        <!-- Condition -->
                        <div class="mb-3">
                            <label for="condition" class="form-label mb-2 d-block">Condition</label>
                            <select class="form-select w-100" id="condition" name="condition">
                                <option value="new">New</option>
                                <option value="used">Used</option>
                                <option value="refurbished">Refurbished</option>
                            </select>
                        </div>

                    </div>
                </div>

                <!-- Column 2 -->
                <div class="col-md-6">
                    <!-- Truck Type -->
                    <div class="mb-3">
                        <label for="truck_type" class="form-label">Truck Type</label>
                        <input type="text" class="form-control" id="truck_type" name="truck_type">
                    </div>

                    <!-- License Plate -->
                    <div class="mb-3">
                        <label for="license_plate" class="form-label">License Plate</label>
                        <input type="text" class="form-control" id="license_plate" name="license_plate">
                    </div>

                    <!-- Capacity -->
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacity (kg)</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" step="0.01">
                    </div>

                    <!-- Trucks Category -->
                    <div class="mb-3">
                        <label for="trucks_category" class="form-label">Trucks Category</label>
                        <input type="text" class="form-control" id="trucks_category" name="trucks_category">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Create Truck</button>
            </div>
        </form>
    </div>

@endsection --}}
