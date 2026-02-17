<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;800;900&family=Rajdhani:wght@300;400;500;600&family=Share+Tech+Mono&display=swap');

  :root {
    --neon-cyan: #00f5ff;
    --neon-blue: #0066ff;
    --neon-purple: #7b2fff;
    --neon-pink: #ff00aa;
    --bg-deep: #020812;
    --bg-mid: #050f1f;
    --bg-card: rgba(0, 245, 255, 0.03);
    --glass: rgba(0, 245, 255, 0.06);
    --border-glow: rgba(0, 245, 255, 0.25);
    --text-main: #e0f4ff;
    --text-dim: #6a8fa8;
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  html { scroll-behavior: smooth; }

  body {
    background: var(--bg-deep);
    color: var(--text-main);
    font-family: 'Rajdhani', sans-serif;
    overflow-x: hidden;
    cursor: none;
  }

  /* Custom Cursor */
  .cursor {
    width: 12px; height: 12px;
    background: var(--neon-cyan);
    border-radius: 50%;
    position: fixed;
    top: 0; left: 0;
    pointer-events: none;
    z-index: 9999;
    transform: translate(-50%, -50%);
    transition: transform 0.1s ease;
    box-shadow: 0 0 15px var(--neon-cyan), 0 0 30px var(--neon-cyan);
  }
  .cursor-ring {
    width: 36px; height: 36px;
    border: 1px solid var(--neon-cyan);
    border-radius: 50%;
    position: fixed;
    top: 0; left: 0;
    pointer-events: none;
    z-index: 9998;
    transform: translate(-50%, -50%);
    transition: all 0.18s ease;
    opacity: 0.5;
  }

  /* Scanline overlay */
  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background: repeating-linear-gradient(
      0deg,
      transparent,
      transparent 2px,
      rgba(0, 245, 255, 0.012) 2px,
      rgba(0, 245, 255, 0.012) 4px
    );
    pointer-events: none;
    z-index: 9990;
    animation: scanMove 8s linear infinite;
  }
  @keyframes scanMove {
    0% { background-position: 0 0; }
    100% { background-position: 0 200px; }
  }

  /* Noise grain */
  body::after {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 9989;
    opacity: 0.3;
  }

  /* ============ NAVBAR (Bootstrap override — futuristic style) ============ */
  .navbar {
    border-bottom: 1px solid var(--border-glow) !important;
    backdrop-filter: blur(20px);
    background: linear-gradient(180deg, rgba(2,8,18,0.97) 0%, rgba(2,8,18,0.92) 100%) !important;
    transition: background 0.3s ease;
    padding: 0 1rem;
    height: 70px;
  }
  .navbar.scrolled {
    background: rgba(2,8,18,0.99) !important;
    box-shadow: 0 0 20px rgba(0,245,255,0.08);
  }
  .navbar-brand {
    font-family: 'Orbitron', monospace !important;
    font-size: 1.2rem !important;
    font-weight: 900 !important;
    color: var(--neon-cyan) !important;
    letter-spacing: 3px;
    text-shadow: 0 0 20px var(--neon-cyan);
  }
  .navbar-brand .bracket { color: var(--neon-purple); text-shadow: 0 0 20px var(--neon-purple); }
  .navbar-nav .nav-link {
    font-family: 'Share Tech Mono', monospace !important;
    font-size: 0.78rem !important;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--text-dim) !important;
    transition: color 0.3s;
    padding: 0.4rem 0.9rem !important;
  }
  .navbar-nav .nav-link:hover,
  .navbar-nav .nav-link.active { color: var(--neon-cyan) !important; }
  .navbar-toggler { border-color: var(--border-glow) !important; }
  .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0,245,255,0.85)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
  }
  .navbar-collapse { background: transparent; }
  .nav-cta-btn {
    font-family: 'Share Tech Mono', monospace !important;
    font-size: 0.75rem !important;
    letter-spacing: 2px;
    padding: 8px 20px !important;
    border: 1px solid var(--neon-cyan) !important;
    color: var(--neon-cyan) !important;
    text-transform: uppercase;
    position: relative;
    overflow: hidden;
    transition: all 0.3s !important;
  }
  .nav-cta-btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: var(--neon-cyan);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s ease;
  }
  .nav-cta-btn:hover { color: var(--bg-deep) !important; }
  .nav-cta-btn:hover::before { transform: scaleX(1); }
  .nav-cta-btn span { position: relative; z-index: 1; }

  /* ============ GRID BACKGROUND ============ */
  .grid-bg {
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 0;
    background-image:
      linear-gradient(rgba(0,245,255,0.04) 1px, transparent 1px),
      linear-gradient(90deg, rgba(0,245,255,0.04) 1px, transparent 1px);
    background-size: 60px 60px;
    animation: gridPulse 4s ease-in-out infinite alternate;
  }
  @keyframes gridPulse {
    0% { opacity: 0.5; }
    100% { opacity: 1; }
  }

  /* ============ HERO SECTION ============ */
  #home {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    padding: 70px 2rem 60px;
  }
  .hero-orbs {
    position: absolute;
    inset: 0;
    pointer-events: none;
    overflow: hidden;
  }
  .orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    animation: orbFloat 8s ease-in-out infinite;
  }
  .orb-1 { width: 600px; height: 600px; background: radial-gradient(circle, rgba(0,245,255,0.08) 0%, transparent 70%); top: -200px; left: -200px; animation-delay: 0s; }
  .orb-2 { width: 500px; height: 500px; background: radial-gradient(circle, rgba(123,47,255,0.1) 0%, transparent 70%); bottom: -150px; right: -100px; animation-delay: -4s; }
  .orb-3 { width: 300px; height: 300px; background: radial-gradient(circle, rgba(0,102,255,0.12) 0%, transparent 70%); top: 40%; left: 55%; animation-delay: -2s; }
  @keyframes orbFloat {
    0%, 100% { transform: translate(0, 0); }
    50% { transform: translate(30px, -30px); }
  }

  .hero-content {
    text-align: center;
    position: relative;
    z-index: 2;
    max-width: 900px;
  }
  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-family: 'Share Tech Mono', monospace;
    font-size: 0.72rem;
    letter-spacing: 3px;
    color: var(--neon-cyan);
    border: 1px solid rgba(0,245,255,0.3);
    padding: 7px 18px;
    margin-bottom: 2.5rem;
    background: rgba(0,245,255,0.05);
    animation: fadeInDown 0.8s ease both;
  }
  .hero-badge::before {
    content: '';
    width: 6px; height: 6px;
    background: var(--neon-cyan);
    border-radius: 50%;
    animation: blink 1.2s ease infinite;
  }
  @keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0; }
  }

  .hero-title {
    font-family: 'Orbitron', monospace;
    font-size: clamp(2.5rem, 6vw, 5.5rem);
    font-weight: 900;
    line-height: 1.05;
    letter-spacing: -1px;
    margin-bottom: 1.5rem;
    animation: fadeInUp 0.9s ease 0.2s both;
  }
  .hero-title .line-1 { display: block; color: var(--text-main); }
  .hero-title .line-2 {
    display: block;
    background: linear-gradient(135deg, var(--neon-cyan) 0%, var(--neon-blue) 50%, var(--neon-purple) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: none;
    filter: drop-shadow(0 0 40px rgba(0,245,255,0.4));
  }

  .hero-subtitle {
    font-size: 1.15rem;
    color: var(--text-dim);
    max-width: 600px;
    margin: 0 auto 3rem;
    line-height: 1.8;
    font-weight: 300;
    letter-spacing: 1px;
    animation: fadeInUp 0.9s ease 0.4s both;
  }

  .hero-btns {
    display: flex;
    gap: 1.2rem;
    justify-content: center;
    flex-wrap: wrap;
    animation: fadeInUp 0.9s ease 0.6s both;
  }

  .btn-primary-glow {
    font-family: 'Share Tech Mono', monospace;
    font-size: 0.8rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 15px 36px;
    background: linear-gradient(135deg, var(--neon-cyan), var(--neon-blue));
    color: var(--bg-deep);
    border: none;
    text-decoration: none;
    font-weight: 700;
    position: relative;
    overflow: hidden;
    transition: all 0.3s;
    box-shadow: 0 0 30px rgba(0,245,255,0.3), inset 0 1px 0 rgba(255,255,255,0.2);
  }
  .btn-primary-glow:hover {
    transform: translateY(-2px);
    box-shadow: 0 0 60px rgba(0,245,255,0.5), 0 10px 40px rgba(0,102,255,0.3);
    color: var(--bg-deep);
  }

  .btn-outline-glow {
    font-family: 'Share Tech Mono', monospace;
    font-size: 0.8rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 14px 36px;
    background: transparent;
    color: var(--text-main);
    border: 1px solid rgba(255,255,255,0.2);
    text-decoration: none;
    transition: all 0.3s;
  }
  .btn-outline-glow:hover {
    border-color: var(--neon-cyan);
    color: var(--neon-cyan);
    box-shadow: 0 0 20px rgba(0,245,255,0.15);
    transform: translateY(-2px);
  }

  /* Scrolling stats bar */
  .stats-bar {
    position: absolute;
    bottom: 0;
    left: 0; right: 0;
    display: flex;
    justify-content: center;
    gap: 0;
    border-top: 1px solid var(--border-glow);
    background: rgba(0,245,255,0.02);
    animation: fadeIn 1s ease 1s both;
  }
  .stat-item {
    padding: 20px 50px;
    text-align: center;
    border-right: 1px solid var(--border-glow);
    flex: 1;
    max-width: 200px;
  }
  .stat-item:last-child { border-right: none; }
  .stat-num {
    font-family: 'Orbitron', monospace;
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--neon-cyan);
    text-shadow: 0 0 20px rgba(0,245,255,0.5);
    display: block;
  }
  .stat-label {
    font-family: 'Share Tech Mono', monospace;
    font-size: 0.65rem;
    letter-spacing: 2px;
    color: var(--text-dim);
    text-transform: uppercase;
  }

  /* ============ SECTION STYLES ============ */
  .section-label {
    font-family: 'Share Tech Mono', monospace;
    font-size: 0.7rem;
    letter-spacing: 4px;
    color: var(--neon-cyan);
    text-transform: uppercase;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 12px;
  }
  .section-label::before, .section-label::after {
    content: '';
    height: 1px;
    width: 40px;
    background: linear-gradient(90deg, transparent, var(--neon-cyan));
  }
  .section-label::after {
    background: linear-gradient(270deg, transparent, var(--neon-cyan));
  }

  .section-title {
    font-family: 'Orbitron', monospace;
    font-size: clamp(1.8rem, 3.5vw, 2.8rem);
    font-weight: 800;
    letter-spacing: -0.5px;
    line-height: 1.2;
  }
  .section-title .accent {
    background: linear-gradient(135deg, var(--neon-cyan), var(--neon-purple));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  /* ============ ABOUT SECTION ============ */
  #about {
    padding: 120px 2rem;
    position: relative;
    z-index: 1;
  }
  .about-inner {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
  }
  .about-text .section-label { justify-content: flex-start; }
  .about-text .section-title { margin-bottom: 1.5rem; }
  .about-text p {
    color: var(--text-dim);
    line-height: 1.9;
    font-size: 1.05rem;
    margin-bottom: 1.2rem;
    font-weight: 300;
  }
  .about-text p strong { color: var(--neon-cyan); font-weight: 600; }

  .about-visual {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .hex-container {
    position: relative;
    width: 300px;
    height: 340px;
  }
  .hex-ring {
    position: absolute;
    inset: 0;
    border: 1px solid var(--border-glow);
    clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
    animation: hexSpin 12s linear infinite;
  }
  .hex-ring-2 {
    position: absolute;
    inset: 20px;
    border: 1px solid rgba(123,47,255,0.3);
    clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
    animation: hexSpin 8s linear infinite reverse;
  }
  .hex-core {
    position: absolute;
    inset: 50px;
    background: linear-gradient(135deg, rgba(0,245,255,0.1), rgba(123,47,255,0.1));
    clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .hex-icon {
    font-size: 3rem;
    filter: drop-shadow(0 0 20px var(--neon-cyan));
  }
  @keyframes hexSpin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  .about-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 2rem;
  }
  .tag {
    font-family: 'Share Tech Mono', monospace;
    font-size: 0.68rem;
    letter-spacing: 2px;
    padding: 6px 14px;
    border: 1px solid var(--border-glow);
    color: var(--neon-cyan);
    background: rgba(0,245,255,0.04);
    text-transform: uppercase;
    transition: all 0.3s;
  }
  .tag:hover {
    background: rgba(0,245,255,0.12);
    box-shadow: 0 0 15px rgba(0,245,255,0.15);
  }

  /* ============ SERVICES SECTION ============ */
  #services {
    padding: 120px 2rem;
    position: relative;
    z-index: 1;
    background: linear-gradient(180deg, transparent, rgba(0,245,255,0.02) 50%, transparent);
  }
  .services-inner { max-width: 1200px; margin: 0 auto; }
  .services-header { text-align: center; margin-bottom: 70px; }
  .services-header .section-label { justify-content: center; }
  .services-header p {
    color: var(--text-dim);
    font-size: 1.05rem;
    max-width: 550px;
    margin: 1.2rem auto 0;
    line-height: 1.8;
  }

  .services-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2px;
    background: var(--border-glow);
  }
  .service-card {
    background: var(--bg-mid);
    padding: 45px 35px;
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
    cursor: default;
  }
  .service-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(0,245,255,0.07) 0%, transparent 60%);
    opacity: 0;
    transition: opacity 0.4s;
  }
  .service-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, var(--neon-cyan), var(--neon-purple));
    transform: scaleX(0);
    transition: transform 0.4s ease;
  }
  .service-card:hover::before { opacity: 1; }
  .service-card:hover::after { transform: scaleX(1); }
  .service-card:hover { transform: translateY(-4px); }

  .service-number {
    font-family: 'Orbitron', monospace;
    font-size: 0.65rem;
    letter-spacing: 3px;
    color: var(--neon-purple);
    margin-bottom: 1.5rem;
    font-weight: 600;
  }
  .service-icon {
    font-size: 2.2rem;
    margin-bottom: 1.5rem;
    filter: drop-shadow(0 0 15px rgba(0,245,255,0.4));
    display: block;
    transition: transform 0.3s;
  }
  .service-card:hover .service-icon { transform: scale(1.1); }
  .service-title {
    font-family: 'Orbitron', monospace;
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: 1px;
    color: var(--text-main);
    margin-bottom: 1rem;
  }
  .service-desc {
    color: var(--text-dim);
    font-size: 0.9rem;
    line-height: 1.8;
    font-weight: 300;
  }
  .service-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-family: 'Share Tech Mono', monospace;
    font-size: 0.7rem;
    letter-spacing: 2px;
    color: var(--neon-cyan);
    text-decoration: none;
    margin-top: 1.8rem;
    text-transform: uppercase;
    opacity: 0;
    transform: translateX(-10px);
    transition: all 0.3s 0.1s;
  }
  .service-link::after { content: '→'; }
  .service-card:hover .service-link { opacity: 1; transform: translateX(0); }

  /* ============ PROCESS SECTION ============ */
  #process {
    padding: 120px 2rem;
    position: relative;
    z-index: 1;
  }
  .process-inner { max-width: 1100px; margin: 0 auto; }
  .process-header { text-align: center; margin-bottom: 80px; }
  .process-header .section-label { justify-content: center; }

  .process-timeline {
    display: flex;
    gap: 0;
    position: relative;
  }
  .process-timeline::before {
    content: '';
    position: absolute;
    top: 35px; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--border-glow) 20%, var(--border-glow) 80%, transparent);
  }
  .process-step {
    flex: 1;
    text-align: center;
    padding: 0 20px;
    position: relative;
  }
  .step-num-wrap {
    position: relative;
    display: inline-block;
    margin-bottom: 2rem;
  }
  .step-num {
    width: 70px; height: 70px;
    border: 1px solid var(--border-glow);
    background: var(--bg-mid);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Orbitron', monospace;
    font-size: 1.1rem;
    font-weight: 800;
    color: var(--neon-cyan);
    position: relative;
    z-index: 1;
    transition: all 0.3s;
  }
  .process-step:hover .step-num {
    background: linear-gradient(135deg, rgba(0,245,255,0.15), rgba(123,47,255,0.15));
    border-color: var(--neon-cyan);
    box-shadow: 0 0 30px rgba(0,245,255,0.25);
  }
  .step-title {
    font-family: 'Orbitron', monospace;
    font-size: 0.85rem;
    font-weight: 700;
    margin-bottom: 0.8rem;
    color: var(--text-main);
    letter-spacing: 1px;
  }
  .step-desc {
    color: var(--text-dim);
    font-size: 0.88rem;
    line-height: 1.7;
    font-weight: 300;
  }

  /* ============ CONTACT SECTION ============ */
  #contact {
    padding: 120px 2rem;
    position: relative;
    z-index: 1;
    background: linear-gradient(180deg, transparent, rgba(123,47,255,0.03) 50%, transparent);
  }
  .contact-inner {
    max-width: 1000px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1.3fr;
    gap: 80px;
    align-items: start;
  }
  .contact-info .section-label { justify-content: flex-start; }
  .contact-info p {
    color: var(--text-dim);
    font-size: 1rem;
    line-height: 1.8;
    margin: 1.5rem 0 2.5rem;
    font-weight: 300;
  }
  .contact-items { display: flex; flex-direction: column; gap: 15px; }
  .contact-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 16px 20px;
    border: 1px solid var(--border-glow);
    background: var(--glass);
    transition: all 0.3s;
  }
  .contact-item:hover {
    border-color: var(--neon-cyan);
    background: rgba(0,245,255,0.07);
    transform: translateX(5px);
  }
  .contact-item-icon {
    font-size: 1.2rem;
    filter: drop-shadow(0 0 8px var(--neon-cyan));
  }
  .contact-item-text { font-size: 0.9rem; color: var(--text-main); letter-spacing: 1px; }
  .contact-item-label {
    font-family: 'Share Tech Mono', monospace;
    font-size: 0.65rem;
    letter-spacing: 2px;
    color: var(--neon-cyan);
    text-transform: uppercase;
    display: block;
    margin-bottom: 3px;
  }

  /* Contact Form */
  .contact-form { display: flex; flex-direction: column; gap: 20px; }
  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
  .form-group { position: relative; }
  .form-label {
    font-family: 'Share Tech Mono', monospace;
    font-size: 0.65rem;
    letter-spacing: 2px;
    color: var(--text-dim);
    text-transform: uppercase;
    display: block;
    margin-bottom: 8px;
  }
  .form-input, .form-textarea {
    width: 100%;
    background: rgba(0,245,255,0.03);
    border: 1px solid var(--border-glow);
    padding: 14px 18px;
    color: var(--text-main);
    font-family: 'Rajdhani', sans-serif;
    font-size: 0.95rem;
    outline: none;
    transition: all 0.3s;
    resize: none;
  }
  .form-input::placeholder, .form-textarea::placeholder { color: rgba(106,143,168,0.5); }
  .form-input:focus, .form-textarea:focus {
    border-color: var(--neon-cyan);
    background: rgba(0,245,255,0.06);
    box-shadow: 0 0 20px rgba(0,245,255,0.1);
  }
  .form-textarea { height: 130px; }
  .btn-send {
    font-family: 'Share Tech Mono', monospace;
    font-size: 0.8rem;
    letter-spacing: 3px;
    text-transform: uppercase;
    padding: 16px 40px;
    background: transparent;
    border: 1px solid var(--neon-cyan);
    color: var(--neon-cyan);
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.3s;
    align-self: flex-start;
  }
  .btn-send::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, var(--neon-cyan), var(--neon-blue));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.35s ease;
  }
  .btn-send:hover { color: var(--bg-deep); box-shadow: 0 0 30px rgba(0,245,255,0.3); }
  .btn-send:hover::before { transform: scaleX(1); }
  .btn-send span { position: relative; z-index: 1; }

  /* ============ FOOTER ============ */
  footer {
    position: relative;
    z-index: 1;
    border-top: 1px solid var(--border-glow);
    padding: 0;
    background: var(--bg-deep);
  }
  .footer-inner {
    max-width: 1200px;
    margin: 0 auto;
    padding: 50px 2rem 30px;
  }
  .footer-top {
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1fr;
    gap: 50px;
    margin-bottom: 50px;
  }
  .footer-brand p {
    color: var(--text-dim);
    font-size: 0.88rem;
    line-height: 1.8;
    margin-top: 1rem;
    font-weight: 300;
  }
  .footer-col h4 {
    font-family: 'Share Tech Mono', monospace;
    font-size: 0.7rem;
    letter-spacing: 3px;
    color: var(--neon-cyan);
    text-transform: uppercase;
    margin-bottom: 1.2rem;
  }
  .footer-col ul { list-style: none; }
  .footer-col ul li { margin-bottom: 10px; }
  .footer-col ul a {
    color: var(--text-dim);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s;
    font-weight: 300;
  }
  .footer-col ul a:hover { color: var(--neon-cyan); }
  .footer-bottom {
    border-top: 1px solid var(--border-glow);
    padding-top: 25px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .footer-copy {
    font-family: 'Share Tech Mono', monospace;
    font-size: 0.7rem;
    letter-spacing: 2px;
    color: var(--text-dim);
  }
  .footer-copy span { color: var(--neon-cyan); }
  .footer-status {
    display: flex;
    align-items: center;
    gap: 8px;
    font-family: 'Share Tech Mono', monospace;
    font-size: 0.65rem;
    letter-spacing: 2px;
    color: #00ff88;
  }
  .footer-status::before {
    content: '';
    width: 6px; height: 6px;
    background: #00ff88;
    border-radius: 50%;
    animation: blink 1.5s ease infinite;
    box-shadow: 0 0 10px #00ff88;
  }
  .footer-logo {
    font-family: 'Orbitron', monospace;
    font-size: 1.1rem;
    font-weight: 900;
    color: var(--neon-cyan);
    text-decoration: none;
    letter-spacing: 3px;
    text-shadow: 0 0 20px var(--neon-cyan);
    display: inline-block;
    margin-bottom: 0.5rem;
  }

  /* ============ ANIMATIONS ============ */
  @keyframes fadeInDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
  @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
  @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

  /* Scroll reveal */
  .reveal {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .reveal.visible {
    opacity: 1;
    transform: translateY(0);
  }
  .reveal-delay-1 { transition-delay: 0.1s; }
  .reveal-delay-2 { transition-delay: 0.2s; }
  .reveal-delay-3 { transition-delay: 0.3s; }
  .reveal-delay-4 { transition-delay: 0.4s; }

  /* Responsive */
  @media (max-width: 900px) {
    .about-inner { grid-template-columns: 1fr; gap: 50px; }
    .services-grid { grid-template-columns: 1fr; }
    .contact-inner { grid-template-columns: 1fr; gap: 50px; }
    .process-timeline { flex-direction: column; gap: 30px; }
    .process-timeline::before { display: none; }
    .footer-top { grid-template-columns: 1fr 1fr; }
    .form-row { grid-template-columns: 1fr; }
    .stats-bar { flex-wrap: wrap; }
    .stat-item { max-width: none; }
  }
</style>

<!-- Custom Cursor -->
<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- Grid Background -->
<div class="grid-bg"></div>

<!-- ============ HERO ============ -->
<section id="home">
  <div class="hero-orbs">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
  </div>
  <div class="hero-content">
    <div class="hero-badge">NEXT-GEN WEB SOLUTIONS</div>
    <h1 class="hero-title">
      <span class="line-1">MEMBANGUN MASA DEPAN</span>
      <span class="line-2">DIGITAL ANDA</span>
    </h1>
    <p class="hero-subtitle">
      Kami merancang dan mengembangkan solusi web yang tidak hanya indah,
      tetapi juga cerdas dan berperforma tinggi — ditenagai oleh teknologi terdepan.
    </p>
    <div class="hero-btns">
      <a href="#services" class="btn-primary-glow">Jelajahi Layanan</a>
      <a href="#about" class="btn-outline-glow">Tentang Kami</a>
    </div>
  </div>
  <div class="stats-bar">
    <div class="stat-item">
      <span class="stat-num">200+</span>
      <span class="stat-label">Proyek Selesai</span>
    </div>
    <div class="stat-item">
      <span class="stat-num">98%</span>
      <span class="stat-label">Klien Puas</span>
    </div>
    <div class="stat-item">
      <span class="stat-num">5+</span>
      <span class="stat-label">Tahun Pengalaman</span>
    </div>
    <div class="stat-item">
      <span class="stat-num">24/7</span>
      <span class="stat-label">Support Aktif</span>
    </div>
  </div>
</section>

<!-- ============ ABOUT ============ -->
<section id="about">
  <div class="about-inner">
    <div class="about-text reveal">
      <div class="section-label">Tentang Kami</div>
      <h2 class="section-title">Solusi Digital <span class="accent">Masa Depan</span></h2>
      <p>Kami adalah tim pengembang dan desainer yang berdedikasi untuk menciptakan <strong>pengalaman digital yang luar biasa</strong>. Berdiri sejak 2018, kami telah membantu ratusan bisnis bertransformasi di era digital.</p>
      <p>Dengan pendekatan berbasis data dan teknologi terkini seperti <strong>CodeIgniter 4, React, Vue.js</strong>, serta arsitektur modern, kami memastikan setiap produk yang kami bangun tidak hanya estetis, tetapi juga skalabel dan aman.</p>
      <p>Misi kami sederhana: <strong>ubah visi Anda menjadi realita digital</strong> yang melampaui ekspektasi.</p>
      <div class="about-tags">
        <span class="tag">CodeIgniter 4</span>
        <span class="tag">React JS</span>
        <span class="tag">UI/UX Design</span>
        <span class="tag">REST API</span>
        <span class="tag">Cloud Infra</span>
        <span class="tag">SEO</span>
      </div>
    </div>
    <div class="about-visual reveal reveal-delay-2">
      <div class="hex-container">
        <div class="hex-ring"></div>
        <div class="hex-ring-2"></div>
        <div class="hex-core">
          <span class="hex-icon">⬡</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ SERVICES ============ -->
<section id="services">
  <div class="services-inner">
    <div class="services-header reveal">
      <div class="section-label">Layanan Kami</div>
      <h2 class="section-title">Apa yang Kami <span class="accent">Tawarkan</span></h2>
      <p>Dari konsep hingga peluncuran, kami menyediakan solusi menyeluruh yang dirancang khusus untuk kebutuhan bisnis Anda.</p>
    </div>
    <div class="services-grid">
      <div class="service-card reveal reveal-delay-1">
        <div class="service-number">01 / DEVELOPMENT</div>
        <span class="service-icon">💻</span>
        <h3 class="service-title">Web Development</h3>
        <p class="service-desc">Membangun aplikasi web yang cepat, aman, dan scalable menggunakan framework modern seperti CodeIgniter 4, Laravel, dan React JS.</p>
        <a href="#contact" class="service-link">Pelajari lebih lanjut</a>
      </div>
      <div class="service-card reveal reveal-delay-2">
        <div class="service-number">02 / DESIGN</div>
        <span class="service-icon">🎨</span>
        <h3 class="service-title">UI/UX Design</h3>
        <p class="service-desc">Desain antarmuka yang intuitif dan menarik, dengan riset mendalam tentang pengguna untuk menciptakan pengalaman yang berkesan.</p>
        <a href="#contact" class="service-link">Pelajari lebih lanjut</a>
      </div>
      <div class="service-card reveal reveal-delay-3">
        <div class="service-number">03 / BACKEND</div>
        <span class="service-icon">⚙️</span>
        <h3 class="service-title">API & Backend</h3>
        <p class="service-desc">Membangun REST API yang robust dan dokumentasi lengkap, mendukung integrasi dengan aplikasi mobile maupun sistem pihak ketiga.</p>
        <a href="#contact" class="service-link">Pelajari lebih lanjut</a>
      </div>
      <div class="service-card reveal reveal-delay-1">
        <div class="service-number">04 / CLOUD</div>
        <span class="service-icon">☁️</span>
        <h3 class="service-title">Cloud & Hosting</h3>
        <p class="service-desc">Infrastruktur cloud yang handal dengan uptime 99.9%, dilengkapi monitoring 24/7, backup otomatis, dan keamanan berlapis.</p>
        <a href="#contact" class="service-link">Pelajari lebih lanjut</a>
      </div>
      <div class="service-card reveal reveal-delay-2">
        <div class="service-number">05 / MOBILE</div>
        <span class="service-icon">📱</span>
        <h3 class="service-title">Mobile App</h3>
        <p class="service-desc">Pengembangan aplikasi mobile cross-platform dengan React Native dan Flutter untuk menjangkau pengguna Android dan iOS sekaligus.</p>
        <a href="#contact" class="service-link">Pelajari lebih lanjut</a>
      </div>
      <div class="service-card reveal reveal-delay-3">
        <div class="service-number">06 / SUPPORT</div>
        <span class="service-icon">🛡️</span>
        <h3 class="service-title">Maintenance</h3>
        <p class="service-desc">Layanan pemeliharaan dan pembaruan berkelanjutan memastikan website Anda tetap aman, cepat, dan selalu menggunakan teknologi terbaru.</p>
        <a href="#contact" class="service-link">Pelajari lebih lanjut</a>
      </div>
    </div>
  </div>
</section>

<!-- ============ PROCESS ============ -->
<section id="process">
  <div class="process-inner">
    <div class="process-header reveal">
      <div class="section-label">Cara Kerja Kami</div>
      <h2 class="section-title">Alur Kerja <span class="accent">Kami</span></h2>
    </div>
    <div class="process-timeline">
      <div class="process-step reveal reveal-delay-1">
        <div class="step-num-wrap"><div class="step-num">01</div></div>
        <h3 class="step-title">Konsultasi</h3>
        <p class="step-desc">Kami memahami kebutuhan bisnis Anda secara mendalam melalui sesi diskusi intensif.</p>
      </div>
      <div class="process-step reveal reveal-delay-2">
        <div class="step-num-wrap"><div class="step-num">02</div></div>
        <h3 class="step-title">Perencanaan</h3>
        <p class="step-desc">Tim kami merancang roadmap dan arsitektur teknis yang optimal untuk proyek Anda.</p>
      </div>
      <div class="process-step reveal reveal-delay-3">
        <div class="step-num-wrap"><div class="step-num">03</div></div>
        <h3 class="step-title">Desain</h3>
        <p class="step-desc">Wireframe dan prototype interaktif dibuat sebelum masuk ke fase pengembangan penuh.</p>
      </div>
      <div class="process-step reveal reveal-delay-4">
        <div class="step-num-wrap"><div class="step-num">04</div></div>
        <h3 class="step-title">Pengembangan</h3>
        <p class="step-desc">Kode ditulis dengan standar tinggi, dilengkapi unit test dan code review yang ketat.</p>
      </div>
      <div class="process-step reveal reveal-delay-4">
        <div class="step-num-wrap"><div class="step-num">05</div></div>
        <h3 class="step-title">Peluncuran</h3>
        <p class="step-desc">Deploy ke produksi dengan monitoring penuh dan dukungan pasca-peluncuran selama 30 hari.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ CONTACT ============ -->
<section id="contact">
  <div class="contact-inner">
    <div class="contact-info reveal">
      <div class="section-label">Hubungi Kami</div>
      <h2 class="section-title">Mulai <span class="accent">Proyek</span> Anda</h2>
      <p>Siap mengambil langkah pertama? Hubungi kami sekarang dan dapatkan konsultasi gratis untuk proyek digital Anda.</p>
      <div class="contact-items">
        <div class="contact-item">
          <span class="contact-item-icon">📧</span>
          <div>
            <span class="contact-item-label">Email</span>
            <span class="contact-item-text">admin@company.com</span>
          </div>
        </div>
        <div class="contact-item">
          <span class="contact-item-icon">📞</span>
          <div>
            <span class="contact-item-label">Telepon</span>
            <span class="contact-item-text">+62 812-3456-7890</span>
          </div>
        </div>
        <div class="contact-item">
          <span class="contact-item-icon">📍</span>
          <div>
            <span class="contact-item-label">Lokasi</span>
            <span class="contact-item-text">Jakarta Selatan, Indonesia</span>
          </div>
        </div>
      </div>
    </div>
    <div class="contact-form reveal reveal-delay-2">
      <div class="form-row">
        <div class="form-group">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" class="form-input" placeholder="John Doe">
        </div>
        <div class="form-group">
          <label class="form-label">Email</label>
          <input type="email" class="form-input" placeholder="john@email.com">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">Subjek</label>
        <input type="text" class="form-input" placeholder="Konsultasi Proyek Web">
      </div>
      <div class="form-group">
        <label class="form-label">Pesan</label>
        <textarea class="form-textarea" placeholder="Ceritakan tentang proyek Anda..."></textarea>
      </div>
      <button class="btn-send"><span>Kirim Pesan →</span></button>
    </div>
  </div>
</section>

<!-- ============ FOOTER ============ -->
<footer>
  <div class="footer-inner">
    <div class="footer-top">
      <div class="footer-brand">
        <a href="#home" class="footer-logo">[CI4]</a>
        <p>Kami membangun solusi digital yang inovatif dan berdampak nyata bagi bisnis Anda di era transformasi digital.</p>
      </div>
      <div class="footer-col">
        <h4>Navigasi</h4>
        <ul>
          <li><a href="#home">Home</a></li>
          <li><a href="#about">Tentang</a></li>
          <li><a href="#services">Layanan</a></li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Layanan</h4>
        <ul>
          <li><a href="#">Web Development</a></li>
          <li><a href="#">UI/UX Design</a></li>
          <li><a href="#">Mobile App</a></li>
          <li><a href="#">Cloud Hosting</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Sosial Media</h4>
        <ul>
          <li><a href="#">Instagram</a></li>
          <li><a href="#">LinkedIn</a></li>
          <li><a href="#">GitHub</a></li>
          <li><a href="#">Twitter / X</a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="footer-copy">
        &copy; <?= date('Y') ?> <span>My Landing Page</span> — All rights reserved
      </div>
      <div class="footer-status">SYSTEM ONLINE</div>
    </div>
  </div>
</footer>

<script>
  // Custom cursor
  const cursor = document.getElementById('cursor');
  const ring = document.getElementById('cursorRing');
  document.addEventListener('mousemove', e => {
    cursor.style.left = e.clientX + 'px';
    cursor.style.top = e.clientY + 'px';
    setTimeout(() => {
      ring.style.left = e.clientX + 'px';
      ring.style.top = e.clientY + 'px';
    }, 80);
  });
  document.querySelectorAll('a, button, .service-card').forEach(el => {
    el.addEventListener('mouseenter', () => {
      cursor.style.transform = 'translate(-50%,-50%) scale(2)';
      ring.style.transform = 'translate(-50%,-50%) scale(1.5)';
      ring.style.opacity = '1';
    });
    el.addEventListener('mouseleave', () => {
      cursor.style.transform = 'translate(-50%,-50%) scale(1)';
      ring.style.transform = 'translate(-50%,-50%) scale(1)';
      ring.style.opacity = '0.5';
    });
  });

  // Scroll reveal
  const reveals = document.querySelectorAll('.reveal');
  const observer = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        observer.unobserve(e.target);
      }
    });
  }, { threshold: 0.12 });
  reveals.forEach(el => observer.observe(el));

  // Animated counter for stats
  const counters = document.querySelectorAll('.stat-num');
  counters.forEach(counter => {
    const target = counter.innerText;
    const numMatch = target.match(/\d+/);
    if (!numMatch) return;
    const num = parseInt(numMatch[0]);
    const suffix = target.replace(/[\d.]/g, '');
    let start = 0;
    const step = num / 60;
    const timer = setInterval(() => {
      start += step;
      if (start >= num) { start = num; clearInterval(timer); }
      counter.innerText = Math.floor(start) + suffix;
    }, 20);
  });

  // Navbar scroll effect (Bootstrap navbar)
  window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar');
    if (!navbar) return;
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  });
</script>

<?= $this->endSection() ?>