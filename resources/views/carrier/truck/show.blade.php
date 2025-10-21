@extends('carrier.minlayout.master')


@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">تفاصيل الشاحنة: {{ $truck->title }}</h4>
                            <div>
                                {{-- <a href="{{ route('carriertrucks.edit', $truck->id) }}" class="btn btn-sm btn-light">
                                    <i class="fas fa-edit"></i> تعديل
                                </a> --}}

                                <a href="{{ route('carriertrucks.index') }}" class="btn btn-sm btn-outline-light">
                                    <i class="fas fa-list"></i> قائمة الشاحنات
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- الصور -->
                        <div class="mb-5">
                            <h5 class="border-bottom pb-2 mb-4">صور الشاحنة</h5>
                            <div class="row">
                                <!-- الصورة الرئيسية -->
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-secondary text-white">
                                            الصورة الرئيسية
                                        </div>
                                        <div class="card-body p-0">
                                            <img src="{{ $truck->photo ? asset('storage/' . $truck->photo) : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                                                alt="صورة الشاحنة الرئيسية" class="img-fluid rounded-top">
                                        </div>
                                    </div>
                                </div>

                                <!-- الصور الإضافية -->
                                @forelse($truck->photos as $photo)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100">
                                            <div class="card-body p-0">
                                                <img src="{{ asset('storage/' . $photo->photo_path) }}"
                                                    alt="صورة إضافية للشاحنة" class="img-fluid rounded-top">
                                            </div>
                                            <div class="card-footer bg-light">
                                                <form
                                                    action="{{ route('carriertrucks.destroy', ['carriertruck' => $truck->id]) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('هل أنت متأكد من حذف هذه الشاحنة؟')">
                                                        <i class="fas fa-trash"></i> حذف الشاحنة
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-info">لا توجد صور إضافية</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- المعلومات الأساسية -->
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 mb-4">المعلومات الأساسية</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th width="30%">نوع الشاحنة</th>
                                                <td>{{ $truck->truck_type }}</td>
                                            </tr>
                                            <tr>
                                                <th>رقم اللوحة</th>
                                                <td>{{ $truck->license_plate }}</td>
                                            </tr>
                                            <tr>
                                                <th>الحالة</th>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $truck->condition == 'new' ? 'success' : ($truck->condition == 'used' ? 'warning' : 'info') }}">
                                                        {{ __('trucks.condition_' . $truck->condition) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>حالة التوفر</th>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $truck->status == 'active' ? 'success' : ($truck->status == 'booked' ? 'danger' : 'secondary') }}">
                                                        {{ __('trucks.status_' . $truck->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>السعر</th>
                                                <td>
                                                    {{ number_format($truck->price, 2) }} دولار
                                                    @if ($truck->offer_price && $truck->offer_price != $truck->price)
                                                        <br><small
                                                            class="text-muted"><del>{{ number_format($truck->offer_price, 2) }}
                                                                دولار</del></small>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 mb-4">الموقع</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th width="30%">الدولة</th>
                                                <td>{{ $truck->location_country }}</td>
                                            </tr>
                                            <tr>
                                                <th>المدينة</th>
                                                <td>{{ $truck->location_city }}</td>
                                            </tr>
                                            @if ($truck->latitude && $truck->longitude)
                                                <tr>
                                                    <th>الموقع الجغرافي</th>
                                                    <td>
                                                        <a href="https://www.google.com/maps?q={{ $truck->latitude }},{{ $truck->longitude }}"
                                                            target="_blank">
                                                            <i class="fas fa-map-marker-alt"></i> عرض على الخريطة
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- الأبعاد والمواصفات -->
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 mb-4">الأبعاد والوزن</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th width="30%">الطول</th>
                                                <td>{{ $truck->length }} متر</td>
                                            </tr>
                                            <tr>
                                                <th>العرض</th>
                                                <td>{{ $truck->width }} متر</td>
                                            </tr>
                                            <tr>
                                                <th>الارتفاع</th>
                                                <td>{{ $truck->height }} متر</td>
                                            </tr>
                                            <tr>
                                                <th>الوزن</th>
                                                <td>{{ $truck->weight }} كجم</td>
                                            </tr>
                                            <tr>
                                                <th>السعة</th>
                                                <td>{{ $truck->capacity }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h5 class="border-bottom pb-2 mb-4">المواصفات الفنية</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            @if ($truck->specification)
                                                <tr>
                                                    <th width="30%">نوع المحرك</th>
                                                    <td>{{ $truck->specification->engine_type ?? 'غير محدد' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>نوع الوقود</th>
                                                    <td>{{ $truck->specification->fuel_type ?? 'غير محدد' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>ناقل الحركة</th>
                                                    <td>{{ $truck->specification->transmission ?? 'غير محدد' }}</td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td colspan="2" class="text-center">لا توجد مواصفات فنية مسجلة</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- أوقات التوفر -->
                        <div class="mb-5">
                            <h5 class="border-bottom pb-2 mb-4">أوقات التوفر</h5>
                            @if ($truck->availabilities->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-light">
                                            <tr>
                                                <th>تاريخ البدء</th>
                                                <th>تاريخ الانتهاء</th>
                                                <th>الحالة</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($truck->availabilities as $availability)
                                                <tr>
                                                    <td>{{ $availability->start_date }}</td>
                                                    <td>{{ $availability->end_date }}</td>
                                                    <td>{{ $availability->status }}</td>
                                                    <td>
                                                        {{-- <form
                                                            action="{{ route('truck-availabilities.destroy', $availability->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('هل أنت متأكد من حذف هذا التوفر؟')">
                                                                <i class="fas fa-trash"></i> حذف
                                                            </button>
                                                        </form> --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">لا توجد أوقات توفر مسجلة</div>
                            @endif
                        </div>

                        <!-- التقييمات -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-4">تقييمات الشاحنة</h5>

                            <!-- نموذج إضافة تقييم -->
                            @auth
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h6>أضف تقييمك</h6>
                                        <form action="{{ route('trucks.addRating', $truck->id) }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="rating" class="form-label">التقييم (من 1 إلى 5)</label>
                                                <select class="form-select" id="rating" name="rating" required>
                                                    <option value="1">1 - سيء</option>
                                                    <option value="2">2 - مقبول</option>
                                                    <option value="3">3 - جيد</option>
                                                    <option value="4">4 - جيد جدًا</option>
                                                    <option value="5" selected>5 - ممتاز</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="comment" class="form-label">تعليقك</label>
                                                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">إرسال التقييم</button>
                                        </form>
                                    </div>
                                </div>
                            @endauth

                            <!-- قائمة التقييمات -->
                            @if ($truck->ratings->count() > 0)
                                <div class="row">
                                    @foreach ($truck->ratings as $rating)
                                        <div class="col-md-6 mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <h6 class="card-title mb-0">
                                                            {{ $rating->user->name }}
                                                            <small
                                                                class="text-muted">{{ $rating->created_at->diffForHumans() }}</small>
                                                        </h6>
                                                        <div class="text-warning">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i
                                                                    class="fas fa-star{{ $i <= $rating->rating ? '' : '-empty' }}"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    @if ($rating->comment)
                                                        <p class="card-text">{{ $rating->comment }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info">لا توجد تقييمات حتى الآن</div>
                            @endif
                        </div>
                    </div>

                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between">
                            <small class="text-muted">
                                تم الإنشاء في: {{ $truck->created_at->format('Y-m-d H:i') }}
                                @if ($truck->created_at != $truck->updated_at)
                                    <br>تم التحديث في: {{ $truck->updated_at->format('Y-m-d H:i') }}
                                @endif
                            </small>
                            <div>
                                {{-- <form action="{{ route('carriertrucks.destroy', $truck->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('هل أنت متأكد من حذف هذه الشاحنة؟')">
                                        <i class="fas fa-trash"></i> حذف الشاحنة
                                    </button>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
