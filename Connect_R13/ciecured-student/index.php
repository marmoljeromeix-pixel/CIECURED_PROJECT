<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CIEcured — Speak. Support. Stay Safe.</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css">
<link rel="stylesheet" href="assets/css/scenarios.css">
</head>
<body>

<header>
  <div class="wrap nav-inner">
    <a href="#top" class="logo" onclick="goHome(event,'top')">
      <span class="logo-mark">
        <img src="assets/img/logo.png" alt="CIEcured logo">
      </span>
      CIEcured
    </a>
    <nav class="links">
      <a href="#rights" data-page="home" class="active" onclick="goHome(event,'rights')" data-i18n="nav.rights">Know Your Rights</a>
      <a href="#" data-page="assess" onclick="showPage(event,'assess')" data-i18n="nav.assess">Assess Yourself</a>
      <a href="#" data-page="inbox" onclick="showPage(event,'inbox')" data-i18n="nav.inbox">Inbox</a>
    </nav>
    <div class="nav-actions">
      <button class="lang-toggle" onclick="toggleLanguage()" aria-label="Switch language">
        <span class="lang-option active" data-lang="en">EN</span>
        <span class="lang-option" data-lang="tl">TL</span>
      </button>
      <button class="btn btn-primary" onclick="goHome(event,'report')" data-i18n="nav.report">Report</button>
      <button class="mobile-toggle" aria-label="Menu" onclick="toggleMobileNav()">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#2E1F52" stroke-width="2" stroke-linecap="round"><line x1="4" y1="7" x2="20" y2="7"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="17" x2="20" y2="17"/></svg>
      </button>
    </div>
  </div>
  <div class="mobile-nav" id="mobileNav" hidden>
    <button class="lang-toggle" onclick="toggleLanguage()" aria-label="Switch language" style="align-self:flex-start; margin-bottom:8px;">
      <span class="lang-option active" data-lang="en">EN</span>
      <span class="lang-option" data-lang="tl">TL</span>
    </button>
    <a href="#rights" onclick="closeMobileNav(); goHome(event,'rights')" data-i18n="nav.rights">Know Your Rights</a>
    <a href="#" onclick="closeMobileNav(); showPage(event,'assess')" data-i18n="nav.assess">Assess Yourself</a>
    <a href="#" onclick="closeMobileNav(); showPage(event,'inbox')" data-i18n="nav.inbox">Inbox</a>
    <a href="#" onclick="closeMobileNav(); goHome(event,'report')" data-i18n="nav.report">Report</a>
  </div>
</header>

<main id="top" class="page">

  <!-- HERO -->
  <section class="hero">
    <div class="wrap hero-grid">
      <div>
        <span class="eyebrow"><span class="dot"></span><span data-i18n="hero.eyebrow">SAFE · CONFIDENTIAL · ACCOUNTABLE</span></span>
        <h1>Speak. Learn.<br><span class="accent">Stay Safe</span> — with CIEcured.</h1>
        <p class="sub" data-i18n="hero.sub">A safe and confidential space for CIE students to understand their rights, raise concerns, and take action—while staying in control of their story.  </p>
        <div class="hero-ctas">
          <button class="btn btn-hero" onclick="document.getElementById('report').scrollIntoView()" data-i18n="hero.reportnow">Report Now</button>
          <span class="hero-note">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L20 6V11C20 16 16.5 20 12 22C7.5 20 4 16 4 11V6L12 2Z"/></svg>
            <span data-i18n="hero.noaccount">No account needed to start</span>
          </span>
        </div>
        <div class="trust-row">
          <span><span class="pip"></span><span data-i18n="hero.trust1">Anonymous or named</span></span>
          <span><span class="pip"></span><span data-i18n="hero.trust2">Tamper-evident record</span></span>
          <span><span class="pip"></span><span data-i18n="hero.trust3">Audited access only</span></span>
        </div>
      </div>

      <div class="hero-visual">
        <div class="halo-rings">
          <div class="ring ring1"></div>
          <div class="ring ring2"></div>
          <div class="ring ring3"></div>
        </div>
        <div class="hero-card">
          <span class="tag" data-i18n="hero.cardtag">Before you start</span>
          <h3 data-i18n="hero.cardtitle">You're not alone in this</h3>
          <p data-i18n="hero.cardintro">Whatever brought you here, you're in control of what happens next.</p>
          <ul class="reassure-list">
            <li>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              <span data-i18n="hero.list1">Your identity stays in your control, always</span>
            </li>
            <li>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              <span data-i18n="hero.list2">Only trained, verified staff can review a case</span>
            </li>
            <li>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
              <span data-i18n="hero.list3">Go at your own pace — nothing is rushed</span>
            </li>
          </ul>
          <button class="btn btn-primary" onclick="goHome(event,'how')" data-i18n="hero.seehow">See how it works</button>
          <a class="track-link" href="#" onclick="showPage(event,'inbox')"><span data-i18n="hero.tracklink">Already reported? </span><b data-i18n="hero.tracklinkb">Track it with your TUP ID.</b></a>
        </div>
      </div>
    </div>
  </section>

