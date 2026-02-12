@extends('frontend.layouts.master')



@section('content')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster/dist/MarkerCluster.Default.css" />


 
    <style>
        #map { border-radius: 8px; }
        .empty-state { padding: 50px 20px; }
        .stat-card { padding: 15px; border-radius: 8px; text-align: center; }
        .stat-card i { font-size: 2rem; margin-bottom: 10px; }
        .stat-card h4 { font-weight: bold; margin: 0; }
        .stat-card p { margin: 0; opacity: 0.9; }
        .map-popup .leaflet-popup-content-wrapper {
            border-radius: 8px;
            min-width: 280px;
        }

/* تنسيقات الخريطة */
#map {
    height: 500px;
    border-radius: 8px;
    z-index: 1;
}

.wcolor{
    color: #fff;
    
}
.custom-marker {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 16px;
    border: 3px solid white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
}

.doctor-marker {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #4CAF50;
    color: white;
    font-size: 16px;
    border: 3px solid white;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3);
}

.cluster-marker {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: rgba(52, 152, 219, 0.9);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 14px;
    border: 3px solid white;
    box-shadow: 0 3px 6px rgba(0,0,0,0.3);
}

.doctor-cluster {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: rgba(76, 175, 80, 0.9);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 14px;
    border: 3px solid white;
    box-shadow: 0 3px 6px rgba(0,0,0,0.3);
}

.current-location-marker .current-location {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #ff0000;
    border: 2px solid white;
    box-shadow: 0 0 10px rgba(255,0,0,0.5);
}

/* تنسيقات الإحصائيات */
.stat-card {
    transition: transform 0.2s;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-value {
    font-weight: bold;
    margin: 0;
}

/* تنسيقات popup */
.leaflet-popup-content {
    margin: 13px 19px;
    line-height: 1.4;
}

.map-popup {
    min-width: 250px;
}

.map-popup .badge {
    font-size: 0.7rem;
    padding: 2px 6px;
}

/* تنسيقات تحميل */
#loading {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 8px;
    padding: 20px;
}
</style>



