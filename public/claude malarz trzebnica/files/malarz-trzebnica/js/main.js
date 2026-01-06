/* ============================================
   MALARZ TRZEBNICA - Main JavaScript
   Precision, Perfection, Professional
   ============================================ */

document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    /* ============================================
       1. PRELOADER
       ============================================ */
    const preloader = document.getElementById('preloader');
    
    window.addEventListener('load', function() {
        setTimeout(function() {
            preloader.classList.add('loaded');
            // Usunięcie preloadera z DOM po animacji
            setTimeout(function() {
                if (preloader.parentNode) {
                    preloader.parentNode.removeChild(preloader);
                }
            }, 500);
        }, 800);
    });

    /* ============================================
       2. HEADER SCROLL EFFECT
       ============================================ */
    const header = document.getElementById('header');
    const topBar = document.querySelector('.top-bar');
    let lastScroll = 0;

    function handleHeaderScroll() {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        lastScroll = currentScroll;
    }

    window.addEventListener('scroll', handleHeaderScroll);

    /* ============================================
       3. SMOOTH SCROLL FOR ANCHOR LINKS
       ============================================ */
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
            
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                e.preventDefault();
                
                const headerHeight = header.offsetHeight;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Zamknij mobilne menu jeśli otwarte
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                    if (bsCollapse) {
                        bsCollapse.hide();
                    }
                }
            }
        });
    });

    /* ============================================
       4. BACK TO TOP BUTTON
       ============================================ */
    const backToTopButton = document.getElementById('backToTop');
    
    function toggleBackToTop() {
        if (window.pageYOffset > 500) {
            backToTopButton.classList.add('visible');
        } else {
            backToTopButton.classList.remove('visible');
        }
    }
    
    window.addEventListener('scroll', toggleBackToTop);
    
    backToTopButton.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    /* ============================================
       5. ANIMATED COUNTER (Stats Section)
       ============================================ */
    const counters = document.querySelectorAll('.stat-number');
    let countersAnimated = false;

    function animateCounters() {
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000; // 2 sekundy
            const increment = target / (duration / 16); // 60fps
            let current = 0;

            const updateCounter = () => {
                current += increment;
                if (current < target) {
                    counter.textContent = Math.ceil(current);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent = target;
                }
            };

            updateCounter();
        });
    }

    function checkCountersInView() {
        if (countersAnimated) return;
        
        const statsSection = document.querySelector('.stats-section');
        if (!statsSection) return;
        
        const rect = statsSection.getBoundingClientRect();
        const windowHeight = window.innerHeight;
        
        if (rect.top < windowHeight * 0.75 && rect.bottom > 0) {
            countersAnimated = true;
            animateCounters();
        }
    }

    window.addEventListener('scroll', checkCountersInView);
    checkCountersInView(); // Sprawdź przy załadowaniu

    /* ============================================
       6. NAVBAR ACTIVE STATE
       ============================================ */
    function setActiveNavLink() {
        const currentPage = window.location.pathname.split('/').pop() || 'index.html';
        const navLinks = document.querySelectorAll('.nav-link');
        
        navLinks.forEach(link => {
            link.classList.remove('active');
            const href = link.getAttribute('href');
            if (href === currentPage || (currentPage === '' && href === 'index.html')) {
                link.classList.add('active');
            }
        });
    }

    setActiveNavLink();

    /* ============================================
       7. AOS (Animate On Scroll) INITIALIZATION
       ============================================ */
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50,
            delay: 0,
            disable: function() {
                return window.innerWidth < 768;
            }
        });
    }

    /* ============================================
       8. PARALLAX EFFECT
       ============================================ */
    const parallaxElements = document.querySelectorAll('.hero-slide, .stats-parallax, .cta-parallax');
    
    function handleParallax() {
        if (window.innerWidth < 768) return; // Wyłącz na mobile
        
        parallaxElements.forEach(element => {
            const scrolled = window.pageYOffset;
            const rect = element.getBoundingClientRect();
            const elementTop = rect.top + scrolled;
            const elementHeight = element.offsetHeight;
            
            if (scrolled > elementTop - window.innerHeight && scrolled < elementTop + elementHeight) {
                const speed = 0.3;
                const yPos = (scrolled - elementTop) * speed;
                element.style.backgroundPositionY = `${yPos}px`;
            }
        });
    }

    // Użyj requestAnimationFrame dla płynności
    let ticking = false;
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                handleParallax();
                ticking = false;
            });
            ticking = true;
        }
    });

    /* ============================================
       9. MOBILE MENU ANIMATION
       ============================================ */
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler && navbarCollapse) {
        navbarCollapse.addEventListener('show.bs.collapse', function() {
            navbarToggler.classList.add('active');
        });
        
        navbarCollapse.addEventListener('hide.bs.collapse', function() {
            navbarToggler.classList.remove('active');
        });
    }

    /* ============================================
       10. GALLERY HOVER EFFECTS
       ============================================ */
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    galleryItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.querySelector('.gallery-overlay').style.opacity = '1';
        });
        
        item.addEventListener('mouseleave', function() {
            this.querySelector('.gallery-overlay').style.opacity = '0';
        });
    });

    /* ============================================
       11. SERVICE CARDS HOVER ANIMATION
       ============================================ */
    const serviceCards = document.querySelectorAll('.service-card');
    
    serviceCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            const icon = this.querySelector('.service-icon');
            if (icon) {
                icon.style.transform = 'scale(1.05)';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            const icon = this.querySelector('.service-icon');
            if (icon) {
                icon.style.transform = 'scale(1)';
            }
        });
    });

    /* ============================================
       12. LAZY LOADING IMAGES
       ============================================ */
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    img.classList.add('loaded');
                    observer.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px 0px',
            threshold: 0.01
        });

        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }

    /* ============================================
       13. PHONE NUMBER CLICK TRACKING
       ============================================ */
    const phoneLinks = document.querySelectorAll('a[href^="tel:"]');
    
    phoneLinks.forEach(link => {
        link.addEventListener('click', function() {
            // Można dodać analytics tracking
            console.log('Kliknięto numer telefonu: ' + this.getAttribute('href'));
        });
    });

    /* ============================================
       14. SCROLL REVEAL ANIMATION
       ============================================ */
    function revealOnScroll() {
        const reveals = document.querySelectorAll('.reveal');
        
        reveals.forEach(element => {
            const windowHeight = window.innerHeight;
            const elementTop = element.getBoundingClientRect().top;
            const elementVisible = 150;
            
            if (elementTop < windowHeight - elementVisible) {
                element.classList.add('active');
            }
        });
    }

    window.addEventListener('scroll', revealOnScroll);

    /* ============================================
       15. HERO SLIDER (jeśli więcej slajdów)
       ============================================ */
    const heroSlides = document.querySelectorAll('.hero-slide');
    let currentSlide = 0;
    
    if (heroSlides.length > 1) {
        function nextSlide() {
            heroSlides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % heroSlides.length;
            heroSlides[currentSlide].classList.add('active');
        }
        
        // Automatyczna zmiana slajdów co 6 sekund
        setInterval(nextSlide, 6000);
    }

    /* ============================================
       16. FORM VALIDATION (dla strony kontakt)
       ============================================ */
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Prosta walidacja
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const message = document.getElementById('message');
            let isValid = true;
            
            if (name && name.value.trim() === '') {
                showError(name, 'Proszę podać imię');
                isValid = false;
            } else if (name) {
                removeError(name);
            }
            
            if (email && !isValidEmail(email.value)) {
                showError(email, 'Proszę podać prawidłowy email');
                isValid = false;
            } else if (email) {
                removeError(email);
            }
            
            if (message && message.value.trim() === '') {
                showError(message, 'Proszę wpisać wiadomość');
                isValid = false;
            } else if (message) {
                removeError(message);
            }
            
            if (isValid) {
                // Tutaj można dodać wysyłanie formularza
                console.log('Formularz wysłany');
                showSuccessMessage();
            }
        });
    }

    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }

    function showError(input, message) {
        const formGroup = input.closest('.form-group') || input.parentElement;
        formGroup.classList.add('has-error');
        
        let errorElement = formGroup.querySelector('.error-message');
        if (!errorElement) {
            errorElement = document.createElement('div');
            errorElement.className = 'error-message';
            formGroup.appendChild(errorElement);
        }
        errorElement.textContent = message;
    }

    function removeError(input) {
        const formGroup = input.closest('.form-group') || input.parentElement;
        formGroup.classList.remove('has-error');
        
        const errorElement = formGroup.querySelector('.error-message');
        if (errorElement) {
            errorElement.remove();
        }
    }

    function showSuccessMessage() {
        const form = document.getElementById('contactForm');
        if (form) {
            form.innerHTML = `
                <div class="success-message">
                    <i class="fas fa-check-circle"></i>
                    <h4>Dziękujemy za wiadomość!</h4>
                    <p>Skontaktujemy się z Tobą najszybciej jak to możliwe.</p>
                </div>
            `;
        }
    }

    /* ============================================
       17. TOOLTIP INITIALIZATION
       ============================================ */
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    if (tooltipTriggerList.length > 0 && typeof bootstrap !== 'undefined') {
        tooltipTriggerList.forEach(tooltipTriggerEl => {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    /* ============================================
       18. SMOOTH SCROLL POLYFILL CHECK
       ============================================ */
    if (!('scrollBehavior' in document.documentElement.style)) {
        // Fallback dla starszych przeglądarek
        console.log('Smooth scroll not supported, using fallback');
    }

    /* ============================================
       19. PRINT PAGE FUNCTION
       ============================================ */
    window.printPage = function() {
        window.print();
    };

    /* ============================================
       20. PERFORMANCE MONITORING
       ============================================ */
    if (window.performance) {
        window.addEventListener('load', function() {
            setTimeout(function() {
                const timing = performance.timing;
                const loadTime = timing.loadEventEnd - timing.navigationStart;
                console.log('Czas ładowania strony: ' + loadTime + 'ms');
            }, 0);
        });
    }

    /* ============================================
       21. RESIZE HANDLER
       ============================================ */
    let resizeTimer;
    
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            // Odśwież AOS po zmianie rozmiaru okna
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        }, 250);
    });

    /* ============================================
       22. INTERSECTION OBSERVER FOR ANIMATIONS
       ============================================ */
    if ('IntersectionObserver' in window) {
        const animateObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        document.querySelectorAll('.animate-on-scroll').forEach(element => {
            animateObserver.observe(element);
        });
    }

    /* ============================================
       23. CONSOLE WELCOME MESSAGE
       ============================================ */
    console.log('%c🎨 Malarz Trzebnica', 'color: #1e40af; font-size: 24px; font-weight: bold;');
    console.log('%cPrecision, Perfection, Professional', 'color: #f59e0b; font-size: 14px;');
    console.log('%cStrona internetowa wykonana z dbałością o każdy detal.', 'color: #64748b; font-size: 12px;');
    console.log('%cwww.malarz.trzebnica.pl | Tel: +48 452 690 824', 'color: #1e40af; font-size: 12px;');

});

/* ============================================
   24. UTILITY FUNCTIONS
   ============================================ */

// Debounce function
function debounce(func, wait, immediate) {
    let timeout;
    return function executedFunction() {
        const context = this;
        const args = arguments;
        const later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

// Throttle function
function throttle(func, limit) {
    let inThrottle;
    return function executedFunction() {
        const context = this;
        const args = arguments;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Check if element is in viewport
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Get scroll percentage
function getScrollPercent() {
    const h = document.documentElement;
    const b = document.body;
    const st = 'scrollTop';
    const sh = 'scrollHeight';
    return (h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight) * 100;
}
