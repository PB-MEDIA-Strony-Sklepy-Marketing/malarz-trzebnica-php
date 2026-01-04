<!DOCTYPE html>
<html lang="pl">
<?php
    $page_title = 'Malarz Trzebnica - Profesjonalne Usługi Malarskie';
    include 'includes/header.php';
?>
<body>
    <!-- ======================= Custom-Cursor ======================= -->
    <div class="circle-cursor circle-cursor--inner"></div>
    <div class="circle-cursor circle-cursor--outer"></div>
    <!-- ======================= Preloader ======================= -->
    <div id="preloader">
        <div class="graf">
            <div class="text_pre">Ładowanie...</div>
            <div class="droplets">
                <div class="gota1"></div>
                <div class="gota2"></div>
            </div>
        </div>
    </div>
    <!-- ======================= All Section ======================= -->
    <div id="main-content">
        <!-- ======================= Header ======================= -->
        <header>
            <div class="header_containt d-flex justify-content-between">
                <a href="index.php" class="logo">
                    <img src="assets/image/svg/logo.svg" alt="logo">
                </a>
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <nav class="navbar_header">
                    <ul class="nav">
                        <li class="sidebar_logo">
                            <a href="index.php">
                                <img src="assets/image/svg/logo.svg" alt="logo">
                            </a>
                        </li>
                        <li><a href="index.php">Strona Główna</a></li>
                        <li><a href="oferta.php">Oferta</a></li>
                        <li><a href="galeria.php">Galeria</a></li>
                        <li><a href="kontakt.php">Kontakt</a></li>
                    </ul>
                    <div class="bubbles header_button">
                        <a href="kontakt.php" class="d-flex align-items-center">
                            <p class="text">Umów Wizytę</p>
                            <img src="assets/image/svg/buttonarrow.svg" alt="buttonarrow" class="button_img">
                        </a>
                    </div>
                </nav>
            </div>
        </header>
        <!-- ======================= Hero Section ======================= -->
        <section class="second_hero_section">
            <div class="swiper home_second_slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slide1">
                            <div class="container">
                                <div class="slider_content w-100">
                                    <p class="hero_pttx text-md-start text-center fade_up">Precision, Perfection, Professional</p>
                                    <h1 class="hero_main_txt text-md-start text-center fade_up">
                                        Profesjonalne usługi malarskie i wykończeniowe w Trzebnicy
                                    </h1>
                                    <div class="d-flex border_txt text-md-start text-center">
                                        <div class="border_hero"></div>
                                        <p class="hero_pttx1 fade_up">
                                            Tworzymy estetyczne, trwałe i funkcjonalne przestrzenie, które spełniają najwyższe standardy jakości.
                                        </p>
                                    </div>
                                    <div class="bubbles buttons1">
                                        <a href="oferta.php" class="align-items-center d-flex align-items-center">
                                            <p class="text">Nasza Oferta</p>
                                            <img src="assets/image/svg/buttonarrow.svg" alt="buttonarrow"
                                                class="button_img">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======================= Offer Section ======================= -->
        <section class="offer_section">
            <div class="container">
                <p class="offer_p text-md-start text-center fade_up">Co Oferujemy</p>
                <div class="d-flex flex-lg-row flex-column offer_head fade_up">
                    <h2 class="offer_h2 text-md-start text-center">Kompleksowe usługi malarskie – wnętrza i elewacje</h2>
                    <p class="offer_paragraph text-md-start text-center w-100">
                        Oferujemy malowanie mieszkań, domów, biur, klatek schodowych oraz lokali użytkowych. Dbamy o każdy detal – od dokładnego zabezpieczenia powierzchni, przez staranne przygotowanie podłoża, aż po perfekcyjne wykończenie.
                    </p>
                </div>
                <div class="offer_row mt-60">
                    <div
                        class="offer_box d-flex align-items-md-start align-items-center justify-content-center flex-column">
                        <img src="assets/image/svg/offer1.svg" alt="offer" class="flip_left">
                        <h3 class="offer_h3 text-md-start text-center w-100">Malowanie Wnętrz</h3>
                        <p class="offer_ptxt text-md-start text-center">
                            Malowanie ścian i sufitów farbami lateksowymi, akrylowymi i specjalistycznymi.
                        </p>
                        <a href="oferta.php">
                            <div class="read_more">
                                <div class="read_more_text">Czytaj więcej</div>
                                <div><img src="assets/image/svg/offer_arrow.svg" alt="offer_arrow"></div>
                            </div>
                        </a>
                    </div>
                    <div
                        class="offer_box d-flex align-items-md-start align-items-center justify-content-center flex-column mt-sm-0 mt-2">
                        <img src="assets/image/svg/offer2.svg" alt="offer" class="flip_left">
                        <h3 class="offer_h3 text-md-start text-center w-100">Malowanie Elewacji</h3>
                        <p class="offer_ptxt text-md-start text-center">
                            Malowanie elewacji budynków mieszkalnych i komercyjnych z ochroną przed warunkami atmosferycznymi.
                        </p>
                        <a href="oferta.php">
                            <div class="read_more">
                                <div class="read_more_text">Czytaj więcej</div>
                                <div><img src="assets/image/svg/offer_arrow.svg" alt="offer_arrow"></div>
                            </div>
                        </a>
                    </div>
                    <div
                        class="offer_box d-flex align-items-md-start align-items-center justify-content-center flex-column mt-lg-0 mt-md-3 mt-2">
                        <img src="assets/image/svg/offer3.svg" alt="offer" class="flip_left">
                        <h3 class="offer_h3 text-md-start text-center w-100">Szpachlowanie Ścian</h3>
                        <p class="offer_ptxt text-md-start text-center">
                            Wykonywanie gładzi gipsowych oraz niwelowanie nierówności dla idealnie gładkich ścian.
                        </p>
                        <a href="oferta.php">
                            <div class="read_more">
                                <div class="read_more_text">Czytaj więcej</div>
                                <div><img src="assets/image/svg/offer_arrow.svg" alt="offer_arrow"></div>
                            </div>
                        </a>
                    </div>
                    <div
                        class="offer_box d-flex align-items-md-start align-items-center justify-content-center flex-column mt-lg-0 mt-md-3 mt-2">
                        <img src="assets/image/svg/offer4.svg" alt="offer" class="flip_left">
                        <h3 class="offer_h3 text-md-start text-center w-100">Sucha Zabudowa GK</h3>
                        <p class="offer_ptxt text-md-start text-center">
                            Sufity podwieszane, ścianki działowe, zabudowy wnęk i poddaszy.
                        </p>
                        <a href="oferta.php">
                            <div class="read_more">
                                <div class="read_more_text">Czytaj więcej</div>
                                <div><img src="assets/image/svg/offer_arrow.svg" alt="offer_arrow"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======================= Choose Section ======================= -->
        <section class="chhose_section position-relative">
            <img src="assets/image/home/choose3.png" alt="choose" class="position-absolute choose_img1">
            <img src="assets/image/home/choose4.png" alt="choose" class="position-absolute choose_img2">
            <div class="choose_row position-relative d-flex flex-lg-row flex-column-reverse">
                <div>
                    <div class="img-mask">
                        <img src="assets/image/home/choose1.jpg" alt="choose1"
                            class="choose_img img-animation-style1 reveal w-100">
                    </div>
                    <p class="choose_p text-md-start text-center w-100">
                        Jesteśmy lokalną firmą z Trzebnicy, oferującą terminowość, rzetelność oraz indywidualne podejście do każdego zlecenia.
                    </p>
                </div>
                <div>
                    <p class="offer_p text-md-start text-center fade_up">DLACZEGO MY</p>
                    <h2 class="offer_h2 text-md-start text-center mt-2 fade_up">Co nas wyróżnia?</h2>
                    <h2 class="offer_h2 text-md-start text-center fade_up">Dlaczego warto wybrać naszą firmę?</h2>
                    <p class="choose_p2 text-md-start text-center w-100">
                        Pracujemy wyłącznie na profesjonalnym i nowoczesnym sprzęcie, wykorzystując sprawdzone technologie oraz wysokiej jakości materiały.
                    </p>
                    <div class="d-flex flex-xl-row flex-column choose_boxes">
                        <div class="choose_box d-flex flex-column align-items-md-start align-items-center w-100">
                            <img src="assets/image/svg/chooseimg1.svg" alt="chooseimg" class="flip_left choose_box_img">
                            <h3 class="choose_h3 fade_up text-md-start text-center">Profesjonalny Sprzęt</h3>
                            <p class="choose_box_ptxtx text-md-start text-center">
                                Gwarantujemy idealne krycie i równe powierzchnie dzięki nowoczesnym narzędziom.
                            </p>
                        </div>
                        <div class="choose_box d-flex flex-column align-items-md-start align-items-center w-100">
                            <img src="assets/image/svg/chooseimg2.svg" alt="chooseimg" class="flip_left choose_box_img">
                            <h3 class="choose_h3 fade_up text-md-start text-center">Jakość i Trwałość</h3>
                            <p class="choose_box_ptxtx text-md-start text-center">
                                Używamy wysokiej jakości materiałów, aby zapewnić trwały efekt na lata.
                            </p>
                        </div>
                    </div>
                    <img src="assets/image/home/choose2.jpg" alt="choose2"
                        class="choose2 img-animation-style2 reveal w-100">
                </div>
            </div>
        </section>
        <!-- ======================= Who Section ======================= -->
        <section class="offer_section">
            <div class="container">
                <div class="d-flex whor_row flex-lg-row flex-column">
                    <div class="who_img_section1">
                        <p class="offer_p text-md-start text-center fade_up">O NAS</p>
                        <h2 class="offer_h2 text-md-start text-center mt-2 fade_up">Doświadczony malarz – Trzebnica i okolice</h2>
                        <div class="d-flex border_txt1 text-md-start text-center fade_up">
                            <div class="border_hero1"></div>
                            <p class="who_ptxt text-md-start text-center">
                                Jeżeli szukasz sprawdzonego fachowca pod hasłem „malarz Trzebnica”, jesteś we właściwym miejscu.
                            </p>
                        </div>
                        <p class="who_ptxt1 text-md-start text-center w-100">
                            Posiadamy wieloletnie doświadczenie w realizacji prac malarskich i wykończeniowych – zarówno w nowych inwestycjach, jak i podczas remontów oraz odświeżania wnętrz.
                        </p>
                        <div class="d-flex flex-md-row flex-column align-items-center who_right fade_up mt-3">
                            <img src="assets/image/svg/who_img.svg" alt="who_img" class="flip_left">
                            <div>
                                <h3 class="who_h3 text-md-start text-center">Lokalna Firma</h3>
                                <p class="who_ptxt2 text-md-start text-center">
                                    Działamy lokalnie w Trzebnicy i okolicach, zapewniając szybki kontakt i realizację.
                                </p>
                            </div>
                        </div>
                        <div class="d-flex flex-md-row flex-column align-items-center who_right fade_up">
                            <img src="assets/image/svg/who_img.svg" alt="who_img" class="flip_left">
                            <div>
                                <h3 class="who_h3 text-md-start text-center">Kompleksowa Obsługa</h3>
                                <p class="who_ptxt2 text-md-start text-center">
                                    Od malowania po układanie podłóg i glazury - jeden wykonawca, pełen zakres usług.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="who_img_section">
                        <img src="assets/image/home/who1.jpg" alt="who1"
                            class="who1_img img-animation-style1 reveal w-100">
                        <div class="d-flex who_imgs align-items-center justify-content-between">
                            <img src="assets/image/home/who3.jpg" alt="who4" class="who4">
                            <div class="who_help d-flex align-items-center">
                                <div class="who_help_img d-flex align-items-center justify-content-center">
                                    <img src="assets/image/svg/whohelp.svg" alt="whohelp" class="whohelp">
                                </div>
                                <div>
                                    <h3 class="who_help_h3">POTRZEBUJESZ POMOCY?</h3>
                                    <a href="tel:48452690824">
                                        <p class="who_help_p">+48 452 690 824</p>
                                    </a>
                                </div>
                            </div>
                            <img src="assets/image/home/who4.jpg" alt="who4" class="who4">
                        </div>
                        <img src="assets/image/home/who2.jpg" alt="who1"
                            class="who2_img img-animation-style2 reveal w-100">
                    </div>
                </div>
            </div>
        </section>
        <!-- ======================= Meet Section ======================= -->
        <section class="meet_section">
            <div class="container">
                <div class="offer_section">
                    <div class="d-flex align-items-center justify-content-between flex-xxl-row flex-column">
                        <h2 class="meet_h2 text-xxl-start text-center  w-100 fade_up">
                            Umów się na spotkanie lub wyślij zapytanie
                        </h2>
                        <div class="meet_button d-flex flex-sm-row flex-column mt-xxl-0 mt-xl-5 mt-4">
                            <div>
                                <a href="kontakt.php">
                                    <div class="bubbles d-flex align-items-center">
                                        <p class="text">Darmowa Wycena</p>
                                        <img src="assets/image/svg/buttonarrow.svg" alt="buttonarrow"
                                            class="button_img">
                                    </div>
                                </a>
                            </div>
                            <div class="second_btn">
                                <a href="kontakt.php">
                                    <div class="bubbles1 d-flex align-items-center">
                                        <p class="text">Skontaktuj się</p>
                                        <img src="assets/image/svg/buttonarrow.svg" alt="buttonarrow"
                                            class="button_img">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======================= Work Section ======================= -->
        <section class="work_section">
            <p class="offer_p fade_up text-center">NASZE REALIZACJE</p>
            <h2 class="offer_h2 text-center fade_up mt-2">Ostatnio Zrealizowane Projekty</h2>
            <div class="work_slider swiper mt-60">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="galeria.php">
                            <div class="work_box">
                                <img src="assets/image/home/work1.jpg" alt="work"
                                    class="work_img img-animation-style1 reveal">
                                <div class="work_overlay">
                                    <h3 class="work_h3">Wnętrza</h3>
                                    <p class="work_ptxt">Malowanie</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="galeria.php">
                            <div class="work_box">
                                <img src="assets/image/home/work2.jpg" alt="work"
                                    class="work_img img-animation-style2 reveal">
                                <div class="work_overlay">
                                    <h3 class="work_h3">Elewacje</h3>
                                    <p class="work_ptxt">Malowanie</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="galeria.php">
                            <div class="work_box">
                                <img src="assets/image/home/work3.png" alt="work"
                                    class="work_img img-animation-style1 reveal">
                                <div class="work_overlay">
                                    <h3 class="work_h3">Pokoje Dziecięce</h3>
                                    <p class="work_ptxt">Malowanie</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a href="galeria.php">
                            <div class="work_box">
                                <img src="assets/image/home/work4.jpg" alt="work"
                                    class="work_img img-animation-style2 reveal">
                                <div class="work_overlay">
                                    <h3 class="work_h3">Lokale Użytkowe</h3>
                                    <p class="work_ptxt">Malowanie</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======================= Dream Section ======================= -->
        <section class="dream_section mt-100 position-relative">
            <img src="assets/image/home/itwork.png" alt="itwork" class="itwork_choose position-absolute">
            <div class="container">
                <div class="d-flex flex-lg-row flex-column-reverse dream_section_row">
                    <div class="d-flex w-100 align-items-end">
                        <img src="assets/image/home/dream.jpg" alt="dream" class="w-100 dream1">
                        <img src="assets/image/home/dream1.png" alt="dream1" class="dream2 d-flex">
                    </div>
                    <div class="dream_row w-100">
                        <p class="offer_p text-md-start text-center fade_up">Umów Wizytę</p>
                        <h2 class="offer_h2 text-md-start text-center mt-2 fade_up">Skontaktuj się – darmowa wycena usług malarskich</h2>
                        <p class="dream_pxtx text-md-start text-center pb-sm-0 pb-3">
                            Planujesz remont, wykończenie mieszkania lub odświeżenie elewacji? Skontaktuj się z nami i poznaj szczegóły oferty.
                        </p>
                        <div class="dream_form flex-sm-row flex-column d-flex">
                            <div class="deream_inp d-flex w-100">
                                <input type="text" name="name_painter" class="dream_input w-100 border-0"
                                    placeholder="Imię i Nazwisko">
                                <img src="assets/image/svg/dream_img1.svg" alt="dream_img1">
                            </div>
                            <div class="deream_inp d-flex w-100">
                                <input type="number" name="number" class="dream_input w-100 border-0"
                                    placeholder="Numer Telefonu">
                                <img src="assets/image/svg/dream_img2.svg" alt="dream_img1">
                            </div>
                        </div>
                        <div class="dream_form flex-sm-row flex-column d-flex">
                            <div class="deream_inp d-flex align-items-center w-100">
                                <input type="email" name="painter_email" class="dream_input w-100 border-0"
                                    placeholder="Adres Email">
                                <img src="assets/image/svg/dream_img3.svg" alt="dream_img1">
                            </div>
                            <div class="dream_inp deream_inp d-flex w-100 position-relative">
                                <input type="text" name="service" class="dream_input1 w-100 border-0"
                                    placeholder="Wybierz Usługę" readonly>
                                <img src="assets/image/svg/dream_img6.svg" alt="dream_img1" class="dropdown_icon">
                                <ul class="custom_dropdown list-unstyled">
                                    <li data-value="option1">Malowanie Wnętrz</li>
                                    <li data-value="option2">Malowanie Elewacji</li>
                                    <li data-value="option3">Szpachlowanie</li>
                                    <li data-value="option4">Inne</li>
                                </ul>
                            </div>
                        </div>
                        <div class="dream_form">
                            <textarea name="textarea" placeholder="Twoja Wiadomość" class="dream_txtarea"></textarea>
                        </div>
                        <div class="bubbles dream_button d-flex justify-content-center">
                            <a href="kontakt.php" class="d-flex align-items-center">
                                <p class="text">Wyślij Wiadomość</p>
                                <img src="assets/image/svg/buttonarrow.svg" alt="buttonarrow" class="button_img">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======================= Rolliamge Section ======================= -->
        <section class="rollimage_section expand-img-main image">
            <h2 class="d-none">roll image</h2>
            <img class="expand-img" src="assets/image/home/rollimage.jpg" alt="expand-img">
        </section>
        <!-- ======================= Start Footer ======================= -->
        <?php include 'includes/footer.php'; ?>
        <!-- ======================= End Footer ======================= -->
</body>
</html>