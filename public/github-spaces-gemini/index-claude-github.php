<?php
/**
 * Strona Główna - Malarz Trzebnica
 * www.malarz.trzebnica.pl
 * 
 * Precision, Perfection, Professional
 * 
 * @version 2.0.0
 * @author PB MEDIA
 */

// Konfiguracja meta tagów dla tej podstrony
$pageTitle = "Malarz Trzebnica - Profesjonalne Usługi Malarskie | Precision, Perfection, Professional";
$pageDescription = "Profesjonalny malarz w Trzebnicy i okolicach. Malowanie wnętrz i elewacji, szpachlowanie, sucha zabudowa GK, układanie podłóg i glazury.  Darmowa wycena!  Tel: +48 452 690 824";
$pageKeywords = "malarz Trzebnica, usługi malarskie Trzebnica, malowanie wnętrz, malowanie elewacji, szpachlowanie, gładzie gipsowe, sucha zabudowa GK, remonty Trzebnica";
$currentPage = 'index';

include 'includes/header.php';
?>

<!-- Hero Section z Parallax -->
<section class="hero-section position-relative overflow-hidden" id="hero">
    <div class="hero-bg-overlay"></div>
    <div class="hero-particles"></div>
    
    <div class="container position-relative z-index-2">
        <div class="row min-vh-100 align-items-center py-5">
            <div class="col-lg-7 col-xl-6" data-aos="fade-right" data-aos-duration="1000">
                <!-- Badge -->
                <div class="hero-badge mb-4">
                    <span class="badge bg-primary bg-opacity-20 text-primary px-3 py-2 rounded-pill">
                        <i class="fas fa-award me-2"></i>10+ lat doświadczenia
                    </span>
                </div>
                
                <!-- Slogan -->
                <p class="hero-slogan text-primary fw-bold text-uppercase ls-3 mb-3">
                    Precision, Perfection, Professional
                </p>
                
                <!-- Główny nagłówek -->
                <h1 class="display-3 fw-bold text-white mb-4 hero-title">
                    Profesjonalny <span class="text-gradient-primary">Malarz</span><br>
                    <span class="text-primary">Trzebnica</span> i Okolice
                </h1>
                
                <!-- Opis -->
                <p class="lead text-white-75 mb-5 hero-description" style="font-size: 1.25rem; line-height: 1.8;">
                    Tworzymy wnętrza z pasją i precyzją. Oferujemy kompleksowe usługi malarskie, 
                    szpachlowanie natryskowe, suchą zabudowę GK oraz wykończenia pod klucz.  
                    <strong class="text-white">Gwarantujemy terminowość i najwyższą jakość wykonania. </strong>
                </p>
                
                <!-- Przyciski CTA -->
                <div class="d-flex flex-column flex-sm-row gap-3 mb-5">
                    <a href="kontakt.php" class="btn btn-primary btn-lg px-5 py-3 rounded-pill shadow-lg btn-hover-scale">
                        <i class="fas fa-phone-alt me-2"></i>Darmowa Wycena
                    </a>
                    <a href="galeria.php" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill btn-hover-scale">
                        <i class="fas fa-images me-2"></i>Zobacz Realizacje
                    </a>
                </div>
                
                <!-- Trust indicators -->
                <div class="hero-trust d-flex flex-wrap gap-4 text-white-50">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle text-primary me-2"></i>
                        <span>Darmowa wycena</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle text-primary me-2"></i>
                        <span>Gwarancja jakości</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-check-circle text-primary me-2"></i>
                        <span>Terminowość</span>
                    </div>
                </div>
            </div>
            
            <!-- Hero Image -->
            <div class="col-lg-5 col-xl-6 d-none d-lg-block" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="hero-image-wrapper position-relative">
                    <img src="https://images.unsplash.com/photo-1562259949-e8e7689d7828?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="Profesjonalny malarz podczas pracy w Trzebnicy" 
                         class="img-fluid rounded-4 shadow-2xl hero-floating-image">
                    
                    <!-- Floating card -->
                    <div class="hero-floating-card position-absolute bg-white rounded-3 shadow-lg p-3" style="bottom: 20%; left: -10%;">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                <i class="fas fa-star text-primary fa-lg"></i>
                            </div>
                            <div>
                                <div class="fw-bold text-dark">150+ Realizacji</div>
                                <small class="text-muted">Zadowolonych klientów</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="hero-scroll-indicator position-absolute bottom-0 start-50 translate-middle-x pb-4">
        <a href="#about" class="text-white-50 text-decoration-none d-flex flex-column align-items-center">
            <span class="small mb-2">Przewiń w dół</span>
            <i class="fas fa-chevron-down fa-bounce"></i>
        </a>
    </div>
