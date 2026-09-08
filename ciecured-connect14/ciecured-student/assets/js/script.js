/* ================= LANGUAGE TOGGLE (EN / TL) ================= */
// Every element tagged with data-i18n="some.key" gets its text
// swapped when the language changes. Only sections that have been
// translated so far are covered by the TL dictionary below — any
// key missing from TL just stays in English, so nothing breaks as
// more sections get translated over time.
var TRANSLATIONS = {
  tl: {
    "rights.eyebrow": "Ang batas ay panig na sa iyo.",
    "rights.title": "Alam Mo Ba ang Iyong mga Karapatan?",
    "rights.intro": "Isinasalin ng CIEcured sa payak na wika ang mga proteksyong nararapat sa iyo — upang mas madali mong makilala ang nangyayari at malaman nang eksakto ang dapat gawin.",
    "rights.hint": "I-hover upang matuto pa ›",
    "rights.ra9262.title": "Batas Kontra sa Karahasan sa Kababaihan at Kanilang mga Anak (Anti-VAWC Law)",
    "rights.ra9262.main": "Pinoprotektahan nito ang kababaihan at ang kanilang mga anak laban sa pisikal, sekswal, sikolohikal, at ekonomikong pang-aabuso — kabilang na ang ginagawa ng kapareha o miyembro ng pamilya.",
    "rights.ra9262.extra": "Naaangkop ito sa asawa, dating asawa, o kapareha — kahit walang kasal o hindi magkasamang naninirahan. Sakop nito ang mga banta, mapanupil na pag-uugali, at pagkakait ng suportang pinansyal, hindi lang pisikal na pananakit.",
    "rights.ra11313.title": "Batas sa Ligtas na Espasyo (Safe Spaces Act)",
    "rights.ra11313.main": "Sakop nito ang panliligalig sa mga kalye, pampublikong lugar, online, at sa paaralan o pinagtatrabahuhan — anumang uri ng panliligalig na nakabatay sa kasarian.",
    "rights.ra11313.extra": "Kabilang dito ang catcalling, stalking, hindi hinihinging pang-aakit, at online na panliligalig tulad ng hindi hinihinging sekswal na komento, banta, o pagbahagi ng pribadong nilalaman nang walang pahintulot.",
    "rights.ra7877.title": "Batas Kontra sa Sekswal na Panliligalig (Anti-Sexual Harassment Act)",
    "rights.ra7877.main": "Tumutugon ito sa panliligalig ng isang taong may awtoridad o moral na impluwensya (moral ascendancy) sa iyo, sa paaralan man o sa trabaho.",
    "rights.ra7877.extra": "Sakop nito ang superbisor, guro, o sinumang may kapangyarihan na nagkokondisyon ng pabor, marka, o resulta sa trabaho batay sa sekswal na kahilingan — kahit ito ay hindi tuwirang sinasabi.",
    "chip.consider": "Isaalang-alang",
    "chip.reachout": "Lumapit",
    "chip.reporting": "Pag-uulat",
    "chip.safety": "Kaligtasan Muna",

    "nav.rights": "Alamin ang Iyong mga Karapatan",
    "nav.assess": "I-assess ang Sarili",
    "nav.inbox": "Inbox",
    "nav.report": "Report",

    "hero.eyebrow": "LIGTAS · KUMPIDENSYAL · MAY PANANAGUTAN",
    "hero.sub": "Isang ligtas at kumpidensyal na espasyo para sa mga estudyante ng CIE upang maunawaan ang kanilang mga karapatan, ilahad ang kanilang mga alalahanin, at kumilos — habang nasa kontrol pa rin sila ng kanilang sariling kwento.",
    "hero.reportnow": "Report Now",
    "hero.trust1": "Anonymous o may pangalan",
    "hero.trust2": "Rekord na hindi mababago nang hindi mapapansin",
    "hero.trust3": "Audited access lamang",
    "hero.cardtag": "Bago ka magsimula",
    "hero.cardtitle": "Hindi ka nag-iisa sa bagay na ito",
    "hero.cardintro": "Anuman ang dahilan kung bakit ka narito, ikaw ang may kontrol sa susunod na mangyayari.",
    "hero.list1": "Palaging nasa iyong kontrol ang iyong pagkakakilanlan",
    "hero.list2": "Tanging mga sanay at beripikadong staff lamang ang maaaring magsuri ng kaso",
    "hero.list3": "Sundin ang sarili mong bilis — walang minamadali",
    "hero.seehow": "Tingnan kung paano ito gumagana",
    "hero.tracklink": "May naiulat ka na ba? ",
    "hero.tracklinkb": "Subaybayan ito gamit ang iyong TUP ID.",

    "trust.eyebrow": "Bakit Mapagkakatiwalaan ang CIEcured",
    "trust.title": "Idinisenyo upang ang rekord ay proteksyon mo rin.",
    "trust.intro": "Bawat proteksyon ay may isang layunin: upang ang paglahad ng iyong boses ay hindi kailanman maglagay sa iyo sa mas malaking panganib.",
    "trust.card1.title": "Kumpidensyal",
    "trust.card1.desc": "Mag-ulat gamit ang iyong pangalan o ganap na anonymous — laging nasa iyo ang kontrol kung ano ang ibabahagi mo.",
    "trust.card2.title": "Hindi Mababago nang Hindi Mapapansin",
    "trust.card2.desc": "Bawat report at aksyon ay naitatala sa isang hash-chained na rekord na maaaring beripikahin nang independiyente.",
    "trust.card3.title": "Na-audit na Access",
    "trust.card3.desc": "Tanging mga pinangalanan at sanay na staff lamang ang maaaring magbukas ng report — at bawat pagtingin ay itinatala.",
    "trust.card4.title": "Laging Bukas",
    "trust.card4.desc": "Magsimula ng report anumang oras. Hindi ito emergency line — kung may agarang panganib, tumawag sa iyong lokal na hotline.",

    "how.eyebrow": "⚙ Paano Gumagana ang CIEcured",
    "how.title": "Isang simple at secure na proseso ng pag-uulat",
    "how.intro": "Nandito kami upang makinig, sumuporta, at tumulong sa bawat hakbang.",
    "how.step1.title": "Isumite",
    "how.step1.desc": "Ibahagi ang mga detalye ng insidente sa pamamagitan ng aming secure na reporting form.",
    "how.step2.title": "Suriin",
    "how.step2.desc": "Ang iyong report ay natatanggap at maingat na sinusuri ng awtorisadong tauhan.",
    "how.step3.title": "Makipag-ugnayan",
    "how.step3.desc": "Maaari kang makatanggap ng mga tanong o update sa pamamagitan ng secure na sistema.",
    "how.step4.title": "Sundan",
    "how.step4.desc": "Gamitin ang iyong case credentials upang tingnan ang mga update at ipagpatuloy ang komunikasyon.",

    "report.eyebrow": "Mag-ulat ng Alalahanin",
    "report.title": "Anumang oras ka handa, nakikinig kami.",
    "report.submit.title": "Magsumite ng Report",
    "report.submit.desc": "Tatagal ito ng humigit-kumulang tatlong minuto. Maaari kang huminto at i-save ang draft anumang oras.",
    "report.name.label": "Pangalan (opsyonal)",
    "report.name.placeholder": "Iwanang blangko upang manatiling anonymous",
    "report.category.label": "Kategorya",
    "report.category.placeholder": "Pumili ng kategorya…",
    "report.category.harassment": "Panliligalig",
    "report.category.abuse": "Pisikal o emosyonal na pang-aabuso",
    "report.category.online": "Online / digital na panliligalig",
    "report.category.other": "Ibang alalahanin sa kaligtasan",
    "report.location.label": "Lugar",
    "report.location.placeholder": "hal. Room 204, CR, hallway…",
    "report.desc.label": "Ano ang nangyayari",
    "report.desc.placeholder": "Ibahagi hanggang saan ka komportable — dami man o kaunti…",
    "report.password.label": "Gumawa ng password para sa inbox",
    "report.password.placeholder": "Hindi bababa sa 4 na karakter",
    "report.password.hint": "Kakailanganin mo ito, kasama ang iyong TUP ID, upang mabasa ang mga sagot sa ibang pagkakataon. Hindi namin ito iniimbak bilang plain text, at hindi ito makikita o mare-reset ng staff para sa iyo — pakitandaan ito.",
    "report.tupid.label": "TUP ID",
    "report.tupid.placeholder": "hal. TUPM-12-3456",
    "report.tupid.hint": "Format: TUPM-[taon ng iyong pagpasok]-[numero ng iyong ID], hal. TUPM-12-3456. Isang beses lang magagamit ang bawat TUP ID para magsumite ng ulat — siguraduhing tama ito bago ipadala.",
    "report.submitbtn": "Isumite ang Report",
    "report.track.title": "May naiulat ka na ba?",
    "report.track.desc": "Ilagay ang iyong TUP ID at password upang mabasa ang mga sagot o magdagdag ng detalye sa umiiral na kaso.",
    "report.track.code.label": "TUP ID",
    "report.track.code.placeholder": "hal. TUPM-12-3456",
    "report.track.password.label": "Password",
    "report.track.password.placeholder": "Ang password ng iyong inbox",
    "report.openinbox": "Buksan ang Inbox",

    "ways.eyebrow": "📣 MAGSALITA, HUMINGI NG SUPORTA",
    "ways.title.a": "Alam mo ba na may mga Batas na ",
    "ways.title.b": "makakatulong sa iyong kaso?",
    "ways.intro": "May karapatan kang magsalita at humingi ng tulong. May mga ligtas at angkop na channel na available para sa iyo.",
    "ways.link": "Alamin muna ang iyong mga karapatan →",
    "ways.card1.title": "Nang Personal",
    "ways.card1.desc": "Humingi ng tulong mula sa naaangkop na opisina ng unibersidad o awtorisadong tauhan.",
    "ways.card2.title": "Sa Pamamagitan ng Opisyal na Channel",
    "ways.card2.desc": "Gamitin ang umiiral na proseso ng pag-uulat at mga serbisyo ng suporta ng paaralan.",
    "ways.card3.title": "Sa Pamamagitan ng CIEcured",
    "ways.card3.desc": "Magsumite at ligtas na sundan ang iyong report sa aming kumpidensyal na platform.",
    "ways.card3.btn": "Magsimula ng Report",

    "assess.eyebrow": "🧭 Subukin ang Sarili",
    "assess.title": "Gaano mo kakilala ang iyong mga karapatan?",
    "assess.intro": "Sampung mabilisang tanong — walang maling hakbang, linaw lang. Wala sa mga ito ang sinusubaybayan o iniuulat kahit saan.",
    "assess.result.report": "Mag-ulat ng alalahanin",
    "assess.result.review": "Suriin ang iyong mga karapatan",
    "assess.result.retake": "Ulitin ang pagsusulit",

    "scenario.s1.label": "Sa Silid-Aralan",
    "scenario.s1.title": "Ano ang gagawin mo kung may kaklase kang humipo sa iyo nang wala kang pahintulot?",
    "scenario.s1.preview": "Sa isang gawain sa klase, paulit-ulit na hinihipo ng isang kaklase ang kapwa estudyante kahit malinaw namang ipinaalam nito na hindi ito komportable. Lumalayo ang estudyante, pero nauulit pa rin ito, at binabalewala lang bilang \"biro.\" Naiiwan ang estudyante na balisa at nag-aalinlangan kung dapat itong iulat.",
    "scenario.s1.meaning": "Maaaring lumayo ang estudyante at lumapit sa taong pinagkakatiwalaan nito, tulad ng guro o ng tanggapan ng GAD (Gender and Development). Maaari nitong ibahagi ang nangyari at iulat ang pag-uugali sa oras na maging handa ito. Sa pamamagitan ng GAD, makakatanggap ito ng suporta at gabay habang ginagalang at pinananatiling kumpidensyal ang alalahanin nito.",

    "scenario.s2.label": "Sa Loob ng Faculty",
    "scenario.s2.title": "Ano ang gagawin mo kung lumabag ang isang propesor sa personal mong hangganan?",
    "scenario.s2.preview": "Ang posisyon ng awtoridad ay hindi dapat gamitin upang pigilan o takutin ang isang estudyante.",
    "scenario.s2.meaning": "Ang hindi hinihinging komento, mensahe, o pamimilit mula sa taong may kapangyarihan sa iyong akademikong kalagayan ay isang maling paggamit ng awtoridad na iyon, hindi normal na bahagi ng pagmementor. Ang kawalang-timbang na ito ay maaaring magpahirap sa pagtanggi o pag-uulat, lalo na kung nakataya ang mga marka o oportunidad — at ang pag-aalinlangang ito ay makatwirang tugon sa tunay na panganib, hindi tanda na hindi wasto ang alalahanin.",

    "scenario.s3.label": "Buhay sa Online na Kampus",
    "scenario.s3.title": "Ano ang gagawin mo kung naging lugar ng panliligalig ang inyong class group chat?",
    "scenario.s3.preview": "Ang panliligalig ay maaaring mangyari kahit nasa likod ka ng screen.",
    "scenario.s3.meaning": "Ang hindi hinihinging mensahe, ibinahaging larawan, tsismis, o sabay-sabay na biro sa isang class o organization chat ay panliligalig pa rin, kahit walang pisikal na presensya. Ang online na espasyo ay maaaring mas mahirap talikuran — maaari itong sumunod sa iyong mga notification anumang oras — at wala sa mga ito ang nagpapagaan sa bigat nito.",

    "scenario.s4.label": "Buhay Bilang Estudyante",
    "scenario.s4.title": "Ano ang gagawin mo kung may nanggipit sa iyo na gumawa ng bagay na ayaw mo?",
    "scenario.s4.preview": "Hindi ka kailanman may utang sa isang tao dahil siya ay kaibigan mo, kapareha, kaklase, o kasapi ng organisasyon.",
    "scenario.s4.meaning": "Ang pamimilit, panggigipit, paulit-ulit na pakikiusap, o pag-eeframe na \"lahat naman ay ginagawa ito\" ay maaaring magpahirap na magbigay ng tunay na malayang pahintulot. Ang pagsang-ayon lamang upang maiwasan ang alitan o hindi masali ay hindi katumbas ng tunay na pagnanais na sumang-ayon — at maaari kang magbago ng isip anumang oras, kahit pagkatapos mong sumang-ayon.",

    "scenario.s5.label": "Bilang Saksi",
    "scenario.s5.title": "Ano ang gagawin mo kung nasaksihan mong may nililigalig sa kampus?",
    "scenario.s5.preview": "Hindi mo kailangang maranasan mismo ang panliligalig upang makatulong lumikha ng mas ligtas na kampus.",
    "scenario.s5.meaning": "Ang pagpansin na may hindi maganda ay kadalasang unang hakbang, kahit hindi ka pa lubos na sigurado kung ano talaga ang nangyayari. Hindi mo kailangang direktang manghimasok o magkaroon ng lahat ng sagot upang makatulong — minsan, ang pinakamalaking tulong ay ang simpleng pagtanong kung okay lang o pagtulong sa paghahanap ng suporta."
  }
};