<!-- ================= SCENARIO DIVIDER 1 — IN THE CLASSROOM ================= -->
<div class="scenario-divider">
  <div class="scenario-card">
    <article class="scenario-card-inner" tabindex="0" aria-expanded="false">
      <div class="scenario-row">
        <span class="scenario-visual" aria-hidden="true">
          <img src="assets/img/img_S1.jpg" alt="">
        </span>
        <div class="scenario-main">
          <span class="scenario-label"><span class="pip"></span><span class="label-text" data-i18n="scenario.s1.label">In the classroom</span></span>
          <h3 class="scenario-title" data-i18n="scenario.s1.title">What would you do if a classmate touched you without your consent?</h3>
          <p class="scenario-preview" data-i18n="scenario.s1.preview">During a classroom activity, a classmate keeps touching another student even though they've made it clear they're not comfortable with it. The student moves away, but it happens again, brushed off as "just a joke." They're left feeling uneasy and unsure whether to report it.</p>
        </div>
        <span class="scenario-indicator" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </span>
      </div>
            <div class="scenario-expand">
        <div class="scenario-expand-inner">
          <div class="scenario-expand-content">
            <p class="scenario-meaning" data-i18n="scenario.s1.meaning">The student can move away and reach out to someone they trust, such as a teacher or the GAD (Gender and Development) office. They can share what happened and report the behavior whenever they feel ready. Through GAD, they can receive support and guidance while their concern is handled respectfully and confidentially.</p>
            <div class="scenario-grid">
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M14.5 9.5L10 10l-.5 4.5L14 14l.5-4.5z"/></svg>
                  <strong data-i18n="chip.consider">Consider</strong>
                </div>
                <p>Move to a safer space if you're able to. What you do next is your call.</p>
              </div>
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                  <strong data-i18n="chip.reachout">Reach out</strong>
                </div>
                <p>A trusted friend, adviser, or counselor can help you think it through.</p>
              </div>
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22V4"/><path d="M4 4h11l-1.5 4L15 12H4"/></svg>
                  <strong data-i18n="chip.reporting">Reporting</strong>
                </div>
                <p>CIEcured takes anonymous or named reports, whenever you're ready.</p>
              </div>
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L20 6V11C20 16 16.5 20 12 22C7.5 20 4 16 4 11V6L12 2Z"/></svg>
                  <strong data-i18n="chip.safety">Safety first</strong>
                </div>
                <p>You never have to confront the person yourself.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>
  </div>
</div>


  <!-- SPEAK UP, SEEK SUPPORT -->
  <section class="awareness" id="ways">
    <div class="wrap">
      <div class="awareness-grid">
        <div class="awareness-copy">
          <span class="eyebrow" data-i18n="ways.eyebrow">📣 SPEAK UP, SEEK SUPPORT</span>
          <h2><span data-i18n="ways.title.a">Are you aware that there are Laws to </span><span class="accent" data-i18n="ways.title.b">help your case?</span></h2>
          <p data-i18n="ways.intro">You have the right to speak up and seek help. There are safe and appropriate channels available for you.</p>
          <a href="#rights" class="awareness-link" onclick="goHome(event,'rights')" data-i18n="ways.link">Know your rights first →</a>
        </div>

        <div class="ways-grid">
          <div class="way-card">
            <div class="way-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v4c0 5-3.5 8.5-7 10-3.5-1.5-7-5-7-10V6l7-3z"/><path d="M12 8v4"/><circle cx="12" cy="15" r=".5"/></svg>
            </div>
            <h3 data-i18n="ways.card1.title">In Person</h3>
            <p data-i18n="ways.card1.desc">Seek assistance from the appropriate university office or authorized personnel.</p>
          </div>
          <div class="way-card">
            <div class="way-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 21V9l8-5 8 5v12"/><path d="M9 21v-6h6v6"/><path d="M4 9h16"/></svg>
            </div>
            <h3 data-i18n="ways.card2.title">Through Official Channels</h3>
            <p data-i18n="ways.card2.desc">Use existing school reporting procedures and support services.</p>
          </div>
          <div class="way-card way-card-accent">
            <div class="way-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3" width="14" height="18" rx="3"/><path d="M9 7h6"/><rect x="10" y="15" width="4" height="4" rx=".5"/></svg>
            </div>
            <h3 data-i18n="ways.card3.title">Through CIEcured</h3>
            <p data-i18n="ways.card3.desc">Submit and securely follow up on your report through our confidential platform.</p>
            <button class="btn btn-primary way-btn" onclick="goHome(event,'report')" data-i18n="ways.card3.btn">Start a report</button>
          </div>
        </div>
      </div>

     
    </div>
  </section>

