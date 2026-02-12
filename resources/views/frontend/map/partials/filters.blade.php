<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white py-3">
        <h6 class="mb-0">
            <i class="fas fa-filter"></i> @lang('map.filter_results')
        </h6>
    </div>
    <div class="card-body">
        <form id="filter-form" method="GET" action="{{ route('map.index') }}">
            <!-- نوع المركز -->
            <div class="mb-3">
                <label class="form-label small fw-bold">@lang('map.center_type')</label>
                <select name="type" class="form-select form-select-sm filter-control">
                    <option value="">@lang('map.all_types')</option>
                    <option value="clinic" {{ request('type') == 'clinic' ? 'selected' : '' }}>@lang('map.clinic')</option>
                    <option value="hospital" {{ request('type') == 'hospital' ? 'selected' : '' }}>@lang('map.hospital')</option>
                    <option value="medical_center" {{ request('type') == 'medical_center' ? 'selected' : '' }}>@lang('map.medical_center_type')</option>
                    <option value="lab" {{ request('type') == 'lab' ? 'selected' : '' }}>@lang('map.lab')</option>
                    <option value="pharmacy" {{ request('type') == 'pharmacy' ? 'selected' : '' }}>@lang('map.pharmacy')</option>
                </select>
            </div>
            
            <!-- المدينة -->
            <div class="mb-3">
                <label class="form-label small fw-bold">@lang('map.city')</label>
                <select name="city" class="form-select form-select-sm filter-control">
                    <option value="">@lang('map.all_cities')</option>
                    @foreach($cities as $city)
                        <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                            {{ $city }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <!-- التخصصات -->
            @if(!empty($specialties))
            <div class="mb-3">
                <label class="form-label small fw-bold">@lang('map.specialty')</label>
                <select name="specialty" class="form-select form-select-sm filter-control">
                    <option value="">@lang('map.all_specialties')</option>
                    @foreach($specialties as $specialty)
                        <option value="{{ $specialty }}" {{ request('specialty') == $specialty ? 'selected' : '' }}>
                            {{ $specialty }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif
            
            <!-- التقييم الأدنى -->
            <div class="mb-3">
                <label class="form-label small fw-bold">@lang('map.min_rating')</label>
                <select name="rating_min" class="form-select form-select-sm filter-control">
                    <option value="">@lang('map.all_ratings')</option>
                    <option value="4.5" {{ request('rating_min') == '4.5' ? 'selected' : '' }}>@lang('map.stars_up_4_5')</option>
                    <option value="4" {{ request('rating_min') == '4' ? 'selected' : '' }}>@lang('map.stars_up', ['rating' => 4])</option>
                    <option value="3.5" {{ request('rating_min') == '3.5' ? 'selected' : '' }}>@lang('map.stars_up_3_5')</option>
                    <option value="3" {{ request('rating_min') == '3' ? 'selected' : '' }}>@lang('map.stars_up', ['rating' => 3])</option>
                    <option value="2" {{ request('rating_min') == '2' ? 'selected' : '' }}>@lang('map.stars_up', ['rating' => 2])</option>
                </select>
            </div>
            
            <!-- خيارات إضافية -->
            <div class="mb-3">
                <label class="form-label small fw-bold">@lang('map.options')</label>
                <div class="form-check mb-2">
                    <input class="form-check-input filter-control" type="checkbox" name="is_verified" 
                           value="true" id="verified" {{ request('is_verified') == 'true' ? 'checked' : '' }}>
                    <label class="form-check-label small" for="verified">
                        <i class="fas fa-check-circle text-success"></i> @lang('map.verified_only')
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input filter-control" type="checkbox" name="has_doctors" 
                           value="true" id="hasDoctors" {{ request('has_doctors') == 'true' ? 'checked' : '' }}>
                    <label class="form-check-label small" for="hasDoctors">
                        <i class="fas fa-user-md text-primary"></i> @lang('map.with_doctors_only')
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input filter-control" type="checkbox" name="is_featured" 
                           value="true" id="featured" {{ request('is_featured') == 'true' ? 'checked' : '' }}>
                    <label class="form-check-label small" for="featured">
                        <i class="fas fa-star text-warning"></i> @lang('map.featured_only')
                    </label>
                </div>
            </div>
            
            <!-- أزرار -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fas fa-search"></i> @lang('map.apply_filters')
                </button>
                <a href="{{ route('map.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-redo"></i> @lang('map.reset')
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Legend Card -->
<div class="card shadow-sm mt-3">
    <div class="card-header bg-light py-3">
        <h6 class="mb-0">
            <i class="fas fa-info-circle text-info"></i> @lang('map.legend')
        </h6>
    </div>
    <div class="card-body">
        <div class="legend-item mb-2 d-flex align-items-center">
            <span class="legend-color" style="background-color: #3498db; width: 20px; height: 20px; border-radius: 50%; margin-inline-end: 10px; display: inline-block;"></span>
            <span class="legend-text small">@lang('map.clinic')</span>
        </div>
        <div class="legend-item mb-2 d-flex align-items-center">
            <span class="legend-color" style="background-color: #e74c3c; width: 20px; height: 20px; border-radius: 50%; margin-inline-end: 10px; display: inline-block;"></span>
            <span class="legend-text small">@lang('map.hospital')</span>
        </div>
        <div class="legend-item mb-2 d-flex align-items-center">
            <span class="legend-color" style="background-color: #2ecc71; width: 20px; height: 20px; border-radius: 50%; margin-inline-end: 10px; display: inline-block;"></span>
            <span class="legend-text small">@lang('map.medical_center')</span>
        </div>
        <div class="legend-item mb-2 d-flex align-items-center">
            <span class="legend-color" style="background-color: #9b59b6; width: 20px; height: 20px; border-radius: 50%; margin-inline-end: 10px; display: inline-block;"></span>
            <span class="legend-text small">@lang('map.lab')</span>
        </div>
        <div class="legend-item mb-2 d-flex align-items-center">
            <span class="legend-color" style="background-color: #f39c12; width: 20px; height: 20px; border-radius: 50%; margin-inline-end: 10px; display: inline-block;"></span>
            <span class="legend-text small">@lang('map.pharmacy')</span>
        </div>
        <div class="legend-item mb-2 d-flex align-items-center">
            <span class="legend-color" style="background-color: #4CAF50; width: 20px; height: 20px; border-radius: 50%; margin-inline-end: 10px; display: inline-block;"></span>
            <span class="legend-text small">@lang('map.doctor')</span>
        </div>
    </div>
</div>