@extends('frontend.layouts.master')

@section('content')
    <div class="breadcrumb-bar">
        <div class="container">
            <div class="row align-items-center inner-banner">
                <div class="text-center col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="isax isax-home-15"></i></a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Patient</li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                        <h2 class="breadcrumb-title">Settings</h2>
                    </nav>
                </div>
            </div>
        </div>
        <div class="breadcrumb-bg">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-01.png') }}" alt="img"
                class="breadcrumb-bg-01">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-bg-02.png') }}" alt="img"
                class="breadcrumb-bg-02">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-03">
            <img src="{{ asset('frontend/xx/assets/img/bg/breadcrumb-icon.png') }}" alt="img" class="breadcrumb-bg-04">
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-xl-3 theiaStickySidebar">
                    <!-- Profile Sidebar -->
                    @include('patient.sidebar')
                </div>

                <div class="col-lg-8 col-xl-9">
                    <nav class="mb-1 settings-tab">
                        <ul class="nav nav-tabs-bottom" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" href="#profile" data-bs-toggle="tab">Profile</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="#password" data-bs-toggle="tab">Change Password</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="#notifications" data-bs-toggle="tab">Notifications</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="#delete-account" data-bs-toggle="tab">Delete Account</a>
                            </li>
                        </ul>
                    </nav>

                    <div class="tab-content">
                        <!-- Tab 1: Profile Settings -->
                        <div class="tab-pane fade show active" id="profile">
                            <div class="card">
                                <div class="card-body">
                                    <div class="pb-3 mb-3 border-bottom">
                                        <h5>Profile Settings</h5>
                                    </div>

                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <form action="{{ route('patient.profile.settings.update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="setting-card">
                                            <label class="mb-2 form-label">Profile Photo</label>
                                            <div class="change-avatar img-upload">
                                                <div class="profile-img">
                                                    @if (Auth::user()->photo)
                                                        <img src="{{ asset('storage/profiles/' . Auth::user()->photo) }}"
                                                            alt="Profile"
                                                            style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                                                    @else
                                                        <i class="fa-solid fa-file-image" style="font-size: 48px;"></i>
                                                    @endif
                                                </div>
                                                <div class="upload-img">
                                                    <div class="imgs-load d-flex align-items-center">
                                                        <div class="change-photo">
                                                            Upload New
                                                            <input type="file" name="photo" class="upload"
                                                                accept="image/*">
                                                        </div>
                                                        @if (Auth::user()->photo)
                                                            <a href="#" class="upload-remove"
                                                                id="remove-photo">Remove</a>
                                                        @endif
                                                    </div>
                                                    <p>Your Image should Below 4 MB, Accepted format jpg,png,svg</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="setting-title">
                                            <h6>Personal Information</h6>
                                        </div>
                                        <div class="setting-card">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Full Name <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ old('name', $user->name) }}" required>
                                                        @error('name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Email Address <span
                                                                class="text-danger">*</span></label>
                                                        <input type="email" name="email" class="form-control"
                                                            value="{{ old('email', $user->email) }}" required>
                                                        @error('email')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Phone Number <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" name="phone" class="form-control"
                                                            value="{{ old('phone', $user->phone) }}" required>
                                                        @error('phone')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Date of Birth</label>
                                                        <input type="date" name="date_of_birth" class="form-control"
                                                            value="{{ old('date_of_birth', $user->date_of_birth ? $user->date_of_birth->format('Y-m-d') : '') }}">
                                                        @error('date_of_birth')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Gender <span
                                                                class="text-danger">*</span></label>
                                                        <select name="gender" class="form-select" required>
                                                            <option value="">Select Gender</option>
                                                            <option value="male"
                                                                {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>
                                                                Male</option>
                                                            <option value="female"
                                                                {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>
                                                                Female</option>
                                                        </select>
                                                        @error('gender')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nationality</label>
                                                        <input type="text" name="nationality" class="form-control"
                                                            value="{{ old('nationality', $user->nationality) }}">
                                                        @error('nationality')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="setting-title">
                                            <h6>Medical Information</h6>
                                        </div>
                                        <div class="setting-card">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Blood Group</label>
                                                        <select name="blood_group" class="form-select">
                                                            <option value="">Select Blood Group</option>
                                                            <option value="A+"
                                                                {{ old('blood_group', $medicalProfile->blood_group) == 'A+' ? 'selected' : '' }}>
                                                                A+</option>
                                                            <option value="A-"
                                                                {{ old('blood_group', $medicalProfile->blood_group) == 'A-' ? 'selected' : '' }}>
                                                                A-</option>
                                                            <option value="B+"
                                                                {{ old('blood_group', $medicalProfile->blood_group) == 'B+' ? 'selected' : '' }}>
                                                                B+</option>
                                                            <option value="B-"
                                                                {{ old('blood_group', $medicalProfile->blood_group) == 'B-' ? 'selected' : '' }}>
                                                                B-</option>
                                                            <option value="AB+"
                                                                {{ old('blood_group', $medicalProfile->blood_group) == 'AB+' ? 'selected' : '' }}>
                                                                AB+</option>
                                                            <option value="AB-"
                                                                {{ old('blood_group', $medicalProfile->blood_group) == 'AB-' ? 'selected' : '' }}>
                                                                AB-</option>
                                                            <option value="O+"
                                                                {{ old('blood_group', $medicalProfile->blood_group) == 'O+' ? 'selected' : '' }}>
                                                                O+</option>
                                                            <option value="O-"
                                                                {{ old('blood_group', $medicalProfile->blood_group) == 'O-' ? 'selected' : '' }}>
                                                                O-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Height (cm)</label>
                                                        <input type="number" name="height" class="form-control"
                                                            value="{{ old('height', $medicalProfile->height) }}"
                                                            step="0.1">
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Weight (kg)</label>
                                                        <input type="number" name="weight" class="form-control"
                                                            value="{{ old('weight', $medicalProfile->weight) }}"
                                                            step="0.1">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Allergies</label>
                                                        <textarea name="allergies" class="form-control" rows="3" placeholder="List any allergies you have...">{{ old('allergies', $medicalProfile->allergies) }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Chronic Conditions</label>
                                                        <textarea name="chronic_conditions" class="form-control" rows="3"
                                                            placeholder="List any chronic medical conditions...">{{ old('chronic_conditions', $medicalProfile->chronic_conditions) }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Current Medications</label>
                                                        <textarea name="current_medications" class="form-control" rows="3"
                                                            placeholder="List any current medications...">{{ old('current_medications', $medicalProfile->current_medications) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="setting-title">
                                            <h6>Emergency Contact</h6>
                                        </div>
                                        <div class="setting-card">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Emergency Contact Name</label>
                                                        <input type="text" name="emergency_contact"
                                                            class="form-control"
                                                            value="{{ old('emergency_contact', $user->emergency_contact) }}">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Emergency Phone</label>
                                                        <input type="text" name="emergency_phone" class="form-control"
                                                            value="{{ old('emergency_phone', $user->emergency_phone) }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="setting-title">
                                            <h6>Address</h6>
                                        </div>
                                        <div class="setting-card">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Address</label>
                                                        <textarea name="address" class="form-control" rows="3" placeholder="Enter your full address...">{{ old('address', $user->address) }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-btn text-end">
                                            <button type="reset"
                                                class="btn btn-md btn-light rounded-pill">Cancel</button>
                                            <button type="submit"
                                                class="btn btn-md btn-primary-gradient rounded-pill">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 2: Change Password -->
                        <div class="tab-pane fade" id="password">
                            <div class="card">
                                <div class="card-body">
                                    <div class="pb-3 mb-3 border-bottom">
                                        <h5>Change Password</h5>
                                    </div>

                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <form action="{{ route('patient.change.password') }}" method="POST">
                                        @csrf
                                        <div class="setting-card">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Current Password <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" name="current_password"
                                                            class="form-control" required>
                                                        @error('current_password')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">New Password <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" name="new_password" class="form-control"
                                                            required>
                                                        @error('new_password')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Confirm New Password <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" name="new_password_confirmation"
                                                            class="form-control" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-btn text-end">
                                            <button type="submit"
                                                class="btn btn-md btn-primary-gradient rounded-pill">Update
                                                Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 3: Notifications -->
                        <div class="tab-pane fade" id="notifications">
                            <div class="card">
                                <div class="card-body">
                                    <div class="pb-3 mb-3 border-bottom">
                                        <h5>Notification Settings</h5>
                                    </div>

                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <form action="{{ route('patient.notifications.update') }}" method="POST">
                                        @csrf
                                        <div class="setting-card">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3 form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="push_notifications" id="pushNotifications"
                                                            {{ $user->push_notifications ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="pushNotifications">
                                                            Push Notifications
                                                        </label>
                                                    </div>
                                                    <div class="mb-3 form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="email_notifications" id="emailNotifications"
                                                            {{ $user->email_notifications ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="emailNotifications">
                                                            Email Notifications
                                                        </label>
                                                    </div>
                                                    <div class="mb-3 form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="sms_notifications" id="smsNotifications"
                                                            {{ $user->sms_notifications ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="smsNotifications">
                                                            SMS Notifications
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-btn text-end">
                                            <button type="submit"
                                                class="btn btn-md btn-primary-gradient rounded-pill">Save Settings</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 4: Delete Account -->
                        <div class="tab-pane fade" id="delete-account">
                            <div class="card">
                                <div class="card-body">
                                    <div class="pb-3 mb-3 border-bottom">
                                        <h5>Delete Account</h5>
                                    </div>

                                    <div class="alert alert-warning">
                                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Warning</h6>
                                        <p class="mb-0">Once you delete your account, there is no going back. Please be
                                            certain.</p>
                                    </div>

                                    <form action="{{ route('patient.delete.account') }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                                        @csrf
                                        <div class="setting-card">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Enter your password to confirm <span
                                                                class="text-danger">*</span></label>
                                                        <input type="password" name="password" class="form-control"
                                                            required>
                                                        @error('password')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-btn text-end">
                                            <button type="submit" class="btn btn-md btn-danger rounded-pill">Delete My
                                                Account</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // معالجة إزالة الصورة
            document.getElementById('remove-photo')?.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to remove your profile photo?')) {
                    // يمكنك إضافة منطق AJAX لحذف الصورة
                    fetch('{{ route('patient.profile.settings.update') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                remove_photo: true
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            }
                        });
                }
            });

            // عرض معاينة الصورة قبل الرفع
            document.querySelector('input[name="photo"]')?.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 4 * 1024 * 1024) {
                        alert('File size must be less than 4MB');
                        this.value = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100px';
                        img.style.height = '100px';
                        img.style.borderRadius = '50%';
                        img.style.objectFit = 'cover';

                        const profileImg = document.querySelector('.profile-img');
                        profileImg.innerHTML = '';
                        profileImg.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // تفعيل التبويبات
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');
            if (tab) {
                const tabElement = document.querySelector(`[data-bs-target="#${tab}"]`);
                if (tabElement) {
                    new bootstrap.Tab(tabElement).show();
                }
            }
        });
    </script>
@endsection
