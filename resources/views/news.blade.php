@extends('layouts.app')

@section('title', 'Latest News - AI Tracks')
@section('description', 'Stay updated with AI Tracks latest developments and AI technology trends. Learn about the latest programming development technologies, UI/UX design trends and digital transformation information.')
@section('keywords', 'latest news, AI technology trends, programming development news, UI/UX design trends, digital transformation information, technology updates')
@section('og_title', 'Latest News - AI Tracks')
@section('og_description', 'Stay updated with AI Tracks latest developments and AI technology trends. Learn about the latest programming development technologies, UI/UX design trends and digital transformation information.')
@section('og_image', asset('images/ai-tracks-news.png'))
@section('twitter_title', 'Latest News - AI Tracks')
@section('twitter_description', 'Stay updated with AI Tracks latest developments and AI technology trends. Learn about the latest programming development technologies, UI/UX design trends and digital transformation information.')
@section('twitter_image', asset('images/ai-tracks-news.png'))

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-5 fw-bold mb-3">Latest News</h1>
                <p class="lead">Stay updated with the latest AI technology trends and company updates</p>
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
                        <span class="text-muted me-3">Total {{ $news->total() }} news items</span>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" id="filterSelect" style="min-width: 150px;">
                            <option value="all">All News</option>
                            <option value="active">Published</option>
                            <option value="draft">Draft</option>
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
                        </div>
                        
                        <h5 class="card-title fw-bold mb-3">{{ $item->title }}</h5>
                        
                        <div class="mt-auto">
                            <button class="btn btn-primary btn-sm w-100" 
                                    onclick="showNewsDetails({{ $item->id }})">
                                <i class="fas fa-eye me-1"></i>Read Full Article
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
                <nav aria-label="News pagination">
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
                <h5 class="modal-title" id="newsModalTitle">News Details</h5>
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
<script src="https://cdn.jsdelivr.net/npm/marked@12.0.0/marked.min.js"></script>
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
        
        // Convert markdown to HTML using marked
        let contentHtml = '';
        if (data.content) {
            // Use marked library to convert markdown to HTML
            contentHtml = marked.parse(data.content);
        }
        
        $('#newsModalTitle').text(data.title);
        $('#newsModalBody').html(`
            ${imageHtml}
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Published Date: ${new Date(data.published_at).toLocaleDateString('en-US')}</small>
                </div>
            </div>
            <div class="mb-3">
                <h4>${data.title}</h4>
            </div>
            <div class="mb-3">
                <strong>News Content:</strong>
                <div class="mt-2 markdown-content markdown-body">${contentHtml}</div>
            </div>
        `);
    }).fail(function() {
        $('#newsModalBody').html('<div class="alert alert-danger">Loading failed, please try again later.</div>');
    });
}
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/5.8.1/github-markdown.css">
<style>
.hover-lift {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

/* GitHub Markdown Content Styles */
.markdown-content {
    /* Use GitHub Markdown styles */
    font-family: -apple-system,BlinkMacSystemFont,"Segoe UI","Noto Sans",Helvetica,Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji";
    font-size: 16px;
    line-height: 1.5;
    word-wrap: break-word;
}

/* Adjust GitHub Markdown display in Modal */
.markdown-content.markdown-body {
    background-color: transparent;
    color: inherit;
}

/* Fix table text color to ensure visibility in Modal */
.markdown-content.markdown-body table {
    color: #333 !important;
}

.markdown-content.markdown-body table th {
    color: #333 !important;
    background-color: #f6f8fa !important;
    border-color: #d1d9e0 !important;
}

.markdown-content.markdown-body table td {
    color: #333 !important;
    border-color: #d1d9e0 !important;
}

.markdown-content.markdown-body table tr:nth-child(even) {
    background-color: #f6f8fa !important;
}

.markdown-content.markdown-body table tr:nth-child(odd) {
    background-color: #ffffff !important;
}

/* Ensure all text is clearly visible in Modal */
.markdown-content.markdown-body h1,
.markdown-content.markdown-body h2,
.markdown-content.markdown-body h3,
.markdown-content.markdown-body h4,
.markdown-content.markdown-body h5,
.markdown-content.markdown-body h6,
.markdown-content.markdown-body p,
.markdown-content.markdown-body li,
.markdown-content.markdown-body strong,
.markdown-content.markdown-body em,
.markdown-content.markdown-body code,
.markdown-content.markdown-body blockquote {
    color: #333 !important;
}

.markdown-content.markdown-body a {
    color: #0969da !important;
}

.markdown-content.markdown-body a:hover {
    color: #1a7f37 !important;
}

/* Fix code block text color */
.markdown-content.markdown-body pre {
    background-color: #f6f8fa !important;
    color: #333 !important;
    border: 1px solid #d1d9e0 !important;
}

.markdown-content.markdown-body pre code {
    background-color: transparent !important;
    color: #333 !important;
    padding: 0 !important;
}

.markdown-content.markdown-body code {
    background-color: #f6f8fa !important;
    color: #e36209 !important;
    border: 1px solid #d1d9e0 !important;
}

/* Fix syntax highlighting block text color */
.markdown-content.markdown-body .highlight {
    background-color: #f6f8fa !important;
}

.markdown-content.markdown-body .highlight pre {
    background-color: #f6f8fa !important;
    color: #333 !important;
}
</style>
@endpush 