</section>

<!-- About Section -->
<section class="py-5 py-lg-6 bg-white" id="about">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <!-- Image Column -->
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="800">
                <div class="about-image-wrapper position-relative">
                    <img src="https://images.unsplash.com/photo-1589939705384-5185137a7f0f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="Profesjonalny malarz podczas pracy - usługi malarskie Trzebnica" 
                         class="img-fluid rounded-4 shadow-lg about-img-main">
                    
                    <!-- Experience badge -->
                    <div class="about-experience-badge position-absolute bg-primary text-white rounded-3 shadow-lg p-4 text-center">
                        <span class="display-4 fw-bold d-block">10+</span>
                        <span class="small text-uppercase ls-2">Lat<br>Doświadczenia</span>
                    </div>
                    
                    <!-- Decorative element -->
                    <div class="about-decoration position-absolute bg-primary opacity-10 rounded-4" 
                         style="width: 80%; height: 80%; bottom: -20px; right: -20px; z-index: -1;"></div>
                </div>
            </div>
            
            <!-- Content Column -->
            <div class="col-lg-6 ps-lg-5" data-aos="fade-left" data-aos-duration="800" data-aos-delay="100">
                <div class="section-header mb-4">
                    <span class="text-primary fw-bold text-uppercase ls-2 d-block mb-2">
                        <i class="fas fa-info-circle me-2"></i>O Naszej Firmie
                    </span>
                    <h2 class="display-5 fw-bold mb-3">
                        Twój Zaufany Partner w <span class="text-primary">Wykończeniach Wnętrz</span>
                    </h2>
                </div>
                
                <p class="text-muted mb-4" style="font-size: 1.1rem; line-height: 1.8;">
                    Jesteśmy <strong>lokalną firmą malarską z Trzebnicy</strong>, dla której malowanie to nie tylko praca, 
                    ale przede wszystkim pasja. Działamy na terenie Trzebnicy i okolicznych miejscowości, 
                    dostarczając usługi na najwyższym poziomie od ponad <strong>10 lat</strong>. 
                </p>
                
                <p class="text-muted mb-4" style="font-size:  1.1rem; line-height: 1.8;">
                    Naszą najmocniejszą stroną są <strong>usługi malarskie wewnątrz i na zewnątrz pomieszczeń</strong>, 
                    szpachlowanie ścian oraz sucha zabudowa GK.  Dysponujemy <strong>profesjonalnym i nowoczesnym sprzętem</strong> 
                    (agregaty malarskie Wagner, Graco, szlifierki bezpyłowe Festool), co pozwala nam na szybką i czystą pracę.
                </p>
                
                <!-- Features grid -->
                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center p-3 bg-light rounded-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-primary fa-lg"></i>
                            </div>
                            <div class="ms-3">
                                <span class="fw-medium">Terminowość realizacji</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center p-3 bg-light rounded-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-primary fa-lg"></i>
                            </div>
                            <div class="ms-3">
                                <span class="fw-medium">Czystość pracy</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center p-3 bg-light rounded-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-primary fa-lg"></i>
                            </div>
                            <div class="ms-3">
                                <span class="fw-medium">Darmowa wycena</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center p-3 bg-light rounded-3">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-primary fa-lg"></i>
                            </div>
                            <div class="ms-3">
                                <span class="fw-medium">Gwarancja jakości</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <a href="oferta.php" class="btn btn-primary btn-lg rounded-pill px-5 btn-hover-scale">
                    Poznaj Pełną Ofertę <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5 py-lg-6 bg-light" id="services">
    <div class="container py-5">
        <!-- Section Header -->
        <div class="text-center mb-5 mx-auto" style="max-width: 700px;" data-aos="fade-up">
            <span class="text-primary fw-bold text-uppercase ls-2 d-block mb-2">
                <i class="fas fa-paint-roller me-2"></i>Nasza Oferta
            </span>
            <h2 class="display-5 fw-bold mb-4">
                Kompleksowe <span class="text-primary">Usługi Wykończeniowe</span>
            </h2>
            <p class="text-muted lead">
                Świadczymy szeroki zakres usług wykończeniowych, dbając o każdy detal.  
                Od przygotowania powierzchni po ostatnie pociągnięcie pędzlem.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="row g-4">
            <!-- Service 1: Malowanie Wnętrz -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card h-100 bg-white rounded-4 shadow-sm p-4 transition-all">
                    <div class="service-icon bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-paint-roller text-primary fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Malowanie Wnętrz</h4>
                    <p class="text-muted mb-4">
                        Precyzyjne malowanie ścian i sufitów w mieszkaniach, domach i biurach. 
                        Używamy farb najwyższej jakości (Dulux, Tikkurila) odpornych na zmywanie i ścieranie.
                    </p>
                    <ul class="list-unstyled text-muted small mb-4">
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Pokoje, salony, sypialne</li>
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Kuchnie i łazienki</li>
                        <li><i class="fas fa-check text-primary me-2"></i>Biura i lokale usługowe</li>
                    </ul>
                    <a href="oferta.php#malowanie-wnetrz" class="text-primary fw-bold text-decoration-none service-link">
                        Więcej szczegółów <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- Service 2: Malowanie Elewacji -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card h-100 bg-white rounded-4 shadow-sm p-4 transition-all">
                    <div class="service-icon bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 80px; height:  80px;">
                        <i class="fas fa-home text-primary fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Malowanie Elewacji</h4>
                    <p class="text-muted mb-4">
                        Odświeżanie i malowanie elewacji budynków mieszkalnych i komercyjnych. 
                        Zabezpieczamy mury przed wilgocią, grzybami i algami, nadając im nowy, świeży wygląd.
                    </p>
                    <ul class="list-unstyled text-muted small mb-4">
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Domy jednorodzinne</li>
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Budynki wielorodzinne</li>
                        <li><i class="fas fa-check text-primary me-2"></i>Obiekty komercyjne</li>
                    </ul>
                    <a href="oferta.php#malowanie-elewacji" class="text-primary fw-bold text-decoration-none service-link">
                        Więcej szczegółów <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- Service 3: Szpachlowanie -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="service-card h-100 bg-white rounded-4 shadow-sm p-4 transition-all">
                    <div class="service-icon bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-layer-group text-primary fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Szpachlowanie Ścian</h4>
                    <p class="text-muted mb-4">
                        Idealnie gładkie ściany dzięki profesjonalnemu szpachlowaniu i gładziom gipsowym. 
                        Przygotowanie powierzchni pod malowanie ze standardem Q3/Q4.
                    </p>
                    <ul class="list-unstyled text-muted small mb-4">
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Gładzie gipsowe</li>
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Szpachlowanie natryskowe</li>
                        <li><i class="fas fa-check text-primary me-2"></i>Naprawa pęknięć</li>
                    </ul>
                    <a href="oferta.php#szpachlowanie" class="text-primary fw-bold text-decoration-none service-link">
                        Więcej szczegółów <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- Service 4: Zabudowa GK -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card h-100 bg-white rounded-4 shadow-sm p-4 transition-all">
                    <div class="service-icon bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-tools text-primary fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Sucha Zabudowa GK</h4>
                    <p class="text-muted mb-4">
                        Montaż sufitów podwieszanych, ścianek działowych oraz zabudów dekoracyjnych 
                        z płyt gipsowo-kartonowych.  Nowoczesne rozwiązania dla Twojego wnętrza.
                    </p>
                    <ul class="list-unstyled text-muted small mb-4">
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Sufity podwieszane</li>
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Ścianki działowe</li>
                        <li><i class="fas fa-check text-primary me-2"></i>Zabudowy wnęk</li>
                    </ul>
                    <a href="oferta.php#zabudowa-gk" class="text-primary fw-bold text-decoration-none service-link">
                        Więcej szczegółów <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- Service 5: Podłogi i Glazura -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card h-100 bg-white rounded-4 shadow-sm p-4 transition-all">
                    <div class="service-icon bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-th text-primary fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Podłogi i Glazura</h4>
                    <p class="text-muted mb-4">
                        Układanie paneli podłogowych, wykładzin oraz glazury na ścianach i podłogach. 
                        Kompleksowe wykończenia łazienek i kuchni z dbałością o detale.
                    </p>
                    <ul class="list-unstyled text-muted small mb-4">
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Panele laminowane i winylowe</li>
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Płytki ceramiczne</li>
                        <li><i class="fas fa-check text-primary me-2"></i>Wykładziny PCV</li>
                    </ul>
                    <a href="oferta.php#podlogi-glazura" class="text-primary fw-bold text-decoration-none service-link">
                        Więcej szczegółów <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>

            <!-- Service 6: Wykończenia -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="service-card h-100 bg-white rounded-4 shadow-sm p-4 transition-all">
                    <div class="service-icon bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <i class="fas fa-pencil-ruler text-primary fa-2x"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Wykończenia Wnętrz</h4>
                    <p class="text-muted mb-4">
                        Drobne elementy wykończenia, montaże listew przypodłogowych, prace naprawcze. 
                        Dbamy o to, by Twoje wnętrze było dopracowane w każdym calu.
                    </p>
                    <ul class="list-unstyled text-muted small mb-4">
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Listwy przypodłogowe</li>
                        <li class="mb-2"><i class="fas fa-check text-primary me-2"></i>Montaż drzwi</li>
                        <li><i class="fas fa-check text-primary me-2"></i>Prace naprawcze</li>
                    </ul>
                    <a href="oferta.php#wykonczenia" class="text-primary fw-bold text-decoration-none service-link">
                        Więcej szczegółów <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- CTA Button -->
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="oferta.php" class="btn btn-primary btn-lg rounded-pill px-5 py-3 btn-hover-scale">
                <i class="fas fa-list-ul me-2"></i>Zobacz Pełną Ofertę
            </a>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-5 py-lg-6 bg-dark text-white position-relative overflow-hidden" id="why-us">
    <!-- Background Pattern -->
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-5">
        <div class="bg-pattern"></div>
    </div>
    
    <div class="container py-5 position-relative">
        <div class="row align-items-center g-5">
            <!-- Content -->
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="800">
                <span class="text-primary fw-bold text-uppercase ls-2 d-block mb-2">
                    <i class="fas fa-award me-2"></i>Dlaczego My?
                </span>
                <h2 class="display-5 fw-bold mb-4">
                    Precision, Perfection, <span class="text-primary">Professional</span>
                </h2>
                <p class="text-white-50 lead mb-5">
                    Wybierając naszą firmę, decydujesz się na spokój i pewność, że prace zostaną wykonane 
                    zgodnie ze sztuką budowlaną.  Nie uznajemy kompromisów w kwestii jakości.
                </p>
                
                <!-- Features -->
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="feature-item d-flex align-items-start">
                            <div class="feature-icon bg-primary rounded-circle p-3 me-3 flex-shrink-0">
                                <i class="fas fa-medal text-white"></i>
                            </div>
                            <div>
                                <h5 class="text-white fw-bold mb-2">Wysoka Jakość</h5>
                                <p class="text-white-50 small mb-0">
                                    Używamy tylko sprawdzonych materiałów renomowanych producentów. 
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="feature-item d-flex align-items-start">
                            <div class="feature-icon bg-primary rounded-circle p-3 me-3 flex-shrink-0">
                                <i class="fas fa-user-clock text-white"></i>
                            </div>
                            <div>
                                <h5 class="text-white fw-bold mb-2">Terminowość</h5>
                                <p class="text-white-50 small mb-0">
                                    Szanujemy Twój czas.  Prace rozpoczynamy i kończymy zgodnie z umową.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="feature-item d-flex align-items-start">
                            <div class="feature-icon bg-primary rounded-circle p-3 me-3 flex-shrink-0">
                                <i class="fas fa-spray-can text-white"></i>
                            </div>
                            <div>
                                <h5 class="text-white fw-bold mb-2">Nowoczesny Sprzęt</h5>
                                <p class="text-white-50 small mb-0">
                                    Agregaty malarskie, szlifierki bezpyłowe - praca szybka i czysta.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="feature-item d-flex align-items-start">
                            <div class="feature-icon bg-primary rounded-circle p-3 me-3 flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h5 class="text-white fw-bold mb-2">Lokalna Firma</h5>
                                <p class="text-white-50 small mb-0">
                                    Trzebnica i okolice - szybki dojazd, znajomość lokalnego rynku.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Image -->
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1562259949-e8e7689d7828?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         alt="Malarz malujący ścianę na niebiesko - profesjonalne usługi malarskie Trzebnica" 
                         class="img-fluid rounded-4 shadow-lg">
                    
                    <!-- Floating card -->
                    <div class="position-absolute bottom-0 start-0 translate-middle-y ms-n4 bg-white rounded-3 shadow-lg p-4" 
                         style="max-width: 280px;" data-aos="fade-up" data-aos-delay="400">
                        <div class="d-flex align-items-center mb-3">
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="ms-2 fw-bold text-dark">5.0</span>
                        </div>
                        <p class="text-muted small mb-0">
                            "Świetna praca! Polecam każdemu szukającemu profesjonalnego malarza w Trzebnicy."
                        </p>
                        <p class="fw-bold text-dark small mt-2 mb-0">— Anna K., Trzebnica</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Counter Section with Parallax -->