var currentLang = localStorage.getItem('ciecured_lang') || 'en';

function toggleLanguage(){
  currentLang = (currentLang === 'en') ? 'tl' : 'en';
  localStorage.setItem('ciecured_lang', currentLang);
  applyLanguage();
}

function applyLanguage(){
  document.querySelectorAll('.lang-toggle .lang-option').forEach(function(opt){
    opt.classList.toggle('active', opt.getAttribute('data-lang') === currentLang);
  });

  document.querySelectorAll('[data-i18n]').forEach(function(el){
    var key = el.getAttribute('data-i18n');

    // Remember the original English text the first time we touch
    // this element, so switching back to English is exact.
    if(!el.dataset.enText){
      el.dataset.enText = el.textContent;
    }

    if(currentLang === 'tl' && TRANSLATIONS.tl[key]){
      el.textContent = TRANSLATIONS.tl[key];
    } else {
      el.textContent = el.dataset.enText;
    }
  });

  // Same idea, but for placeholder text on inputs/textareas instead
  // of visible text content.
  document.querySelectorAll('[data-i18n-placeholder]').forEach(function(el){
    var key = el.getAttribute('data-i18n-placeholder');

    if(!el.dataset.enPlaceholder){
      el.dataset.enPlaceholder = el.getAttribute('placeholder');
    }

    if(currentLang === 'tl' && TRANSLATIONS.tl[key]){
      el.setAttribute('placeholder', TRANSLATIONS.tl[key]);
    } else {
      el.setAttribute('placeholder', el.dataset.enPlaceholder);
    }
  });

  // Same idea for the quiz: if a question is currently on screen, its
  // text/options only came from QUIZ[quizIndex] when it was first
  // rendered — re-render it now so a language switch mid-quiz actually
  // takes effect, instead of waiting for the next question to load.
  var quizPlay = document.getElementById('quizPlay');
  if(quizPlay && !quizPlay.hidden && typeof QUIZ !== 'undefined' && QUIZ[quizIndex]){
    renderQuestion();
  }
}

