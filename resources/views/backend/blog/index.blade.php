@extends('backend.layouts.master')

@section('title', 'Blog Management')


<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<style>
    .blog-status {
        font-size: 0.75rem;
        padding: 2px 8px;
        border-radius: 12px;
    }
    .status-published { background-color: #d4edda; color: #155724; }
    .status-draft { background-color: #fff3cd; color: #856404; }
    .status-archived { background-color: #f8d7da; color: #721c24; }
    .seo-score {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 12px;
    }
    .score-high { background-color: #28a745; color: white; }
    .score-medium { background-color: #ffc107; color: #212529; }
    .score-low { background-color: #dc3545; color: white; }
</style>

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blog Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Blogs</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Statistics Cards -->
            <div class="row mb-3">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $stats['total'] }}</h3>
                            <p>Total Blogs</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <a href="{{ route('adminblog.index', ['status' => '']) }}" class="small-box-footer">
                            View All <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $stats['published'] }}</h3>
                            <p>Published</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <a href="{{ route('adminblog.index', ['status' => 'published']) }}" class="small-box-footer">
                            View Published <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $stats['drafts'] }}</h3>
                            <p>Drafts</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <a href="{{ route('adminblog.index', ['status' => 'draft']) }}" class="small-box-footer">
                            View Drafts <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3>{{ $stats['featured'] }}</h3>
                            <p>Featured</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <a href="{{ route('adminblog.index', ['featured' => 'yes']) }}" class="small-box-footer">
                            View Featured <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Filters</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('adminblog.index') }}" method="GET" id="filterForm">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Search</label>
                                    <input type="text" name="search" class="form-control" 
                                           value="{{ request('search') }}" placeholder="Search blogs...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control select2">
                                        <option value="">All Status</option>
                                        @foreach($statuses as $status)
                                            <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category" class="form-control select2">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Author</label>
                                    <select name="author" class="form-control select2">
                                        <option value="">All Authors</option>
                                        @foreach($authors as $author)
                                            <option value="{{ $author->id }}" {{ request('author') == $author->id ? 'selected' : '' }}>
                                                {{ $author->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Featured</label>
                                    <select name="featured" class="form-control select2">
                                        <option value="">All</option>
                                        <option value="yes" {{ request('featured') == 'yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="no" {{ request('featured') == 'no' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Sort By</label>
                                    <select name="sort" class="form-control select2">
                                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                        <option value="published_desc" {{ request('sort') == 'published_desc' ? 'selected' : '' }}>Published Date</option>
                                        <option value="views_desc" {{ request('sort') == 'views_desc' ? 'selected' : '' }}>Most Views</option>
                                        <option value="likes_desc" {{ request('sort') == 'likes_desc' ? 'selected' : '' }}>Most Likes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input type="date" name="date_from" class="form-control" 
                                           value="{{ request('date_from') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>To Date</label>
                                    <input type="date" name="date_to" class="form-control" 
                                           value="{{ request('date_to') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" style="margin-top: 30px;">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-filter"></i> Apply Filters
                                    </button>
                                    <a href="{{ route('adminblog.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Clear Filters
                                    </a>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exportModal">
                                        <i class="fas fa-download"></i> Export
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row mb-3">
                <div class="col-12">
                    <div class="btn-group">
                        <a href="{{ route('adminblog.create') }}" class="btn btn-success">
                            <i class="fas fa-plus"></i> Create New Blog
                        </a>
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-cog"></i> Bulk Actions
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item bulk-action-btn" href="#" data-action="publish">
                                <i class="fas fa-check-circle text-success"></i> Publish Selected
                            </a>
                            <a class="dropdown-item bulk-action-btn" href="#" data-action="draft">
                                <i class="fas fa-edit text-warning"></i> Move to Draft
                            </a>
                            <a class="dropdown-item bulk-action-btn" href="#" data-action="archive">
                                <i class="fas fa-archive text-secondary"></i> Archive Selected
                            </a>
                            <a class="dropdown-item bulk-action-btn" href="#" data-action="feature">
                                <i class="fas fa-star text-warning"></i> Mark as Featured
                            </a>
                            <a class="dropdown-item bulk-action-btn" href="#" data-action="unfeature">
                                <i class="fas fa-star text-secondary"></i> Remove Featured
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item bulk-action-btn text-danger" href="#" data-action="delete">
                                <i class="fas fa-trash"></i> Delete Selected
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blogs Table -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Blogs List</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">Showing {{ $blogs->firstItem() }} to {{ $blogs->lastItem() }} of {{ $blogs->total() }}</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="bulkActionForm" action="{{ route('adminblog.bulk-action') }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" id="bulkAction">
                        <input type="hidden" name="ids" id="bulkIds">
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="50">
                                            <input type="checkbox" id="selectAll">
                                        </th>
                                        <th width="60">ID</th>
                                        <th>Title & Excerpt</th>
                                        <th width="120">Category</th>
                                        <th width="100">Author</th>
                                        <th width="100">Status</th>
                                        <th width="80">Views</th>
                                        <th width="80">SEO</th>
                                        <th width="150">Published</th>
                                        <th width="120">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($blogs as $blog)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="blog-checkbox" value="{{ $blog->id }}">
                                        </td>
                                        <td>{{ $blog->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-start">
                                                @if($blog->featured_image)
                                                <img src="{{ Storage::url($blog->featured_image) }}" 
                                                     alt="{{ $blog->title }}" 
                                                     class="img-thumbnail mr-2" 
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                <div class="img-thumbnail mr-2 d-flex align-items-center justify-content-center" 
                                                     style="width: 60px; height: 60px; background: #f8f9fa;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                                @endif
                                                <div>
                                                    <strong>
                                                        <a href="{{ route('adminblog.show', $blog->id) }}">
                                                            {{ Str::limit($blog->title, 50) }}
                                                        </a>
                                                        @if($blog->featured)
                                                        <span class="badge badge-warning ml-1">Featured</span>
                                                        @endif
                                                    </strong>
                                                    <p class="text-muted mb-0 small">
                                                        {{ Str::limit(strip_tags($blog->excerpt), 80) }}
                                                    </p>
                                                    <div class="small text-muted">
                                                        <i class="fas fa-clock"></i> {{ $blog->reading_time }}
                                                        @if($blog->translations->count() > 0)
                                                        <span class="ml-2">
                                                            <i class="fas fa-language"></i> {{ $blog->translations->count() }} langs
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($blog->category)
                                            <span class="badge" style="background-color: {{ $blog->category->color }}; color: white;">
                                                {{ $blog->category->name }}
                                            </span>
                                            @else
                                            <span class="text-muted">No category</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $blog->author->avatar ?? asset('backend/dist/img/user2-160x160.jpg') }}" 
                                                     alt="{{ $blog->author->name }}" 
                                                     class="img-circle mr-2" 
                                                     style="width: 30px; height: 30px;">
                                                <span>{{ $blog->author->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <select class="form-control form-control-sm status-select" 
                                                    data-blog-id="{{ $blog->id }}"
                                                    style="min-width: 100px;">
                                                <option value="draft" {{ $blog->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                                <option value="published" {{ $blog->status == 'published' ? 'selected' : '' }}>Published</option>
                                                <option value="archived" {{ $blog->status == 'archived' ? 'selected' : '' }}>Archived</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <div class="text-bold">{{ number_format($blog->views) }}</div>
                                                <div class="small text-muted">
                                                    <i class="fas fa-heart text-danger"></i> {{ $blog->likes }}
                                                    <i class="fas fa-share text-info ml-2"></i> {{ $blog->shares }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $seoScore = $blog->seo_score ?? 0;
                                                $scoreClass = $seoScore >= 80 ? 'score-high' : ($seoScore >= 60 ? 'score-medium' : 'score-low');
                                            @endphp
                                            <div class="seo-score {{ $scoreClass }} mx-auto" 
                                                 title="SEO Score: {{ $seoScore }}/100"
                                                 data-toggle="tooltip">
                                                {{ $seoScore }}
                                            </div>
                                        </td>
                                        <td>
                                            @if($blog->published_at)
                                            <div class="small">
                                                <div>{{ $blog->published_at->format('M d, Y') }}</div>
                                                <div class="text-muted">{{ $blog->published_at->format('h:i A') }}</div>
                                            </div>
                                            @else
                                            <span class="text-muted">Not published</span>
                                            @endif
                                            @if($blog->scheduled_for && $blog->scheduled_for > now())
                                            <div class="badge badge-info mt-1">Scheduled</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('blog.show', $blog->slug) }}" 
                                                   target="_blank" 
                                                   class="btn btn-info" 
                                                   title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('adminblog.edit', $blog->id) }}" 
                                                   class="btn btn-primary" 
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('adminblog.seo-analysis', $blog->id) }}" 
                                                   class="btn btn-warning" 
                                                   title="SEO Analysis">
                                                    <i class="fas fa-chart-line"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-secondary dropdown-toggle dropdown-toggle-split" 
                                                        data-toggle="dropdown">
                                                    <span class="sr-only">More actions</span>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('adminblog.clone', $blog->id) }}">
                                                        <i class="fas fa-copy text-info"></i> Clone
                                                    </a>
                                                    <a class="dropdown-item regenerate-slug" href="#" data-id="{{ $blog->id }}">
                                                        <i class="fas fa-link text-secondary"></i> Regenerate Slug
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger delete-btn" 
                                                       href="#" 
                                                       data-id="{{ $blog->id }}"
                                                       data-title="{{ $blog->title }}">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10" class="text-center py-4">
                                            <div class="empty-state">
                                                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                                <h4>No blogs found</h4>
                                                <p class="text-muted">Create your first blog post to get started.</p>
                                                <a href="{{ route('adminblog.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus"></i> Create New Blog
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="card-footer clearfix">
                    <div class="float-right">
                        {{ $blogs->appends(request()->query())->links() }}
                    </div>
                    <div class="float-left">
                        <div class="small text-muted">
                            Showing {{ $blogs->firstItem() }} to {{ $blogs->lastItem() }} of {{ $blogs->total() }} entries
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Export Modal -->
<div class="modal fade" id="exportModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Export Blogs</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('adminblog.export') }}" method="GET" id="exportForm">
                    <div class="form-group">
                        <label for="exportFormat">Format</label>
                        <select name="format" id="exportFormat" class="form-control">
                            <option value="csv">CSV (Excel)</option>
                            <option value="json">JSON</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Export Range</label>
                        <select name="range" class="form-control">
                            <option value="all">All Blogs</option>
                            <option value="published">Published Only</option>
                            <option value="draft">Drafts Only</option>
                            <option value="featured">Featured Only</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" form="exportForm" class="btn btn-primary">
                    <i class="fas fa-download"></i> Export
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete "<span id="deleteBlogTitle"></span>"?</p>
                <p class="text-danger"><small>This action cannot be undone. All translations and related data will also be deleted.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap4'
    });

    // Select all checkbox
    $('#selectAll').change(function() {
        $('.blog-checkbox').prop('checked', $(this).prop('checked'));
    });

    // Bulk actions
    $('.bulk-action-btn').click(function(e) {
        e.preventDefault();
        const action = $(this).data('action');
        const selected = $('.blog-checkbox:checked');
        
        if (selected.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'No blogs selected',
                text: 'Please select at least one blog to perform this action.'
            });
            return;
        }

        const ids = selected.map(function() {
            return $(this).val();
        }).get();

        if (action === 'delete') {
            Swal.fire({
                title: 'Are you sure?',
                text: `This will delete ${ids.length} blog(s) permanently.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete them!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#bulkAction').val(action);
                    $('#bulkIds').val(JSON.stringify(ids));
                    $('#bulkActionForm').submit();
                }
            });
        } else {
            $('#bulkAction').val(action);
            $('#bulkIds').val(JSON.stringify(ids));
            $('#bulkActionForm').submit();
        }
    });

    // Status change
    $('.status-select').change(function() {
        const blogId = $(this).data('blog-id');
        const status = $(this).val();
        
        $.ajax({
            url: "{{ url('admin/blogs') }}/" + blogId + "/status",
            method: 'PUT',
            data: {
                _token: "{{ csrf_token() }}",
                status: status
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to update status.'
                });
            }
        });
    });

    // Delete single blog
    $('.delete-btn').click(function(e) {
        e.preventDefault();
        const blogId = $(this).data('id');
        const blogTitle = $(this).data('title');
        
        $('#deleteBlogTitle').text(blogTitle);
        $('#deleteForm').attr('action', "{{ url('admin/blogs') }}/" + blogId);
        $('#deleteModal').modal('show');
    });

    // Regenerate slug
    $('.regenerate-slug').click(function(e) {
        e.preventDefault();
        const blogId = $(this).data('id');
        
        Swal.fire({
            title: 'Regenerate Slug?',
            text: 'This will change the URL of the blog.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, regenerate',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ url('admin/blogs') }}/" + blogId + "/regenerate-slug",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to regenerate slug.'
                        });
                    }
                });
            }
        });
    });

    // Tooltips
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection

