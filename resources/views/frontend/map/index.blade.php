@extends('frontend.layouts.master')



@section('content')


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />
<style>
    #map-container {
        position: relative;
        height: 700px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    #map {
        height: 100%;
        width: 100%;
        z-index: 1;
    }
    
    .map-sidebar {
        position: absolute;
        top: 20px;
        right: 20px;
        width: 350px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        z-index: 1000;
        max-height: calc(100% - 40px);
        overflow-y: auto;
    }
    
    .map-controls {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 1000;
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        width: 300px;
    }
    
    .map-stats {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px;
        border-radius: 10px 10px 0 0;
    }
    
    .legend {
        background: white;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        margin-bottom: 5px;
    }
    
    .legend-color {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin-left: 10px;
    }
    
    .map-popup {
        min-width: 250px;
    }
    
    .marker-cluster {
        background-clip: padding-box;
        border-radius: 50%;
    }
    
    .marker-cluster div {
        width: 30px;
        height: 30px;
        margin-left: 5px;
        margin-top: 5px;
        text-align: center;
        border-radius: 50%;
        font-weight: bold;
        color: white;
    }
    
    .filter-group {
        margin-bottom: 15px;
    }
    
    .location-search {
        position: relative;
    }
    
    .location-search input {
        padding-right: 40px;
    }
    
    .location-search i {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
    
    @media (max-width: 768px) {
        .map-sidebar,
        .map-controls {
            position: relative;
            top: auto;
            left: auto;
            right: auto;
            width: 100%;
            margin-bottom: 15px;
        }
        
        #map-container {
            height: 500px;
        }
    }
</style>