<section class="py-5 position-relative overflow-hidden" id="stats">
    <div class="parallax-bg" style="background:  linear-gradient(135deg, rgba(13, 110, 253, 0.95) 0%, rgba(10, 88, 202, 0.95) 100%), url('https://images.unsplash.com/photo-1589939705384-5185137a7f0f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-attachment: fixed; background-size: cover; background-position: center;"></div>
    
    <div class="container py-5 position-relative">
        <div class="row text-center text-white g-4">
            <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="stat-item">
                    <div class="display-4 fw-bold mb-2 counter" data-target="150">0</div>
                    <div class="stat-icon mb-2">
                        <i class="fas fa-briefcase fa-2x opacity-50"></i>
                    </div>
                    <p class="mb-0 text-white-75 text-uppercase fw-bold small ls-2">Zrealizowanych Zleceń</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="stat-item">
                    <div class="display-4 fw-bold mb-2">100<span class="text-warning">%</span></div>
                    <div class="stat-icon mb-2">
                        <i class="fas fa-smile fa-2x opacity-50"></i>
                    </div>
                    <p class="mb-0 text-white-75 text-uppercase fw-bold small ls-2">Zadowolonych Klientów</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="300">
                <div class="stat-item">
                    <div class="display-4 fw-bold mb-2 counter" data-target="10">0</div>
                    <div class="stat-icon mb-2">
                        <i class="fas fa-calendar-alt fa-2x opacity-50"></i>
                    </div>
                    <p class="mb-0 text-white-75 text-uppercase fw-bold small ls-2">Lat Doświadczenia</p>
                </div>
            </div>
            <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="400">
                <div class="stat-item">
                    <div class="display-4 fw-bold mb-2">24<span class="text-warning">h</span></div>
                    <div class="stat-icon mb-2">
                        <i class="fas fa-clock fa-2x opacity-50"></i>
                    </div>
                    <p class="mb-0 text-white-75 text-uppercase fw-bold small ls-2">Szybka Wycena</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Preview Section -->
