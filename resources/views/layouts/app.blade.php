<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AI Tracks - 專業案例展示')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css?v=' . time()) }}">
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="bg-white shadow-sm sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
                    <i class="fas fa-rocket me-2"></i>AI Tracks
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">首頁</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cases') }}">案例展示</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('news') }}">最新消息</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">聯絡我們</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-light py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-3">AI Tracks</h5>
                    <p class="text-muted">專業的 AI 技術解決方案提供商，為您打造最佳的數位體驗。</p>
                </div>
                <div class="col-md-3">
                    <h6 class="mb-3">快速連結</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-muted text-decoration-none">首頁</a></li>
                        <li><a href="{{ route('cases') }}" class="text-muted text-decoration-none">案例展示</a></li>
                        <li><a href="{{ route('news') }}" class="text-muted text-decoration-none">最新消息</a></li>
                        <li><a href="{{ route('contact') }}" class="text-muted text-decoration-none">聯絡我們</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="mb-3">聯絡資訊</h6>
                    <ul class="list-unstyled text-muted">
                        <li><i class="fas fa-phone me-2"></i>02-1234-5678</li>
                        <li><i class="fas fa-envelope me-2"></i>info@aitracks.com</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i>台北市信義區</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center text-muted">
                <small>&copy; 2024 AI Tracks. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    
    @stack('scripts')
</body>
</html> 