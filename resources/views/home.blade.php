@extends('layouts.app')

@section('title', 'AI Tracks - 首頁')

@section('content')
<!-- Hero Slider Section -->
<section class="hero-slider-section">
    @if($sliders->count() > 0)
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <!-- Indicators -->
        <div class="carousel-indicators">
            @foreach($sliders as $index => $slider)
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" 
                    class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                    aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <!-- Slides -->
        <div class="carousel-inner">
            @foreach($sliders as $index => $slider)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <div class="hero-slide" style="background-image: url('{{ Storage::url($slider->image) }}');">
                    <div class="hero-overlay"></div>
                    <div class="container">
                        <div class="row align-items-center hero-content-wrapper">
                            <div class="col-lg-6">
                                <div class="hero-content text-white">
                                    <h1 class="display-4 fw-bold mb-4">{{ $slider->title }}</h1>
                                    @if($slider->description)
                                    <p class="lead mb-4">{{ $slider->description }}</p>
                                    @endif
                                    <div class="hero-buttons">
                                        <a href="{{ route('cases') }}" class="btn btn-light btn-lg me-3">
                                            <i class="fas fa-eye me-2"></i>查看案例
                                        </a>
                                        @if($slider->link)
                                        <a href="{{ $slider->link }}" class="btn btn-outline-light btn-lg" target="_blank">
                                            <i class="fas fa-external-link-alt me-2"></i>了解更多
                                        </a>
                                        @else
                                        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                                            <i class="fas fa-phone me-2"></i>聯絡我們
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Controls -->
        @if($sliders->count() > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        @endif
    </div>
    @else
    <!-- Fallback Hero Section -->
    <section class="hero-section bg-gradient-primary text-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">AI 技術的未來</h1>
                    <p class="lead mb-4">
                        我們專注於提供最先進的 AI 解決方案，為您的業務帶來革命性的改變。
                    </p>
                    <a href="{{ route('cases') }}" class="btn btn-light btn-lg me-3">
                        <i class="fas fa-eye me-2"></i>查看案例
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-phone me-2"></i>聯絡我們
                    </a>
                </div>
                <div class="col-lg-6">
                    <img src="https://via.placeholder.com/600x400/007bff/ffffff?text=AI+Technology" 
                         alt="AI Technology" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>
    @endif
</section>

<!-- Featured Cases Section -->
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold mb-3">精選案例</h2>
                <p class="text-muted">探索我們最新的成功案例</p>
            </div>
        </div>
        
        <div class="row">
            @foreach($featuredCases as $case)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($case->casePhotos->count() > 0)
                    <img src="{{ Storage::url($case->casePhotos->first()->image) }}" 
                         class="card-img-top" alt="{{ $case->name }}" style="height: 200px; object-fit: cover;">
                    @else
                    <div class="d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                        <span class="text-muted">無法載入圖片</span>
                    </div>
                    @endif
                    
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-2">{{ $case->name }}</h5>
                        @if($case->sub_name)
                        <h6 class="card-subtitle text-muted mb-3">{{ $case->sub_name }}</h6>
                        @endif
                        @if($case->url)
                        <a href="{{ $case->url }}" class="btn btn-outline-primary btn-sm" target="_blank">
                            <i class="fas fa-external-link-alt me-1"></i>查看網站
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('cases') }}" class="btn btn-primary btn-lg">
                查看更多案例 <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Latest News Section -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold mb-3">最新消息</h2>
                <p class="text-muted">掌握最新的 AI 技術趨勢</p>
            </div>
        </div>
        
        <div class="row">
            @foreach($latestNews as $news)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    @if($news->image)
                    <img src="{{ Storage::url($news->image) }}" 
                         class="card-img-top" alt="{{ $news->title }}" style="height: 200px; object-fit: cover;">
                    @else
                    <img src="https://via.placeholder.com/400x200/f8f9fa/6c757d?text=News" 
                         class="card-img-top" alt="News" style="height: 200px; object-fit: cover;">
                    @endif
                    
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <small class="text-muted">{{ $news->published_at->format('Y-m-d') }}</small>
                            @if($news->is_active)
                            <span class="badge bg-success">已發布</span>
                            @else
                            <span class="badge bg-secondary">草稿</span>
                            @endif
                        </div>
                        <h5 class="card-title fw-bold">{{ $news->title }}</h5>
                        <p class="card-text text-muted">{{ Str::limit(strip_tags($news->content), 100) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('news') }}" class="btn btn-outline-primary btn-lg">
                查看更多消息 <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold mb-3">我們的服務</h2>
                <p class="text-muted">專業的 AI 技術解決方案</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-brain fa-2x text-primary"></i>
                    </div>
                    <h5 class="fw-bold">機器學習</h5>
                    <p class="text-muted">客製化的機器學習模型開發，為您的業務提供智能分析。</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-robot fa-2x text-success"></i>
                    </div>
                    <h5 class="fw-bold">自動化流程</h5>
                    <p class="text-muted">智能自動化流程設計，提升工作效率與準確性。</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-chart-line fa-2x text-warning"></i>
                    </div>
                    <h5 class="fw-bold">數據分析</h5>
                    <p class="text-muted">深度數據分析與視覺化，發掘隱藏的商業價值。</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 