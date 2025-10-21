{{-- resources/views/admin/medical-centers/partials/form.blade.php --}}

<!-- المعلومات الأساسية -->
<div class="row">
    <div class="col-md-6">
        <h5>المعلومات الأساسية</h5>
        <hr>

        <div class="form-group">
            <label for="name">اسم المركز الطبي *</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $medicalCenter->name ?? '') }}" required>
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="type">نوع المركز *</label>
            <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                <option value="">اختر نوع المركز</option>
                <option value="clinic" {{ old('type', $medicalCenter->type ?? '') == 'clinic' ? 'selected' : '' }}>عيادة
                </option>
                <option value="medical_center"
                    {{ old('type', $medicalCenter->type ?? '') == 'medical_center' ? 'selected' : '' }}>مركز طبي
                </option>
                <option value="hospital" {{ old('type', $medicalCenter->type ?? '') == 'hospital' ? 'selected' : '' }}>
                    مستشفى</option>
                <option value="lab" {{ old('type', $medicalCenter->type ?? '') == 'lab' ? 'selected' : '' }}>مختبر
                </option>
            </select>
            @error('type')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">وصف المركز</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                rows="3">{{ old('description', $medicalCenter->description ?? '') }}</textarea>
            @error('description')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <h5>معلومات الاتصال</h5>
        <hr>

        <div class="form-group">
            <label for="email">البريد الإلكتروني</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                name="email" value="{{ old('email', $medicalCenter->email ?? '') }}">
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="phone">رقم الهاتف *</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                name="phone" value="{{ old('phone', $medicalCenter->phone ?? '') }}" required>
            @error('phone')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="website">الموقع الإلكتروني</label>
            <input type="url" class="form-control @error('website') is-invalid @enderror" id="website"
                name="website" value="{{ old('website', $medicalCenter->website ?? '') }}">
            @error('website')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<!-- العنوان -->
<div class="mt-3 row">
    <div class="col-12">
        <h5>العنوان</h5>
        <hr>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="address">العنوان التفصيلي *</label>
            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2"
                required>{{ old('address', $medicalCenter->address ?? '') }}</textarea>
            @error('address')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="city">المدينة *</label>
            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city"
                value="{{ old('city', $medicalCenter->city ?? '') }}" required>
            @error('city')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label for="state">المنطقة</label>
            <input type="text" class="form-control @error('state') is-invalid @enderror" id="state"
                name="state" value="{{ old('state', $medicalCenter->state ?? '') }}">
            @error('state')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="country">الدولة *</label>
            <select class="form-control @error('country') is-invalid @enderror" id="country" name="country" required>
                <option value="SA" {{ old('country', $medicalCenter->country ?? 'SA') == 'SA' ? 'selected' : '' }}>
                    المملكة العربية السعودية</option>
                <option value="EG" {{ old('country', $medicalCenter->country ?? '') == 'EG' ? 'selected' : '' }}>
                    مصر</option>
                <option value="AE" {{ old('country', $medicalCenter->country ?? '') == 'AE' ? 'selected' : '' }}>
                    الإمارات</option>
                <option value="QA" {{ old('country', $medicalCenter->country ?? '') == 'QA' ? 'selected' : '' }}>
                    قطر</option>
                <option value="KW" {{ old('country', $medicalCenter->country ?? '') == 'KW' ? 'selected' : '' }}>
                    الكويت</option>
                <option value="BH" {{ old('country', $medicalCenter->country ?? '') == 'BH' ? 'selected' : '' }}>
                    البحرين</option>
                <option value="OM" {{ old('country', $medicalCenter->country ?? '') == 'OM' ? 'selected' : '' }}>
                    عمان</option>
                <option value="JO" {{ old('country', $medicalCenter->country ?? '') == 'JO' ? 'selected' : '' }}>
                    الأردن</option>
                <option value="LB" {{ old('country', $medicalCenter->country ?? '') == 'LB' ? 'selected' : '' }}>
                    لبنان</option>
            </select>
            @error('country')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="postal_code">الرمز البريدي</label>
            <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code"
                name="postal_code" value="{{ old('postal_code', $medicalCenter->postal_code ?? '') }}">
            @error('postal_code')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="latitude">خط العرض</label>
            <input type="number" step="any" class="form-control @error('latitude') is-invalid @enderror"
                id="latitude" name="latitude" value="{{ old('latitude', $medicalCenter->latitude ?? '') }}">
            @error('latitude')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="longitude">خط الطول</label>
            <input type="number" step="any" class="form-control @error('longitude') is-invalid @enderror"
                id="longitude" name="longitude" value="{{ old('longitude', $medicalCenter->longitude ?? '') }}">
            @error('longitude')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<!-- الخدمات والمرافق -->
