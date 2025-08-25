<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AI Tracks - Professional Case Studies')</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('description', 'AI Tracks provides professional AI technology solutions, specializing in programming development, UI/UX design and digital transformation services.')">
    <meta name="keywords" content="@yield('keywords', 'AI technology, programming development, UI/UX design, digital transformation, Laravel, web development')">
    <meta name="author" content="AI Tracks">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="@yield('og_title', 'AI Tracks - Professional Case Studies')">
    <meta property="og:description" content="@yield('og_description', 'AI Tracks provides professional AI technology solutions, specializing in programming development, UI/UX design and digital transformation services.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/ai-tracks-og.jpg'))">
    <meta property="og:site_name" content="AI Tracks">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'AI Tracks - Professional Case Studies')">
    <meta name="twitter:description" content="@yield('twitter_description', 'AI Tracks provides professional AI technology solutions, specializing in programming development, UI/UX design and digital transformation services.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/ai-tracks-og.jpg'))">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ request()->url() }}">

    <!-- Additional SEO -->
    <meta name="theme-color" content="#007bff">
    <meta name="msapplication-TileColor" content="#007bff">

    <link rel="icon" href="{{ asset('images/ai-tracks.png') }}" type="image/x-icon">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css?v=' . time()) }}">

    <script type="text/javascript">
        (function(c, l, a, r, i, t, y) {
            c[a] = c[a] || function() {
                (c[a].q = c[a].q || []).push(arguments)
            };
            t = l.createElement(r);
            t.async = 1;
            t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, "clarity", "script", "spfii8nlyu");
    </script>

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
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cases') }}">Case Studies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('news') }}">News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
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
                    <p class="text-white-50">Professional AI technology solution provider, creating the best digital experience for you.</p>
                </div>
                <div class="col-md-3">
                    <h6 class="mb-3">Quick Links</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white-50 text-decoration-none">Home</a></li>
                        <li><a href="{{ route('cases') }}" class="text-white-50 text-decoration-none">Case Studies</a></li>
                        <li><a href="{{ route('news') }}" class="text-white-50 text-decoration-none">News</a></li>
                        <li><a href="{{ route('contact') }}" class="text-white-50 text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="mb-3">Contact Information</h6>
                    <ul class="list-unstyled text-white-50">
                        <li><i class="fas fa-phone me-2"></i>0922-013-171</li>
                        <li><i class="fas fa-envelope me-2"></i>renfu.her@gmail.com</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center text-white-50">
                <small>&copy; 2024 AI Tracks. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/app.js?v=' . time()) }}"></script>

    @stack('scripts')
</body>

</html>
