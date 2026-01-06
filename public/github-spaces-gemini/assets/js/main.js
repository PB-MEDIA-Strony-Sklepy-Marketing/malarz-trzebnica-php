/**
 * Malarz Trzebnica - Main JavaScript File
 * Precision, Perfection, Professional
 * 
 * Zawiera logikę dla:
 * 1. Nawigacji i efektów scrollowania
 * 2. Animacji pojawiania się elementów (Scroll Reveal)
 * 3. Liczników statystyk
 * 4. Galerii Lightbox (Custom Implementation)
 * 5. Walidacji formularzy
 */

'use strict';

document.addEventListener('DOMContentLoaded', () => {
    
    // ==========================================
    // 1. NAWIGACJA & HEADER
    // ==========================================
    
    const navbar = document.querySelector('.navbar');
    const navLinks = document.querySelectorAll('.nav-link');
    const navbarCollapse = document.querySelector('.navbar-collapse');

    // Efekt zmiany tła nawigacji przy przewijaniu
    function handleScroll() {
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled', 'shadow-sm');
        } else {
            navbar.classList.remove('navbar-scrolled', 'shadow-sm');
        }
    }

    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Init check

    // Zamykanie menu mobilnego po kliknięciu w link
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navbarCollapse.classList.contains('show')) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                    toggle: true
                });
            }
        });
    });

    // Smooth Scroll dla linków kotwicznych (jeśli występują)
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href !== "#" && document.querySelector(href)) {
                e.preventDefault();
                const targetElement = document.querySelector(href);
                const headerOffset = 80;
                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // ==========================================
    // 2. ANIMACJE SCROLL (INTERSECTION OBSERVER)
    // ==========================================
    
    // Obserwator dla animacji pojawiania się
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.15
    };

    const fadeInUpObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target); // Animuj tylko raz
            }
        });
    }, observerOptions);

    // Znajdź wszystkie elementy do animacji
    // Dodaj klasę .animate-on-scroll w HTML do elementów, które mają się animować
    const animatedElements = document.querySelectorAll('.animate-on-scroll, .feature-card, .service-card, .gallery-item');
    animatedElements.forEach((el, index) => {
        // Dodaj opóźnienie dla elementów w grupie (stagger effect)
        if (!el.style.transitionDelay && index % 3 !== 0) {
            el.style.transitionDelay = `${(index % 3) * 0.1}s`;
        }
        el.classList.add('fade-up-hidden'); // Klasa bazowa ukrywająca element
        fadeInUpObserver.observe(el);
    });

    // ==========================================
    // 3. LICZNIKI STATYSTYK
    // ==========================================
    
    const counters = document.querySelectorAll('.counter-value');
    
    const counterObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000; // 2 sekundy
                const step = target / (duration / 16); // 60fps
                
                let current = 0;
                const updateCounter = () => {
                    current += step;
                    if (current < target) {
                        counter.textContent = Math.ceil(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };
                
                updateCounter();
                observer.unobserve(counter);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => {
        counterObserver.observe(counter);
    });

    // ==========================================
    // 4. GALERIA LIGHTBOX (Custom)
    // ==========================================
    
    // Inicjalizacja Lightboxa
    const galleryImages = document.querySelectorAll('.gallery-item img');
    
    if (galleryImages.length > 0) {
        // Stwórz elementy DOM dla Lightboxa
        const lightboxOverlay = document.createElement('div');
        lightboxOverlay.id = 'custom-lightbox';
        lightboxOverlay.className = 'lightbox-overlay';
        lightboxOverlay.innerHTML = `
            <button class="lightbox-close" aria-label="Zamknij">&times;</button>
            <button class="lightbox-prev" aria-label="Poprzednie">&lt;</button>
            <button class="lightbox-next" aria-label="Następne">&gt;</button>
            <div class="lightbox-content">
                <img src="" alt="Powiększenie" class="lightbox-img">
                <div class="lightbox-caption"></div>
            </div>
        `;
        document.body.appendChild(lightboxOverlay);

        const lightboxImg = lightboxOverlay.querySelector('.lightbox-img');
        const lightboxCaption = lightboxOverlay.querySelector('.lightbox-caption');
        const closeBtn = lightboxOverlay.querySelector('.lightbox-close');
        const prevBtn = lightboxOverlay.querySelector('.lightbox-prev');
        const nextBtn = lightboxOverlay.querySelector('.lightbox-next');
        
        let currentIndex = 0;

        // Funkcja otwierająca lightbox
        const openLightbox = (index) => {
            currentIndex = index;
            const img = galleryImages[currentIndex];
            // Użyj źródła wysokiej jakości jeśli dostępne (data-full), w przeciwnym razie src
            const imgSrc = img.getAttribute('data-full') || img.src;
            const imgAlt = img.alt || 'Realizacja Malarz Trzebnica';
            
            lightboxImg.src = imgSrc;
            lightboxCaption.textContent = imgAlt;
            lightboxOverlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Zablokuj scrollowanie strony
        };

        // Funkcja zamykająca
        const closeLightbox = () => {
            lightboxOverlay.classList.remove('active');
            document.body.style.overflow = '';
            setTimeout(() => {
                lightboxImg.src = ''; // Wyczyść src po animacji
            }, 300);
        };

        // Nawigacja
        const showNext = (e) => {
            if(e) e.stopPropagation();
            currentIndex = (currentIndex + 1) % galleryImages.length;
            openLightbox(currentIndex);
        };

        const showPrev = (e) => {
            if(e) e.stopPropagation();
            currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
            openLightbox(currentIndex);
        };

        // Event Listeners dla galerii
        galleryImages.forEach((img, index) => {
            // Dodaj kursor pointer i efekt hover w CSS
            img.style.cursor = 'pointer';
            img.closest('.gallery-item').addEventListener('click', (e) => {
                e.preventDefault();
                openLightbox(index);
            });
        });

        // Event Listeners dla kontrolek
        closeBtn.addEventListener('click', closeLightbox);
        nextBtn.addEventListener('click', showNext);
        prevBtn.addEventListener('click', showPrev);

        // Zamknij po kliknięciu w tło
        lightboxOverlay.addEventListener('click', (e) => {
            if (e.target === lightboxOverlay || e.target.classList.contains('lightbox-content')) {
                closeLightbox();
            }
        });

        // Obsługa klawiatury
        document.addEventListener('keydown', (e) => {
            if (!lightboxOverlay.classList.contains('active')) return;
            
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowRight') showNext();
            if (e.key === 'ArrowLeft') showPrev();
        });
    }

    // ==========================================
    // 5. WALIDACJA FORMULARZA KONTAKTOWEGO
    // ==========================================
    
    const contactForm = document.querySelector('.needs-validation');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function (event) {
            if (!contactForm.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                // Tutaj można dodać obsługę AJAX
                // event.preventDefault();
                // submitViaAjax(new FormData(contactForm));
            }
            contactForm.classList.add('was-validated');
        }, false);
    }

    // ==========================================
    // 6. STOPKA - ROK
    // ==========================================
    const yearSpan = document.querySelector('#current-year');
    if (yearSpan) {
        yearSpan.textContent = new Date().getFullYear();
    }
});

// Pomocnicza funkcja do obsługi AJAX (opcjonalna)
/*
async function submitViaAjax(formData) {
    const submitBtn = document.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    try {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Wysyłanie...';
        
        const response = await fetch('kontakt.php', {
            method: 'POST',
            body: formData
        });
        
        if (response.ok) {
            alert('Dziękujemy! Wiadomość została wysłana.');
            document.querySelector('.needs-validation').reset();
            document.querySelector('.needs-validation').classList.remove('was-validated');
        } else {
            throw new Error('Błąd wysyłania');
        }
    } catch (error) {
        alert('Wystąpił błąd podczas wysyłania wiadomości. Spróbuj ponownie lub zadzwoń.');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    }
}
*/