<!-- ================= SCENARIO DIVIDER 2 — WITHIN THE FACULTY ================= -->
<div class="scenario-divider">
  <div class="scenario-card">
    <article class="scenario-card-inner" tabindex="0" aria-expanded="false">
      <div class="scenario-row">
        <span class="scenario-visual" aria-hidden="true">
          <img src="assets/img/img_S2.jpg" alt="">
        </span>
        <div class="scenario-main">
          <span class="scenario-label"><span class="pip"></span><span class="label-text" data-i18n="scenario.s2.label">Within the faculty</span></span>
          <h3 class="scenario-title" data-i18n="scenario.s2.title">What would you do if a professor crossed a personal boundary?</h3>
          <p class="scenario-preview" data-i18n="scenario.s2.preview">A position of authority should never be used to pressure or intimidate a student.</p>
        </div>
        <span class="scenario-indicator" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </span>
      </div>
      <div class="scenario-expand">
        <div class="scenario-expand-inner">
          <div class="scenario-expand-content">
            <p class="scenario-meaning" data-i18n="scenario.s2.meaning">Unwanted comments, messages, or pressure from someone who holds power over your academic standing is a misuse of that authority, not a normal part of mentorship. That imbalance can make refusing or reporting feel risky, especially when grades or opportunities are on the line — and that hesitation is a reasonable response to a real risk, not a sign the concern isn't valid.</p>
            <div class="scenario-grid">
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M14.5 9.5L10 10l-.5 4.5L14 14l.5-4.5z"/></svg>
                  <strong data-i18n="chip.consider">Consider</strong>
                </div>
                <p>Save messages or details if it's safe to. Power gaps make this hard alone, and that's okay.</p>
              </div>
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                  <strong data-i18n="chip.reachout">Reach out</strong>
                </div>
                <p>Confidential support is available, even if you're unsure it "counts."</p>
              </div>
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22V4"/><path d="M4 4h11l-1.5 4L15 12H4"/></svg>
                  <strong data-i18n="chip.reporting">Reporting</strong>
                </div>
                <p>Campus channels exist specifically for cases involving faculty or staff.</p>
              </div>
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L20 6V11C20 16 16.5 20 12 22C7.5 20 4 16 4 11V6L12 2Z"/></svg>
                  <strong data-i18n="chip.safety">Safety first</strong>
                </div>
                <p>You're never responsible for how someone in authority behaves.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>
  </div>
</div>


  <!-- KNOW YOUR RIGHTS -->
  <section id="rights">
    <div class="wrap">
      <div class="section-head">
        <span class="section-eyebrow" data-i18n="rights.eyebrow">The law is already on your side.</span>
        <h2 data-i18n="rights.title">Are You Aware of Your Rights?</h2>
        <p data-i18n="rights.intro">CIEcured translates the protections you're entitled to into plain language — so you can recognize what's happening and know exactly what to do next.</p>
      </div>
      <div class="rights-grid">
        <div class="right-card" tabindex="0">
          <span class="law-tag">RA 9262</span>
          <h3 data-i18n="rights.ra9262.title">Anti-VAWC Law</h3>
          <span class="right-hint" data-i18n="rights.hint">Hover to learn more ›</span>
          <div class="right-detail">
            <p data-i18n="rights.ra9262.main">Protects women and their children from physical, sexual, psychological, and economic abuse — including by a partner or family member.</p>
            <p class="right-extra" data-i18n="rights.ra9262.extra">Applies to a spouse, ex-spouse, or partner — even without marriage or shared residence. Covers threats, controlling behavior, and withholding financial support, not just physical harm.</p>
          </div>
        </div>
        <div class="right-card" tabindex="0">
          <span class="law-tag">RA 11313</span>
          <h3 data-i18n="rights.ra11313.title">Safe Spaces Act</h3>
          <span class="right-hint" data-i18n="rights.hint">Hover to learn more ›</span>
          <div class="right-detail">
            <p data-i18n="rights.ra11313.main">Covers harassment in streets, public spaces, online, and educational or workplace settings — gender-based, in any form.</p>
            <p class="right-extra" data-i18n="rights.ra11313.extra">Includes catcalling, stalking, unwanted advances, and online harassment such as unwanted sexual remarks, threats, or sharing private content without consent.</p>
          </div>
        </div>
        <div class="right-card" tabindex="0">
          <span class="law-tag">RA 7877</span>
          <h3 data-i18n="rights.ra7877.title">Anti-Sexual Harassment Act</h3>
          <span class="right-hint" data-i18n="rights.hint">Hover to learn more ›</span>
          <div class="right-detail">
            <p data-i18n="rights.ra7877.main">Addresses harassment by someone who holds authority, influence, or moral ascendancy over you at school or at work.</p>
            <p class="right-extra" data-i18n="rights.ra7877.extra">Covers a supervisor, teacher, or someone in a position of power who conditions a favor, grade, or job outcome on sexual demands — even implied ones.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- ================= SCENARIO DIVIDER 3 — ONLINE CAMPUS LIFE ================= -->
