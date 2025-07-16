@extends('layouts.app')

@section('title', '案例展示 - AI Tracks')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-5 fw-bold mb-3">案例展示</h1>
                <p class="lead">探索我們的成功案例，了解 AI 技術如何改變世界</p>
            </div>
        </div>
    </div>
</section>

<!-- Cases Grid -->
<section class="py-5">
    <div class="container">
        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="mb-3">
                        <span class="text-muted me-3">共 {{ $cases->total() }} 個案例</span>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" id="sortSelect">
                            <option value="latest">最新案例</option>
                            <option value="oldest">最舊案例</option>
                            <option value="name">按名稱排序</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cases Grid -->
        <div class="row" id="casesGrid">
            @foreach($cases as $case)
            <div class="col-lg-4 col-md-6 mb-4 case-item">
                <div class="card h-100 shadow-sm border-0 hover-lift">
                    @if($case->casePhotos->count() > 0)
                    <div class="position-relative">
                        <img src="{{ Storage::url($case->casePhotos->first()->image) }}" 
                             class="card-img-top" alt="{{ $case->name }}" 
                             style="height: 250px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-2">
                            @if($case->status)
                            <span class="badge bg-success">已啟用</span>
                            @else
                            <span class="badge bg-secondary">已停用</span>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="position-relative">
                        <img src="https://via.placeholder.com/400x250/f8f9fa/6c757d?text=No+Image" 
                             class="card-img-top" alt="No Image" 
                             style="height: 250px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-2">
                            @if($case->status)
                            <span class="badge bg-success">已啟用</span>
                            @else
                            <span class="badge bg-secondary">已停用</span>
                            @endif
                        </div>
                    </div>
                    @endif
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold mb-2">{{ $case->name }}</h5>
                        @if($case->sub_name)
                        <h6 class="card-subtitle text-muted mb-3">{{ $case->sub_name }}</h6>
                        @endif
                        <p class="card-text text-muted flex-grow-1">
                            {{ Str::limit(strip_tags($case->content), 120) }}
                        </p>
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center">
                                @if($case->url)
                                <a href="{{ $case->url }}" class="btn btn-outline-primary btn-sm" target="_blank">
                                    <i class="fas fa-external-link-alt me-1"></i>查看網站
                                </a>
                                @else
                                <span class="text-muted small">無網站連結</span>
                                @endif
                                
                                <button class="btn btn-primary btn-sm" 
                                        onclick="showCaseDetails({{ $case->id }})">
                                    <i class="fas fa-eye me-1"></i>詳細資訊
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($cases->hasPages())
        <div class="row">
            <div class="col-12">
                <nav aria-label="案例分頁">
                    {{ $cases->links() }}
                </nav>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Case Details Modal -->
<div class="modal fade" id="caseModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="caseModalTitle">案例詳細資訊</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="caseModalBody">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Sort functionality
    $('#sortSelect').change(function() {
        const sort = $(this).val();
        window.location.href = '{{ route("cases") }}?sort=' + sort;
    });
    
    // Set current sort value
    const urlParams = new URLSearchParams(window.location.search);
    const currentSort = urlParams.get('sort') || 'latest';
    $('#sortSelect').val(currentSort);
});

function showCaseDetails(caseId) {
    // Show loading
    $('#caseModalBody').html('<div class="text-center"><div class="spinner-border" role="status"></div></div>');
    $('#caseModal').modal('show');
    
    // Load case details via AJAX
    $.get(`/api/cases/${caseId}`, function(data) {
        let photosHtml = '';
        if (data.case_photos && data.case_photos.length > 0) {
            photosHtml = '<div class="row mb-3">';
            data.case_photos.forEach(function(photo) {
                photosHtml += `
                    <div class="col-md-4 mb-2">
                        <img src="/storage/${photo.image}" class="img-fluid rounded" alt="案例照片">
                    </div>
                `;
            });
            photosHtml += '</div>';
        }
        
        $('#caseModalTitle').text(data.name);
        $('#caseModalBody').html(`
            ${photosHtml}
            <div class="mb-3">
                <strong>案例名稱：</strong> ${data.name}
            </div>
            ${data.sub_name ? `<div class="mb-3"><strong>副標題：</strong> ${data.sub_name}</div>` : ''}
            ${data.url ? `<div class="mb-3"><strong>網站連結：</strong> <a href="${data.url}" target="_blank">${data.url}</a></div>` : ''}
            <div class="mb-3">
                <strong>案例內容：</strong>
                <div class="mt-2">${data.content}</div>
            </div>
            <div class="mb-3">
                <strong>狀態：</strong> 
                <span class="badge ${data.status ? 'bg-success' : 'bg-secondary'}">
                    ${data.status ? '已啟用' : '已停用'}
                </span>
            </div>
            <div class="mb-3">
                <strong>建立時間：</strong> ${new Date(data.created_at).toLocaleDateString('zh-TW')}
            </div>
        `);
    }).fail(function() {
        $('#caseModalBody').html('<div class="alert alert-danger">載入失敗，請稍後再試。</div>');
    });
}
</script>
@endpush

@push('styles')
<style>
.hover-lift {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}
</style>
@endpush 