<section class="py-5 py-lg-6 bg-white" id="portfolio">
    <div class="container py-5">
        <!-- Section Header -->
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="text-primary fw-bold text-uppercase ls-2 d-block mb-2">
                <i class="fas fa-images me-2"></i>Nasze Realizacje
            </span>
            <h2 class="display-5 fw-bold mb-4">
                Zobacz Efekty <span class="text-primary">Naszej Pracy</span>
            </h2>
            <p class="text-muted lead mx-auto" style="max-width: 700px;">
                Galeria wybranych realizacji z Trzebnicy i okolic. Każdy projekt to dowód naszego profesjonalizmu 
                i dbałości o detale.
            </p>
        </div>
        
        <!-- Portfolio Grid -->
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="portfolio-item position-relative rounded-4 overflow-hidden shadow-sm">
                    <img src="https://images.unsplash.com/photo-1562663474-6cbb3eaa4d14?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         alt="Malowanie salonu w Trzebnicy - realizacja" 
                         class="img-fluid w-100" loading="lazy">
                    <div class="portfolio-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="text-center text-white p-4">
                            <h5 class="fw-bold mb-2">Malowanie Salonu</h5>
                            <p class="small mb-3 opacity-75">Trzebnica, ul. Słowackiego</p>
                            <a href="galeria.php" class="btn btn-outline-light btn-sm rounded-pill">
                                <i class="fas fa-eye me-1"></i> Zobacz więcej
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="portfolio-item position-relative rounded-4 overflow-hidden shadow-sm">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         alt="Kompleksowe wykończenie wnętrza - Trzebnica" 
                         class="img-fluid w-100" loading="lazy">
                    <div class="portfolio-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="text-center text-white p-4">
                            <h5 class="fw-bold mb-2">Wykończenie Wnętrza</h5>
                            <p class="small mb-3 opacity-75">Dom jednorodzinny</p>
                            <a href="galeria.php" class="btn btn-outline-light btn-sm rounded-pill">
                                <i class="fas fa-eye me-1"></i> Zobacz więcej
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="portfolio-item position-relative rounded-4 overflow-hidden shadow-sm">
                    <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         alt="Malowanie elewacji domu jednorodzinnego - Trzebnica" 
                         class="img-fluid w-100" loading="lazy">
                    <div class="portfolio-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="text-center text-white p-4">
                            <h5 class="fw-bold mb-2">Elewacja Domu</h5>
                            <p class="small mb-3 opacity-75">Oborniki Śląskie</p>
                            <a href="galeria.php" class="btn btn-outline-light btn-sm rounded-pill">
                                <i class="fas fa-eye me-1"></i> Zobacz więcej
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="portfolio-item position-relative rounded-4 overflow-hidden shadow-sm">
                    <img src="https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         alt="Wykończenie łazienki - glazura Trzebnica" 
                         class="img-fluid w-100" loading="lazy">
                    <div class="portfolio-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="text-center text-white p-4">
                            <h5 class="fw-bold mb-2">Łazienka</h5>
                            <p class="small mb-3 opacity-75">Glazura i malowanie</p>
                            <a href="galeria.php" class="btn btn-outline-light btn-sm rounded-pill">
                                <i class="fas fa-eye me-1"></i> Zobacz więcej
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="portfolio-item position-relative rounded-4 overflow-hidden shadow-sm">
                    <img src="https://images.unsplash.com/photo-1595846519845-68e298c2edd8?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         alt="Malowanie sypialni - eleganckie wykończenie" 
                         class="img-fluid w-100" loading="lazy">
                    <div class="portfolio-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="text-center text-white p-4">
                            <h5 class="fw-bold mb-2">Sypialnia</h5>
                            <p class="small mb-3 opacity-75">Eleganckie wykończenie</p>
                            <a href="galeria.php" class="btn btn-outline-light btn-sm rounded-pill">
                                <i class="fas fa-eye me-1"></i> Zobacz więcej
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="portfolio-item position-relative rounded-4 overflow-hidden shadow-sm">
                    <img src="https://images.unsplash.com/photo-1503387762-592deb58ef4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         alt="Sucha zabudowa GK - sufity podwieszane Trzebnica" 
                         class="img-fluid w-100" loading="lazy">
                    <div class="portfolio-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                        <div class="text-center text-white p-4">
                            <h5 class="fw-bold mb-2">Zabudowa GK</h5>
                            <p class="small mb-3 opacity-75">Sufit podwieszany z LED</p>
                            <a href="galeria.php" class="btn btn-outline-light btn-sm rounded-pill">
                                <i class="fas fa-eye me-1"></i> Zobacz więcej
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- CTA Button -->
        <div class="text-center mt-5" data-aos="fade-up">
            <a href="galeria.php" class="btn btn-primary btn-lg rounded-pill px-5 py-3 btn-hover-scale">
                <i class="fas fa-images me-2"></i>Zobacz Pełną Galerię
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-5 py-lg-6 bg-light" id="testimonials">
    <div class="container py-5">
        <!-- Section Header -->
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="text-primary fw-bold text-uppercase ls-2 d-block mb-2">
                <i class="fas fa-quote-left me-2"></i>Opinie Klientów
            </span>
            <h2 class="display-5 fw-bold mb-4">
                Co Mówią <span class="text-primary">Nasi Klienci</span>
            </h2>
        </div>
        
        <!-- Testimonials Grid -->
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-card bg-white rounded-4 shadow-sm p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-muted mb-4" style="font-style: italic;">
                        "Profesjonalna ekipa, terminowość i super efekt! Malowanie mieszkania przebiegło sprawnie, 
                        a ściany wyglądają idealnie. Polecam każdemu szukającemu malarza w Trzebnicy."
                    </p>
                    <div class="d-flex align-items-center">
                        <div class="testimonial-avatar bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 50px; height: 50px;">
                            <span class="fw-bold text-primary">AK</span>
                        </div>
                        <div class="ms-3">
                            <h6 class="fw-bold mb-0">Anna Kowalska</h6>
                            <small class="text-muted">Trzebnica</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-card bg-white rounded-4 shadow-sm p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-muted mb-4" style="font-style:  italic;">
                        "Zleciliśmy malowanie elewacji naszego domu.  Praca wykonana perfekcyjnie, 
                        z dbałością o każdy detal. Cena adekwatna do jakości.  Na pewno wrócimy!"
                    </p>
                    <div class="d-flex align-items-center">
                        <div class="testimonial-avatar bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 50px; height: 50px;">
                            <span class="fw-bold text-primary">MN</span>
                        </div>
                        <div class="ms-3">
                            <h6 class="fw-bold mb-0">Marek Nowak</h6>
                            <small class="text-muted">Oborniki Śląskie</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mx-auto" data-aos="fade-up" data-aos-delay="300">
                <div class="testimonial-card bg-white rounded-4 shadow-sm p-4 h-100">
                    <div class="d-flex align-items-center mb-3">
                        <div class="text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-muted mb-4" style="font-style: italic;">
                        "Szpachlowanie i malowanie całego mieszkania w zaledwie tydzień!  
                        Czysto, schludnie i profesjonalnie.  Gorąco polecam firmę Malarz Trzebnica."
                    </p>
                    <div class="d-flex align-items-center">
                        <div class="testimonial-avatar bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 50px; height: 50px;">
                            <span class="fw-bold text-primary">KW</span>
                        </div>
                        <div class="ms-3">
                            <h6 class="fw-bold mb-0">Katarzyna Wiśniewska</h6>
                            <small class="text-muted">Zawonia</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 py-lg-6 position-relative overflow-hidden" id="cta">
    <div class="cta-bg-gradient"></div>
    
    <div class="container py-5 position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center text-white" data-aos="zoom-in">
                <!-- Badge -->
                <div class="mb-4">
                    <span class="badge bg-white bg-opacity-20 text-white px-4 py-2 rounded-pill fs-6">
                        <i class="fas fa-phone-alt me-2"></i>Bezpłatna wycena
                    </span>
                </div>
                
                <h2 class="display-4 fw-bold mb-4">
                    Planujesz Remont w <span class="text-warning">Trzebnicy</span>?
                </h2>
                <p class="lead mb-5 opacity-90 mx-auto" style="max-width: 700px;">
                    Skontaktuj się z nami już dziś i otrzymaj bezpłatną wycenę.  Doradzimy w doborze 
                    materiałów i kolorów.  <strong>Zaufaj profesjonalistom z 10-letnim doświadczeniem. </strong>
                </p>
                
                <!-- CTA Buttons -->
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center mb-5">
                    <a href="tel:+48452690824" class="btn btn-light btn-lg text-primary fw-bold px-5 py-3 rounded-pill shadow btn-hover-scale">
                        <i class="fas fa-phone-alt me-2"></i>+48 452 690 824
                    </a>
                    <a href="kontakt.php" class="btn btn-outline-light btn-lg fw-bold px-5 py-3 rounded-pill btn-hover-scale">
                        <i class="fas fa-envelope me-2"></i>Napisz do nas
                    </a>
                </div>
                
                <!-- Trust badges -->
                <div class="d-flex flex-wrap justify-content-center gap-4 text-white-50 small">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-clock me-2"></i>
                        <span>Odpowiadamy w 24h</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <span>Trzebnica i okolice</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-shield-alt me-2"></i>
                        <span>Gwarancja jakości</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SEO Content Section -->
