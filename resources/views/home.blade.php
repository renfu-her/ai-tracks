@extends('layouts.app')

@section('title', 'AI Tracks - Professional Case Studies')
@section('description', 'AI Tracks provides professional AI technology solutions, specializing in programming development, UI/UX design and digital transformation services. Explore our successful cases and latest technology trends.')
@section('keywords', 'AI technology, programming development, UI/UX design, digital transformation, Laravel, web development, artificial intelligence, software development')
@section('og_title', 'AI Tracks - Professional Case Studies')
@section('og_description', 'AI Tracks provides professional AI technology solutions, specializing in programming development, UI/UX design and digital transformation services.')
@section('og_image', asset('images/ai-tracks-home.png'))
@section('twitter_title', 'AI Tracks - Professional Case Studies')
@section('twitter_description', 'AI Tracks provides professional AI technology solutions, specializing in programming development, UI/UX design and digital transformation services.')
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
                                                        <i class="fas fa-eye me-2"></i>View Cases
                                                    </a>
                                                    @if ($slider->link)
                                                        <a href="{{ $slider->link }}" class="btn btn-outline-light btn-lg"
                                                            target="_blank">
                                                            <i class="fas fa-external-link-alt me-2"></i>Learn More
                                                        </a>
                                                    @else
                                                        <a href="{{ route('contact') }}"
                                                            class="btn btn-outline-light btn-lg">
                                                            <i class="fas fa-phone me-2"></i>Contact Us
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
                            <h1 class="display-4 fw-bold mb-4">AI-Powered Programming Development & UI/UX Design</h1>
                            <p class="lead mb-4">
                                Combining AI intelligence with design aesthetics to create efficient and intuitive development experiences, enhancing productivity and creative quality.
                            </p>
                            <a href="{{ route('cases') }}" class="btn btn-light btn-lg me-3">
                                <i class="fas fa-eye me-2"></i>View Cases
                            </a>
                            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-phone me-2"></i>Contact Us
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
                    <h2 class="fw-bold mb-3">Featured Cases</h2>
                    <p class="text-muted">Explore our latest AI development and design cases</p>
                </div>
            </div>

            <div class="row">
                @foreach ($featuredCases as $case)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm border-0 hover-lift d-flex flex-column">
                            <!-- Top: Image and title area -->
                            <div class="flex-grow-1">
                                <a href="{{ route('cases.detail', $case->id) }}" class="text-decoration-none">
                                    @if ($case->casePhotos->count() > 0)
                                        <img src="{{ Storage::url($case->casePhotos->first()->image) }}"
                                            class="card-img-top" alt="{{ $case->name }}"
                                            style="height: 200px; object-fit: cover;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-light"
                                            style="height: 200px;">
                                            <span class="text-muted">Unable to load image</span>
                                        </div>
                                    @endif

                                    <div class="card-body">
                                        <h5 class="card-title fw-bold mb-2 text-dark">{{ $case->name }}</h5>
                                    </div>
                                </a>
                            </div>

                            <!-- Bottom: Button area (fixed height) -->
                            <div class="card-body pt-0"
                                style="height: 60px; display: flex; align-items: flex-end; padding-bottom: 10px;">
                                @if ($case->url)
                                    <a href="{{ $case->url }}" class="btn btn-outline-primary btn-sm" target="_blank">
                                        <i class="fas fa-external-link-alt me-1"></i>View Website
                                    </a>
                                @else
                                    <button class="btn btn-outline-secondary btn-sm" disabled>
                                        <i class="fas fa-external-link-alt me-1"></i>View Website
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('cases') }}" class="btn btn-primary btn-lg">
                    View More Cases <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="bg-light py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="fw-bold mb-3">Latest News</h2>
                    <p class="text-muted">Stay updated with the latest AI development and design trends</p>
                </div>
            </div>

            <div class="row">
                @foreach ($latestNews as $news)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <a href="{{ route('news') }}" class="text-decoration-none">
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
                                    </div>
                                    <h5 class="card-title fw-bold">{{ $news->title }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('news') }}" class="btn btn-outline-primary btn-lg">
                    View More News <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="fw-bold mb-3">Our Services</h2>
                    <p class="text-muted">Professional AI development and design solutions</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="text-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-code fa-2x text-primary"></i>
                        </div>
                        <h5 class="fw-bold">AI Programming Development</h5>
                        <p class="text-muted">Intelligent programming development combining AI technology to enhance development efficiency and code quality.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="text-center">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-palette fa-2x text-success"></i>
                        </div>
                        <h5 class="fw-bold">UI/UX Design</h5>
                        <p class="text-muted">AI-assisted intuitive design, creating beautiful and user-friendly experiences.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="text-center">
                        <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-lightbulb fa-2x text-warning"></i>
                        </div>
                        <h5 class="fw-bold">Creative Optimization</h5>
                        <p class="text-muted">AI-driven creative ideation and design optimization, inspiring unlimited creative possibilities.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
