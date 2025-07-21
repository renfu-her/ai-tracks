@extends('layouts.app')

@section('title', 'AI Tracks - 專業案例展示')
@section('description', 'AI Tracks 提供專業的 AI 技術解決方案，專注於程式開發、UI/UX 設計與數位轉型服務。探索我們的成功案例與最新技術趨勢。')
@section('keywords', 'AI 技術, 程式開發, UI/UX 設計, 數位轉型, Laravel, 網站開發, 人工智慧, 軟體開發')
@section('og_title', 'AI Tracks - 專業案例展示')
@section('og_description', 'AI Tracks 提供專業的 AI 技術解決方案，專注於程式開發、UI/UX 設計與數位轉型服務。')
@section('og_image', asset('images/ai-tracks-home.png'))
@section('twitter_title', 'AI Tracks - 專業案例展示')
@section('twitter_description', 'AI Tracks 提供專業的 AI 技術解決方案，專注於程式開發、UI/UX 設計與數位轉型服務。')
@section('twitter_image', asset('images/ai-tracks-home.png'))

@section('content')
    <!-- Hero Slider Section -->
    <section class="hero-slider-section">
        @if ($sliders->count() > 0)
            <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    @foreach ($sliders as $index => $slider)
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}"
                            class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $index + 1 }}"></button>
                    @endforeach
                </div>

                <!-- Slides -->
                <div class="carousel-inner">
                    @foreach ($sliders as $index => $slider)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="hero-slide" style="background-image: url('{{ Storage::url($slider->image) }}');">
                                <div class="hero-overlay"></div>
                                <div class="container">
                                    <div class="row align-items-center hero-content-wrapper">
                                        <div class="col-lg-6">
                                            <div class="hero-content text-white">
                                                <h1 class="display-5 fw-bold mb-4">{{ $slider->title }}</h1>
                                                @if ($slider->description)
                                                    <p class="lead mb-4">{{ $slider->description }}</p>
                                                @endif
                                                <div class="hero-buttons">
                                                    <a href="{{ route('cases') }}" class="btn btn-light btn-lg me-3">
                                                        <i class="fas fa-eye me-2"></i>查看案例
                                                    </a>
                                                    @if ($slider->link)
                                                        <a href="{{ $slider->link }}" class="btn btn-outline-light btn-lg"
                                                            target="_blank">
                                                            <i class="fas fa-external-link-alt me-2"></i>了解更多
                                                        </a>
                                                    @else
                                                        <a href="{{ route('contact') }}"
                                                            class="btn btn-outline-light btn-lg">
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
                @if ($sliders->count() > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                        data-bs-slide="next">
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
                    <h1 class="display-4 fw-bold mb-4">AI 助力程式開發與 UI/UX 設計</h1>
                    <p class="lead mb-4">
                        結合 AI 智能與設計美學，打造高效且直覺的開發體驗，提升效率與創意品質。
                    </p>
                    <a href="{{ route('cases') }}" class="btn btn-light btn-lg me-3">
                        <i class="fas fa-eye me-2"></i>查看案例
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-phone me-2"></i>聯絡我們
                    </a>
                </div>
                <div class="col-lg-6">
                    <img src="https://via.placeholder.com/600x400/007bff/ffffff?text=AI+Development+Design" 
                         alt="AI Development & Design" class="img-fluid rounded shadow">
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
                <p class="text-muted">探索我們最新的 AI 開發與設計案例</p>
            </div>
        </div>

            <div class="row">
                @foreach ($featuredCases as $case)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0 hover-lift d-flex flex-column">
                            <!-- 上方：圖片和標題區域 -->
                            <div class="flex-grow-1">
                                <a href="{{ route('cases') }}" class="text-decoration-none">
                                    @if ($case->casePhotos->count() > 0)
                                        <img src="{{ Storage::url($case->casePhotos->first()->image) }}" class="card-img-top"
                                            alt="{{ $case->name }}" style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-light"
                                            style="height: 200px;">
                                            <span class="text-muted">無法載入圖片</span>
                                        </div>
                                    @endif

                                    <div class="card-body">
                                        <h5 class="card-title fw-bold mb-2 text-dark">{{ $case->name }}</h5>
                                    </div>
                                </a>
                            </div>
                            
                            <!-- 下方：按鈕區域（固定高度） -->
                            <div class="card-body pt-0" style="height: 60px; display: flex; align-items: flex-end; padding-bottom: 0;">
                                @if ($case->url)
                                    <a href="{{ $case->url }}" class="btn btn-outline-primary btn-sm" target="_blank">
                                        <i class="fas fa-external-link-alt me-1"></i>查看網站
                                    </a>
                                @else
                                    <button class="btn btn-outline-secondary btn-sm" disabled>
                                        <i class="fas fa-external-link-alt me-1"></i>查看網站
                                    </button>
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
                <p class="text-muted">掌握最新的 AI 開發與設計趨勢</p>
            </div>
        </div>

            <div class="row">
                @foreach ($latestNews as $news)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            @if ($news->image)
                                <img src="{{ Storage::url($news->image) }}" class="card-img-top"
                                    alt="{{ $news->title }}" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/400x200/f8f9fa/6c757d?text=News"
                                    class="card-img-top" alt="News" style="height: 200px; object-fit: cover;">
                            @endif

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-muted">{{ $news->published_at->format('Y-m-d') }}</small>
                                    @if ($news->is_active)
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
                <p class="text-muted">專業的 AI 開發與設計解決方案</p>
            </div>
        </div>

            <div class="row">
                            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-code fa-2x text-primary"></i>
                    </div>
                    <h5 class="fw-bold">AI 程式開發</h5>
                    <p class="text-muted">結合 AI 技術的智能程式開發，提升開發效率與程式碼品質。</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-palette fa-2x text-success"></i>
                    </div>
                    <h5 class="fw-bold">UI/UX 設計</h5>
                    <p class="text-muted">AI 輔助的直覺化設計，創造美觀且易用的使用者體驗。</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                         style="width: 80px; height: 80px;">
                        <i class="fas fa-lightbulb fa-2x text-warning"></i>
                    </div>
                    <h5 class="fw-bold">創意優化</h5>
                    <p class="text-muted">AI 驅動的創意發想與設計優化，激發無限創意可能。</p>
                </div>
            </div>
            </div>
        </div>
    </section>
@endsection