<div class="scenario-divider">
  <div class="scenario-card">
    <article class="scenario-card-inner" tabindex="0" aria-expanded="false">
      <div class="scenario-row">
        <span class="scenario-visual" aria-hidden="true">
          <img src="assets/img/img_S3.jpg" alt="">
        </span>
        <div class="scenario-main">
          <span class="scenario-label"><span class="pip"></span><span class="label-text" data-i18n="scenario.s3.label">Online campus life</span></span>
          <h3 class="scenario-title" data-i18n="scenario.s3.title">What would you do if your class group chat became a place for harassment?</h3>
          <p class="scenario-preview" data-i18n="scenario.s3.preview">Harassment can happen even when you're behind a screen.</p>
        </div>
        <span class="scenario-indicator" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </span>
      </div>
      <div class="scenario-expand">
        <div class="scenario-expand-inner">
          <div class="scenario-expand-content">
            <p class="scenario-meaning" data-i18n="scenario.s3.meaning">Unwanted messages, shared photos, rumors, or pile-on jokes in a class or organization chat are still harassment, even without anyone being physically present. Online spaces can make it harder to get away from — it can follow you into your notifications at any hour — and none of that makes it less serious.</p>
            <div class="scenario-grid">
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M14.5 9.5L10 10l-.5 4.5L14 14l.5-4.5z"/></svg>
                  <strong data-i18n="chip.consider">Consider</strong>
                </div>
                <p>Save screenshots if you can. Blocking or muting is a valid response.</p>
              </div>
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                  <strong data-i18n="chip.reachout">Reach out</strong>
                </div>
                <p>Loop in a trusted classmate, adviser, or the group's moderator.</p>
              </div>
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22V4"/><path d="M4 4h11l-1.5 4L15 12H4"/></svg>
                  <strong data-i18n="chip.reporting">Reporting</strong>
                </div>
                <p>Report it if it's tied to your class, org, or campus community.</p>
              </div>
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L20 6V11C20 16 16.5 20 12 22C7.5 20 4 16 4 11V6L12 2Z"/></svg>
                  <strong data-i18n="chip.safety">Safety first</strong>
                </div>
                <p>You're not obligated to respond to or engage with the sender.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>
  </div>
</div>


  <!-- WHY TRUSTED -->
  <section>
    <div class="wrap">
      <div class="section-head">
        <span class="section-eyebrow" data-i18n="trust.eyebrow">Why CIEcured Is Trusted</span>
        <h2 data-i18n="trust.title">Built so the record protects you, too.</h2>
        <p data-i18n="trust.intro">Every safeguard exists for one reason: so raising your voice never puts you at more risk.</p>
      </div>
      <div class="trust-grid">
        <div class="trust-card">
          <div class="icon-halo">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 2L20 6V11C20 16 16.5 20 12 22C7.5 20 4 16 4 11V6L12 2Z"/></svg>
          </div>
          <h3 data-i18n="trust.card1.title">Confidential</h3>
          <p data-i18n="trust.card1.desc">Report with your name or completely anonymously — you're always in control of what you share.</p>
        </div>
        <div class="trust-card">
          <div class="icon-halo">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="4" y="10" width="16" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
          </div>
          <h3 data-i18n="trust.card2.title">Tamper-evident</h3>
          <p data-i18n="trust.card2.desc">Every report and action writes to a hash-chained record that can be independently verified.</p>
        </div>
        <div class="trust-card">
          <div class="icon-halo">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>
          </div>
          <h3 data-i18n="trust.card3.title">Audited Access</h3>
          <p data-i18n="trust.card3.desc">Only named, trained staff can open a report — and every view is logged.</p>
        </div>
        <div class="trust-card">
          <div class="icon-halo">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3"/></svg>
          </div>
          <h3 data-i18n="trust.card4.title">Always Reachable</h3>
          <p data-i18n="trust.card4.desc">Start a report any time. This isn't an emergency line — for immediate danger, call your local hotline.</p>
        </div>
      </div>
    </div>
  </section>