<div class="container-fluid">
    
    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-md-3">
            @include('frontend.map.partials.filters')
        </div>
        
        <!-- Map Container -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-map-marked-alt"></i> @lang('map.title')
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($medicalCenters->isEmpty() && $doctors->isEmpty())
                        <div class="text-center py-5">
                            <div class="empty-state">
                                <i class="fas fa-map-marker-alt fa-4x text-muted mb-3"></i>
                                <h4>@lang('map.no_data')</h4>
                                <p class="text-muted">@lang('map.no_data_desc')</p>
                                
                                @if(auth()->check() && auth()->user()->isAdmin())
                                    <div class="mt-4">
                                        <a href="{{ route('admin.medical-centers.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> @lang('map.add_medical_center')
                                        </a>
                                        <a href="{{ route('admin.doctors.create') }}" class="btn btn-success">
                                            <i class="fas fa-user-md"></i> @lang('map.add_doctor')
                                        </a>
                                    </div>
                                @endif
                                
                                <!-- زر تحديث الصفحة -->
                                <div class="mt-3">
                                    <button onclick="window.location.reload()" class="btn btn-outline-primary">
                                        <i class="fas fa-sync-alt"></i> @lang('map.refresh_page')
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Statistics -->
                        <div class="row mb-4" id="statistics-container">
                            <div class="col-xl-3 col-md-6 mb-3">
                                <div class="card stat-card bg-primary text-white shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-hospital fa-2x opacity-75"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h3 class="mb-0 stat-value wcolor" style="color: #fff">{{ $medicalCenters->count() }}</h3>
                                                <p class="mb-0 small opacity-75  wcolor" style="color: #fff">@lang('map.medical_center')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-3">
                                <div class="card stat-card bg-success text-white shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-user-md fa-2x opacity-75"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h3 class="mb-0 stat-value wcolor" style="color: #fff">{{ $doctors->count() }}</h3>
                                                <p class="mb-0 small opacity-75 wcolor" style="color: #fff">@lang('map.doctor')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-3">
                                <div class="card stat-card bg-info text-white shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-check-circle fa-2x opacity-75"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h3 class="mb-0 stat-value wcolor" style="color: #fff">{{ $medicalCenters->where('is_verified', true)->count() }}</h3>
                                                <p class="mb-0 small opacity-75 wcolor" style="color: #fff">@lang('map.verified_center')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6 mb-3">
                                <div class="card stat-card bg-warning text-white shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="fas fa-star fa-2x opacity-75"></i>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h3 class="mb-0 stat-value wcolor" style="color: #fff">{{ $medicalCenters->where('is_featured', true)->count() }}</h3>
                                                <p class="mb-0 small opacity-75 wcolor" style="color: #fff">@lang('map.featured_center')</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Map Container -->
                        <div class="card shadow-sm">
                            <div class="card-body p-0 position-relative">
                                <div id="map-container" style="height: 500px; border-radius: 8px; overflow: hidden; position: relative;">
                                    <div id="map" style="height: 100%; width: 100%;"></div>
                                    
                                    <!-- Loading Indicator -->
                                    <div id="loading" class="text-center" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(255,255,255,0.9); padding: 20px; border-radius: 8px; z-index: 1000;">
                                        <!-- سيتم ملؤه بواسطة JavaScript -->
                                    </div>
                                </div>
                                
                                <!-- Controls -->
                                <div class="p-3 border-top">
                                    <div class="row align-items-center">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <span class="me-2 small text-muted">@lang('map.view')</span>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <button type="button" class="btn btn-outline-primary active" id="show-all">
                                                        @lang('map.all')
                                                    </button>
                                                    <button type="button" class="btn btn-outline-primary" id="show-centers">
                                                        @lang('map.centers_only')
                                                    </button>
                                                    <button type="button" class="btn btn-outline-primary" id="show-doctors">
                                                        @lang('map.doctors_only')
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button id="reload-data" class="btn btn-sm btn-outline-secondary">
                                                <i class="fas fa-sync-alt"></i> @lang('map.refresh_data')
                                            </button>
                                            <button id="locate-me" class="btn btn-sm btn-outline-success ms-2">
                                                <i class="fas fa-location-arrow"></i> @lang('map.locate_me')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Results List -->
                        @if(!$medicalCenters->isEmpty())
                        <div class="card shadow-sm mt-4">
                            <div class="card-header bg-light py-3">
                                <h6 class="mb-0">
                                    <i class="fas fa-list text-primary"></i> @lang('map.search_results')
                                    <span class="badge bg-primary rounded-pill">{{ $medicalCenters->count() }}</span>
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach($medicalCenters->take(6) as $center)
                                    <div class="col-lg-4 col-md-6 mb-3">
                                        <div class="card h-100 border hover-shadow">
                                            <div class="card-body">
                                                <h6 class="card-title mb-2">
                                                    <i class="fas fa-{{ $center->type == 'clinic' ? 'stethoscope' : ($center->type == 'hospital' ? 'hospital' : 'clinic-medical') }} text-primary me-1"></i>
                                                    {{ $center->name }}
                                                </h6>
                                                <p class="card-text small text-muted mb-2">
                                                    <i class="fas fa-map-marker-alt"></i> {{ $center->address }}, {{ $center->city }}
                                                </p>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        @if($center->is_verified)
                                                        <span class="badge bg-success me-1">
                                                            <i class="fas fa-check-circle"></i> @lang('map.verified')
                                                        </span>
                                                        @endif
                                                        @if($center->is_featured)
                                                        <span class="badge bg-warning">
                                                            <i class="fas fa-star"></i> @lang('map.featured')
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <a href="{{ route('medical-centershome.show', $center->id) }}" class="btn btn-sm btn-outline-primary">
                                                        @lang('map.details')
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                                @if($medicalCenters->count() > 6)
                                <div class="text-center mt-3">
                                    <a href="#" class="btn btn-outline-secondary btn-sm">
                                        @lang('map.show_more') <i class="fas fa-chevron-down"></i>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <script>
// متغيرات عالمية
let map = null;
let medicalCentersGroup = null;

let doctorsGroup = null;

// دالة آمنة لتحديث الإحصائيات
// دالة محسنة لتحديث الإحصائيات
function updateStatisticsSafely(stats) {
    if (!stats) {
        console.warn('لا توجد إحصائيات لتحديثها');
        return;
    }
    
    try {
        // الحصول على جميع عناصر الإحصائيات
        const statElements = document.querySelectorAll('.stat-value');
        
        if (statElements.length === 0) {
            console.warn('لم يتم العثور على عناصر الإحصائيات');
            return;
        }
        
        // قائمة المفاتيح المتوقعة بالترتيب
        const statKeys = ['total_centers', 'total_doctors', 'verified_centers', 'featured_centers'];
        
        // تحديث كل عنصر إذا كان المفتاح موجوداً
        statElements.forEach((element, index) => {
            const key = statKeys[index];
            if (key && stats[key] !== undefined) {
                element.textContent = stats[key];
            }
        });
        
        console.log('تم تحديث الإحصائيات بنجاح:', stats);
        
    } catch (error) {
        console.error('خطأ في تحديث الإحصائيات:', error);
    }
}

