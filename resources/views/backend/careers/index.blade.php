@extends('backend.layouts.master')

@section('title', __('admin.careers.title'))

@section('content')
    @php
        $lang = app()->getLocale();
        $isRTL = $lang === 'ar';
    @endphp

    <style>
        /* Admin Panel Styles */
        .stats-card {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .table-responsive {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .table th {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            font-weight: 600;
            color: #475569;
            padding: 1rem;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-active {
            background: #d1fae5;
            color: #065f46;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        .btn-primary-admin {
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary-admin:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(14, 165, 233, 0.2);
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            padding-{{ $isRTL ? 'right' : 'left' }}: 3rem;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .search-box i {
            position: absolute;
            top: 50%;
            {{ $isRTL ? 'right' : 'left' }}: 1rem;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            border-bottom: 1px solid #e2e8f0;
            padding: 1.5rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        /* Animation for table rows */
        @keyframes fadeInRow {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table tbody tr {
            animation: fadeInRow 0.3s ease-out;
            animation-fill-mode: both;
        }

        .table tbody tr:nth-child(1) { animation-delay: 0.1s; }
        .table tbody tr:nth-child(2) { animation-delay: 0.2s; }
        .table tbody tr:nth-child(3) { animation-delay: 0.3s; }
        .table tbody tr:nth-child(4) { animation-delay: 0.4s; }
        .table tbody tr:nth-child(5) { animation-delay: 0.5s; }
    </style>

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">{{ __('admin.careers.title') }}</h1>
            <p class="text-slate-600 mt-2">{{ __('admin.careers.subtitle') }}</p>
        </div>
        <a href="{{ route('admin.careers.create') }}" class="btn-primary-admin flex items-center gap-2">
            <i class="fas fa-plus"></i> {{ __('admin.careers.add_new') }}
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="stats-card">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-2xl font-bold text-slate-800">{{ $careers->total() }}</div>
                    <div class="text-slate-600 text-sm">{{ __('admin.careers.stats.total') }}</div>
                </div>
                <div class="stats-icon bg-blue-100 text-blue-600">
                    <i class="fas fa-briefcase"></i>
                </div>
            </div>
        </div>

        <div class="stats-card">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-2xl font-bold text-slate-800">
                        {{ $careers->where('is_active', true)->count() }}
                    </div>
                    <div class="text-slate-600 text-sm">{{ __('admin.careers.stats.active') }}</div>
                </div>
                <div class="stats-icon bg-green-100 text-green-600">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>

        <div class="stats-card">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-2xl font-bold text-slate-800">
                        {{ $departmentsCount ?? 0 }}
                    </div>
                    <div class="text-slate-600 text-sm">{{ __('admin.careers.stats.departments') }}</div>
                </div>
                <div class="stats-icon bg-purple-100 text-purple-600">
                    <i class="fas fa-building"></i>
                </div>
            </div>
        </div>

        <div class="stats-card">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-2xl font-bold text-slate-800">
                        {{ $expiringCount ?? 0 }}
                    </div>
                    <div class="text-slate-600 text-sm">{{ __('admin.careers.stats.expiring') }}</div>
                </div>
                <div class="stats-icon bg-amber-100 text-amber-600">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-2xl shadow p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="search-box">
                <input type="text" id="searchInput" class="w-full p-3" 
                       placeholder="{{ __('admin.careers.search_placeholder') }}">
                <i class="fas fa-search"></i>
            </div>
            
            <select id="statusFilter" class="p-3 border border-slate-300 rounded-xl">
                <option value="">{{ __('admin.careers.filter.all_status') }}</option>
                <option value="active">{{ __('admin.careers.filter.active') }}</option>
                <option value="inactive">{{ __('admin.careers.filter.inactive') }}</option>
            </select>

            <select id="typeFilter" class="p-3 border border-slate-300 rounded-xl">
                <option value="">{{ __('admin.careers.filter.all_types') }}</option>
                @foreach(['full-time', 'part-time', 'remote', 'contract', 'internship'] as $type)
                    <option value="{{ $type }}">{{ __('careers.job_types.' . $type) }}</option>
                @endforeach
            </select>

            <button id="applyFilters" class="bg-slate-100 text-slate-700 p-3 rounded-xl font-semibold hover:bg-slate-200 transition">
                {{ __('admin.careers.apply_filters') }}
            </button>
        </div>
    </div>

    <!-- Careers Table -->
    <div class="table-responsive">
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-start">{{ __('admin.careers.table.title') }}</th>
                    <th class="text-start">{{ __('admin.careers.table.department') }}</th>
                    <th class="text-start">{{ __('admin.careers.table.type') }}</th>
                    <th class="text-start">{{ __('admin.careers.table.deadline') }}</th>
                    <th class="text-start">{{ __('admin.careers.table.applications') }}</th>
                    <th class="text-start">{{ __('admin.careers.table.status') }}</th>
                    <th class="text-start">{{ __('admin.careers.table.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($careers as $career)
                    <tr class="border-t border-slate-100 hover:bg-slate-50 transition-colors">
                        <td>
                            <div class="font-medium text-slate-800">{{ $career->title }}</div>
                            <div class="text-sm text-slate-500">{{ $career->location }}</div>
                        </td>
                        <td class="text-slate-700">{{ $career->department }}</td>
                        <td>
                            <span class="badge-job-type badge-{{ $career->type }} text-xs">
                                {{ __('careers.job_types.' . $career->type) }}
                            </span>
                        </td>
                        <td>
                            <div class="text-slate-700">{{ $career->application_deadline->format('d/m/Y') }}</div>
                            @if($career->application_deadline->isPast())
                                <span class="text-xs text-red-500">{{ __('admin.careers.expired') }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-slate-700">
                                    {{ $career->applications_count ?? 0 }}
                                </span>
                                <i class="fas fa-users text-slate-400 text-sm"></i>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $career->is_active ? 'active' : 'inactive' }}">
                                {{ $career->is_active ? __('admin.careers.active') : __('admin.careers.inactive') }}
                            </span>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <a href="{{ route('admin.careers.edit', $career->id) }}" 
                                   class="action-btn bg-blue-100 text-blue-600 hover:bg-blue-200"
                                   title="{{ __('admin.careers.edit') }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <button onclick="toggleStatus({{ $career->id }})"
                                        class="action-btn {{ $career->is_active ? 'bg-orange-100 text-orange-600 hover:bg-orange-200' : 'bg-green-100 text-green-600 hover:bg-green-200' }}"
                                        title="{{ $career->is_active ? __('admin.careers.deactivate') : __('admin.careers.activate') }}">
                                    <i class="fas fa-{{ $career->is_active ? 'ban' : 'check' }}"></i>
                                </button>
                                
                                <button onclick="confirmDelete({{ $career->id }})"
                                        class="action-btn bg-red-100 text-red-600 hover:bg-red-200"
                                        title="{{ __('admin.careers.delete') }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <a href="{{ route('careers.show', $career->id) }}" target="_blank"
                                   class="action-btn bg-slate-100 text-slate-600 hover:bg-slate-200"
                                   title="{{ __('admin.careers.preview') }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-12 text-slate-500">
                            <i class="fas fa-briefcase text-4xl mb-4 text-slate-300"></i>
                            <div class="text-lg font-medium">{{ __('admin.careers.no_jobs') }}</div>
                            <p class="mt-2">{{ __('admin.careers.no_jobs_description') }}</p>
                            <a href="{{ route('admin.careers.create') }}" class="btn-primary-admin inline-flex items-center gap-2 mt-4">
                                <i class="fas fa-plus"></i> {{ __('admin.careers.add_first') }}
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($careers->hasPages())
        <div class="mt-6">
            {{ $careers->links() }}
        </div>
    @endif

    <!-- JavaScript -->
    <script>
        // Search and Filter Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const typeFilter = document.getElementById('typeFilter');
            const applyFiltersBtn = document.getElementById('applyFilters');
            const tableRows = document.querySelectorAll('tbody tr');

            function filterTable() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;
                const typeValue = typeFilter.value;

                tableRows.forEach(row => {
                    if (row.cells.length < 7) return; // Skip empty row

                    const title = row.cells[0].textContent.toLowerCase();
                    const type = row.cells[2].textContent.toLowerCase();
                    const status = row.cells[5].textContent.toLowerCase();

                    const matchesSearch = title.includes(searchTerm);
                    const matchesType = !typeValue || type.includes(typeValue);
                    const matchesStatus = !statusValue || 
                        (statusValue === 'active' && status.includes('active')) ||
                        (statusValue === 'inactive' && status.includes('inactive'));

                    if (matchesSearch && matchesType && matchesStatus) {
                        row.style.display = '';
                        row.style.animation = 'fadeInRow 0.3s ease-out';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
            typeFilter.addEventListener('change', filterTable);
            applyFiltersBtn.addEventListener('click', filterTable);
        });

        // Toggle Status Function
        async function toggleStatus(careerId) {
            if (!confirm('{{ __("admin.careers.confirm_toggle") }}')) return;

            try {
                const response = await fetch(`/admin/careers/${careerId}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    location.reload();
                } else {
                    throw new Error('{{ __("admin.careers.toggle_error") }}');
                }
            } catch (error) {
                alert(error.message);
            }
        }

        // Delete Confirmation
        async function confirmDelete(careerId) {
            if (!confirm('{{ __("admin.careers.confirm_delete") }}')) return;

            try {
                const response = await fetch(`/admin/careers/${careerId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                });

                if (response.ok) {
                    location.reload();
                } else {
                    throw new Error('{{ __("admin.careers.delete_error") }}');
                }
            } catch (error) {
                alert(error.message);
            }
        }

        // Export to CSV
        function exportToCSV() {
            // Implement CSV export functionality
            alert('Export functionality will be implemented soon!');
        }

        // Bulk Actions
        function handleBulkAction(action) {
            const selectedIds = Array.from(document.querySelectorAll('input[name="selected_jobs[]"]:checked'))
                .map(checkbox => checkbox.value);

            if (selectedIds.length === 0) {
                alert('{{ __("admin.careers.no_selection") }}');
                return;
            }

            if (action === 'delete') {
                if (!confirm('{{ __("admin.careers.confirm_bulk_delete") }}')) return;
                // Implement bulk delete
            } else if (action === 'activate') {
                // Implement bulk activate
            } else if (action === 'deactivate') {
                // Implement bulk deactivate
            }
        }
    </script>
@endsection