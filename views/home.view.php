<?php
/** @var $projects */
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Dawnl3ss :: Home </title>

        <!-- Meta Tags -->
        <meta property="og:title" content="Dawnless | .dawnl3ss">
        <meta property="og:description" content="Dawnl3ss website. Cybersecurity enthusiast, ctf player and web-dev. Boot-to-Root enjoyer 💀">
        <meta content="Dawnless" name="author">

        <link href="assets/img/icon.jpg" rel="icon" type="image/png">

        <link href="assets/css/variables.css" rel="stylesheet">
        <link href="assets/css/base.css" rel="stylesheet">
        <link href="assets/css/animations.css" rel="stylesheet">

        <link href="assets/css/components/navbar.css" rel="stylesheet">
        <link href="assets/css/components/hero.css" rel="stylesheet">
        <link href="assets/css/components/about.css" rel="stylesheet">
        <link href="assets/css/components/skills.css" rel="stylesheet">
        <link href="assets/css/components/timeline.css" rel="stylesheet">
        <link href="assets/css/components/projects.css" rel="stylesheet">
        <link href="assets/css/components/footer.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Fira+Code:wght@300;400;500;600&display=swap" rel="stylesheet">
    </head>

    <body>
        <header class="header" id="header">
            <?php require_once 'components/nav.part.php'; ?>
        </header>

        <section class="hero section" id="home">
            <div class="hero-container container">
                <div class="hero-terminal">
                    <div class="terminal-header">
                        <div class="terminal-buttons">
                            <span class="btn-close"></span>
                            <span class="btn-minimize"></span>
                            <span class="btn-maximize"></span>
                        </div>
                        <div class="terminal-title">dawnl3ss@parrot-sec:~$</div>
                    </div>
                    <div class="terminal-body">
                        <div class="terminal-line">
                            <span class="prompt">$</span>
                            <span class="command typing-animation">whoami</span>
                        </div>
                        <div class="terminal-line output">
                            <span class="fade-in-text">Dawnless (.dawnl3ss) - Alex' </span>
                        </div>
                        <div class="terminal-line">
                            <span class="prompt">$</span>
                            <span class="command typing-animation">cat about.txt</span>
                        </div>
                        <div class="terminal-line output">
                            <span class="fade-in-text"> CTO & Senior Full Stack Web Developer | Cybersecurity enthusiast </span>
                        </div>
                        <div class="terminal-line">
                            <span class="prompt">$</span>
                            <span class="command typing-animation">./passion.sh</span>
                        </div>
                        <div class="terminal-line output">
                            <span class="fade-in-text"> Boot-to-root enjoyer 💀 | Red team aspirant | Travel | Sports </span>
                        </div>
                        <div class="terminal-line">
                            <span class="prompt">$</span>
                            <span class="cursor-blink">_</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-scroll">
                <span> Scroll to explore </span>
                <i class="mdi mdi-chevron-down"></i>
            </div>
        </section>


        <section class="about section" id="about">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">
                    <span class="title-bracket">[</span>
                    About Me
                    <span class="title-bracket">]</span>
                </h2>

                <div class="about-container">
                    <div class="about-image" data-aos="fade-right">
                        <div class="image-wrapper">
                            <img src="assets/img/ogimage.jpg" alt="Dawnl3ss Profile">
                            <div class="status-indicator"></div>
                        </div>
                    </div>

                    <div class="about-content" data-aos="fade-left">
                        <div class="info-card">
                            <div class="card-header">
                                <h3> Dawnless </h3>
                                <span class="role"> Cybersecurity Enthusiast </span>
                            </div>

                            <div class="info-grid">
                                <div class="info-item">
                                    <i class="mdi mdi-calendar"></i>
                                    <div>
                                        <span class="label"> Age </span>
                                        <span class="value"> 19 years old </span>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <i class="mdi mdi-map-marker"></i>
                                    <div>
                                        <span class="label"> Location </span>
                                        <span class="value"> Paris, France </span>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <i class="mdi mdi-school"></i>
                                    <div>
                                        <span class="label"> Education </span>
                                        <span class="value">EPITA Student</span>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <i class="mdi mdi-linux"></i>
                                    <div>
                                        <span class="label"> OS </span>
                                        <span class="value"> Parrot Security </span>
                                    </div>
                                </div>
                            </div>

                            <div class="description">
                                <p> Passionate about cybersecurity and ethical hacking. Currently training for CPTS certification while pursuing engineering studies at EPITA.</p>
                                <p> I love breaking things to understand how they work, solving CTF challenges, and building secure applications.</p>
                            </div>

                            <div class="social-links">
                                <a href="https://github.com/dawnl3ss" target="_blank" class="social-link">
                                    <img class="applogo" src="../assets/img/github.svg" alt="GH Logo">
                                    <span> GitHub </span>
                                </a>
                                <a href="https://app.hackthebox.com/profile/1321357" target="_blank" class="social-link">
                                    <img class="applogo" src="../assets/img/hackthebox.svg" alt="HTB Logo">
                                    <span> HackTheBox </span>
                                </a>
                                <a href="https://tryhackme.com/p/dawnl3ss" target="_blank" class="social-link">
                                    <img class="applogo" src="../assets/img/tryhackme.svg" alt="THM Logo">
                                    <span> TryHackMe </span>
                                </a>
                                <a href="https://www.root-me.org/dawnl3ss" target="_blank" class="social-link">
                                    <img class="applogo" src="../assets/img/rootme.svg" alt="RM Logo">
                                    <span> Root-Me </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="skills section" id="skills">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">
                    <span class="title-bracket">[</span>
                    Skills & Technologies
                    <span class="title-bracket">]</span>
                </h2>

                <div class="file-explorer" data-aos="fade-up">
                    <div class="explorer-header">
                        <div class="explorer-buttons">
                            <span class="btn-close"></span>
                            <span class="btn-minimize"></span>
                            <span class="btn-maximize"></span>
                        </div>
                        <div class="explorer-title"> Skills Directory </div>
                    </div>

                    <div class="explorer-body">
                        <div class="file-tree">
                            <div class="folder-item" data-folder="skills">
                                <span><i class="mdi mdi-folder"></i>skills/</span>

                                <div class="folder-content">
                                    <div class="folder-item" data-folder="cybersecurity">
                                        <span><i class="mdi mdi-folder-open"></i> cybersecurity/ </span>

                                        <div class="folder-content">
                                            <div class="file-item">
                                                <span>
                                                    <i class="mdi mdi-web"></i>
                                                    web_security (OWASP 10, Pentest API...)
                                                </span>
                                                <div class="skill-level">
                                                    <div class="level-bar" data-level="85"></div>
                                                </div>
                                            </div>
                                            <div class="file-item">
                                                <span>
                                                    <i class="mdi mdi-bug"></i>
                                                    reverse_engineering (IDA, Ghidra)
                                                </span>
                                                <div class="skill-level">
                                                    <div class="level-bar" data-level="60"></div>
                                                </div>
                                            </div>
                                            <div class="file-item">
                                                <span>
                                                    <i class="mdi mdi-linux"></i>
                                                    linux_security (Cron, SUID, Sudo...)
                                                </span>
                                                <div class="skill-level">
                                                    <div class="level-bar" data-level="90"></div>
                                                </div>
                                            </div>
                                            <div class="file-item">
                                                <span>
                                                    <i class="mdi mdi-microsoft-windows"></i>
                                                    active_directory (LDAP, Kerberos, NTLM, ACLs)
                                                </span>
                                                <div class="skill-level">
                                                    <div class="level-bar" data-level="75"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="folder-item" data-folder="development">
                                        <span><i class="mdi mdi-folder-open"></i> development/</span>

                                        <div class="folder-content">
                                            <div class="file-item">
                                                <span>
                                                    <i class="mdi mdi-language-html5"></i>
                                                    web_frontend (HTML, CSS, JS, JQuery, React)
                                                </span>
                                                <div class="skill-level">
                                                    <div class="level-bar" data-level="70"></div>
                                                </div>
                                            </div>
                                            <div class="file-item">
                                                <span>
                                                    <i class="mdi mdi-language-php"></i>
                                                    web_backend (PHP, Python, dotNet, Java, Node.js)
                                                </span>
                                                <div class="skill-level">
                                                    <div class="level-bar" data-level="90"></div>
                                                </div>
                                            </div>
                                            <div class="file-item">
                                                <span>
                                                    <i class="mdi mdi-language-python"></i>
                                                    software (C, C++, C#, Python, Java, Rust)
                                                </span>
                                                <div class="skill-level">
                                                    <div class="level-bar" data-level="85"></div>
                                                </div>
                                            </div>
                                            <div class="file-item">
                                                <span>
                                                    <i class="mdi mdi-powershell"></i>
                                                    scripting (Bash, Batch, PowerShell)
                                                </span>
                                                <div class="skill-level">
                                                    <div class="level-bar" data-level="75"></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="experience section" id="experience">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">
                    <span class="title-bracket"> [ </span>
                    Experience & Education
                    <span class="title-bracket"> ] </span>
                </h2>

                <div class="timeline" data-aos="fade-up">
                    <div class="timeline-item" data-aos="fade-right">
                        <div class="timeline-marker">
                            <i class="mdi mdi-school"></i>
                        </div>
                        <div class="timeline-content">
                            <h3 class="timeline-title"> High School </h3>
                            <span class="timeline-date"> 2016 - 2023 </span>
                            <p> Began coding at 11 with HTML/CSS, built my first site in 2017. Later explored PHP, JavaScript, Symfony, Laravel, React, and jQuery. </p>
                            <p> Discovered cybersecurity two years ago, learning Python, C, and C++. Passionate about pentesting & red teaming, currently active on HackTheBox. </p>
                        </div>
                    </div>
                    <div class="timeline-item" data-aos="fade-left">
                        <div class="timeline-marker">
                            <i class="mdi mdi-briefcase"></i>
                        </div>
                        <div class="timeline-content">
                            <h3 class="timeline-title"> Hardware Hub - Startup </h3>
                            <span class="timeline-date"> 2022 - Present </span>
                            <p> Co-Founder (CTO) and Web Full Stack Developer of Hardware Hub. </p>
                            <p> Our smart tool helps you design the perfect setup at the best prices available. Whether you’re a beginner or a pro, Config-Maker by Hardware Hub makes building your PC simple, optimized, and affordable. </p>
                            <p> -> <a target="_blank" href="https://hardware-hub.fr">https://hardware-hub.fr</a> </p>
                        </div>
                    </div>
                    <div class="timeline-item" data-aos="fade-right">
                        <div class="timeline-marker">
                            <i class="mdi mdi-school"></i>
                        </div>
                        <div class="timeline-content">
                            <h3 class="timeline-title"> EPITA - Master of Science </h3>
                            <span class="timeline-date"> 2023 - Present </span>
                            <p> Joined EPITA, a leading private IT engineering school in France, currently studying advanced mathematics, physics, and computer science. </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="projects section" id="projects">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">
                    <span class="title-bracket">[</span>
                    Projects
                    <span class="title-bracket">]</span>
                </h2>

                <div class="projects-terminal">
                    <div class="terminal-projects">
                        <div class="file-tree-dark">
                            <ul class="tree">
                                <li class="tree-folder">
                                        <span class="tree-item">
                                            <i class="mdi mdi-folder-sync"></i>
                                            <span class="tree-name">projects/</span>
                                        </span>
                                    <ul>
                                        <li class="tree-folder">
                                            <span class="tree-item">
                                                <i class="mdi mdi-folder-open"></i>
                                                <span class="tree-name">websites/</span>
                                            </span>
                                            <ul id="websites-list">
                                                <?php foreach ($projects["websites"] as $project) : ?>
                                                    <li class="tree-file">
                                                        <a href="/projects<?= $project->_get_route(); ?>" class="tree-item project-link" target="_blank" style="transition: 0.2s;" style="transition: 0.2s;">
                                                            <i class="mdi mdi-<?= $project->_get_icon(); ?>"></i>
                                                            <span class="tree-name"> <?= $project->_get_name(); ?> </span>
                                                            <span class="project-description"> - <?= $project->_get_description(); ?> </span>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <li class="tree-folder">
                                            <span class="tree-item">
                                                <i class="mdi mdi-folder-open"></i>
                                                <span class="tree-name">tools/</span>
                                            </span>
                                            <ul id="tools-list">
                                                <?php foreach ($projects["tools"] as $project) : ?>
                                                    <li class="tree-file">
                                                        <a href="/projects<?= $project->_get_route(); ?>" class="tree-item project-link" target="_blank" style="transition: 0.2s;" style="transition: 0.2s;">
                                                            <i class="mdi mdi-<?= $project->_get_icon(); ?>"></i>
                                                            <span class="tree-name"> <?= $project->_get_name(); ?> </span>
                                                            <span class="project-description"> - <?= $project->_get_description(); ?> </span>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                        <li class="tree-folder">
                                            <span class="tree-item">
                                                <i class="mdi mdi-folder-open"></i>
                                                <span class="tree-name">others/</span>
                                            </span>
                                            <ul id="others-list">
                                                <?php foreach ($projects["others"] as $project) : ?>
                                                    <li class="tree-file">
                                                        <a href="/projects<?= $project->_get_route(); ?>" class="tree-item project-link" target="_blank" style="transition: 0.2s;" style="transition: 0.2s;">
                                                            <i class="mdi mdi-<?= $project->_get_icon(); ?>"></i>
                                                            <span class="tree-name"> <?= $project->_get_name(); ?> </span>
                                                            <span class="project-description"> - <?= $project->_get_description(); ?> </span>
                                                        </a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php require_once 'components/footer.part.php'; ?>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/projects.js"></script>
        <script src="assets/js/animations.js"></script>
    </body>
</html>