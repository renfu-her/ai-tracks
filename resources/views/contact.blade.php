@extends('layouts.app')

@section('title', '聯絡我們 - AI Tracks')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-5 fw-bold mb-3">聯絡我們</h1>
                <p class="lead">我們隨時準備為您提供專業的 AI 技術諮詢</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-lg-8 mb-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="fw-bold mb-4">發送訊息</h3>
                        
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">姓名 <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">電子郵件 <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email') }}" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="phone" class="form-label">電話號碼</label>
                                <input type="tel" class="form-control" id="phone" name="phone" 
                                       value="{{ old('phone') }}">
                            </div>
                            
                            <div class="mb-3">
                                <label for="subject" class="form-label">主旨 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="subject" name="subject" 
                                       value="{{ old('subject') }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">訊息內容 <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" name="message" rows="6" 
                                          required>{{ old('message') }}</textarea>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="privacy" name="privacy" required>
                                    <label class="form-check-label" for="privacy">
                                        我同意 <a href="#" class="text-decoration-none">隱私政策</a> 和 
                                        <a href="#" class="text-decoration-none">服務條款</a>
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>發送訊息
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">聯絡資訊</h4>
                        
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                 style="width: 50px; height: 50px;">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">地址</h6>
                                <p class="text-muted mb-0">台北市信義區信義路五段7號</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                 style="width: 50px; height: 50px;">
                                <i class="fas fa-phone text-success"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">電話</h6>
                                <p class="text-muted mb-0">02-1234-5678</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                 style="width: 50px; height: 50px;">
                                <i class="fas fa-envelope text-warning"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">電子郵件</h6>
                                <p class="text-muted mb-0">info@aitracks.com</p>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" 
                                 style="width: 50px; height: 50px;">
                                <i class="fas fa-clock text-info"></i>
                            </div>
                            <div>
                                <h6 class="mb-1">營業時間</h6>
                                <p class="text-muted mb-0">週一至週五 9:00-18:00</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">關注我們</h4>
                        <div class="d-flex gap-3">
                            <a href="#" class="btn btn-outline-primary rounded-circle" style="width: 50px; height: 50px;">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-outline-info rounded-circle" style="width: 50px; height: 50px;">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-outline-danger rounded-circle" style="width: 50px; height: 50px;">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#" class="btn btn-outline-dark rounded-circle" style="width: 50px; height: 50px;">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h3 class="fw-bold">我們的位置</h3>
                <p class="text-muted">歡迎您親自來訪</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="ratio ratio-21x9">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3614.7!2d121.5654!3d25.0330!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3442abb6da9c9e1f%3A0x1206bcf082fd10a6!2z5Y-w5YyX5biC5L-h576p5Y2A5L-h576p6Lev5LqU5q2N6KGX!5e0!3m2!1szh-TW!2stw!4v1234567890" 
                                    style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Form validation
    $('#contactForm').on('submit', function(e) {
        let isValid = true;
        
        // Check required fields
        $(this).find('[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        // Email validation
        const email = $('#email').val();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email && !emailRegex.test(email)) {
            $('#email').addClass('is-invalid');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $('.is-invalid').first().offset().top - 100
            }, 500);
        }
    });
    
    // Remove validation on input
    $('input, textarea').on('input', function() {
        $(this).removeClass('is-invalid');
    });
});
</script>
@endpush

@push('styles')
<style>
.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.is-invalid {
    border-color: #dc3545 !important;
}

.is-invalid:focus {
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
}
</style>
@endpush 