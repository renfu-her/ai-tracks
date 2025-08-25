@extends('layouts.app')

@section('title', $news->title . ' - Latest News')
@section('description', Str::limit(strip_tags($news->content), 160))

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3 bg-light">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news') }}">Latest News</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $news->title }}</li>
        </ol>
    </div>
</nav>

<!-- News Detail Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- News Header -->
                <article class="mb-4">
                    <div class="mb-4">
                        <h1 class="display-5 fw-bold mb-3">{{ $news->title }}</h1>
                        <div class="d-flex align-items-center text-muted mb-4">
                            <i class="fas fa-calendar-alt me-2"></i>
                            <span>{{ $news->published_at->format('Y-m-d') }}</span>
                        </div>
                    </div>

                    <!-- News Image -->
                    @if($news->image)
                        <div class="mb-5 text-center">
                            <img src="{{ Storage::url($news->image) }}" 
                                 alt="{{ $news->title }}" 
                                 class="img-fluid rounded shadow-lg"
                                 style="max-height: 500px; width: auto;">
                        </div>
                    @endif

                    <!-- News Content -->
                    <div class="mb-5">
                        <div class="markdown-content markdown-body bg-white p-4 rounded border">
                            {!! strip_tags($news->content, '<p><br><strong><em><ul><ol><li><h1><h2><h3><h4><h5><h6><blockquote><code><pre><table><tr><td><th>') !!}
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="mb-4">
                        <a href="{{ route('news') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back to News
                        </a>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 2rem;">
                    <!-- News Info Card -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">News Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Title:</strong><br>
                                {{ $news->title }}
                            </div>
                            <div class="mb-3">
                                <strong>Published Date:</strong><br>
                                {{ $news->published_at->format('Y-m-d') }}
                            </div>
                            <div class="mb-0">
                                <strong>Status:</strong><br>
                                <span class="badge {{ $news->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $news->is_active ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Related News -->
                    @if($relatedNews->count() > 0)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Related News</h5>
                            </div>
                            <div class="card-body">
                                @foreach($relatedNews as $relatedItem)
                                    <div class="d-flex mb-3 {{ !$loop->last ? 'border-bottom pb-3' : '' }}">
                                        @if($relatedItem->image)
                                            <img src="{{ Storage::url($relatedItem->image) }}" 
                                                 alt="{{ $relatedItem->title }}" 
                                                 class="rounded me-3"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-newspaper text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">
                                                <a href="{{ route('news.detail', $relatedItem->id) }}" 
                                                   class="text-decoration-none">
                                                    {{ Str::limit($relatedItem->title, 50) }}
                                                </a>
                                            </h6>
                                            <small class="text-muted">{{ $relatedItem->published_at->format('Y-m-d') }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/5.8.1/github-markdown.css">
<style>
.markdown-content.markdown-body {
    background-color: transparent;
    font-size: 16px;
}

.markdown-content.markdown-body table {
    color: #333 !important;
    background-color: #fff;
}

.markdown-content.markdown-body th {
    background-color: #f8f9fa;
    color: #333 !important;
}

.markdown-content.markdown-body td {
    color: #333 !important;
}

.markdown-content.markdown-body h1,
.markdown-content.markdown-body h2,
.markdown-content.markdown-body h3,
.markdown-content.markdown-body h4,
.markdown-content.markdown-body h5,
.markdown-content.markdown-body h6 {
    color: #333 !important;
}

.markdown-content.markdown-body p,
.markdown-content.markdown-body li,
.markdown-content.markdown-body span {
    color: #333 !important;
}

.markdown-content.markdown-body code {
    background-color: #f6f8fa;
    color: #333 !important;
}

.markdown-content.markdown-body pre {
    background-color: transparent;
    border: none;
    padding: 0;
    margin: 0;
    white-space: normal;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
}

.markdown-content.markdown-body pre code {
    background-color: transparent;
    border: none;
    padding: 0;
    font-family: inherit;
    font-size: inherit;
    color: inherit;
}

.markdown-content.markdown-body blockquote {
    color: #333 !important;
    border-left: 4px solid #dfe2e5;
}
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/marked/4.3.0/marked.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Convert markdown content to HTML
    const markdownContent = document.querySelector('.markdown-content');
    if (markdownContent) {
        const markdownText = markdownContent.textContent;
        markdownContent.innerHTML = marked.parse(markdownText);
    }
});
</script>
@endpush