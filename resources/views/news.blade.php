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
                </div>
            </div>
        </div>

        <!-- News Grid -->
        <div class="row" id="newsGrid">
            @foreach($news as $item)
            <div class="col-lg-4 col-md-6 mb-4 news-item">
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
                            <a href="{{ route('news.detail', $item->id) }}" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-eye me-1"></i>Read Full Article
                            </a>
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
@endsection

@push('styles')
<style>
.hover-lift {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}
</style>
@endpush 