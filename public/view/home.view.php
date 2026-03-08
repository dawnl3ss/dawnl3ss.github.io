<?php
/** @var array $projects */
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Dawnl3ss :: Home </title>

        <!-- Meta Tags -->
        <meta property="og:title" content="Dawnless | .dawnl3ss">
        <meta property="og:description" content="Dawnl3ss website. Senior PHP Developer, Cybersecurity enthusiast and ctf player. Student @ EPITA.">
        <meta property="og:image" content="public/img/ogimage.jpg">
        <meta content="Dawnless" name="author">

        <link href="public/img/icon.jpg" rel="icon" type="image/png">

        <link href="public/css/variables.css" rel="stylesheet">
        <link href="public/css/base.css" rel="stylesheet">
        <link href="public/css/animations.css" rel="stylesheet">

        <link href="public/css/components/navbar.css" rel="stylesheet">
        <link href="public/css/components/hero.css" rel="stylesheet">
        <link href="public/css/components/about.css" rel="stylesheet">
        <link href="public/css/components/skills.css" rel="stylesheet">
        <link href="public/css/components/timeline.css" rel="stylesheet">
        <link href="public/css/components/projects.css" rel="stylesheet">
        <link href="public/css/components/hardware-hub.css" rel="stylesheet">
        <link href="public/css/components/footer.css" rel="stylesheet">


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Fira+Code:wght@300;400;500;600&display=swap" rel="stylesheet">
    </head>

    <body>
        <header class="header" id="header">
            <?php require_once 'public/view/components/nav.part.php'; ?>
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
                            <span class="fade-in-text">Dawnless (Neptune) - Alex' </span>
                        </div>
                        <div class="terminal-line">
                            <span class="prompt">$</span>
                            <span class="command typing-animation">cat about.txt</span>
                        </div>
                        <div class="terminal-line output">
                            <span class="fade-in-text"> Senior PHP & Full Stack Developer | Cybersecurity Enthusiast | <br> Student @ EPITA, Graduate School of Computer Engineering </span>
                        </div>
                        <div class="terminal-line">
                            <span class="prompt">$</span>
                            <span class="command typing-animation">./passions.sh</span>
                        </div>
                        <div class="terminal-line output">
                            <span class="fade-in-text"> Programming | Red team/Pentest | Travel | Sports </span>
                        </div>
                        <div class="terminal-line">
                            <span class="prompt">$</span>
                            <span class="cursor-blink">_</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-scroll">
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
                            <img src="public/img/ogimage.jpg" alt="Dawnl3ss Profile">
                            <div class="status-indicator"></div>
                        </div>
                    </div>

                    <div class="about-content" data-aos="fade-left">
                        <div class="info-card">
                            <div class="card-header">
                                <h3> Alexandre VOISIN </h3>
                                <span class="role"> Cybersecurity Enthusiast </span>
                            </div>

                            <div class="info-grid">
                                <div class="info-item">
                                    <i class="mdi mdi-account-group"></i>
                                    <div>
                                        <span class="label"> Usernames </span>
                                        <span class="value"> Dawnless, Neptune </span>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <i class="mdi mdi-calendar"></i>
                                    <div>
                                        <span class="label"> Age </span>
                                        <span class="value"> 20 years old </span>
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
                                        <span class="value"> EPITA Student </span>
                                    </div>
                                </div>
                            </div>

                            <div class="description">
                                <p> Senior PHP Developer & Architect with 5 years of experience, specializing in high-performance, secure, and maintainable PHP backends. </p>
                                <p> Full-Stack Developer when needed, building complete and secure applications is part of my daily work. </p>
                                <p> Passionate about cybersecurity and ethical hacking. Currently training for CPTS certification with HackTheBox Academy while pursuing engineering studies at EPITA. </p>
                            </div>

                            <div class="social-links">
                                <a href="https://www.linkedin.com/in/alexvsn/" target="_blank" class="social-link">
                                    <img class="applogo" src="public/img/linkedin.svg" alt="LI Logo">
                                    <span> LinkedIn </span>
                                </a>
                                <a href="https://github.com/dawnl3ss" target="_blank" class="social-link">
                                    <img class="applogo" src="public/img/github.svg" alt="GH Logo">
                                    <span> GitHub </span>
                                </a>
                                <a href="https://app.hackthebox.com/profile/1321357" target="_blank" class="social-link">
                                    <img class="applogo" src="public/img/hackthebox.svg" alt="HTB Logo">
                                    <span> HackTheBox </span>
                                </a>
                                <a href="https://tryhackme.com/p/dawnl3ss" target="_blank" class="social-link">
                                    <img class="applogo" src="public/img/tryhackme.svg" alt="THM Logo">
                                    <span> TryHackMe </span>
                                </a>


                            </div>
                            <br>
                            <div class="startup-links">

                                <a href="/resume/fr" target="_blank" class="startup-link secondary">
                                    <i class="mdi mdi-text"></i>
                                    <span> See my resume </span>
                                    <i class="mdi mdi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about section" id="writeups">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">
                    <span class="title-bracket">[</span>
                    Writeups &amp; Articles
                    <span class="title-bracket">]</span>
                </h2>

                <div class="wl-card" data-aos="fade-up">

                    <div class="wl-header">
                        <div>
                            <h3> CTF Writeups &amp; Technical Articles </h3>
                            <p> HackTheBox, TryHackMe, sécurité web, développement. </p>
                        </div>
                        <span class="wl-count"><span>11</span> writeups</span>
                    </div>

                    <div class="wl-list">

                        <a class="wl-item" target="_blank" href="/writeups/hackthebox/boardlight">
                            <div class="wl-icon ctf"><img src="https://labs.hackthebox.com/storage/avatars/7768afed979c9abe917b0c20df49ceb8.png"></div>
                            <div class="wl-body">
                                <div class="wl-title"> HTB - BoardLight </div>
                                <div class="wl-desc"> Dolibarr 17.0 default creds -> CVE-2023-30253 RCE -> SUID Enlightenment LPE -> root </div>
                            </div>
                            <div class="wl-right">
                                <span class="wl-platform"> HackTheBox </span>
                                <span class="wl-diff easy"> Easy </span>
                                <i class="mdi mdi-arrow-right wl-arrow"></i>
                            </div>
                        </a>

                        <a class="wl-item" target="_blank" href="/writeups/tryhackme/wonderland">
                            <div class="wl-icon ctf"><img src="https://tryhackme-images.s3.amazonaws.com/room-icons/fdba6eaf85513262b2a9b12875b0f342.jpeg"></i></div>
                            <div class="wl-body">
                                <div class="wl-title"> THM - Wonderland </div>
                                <div class="wl-desc"> FFUF recursive -> hidden SSH creds in source -> Python lib hijack -> PATH hijack -> Perl cap_setuid </div>
                            </div>
                            <div class="wl-right">
                                <span class="wl-platform"> TryHackMe </span>
                                <span class="wl-diff medium"> Medium </span>
                                <i class="mdi mdi-arrow-right wl-arrow"></i>
                            </div>
                        </a>

                        <a class="wl-item" target="_blank" href="/writeups/hackthebox/usage">
                            <div class="wl-icon ctf"><img src="https://labs.hackthebox.com/storage/avatars/23e804513a47e8f20bc865d0419946e1.png"></i></div>
                            <div class="wl-body">
                                <div class="wl-title"> HTB - Usage </div>
                                <div class="wl-desc"> SQLi password reset -> sqlmap -> file upload .php.jpg bypass -> 7za wildcard symlink -> root </div>
                            </div>
                            <div class="wl-right">
                                <span class="wl-platform"> HackTheBox </span>
                                <span class="wl-diff easy"> Easy </span>
                                <i class="mdi mdi-arrow-right wl-arrow"></i>
                            </div>
                        </a>

                        <a class="wl-item" target="_blank" href="/writeups/tryhackme/simple-ctf">
                            <div class="wl-icon ctf"><img src="https://tryhackme-images.s3.amazonaws.com/room-icons/f28ade2b51eb7aeeac91002d41f29c47.png"></i></div>
                            <div class="wl-body">
                                <div class="wl-title"> THM - Simple CTF </div>
                                <div class="wl-desc"> FTP anonymous -> ForMitch.txt -> Hydra SSH bruteforce -> vim GTFOBins -> root </div>
                            </div>
                            <div class="wl-right">
                                <span class="wl-platform"> TryHackMe </span>
                                <span class="wl-diff easy"> Easy </span>
                                <i class="mdi mdi-arrow-right wl-arrow"></i>
                            </div>
                        </a>

                        <a class="wl-item" target="_blank" href="/writeups/tryhackme/looking-glass">
                            <div class="wl-icon ctf"><img src="https://tryhackme-images.s3.amazonaws.com/room-icons/56215a135c08963843afda2240c317a3.png"></i></div>
                            <div class="wl-body">
                                <div class="wl-title"> THM - Looking Glass </div>
                                <div class="wl-desc"> SSH binary search -> Vigenère cipher -> cron @reboot injection -> reversed sudoers hostname </div>
                            </div>
                            <div class="wl-right">
                                <span class="wl-platform"> TryHackMe </span>
                                <span class="wl-diff medium"> Medium </span>
                                <i class="mdi mdi-arrow-right wl-arrow"></i>
                            </div>
                        </a>

                    </div>

                    <div class="startup-links">
                        <a href="/writeups" class="startup-link secondary">
                            <i class="mdi mdi-book-open-variant"></i>
                            <span> Voir tous les writeups </span>
                            <i class="mdi mdi-arrow-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </section>


        <section class="hardware-hub section" id="hardware-hub">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">
                    <span class="title-bracket">[</span>
                    Hardware Hub
                    <span class="title-bracket">]</span>
                </h2>

                <div class="startup-container">
                    <div class="startup-terminal" data-aos="fade-up">
                        <div class="terminal-header">
                            <div class="terminal-buttons">
                                <span class="btn-close"></span>
                                <span class="btn-minimize"></span>
                                <span class="btn-maximize"></span>
                            </div>
                            <div class="terminal-title">hardware-hub@startup:~$</div>
                        </div>
                        <div class="terminal-body">
                            <div class="terminal-line">
                                <span class="prompt">$</span>
                                <span class="command"> ./project-info.sh </span>
                            </div>
                            <div class="terminal-line output">
                                <span class="text-primary">Name: </span>Hardware Hub
                            </div>
                            <div class="terminal-line output">
                                <span class="text-primary"> Role:</span>Co-Founder Full Stack Developer
                            </div>
                            <div class="terminal-line output">
                                <span class="text-primary"> Status : </span><span class="status-active"> Opened </span>
                            </div>
                            <div class="terminal-line">
                                <span class="prompt">$</span>
                                <span class="cursor-blink">_</span>
                            </div>
                        </div>
                    </div>

                    <div class="startup-content" data-aos="fade-left">
                        <div class="startup-card">
                            <div class="card-header">
                                <h3> Config-Maker by Hardware Hub </h3>
                                <span class="badge-startup"> Main Project </span>
                            </div>

                            <div class="startup-description">
                                <p> We are transforming the way people build PCs with our innovative tool that helps users create their ideal setup at the best possible price. </p>
                                <p> Config-Maker features only carefully selected components, verified by our team and supported by trusted sources to guarantee quality and reliability. </p>
                                <p> Every part is thoroughly checked for compatibility, making Config-Maker one of the most dependable PC configuration platforms available. </p>
                            </div>

                            <div class="features-grid">
                                <div class="feature-item">
                                    <i class="mdi mdi-rocket-launch"></i>
                                    <h4> Beginner Mode </h4>
                                    <p> Simplified experience to quickly create the best quality configuration </p>
                                </div>
                                <div class="feature-item">
                                    <i class="mdi mdi-shield-check"></i>
                                    <h4> Validated Expertise </h4>
                                    <p> Components rigorously approved by our team </p>
                                </div>
                                <div class="feature-item">
                                    <i class="mdi mdi-currency-eur"></i>
                                    <h4> Best Prices </h4>
                                    <p> Automatic optimization for the best value for moneey </p>
                                </div>
                                <div class="feature-item">
                                    <i class="mdi mdi-lightning-bolt"></i>
                                    <h4> Fast & Efficient </h4>
                                    <p> Intuitive interface for configuration in just minutes </p>
                                </div>
                            </div>

                            <div class="startup-links">

                                <a href="https://hardware-hub.fr/configmaker/create" target="_blank" class="startup-link secondary">
                                    <i class="mdi mdi-desktop-classic"></i>
                                    <span> Config-Maker </span>
                                    <i class="mdi mdi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="hardware-hub section" id="aether-php">
            <div class="container">
                <h2 class="section-title" data-aos="fade-up">
                    <span class="title-bracket">[</span>
                    Æther Framework
                    <span class="title-bracket">]</span>
                </h2>

                <div class="startup-container">


                    <div class="startup-content" data-aos="fade-left">
                        <div class="startup-card">
                            <div class="card-header">
                                <h3> The divine PHP 8.3+ framework </h3>
                                <span class="badge-startup"> Main Project </span>
                            </div>

                            <div class="startup-description">
                                <p> Reclaim your freedom from bloated frameworks. Aether is a pure PHP 8.3+ framework engineered for speed, simplicity, and seamless integration. At under 1MB with zero dependencies, it's the perfect backend for modern frontend apps - React, Vue, Svelte, or vanilla JS. </p>
                                <p> Built with a fully OOP-oriented architecture, Aether is designed from day one to be dropped into any project without friction. It's not just lightweight and secure - it's your secret weapon for delivering high-performance freelance projects faster than ever. </p>

                            </div>

                            <div class="features-grid">
                                <div class="feature-item">
                                    <i class="mdi mdi-rocket-launch"></i>
                                    <h4> Blazing Performance </h4>
                                    <p> Boots in milliseconds, no overhead, pure PHP power. </p>
                                </div>

                                <div class="feature-item">
                                    <i class="mdi mdi-shield-check"></i>
                                    <h4> Ultra Secure </h4>
                                    <p> Secure-by-design framework that permits to build fast but secure backends </p>
                                </div>


                                <div class="feature-item">
                                    <i class="mdi mdi-bug"></i>
                                    <h4> No Bloat, Ever </h4>
                                    <p> Zero external dependencies - everything you need, nothing you don't. </p>
                                </div>

                                <div class="feature-item">
                                    <i class="mdi mdi-atom"></i>
                                    <h4> Freelance-Ready </h4>
                                    <p> Scalable, secure, and modular for real-world client missions. </p>
                                </div>
                            </div>


                            <div class="startup-links">
                                <a href="https://getaether.space" target="_blank" class="startup-link secondary">
                                    <i class="mdi mdi-code-block-braces"></i>
                                    <span> Get Aether </span>
                                    <i class="mdi mdi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="startup-terminal" data-aos="fade-up">
                        <div class="terminal-header">
                            <div class="terminal-buttons">
                                <span class="btn-close"></span>
                                <span class="btn-minimize"></span>
                                <span class="btn-maximize"></span>
                            </div>
                            <div class="terminal-title">aetherphp@framework:~$</div>
                        </div>
                        <div class="terminal-body">
                            <div class="terminal-line">
                                <span class="prompt">$</span>
                                <span class="command"> ./project-info.sh </span>
                            </div>
                            <div class="terminal-line output">
                                <span class="text-primary">Name: </span>Aether-PHP Framework
                            </div>
                            <div class="terminal-line output">
                                <span class="text-primary"> Role:</span>Creator, Architect, Developer
                            </div>
                            <div class="terminal-line output">
                                <span class="text-primary"> Status : </span><span class="status-active"> Released </span>
                            </div>
                            <div class="terminal-line">
                                <span class="prompt">$</span>
                                <span class="cursor-blink">_</span>
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
                                                    <div class="level-bar" data-level="90"></div>
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
                                                    <div class="level-bar" data-level="80"></div>
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
                                                            <i class="mdi mdi-database"></i>
                                                            databases (MySQL, MongoDB, PostgreSQL)
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

                                    <div class="folder-item" data-folder="cybersecurity">
                                        <span><i class="mdi mdi-folder-open"></i> devops/ </span>

                                        <div class="folder-content">
                                            <div class="file-item">
                                                        <span>
                                                            <i class="mdi mdi-monitor"></i>
                                                            ci/cd (Apache2, Nginx, Docker, Kubernetes)
                                                        </span>
                                                <div class="skill-level">
                                                    <div class="level-bar" data-level="75"></div>
                                                </div>
                                            </div>

                                            <div class="file-item">
                                                        <span>
                                                            <i class="mdi mdi-cached"></i>
                                                            cache (RAM, Redis, Memcached)
                                                        </span>
                                                <div class="skill-level">
                                                    <div class="level-bar" data-level="65"></div>
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
                            <p> Began coding at 11 with HTML/CSS and PHP, built my first website in 2017. Later explored JavaScript, Symfony, Laravel, React, jQuery and way more. </p>
                            <p> Discovered cybersecurity 2 years before the end of highschool, thus I learned and mastered Python, C, and C++. </p>
                        </div>
                    </div>
                    <div class="timeline-item" data-aos="fade-left">
                        <div class="timeline-marker">
                            <i class="mdi mdi-briefcase"></i>
                        </div>
                        <div class="timeline-content">
                            <h3 class="timeline-title"> Hardware Hub - Main Project </h3>
                            <span class="timeline-date"> 2022 - Present </span>
                            <p> Co-Founder (CTO) and Full Stack Developer of Hardware Hub. </p>
                            <p> Our smart tool helps you design the perfect setup at the best prices available. Whether you're a beginner or a pro, Config-Maker by Hardware Hub makes building your PC simple, optimized, and affordable. </p>
                            <p> -> <a target="_blank" href="https://hardware-hub.fr">https://hardware-hub.fr</a> </p>
                        </div>
                    </div>
                    <div class="timeline-item" data-aos="fade-right">
                        <div class="timeline-marker">
                            <i class="mdi mdi-school"></i>
                        </div>
                        <div class="timeline-content">
                            <h3 class="timeline-title"> HackTheBox </h3>
                            <span class="timeline-date"> 2023 - Present </span>
                            <p> I like to pursue the Certified Penetration Testing Specialist (CPTS) Job Role Path on HackTheBox Academy, coupled with a practical part on HackTheBox labs. </p>
                        </div>
                    </div>
                    <div class="timeline-item" data-aos="fade-left">
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
                                                <span class="tree-name">main/</span>
                                            </span>
                                            <ul id="websites-list">
                                                <?php foreach ($projects["main"] as $project) : ?>
                                                    <li class="tree-file">
                                                        <a href="<?= $project->_get_url(); ?>" class="tree-item project-link" target="_blank" style="transition: 0.2s;" style="transition: 0.2s;">
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
                                                <span class="tree-name">web/</span>
                                            </span>
                                            <ul id="websites-list">
                                                <?php foreach ($projects["web"] as $project) : ?>
                                                    <li class="tree-file">
                                                        <a href="<?= $project->_get_url(); ?>" class="tree-item project-link" target="_blank" style="transition: 0.2s;" style="transition: 0.2s;">
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
                                                <span class="tree-name">cybersecurity/</span>
                                            </span>
                                            <ul id="tools-list">
                                                <?php foreach ($projects["cybersecurity"] as $project) : ?>
                                                    <li class="tree-file">
                                                        <a href="<?= $project->_get_url(); ?>" class="tree-item project-link" target="_blank" style="transition: 0.2s;" style="transition: 0.2s;">
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
                                                <span class="tree-name">misc/</span>
                                            </span>
                                            <ul id="others-list">
                                                <?php foreach ($projects["misc"] as $project) : ?>
                                                    <li class="tree-file">
                                                        <a href="<?= $project->_get_url(); ?>" class="tree-item project-link" target="_blank" style="transition: 0.2s;" style="transition: 0.2s;">
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

        <?php require_once 'public/view/components/footer.part.php'; ?>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="public/js/main.js"></script>
        <script src="public/js/projects.js"></script>
        <script src="public/js/animations.js"></script>
    </body>
</html>