/* ================= PAGE ROUTING ================= */
var PAGE_IDS = { home:'top', assess:'page-assess', inbox:'page-inbox' };

function showPage(e, name){
  if(e) e.preventDefault();
  Object.keys(PAGE_IDS).forEach(function(key){
    var el = document.getElementById(PAGE_IDS[key]);
    if(el) el.hidden = (key !== name);
  });
  setActiveNav(name);
  window.scrollTo({top:0, behavior:'smooth'});
  if(name === 'assess') startQuiz();
  if(name === 'inbox') lockInbox();
  closeMobileNav();
  // The floating chat button sits in the same bottom-right corner where
  // quiz answer options can land, so it's tucked away while the
  // assessment is on screen (it comes back on every other page).
  document.body.classList.toggle('quiz-mode', name === 'assess');
}

function goHome(e, anchor){
  if(e) e.preventDefault();
  Object.keys(PAGE_IDS).forEach(function(key){
    var el = document.getElementById(PAGE_IDS[key]);
    if(el) el.hidden = (key !== 'home');
  });
  setActiveNav('home');
  document.body.classList.remove('quiz-mode');
  closeMobileNav();
  requestAnimationFrame(function(){
    var el = anchor ? document.getElementById(anchor) : null;
    if(el) el.scrollIntoView({behavior:'smooth', block:'start'});
    else window.scrollTo({top:0, behavior:'smooth'});
  });
}

function setActiveNav(name){
  document.querySelectorAll('nav.links a[data-page]').forEach(function(a){
    a.classList.toggle('active', a.dataset.page === name);
  });
}

function toggleMobileNav(){
  var nav = document.getElementById('mobileNav');
  nav.hidden = !nav.hidden;
}
function closeMobileNav(){
  var nav = document.getElementById('mobileNav');
  if(nav) nav.hidden = true;
}

/* ================= REPORT FORM ================= */
// Format we expect for a TUP ID: TUPM-<2-digit year>-<ID number>.
var TUP_ID_PATTERN = /^TUPM-\d{2}-\d{3,6}$/;

// Holds the report the student is about to send, from the moment
// they click Submit until they confirm it in the popup. Nothing is
// sent to the server until confirmAndSubmitReport() runs.
var PENDING_REPORT = null;

function submitReport(){
  var btn = event.target;
  var tupId = document.getElementById('tupId').value.trim().toUpperCase();
  var cat = document.getElementById('cat').value;
  var desc = document.getElementById('desc').value.trim();
  var location = document.getElementById('location').value.trim();
  var password = document.getElementById('reportPassword').value;
  // The name field is optional now — leaving it blank keeps the
  // report anonymous, filling it in makes it a named report.
  var displayName = document.getElementById('displayName').value.trim();

  if(!TUP_ID_PATTERN.test(tupId)){
    flashButton(btn, 'Please enter a valid TUP ID (e.g. TUPM-12-3456)', '#C9584F');
    return;
  }

  if(!cat || cat.indexOf('Select') === 0){
    flashButton(btn, 'Please choose a category', '#C9584F');
    return;
  }

  if(password.length < 4){
    flashButton(btn, 'Please set a password (4+ characters)', '#C9584F');
    return;
  }

  // Nothing is saved yet — hold onto the report until the student
  // confirms their TUP ID and agrees to the terms in the popup.
  // There's no "when did this happen" field anymore — instead we
  // just record the moment they actually submit, read from this
  // device's own clock.
  PENDING_REPORT = {
    tupId: tupId,
    category: cat,
    desc: desc,
    location: location,
    password: password,
    displayName: displayName
  };

  showConfirmModal(tupId);
}

// Shows the pre-submit popup: the TUP ID the student entered, a
// warning to double-check it, and the Terms and Conditions checkbox
// that has to be ticked before Confirm & Submit does anything.
function showConfirmModal(tupId){
  document.getElementById('confirmTupIdValue').textContent = tupId;
  document.getElementById('confirmTermsCheckbox').checked = false;
  document.getElementById('confirmSubmitBtn').disabled = true;
  document.getElementById('confirmSubmitBtn').textContent = 'Confirm & Submit';
  document.getElementById('confirmError').textContent = '';
  document.getElementById('confirmModal').hidden = false;
}