// دالة لتحميل بيانات الخريطة
async function loadMapData() {
    let loadingElement = null;
    
    try {
        // التحقق من وجود عنصر التحميل
        loadingElement = document.getElementById('loading');
        if (loadingElement) {
            loadingElement.style.display = 'block';
            loadingElement.innerHTML = `
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">@lang('map.loading')</span>
                    </div>
                    <p class="mt-2 text-muted">@lang('map.loading_data')</p>
                </div>
            `;
        }
        
        // جمع معاملات الفلاتر
        const params = new URLSearchParams();
        
        // فلاتر select
        const selectFilters = ['type', 'city', 'specialty', 'rating_min'];
        selectFilters.forEach(filterName => {
            const element = document.querySelector(`select[name="${filterName}"]`);
            if (element && element.value) {
                params.append(filterName, element.value);
            }
        });
        
        // فلاتر checkbox
        const checkboxFilters = ['is_verified', 'has_doctors', 'is_featured'];
        checkboxFilters.forEach(filterName => {
            const element = document.querySelector(`input[name="${filterName}"]`);
            if (element && element.checked) {
                params.append(filterName, 'true');
            }
        });
        
        // إنشاء URL
        const url = `/api/map-data${params.toString() ? '?' + params.toString() : ''}`;
        
        console.log('جاري تحميل البيانات من:', url);
        
        // طلب البيانات
        const response = await fetch(url, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            signal: AbortSignal.timeout(15000) // timeout بعد 15 ثانية
        });
        
        if (!response.ok) {
            throw new Error(`@lang('map.network_error'): ${response.status} ${response.statusText}`);
        }
        
        const data = await response.json();
        
        if (!data.success) {
            throw new Error(data.message || '@lang('map.server_error')');
        }
        
        console.log('تم استلام البيانات:', {
            centers: data.data.medical_centers?.length || 0,
            doctors: data.data.doctors?.length || 0
        });
        
        // مسح العلامات القديمة
        if (medicalCentersGroup) medicalCentersGroup.clearLayers();
        if (doctorsGroup) doctorsGroup.clearLayers();
        
        // إضافة المراكز الطبية
        if (data.data.medical_centers && data.data.medical_centers.length > 0) {
            data.data.medical_centers.forEach(center => {
                if (center.latitude && center.longitude) {
                    const marker = L.marker([center.latitude, center.longitude], {
                        icon: L.divIcon({
                            html: `<div class="custom-marker" style="background-color: ${center.color};">
                                    <i class="fas fa-${center.icon}"></i>
                                  </div>`,
                            className: 'custom-div-icon',
                            iconSize: [40, 40]
                        })
                    });
                    
                    marker.bindPopup(center.popup_content);
                    medicalCentersGroup.addLayer(marker);
                }
            });
        }
        
        // إضافة الأطباء
        if (data.data.doctors && data.data.doctors.length > 0) {
            data.data.doctors.forEach(doctor => {
                if (doctor.latitude && doctor.longitude) {
                    const marker = L.marker([doctor.latitude, doctor.longitude], {
                        icon: L.divIcon({
                            html: `<div class="doctor-marker">
                                    <i class="fas fa-user-md"></i>
                                  </div>`,
                            className: 'doctor-div-icon',
                            iconSize: [40, 40]
                        })
                    });
                    
                    marker.bindPopup(doctor.popup_content);
                    doctorsGroup.addLayer(marker);
                }
            });
        }
        
        // تحديث الإحصائيات
        updateStatisticsSafely(data.data.stats);
        
        // ضبط عرض الخريطة
        if (medicalCentersGroup && doctorsGroup) {
            const allMarkers = [
                ...medicalCentersGroup.getLayers(),
                ...doctorsGroup.getLayers()
            ];
            
            if (allMarkers.length > 0) {
                const group = L.featureGroup(allMarkers);
                map.fitBounds(group.getBounds().pad(0.1));
            } else if (data.data.medical_centers && data.data.medical_centers.length === 0) {
                // إذا لم تكن هناك بيانات، ابقى على العرض الحالي
                console.log('لا توجد بيانات للعرض');
            }
        }
        
    } catch (error) {
        console.error('خطأ في تحميل بيانات الخريطة:', error);
        
        // عرض رسالة الخطأ بشكل آمن
        try {
            if (loadingElement) {
                loadingElement.innerHTML = `
                    <div class="alert alert-danger m-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-exclamation-triangle fs-4 me-3"></i>
                            <div>
                                <h6 class="mb-1">@lang('map.error_loading_data')</h6>
                                <p class="mb-2 small">${error.message || '@lang('map.server_error')'}</p>
                                <button onclick="loadMapData()" class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-redo me-1"></i> @lang('map.retry')
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            } else {
                // إنشاء عنصر خطأ جديد إذا لم يكن موجوداً
                const errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-danger m-3';
                errorDiv.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle fs-4 me-3"></i>
                        <div>
                            <h6 class="mb-1">@lang('map.error_loading_data')</h6>
                            <p class="mb-2 small">${error.message || '@lang('map.server_error')'}</p>
                            <button onclick="loadMapData()" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-redo me-1"></i> @lang('map.retry')
                            </button>
                        </div>
                    </div>
                `;
                
                const mapContainer = document.querySelector('#map-container');
                if (mapContainer) {
                    mapContainer.prepend(errorDiv);
                }
            }
        } catch (innerError) {
            console.error('خطأ في عرض رسالة الخطأ:', innerError);
        }
        
    } finally {
        // إخفاء مؤشر التحميل بأمان
        try {
            if (loadingElement) {
                loadingElement.style.display = 'none';
            }
        } catch (error) {
            console.error('خطأ في إخفاء مؤشر التحميل:', error);
        }
    }
}