<div class="container-fluid px-4 py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="fas fa-map-marked-alt text-primary"></i> الخريطة التفاعلية للخدمات الطبية</h2>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary" onclick="downloadMapData()">
                        <i class="fas fa-download"></i> تصدير البيانات
                    </button>
                    <button class="btn btn-primary" onclick="printMap()">
                        <i class="fas fa-print"></i> طباعة الخريطة
                    </button>
                </div>
            </div>
            <p class="text-muted">استكشف المراكز الطبية والأطباء في منطقتك مع نظام الحوافز والكاش باك</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 mb-4">
            <!-- Statistics Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-chart-bar"></i> إحصائيات الخريطة</h6>
                </div>
                <div class="card-body">
                    <div id="map-stats" class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">جاري التحميل...</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Legend -->
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="fas fa-key"></i> مفتاح الخريطة</h6>
                </div>
                <div class="card-body">
                    <div class="legend">
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #3498db;"></div>
                            <span>عيادات</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #e74c3c;"></div>
                            <span>مستشفيات</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #2ecc71;"></div>
                            <span>مراكز طبية</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #9b59b6;"></div>
                            <span>مختبرات</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #4CAF50;"></div>
                            <span>أطباء</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background-color: #f39c12;"></div>
                            <span>صيدليات</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div id="map-container" class="shadow-lg">
                <!-- Controls -->
                <div class="map-controls">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0"><i class="fas fa-filter"></i> الفلاتر</h6>
                        <button class="btn btn-sm btn-outline-secondary" onclick="resetFilters()">
                            <i class="fas fa-redo"></i>
                        </button>
                    </div>
                    
                    <div class="filter-group">
                        <label class="form-label">نوع المرفق:</label>
                        <select id="filter-type" class="form-select form-select-sm">
                            <option value="">الكل</option>
                            <option value="clinic">عيادات</option>
                            <option value="hospital">مستشفيات</option>
                            <option value="medical_center">مراكز طبية</option>
                            <option value="lab">مختبرات</option>
                            <option value="pharmacy">صيدليات</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="form-label">المدينة:</label>
                        <select id="filter-city" class="form-select form-select-sm">
                            <option value="">الكل</option>
                            @foreach($cities as $city)
                                <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                    {{ $city }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label class="form-label">التخصص:</label>
                        <select id="filter-specialty" class="form-select form-select-sm">
                            <option value="">الكل</option>
                            @foreach($specialties as $specialty)
                                <option value="{{ $specialty }}">{{ $specialty }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="filter-verified" checked>
                        <label class="form-check-label" for="filter-verified">
                            الموثقين فقط
                        </label>
                    </div>
                    
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="filter-featured">
                        <label class="form-check-label" for="filter-featured">
                            المميزين فقط
                        </label>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="filter-doctors">
                        <label class="form-check-label" for="filter-doctors">
                            يحتوي على أطباء
                        </label>
                    </div>
                    
                    <div class="d-grid">
                        <button class="btn btn-primary btn-sm" onclick="applyFilters()">
                            <i class="fas fa-search"></i> تطبيق الفلاتر
                        </button>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="map-sidebar">
                    <div class="map-stats">
                        <h6 class="mb-0"><i class="fas fa-info-circle"></i> المعلومات</h6>
                    </div>
                    <div class="p-3">
                        <div class="location-search mb-3">
                            <input type="text" id="location-search" class="form-control" 
                                   placeholder="ابحث عن موقع أو عنوان...">
                            <i class="fas fa-search"></i>
                        </div>
                        
                        <div id="search-results" class="mb-3">
                            <!-- نتائج البحث ستظهر هنا -->
                        </div>
                        
                        <div id="selected-location" class="mb-3">
                            <!-- تفاصيل الموقع المحدد ستظهر هنا -->
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" onclick="locateMe()">
                                <i class="fas fa-location-arrow"></i> تحديد موقعي
                            </button>
                            <button class="btn btn-outline-success" onclick="showAll()">
                                <i class="fas fa-globe"></i> عرض الكل
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Map -->
                <div id="map"></div>
            </div>
        </div>
    </div>

    <!-- Results Table -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0"><i class="fas fa-list"></i> قائمة المراكز الطبية</h6>
                    <span class="badge bg-primary" id="results-count">0 نتيجة</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="results-table">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>النوع</th>
                                    <th>المدينة</th>
                                    <th>عدد الأطباء</th>
                                    <th>التقييم</th>
                                    <th>الحالة</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody id="results-body">
                                <!-- البيانات ستظهر هنا عبر JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster/dist/leaflet.markercluster.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
    let map;
    let markersLayer;
    let doctorMarkersLayer;
    let mapData = {};
    let currentFilters = {};

    // Icons configuration
    const icons = {
        clinic: L.divIcon({
            html: '<i class="fas fa-hospital" style="color: #3498db; font-size: 24px;"></i>',
            iconSize: [30, 30],
            className: 'map-icon'
        }),
        hospital: L.divIcon({
            html: '<i class="fas fa-hospital-alt" style="color: #e74c3c; font-size: 28px;"></i>',
            iconSize: [32, 32],
            className: 'map-icon'
        }),
        medical_center: L.divIcon({
            html: '<i class="fas fa-clinic-medical" style="color: #2ecc71; font-size: 26px;"></i>',
            iconSize: [31, 31],
            className: 'map-icon'
        }),
        lab: L.divIcon({
            html: '<i class="fas fa-flask" style="color: #9b59b6; font-size: 22px;"></i>',
            iconSize: [28, 28],
            className: 'map-icon'
        }),
        pharmacy: L.divIcon({
            html: '<i class="fas fa-pills" style="color: #f39c12; font-size: 22px;"></i>',
            iconSize: [28, 28],
            className: 'map-icon'
        }),
        doctor: L.divIcon({
            html: '<i class="fas fa-user-md" style="color: #4CAF50; font-size: 24px;"></i>',
            iconSize: [30, 30],
            className: 'map-icon'
        })
    };

    // Initialize map
    function initMap() {
        // Default center (Riyadh, KSA)
        const defaultCenter = [24.7136, 46.6753];
        
        map = L.map('map', {
            zoomControl: true,
            zoomSnap: 0.5,
            zoomDelta: 0.5
        }).setView(defaultCenter, 12);

        // Add tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19,
        }).addTo(map);

        // Add marker clusters
        markersLayer = L.markerClusterGroup({
            chunkedLoading: true,
            maxClusterRadius: 50,
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            iconCreateFunction: function(cluster) {
                const count = cluster.getChildCount();
                const size = count < 10 ? 'small' : count < 100 ? 'medium' : 'large';
                const colors = {
                    small: '#3498db',
                    medium: '#2ecc71',
                    large: '#e74c3c'
                };
                
                return L.divIcon({
                    html: `<div style="background-color: ${colors[size]}; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; border: 3px solid white;">${count}</div>`,
                    iconSize: [40, 40],
                    className: 'marker-cluster'
                });
            }
        });

        doctorMarkersLayer = L.layerGroup();
        
        map.addLayer(markersLayer);
        map.addLayer(doctorMarkersLayer);

        // Add geocoder control
        const geocoder = L.Control.geocoder({
            defaultMarkGeocode: false,
            placeholder: 'ابحث عن موقع...',
            errorMessage: 'لم يتم العثور على الموقع'
        }).on('markgeocode', function(e) {
            map.fitBounds(e.geocode.bbox);
        }).addTo(map);

        // Add scale control
        L.control.scale().addTo(map);

        // Load data
        loadMapData();
    }

    // Load map data from API
    async function loadMapData() {
        try {
            const response = await fetch('{{ route("map.data") }}');
            mapData = await response.json();
            
            updateStats();
            renderMapMarkers();
            renderResultsTable();
        } catch (error) {
            console.error('Error loading map data:', error);
            showError('حدث خطأ في تحميل البيانات');
        }
    }

    // Render markers on map
    function renderMapMarkers() {
        markersLayer.clearLayers();
        doctorMarkersLayer.clearLayers();

        // Filter medical centers
        const filteredCenters = mapData.medical_centers.filter(center => {
            if (currentFilters.type && center.type !== currentFilters.type) return false;
            if (currentFilters.city && center.city !== currentFilters.city) return false;
            if (currentFilters.verified && !center.is_verified) return false;
            if (currentFilters.featured && !center.is_featured) return false;
            if (currentFilters.specialty && !center.specialties.includes(currentFilters.specialty)) return false;
            if (currentFilters.doctors && center.doctor_count === 0) return false;
            return true;
        });

        // Add medical center markers
        filteredCenters.forEach(center => {
            if (center.latitude && center.longitude) {
                const marker = L.marker([center.latitude, center.longitude], {
                    icon: icons[center.type] || icons.clinic,
                    title: center.name
                }).bindPopup(center.popup_content);

                marker.centerData = center;
                markersLayer.addLayer(marker);

                // Add click event
                marker.on('click', function() {
                    showLocationDetails(center);
                });
            }
        });

        // Add doctor markers
        mapData.doctors.forEach(doctor => {
            if (doctor.latitude && doctor.longitude) {
                const marker = L.marker([doctor.latitude, doctor.longitude], {
                    icon: icons.doctor,
                    title: doctor.name
                }).bindPopup(doctor.popup_content);

                marker.doctorData = doctor;
                doctorMarkersLayer.addLayer(marker);

                marker.on('click', function() {
                    showLocationDetails(doctor, true);
                });
            }
        });

        // Update results count
        document.getElementById('results-count').textContent = `${filteredCenters.length} نتيجة`;
    }

    // Show location details in sidebar
    function showLocationDetails(location, isDoctor = false) {
        const sidebar = document.querySelector('.map-sidebar');
        const detailsDiv = document.getElementById('selected-location');
        
        let html = `
            <div class="card">
                <div class="card-header bg-${isDoctor ? 'success' : 'primary'} text-white">
                    <h6 class="mb-0">${location.name}</h6>
                </div>
                <div class="card-body">
                    ${isDoctor ? `
                        <p><strong>التخصص:</strong> ${location.specialization}</p>
                        <p><strong>الخبرة:</strong> ${location.experience} سنة</p>
                        <p><strong>التقييم:</strong> ${location.rating} / 5</p>
                        ${location.clinic_name ? `<p><strong>العيادة:</strong> ${location.clinic_name}</p>` : ''}
                    ` : `
                        <p><strong>النوع:</strong> ${location.type_label}</p>
                        <p><strong>العنوان:</strong> ${location.address}, ${location.city}</p>
                        <p><strong>عدد الأطباء:</strong> ${location.doctor_count}</p>
                        <p><strong>التقييم:</strong> ${location.rating} / 5</p>
                        ${location.is_verified ? '<span class="badge bg-success mb-2"><i class="fas fa-check-circle"></i> موثق</span>' : ''}
                        ${location.is_featured ? '<span class="badge bg-warning mb-2"><i class="fas fa-star"></i> مميز</span>' : ''}
                    `}
                    
                    <div class="d-grid gap-2 mt-3">
                        ${isDoctor ? `
                            <a href="/doctors/${location.id}" class="btn btn-primary btn-sm">
                                <i class="fas fa-user-md"></i> عرض البروفايل
                            </a>
                        ` : `
                            <a href="/medical-centers/${location.id}" class="btn btn-primary btn-sm">
                                <i class="fas fa-info-circle"></i> التفاصيل
                            </a>
                        `}
                        
                        ${isDoctor ? `
                            <a href="/appointments/create?doctor_id=${location.id}" class="btn btn-success btn-sm">
                                <i class="fas fa-calendar-check"></i> حجز استشارة
                            </a>
                        ` : `
                            <a href="/appointments/create?center_id=${location.id}" class="btn btn-success btn-sm">
                                <i class="fas fa-calendar-check"></i> حجز موعد
                            </a>
                        `}
                        
                        <button class="btn btn-outline-secondary btn-sm" onclick="showDirections(${location.latitude}, ${location.longitude})">
                            <i class="fas fa-directions"></i> اتجاهات
                        </button>
                    </div>
                </div>
            </div>
        `;
        
        detailsDiv.innerHTML = html;
        
        // Scroll to details
        detailsDiv.scrollIntoView({ behavior: 'smooth' });
    }

    // Apply filters
    function applyFilters() {
        currentFilters = {
            type: document.getElementById('filter-type').value,
            city: document.getElementById('filter-city').value,
            specialty: document.getElementById('filter-specialty').value,
            verified: document.getElementById('filter-verified').checked,
            featured: document.getElementById('filter-featured').checked,
            doctors: document.getElementById('filter-doctors').checked
        };
        
        renderMapMarkers();
        renderResultsTable();
    }

    // Reset filters
    function resetFilters() {
        document.getElementById('filter-type').value = '';
        document.getElementById('filter-city').value = '';
        document.getElementById('filter-specialty').value = '';
        document.getElementById('filter-verified').checked = true;
        document.getElementById('filter-featured').checked = false;
        document.getElementById('filter-doctors').checked = false;
        
        currentFilters = {};
        renderMapMarkers();
        renderResultsTable();
    }

    // Show all markers
    function showAll() {
        if (mapData.medical_centers.length > 0) {
            const bounds = L.latLngBounds(
                mapData.medical_centers
                    .filter(c => c.latitude && c.longitude)
                    .map(c => [c.latitude, c.longitude])
            );
            map.fitBounds(bounds);
        }
    }

    // Locate user
    function locateMe() {
        if (!navigator.geolocation) {
            alert('متصفحك لا يدعم تحديد الموقع');
            return;
        }

        navigator.geolocation.getCurrentPosition(
            function(position) {
                const latlng = [position.coords.latitude, position.coords.longitude];
                map.setView(latlng, 15);
                
                // Add user marker
                const userMarker = L.marker(latlng, {
                    icon: L.divIcon({
                        html: '<i class="fas fa-user-circle" style="color: #3498db; font-size: 32px;"></i>',
                        iconSize: [35, 35]
                    })
                }).bindPopup('موقعك الحالي').addTo(map);
                
                // Remove after 10 seconds
                setTimeout(() => map.removeLayer(userMarker), 10000);
            },
            function(error) {
                alert('تعذر الحصول على موقعك: ' + error.message);
            },
            {
                enableHighAccuracy: true,
                timeout: 10000,
                maximumAge: 0
            }
        );
    }

    // Show directions
    function showDirections(lat, lng) {
        const url = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
        window.open(url, '_blank');
    }

    // Render results table
    function renderResultsTable() {
        const tbody = document.getElementById('results-body');
        const filteredCenters = mapData.medical_centers.filter(center => {
            if (currentFilters.type && center.type !== currentFilters.type) return false;
            if (currentFilters.city && center.city !== currentFilters.city) return false;
            if (currentFilters.verified && !center.is_verified) return false;
            if (currentFilters.featured && !center.is_featured) return false;
            if (currentFilters.specialty && !center.specialties.includes(currentFilters.specialty)) return false;
            if (currentFilters.doctors && center.doctor_count === 0) return false;
            return true;
        });

        let html = '';
        
        filteredCenters.forEach(center => {
            const ratingStars = '★'.repeat(Math.floor(center.rating || 0)) + 
                              (center.rating - Math.floor(center.rating) >= 0.5 ? '½' : '');
            
            html += `
                <tr>
                    <td>
                        <strong>${center.name}</strong>
                        ${center.is_featured ? '<span class="badge bg-warning ms-2"><i class="fas fa-star"></i></span>' : ''}
                        ${center.is_verified ? '<span class="badge bg-success ms-2"><i class="fas fa-check"></i></span>' : ''}
                    </td>
                    <td>${center.type_label}</td>
                    <td>${center.city}</td>
                    <td><span class="badge bg-info">${center.doctor_count}</span></td>
                    <td>
                        <span class="text-warning">${ratingStars}</span>
                        <small class="text-muted">(${center.rating || '0.0'})</small>
                    </td>
                    <td>
                        ${center.is_verified ? 
                            '<span class="badge bg-success">موثق</span>' : 
                            '<span class="badge bg-secondary">غير موثق</span>'
                        }
                    </td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary" onclick="flyToLocation(${center.latitude}, ${center.longitude})">
                            <i class="fas fa-map-marker-alt"></i>
                        </button>
                        <a href="/medical-centers/${center.id}" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="/appointments/create?center_id=${center.id}" class="btn btn-sm btn-outline-success">
                            <i class="fas fa-calendar-plus"></i>
                        </a>
                    </td>
                </tr>
            `;
        });

        tbody.innerHTML = html || '<tr><td colspan="7" class="text-center">لا توجد نتائج</td></tr>';
    }

    // Fly to location on map
    function flyToLocation(lat, lng) {
        map.flyTo([lat, lng], 16, {
            duration: 1.5
        });
        
        // Highlight marker
        markersLayer.eachLayer(function(marker) {
            if (marker.getLatLng().lat === lat && marker.getLatLng().lng === lng) {
                marker.openPopup();
            }
        });
    }

    // Update statistics
    function updateStats() {
        const statsDiv = document.getElementById('map-stats');
        const stats = mapData.stats;
        
        let html = `
            <div class="row text-center">
                <div class="col-6 mb-3">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h3 class="text-primary">${stats.total_centers}</h3>
                            <small class="text-muted">مركز طبي</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-3">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h3 class="text-success">${stats.total_doctors}</h3>
                            <small class="text-muted">طبيب</small>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h3 class="text-info">${stats.verified_centers}</h3>
                            <small class="text-muted">موثق</small>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h3 class="text-warning">${stats.featured_centers}</h3>
                            <small class="text-muted">مميز</small>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        statsDiv.innerHTML = html;
    }

    // Download map data
    function downloadMapData() {
        const dataStr = JSON.stringify(mapData, null, 2);
        const dataUri = 'data:application/json;charset=utf-8,'+ encodeURIComponent(dataStr);
        
        const exportFileDefaultName = `sehasave-map-data-${new Date().toISOString().split('T')[0]}.json`;
        
        const linkElement = document.createElement('a');
        linkElement.setAttribute('href', dataUri);
        linkElement.setAttribute('download', exportFileDefaultName);
        linkElement.click();
    }

    // Print map
    function printMap() {
        const printWindow = window.open('', '_blank');
        const mapImage = map.getBounds().getCenter();
        
        printWindow.document.write(`
            <html>
                <head>
                    <title>خريطة SehaSave</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 20px; }
                        .header { text-align: center; margin-bottom: 30px; }
                        .stats { display: flex; justify-content: space-around; margin: 20px 0; }
                        .stat-item { text-align: center; }
                        .footer { margin-top: 30px; text-align: center; color: #666; }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <h2>خريطة المراكز الطبية - SehaSave</h2>
                        <p>تاريخ الطباعة: ${new Date().toLocaleDateString('ar-SA')}</p>
                    </div>
                    <div class="stats">
                        <div class="stat-item">
                            <h3>${mapData.stats.total_centers}</h3>
                            <p>مركز طبي</p>
                        </div>
                        <div class="stat-item">
                            <h3>${mapData.stats.total_doctors}</h3>
                            <p>طبيب</p>
                        </div>
                        <div class="stat-item">
                            <h3>${mapData.stats.verified_centers}</h3>
                            <p>موثق</p>
                        </div>
                    </div>
                    <p>تحتوي الخريطة على تفاصيل المراكز الطبية والأطباء المسجلين في نظام SehaSave</p>
                    <div class="footer">
                        <p>© ${new Date().getFullYear()} SehaSave - جميع الحقوق محفوظة</p>
                        <p>www.sehasave.com</p>
                    </div>
                </body>
            </html>
        `);
        
        printWindow.document.close();
        printWindow.print();
    }

    // Show error message
    function showError(message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3';
        alertDiv.style.zIndex = '2000';
        alertDiv.innerHTML = `
            <strong>خطأ!</strong> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        document.body.appendChild(alertDiv);
        
        setTimeout(() => alertDiv.remove(), 5000);
    }

    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
        
        // Add event listeners for search
        document.getElementById('location-search').addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                searchLocation(this.value);
            }
        });
    });

    // Search location
    async function searchLocation(query) {
        if (!query.trim()) return;
        
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&accept-language=ar`);
            const results = await response.json();
            
            if (results.length > 0) {
                const result = results[0];
                const latlng = [parseFloat(result.lat), parseFloat(result.lon)];
                
                map.flyTo(latlng, 14);
                
                // Add temporary marker
                const marker = L.marker(latlng, {
                    icon: L.divIcon({
                        html: '<i class="fas fa-search-location" style="color: #e74c3c; font-size: 32px;"></i>',
                        iconSize: [35, 35]
                    })
                }).bindPopup(`<b>${result.display_name}</b>`).addTo(map);
                
                // Remove after 5 seconds
                setTimeout(() => map.removeLayer(marker), 5000);
            }
        } catch (error) {
            console.error('Search error:', error);
        }
    }
</script>
@endsection
