<?php
require_once 'includes/gallery_functions.php';
?>
<!doctype html>
<html class="no-js" lang="de">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galerie - SCD Austria | Eindrucksvolle Momente & Veranstaltungen</title>
    <meta name="description" content="Entdecken Sie unsere Galerie mit Eindrücken von Workshops, Events und Treffen bei SCD Austria. Erleben Sie die schönsten Momente unserer Gemeinschaft in Bildern.">
    
    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="Galerie - SCD Austria | Eindrucksvolle Momente">
    <meta property="og:description" content="Entdecken Sie unsere Bildergalerie mit den schönsten Momenten von SCD Austria Events, Workshops und Gemeinschaftstreffen.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.scd-austria.com/gallery.php">
    <meta property="og:image" content="<?php echo getRandomHeroImage(); ?>">
    <meta property="og:image:alt" content="SCD Austria Galerie Highlight">
    <meta property="og:site_name" content="SCD Austria">
    
    <!-- Additional SEO Meta Tags -->
    <meta name="keywords" content="SCD Austria, Galerie, Workshops, Events, Gemeinschaft, Bilder, Fotogalerie, Veranstaltungen, Treffen">
    <meta name="author" content="SCD Austria">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://www.scd-austria.com/gallery.php">

    <link rel="icon" href="Site/logo.ico" sizes="any">
    <link rel="icon" href="Site/logo.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="Site/icon.png">

    <link rel="stylesheet" href="Site/css/normalize.css">
    <link rel="stylesheet" href="Site/css/skeleton.css">
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/gallery.css">

    <link rel="manifest" href="Site/site.webmanifest">
    <meta name="theme-color" content="#f5f1e3">
</head>

<body>
    <nav class="navbar">
        <a href="index.html" class="logo-link">
            <img src="Site/img/Logo_Transparent.png" alt="SCD Austria Logo" class="nav-logo">
        </a>
        <button class="menu-toggle" type="button">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="section-inner">
            <div class="nav-links">
                <a href="index.html" class="link">Home<span class="bar"></span></a>
                <a href="events.html" class="link">Events<span class="bar"></span></a>
                <a href="gallery.php" class="link active">Gallery<span class="bar"></span></a>
                <a href="future.html" class="link">Future<span class="bar"></span></a>
                <a href="about.html" class="link">About<span class="bar"></span></a>
                <a href="kontakt.html" class="link">Kontakt<span class="bar"></span></a>
            </div>
        </div>
    </nav>

    <div class="hero-background">
        <img src="<?php echo getRandomHeroImage(); ?>" alt="Galerie Hero" class="hero-image">
        <div class="hero-content">
            <h1>Unsere Galerie</h1>
            <p>Entdecken Sie Eindrücke und Momente aus unseren Veranstaltungen und Aktivitäten.</p>
        </div>
    </div>

    <main class="content container" role="main">
        <?php
        // Render all galleries
        renderDynamicGalleries();
        ?>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="six columns footer-section">
                    <h5>Kontakt</h5>
                    <p>
                        Phloxgasse 1A<br>
                        2353 Guntramsdorf<br>
                        <a href="mailto:info@scd-austria.com">info@scd-austria.com</a><br>
                        +43 676 4989291<br>
                        +43 676 3495810
                    </p>
                </div>
                <div class="six columns footer-section">
                    <h5>Links</h5>
                    <ul class="footer-links">
                        <li><a href="events.html">Veranstaltungen</a></li>
                        <li><a href="gallery.php">Galerie</a></li>
                        <li><a href="datenschutz.html">Datenschutz</a></li>
                        <li><a href="impressum.html">Impressum</a></li>
                    </ul>
                    <div class="social-links">
                        <a href="https://www.instagram.com/scd.austria/" target="_blank">
                            <img src="Site/img/img.png" alt="Instagram">
                        </a>
                        <a href="https://www.facebook.com/share/1YFqZQfERd/" target="_blank" style="margin-left: 10px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <script>document.write(new Date().getFullYear());</script> SCD Austria. Alle Rechte vorbehalten.</p>
            </div>
        </div>
    </footer>

    <script src="js/app.js"></script>
    <script src="js/navbar.js"></script>
    <script src="js/gallery.js"></script>
</body>
</html> 