function closeConfirmModal(){
  document.getElementById('confirmModal').hidden = true;
}

// Turns the Confirm & Submit button on/off as the checkbox changes.
function onConfirmTermsChange(box){
  document.getElementById('confirmSubmitBtn').disabled = !box.checked;
}

// Actually sends the report to the shared admin backend, using the
// student's TUP ID as the tracking identifier. Only runs once the
// student has confirmed their TUP ID and agreed to the terms.
function confirmAndSubmitReport(){
  if(!PENDING_REPORT){
    return;
  }

  var report = PENDING_REPORT;
  var submitBtn = document.getElementById('confirmSubmitBtn');
  var errorBox = document.getElementById('confirmError');

  submitBtn.disabled = true;
  submitBtn.textContent = 'Submitting…';
  errorBox.textContent = '';

  var reportBody = 'tup_id=' + encodeURIComponent(report.tupId) + '&category=' + encodeURIComponent(report.category) + '&message=' + encodeURIComponent(report.desc || '(No description provided)') + '&password=' + encodeURIComponent(report.password) + '&location=' + encodeURIComponent(report.location) + '&display_name=' + encodeURIComponent(report.displayName);

  fetch('save_report.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: reportBody
  })
    .then(function(res){
      return res.json().then(function(data){
        return { ok: res.ok, data: data };
      });
    })
    .then(function(result){
      if(!result.ok){
        errorBox.textContent = result.data.error || 'This TUP ID has already been used to submit a report.';
        submitBtn.disabled = false;
        submitBtn.textContent = 'Confirm & Submit';
        return;
      }

      // The moment they actually hit confirm, read straight off this
      // device's own clock — this is what "submitted at" shows later.
      var submittedAtDevice = new Date();
      var tupId = report.tupId;
      var now = 'Just now';
      INBOX_CASES[tupId] = {
        tupId: tupId,
        category: report.category,
        status: 'received',
        location: report.location || '—',
        submittedAtText: formatSubmittedAt(submittedAtDevice),
        displayName: report.displayName || '',
        messages: [
          { from:'you', text: report.desc || '(No description provided)', time: now },
          { from:'team', text:"Thanks for reaching out. We've received your report and a trained reviewer will follow up here soon. You can check back anytime with your TUP ID and password.", time: now }
        ]
      };

      // This browser tab already knows the password, since it's the
      // one that just set it — save it so re-opening this case
      // doesn't ask again.
      sessionStorage.setItem('pw_' + tupId, report.password);

      document.getElementById('tupId').value = '';
      document.getElementById('desc').value = '';
      document.getElementById('cat').value = 'Select a category…';
      document.getElementById('location').value = '';
      document.getElementById('displayName').value = '';
      document.getElementById('reportPassword').value = '';

      PENDING_REPORT = null;
      closeConfirmModal();
      showSubmittedModal(tupId, submittedAtDevice);
    })
    .catch(function(){
      errorBox.textContent = 'Something went wrong sending your report. Please try again.';
      submitBtn.disabled = false;
      submitBtn.textContent = 'Confirm & Submit';
    });
}

// Turns a Date into the kind of text we show next to "Submitted at".
// Uses this device's own locale/timezone, not the server's.
function formatSubmittedAt(date){
  return date.toLocaleDateString(undefined, { year: 'numeric', month: 'short', day: 'numeric' }) + ' at ' + date.toLocaleTimeString(undefined, { hour: 'numeric', minute: '2-digit' });
}

// Shows the "report submitted" popup, reminding the student to
// remember their password (they already know their own TUP ID).
function showSubmittedModal(tupId, submittedAtDate){
  document.getElementById('modalTupIdValue').textContent = tupId;
  document.getElementById('modalSubmittedAt').textContent = 'Submitted at ' + formatSubmittedAt(submittedAtDate);

  var openInboxBtn = document.getElementById('modalOpenInboxBtn');
  openInboxBtn.onclick = function(){
    closeSubmittedModal();
    showPage(null, 'inbox');
  };

  document.getElementById('reportSubmittedModal').hidden = false;
}

function closeSubmittedModal(){
  document.getElementById('reportSubmittedModal').hidden = true;
}

function flashButton(btn, msg, color){
  var original = btn.textContent;
  btn.textContent = msg;
  btn.style.background = color;
  setTimeout(function(){ btn.textContent = original; btn.style.background = ''; }, 2600);
}

function trackReport(){
  var tupId = document.getElementById('trackTupId').value.trim().toUpperCase();
  var password = document.getElementById('trackPassword').value;
  var result = document.getElementById('trackResult');
  if(!tupId){
    result.textContent = 'Enter your TUP ID above to continue.';
  } else if(!password){
    result.textContent = 'Enter your password too.';
  } else {
    result.innerHTML = 'Opening ' + tupId + ' in your Inbox…';
    setTimeout(function(){
      showPage(null, 'inbox');
      openCase(tupId, password);
    }, 400);
  }
  result.classList.add('show');
}

/* ================= INBOX ================= */
// Cases are no longer pre-loaded with sample data — every real case
// comes from the server once the student enters their TUP ID and
// password. This object just holds whatever case is currently open.
var INBOX_CASES = {};

var CURRENT_CASE = null;

var STATUS_LABEL = { received:'Received', review:'Under review', replied:'Replied', resolved:'Resolved' };
var STATUS_CLASS = { received:'status-received', review:'status-review', replied:'status-replied', resolved:'status-resolved' };

function openCaseFromInput(){
  var tupId = document.getElementById('inboxTupId').value.trim().toUpperCase();
  var password = document.getElementById('inboxPassword').value;
  if(!tupId) return;
  openCase(tupId, password);
}

function openCase(tupId, password){
  tupId = tupId.trim().toUpperCase();

  // If we already checked this password earlier in this browser tab
  // (e.g. right after submitting, or opening it once already), reuse
  // it so the student isn't asked again and again.
  if(!password){
    password = sessionStorage.getItem('pw_' + tupId) || '';
  }

  if(!password){
    showInboxError('Enter your TUP ID and password to open this case.');
    return;
  }

  var body = 'tup_id=' + encodeURIComponent(tupId) + '&password=' + encodeURIComponent(password);
  fetch('get_report.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: body
  })
    .then(function(response){
      return response.json();
    })
    .then(function(data){
      if(data.error){
        showInboxError(data.error);
        return;
      }

      // Correct TUP ID and password — remember it for this tab, and
      // build the local case from what the server sent back.
      sessionStorage.setItem('pw_' + tupId, password);

      var messages = [];
      for(var i = 0; i < data.messages.length; i++){
        var serverMessage = data.messages[i];
        var localFrom = serverMessage.from === 'student' ? 'you' : 'team';
        messages.push({ from: localFrom, text: serverMessage.text, time: serverMessage.time });
      }

      // data.submitted_at is a plain timestamp from the server — turn
      // it into this device's own local date/time for display.
      var submittedAtText = data.submitted_at ? formatSubmittedAt(new Date(data.submitted_at * 1000)) : '';

      INBOX_CASES[tupId] = {
        tupId: tupId,
        category: data.category,
        status: data.status,
        resolutionNote: data.resolution_note || '',
        location: data.location || '',
        submittedAtText: submittedAtText,
        displayName: data.display_name || '',
        messages: messages
      };

      showCaseThread(tupId);

      if(data.status === 'resolved' && data.resolution_note){
        showResolvedModal(data.resolution_note);
      }
    })
    .catch(function(){
      showInboxError('Something went wrong opening your inbox. Please try again.');
    });
}