<!-- ================= SCENARIO DIVIDER 4 — STUDENT LIFE ================= -->
<div class="scenario-divider">
  <div class="scenario-card">
    <article class="scenario-card-inner" tabindex="0" aria-expanded="false">
      <div class="scenario-row">
        <span class="scenario-visual" aria-hidden="true">
          <img src="assets/img/img_S4.jpg" alt="">
        </span>
        <div class="scenario-main">
          <span class="scenario-label"><span class="pip"></span><span class="label-text" data-i18n="scenario.s4.label">Student life</span></span>
          <h3 class="scenario-title" data-i18n="scenario.s4.title">What would you do if someone pressured you into doing something you didn't want?</h3>
          <p class="scenario-preview" data-i18n="scenario.s4.preview">You never owe someone something because they're your friend, partner, classmate, or org member.</p>
        </div>
        <span class="scenario-indicator" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </span>
      </div>
      <div class="scenario-expand">
        <div class="scenario-expand-inner">
          <div class="scenario-expand-content">
            <p class="scenario-meaning" data-i18n="scenario.s4.meaning">Pressure, guilt-tripping, repeated asking, or "everyone's doing it" framing can make it genuinely hard to give consent freely. Agreeing just to avoid conflict or being left out isn't the same as actually wanting to say yes — and you can change your mind at any point, even after saying yes once.</p>
            <div class="scenario-grid">
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M14.5 9.5L10 10l-.5 4.5L14 14l.5-4.5z"/></svg>
                  <strong data-i18n="chip.consider">Consider</strong>
                </div>
                <p>It's okay to pause, say no, or step away — whatever the setting.</p>
              </div>
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                  <strong data-i18n="chip.reachout">Reach out</strong>
                </div>
                <p>Talk to someone you trust, even if you're unsure it "counts" as anything serious.</p>
              </div>
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22V4"/><path d="M4 4h11l-1.5 4L15 12H4"/></svg>
                  <strong data-i18n="chip.reporting">Reporting</strong>
                </div>
                <p>CIEcured is there whenever you want to document what happened.</p>
              </div>
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L20 6V11C20 16 16.5 20 12 22C7.5 20 4 16 4 11V6L12 2Z"/></svg>
                  <strong data-i18n="chip.safety">Safety first</strong>
                </div>
                <p>Your comfort comes before anyone else's expectations.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>
  </div>
</div>


  <!-- HOW IT WORKS -->
  <section id="how">
    <div class="wrap">
      <div class="how-wrap">
        <div class="section-head" style="margin-bottom:44px;">
          <span class="section-eyebrow" data-i18n="how.eyebrow">⚙ How CIEcured Works</span>
          <h2 data-i18n="how.title">A simple and secure reporting process</h2>
          <p data-i18n="how.intro">We're here to listen, support, and help every step of the way.</p>
        </div>
        <div class="how-flow">
          <div class="how-flow-step">
            <div class="how-icon-circle">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5z"/></svg>
            </div>
            <div class="how-flow-num">01</div>
            <h3 data-i18n="how.step1.title">Submit</h3>
            <p data-i18n="how.step1.desc">Share the details of the incident through our secure reporting form.</p>
          </div>
          <div class="how-flow-connector"></div>
          <div class="how-flow-step">
            <div class="how-icon-circle">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
            </div>
            <div class="how-flow-num">02</div>
            <h3 data-i18n="how.step2.title">Review</h3>
            <p data-i18n="how.step2.desc">Your report is received and carefully reviewed by authorized personnel.</p>
          </div>
          <div class="how-flow-connector"></div>
          <div class="how-flow-step">
            <div class="how-icon-circle">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </div>
            <div class="how-flow-num">03</div>
            <h3 data-i18n="how.step3.title">Communicate</h3>
            <p data-i18n="how.step3.desc">You may receive questions or updates through the secure system.</p>
          </div>
          <div class="how-flow-connector"></div>
          <div class="how-flow-step">
            <div class="how-icon-circle">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L22 12L12 22L2 12Z"/></svg>
            </div>
            <div class="how-flow-num">04</div>
            <h3 data-i18n="how.step4.title">Follow Up</h3>
            <p data-i18n="how.step4.desc">Use your case credentials to check updates and continue communication.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- ================= SCENARIO DIVIDER 5 — AS A BYSTANDER ================= -->
<div class="scenario-divider">
  <div class="scenario-card">
    <article class="scenario-card-inner" tabindex="0" aria-expanded="false">
      <div class="scenario-row">
        <span class="scenario-visual" aria-hidden="true">
          <img src="assets/img/img_S5.jpg" alt="">
        </span>
        <div class="scenario-main">
          <span class="scenario-label"><span class="pip"></span><span class="label-text" data-i18n="scenario.s5.label">As a bystander</span></span>
          <h3 class="scenario-title" data-i18n="scenario.s5.title">What would you do if you witnessed someone being harassed on campus?</h3>
          <p class="scenario-preview" data-i18n="scenario.s5.preview">You don't have to be the person experiencing harassment to help create a safer campus.</p>
        </div>
        <span class="scenario-indicator" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
        </span>
      </div>
      <div class="scenario-expand">
        <div class="scenario-expand-inner">
          <div class="scenario-expand-content">
            <p class="scenario-meaning" data-i18n="scenario.s5.meaning">Noticing that something feels wrong is often the first step, even before you're fully certain what's happening. You don't need to intervene directly or have all the answers to make a difference — sometimes the most helpful thing is simply checking in afterward or helping someone find support.</p>
            <div class="scenario-grid">
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M14.5 9.5L10 10l-.5 4.5L14 14l.5-4.5z"/></svg>
                  <strong data-i18n="chip.consider">Consider</strong>
                </div>
                <p>A quiet "are you okay?" can matter more than confronting anyone.</p>
              </div>
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="10" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                  <strong data-i18n="chip.reachout">Reach out</strong>
                </div>
                <p>Help them reach someone they trust, or just stay nearby.</p>
              </div>
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22V4"/><path d="M4 4h11l-1.5 4L15 12H4"/></svg>
                  <strong data-i18n="chip.reporting">Reporting</strong>
                </div>
                <p>Help them find the right channel, or report what you witnessed.</p>
              </div>
              <div class="scenario-chip">
                <div class="chip-head">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L20 6V11C20 16 16.5 20 12 22C7.5 20 4 16 4 11V6L12 2Z"/></svg>
                  <strong data-i18n="chip.safety">Safety first</strong>
                </div>
                <p>Never put yourself or anyone else at greater risk to step in.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </article>
  </div>
