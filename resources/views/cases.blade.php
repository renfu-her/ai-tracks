@extends('layouts.app')

@section('title', 'Case Studies - AI Tracks')
@section('description', 'Explore AI Tracks successful cases, including programming development, UI/UX design, website development and other professional technical solutions. Learn how we use AI technology to create value for clients.')
@section('keywords', 'case studies, programming development cases, UI/UX design cases, website development cases, AI technology cases, Laravel cases')
@section('og_title', 'Case Studies - AI Tracks')
@section('og_description', 'Explore AI Tracks successful cases, including programming development, UI/UX design, website development and other professional technical solutions.')
@section('og_image', asset('images/ai-tracks-cases.png'))
@section('twitter_title', 'Case Studies - AI Tracks')
@section('twitter_description', 'Explore AI Tracks successful cases, including programming development, UI/UX design, website development and other professional technical solutions.')
@section('twitter_image', asset('images/ai-tracks-cases.png'))

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-5 fw-bold mb-3">Case Studies</h1>
                <p class="lead">Explore our successful cases and see how AI technology is changing the world</p>
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
                        <span class="text-muted me-3">Total {{ $cases->total() }} cases</span>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" id="sortSelect" style="min-width: 150px;">
                            <option value="latest">Latest Cases</option>
                            <option value="oldest">Oldest Cases</option>
                            <option value="name">Sort by Name</option>
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
                    </div>
                    @else
                    <div class="position-relative">
                        <img src="https://via.placeholder.com/400x250/f8f9fa/6c757d?text=No+Image" 
                             class="card-img-top" alt="No Image" 
                             style="height: 250px; object-fit: cover;">
                    </div>
                    @endif
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold mb-2">{{ $case->name }}</h5>
                        @if($case->sub_name)
                        <h6 class="card-subtitle text-muted mb-3">{{ $case->sub_name }}</h6>
                        @endif
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center">
                                @if($case->url)
                                <a href="{{ $case->url }}" class="btn btn-outline-primary btn-sm" target="_blank">
                                    <i class="fas fa-external-link-alt me-1"></i>View Website
                                </a>
                                @else
                                <span class="text-muted small">No website link</span>
                                @endif
                                
                                <button class="btn btn-primary btn-sm" 
                                        onclick="showCaseDetails({{ $case->id }})">
                                    <i class="fas fa-eye me-1"></i>Details
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
                <nav aria-label="Case studies pagination">
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
                <h5 class="modal-title" id="caseModalTitle">Case Details</h5>
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
<script src="https://cdn.jsdelivr.net/npm/marked@12.0.0/marked.min.js"></script>
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
                        <img src="/storage/${photo.image}" class="img-fluid rounded" alt="Case photo">
                    </div>
                `;
            });
            photosHtml += '</div>';
        }
        
        // Convert markdown to HTML using marked
        let contentHtml = '';
        if (data.content) {
            // Use marked library to convert markdown to HTML
            contentHtml = marked.parse(data.content);
        }
        
        $('#caseModalTitle').text(data.name);
        $('#caseModalBody').html(`
            ${photosHtml}
            <div class="mb-3">
                <strong>Case Name:</strong> ${data.name}
            </div>
            ${data.sub_name ? `<div class="mb-3"><strong>Subtitle:</strong> ${data.sub_name}</div>` : ''}
            ${data.url ? `<div class="mb-3"><strong>Website Link:</strong> <a href="${data.url}" target="_blank">${data.url}</a></div>` : ''}
            <div class="mb-3">
                <strong>Case Content:</strong>
                <div class="mt-2 markdown-content markdown-body">${contentHtml}</div>
            </div>
            <div class="mb-3">
                <strong>Status:</strong> 
                <span class="badge ${data.status ? 'bg-success' : 'bg-secondary'}">
                    ${data.status ? 'Active' : 'Inactive'}
                </span>
            </div>
            <div class="mb-3">
                <strong>Created Date:</strong> ${new Date(data.created_at).toLocaleDateString('en-US')}
            </div>
        `);
    }).fail(function() {
        $('#caseModalBody').html('<div class="alert alert-danger">Loading failed, please try again later.</div>');
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

.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
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

/* Discord specific styles for spoiler */
.markdown-content .spoiler {
    background-color: #333;
    color: #333;
    padding: 0.1rem 0.3rem;
    border-radius: 0.2rem;
    cursor: pointer;
    user-select: none;
}

.markdown-content .spoiler:hover {
    color: #fff;
}

.markdown-content .spoiler.revealed {
    color: #fff;
}
</style>
@endpush 