// تهيئة الصفحة
document.addEventListener('DOMContentLoaded', function() {
    // التحقق من وجود عنصر الخريطة
    const mapElement = document.getElementById('map');
    if (!mapElement) {
        console.warn('لم يتم العثور على عنصر الخريطة');
        return;
    }
    
    // تهيئة الخريطة
    map = L.map('map').setView([25.2048, 55.2708], 11); // مركز دبي (إحداثيات دقيقة وزووم أفضل)
    
    // إضافة طبقة الخريطة
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors',
        maxZoom: 18,
        minZoom: 4
    }).addTo(map);
    
    // إنشاء مجموعات المعلقات
    medicalCentersGroup = L.markerClusterGroup({
        iconCreateFunction: function(cluster) {
            const count = cluster.getChildCount();
            return L.divIcon({
                html: `<div class="cluster-marker">
                        <span>${count}</span>
                      </div>`,
                className: 'custom-cluster',
                iconSize: [50, 50]
            });
        },
        maxClusterRadius: 50,
        showCoverageOnHover: false
    });
    
    doctorsGroup = L.markerClusterGroup({
        iconCreateFunction: function(cluster) {
            const count = cluster.getChildCount();
            return L.divIcon({
                html: `<div class="doctor-cluster">
                        <span>${count}</span>
                      </div>`,
                className: 'doctor-cluster-icon',
                iconSize: [50, 50]
            });
        },
        maxClusterRadius: 50,
        showCoverageOnHover: false
    });
    
    // إضافة المجموعات إلى الخريطة
    map.addLayer(medicalCentersGroup);
    map.addLayer(doctorsGroup);
    
    // تحميل البيانات الأولية بعد تأخير بسيط
    setTimeout(() => {
        loadMapData();
    }, 300);
    
    // إضافة أحداث الفلاتر
    const filterControls = document.querySelectorAll('.filter-control');
    filterControls.forEach(element => {
        element.addEventListener('change', () => {
            loadMapData();
        });
    });
    
    // إضافة أحداث الأزرار
    const reloadBtn = document.getElementById('reload-data');
    if (reloadBtn) {
        reloadBtn.addEventListener('click', () => {
            loadMapData();
        });
    }
    
    const locateBtn = document.getElementById('locate-me');
    if (locateBtn) {
        locateBtn.addEventListener('click', () => {
            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const { latitude, longitude } = position.coords;
                        map.setView([latitude, longitude], 14);
                        
                        // إضافة علامة الموقع الحالي
                        L.marker([latitude, longitude], {
                            icon: L.divIcon({
                                html: '<div class="current-location"></div>',
                                className: 'current-location-marker',
                                iconSize: [20, 20]
                            })
                        })
                        .addTo(map)
                        .bindPopup('@lang('map.current_location')')
                        .openPopup();
                    },
                    (error) => {
                        alert('@lang('map.location_error')' + error.message);
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                alert('@lang('map.geolocation_not_supported')');
            }
        });
    }
    
    // معالجة أزرار التحكم في العرض
    const viewControls = {
        'show-all': document.getElementById('show-all'),
        'show-centers': document.getElementById('show-centers'),
        'show-doctors': document.getElementById('show-doctors')
    };
    
    Object.keys(viewControls).forEach(key => {
        if (viewControls[key]) {
            viewControls[key].addEventListener('click', function() {
                // إزالة النشاط من جميع الأزرار
                Object.values(viewControls).forEach(btn => {
                    if (btn) btn.classList.remove('active');
                });
                
                // إضافة النشاط للزر الحالي
                this.classList.add('active');
                
                // التحكم في طبقات الخريطة
                switch(key) {
                    case 'show-all':
                        map.addLayer(medicalCentersGroup);
                        map.addLayer(doctorsGroup);
                        break;
                    case 'show-centers':
                        map.addLayer(medicalCentersGroup);
                        map.removeLayer(doctorsGroup);
                        break;
                    case 'show-doctors':
                        map.addLayer(doctorsGroup);
                        map.removeLayer(medicalCentersGroup);
                        break;
                }
            });
        }
    });
});
</script>
@endsection