</div>


  <!-- REPORT SECTION -->
  <section class="report-section" id="report">
    <div class="wrap">
      <div class="section-head">
        <span class="section-eyebrow" data-i18n="report.eyebrow">Report a Concern</span>
        <h2 data-i18n="report.title">Whenever you're ready, we're listening.</h2>
      </div>
      <div class="report-box">
        <div>
          <h3 data-i18n="report.submit.title">Submit a report</h3>
          <p class="desc" data-i18n="report.submit.desc">This takes about three minutes. You can stop and save a draft at any point.</p>

          <div class="field" id="nameField">
            <label for="displayName" data-i18n="report.name.label">Name (optional)</label>
            <input id="displayName" type="text" placeholder="Leave blank to stay anonymous" data-i18n-placeholder="report.name.placeholder">
          </div>

          <div class="field">
            <label for="tupId" data-i18n="report.tupid.label">TUP ID</label>
            <input id="tupId" type="text" placeholder="e.g. TUPM-12-3456" data-i18n-placeholder="report.tupid.placeholder">
            <p class="field-hint" data-i18n="report.tupid.hint">Format: TUPM-[year you enrolled]-[your ID number], e.g. TUPM-12-3456. Each TUP ID can only be used to submit one report — double-check it before sending.</p>
          </div>

          <div class="field">
            <label for="cat" data-i18n="report.category.label">Category</label>
            <select id="cat">
              <option data-i18n="report.category.placeholder">Select a category…</option>
              <option value="Harassment" data-i18n="report.category.harassment">Harassment</option>
              <option value="Physical or emotional abuse" data-i18n="report.category.abuse">Physical or emotional abuse</option>
              <option value="Online / digital harassment" data-i18n="report.category.online">Online / digital harassment</option>
              <option value="Other safeguarding concern" data-i18n="report.category.other">Other safeguarding concern</option>
            </select>
          </div>

          <div class="field">
            <label for="location" data-i18n="report.location.label">Place</label>
            <input id="location" type="text" placeholder="e.g. Room 204, CR, hallway…" data-i18n-placeholder="report.location.placeholder">
          </div>
			
          <div class="field">
            <label for="desc" data-i18n="report.desc.label">What's happening</label>
            <textarea id="desc" placeholder="Share as much or as little as you're comfortable with…" data-i18n-placeholder="report.desc.placeholder"></textarea>
          </div>

          <div class="field">
            <label for="reportPassword" data-i18n="report.password.label">Create an inbox password</label>
            <input id="reportPassword" type="password" placeholder="At least 4 characters" data-i18n-placeholder="report.password.placeholder">
            <p class="field-hint" data-i18n="report.password.hint">You'll need this, along with your TUP ID, to read replies later. We don't store this as plain text, and staff can't see it or reset it for you — please remember it.</p>
          </div>

          <button class="btn btn-primary" style="padding:13px 26px;" onclick="submitReport()" data-i18n="report.submitbtn">Submit Report</button>
        </div>

        <div class="track-box">
          <h3 data-i18n="report.track.title">Already reported?</h3>
          <p data-i18n="report.track.desc">Enter your TUP ID and password to read replies or add details to an existing case.</p>
          <div class="field" style="margin-bottom:0;">
            <label for="trackTupId" data-i18n="report.track.code.label">TUP ID</label>
            <input id="trackTupId" type="text" placeholder="e.g. TUPM-12-3456" data-i18n-placeholder="report.track.code.placeholder">
          </div>
          <div class="field" style="margin-bottom:0; margin-top:10px;">
            <label for="trackPassword" data-i18n="report.track.password.label">Password</label>
            <input id="trackPassword" type="password" placeholder="Your inbox password" data-i18n-placeholder="report.track.password.placeholder">
          </div>
          <button class="btn btn-outline" style="margin-top:14px; width:100%;" onclick="trackReport()" data-i18n="report.openinbox">Open Inbox</button>
          <div class="code-result" id="trackResult"></div>
        </div>
      </div>
      <div class="report-result" id="reportResult" hidden></div>
    </div>
  </section>

