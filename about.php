<?php
require_once 'includes/gallery_functions.php';
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Über uns - SCD-Austria</title>
    <meta name="description" content="Lernen Sie SCD Austria kennen - unsere Geschichte, Mission und Team">
    <meta property="og:title" content="SCD Austria">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.scd-austria.com/">
    <meta property="og:image" content="https://i.postimg.cc/tgP1kDRW/hereinspaziert-traumf-nger.jpg">
    <meta property="og:image:alt" content="Welcome to SCD Austria">

    <link rel="icon" href="Site/logo.ico" sizes="any">
    <link rel="icon" href="Site/logo.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="Site/icon.png">

    <link rel="stylesheet" href="Site/css/normalize.css">
    <link rel="stylesheet" href="Site/css/skeleton.css">
    <link rel="stylesheet" href="css/variables.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="manifest" href="Site/site.webmanifest">
    <meta name="theme-color" content="#f5f1e3">

    <style>
        /* Base responsive styles */
        .content {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Hero section responsive */
        .hero-background {
            height: 60vh;
            min-height: 400px;
        }

        .hero-content {
            width: 90%;
            max-width: 800px;
            padding: 2rem;
        }

        /* About intro section responsive */
        .about-intro {
            padding: 4rem 0;
        }

        .content-box {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 3rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Team section responsive */
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            padding: 2rem 0;
        }

        .team-member {
            text-align: center;
        }

        .image-box {
            width: 100%;
            max-width: 300px;
            margin: 0 auto 1.5rem;
            padding-top: 2rem;
        }

        .team-image {
            width: 100%;
            height: auto;
            border-radius: 12px;
        }

        .contact-info {
            text-align: left;
            margin-top: 1.5rem;
        }

        /* Location section responsive */
        .map-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            margin: 2rem 0;
        }

        .map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .hero-background {
                height: 50vh;
            }

            .team-grid {
                gap: 2rem;
            }
        }

        @media (max-width: 768px) {
            .hero-background {
                height: 40vh;
                min-height: 300px;
            }

            .hero-content {
                padding: 1.5rem;
            }

            .hero-content h1 {
                font-size: 2rem;
            }

            .content-box {
                padding: 1.5rem;
            }

            .team-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .image-box {
                max-width: 250px;
            }
        }

        @media (max-width: 480px) {
            .hero-content h1 {
                font-size: 1.8rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .content-box {
                padding: 1.25rem;
                margin: 0 1rem 2rem;
            }

            .team-member {
                margin: 0 1rem;
            }
        }

        /* Qualification list responsive */
        .qualification-list {
            padding-left: 1.5rem;
        }

        @media (max-width: 768px) {
            .qualification-list {
                padding-left: 1.25rem;
            }
        }

        .extended-popup {
            position: fixed;
            top: var(--nav-height, 80px);
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            display: none;
            align-items: center;
            justify-content: center;
            width: 100vw;
            height: calc(100vh - var(--nav-height, 80px));
            margin: 0;
            padding: 0;
        }

        .extended-popup.active {
            display: flex !important;
        }

        .extended-popup-content {
            background: #fff;
            padding: 2rem 1.5rem 1.5rem 1.5rem;
            max-width: 1000px;
            width: 95vw;
            max-height: 90vh;
            overflow-y: auto;
            overflow-x: auto;
            position: relative;
            box-shadow: 0 8px 32px rgba(80,0,80,0.15);
            margin: 0 auto;
            border-radius: 12px;
        }
        .close-extended-btn {
            position: absolute;
            top: 18px;
            right: 18px;
            background: none;
            border: none;
            font-size: 2rem;
            color: #A04EDC;
            cursor: pointer;
            z-index: 2;
        }
        .show-extended-btn {
            margin-top: 1rem;
            background: var(--gradient-primary);
            color: #fff;
            border: none;
            padding: 0.5rem 1.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
            height: 2.5rem;
            min-height: 2.5rem;
        }
        .show-extended-btn:hover {
            background: var(--gradient-secondary);
        }

        body {
            position: relative;
            z-index: 1;
        }
    </style>
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
                <a href="gallery.php" class="link">Gallery<span class="bar"></span></a>
                <a href="future.html" class="link">Future<span class="bar"></span></a>
                <a href="about.html" class="link active">About<span class="bar"></span></a>
                <a href="kontakt.html" class="link">Kontakt<span class="bar"></span></a>
            </div>
        </div>
    </nav>

    <div id="shouldShow"></div>
    
    <div class="hero-background">
        <img src="Site/img/Team.jpg" alt="About Foto" class="hero-image">
        <div class="hero-content">
            <h1>Über uns</h1>
            <p>Lernen Sie uns und unsere Vision kennen</p>
        </div>
    </div>

    <main class="content" role="main" style="h5 { margin-bottom: 0.2em; } p { margin-bottom: 0.5em; }">
        <section class="about-intro">
            <div class="content-box" style="text-align: left;">
                <h2>Unsere Geschichte</h2>
                <p>Wir sind eine Gemeinschaft, gewachsen aus der Liebe zur Natur, dem Wissen unserer Vorfahren und dem Wunsch, mit Herz zu begleiten.</p>
                
                <p>Drei Werte stehen im Zentrum unseres Wirkens:</p>
                
                <ul>
                    <li>Inspiration aus der Natur. Wir nutzen die Kraft von Kräutern, Wasser, Wärme und Stille…</li>
                    
                    <li>Stärke der Gemeinschaft. Bei uns ist niemand allein – wir schaffen Raum für gegenseitige Unterstützung.</li>
                    
                    <li>Bewusstes Leben. Wir glauben, dass langsame Schritte und Achtsamkeit große Kraft haben.</li>
                </ul>
                
                <p>Wir schaffen Räume für Begegnungen, teilen Wissen über Heilpflanzen, nutzen die Heilkraft der Natur und das jahrhundertealte Wissen unserer Vorfahren.</p>
                
                <p>Mit Wärme und Tiefe begleiten wir Menschen auf ihrem Weg. Dies ist kein Servicezentrum, sondern ein Ort, an dem jeder seinen eigenen Weg zu Selbsterkenntnis, innerem Wachstum und Heilung finden kann.</p>
            </div>
        </section>

        <section class="team-section">
            <div class="content-box">
                <h2>Unser Team</h2>
                <div class="team-grid">
                <?php
                $mitgliederDir = __DIR__ . '/Site/mitglieder';
                foreach (new DirectoryIterator($mitgliederDir) as $member) {
                    if ($member->isDot() || !$member->isDir()) continue;
                    $infoPath = $member->getPathname() . '/info';
                    $imgPath = $member->getPathname() . '/picture.jpg';
                    $infoExtendedPath = $member->getPathname() . '/infoExtended';
                    if (!file_exists($infoPath)) continue;
                    $info = file($infoPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                    $infoExtended = file_exists($infoExtendedPath) ? file($infoExtendedPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];

                    $name = '';
                    $role = '';
                    $sections = [];
                    $currentSection = '';
                    foreach ($info as $line) {
                        if (preg_match('/^###(.+)/', $line, $m)) {
                            $name = trim($m[1]);
                        } elseif (preg_match('/^##(.+)/', $line, $m)) {
                            $role = trim($m[1]);
                        } elseif (preg_match('/^#([A-Za-zäöüÄÖÜß ]+)/u', $line, $m)) {
                            $currentSection = strtolower(trim($m[1]));
                            $sections[$currentSection] = [];
                        } elseif (preg_match('/^-/', $line)) {
                            $sections[$currentSection][] = ltrim($line, '- ');
                        } elseif ($currentSection) {
                            $sections[$currentSection][] = $line;
                        }
                    }
                    $imgWebPath = 'Site/mitglieder/' . $member->getFilename() . '/picture.jpg';
                    $popupId = 'popup_' . md5($member->getFilename());
                ?>
                    <div class="team-member">
                        <div class="image-box">
                            <img src="<?= htmlspecialchars($imgWebPath) ?>" alt="<?= htmlspecialchars($name) ?>" class="team-image">
                        </div>
                        <h3><?= htmlspecialchars($name) ?></h3>
                        <p class="role"><?= htmlspecialchars($role) ?></p>
                        <div class="contact-info">
                            <?php foreach ($sections as $section => $values): ?>
                                <?php if (empty($values)) continue; ?>
                                <?php if ($section === 'ausbildung' || $section === 'sprachen') { ?>
                                    <h5><?= ucfirst($section) ?></h5>
                                    <ul class="qualification-list">
                                        <?php foreach ($values as $v): ?>
                                            <li><?= htmlspecialchars($v) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php } else { ?>
                                    <h5><?= ucfirst($section) ?></h5>
                                    <p><?= implode('<br>', array_map('htmlspecialchars', $values)) ?></p>
                                <?php } ?>
                            <?php endforeach; ?>
                        </div>
                        <button class="show-extended-btn" onclick="openExtendedPopup('<?= $popupId ?>')">Mehr anzeigen</button>
                    </div>
                    <template id="template-<?= $popupId ?>">
                        <div class='extended-popup-content'>
                            <button class='close-extended-btn' onclick='closeExtendedPopup()'>&times;</button>
                            <?php
                            $extName = '';
                            $extRole = '';
                            $extSections = [];
                            $extCurrentSection = '';
                            foreach ($infoExtended as $line) {
                                if (preg_match('/^###(.+)/', $line, $m)) {
                                    $extName = trim($m[1]);
                                    echo '<h3>' . htmlspecialchars($extName) . '</h3>';
                                } elseif (preg_match('/^##(.+)/', $line, $m)) {
                                    $extRole = trim($m[1]);
                                    echo '<h4>' . htmlspecialchars($extRole) . '</h4>';
                                } elseif (preg_match('/^#([A-Za-zäöüÄÖÜß ]+)/u', $line, $m)) {
                                    $extCurrentSection = strtolower(trim($m[1]));
                                    echo '<h5>' . htmlspecialchars(ucfirst($extCurrentSection)) . '</h5>';
                                } elseif (preg_match('/^-/', $line)) {
                                    if (!isset($extSections[$extCurrentSection])) $extSections[$extCurrentSection] = [];
                                    $extSections[$extCurrentSection][] = ltrim($line, '- ');
                                } elseif ($extCurrentSection) {
                                    if (!isset($extSections[$extCurrentSection])) $extSections[$extCurrentSection] = [];
                                    $extSections[$extCurrentSection][] = $line;
                                }
                            }
                            // Listen ausgeben
                            foreach ($extSections as $section => $values) {
                                if (empty($values)) continue;
                                echo '<ul class="qualification-list">';
                                foreach ($values as $v) {
                                    echo '<li>' . htmlspecialchars($v) . '</li>';
                                }
                                echo '</ul>';
                            }
                            ?>
                        </div>
                    </template>
                <?php } ?>
                </div>
            </div>
        </section>

        <section class="location-section" id="map-section">
            <div class="content-box">
                <h2>Unser Standort</h2>
                <div class="map-notice">
                    <p>Diese Karte wird von Google Maps bereitgestellt. Mit dem Laden der Karte akzeptieren Sie die <a href="https://policies.google.com/privacy?hl=de&gl=at" target="_blank" rel="noopener">Datenschutzerklärung von Google</a>. Google verarbeitet Ihre Daten und verwendet Cookies, um die Kartenfunktionen bereitzustellen und Nutzungsstatistiken zu erfassen.</p>
                </div>
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2660.0876811669397!2d16.31624037685778!3d48.0550069713075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476da95d52b6153d%3A0x3a8c1c1d3df3f96!2sPhloxgasse%201A%2C%202353%20Guntramsdorf!5e0!3m2!1sde!2sat!4v1699568944359!5m2!1sde!2sat" 
                        width="100%" 
                        height="450" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <p>Besuchen Sie uns in der Phloxgasse 1A, 2353 Guntramsdorf</p>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="section-inner">
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
                        <li><a href="spenden.html">Spenden</a></li>
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

    <div class="extended-popup" id="global-extended-popup" style="display:none;">
    </div>
    <script src="js/app.js"></script>
    <script src="js/navbar.js"></script>
    <script>
    function openExtendedPopup(id) {
        var popup = document.getElementById('global-extended-popup');
        var template = document.getElementById('template-' + id);
        if (template && popup) {
            popup.innerHTML = template.innerHTML;
            popup.style.display = 'flex';
            popup.classList.add('active');
        }
    }
    function closeExtendedPopup() {
        var popup = document.getElementById('global-extended-popup');
        if (popup) {
            popup.style.display = 'none';
            popup.classList.remove('active');
            popup.innerHTML = '';
        }
    }
    // Optional: Schließen bei Klick auf den Hintergrund
    window.addEventListener('click', function(e) {
        var popup = document.getElementById('global-extended-popup');
        if (popup && popup.classList.contains('active') && e.target === popup) {
            closeExtendedPopup();
        }
    });
    </script>
</body>

</html>