<section class="py-5 bg-white" id="seo-content">
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <article class="seo-article" data-aos="fade-up">
                    <h2 class="h3 fw-bold mb-4 text-center">
                        Profesjonalny Malarz Trzebnica – Twój Partner w Wykończeniach Wnętrz
                    </h2>
                    
                    <div class="row g-4">
                        <div class="col-md-6">
                            <p class="text-muted">
                                Szukasz <strong>profesjonalnego malarza w Trzebnicy</strong>?  Nasza firma od ponad 10 lat 
                                świadczy kompleksowe <strong>usługi malarskie</strong> na terenie Trzebnicy i okolicznych 
                                miejscowości. Specjalizujemy się w <strong>malowaniu wnętrz</strong> mieszkań, domów jednorodzinnych, 
                                biur oraz lokali użytkowych.
                            </p>
                            <p class="text-muted">
                                Oferujemy również <strong>malowanie elewacji</strong> budynków mieszkalnych i komercyjnych, 
                                stosując najwyższej jakości farby silikonowe i akrylowe. Nasze <strong>usługi malarskie w Trzebnicy</strong> 
                                wyróżniają się precyzją wykonania, terminowością oraz konkurencyjnymi cenami.
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted">
                                W ramach naszej oferty wykonujemy także <strong>szpachlowanie ścian</strong>, 
                                <strong>gładzie gipsowe</strong> oraz <strong>suchą zabudowę z płyt GK</strong> (sufity podwieszane, 
                                ścianki działowe). Dysponujemy <strong>profesjonalnym sprzętem</strong> – agregatami malarskimi, 
                                szlifierkami bezpyłowymi – co pozwala nam na szybką i czystą pracę.
                            </p>
                            <p class="text-muted">
                                Działamy na terenie <strong>Trzebnicy</strong>, <strong>Obornik Śląskich</strong>, 
                                <strong>Zawoni</strong>, <strong>Prusic</strong> oraz północnej części <strong>Wrocławia</strong>. 
                                Skontaktuj się z nami, aby otrzymać <strong>bezpłatną wycenę</strong>. 
                                Telefon: <a href="tel:+48452690824" class="text-primary fw-bold">+48 452 690 824</a>.
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<!-- Inline Styles for this page -->
<style>
/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, rgba(15, 23, 42, 0.9) 0%, rgba(15, 23, 42, 0.85) 100%), 
                url('https://images.unsplash.com/photo-1562259949-e8e7689d7828?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    min-height: 100vh;
}