// Shows the thread for the one case the student just unlocked, and
// swaps away from the locked popup view.
function showCaseThread(tupId){
  CURRENT_CASE = tupId;
  document.getElementById('inboxLockedSection').hidden = true;
  document.getElementById('inboxContentSection').hidden = false;

  var c = INBOX_CASES[tupId];
  document.getElementById('threadTupId').textContent = c.tupId;
  document.getElementById('threadCat').textContent = c.category;
  document.getElementById('threadLocation').textContent = c.location || '';
  document.getElementById('threadSubmitted').textContent = c.submittedAtText ? ('Submitted ' + c.submittedAtText) : '';
  var statusEl = document.getElementById('threadStatus');
  statusEl.textContent = STATUS_LABEL[c.status];
  statusEl.className = 'thread-status status-pill ' + STATUS_CLASS[c.status];

  renderThreadMessages();
}

// Resets the Inbox page back to its locked state, so the TUP ID and
// password are required again next time it's opened.
function lockInbox(){
  CURRENT_CASE = null;
  document.getElementById('inboxLockedSection').hidden = false;
  document.getElementById('inboxContentSection').hidden = true;
  document.getElementById('inboxTupId').value = '';
  document.getElementById('inboxPassword').value = '';
  showInboxError('');
}

// Shows the popup with the staff-written message for a resolved case.
function showResolvedModal(message){
  document.getElementById('resolvedModalMessage').textContent = message;
  document.getElementById('resolvedModal').hidden = false;
}

function closeResolvedModal(){
  document.getElementById('resolvedModal').hidden = true;
}

function showInboxError(msg){
  var el = document.getElementById('inboxUnlockError');
  if(el) el.textContent = msg;
}

function renderThreadMessages(){
  var c = INBOX_CASES[CURRENT_CASE];
  var wrap = document.getElementById('threadMessages');
  wrap.innerHTML = c.messages.map(function(m){
    var cls = m.from === 'you' ? 'msg-you' : 'msg-team';
    return '<div class="msg ' + cls + '">' + escapeHtml(m.text) + '<span class="msg-time">' + m.time + '</span></div>';
  }).join('');
  wrap.scrollTop = wrap.scrollHeight;
}

function sendReply(e){
  e.preventDefault();
  if(!CURRENT_CASE) return;
  var input = document.getElementById('threadReplyInput');
  var text = input.value.trim();
  if(!text) return;
  var c = INBOX_CASES[CURRENT_CASE];
  c.messages.push({ from:'you', text:text, time:'Just now' });
  if(c.status === 'received') c.status = 'review';
  input.value = '';
  renderThreadMessages();

  // Also send this message to the shared admin backend, so staff
  // see it on their dashboard too. We reuse the password this tab
  // already checked when the case was opened.
  var password = sessionStorage.getItem('pw_' + CURRENT_CASE) || '';
  var replyBody = 'tup_id=' + encodeURIComponent(CURRENT_CASE) + '&text=' + encodeURIComponent(text) + '&password=' + encodeURIComponent(password);
  fetch('student_reply.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: replyBody
  });

  setTimeout(function(){
    c.messages.push({ from:'team', text:"Got it — this has been added to your case. A reviewer will read it and respond as soon as they can.", time:'Just now' });
    c.status = 'replied';
    if(CURRENT_CASE === c.tupId){
      renderThreadMessages();
      var statusEl = document.getElementById('threadStatus');
      statusEl.textContent = STATUS_LABEL[c.status];
      statusEl.className = 'thread-status status-pill ' + STATUS_CLASS[c.status];
    }
  }, 900);
}

function escapeHtml(str){
  var div = document.createElement('div');
  div.textContent = str;
  return div.innerHTML;
}

