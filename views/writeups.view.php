<?php
/** @var $projects */
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Dawnl3ss :: Write UPs ! </title>

        <!-- Meta Tags -->
        <meta property="og:title" content="Dawnless | .dawnl3ss">
        <meta property="og:description" content="Dawnl3ss website. Here is the list of my writeups (SNIPPED of course). Feel free to learn from my mistakes and my progress.">
        <meta content="Dawnless" name="author">

        <link href="assets/img/icon.jpg" rel="icon" type="image/png">

        <link href="assets/css/variables.css" rel="stylesheet">
        <link href="assets/css/base.css" rel="stylesheet">
        <link href="assets/css/animations.css" rel="stylesheet">

        <link href="assets/css/components/navbar.css" rel="stylesheet">
        <link href="assets/css/components/writeups.css" rel="stylesheet">
        <link href="assets/css/components/footer.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Fira+Code:wght@300;400;500;600&display=swap" rel="stylesheet">
    </head>

    <body>
        <header class="header" id="header">
            <nav class="nav container">
                <a href="/" class="nav-logo">
                    <img src="assets/img/icon.jpg" alt="Dawnl3ss logo">
                </a>

                <div class="nav-menu" id="nav-menu">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a href="/" class="nav-link active">
                                <span> Home </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/writeups" class="nav-link">
                                <i class="mdi mdi-book-edit-outline"></i>
                                <span> WriteUPs </span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav-toggle" id="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </header>

        <section class="writeups-hero section">
            <div class="container">
                <div class="terminal-window" data-aos="fade-up">
                    <div class="terminal-header">
                        <div class="terminal-buttons">
                            <span class="btn-close"></span>
                            <span class="btn-minimize"></span>
                            <span class="btn-maximize"></span>
                        </div>
                        <div class="terminal-title">writeups@dawnl3ss:~$</div>
                    </div>
                    <div class="terminal-body">
                        <div class="terminal-line">
                            <span class="prompt">$</span>
                            <span class="command typing-animation"> cat /home/dawnl3ss/writeups.txt </span>
                        </div>
                        <div class="terminal-line output">
                            <span class="fade-in-text"> CTF Writeups Collection - Learning through practice 🚩 </span>
                        </div>
                        <div class="terminal-line">
                            <span class="prompt">$</span>
                            <span class="command typing-animation"> find / -name "*.flag" 2>/dev/null | head -n 1 </span>
                        </div>
                        <div class="terminal-line output">
                            <span class="fade-in-text"> [REDACTED] - All flags are snipped for learning purposes </span>
                        </div>
                        <div class="terminal-line">
                            <span class="prompt">$</span>
                            <span class="cursor-blink">_</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="writeups-filters section-small">
            <div class="container">
                <div class="filters-wrapper" data-aos="fade-up">
                    <div class="filter-group">
                        <button class="filter-btn active" data-filter="all">
                            <i class="mdi mdi-view-grid"></i>
                            <span> All Writeups </span>
                        </button>
                        <button class="filter-btn" data-filter="hackthebox" onclick="switch_page('hackthebox')">
                            <i class="mdi mdi-cube-outline"></i>
                            <span> HackTheBox </span>
                        </button>
                        <button class="filter-btn" data-filter="tryhackme" onclick="switch_page('tryhackme')">
                            <i class="mdi mdi-shield-outline"></i>
                            <span> TryHackMe </span>
                        </button>
                    </div>
                    <div class="search-wrapper">
                        <i class="mdi mdi-magnify"></i>
                        <input type="text" class="search-input" placeholder="Search writeups...">
                    </div>
                </div>
            </div>
        </section>

        <section class="writeups-content section">
            <div class="container">
                <div class="writeups-grid">

                    <?php foreach (Wrapper::_load_writeups() as $platform => $wts): ?>
                        <?php foreach ($wts as $name => $writeup): ?>
                            <article class="writeup-card" data-category="<?= $platform; ?>" data-aos="fade-up">
                                <div class="card-header">
                                    <div class="platform-badge <?= $platform; ?>">
                                        <i class="mdi mdi-cube-outline"></i>
                                        <span> <?= $platform; ?> </span>
                                    </div>
                                    <div class="difficulty-badge <?= $writeup["difficulty"]; ?>">
                                        <span> <?= $writeup["difficulty"]; ?> </span>
                                    </div>
                                </div>

                                <div class="card-thumbnail">
                                    <img src="<?= $writeup["thumb"]; ?>" alt="<?= $name; ?>">
                                    <div class="card-overlay">
                                        <i class="mdi mdi-book-open-variant"></i>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h3 class="card-title"> <?= $writeup["name"]; ?> </h3>
                                    <div class="card-meta">
                                        <span class="meta-item">
                                            <i class="mdi mdi-calendar"></i>
                                            <?= $writeup["release_date"]; ?>
                                        </span>
                                        <span class="meta-item">
                                            <i class="mdi mdi-clock-outline"></i>
                                            10 min read
                                        </span>
                                    </div>
                                    <p class="card-description">
                                        (description - pas encore implem)
                                    </p>
                                    <div class="card-tags">
                                        <?php foreach ($writeup["tags"] as $tag): ?>
                                            <span class="tag"> <?= $tag; ?> </span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <a href="<?= $writeup["link"]; ?>" class="card-link"></a>
                            </article>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="writeups-stats section-small">
            <div class="container">
                <div class="stats-grid" data-aos="fade-up">
                    <div class="stat-card">
                        <i class="mdi mdi-file-document-multiple"></i>
                        <div class="stat-value"><?= real_wtps_count(Wrapper::_load_writeups());?></div>
                        <div class="stat-label"> Total Writeups </div>
                    </div>
                    <div class="stat-card">
                        <i class="mdi mdi-cube-outline"></i>
                        <div class="stat-value"> <?= count(Wrapper::_load_writeups()["hackthebox"]); ?> </div>
                        <div class="stat-label"> HTB Machines </div>
                    </div>
                    <div class="stat-card">
                        <i class="mdi mdi-shield-outline"></i>
                        <div class="stat-value"> <?= count(Wrapper::_load_writeups()["tryhackme"]); ?> </div>
                        <div class="stat-label"> THM Rooms </div>
                    </div>

                </div>
            </div>
        </section>

        <?php require_once 'components/footer.part.php'; ?>

        <script>
            function switch_page(newpage){
                window.location.href = "/writeups/" + newpage;
            }

        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/writeups.js"></script>
        <script src="assets/js/animations.js"></script>
    </body>
</html>