</main>

<!-- ============ ASSESS YOURSELF PAGE ============ -->
<div id="page-assess" class="page" hidden>
  <section class="assess-hero">
    <div class="wrap">
      <div class="section-head" style="margin:0 auto 0; max-width:640px; text-align:center;">
        <span class="section-eyebrow" data-i18n="assess.eyebrow">🧭 Assess Yourself</span>
        <h2 data-i18n="assess.title">How well do you know your rights?</h2>
        <p data-i18n="assess.intro">Ten quick questions — no wrong turns, just clarity. Nothing here is tracked or reported anywhere.</p>
      </div>
    </div>
  </section>

  <section class="quiz-section">
    <div class="wrap">
      <div class="quiz-shell">

        <!-- IN-PROGRESS VIEW -->
        <div id="quizPlay">
          <div class="quiz-progress">
            <div class="quiz-progress-track"><div class="quiz-progress-fill" id="quizProgressFill"></div></div>
            <span class="quiz-progress-label" id="quizProgressLabel">Question 1 of 10</span>
          </div>

          <div class="quiz-card">
            <h3 id="quizQuestion">Question text</h3>
            <div class="quiz-options" id="quizOptions"></div>
            <p class="quiz-feedback" id="quizFeedback" hidden></p>
            <button class="btn btn-primary quiz-next" id="quizNextBtn" onclick="nextQuestion()" hidden>Next question</button>
          </div>
        </div>

        <!-- RESULTS VIEW -->
        <div id="quizResults" hidden>
          <div class="quiz-result-card">
            <span class="result-score" id="resultScore">0/10</span>
            <h3 id="resultTitle">Nice work.</h3>
            <p id="resultMessage">Here's how you did.</p>
            <div class="result-recap" id="resultRecap"></div>
            <div class="result-ctas">
              <button class="btn btn-hero" onclick="goHome(event,'report')" data-i18n="assess.result.report">Report a concern</button>
              <button class="btn btn-outline" onclick="goHome(event,'rights')" data-i18n="assess.result.review">Review your rights</button>
              <button class="btn btn-outline" onclick="startQuiz()" data-i18n="assess.result.retake">Retake assessment</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

<!-- ============ INBOX PAGE ============ -->
<div id="page-inbox" class="page" hidden>

  <!-- Locked view: shown by default. Nothing about the inbox itself
       is visible here except this popup, until the code and password
       are both correct. -->
  <section class="inbox-body" id="inboxLockedSection" style="padding:60px 0;">
    <div class="wrap" style="display:flex; justify-content:center;">
      <div class="modal-box" style="max-width:420px;">
        <h3>Open your inbox</h3>
        <p>Enter your TUP ID and password to continue.</p>
        <div class="field" style="text-align:left;">
          <label for="inboxTupId">TUP ID</label>
          <input id="inboxTupId" type="text" placeholder="e.g. TUPM-12-3456">
        </div>
        <div class="field" style="text-align:left; margin-bottom:0;">
          <label for="inboxPassword">Password</label>
          <input id="inboxPassword" type="password" placeholder="Your inbox password">
        </div>
        <button class="btn btn-primary" style="width:100%; margin-top:16px;" onclick="openCaseFromInput()">Open case</button>
        <div id="inboxUnlockError" class="field-hint" style="color:#8C332B;"></div>
      </div>
    </div>
  </section>

  <!-- Unlocked view: only shown once the code and password are verified. -->
  <section class="inbox-body" id="inboxContentSection" hidden>
    <div class="wrap" style="max-width:640px;">

      <div class="inbox-thread" id="inboxThread">
        <div class="thread-header">
          <div>
            <span class="thread-code" id="threadTupId">TUPM-YY-NNNN</span>
            <span class="thread-status" id="threadStatus">Under review</span>
          </div>
          <span class="thread-cat" id="threadCat">Category</span>
          <span class="thread-cat" id="threadLocation"></span>
          <span class="thread-cat" id="threadSubmitted"></span>
        </div>
        <div class="thread-messages" id="threadMessages"></div>
        <form class="thread-reply" id="threadReplyForm" onsubmit="sendReply(event)">
          <textarea id="threadReplyInput" placeholder="Write a reply…" rows="2"></textarea>
          <button class="btn btn-primary" type="submit">Send</button>
        </form>
      </div>

    </div>
  </section>
</div>

