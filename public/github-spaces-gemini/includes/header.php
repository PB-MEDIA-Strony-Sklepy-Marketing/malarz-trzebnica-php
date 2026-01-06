<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malarz Trzebnica - Profesjonalne Usługi Malarskie i Wykończeniowe</title>
    <meta name="description" content="Szukasz profesjonalnego malarza w Trzebnicy? Oferujemy kompleksowe malowanie wnętrz i elewacji, szpachlowanie, zabudowę GK oraz wykończenia pod klucz. Precision, Perfection, Professional. Zadzwoń: +48 452 690 824.">
    <meta name="keywords" content="malarz Trzebnica, usługi malarskie Trzebnica, malowanie ścian, szpachlowanie, remonty Trzebnica, wykończenia wnętrz, malowanie elewacji">
    <meta name="author" content="PB MEDIA">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.malarz.trzebnica.pl/">
    <meta property="og:title" content="Malarz Trzebnica - Profesjonalne Usługi Malarskie">
    <meta property="og:description" content="Precision, Perfection, Professional. Najlepsze usługi malarskie i wykończeniowe w Trzebnicy i okolicach. Darmowa wycena.">
    <meta property="og:image" content="assets/images/hero-bg.jpg">

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.min.css" integrity="sha512-2bBQCjcnw658Lho4nlXJcc6WkV/UxpE/sAokbXPxQNGqmNdQrWqtw26Ns9kFF/yG792pKR1Sx8/Y1Lf1XN4GKA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
</head>
<body>

<!-- Top Bar Contact Info -->
<div class="top-bar py-2 d-none d-lg-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-start">
                <span class="me-3"><i class="fas fa-phone-alt me-2"></i>+48 452 690 824</span>
                <span><i class="fas fa-envelope me-2"></i>kontakt@malarz.trzebnica.pl</span>
            </div>
            <div class="col-md-6 text-end social-icons-top">
                <a href="#" class="me-2"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
                <span><i class="fas fa-clock me-2 ms-3"></i>Pon - Pt: 8:00 - 18:00</span>
            </div>
        </div>
    </div>
</div>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <span class="text-primary-light">MALARZ</span> TRZEBNICA
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="index.php">Strona Główna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'oferta.php') ? 'active' : ''; ?>" href="oferta.php">Oferta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'galeria.php') ? 'active' : ''; ?>" href="galeria.php">Galeria</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'kontakt.php') ? 'active' : ''; ?>" href="kontakt.php">Kontakt</a>
                </li>
                <li class="nav-item d-lg-none mt-3">
                    <a href="tel:+48452690824" class="btn btn-primary w-100"><i class="fas fa-phone me-2"></i>Zadzwoń</a>
                </li>
                <li class="nav-item d-none d-lg-block ms-3">
                    <a href="kontakt.php" class="btn btn-outline-light btn-sm rounded-pill px-4">Darmowa Wycena</a>
                </li>
            </ul>
        </div>
    </div>
</nav>