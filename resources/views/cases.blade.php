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

                                <a href="{{ route('cases.detail', $case->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>Details
                                </a>
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