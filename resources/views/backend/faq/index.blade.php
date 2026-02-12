@extends('backend.layouts.master')

@section('content')
<div class="wrapper">
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>الأسئلة الشائعة</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item active">الأسئلة الشائعة</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @include('backend.layouts.notification')
                        
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">قائمة الأسئلة الشائعة</h3>
                                <div class="card-tools">
                                    <a href="{{ route('faq.create') }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> إضافة سؤال جديد
                                    </a>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <!-- Filters -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <form method="GET" action="{{ route('faq.index') }}" class="form-inline">
                                            <div class="row">
                                                <div class="col-md-3 mb-2">
                                                    <input type="text" name="search" class="form-control" 
                                                           placeholder="بحث..." value="{{ request('search') }}">
                                                </div>
                                                <div class="col-md-2 mb-2">
                                                    <select name="status" class="form-control">
                                                        <option value="all">جميع الحالات</option>
                                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>نشط</option>
                                                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                                                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <select name="category" class="form-control">
                                                        <option value="all">جميع التصنيفات</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" 
                                                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                                                {{ $category->getTranslation('name', 'ar') ?: $category->getTranslation('name', 'en') }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <button type="submit" class="btn btn-info">
                                                        <i class="fas fa-filter"></i> تصفية
                                                    </button>
                                                    <a href="{{ route('faq.index') }}" class="btn btn-secondary">
                                                        <i class="fas fa-redo"></i> إعادة تعيين
                                                    </a>
                                                    <!-- Bulk Actions -->
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fas fa-cog"></i> إجراءات جماعية
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <button type="button" class="dropdown-item" onclick="bulkAction('activate')">
                                                                تفعيل المحدد
                                                            </button>
                                                            <button type="button" class="dropdown-item" onclick="bulkAction('deactivate')">
                                                                تعطيل المحدد
                                                            </button>
                                                            <div class="dropdown-divider"></div>
                                                            <button type="button" class="dropdown-item text-danger" onclick="bulkAction('delete')">
                                                                حذف المحدد
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                <!-- Bulk Action Form -->
                             {{-- <form id="bulkActionForm" method="POST" action="{{ route('faq.bulk.action') }}">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="action" id="bulkAction">
                                <input type="hidden" name="ids" id="bulkIds">
                            </form> --}}

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30">
                                                <input type="checkbox" id="selectAll">
                                            </th>
                                            <th width="60">#</th>
                                            <th>السؤال (عربي)</th>
                                            <th>السؤال (إنجليزي)</th>
                                            <th>التصنيف</th>
                                            <th>المشاهدات</th>
                                            <th>الصورة</th>
                                            <th>الحالة</th>
                                            <th>الترتيب</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($faqs as $item)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="select-item" value="{{ $item->id }}">
                                            </td>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <strong>{{ $item->getTranslation('question', 'ar') }}</strong>
                                                @if($item->getTranslation('title', 'ar'))
                                                    <br><small class="text-muted">{{ $item->getTranslation('title', 'ar') }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $item->getTranslation('question', 'en') }}</strong>
                                                @if($item->getTranslation('title', 'en'))
                                                    <br><small class="text-muted">{{ $item->getTranslation('title', 'en') }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->category)
                                                    {{ $item->category->getTranslation('name', 'ar') ?: $item->category->getTranslation('name', 'en') }}
                                                @else
                                                    <span class="text-muted">بدون تصنيف</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge badge-info">{{ $item->views_count }}</span>
                                                @if($item->helpful_yes > 0)
                                                    <span class="badge badge-success ml-1">{{ $item->helpful_yes }} نعم</span>
                                                @endif
                                                @if($item->helpful_no > 0)
                                                    <span class="badge badge-danger ml-1">{{ $item->helpful_no }} لا</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->photo_url)
                                                    <img src="{{ $item->photo_url }}" alt="صورة" 
                                                         style="max-height: 60px; max-width: 60px;" 
                                                         class="img-thumbnail">
                                                @else
                                                    <span class="text-muted">بدون صورة</span>
                                                @endif
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm status-change" 
                                                        data-id="{{ $item->id }}">
                                                    <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>
                                                        نشط
                                                    </option>
                                                    <option value="inactive" {{ $item->status == 'inactive' ? 'selected' : '' }}>
                                                        غير نشط
                                                    </option>
                                                    <option value="draft" {{ $item->status == 'draft' ? 'selected' : '' }}>
                                                        مسودة
                                                    </option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm sort-order" 
                                                       value="{{ $item->sort_order }}" 
                                                       data-id="{{ $item->id }}"
                                                       style="width: 80px;">
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('faq.edit', $item->id) }}" 
                                                       class="btn btn-info btn-sm" 
                                                       title="تعديل">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('faq.show', $item->slug) }}" 
                                                       target="_blank" 
                                                       class="btn btn-success btn-sm" 
                                                       title="عرض">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-danger btn-sm delete-btn" 
                                                            data-id="{{ $item->id }}"
                                                            title="حذف">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                                <form id="delete-form-{{ $item->id }}" 
                                                      action="{{ route('faq.destroy', $item->id) }}" 
                                                      method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                <!-- Pagination -->
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $faqs->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function() {
        // Select All Checkbox
        $('#selectAll').click(function() {
            $('.select-item').prop('checked', this.checked);
        });

        // Delete Button
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var form = $('#delete-form-' + id);
            
            swal({
                title: "هل أنت متأكد؟",
                text: "سيتم حذف هذا السؤال وكل بياناته المرتبطة!",
                icon: "warning",
                buttons: ["إلغاء", "تأكيد الحذف"],
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });

        // Status Change
        $('.status-change').change(function() {
            var id = $(this).data('id');
            var status = $(this).val();
            
            $.ajax({
                url: "{{ url('admin/faq/status') }}/" + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    swal("تم!", "تم تحديث الحالة بنجاح", "success");
                },
                error: function() {
                    swal("خطأ!", "حدث خطأ أثناء تحديث الحالة", "error");
                    location.reload();
                }
            });
        });

        // Sort Order Change
        $('.sort-order').change(function() {
            var id = $(this).data('id');
            var order = $(this).val();
            
            $.ajax({
                url: "{{ url('admin/faq/sort') }}/" + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    sort_order: order
                },
                success: function(response) {
                    // Optional: Show success message
                }
            });
        });

        // Bulk Actions
        window.bulkAction = function(action) {
            var selected = [];
            $('.select-item:checked').each(function() {
                selected.push($(this).val());
            });
            
            if (selected.length === 0) {
                swal("تنبيه!", "لم يتم تحديد أي عناصر", "warning");
                return;
            }
            
            if (action === 'delete') {
                swal({
                    title: "هل أنت متأكد؟",
                    text: "سيتم حذف جميع العناصر المحددة!",
                    icon: "warning",
                    buttons: ["إلغاء", "تأكيد الحذف"],
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $('#bulkAction').val(action);
                        $('#bulkIds').val(selected.join(','));
                        $('#bulkActionForm').submit();
                    }
                });
            } else {
                $('#bulkAction').val(action);
                $('#bulkIds').val(selected.join(','));
                $('#bulkActionForm').submit();
            }
        };
    });
</script>

<!-- DataTables -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "ordering": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Arabic.json"
            }
        });
    });
</script>
@endsection

@section('styles')
<style>
    .table td {
        vertical-align: middle;
    }
    .img-thumbnail {
        padding: 2px;
        border: 1px solid #ddd;
    }
    .status-badge {
        cursor: pointer;
    }
</style>
@endsection