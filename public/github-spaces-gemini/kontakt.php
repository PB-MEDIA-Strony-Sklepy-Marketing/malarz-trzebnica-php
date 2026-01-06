<?php
// Konfiguracja meta tagów dla tej podstrony
$pageTitle = "Kontakt - Malarz Trzebnica | Darmowa Wycena +48 452 690 824";
$pageDescription = "Skontaktuj się z profesjonalnym malarzem w Trzebnicy. Szybka i darmowa wycena usług malarskich, szpachlowania i remontów. Tel: +48 452 690 824.";

include 'includes/header.php';
?>

<!-- Page Header -->
<header class="page-header position-relative" style="background: linear-gradient(rgba(15, 23, 42, 0.85), rgba(15, 23, 42, 0.8)), url('https://images.unsplash.com/photo-1557200134-90327ee9fafa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; padding: 120px 0 80px;">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-white mb-3" data-aos="fade-down">Kontakt</h1>
        <p class="lead text-white-50 mb-4">Precision, Perfection, Professional</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="index.php" class="text-white-50 text-decoration-none">Strona Główna</a></li>
                <li class="breadcrumb-item active text-primary" aria-current="page">Kontakt</li>
            </ol>
        </nav>
    </div>
</header>

<!-- Main Contact Section -->
<section class="py-5">
    <div class="container py-4">
        <div class="row g-5">
            <!-- Contact Info & Text -->
            <div class="col-lg-5" data-aos="fade-right">
                <span class="text-primary fw-bold text-uppercase ls-2">Rozpocznij współpracę</span>
                <h2 class="fw-bold mb-4">Skontaktuj się z nami – Malarz Trzebnica</h2>
                <p class="text-muted mb-4">
                    Szukasz sprawdzonej i rzetelnej firmy oferującej usługi malarskie w Trzebnicy? Jesteś w odpowiednim miejscu. 
                    Najwygodniejszą formą kontaktu jest rozmowa telefoniczna – pozwala ona szybko omówić zakres prac, termin realizacji oraz wstępne koszty.
                </p>

                <div class="d-flex flex-column gap-3 mb-5">
                    <!-- Phone Card -->
                    <div class="d-flex align-items-center p-3 rounded-3 shadow-sm bg-white border border-light contact-card">
                        <div class="flex-shrink-0 btn-lg-square bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fas fa-phone-alt fa-lg"></i>
                        </div>
                        <div class="ms-3">
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Telefon</small>
                            <h5 class="mb-0"><a href="tel:+48452690824" class="text-dark text-decoration-none stretched-link">+48 452 690 824</a></h5>
                        </div>
                    </div>

                    <!-- Email Card -->
                    <div class="d-flex align-items-center p-3 rounded-3 shadow-sm bg-white border border-light contact-card">
                        <div class="flex-shrink-0 btn-lg-square bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fas fa-envelope fa-lg"></i>
                        </div>
                        <div class="ms-3">
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Email</small>
                            <h5 class="mb-0"><a href="mailto:kontakt@malarz.trzebnica.pl" class="text-dark text-decoration-none stretched-link">kontakt@malarz.trzebnica.pl</a></h5>
                        </div>
                    </div>

                    <!-- Location Card -->
                    <div class="d-flex align-items-center p-3 rounded-3 shadow-sm bg-white border border-light contact-card">
                        <div class="flex-shrink-0 btn-lg-square bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fas fa-map-marker-alt fa-lg"></i>
                        </div>
                        <div class="ms-3">
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.75rem;">Obszar działania</small>
                            <h5 class="mb-0">Trzebnica i okolice</h5>
                        </div>
                    </div>
                </div>

                <div class="bg-light p-4 rounded-3 border-start border-primary border-5">
                    <h5 class="fw-bold mb-3">Lokalna firma – szybki dojazd</h5>
                    <p class="text-muted mb-0 small">
                        Działamy lokalnie, dzięki czemu możemy zagwarantowa�� szybki dojazd do klienta na terenie Trzebnicy i pobliskich miejscowości. 
                        Współpracując z nami, zyskujesz pewność terminowej realizacji.
                    </p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7" data-aos="fade-left">
                <div class="bg-white p-4 p-md-5 rounded-3 shadow-lg h-100 position-relative overflow-hidden">
                    <div class="position-absolute top-0 end-0 p-3 opacity-10">
                        <i class="fas fa-paint-roller fa-10x text-primary"></i>
                    </div>
                    
                    <h3 class="fw-bold mb-2">Formularz wyceny</h3>
                    <p class="text-muted mb-4">Opisz planowane prace (malowanie, szpachlowanie, GK), a my przygotujemy wstępną ofertę.</p>

                    <form action="kontakt.php" method="POST" class="needs-validation position-relative z-1" novalidate>
                        <!-- Honeypot field (hidden) -->
                        <div style="display:none;">
                            <label for="honeypot">Nie wypełniaj tego pola:</label>
                            <input type="text" id="honeypot" name="website_check">
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="imie" name="imie" placeholder="Jan Kowalski" required>
                                    <label for="imie">Imię i nazwisko</label>
                                    <div class="invalid-feedback">Proszę podać imię.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                                    <label for="email">Adres email</label>
                                    <div class="invalid-feedback">Proszę podać poprawny email.</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="telefon" name="telefon" placeholder="+48 000 000 000">
                                    <label for="telefon">Numer telefonu (opcjonalnie)</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select" id="temat" name="temat" aria-label="Temat zapytania">
                                        <option selected>Wycena ogólna</option>
                                        <option value="Malowanie wnętrz">Malowanie wnętrz</option>
                                        <option value="Malowanie elewacji">Malowanie elewacji</option>
                                        <option value="Szpachlowanie">Szpachlowanie / Gładzie</option>
                                        <option value="Zabudowa GK">Sucha zabudowa GK</option>
                                        <option value="Inne">Inne prace wykończeniowe</option>
                                    </select>
                                    <label for="temat">Rodzaj usługi</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Opisz zakres prac..." id="wiadomosc" name="wiadomosc" style="height: 150px" required></textarea>
                                    <label for="wiadomosc">Treść wiadomości</label>
                                    <div class="invalid-feedback">Proszę wpisać treść wiadomości.</div>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <div class="form-check text-muted small mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="rodo" required>
                                    <label class="form-check-label" for="rodo">
                                        Wyrażam zgodę na przetwarzanie moich danych osobowych w celu kontaktu zwrotnego.
                                    </label>
                                    <div class="invalid-feedback">Wymagana zgoda.</div>
                                </div>
                                
                                <button class="btn btn-primary w-100 py-3 fw-bold rounded-pill shadow-sm transition-hover" type="submit">
                                    <i class="fas fa-paper-plane me-2"></i> Wyślij zapytanie
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Google Map -->
<section class="map-section bg-light" data-aos="fade-up">
    <div class="container-fluid p-0">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20000!2d17.060!3d51.310!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470f8d9c57d57c3d%3A0x6a055110834e760!2sTrzebnica!5e0!3m2!1spl!2spl!4v1700000000000!5m2!1spl!2spl" 
                width="100%" height="450" style="border:0; filter: grayscale(20%) contrast(1.2);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-primary fw-bold text-uppercase">Współpraca</h6>
            <h2 class="fw-bold">Najczęściej zadawane pytania</h2>
            <p class="text-muted">Odpowiedzi na pytania, które często zadają nasi klienci.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
                <div class="accordion" id="faqAccordion">
                    
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Czy wycena usługi jest płatna?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Nie, każda wycena przygotowywana przez naszą firmę jest <strong>bezpłatna i niezobowiązująca</strong>. Wystarczy skontaktować się z nami telefonicznie lub przez formularz, aby umówić termin oględzin.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                W jakim rejonie świadczycie usługi?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Działamy głównie na terenie <strong>Trzebnicy i okolicznych miejscowości</strong> (do ok. 30 km). Obsługujemy również klientów z północnej części Wrocławia, Obornik Śląskich czy Zawoni.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Czy muszę kupić farby i materiały?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Oferujemy elastyczność. Możemy pracować na materiałach powierzonych przez klienta, ale również chętnie <strong>doradzamy i kupujemy sprawdzone materiały</strong> (farby, gładzie, grunty) w korzystnych cenach, zdejmując ten obowiązek z Twoich barków.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item border-0 shadow-sm">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Jak szybko możecie rozpocząć pracę?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Terminy zależą od aktualnego obłożenia kalendarza. Staramy się być elastyczni. W przypadku mniejszych zleceń (np. malowanie jednego pokoju) często jesteśmy w stanie znaleźć szybki termin. Najlepiej zadzwonić i zapytać o bieżącą dostępność: <strong>+48 452 690 824</strong>.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5 bg-dark text-white text-center">
    <div class="container" data-aos="zoom-in">
        <h2 class="fw-bold mb-3">Zadzwoń i umów termin</h2>
        <p class="lead mb-4 opacity-75">Dla nas Precision, Perfection, Professional to realne podejście do każdego projektu.</p>
        <a href="tel:+48452690824" class="btn btn-primary btn-lg fw-bold rounded-pill px-5 shadow-lg">
            <i class="fas fa-phone me-2"></i> +48 452 690 824
        </a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>