<!DOCTYPE html>
<html lang="<?= $data->ISOLanguage ?>">
<head>
    <meta charset="utf-8">
    <title><?= $data->title ?></title>
    <link rel="stylesheet" href="<?= websrc('app-' . $data->BuildID . '.css') ?>">
</head>
<body>
    <div class="page-wrapper">
        <header class="component-navigation">
            <div class="wrap-content">
                <div class="grid no-margin">
                    <div class="col-1-3">
                        <img src="<?= websrc('img/logos/avior-white.png') ?>" alt="AVIOR LOGO" />
                    </div>
                    <div class="col-2-3">
                        <ul class="component-navigation-links">
                            <li>
                                <a href="#bio">Releases</a>
                            </li>
                            <li>
                                <a href="#bio">Biography</a>
                            </li>
                            <li>
                                <a href="#bio">Dates</a>
                            </li>
                            <li>
                                <a href="#bio">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <section class="component-section component-section--nofx component-section--nospace component-background-image">
                <div class="background-image" id="c-bi-teaser-image"></div>
            </section>
            <section class="component-section">
                <div class="wrap-content">
                    <div class="section-info">
                        <h3 class="section-title">Discography</h3>
                    </div>
                </div>
            </section>
            <section class="component-section component-tour-dates">
                <div class="wrap-content">
                    <div class="section-info">
                        <h3 class="section-title">Tour Dates</h3>
                    </div>
                    <div class="timeline-wrapper">
                        <div class="component-timeline">
                            <div class="timeline-item">
                                <span class="date-time">28th March 2015</span>
                                <h5>Tanzgestalten Debut</h5>
                                <p>Conrad Sohm, Dornbirn, Austria</p>
                            </div>
                            <div class="timeline-item">
                                <span class="date-time">1st November 2015</span>
                                <h5>Acoustic Waveforms</h5>
                                <p>Raumstation, St. Gallen, Switzerland</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <script src="<?= websrc('app-' . $data->BuildID . '.js') ?>"></script>
</body>
</html>