<div class="mt-3 row">
    <div class="col-md-4">
        <h5>الخدمات المقدمة</h5>
        <hr>
        <div class="form-group">
            @php
                $selectedServices = old('services', $medicalCenter->services ?? []);
                if (is_string($selectedServices)) {
                    $selectedServices = json_decode($selectedServices, true) ?? [];
                }
            @endphp

            @foreach ([
        'استشارات طبية' => 'medical_consultations',
        'فحوصات مخبرية' => 'lab_tests',
        'أشعة وتصوير' => 'radiology',
        'طوارئ' => 'emergency',
        'عمليات جراحية' => 'surgery',
        'رعاية أسنان' => 'dental_care',
        'عيون' => 'eye_care',
        'أمراض جلدية' => 'dermatology',
        'أمراض نسائية' => 'gynecology',
        'أطفال' => 'pediatrics',
        'علاج طبيعي' => 'physiotherapy',
        'تغذية' => 'nutrition',
        'صحة نفسية' => 'mental_health',
    ] as $label => $value)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="services[]" value="{{ $value }}"
                        id="service_{{ $value }}" {{ in_array($value, $selectedServices) ? 'checked' : '' }}>
                    <label class="form-check-label" for="service_{{ $value }}">
                        {{ $label }}
                    </label>
                </div>
            @endforeach
            @error('services')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <h5>المرافق المتاحة</h5>
        <hr>
        <div class="form-group">
            @php
                $selectedFacilities = old('facilities', $medicalCenter->facilities ?? []);
                if (is_string($selectedFacilities)) {
                    $selectedFacilities = json_decode($selectedFacilities, true) ?? [];
                }
            @endphp

            @foreach ([
        'مواقف سيارات' => 'parking',
        'إنترنت لاسلكي' => 'wifi',
        'تكييف' => 'ac',
        'مصلى' => 'prayer_room',
        'كافيتيريا' => 'cafeteria',
        'صيدلية' => 'pharmacy',
        'غرف انتظار مريحة' => 'waiting_rooms',
        'مدخل لذوي الاحتياجات' => 'disabled_access',
        'خدمة التوصيل' => 'delivery_service',
        'دفع إلكتروني' => 'electronic_payment',
    ] as $label => $value)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="facilities[]" value="{{ $value }}"
                        id="facility_{{ $value }}"
                        {{ in_array($value, $selectedFacilities) ? 'checked' : '' }}>
                    <label class="form-check-label" for="facility_{{ $value }}">
                        {{ $label }}
                    </label>
                </div>
            @endforeach
            @error('facilities')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <h5>شركات التأمين المقبولة</h5>
        <hr>
        <div class="form-group">
            @php
                $selectedInsurance = old('insurance_providers', $medicalCenter->insurance_providers ?? []);
                if (is_string($selectedInsurance)) {
                    $selectedInsurance = json_decode($selectedInsurance, true) ?? [];
                }
            @endphp

            @foreach ([
        'بوبا العربية' => 'bupa_arabia',
        'الشركة العربية' => 'arabia_insurance',
        'الجزيرة' => 'aljazira',
        'أكسا' => 'axa',
        'تكافل' => 'takaful',
        'المتحدة' => 'united',
        'أسيج' => 'aseg',
        'سلامة' => 'salama',
        'أسيان' => 'asian',
        'أخرى' => 'other',
    ] as $label => $value)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="insurance_providers[]"
                        value="{{ $value }}" id="insurance_{{ $value }}"
                        {{ in_array($value, $selectedInsurance) ? 'checked' : '' }}>
                    <label class="form-check-label" for="insurance_{{ $value }}">
                        {{ $label }}
                    </label>
                </div>
            @endforeach
            @error('insurance_providers')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<!-- التخصصات -->
