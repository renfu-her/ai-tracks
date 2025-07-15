// Custom JavaScript for AI Tracks Frontend

$(document).ready(function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Smooth scrolling for anchor links
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if (target.length) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 1000);
        }
    });

    // Add fade-in animation to cards on scroll
    function animateOnScroll() {
        $('.card').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();

            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('fade-in');
            }
        });
    }

    // Trigger animation on scroll
    $(window).on('scroll', animateOnScroll);
    animateOnScroll(); // Initial check

    // Form validation enhancement
    $('form').on('submit', function() {
        var $form = $(this);
        var $submitBtn = $form.find('button[type="submit"]');
        var originalText = $submitBtn.text();

        // Show loading state
        $submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>處理中...');

        // Re-enable after 5 seconds (fallback)
        setTimeout(function() {
            $submitBtn.prop('disabled', false).text(originalText);
        }, 5000);
    });

    // Image lazy loading
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    // Back to top button
    var $backToTop = $('<button class="btn btn-primary rounded-circle position-fixed" style="bottom: 20px; right: 20px; width: 50px; height: 50px; z-index: 1000; display: none;"><i class="fas fa-arrow-up"></i></button>');
    $('body').append($backToTop);

    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 300) {
            $backToTop.fadeIn();
        } else {
            $backToTop.fadeOut();
        }
    });

    $backToTop.on('click', function() {
        $('html, body').animate({scrollTop: 0}, 800);
    });

    // Mobile menu enhancement
    $('.navbar-toggler').on('click', function() {
        $(this).toggleClass('active');
    });

    // Close mobile menu when clicking on a link
    $('.navbar-nav .nav-link').on('click', function() {
        $('.navbar-collapse').collapse('hide');
        $('.navbar-toggler').removeClass('active');
    });

    // Modal enhancement
    $('.modal').on('show.bs.modal', function() {
        $(this).find('.modal-content').addClass('slide-in-left');
    });

    // Alert auto-dismiss
    $('.alert').each(function() {
        var $alert = $(this);
        if (!$alert.hasClass('alert-dismissible')) {
            setTimeout(function() {
                $alert.fadeOut();
            }, 5000);
        }
    });

    // Search functionality (if needed)
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('.searchable-item').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Filter functionality enhancement
    $('.filter-btn').on('click', function() {
        var filter = $(this).data('filter');
        $('.filter-btn').removeClass('active');
        $(this).addClass('active');
        
        if (filter === 'all') {
            $('.filterable-item').show();
        } else {
            $('.filterable-item').hide();
            $('.filterable-item[data-category="' + filter + '"]').show();
        }
    });

    // Counter animation
    function animateCounter($element, target) {
        var current = 0;
        var increment = target / 100;
        var timer = setInterval(function() {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            $element.text(Math.floor(current));
        }, 20);
    }

    // Trigger counter animation when element is visible
    $('.counter').each(function() {
        var $counter = $(this);
        var target = parseInt($counter.data('target'));
        
        var observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    animateCounter($counter, target);
                    observer.unobserve(entry.target);
                }
            });
        });
        
        observer.observe($counter[0]);
    });

    // Parallax effect for hero section
    $(window).on('scroll', function() {
        var scrolled = $(window).scrollTop();
        var parallax = $('.hero-section');
        var speed = 0.5;
        
        parallax.css('transform', 'translateY(' + (scrolled * speed) + 'px)');
    });

    // Enhanced form feedback
    $('.form-control').on('blur', function() {
        var $field = $(this);
        var value = $field.val().trim();
        
        if ($field.hasClass('required') && !value) {
            $field.addClass('is-invalid');
            if (!$field.next('.invalid-feedback').length) {
                $field.after('<div class="invalid-feedback">此欄位為必填</div>');
            }
        } else {
            $field.removeClass('is-invalid');
            $field.next('.invalid-feedback').remove();
        }
    });

    // Copy to clipboard functionality
    $('.copy-btn').on('click', function() {
        var text = $(this).data('clipboard-text');
        navigator.clipboard.writeText(text).then(function() {
            // Show success message
            var $btn = $('.copy-btn');
            var originalText = $btn.text();
            $btn.text('已複製!').addClass('btn-success').removeClass('btn-outline-secondary');
            setTimeout(function() {
                $btn.text(originalText).removeClass('btn-success').addClass('btn-outline-secondary');
            }, 2000);
        });
    });

    // Keyboard navigation enhancement
    $(document).on('keydown', function(e) {
        // ESC key to close modals
        if (e.keyCode === 27) {
            $('.modal').modal('hide');
        }
        
        // Enter key to submit forms
        if (e.keyCode === 13 && $(e.target).is('input, textarea')) {
            var $form = $(e.target).closest('form');
            if ($form.length && !$(e.target).is('textarea')) {
                e.preventDefault();
                $form.submit();
            }
        }
    });

    // Performance optimization: Debounce scroll events
    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    // Apply debounce to scroll events
    var debouncedScroll = debounce(function() {
        animateOnScroll();
    }, 100);

    $(window).on('scroll', debouncedScroll);

    // Initialize any additional plugins or features
    console.log('AI Tracks Frontend initialized successfully!');
});

// Utility functions
window.AITracks = {
    // Show notification
    showNotification: function(message, type = 'info') {
        var alertClass = 'alert-' + type;
        var $alert = $('<div class="alert ' + alertClass + ' alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999;"><button type="button" class="btn-close" data-bs-dismiss="alert"></button>' + message + '</div>');
        $('body').append($alert);
        
        setTimeout(function() {
            $alert.fadeOut(function() {
                $(this).remove();
            });
        }, 5000);
    },

    // Format date
    formatDate: function(date) {
        return new Date(date).toLocaleDateString('zh-TW', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    },

    // Validate email
    validateEmail: function(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    },

    // Get URL parameters
    getUrlParameter: function(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }
}; 