.hero-slogan {
    letter-spacing: 3px;
    font-size:  0.9rem;
}

.text-gradient-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.text-white-75 {
    color: rgba(255, 255, 255, 0.75) !important;
}

.ls-2 { letter-spacing: 2px; }
.ls-3 { letter-spacing: 3px; }

. z-index-2 { z-index: 2; }

.hero-floating-image {
    animation: floating 6s ease-in-out infinite;
}

. hero-floating-card {
    animation: floating 4s ease-in-out infinite;
    animation-delay: 1s;
}

@keyframes floating {
    0%, 100% { transform: translateY(0); }
    50% { transform:  translateY(-15px); }
}

/* About Section */
.about-experience-badge {
    bottom: 30px;
    left: -30px;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(13, 110, 253, 0.4); }
    50% { box-shadow: 0 0 0 20px rgba(13, 110, 253, 0); }
}

/* Service Cards */
.service-card {
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    border: 1px solid rgba(0,0,0,0.05);
}

.service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important;
}

.service-card:hover .service-icon {
    background-color: var(--bs-primary) !important;
}

.service-card: hover .service-icon i {
    color: white !important;
}

. service-link {
    transition: all 0.3s ease;
}

.service-link:hover {
    letter-spacing: 1px;
}

/* Portfolio Items */
.portfolio-item {
    height: 280px;
}

.portfolio-item img {
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.portfolio-overlay {
    background: linear-gradient(135deg, rgba(13, 110, 253, 0.9) 0%, rgba(6, 58, 133, 0.95) 100%);
    opacity: 0;
    transition:  all 0.4s ease;
}

.portfolio-item:hover img {
    transform: scale(1.1);
}

.portfolio-item:hover .portfolio-overlay {
    opacity: 1;
}

/* Testimonial Cards */
.testimonial-card {
    transition: all 0.3s ease;
    border: 1px solid rgba(0,0,0,0.05);
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px