/* ================= ASSESS YOURSELF QUIZ ================= */
var QUIZ = [
  {
    q:"In the classroom scenario, a classmate keeps touching another student even after they've made it clear they're uncomfortable. Which law most directly covers harassment happening in an educational setting like this?",
    options:[
      "RA 9262 (Anti-VAWC Law)",
      "RA 11313 (Safe Spaces Act)",
      "RA 7877 (Anti-Sexual Harassment Act)",
      "No law covers this since they're just classmates"
    ],
    correct:1,
    explain:"RA 11313 (Safe Spaces Act) explicitly covers gender-based harassment in streets, public spaces, online, and educational or workplace settings — including between peers, not just strangers.",
    qTL:"Sa sitwasyon sa silid-aralan, patuloy na hinihipo ng isang kaklase ang kapwa estudyante kahit malinaw na nailahad na nito ang kanilang kawalan ng ginhawa. Aling batas ang direktang sumasaklaw sa panliligalig na nagaganap sa isang institusyong pang-edukasyon tulad nito?",
    optionsTL:[
      "RA 9262 (Anti-VAWC Law)",
      "RA 11313 (Safe Spaces Act)",
      "RA 7877 (Anti-Sexual Harassment Act)",
      "Walang batas na sumasaklaw dito dahil magkaklase lamang sila"
    ],
    explainTL:"Malinaw na sinasaklaw ng RA 11313 (Safe Spaces Act) ang gender-based na panliligalig sa mga kalye, pampublikong lugar, online, at sa paaralan o pinagtatrabahuhan — kabilang na ang sa pagitan ng magkapantay, hindi lamang sa mga estranghero."
  },
  {
    q:"Based on that same classroom scenario, what's a reasonable first step for the student?",
    options:[
      "Confront the classmate in front of everyone",
      "Move to a safer space and reach out to someone they trust, like a teacher or the GAD office",
      "Say nothing and avoid the classmate for the rest of the term",
      "Post about it online to warn others"
    ],
    correct:1,
    explain:"Moving to safety first and reaching out to a trusted person, teacher, or the GAD office keeps the student safe while opening the door to support — there's no obligation to confront anyone directly.",
    qTL:"Batay sa parehong sitwasyon sa silid-aralan, ano ang makatwirang unang hakbang para sa estudyante?",
    optionsTL:[
      "Harapin ang kaklase sa harap ng lahat",
      "Lumipat sa mas ligtas na lugar at lumapit sa taong pinagkakatiwalaan nito, tulad ng guro o ng tanggapan ng GAD",
      "Manahimik na lang at iwasan ang kaklase sa buong semestre",
      "I-post ito online upang bigyang-babala ang iba"
    ],
    explainTL:"Ang paglipat muna sa ligtas na lugar at paglapit sa isang pinagkakatiwalaang tao, guro, o sa tanggapan ng GAD ay nagpapanatiling ligtas ang estudyante habang binubuksan ang pinto para sa suporta — walang obligasyong harapin ang sinuman nang direkta."
  },
  {
    q:"In the faculty scenario, a professor uses their position to pressure a student. Which law specifically addresses harassment by someone who holds authority or moral ascendancy over another person?",
    options:[
      "RA 9262 (Anti-VAWC Law)",
      "RA 11313 (Safe Spaces Act)",
      "RA 7877 (Anti-Sexual Harassment Act)",
      "None — professors are exempt due to academic freedom"
    ],
    correct:2,
    explain:"RA 7877 (Anti-Sexual Harassment Act) addresses harassment by someone who holds authority, influence, or moral ascendancy — like a supervisor, adviser, or professor — over the person affected.",
    qTL:"Sa sitwasyon sa faculty, ginagamit ng isang propesor ang kanyang posisyon upang pilitin ang isang estudyante. Aling batas ang partikular na tumutugon sa panliligalig ng isang taong may awtoridad o moral ascendancy sa iba?",
    optionsTL:[
      "RA 9262 (Anti-VAWC Law)",
      "RA 11313 (Safe Spaces Act)",
      "RA 7877 (Anti-Sexual Harassment Act)",
      "Wala — hindi saklaw ang mga propesor dahil sa academic freedom"
    ],
    explainTL:"Tinutugunan ng RA 7877 (Anti-Sexual Harassment Act) ang panliligalig ng isang taong may awtoridad, impluwensya, o moral ascendancy — tulad ng superbisor, adviser, o propesor — sa taong apektado."
  },
  {
    q:"If a professor crosses a personal boundary, what's a reasonable step a student can take?",
    options:[
      "Confront the professor immediately in class",
      "Save messages or details if it's safe to, and seek confidential support",
      "Assume nothing can be done because of the professor's authority",
      "Drop the class without telling anyone why"
    ],
    correct:1,
    explain:"Power gaps make these situations hard to navigate alone. Saving details when it's safe to, and reaching out for confidential support, keeps options open without requiring a direct confrontation.",
    qTL:"Kung lumabag ang isang propesor sa personal na hangganan, ano ang makatwirang hakbang na maaaring gawin ng estudyante?",
    optionsTL:[
      "Harapin agad ang propesor sa klase",
      "I-save ang mga mensahe o detalye kung ligtas gawin ito, at humingi ng kumpidensyal na suporta",
      "Ipagpalagay na walang magagawa dahil sa awtoridad ng propesor",
      "Mag-drop ng klase nang hindi ipinapaalam kaninuman ang dahilan"
    ],
    explainTL:"Ang agwat sa kapangyarihan ay nagpapahirap harapin ang ganitong sitwasyon nang mag-isa. Ang pag-save ng detalye kung ligtas gawin ito, at ang paghingi ng kumpidensyal na suporta, ay nagpapanatiling bukas ang mga opsyon nang hindi kinakailangan ang direktang pagharap."
  },
  {
    q:"The online scenario shows a class group chat being used to harass a student. Which law extends harassment protections specifically into online spaces?",
    options:[
      "RA 9262 (Anti-VAWC Law)",
      "RA 11313 (Safe Spaces Act)",
      "RA 7877 (Anti-Sexual Harassment Act)",
      "No Philippine law currently covers online harassment"
    ],
    correct:1,
    explain:"RA 11313 (Safe Spaces Act) explicitly names online spaces as one of its four covered settings, alongside streets, public spaces, and educational or workplace settings.",
    qTL:"Ipinapakita ng sitwasyong online na ginagamit ang class group chat upang ligaligin ang isang estudyante. Aling batas ang partikular na nagpapalawig ng proteksyon laban sa panliligalig sa online na espasyo?",
    optionsTL:[
      "RA 9262 (Anti-VAWC Law)",
      "RA 11313 (Safe Spaces Act)",
      "RA 7877 (Anti-Sexual Harassment Act)",
      "Walang batas sa Pilipinas na sumasaklaw sa online na panliligalig sa kasalukuyan"
    ],
    explainTL:"Malinaw na binabanggit ng RA 11313 (Safe Spaces Act) ang online na espasyo bilang isa sa apat nitong saklaw na lugar, kasama ang mga kalye, pampublikong lugar, at paaralan o pinagtatrabahuhan."
  },
  {
    q:"If a class group chat becomes a place for harassment, what's a reasonable first step?",
    options:[
      "Reply and defend yourself publicly in the chat",
      "Save screenshots and consider blocking or muting the sender",
      "Leave the chat and never mention it to anyone",
      "Nothing can be done about online harassment"
    ],
    correct:1,
    explain:"Saving evidence and blocking or muting are valid, safe first steps. There's no obligation to engage with or respond to the person sending it.",
    qTL:"Kung naging lugar ng panliligalig ang isang class group chat, ano ang makatwirang unang hakbang?",
    optionsTL:[
      "Sumagot at ipagtanggol ang sarili nang lantaran sa chat",
      "Mag-save ng screenshots at isaalang-alang ang pag-block o pag-mute sa nagpadala",
      "Umalis sa chat at huwag na itong banggitin kaninuman",
      "Walang magagawa tungkol sa online na panliligalig"
    ],
    explainTL:"Ang pag-save ng ebidensya at pag-block o pag-mute ay wasto at ligtas na unang hakbang. Walang obligasyong makipag-ugnayan o sumagot sa taong nagpapadala nito."
  },
  {
    q:"In the student life scenario, someone is pressured by a partner into something they don't want, causing them distress. If the pressure comes from a partner, which law could apply?",
    options:[
      "RA 9262 (Anti-VAWC Law)",
      "RA 11313 (Safe Spaces Act)",
      "RA 7877 (Anti-Sexual Harassment Act)",
      "None, since no physical violence occurred"
    ],
    correct:0,
    explain:"RA 9262 covers physical, sexual, psychological, and economic abuse committed by a spouse, ex-spouse, or partner — even without marriage or a shared home. Psychological pressure from a partner falls within its scope.",
    qTL:"Sa sitwasyon ng buhay-estudyante, may taong pinipilit ng kapareha na gumawa ng bagay na ayaw nila, na nagdudulot sa kanila ng pagkabalisa. Kung ang panggigipit ay mula sa kapareha, aling batas ang maaaring umangkop?",
    optionsTL:[
      "RA 9262 (Anti-VAWC Law)",
      "RA 11313 (Safe Spaces Act)",
      "RA 7877 (Anti-Sexual Harassment Act)",
      "Wala, dahil walang naganap na pisikal na karahasan"
    ],
    explainTL:"Sinasaklaw ng RA 9262 ang pisikal, sekswal, sikolohikal, at ekonomikong pang-aabuso na ginawa ng asawa, dating asawa, o kapareha — kahit walang kasal o hindi magkasamang tirahan. Ang sikolohikal na panggigipit mula sa kapareha ay saklaw nito."
  },
  {
    q:"True or false: if someone says yes only because they felt pressured, that still counts as consent.",
    options:[
      "True — a yes is a yes no matter the circumstances",
      "False — consent given under pressure isn't the same as consent given freely",
      "True, as long as they didn't say no",
      "It depends on who is asking"
    ],
    correct:1,
    explain:"Real consent has to be freely given. Pressure, guilt-tripping, or persistence can make it difficult or impossible to give consent freely — and someone can change their mind at any point, even after saying yes.",
    qTL:"Tama o mali: kung sumang-ayon ang isang tao dahil lamang sa naramdaman nilang napipilitan, itinuturing pa rin itong pahintulot.",
    optionsTL:[
      "Tama — ang oo ay oo anuman ang sitwasyon",
      "Mali — ang pahintulot na ibinigay dahil sa pamimilit ay hindi katumbas ng pahintulot na malayang ibinigay",
      "Tama, hangga't hindi sila tumanggi",
      "Depende ito sa kung sino ang nagtatanong"
    ],
    explainTL:"Ang tunay na pahintulot ay dapat malayang ibinigay. Ang pamimilit, panggigipit, o patuloy na pag-uudyok ay maaaring magpahirap o magpaimposible na magbigay ng malayang pahintulot — at maaaring magbago ng isip ang sinuman anumang oras, kahit pagkatapos sumang-ayon."
  },
  {
    q:"The bystander scenario involves someone noticing harassment that isn't happening to them directly. How does the Safe Spaces Act's framing of accountability apply here?",
    options:[
      "Only the person directly harassed has any role to play",
      "The law's protections only apply once a formal complaint is filed by the victim",
      "Harassment is treated as a shared community concern, not just a private matter between two people",
      "Bystanders are legally required to intervene directly"
    ],
    correct:2,
    explain:"The Safe Spaces Act frames gender-based harassment as a public accountability issue, not just a private dispute — which is part of why bystanders reporting or supporting someone they've witnessed being harassed is meaningful, even without confronting anyone.",
    qTL:"Kasama sa sitwasyon bilang saksi ang isang taong napapansin ang panliligalig na hindi direktang nangyayari sa kanila. Paano naaangkop dito ang paraan ng Safe Spaces Act sa pananagutan?",
    optionsTL:[
      "Tanging ang taong direktang niligalig lamang ang may gampanin",
      "Ang proteksyon ng batas ay saklaw lamang kapag nagsampa na ng pormal na reklamo ang biktima",
      "Ang panliligalig ay itinuturing na kolektibong alalahanin ng komunidad, hindi lamang pribadong usapin sa pagitan ng dalawang tao",
      "Legal na kinakailangan ng mga saksi na direktang manghimasok"
    ],
    explainTL:"Itinuturing ng Safe Spaces Act ang gender-based na panliligalig bilang isyu ng pampublikong pananagutan, hindi lamang pribadong alitan — kaya naman may kabuluhan ang pag-uulat o pagsuporta ng saksi sa taong nasaksihan nilang niligalig, kahit walang harapan."
  },
  {
    q:"If you witness someone being harassed on campus, what's a safe way to help?",
    options:[
      "Confront the person responsible directly",
      "Ignore it — it's not your problem",
      "Check in with the person affected, or help them find support, if it's safe to do so",
      "Record it and post it online"
    ],
    correct:2,
    explain:"You don't have to confront anyone directly to help. A quiet check-in, or helping someone reach support or the right reporting channel, can make a real difference — safely.",
    qTL:"Kung nasaksihan mong may niligalig sa kampus, ano ang ligtas na paraan upang makatulong?",
    optionsTL:[
      "Direktang harapin ang taong may kagagawan",
      "Balewalain ito — hindi mo problema iyan",
      "Tanungin kung okay lang ang taong apektado, o tulungan silang makahanap ng suporta, kung ligtas gawin ito",
      "I-record ito at i-post online"
    ],
    explainTL:"Hindi mo kailangang direktang harapin ang sinuman upang makatulong. Ang tahimik na pagtatanong kung okay lang, o ang pagtulong sa isang tao na makarating sa tamang suporta o reporting channel, ay maaaring magdulot ng tunay na pagbabago — nang ligtas."
  }
];