<footer id="site-footer">
  <div class="wrap">
    <div class="footer-top">
      <div>
        <div class="footer-logo">
          <span class="logo-mark">
            <img src="assets/img/logo.png" alt="CIEcured logo">
          </span>
          CIEcured
        </div>
        <p>A calm, confidential place to speak up — and be heard by the right people, safely.</p>
      </div>
      <div class="footer-links">
        <div class="footer-col">
          <h4>Platform</h4>
          <a href="#rights" onclick="goHome(event,'rights')">Know Your Rights</a>
          <a href="#" onclick="showPage(event,'assess')">Assess Yourself</a>
          <a href="#" onclick="showPage(event,'inbox')">Inbox</a>
        </div>
        <div class="footer-col">
          <h4>Legal</h4>
          <a href="#">Privacy</a>
          <a href="#" onclick="showPage(event,'inbox')">Track a Report</a>
          <a href="#">Contact</a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <span class="tagline">CIEcured — privacy by architecture.</span>
      <span class="emergency">In immediate danger? Call your local emergency number first.</span>
    </div>
  </div>
</footer>

<!-- ============ CHAT WIDGET ============ -->
<div class="chat-widget">
  <button class="chat-toggle" id="chatToggle" aria-label="Open support chat" onclick="toggleChat()">
    <svg id="chatIconOpen" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
    <svg id="chatIconClose" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" hidden><line x1="6" y1="6" x2="18" y2="18"/><line x1="18" y1="6" x2="6" y2="18"/></svg>
  </button>

  <div class="chat-panel" id="chatPanel" hidden>
    <div class="chat-header">
      <div>
        <span class="chat-title">CIEcured Support</span>
        <span class="chat-subtitle">Usually replies in a moment</span>
      </div>
    </div>
    <div class="chat-body" id="chatBody"></div>
    <div class="chat-quick" id="chatQuick"></div>
    <form class="chat-input-row" id="chatForm" onsubmit="sendChat(event)">
      <input id="chatInput" placeholder="Type a message…" autocomplete="off">
      <button type="submit" aria-label="Send">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
      </button>
    </form>
  </div>
</div>

<!-- ============ CONFIRM REPORT POPUP ============ -->
<!-- Shown when the student clicks Submit Report. Nothing is saved
     yet at this point — this is a checkpoint so they can double-check
     their TUP ID and agree to the terms before anything is sent. -->
<div id="confirmModal" class="modal-overlay" hidden>
  <div class="modal-box">
    <h3>Double-check before you submit</h3>
    <p>You're about to submit a report using this TUP ID:</p>
    <div class="code-display" id="confirmTupIdValue">TUPM-YY-NNNN</div>
    <p class="field-hint" style="color:#8C332B;">Make sure this is correct. If your TUP ID is wrong, your report will not be considered valid — and a TUP ID can only be used to submit one report, so you won't be able to submit again under the same ID to fix it.</p>

    <div class="tc-box">
      <h4>Terms and Conditions</h4>
      <p>By submitting this report, I certify that the information provided is true, accurate, and complete to the best of my knowledge. I understand that submitting false, misleading, or fabricated information may result in the report being disregarded and may be subject to appropriate disciplinary action under applicable University policy. I further acknowledge that this TUP ID may be used to submit one (1) report only and cannot be reused once submitted.</p>
    </div>

    <label class="tc-agree" for="confirmTermsCheckbox">
      <input type="checkbox" id="confirmTermsCheckbox" onchange="onConfirmTermsChange(this)">
      <span>I have read, understood, and agree to the Terms and Conditions above.</span>
    </label>

    <p class="field-hint" id="confirmError" style="color:#8C332B;"></p>
    <button class="btn btn-primary" style="width:100%; margin-top:10px;" id="confirmSubmitBtn" disabled onclick="confirmAndSubmitReport()">Confirm &amp; Submit</button>
    <button class="btn btn-outline" style="width:100%; margin-top:10px;" onclick="closeConfirmModal()">Go back</button>
  </div>
</div>

<!-- ============ REPORT SUBMITTED POPUP ============ -->
<div id="reportSubmittedModal" class="modal-overlay" hidden>
  <div class="modal-box">
    <h3>Report submitted</h3>
    <div class="code-display" id="modalTupIdValue">TUPM-YY-NNNN</div>
    <p id="modalSubmittedAt" class="field-hint"></p>
    <p>Remember the password you just created, along with this TUP ID.</p>
    <p class="field-hint">You'll need both, together, to check for replies later. We don't store your password as plain text, and staff can't look it up for you if you lose it.</p>
    <button class="btn btn-primary" style="width:100%; margin-top:6px;" id="modalOpenInboxBtn">I've saved it — open my inbox</button>
    <button class="btn btn-outline" style="width:100%; margin-top:10px;" onclick="closeSubmittedModal()">Close</button>
  </div>
</div>

<!-- ============ RESOLVED CASE POPUP ============ -->
<div id="resolvedModal" class="modal-overlay" hidden>
  <div class="modal-box">
    <h3>This case has been marked resolved</h3>
    <p id="resolvedModalMessage"></p>
    <button class="btn btn-primary" style="width:100%; margin-top:6px;" onclick="closeResolvedModal()">Got it</button>
  </div>
</div>

<script src="assets/js/script.js"></script>
<script src="assets/js/scenarios.js"></script>

</body>

</html>
