@extends('layouts.app')

@section('title', '最新消息 - AI Tracks')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-5 fw-bold mb-3">最新消息</h1>
                <p class="lead">掌握最新的 AI 技術趨勢與公司動態</p>
            </div>
        </div>
    </div>
</section>

<!-- News Grid -->
<section class="py-5">
    <div class="container">
        <!-- Filter Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div class="mb-3">
                        <span class="text-muted me-3">共 {{ $news->total() }} 則消息</span>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" id="filterSelect">
                            <option value="all">全部消息</option>
                            <option value="active">已發布</option>
                            <option value="draft">草稿</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- News Grid -->
        <div class="row" id="newsGrid">
            @foreach($news as $item)
            <div class="col-lg-4 col-md-6 mb-4 news-item" data-status="{{ $item->is_active ? 'active' : 'draft' }}">
                <article class="card h-100 shadow-sm border-0 hover-lift">
                    @if($item->image)
                    <img src="{{ Storage::url($item->image) }}" 
                         class="card-img-top" alt="{{ $item->title }}" 
                         style="height: 200px; object-fit: cover;">
                    @else
                    <img src="https://via.placeholder.com/400x200/f8f9fa/6c757d?text=News" 
                         class="card-img-top" alt="News" 
                         style="height: 200px; object-fit: cover;">
                    @endif
                    
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <small class="text-muted">{{ $item->published_at->format('Y-m-d') }}</small>
                            @if($item->is_active)
                            <span class="badge bg-success">已發布</span>
                            @else
                            <span class="badge bg-secondary">草稿</span>
                            @endif
                        </div>
                        
                        <h5 class="card-title fw-bold mb-3">{{ $item->title }}</h5>
                        <p class="card-text text-muted flex-grow-1">
                            {{ Str::limit(strip_tags($item->content), 120) }}
                        </p>
                        
                        <div class="mt-auto">
                            <button class="btn btn-primary btn-sm w-100" 
                                    onclick="showNewsDetails({{ $item->id }})">
                                <i class="fas fa-eye me-1"></i>閱讀全文
                            </button>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($news->hasPages())
        <div class="row">
            <div class="col-12">
                <nav aria-label="消息分頁">
                    {{ $news->links() }}
                </nav>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- News Details Modal -->
<div class="modal fade" id="newsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newsModalTitle">消息詳細內容</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="newsModalBody">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Filter functionality
    $('#filterSelect').change(function() {
        const filter = $(this).val();
        
        if (filter === 'all') {
            $('.news-item').show();
        } else {
            $('.news-item').hide();
            $(`.news-item[data-status="${filter}"]`).show();
        }
    });
});

function showNewsDetails(newsId) {
    // Show loading
    $('#newsModalBody').html('<div class="text-center"><div class="spinner-border" role="status"></div></div>');
    $('#newsModal').modal('show');
    
    // Load news details via AJAX
    $.get(`/api/news/${newsId}`, function(data) {
        let imageHtml = '';
        if (data.image) {
            imageHtml = `
                <div class="text-center mb-3">
                    <img src="/storage/${data.image}" class="img-fluid rounded" alt="${data.title}" style="max-height: 300px;">
                </div>
            `;
        }
        
        $('#newsModalTitle').text(data.title);
        $('#newsModalBody').html(`
            ${imageHtml}
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">發布日期：${new Date(data.published_at).toLocaleDateString('zh-TW')}</small>
                    <span class="badge ${data.is_active ? 'bg-success' : 'bg-secondary'}">
                        ${data.is_active ? '已發布' : '草稿'}
                    </span>
                </div>
            </div>
            <div class="mb-3">
                <h4>${data.title}</h4>
            </div>
            <div class="news-content">
                ${data.content}
            </div>
        `);
    }).fail(function() {
        $('#newsModalBody').html('<div class="alert alert-danger">載入失敗，請稍後再試。</div>');
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

.news-content {
    line-height: 1.8;
}

.news-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1rem 0;
}
</style>
@endpush 