var quizIndex = 0;
var quizScore = 0;
var quizAnswers = [];

function startQuiz(){
  quizIndex = 0;
  quizScore = 0;
  quizAnswers = [];
  document.getElementById('quizPlay').hidden = false;
  document.getElementById('quizResults').hidden = true;
  renderQuestion();
}

function renderQuestion(){
  var item = QUIZ[quizIndex];
  var questionText = (currentLang === 'tl' && item.qTL) ? item.qTL : item.q;
  var optionsList = (currentLang === 'tl' && item.optionsTL) ? item.optionsTL : item.options;

  document.getElementById('quizQuestion').textContent = questionText;
  document.getElementById('quizProgressFill').style.width = (((quizIndex) / QUIZ.length) * 100) + '%';
  document.getElementById('quizProgressLabel').textContent = (currentLang === 'tl')
    ? 'Tanong ' + (quizIndex + 1) + ' sa ' + QUIZ.length
    : 'Question ' + (quizIndex + 1) + ' of ' + QUIZ.length;

  var optsWrap = document.getElementById('quizOptions');
  optsWrap.innerHTML = '';
  optionsList.forEach(function(opt, i){
    var btn = document.createElement('button');
    btn.className = 'quiz-option';
    btn.textContent = opt;
    btn.onclick = function(){ selectAnswer(i); };
    optsWrap.appendChild(btn);
  });

  document.getElementById('quizFeedback').hidden = true;
  document.getElementById('quizNextBtn').hidden = true;
}

function selectAnswer(i){
  var item = QUIZ[quizIndex];
  var optionsList = (currentLang === 'tl' && item.optionsTL) ? item.optionsTL : item.options;
  var explainText = (currentLang === 'tl' && item.explainTL) ? item.explainTL : item.explain;
  var questionText = (currentLang === 'tl' && item.qTL) ? item.qTL : item.q;

  var buttons = document.querySelectorAll('#quizOptions .quiz-option');
  buttons.forEach(function(b, idx){
    b.disabled = true;
    if(idx === item.correct) b.classList.add('correct');
    else if(idx === i) b.classList.add('incorrect');
  });

    var isCorrect = (i === item.correct);
  if(isCorrect) quizScore++;
  quizAnswers.push({ correct:isCorrect, q:questionText, explain:explainText, answer:optionsList[item.correct], userAnswer:optionsList[i] });

  var feedback = document.getElementById('quizFeedback');
  feedback.hidden = false;
  var correctPrefix = (currentLang === 'tl') ? '✅ Tama — ' : '✅ Correct — ';
  feedback.textContent = (isCorrect ? correctPrefix : '↳ ') + explainText;

  var nextBtn = document.getElementById('quizNextBtn');
  nextBtn.hidden = false;
  var isLastQuestion = (quizIndex === QUIZ.length - 1);
  if(currentLang === 'tl'){
    nextBtn.textContent = isLastQuestion ? 'Tingnan ang resulta' : 'Susunod na tanong';
  } else {
    nextBtn.textContent = isLastQuestion ? 'See your results' : 'Next question';
  }
}

function nextQuestion(){
  quizIndex++;
  if(quizIndex >= QUIZ.length){
    showResults();
  } else {
    renderQuestion();
  }
}

