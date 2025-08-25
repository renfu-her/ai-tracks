@extends('layouts.app')

@section('title', $case->name . ' - Case Details')
@section('description', $case->sub_name ?: 'View our project case details')

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="py-3 bg-light">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cases') }}">Case Studies</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $case->name }}</li>
        </ol>
    </div>
</nav>

<!-- Case Detail Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Case Header -->
                <div class="mb-4">
                    <h1 class="display-5 fw-bold mb-3">{{ $case->name }}</h1>
                    @if($case->sub_name)
                        <p class="lead text-muted">{{ $case->sub_name }}</p>
                    @endif
                    @if($case->url)
                        <div class="mb-3">
                            <a href="{{ $case->url }}" class="btn btn-outline-primary" target="_blank">
                                <i class="fas fa-external-link-alt me-2"></i>View Website
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Case Photos -->
                @if($case->casePhotos->count() > 0)
                    <div class="mb-5">
                        @if($case->casePhotos->count() == 1)
                            <!-- Single Photo -->
                            <div class="text-center">
                                <img src="{{ Storage::url($case->casePhotos->first()->image) }}" 
                                     alt="{{ $case->name }}" 
                                     class="img-fluid rounded shadow-lg"
                                     style="max-height: 600px; width: auto;">
                            </div>
                        @else
                            <!-- Photo Carousel -->
                            <div id="casePhotosCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach($case->casePhotos as $index => $photo)
                                        <button type="button" 
                                                data-bs-target="#casePhotosCarousel" 
                                                data-bs-slide-to="{{ $index }}" 
                                                class="{{ $index == 0 ? 'active' : '' }}"
                                                aria-current="{{ $index == 0 ? 'true' : 'false' }}" 
                                                aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner rounded shadow-lg">
                                    @foreach($case->casePhotos as $index => $photo)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ Storage::url($photo->image) }}" 
                                                 class="d-block w-100" 
                                                 alt="{{ $case->name }} - Image {{ $index + 1 }}"
                                                 style="height: 500px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#casePhotosCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#casePhotosCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @endif
                    </div>
                @endif

                                    <!-- Case Content -->
                    <div class="mb-5">
                        <h3 class="mb-3">Project Details</h3>
                        <div class="markdown-content markdown-body bg-white p-4 rounded border">
                            {!! $case->content !!}
                        </div>
                    </div>

                <!-- Back Button -->
                <div class="mb-4">
                    <a href="{{ route('cases') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Cases
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 2rem;">
                    <!-- Case Info Card -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Project Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Project Name:</strong><br>
                                {{ $case->name }}
                            </div>
                            @if($case->sub_name)
                                <div class="mb-3">
                                    <strong>Project Subtitle:</strong><br>
                                    {{ $case->sub_name }}
                                </div>
                            @endif
                            @if($case->url)
                                <div class="mb-3">
                                    <strong>Website Link:</strong><br>
                                    <a href="{{ $case->url }}" target="_blank" class="text-break">
                                        {{ $case->url }}
                                    </a>
                                </div>
                            @endif
                            <div class="mb-0">
                                <strong>Created Date:</strong><br>
                                {{ $case->created_at->format('Y-m-d') }}
                            </div>
                        </div>
                    </div>

                    <!-- Related Cases -->
                    @if($relatedCases->count() > 0)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Related Cases</h5>
                            </div>
                            <div class="card-body">
                                @foreach($relatedCases as $relatedCase)
                                    <div class="d-flex mb-3 {{ !$loop->last ? 'border-bottom pb-3' : '' }}">
                                        @if($relatedCase->casePhotos->first())
                                            <img src="{{ Storage::url($relatedCase->casePhotos->first()->image) }}" 
                                                 alt="{{ $relatedCase->name }}" 
                                                 class="rounded me-3"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                                 style="width: 60px; height: 60px;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        @endif
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">
                                                <a href="{{ route('cases.detail', $relatedCase->id) }}" 
                                                   class="text-decoration-none">
                                                    {{ $relatedCase->name }}
                                                </a>
                                            </h6>
                                            @if($relatedCase->sub_name)
                                                <small class="text-muted">{{ Str::limit($relatedCase->sub_name, 50) }}</small>
                                            @endif
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