<div class="mt-3 row">
    <div class="col-12">
        <h5>التخصصات المتاحة</h5>
        <hr>
        <div class="form-group">
            @php
                $selectedSpecialties = old('specialties', $medicalCenter->specialties ?? []);
                if (is_string($selectedSpecialties)) {
                    $selectedSpecialties = json_decode($selectedSpecialties, true) ?? [];
                }
            @endphp

            <div class="row">
                @foreach ($specialties as $specialty)
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="specialties[]"
                                value="{{ $specialty->id }}" id="specialty_{{ $specialty->id }}"
                                {{ in_array($specialty->id, $selectedSpecialties) ? 'checked' : '' }}>
                            <label class="form-check-label" for="specialty_{{ $specialty->id }}">
                                {{ $specialty->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            @error('specialties')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<!-- ساعات العمل -->
<div class="mt-3 row">
    <div class="col-12">
        <h5>ساعات العمل</h5>
        <hr>

        @php
            $workingHours = old('working_hours', $medicalCenter->working_hours ?? []);
            if (is_string($workingHours)) {
                $workingHours = json_decode($workingHours, true) ?? [];
            }

            $days = [
                'sunday' => 'الأحد',
                'monday' => 'الإثنين',
                'tuesday' => 'الثلاثاء',
                'wednesday' => 'الأربعاء',
                'thursday' => 'الخميس',
                'friday' => 'الجمعة',
                'saturday' => 'السبت',
            ];
        @endphp

        @foreach ($days as $dayKey => $dayName)
            <div class="mb-2 row">
                <div class="col-md-2">
                    <label class="font-weight-bold">{{ $dayName }}</label>
                </div>
                <div class="col-md-2">
                    <input type="time" class="form-control" name="working_hours[{{ $dayKey }}][open]"
                        value="{{ $workingHours[$dayKey]['open'] ?? '08:00' }}">
                </div>
                <div class="col-md-2">
                    <input type="time" class="form-control" name="working_hours[{{ $dayKey }}][close]"
                        value="{{ $workingHours[$dayKey]['close'] ?? '17:00' }}">
                </div>
                <div class="col-md-2">
                    <div class="mt-2 form-check">
                        <input class="form-check-input" type="checkbox"
                            name="working_hours[{{ $dayKey }}][closed]" value="1"
                            {{ isset($workingHours[$dayKey]['closed']) && $workingHours[$dayKey]['closed'] ? 'checked' : '' }}>
                        <label class="form-check-label">مغلق</label>
                    </div>
                </div>
            </div>
        @endforeach
        @error('working_hours')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

<!-- الإعدادات -->
<div class="mt-3 row">
    <div class="col-md-4">
        <h5>الإعدادات</h5>
        <hr>

        <div class="form-group">
            <label for="status">حالة المركز *</label>
            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status"
                required>
                <option value="active"
                    {{ old('status', $medicalCenter->status ?? '') == 'active' ? 'selected' : '' }}>نشط</option>
                <option value="inactive"
                    {{ old('status', $medicalCenter->status ?? '') == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                <option value="pending"
                    {{ old('status', $medicalCenter->status ?? '') == 'pending' ? 'selected' : '' }}>قيد المراجعة
                </option>
            </select>
            @error('status')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-2 form-check">
            <input class="form-check-input" type="checkbox" name="is_verified" value="1" id="is_verified"
                {{ old('is_verified', $medicalCenter->is_verified ?? '') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_verified">
                مركز معتمد
            </label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="is_featured"
                {{ old('is_featured', $medicalCenter->is_featured ?? '') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_featured">
                مركز مميز
            </label>
        </div>
    </div>
</div>