function showResults(){
  document.getElementById('quizPlay').hidden = true;
  document.getElementById('quizResults').hidden = false;
  document.getElementById('quizProgressFill').style.width = '100%';

  document.getElementById('resultScore').textContent = quizScore + '/' + QUIZ.length;

    var title, message;
  if(currentLang === 'tl'){
    if(quizScore <= 2){ title = "Tayo-tayo nating paunlarin ang kaalamang iyan."; message = "Okay lang iyan — hindi laging malinaw itinuturo ang mga bagay na ito. Tingnan ang Alamin ang Iyong mga Karapatan, at tandaan na nandito ang CIEcured kapag handa ka na."; }
    else if(quizScore <= 5){ title = "Papalapit ka na."; message = "Marunong ka na sa mga pangunahing bagay, may ilang puwang lang na dapat punan. Isang mabilisang pagtingin sa Alamin ang Iyong mga Karapatan ang makakatulong dito."; }
    else if(quizScore <= 7){ title = "Matatag ang pagkaunawa mo sa iyong mga karapatan."; message = "Malinaw mong alam ang karamihan ng mahalagang bagay dito — ilang detalye na lang ang dapat linawin."; }
    else if(quizScore <= 9){ title = "Kilala mo nang mabuti ang iyong mga karapatan."; message = "Isang malakas na resulta iyan. Nauunawaan mo pareho ang mga proteksyong available sa iyo at kung paano kumilos batay dito."; }
    else { title = "Alam mo na nang lubusan ang iyong mga karapatan."; message = "Perpektong iskor. Malinaw mong nauunawaan ang mga batas, ang mga sitwasyon, at kung ano ang dapat gawin sa bawat isa."; }
  } else {
    if(quizScore <= 2){ title = "Let's build that knowledge together."; message = "That's alright — this stuff isn't always taught clearly. Take a look through Know Your Rights, and remember CIEcured is here whenever you're ready."; }
    else if(quizScore <= 5){ title = "You're getting there."; message = "You've got a decent handle on the basics, with a few gaps worth closing. A quick look at Know Your Rights should fill them in."; }
    else if(quizScore <= 7){ title = "Solid grasp of your rights."; message = "You clearly know most of what matters here — just a few details to sharpen."; }
    else if(quizScore <= 9){ title = "You know your rights well."; message = "That's a strong result. You understand both the protections available to you and how to act on them."; }
    else { title = "You know your rights inside and out."; message = "A perfect score. You clearly understand the laws, the scenarios, and what to do in each one."; }
  }

  document.getElementById('resultTitle').textContent = title;
  document.getElementById('resultMessage').textContent = message;

  var recap = document.getElementById('resultRecap');
  recap.innerHTML = quizAnswers.map(function(a, i){
    var cls = a.correct ? 'right' : 'wrong';
    var icon = a.correct
      ? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>'
      : '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><line x1="12" y1="8" x2="12" y2="13"/><circle cx="12" cy="16" r=".5"/></svg>';
		var body = '<div class="recap-q">' + (i+1) + '. ' + a.q + '</div>';
    if(!a.correct){
      var yourAnswerLabel = (currentLang === 'tl') ? 'Sagot mo: ' : 'Your answer: ';
      body += '<div class="recap-your">' + yourAnswerLabel + a.userAnswer + '</div>';
    }
    var correctAnswerLabel = (currentLang === 'tl') ? 'Tamang sagot: ' : 'Correct answer: ';
    body += '<div class="recap-correct">' + correctAnswerLabel + a.answer + '</div>';
    return '<div class="recap-row ' + cls + '">' + icon + '<div class="recap-body">' + body + '</div></div>';
  }).join('');
}

/* ================= CHAT WIDGET ================= */
var chatOpened = false;
var CHAT_QUICK_REPLIES = ["How do I report?", "Is it anonymous?", "Track my report", "I need help now"];

function toggleChat(){
  var panel = document.getElementById('chatPanel');
  var iconOpen = document.getElementById('chatIconOpen');
  var iconClose = document.getElementById('chatIconClose');
  var willOpen = panel.hidden;
  panel.hidden = !willOpen;
  iconOpen.hidden = willOpen;
  iconClose.hidden = !willOpen;

  if(willOpen && !chatOpened){
    chatOpened = true;
    appendChatMsg('bot', "Hi, I'm here to help you find your way around CIEcured. Ask me about reporting, your rights, or tracking a case.");
    appendChatMsg('bot', "If you're in immediate danger, please call 911 or your local emergency line first.");
    renderChatQuick();
  }
  if(willOpen) document.getElementById('chatInput').focus();
}

function renderChatQuick(){
  var wrap = document.getElementById('chatQuick');
  wrap.innerHTML = '';
  CHAT_QUICK_REPLIES.forEach(function(q){
    var btn = document.createElement('button');
    btn.textContent = q;
    btn.onclick = function(){ handleChatMessage(q); };
    wrap.appendChild(btn);
  });
}

function appendChatMsg(who, text){
  var body = document.getElementById('chatBody');
  var div = document.createElement('div');
  div.className = 'chat-msg ' + who;
  div.textContent = text;
  body.appendChild(div);
  body.scrollTop = body.scrollHeight;
}

function sendChat(e){
  e.preventDefault();
  var input = document.getElementById('chatInput');
  var text = input.value.trim();
  if(!text) return;
  input.value = '';
  handleChatMessage(text);
}

function handleChatMessage(text){
  appendChatMsg('user', text);
  var lower = text.toLowerCase();
  var reply = botReply(lower);
  setTimeout(function(){ appendChatMsg('bot', reply); }, 500);
}

function botReply(lower){
  if(/(danger|emergency|unsafe|hurt now|help now)/.test(lower)){
    return "If you or someone else is in immediate danger, please call 911 or your local emergency line right now — that comes before anything on this site.";
  }
  if(/(anonymous|hide my name|identity)/.test(lower)){
    return "Yes — you can submit a report anonymously. You'll still use your TUP ID and a password you set so you can read replies and add details later, without ever sharing your name.";
  }
  if(/(track|code|status|inbox)/.test(lower)){
    return "You can open your Inbox and enter your TUP ID to see replies and send a message. Want me to take you there?";
  }
  if(/(report|submit|file a)/.test(lower)){
    return "You can start a report from the Report a Concern section — it takes about three minutes and you choose anonymous or named. Want me to scroll you there?";
  }
  if(/(right|law|ra 9262|ra 11313|ra 7877|9262|11313|7877)/.test(lower)){
    return "The Know Your Rights section breaks down RA 9262, RA 11313, and RA 7877 in plain language. There's also a short Assess Yourself quiz if you want to check your understanding.";
  }
  if(/(quiz|assess|test my)/.test(lower)){
    return "The Assess Yourself page has 10 quick questions with instant feedback and a score at the end — no wrong turns, just a way to check your understanding.";
  }
  if(/(hi|hello|hey)/.test(lower)){
    return "Hello! You can ask me about reporting, your rights, or tracking an existing case.";
  }
  return "I might not have a perfect answer for that, but I can point you to reporting, your rights, or tracking a case — or you can use the quick replies below.";
}

/* ================= INIT ================= */
applyLanguage();
