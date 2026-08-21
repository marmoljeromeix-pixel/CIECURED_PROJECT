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
  if(name === 'inbox') renderInboxList();
  closeMobileNav();
}

function goHome(e, anchor){
  if(e) e.preventDefault();
  Object.keys(PAGE_IDS).forEach(function(key){
    var el = document.getElementById(PAGE_IDS[key]);
    if(el) el.hidden = (key !== 'home');
  });
  setActiveNav('home');
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
function setMode(btn){
  document.querySelectorAll('.toggle-row button').forEach(function(b){ b.classList.remove('active'); });
  btn.classList.add('active');
}

function genCode(){
  var chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
  var part = '';
  for(var i=0;i<4;i++){ part += chars[Math.floor(Math.random()*chars.length)]; }
  var num = Math.floor(Math.random()*90)+10;
  return 'CIE-' + part + '-' + num;
}

function submitReport(){
  var btn = event.target;
  var cat = document.getElementById('cat').value;
  var desc = document.getElementById('desc').value.trim();

  if(!cat || cat.indexOf('Select') === 0){
    flashButton(btn, 'Please choose a category', '#C9584F');
    return;
  }

  var code = genCode();
  var now = 'Just now';
  INBOX_CASES[code] = {
    code: code,
    category: cat,
    status: 'received',
    messages: [
      { from:'you', text: desc || '(No description provided)', time: now },
      { from:'team', text:"Thanks for reaching out. We've received your report and a trained reviewer will follow up here soon. You can check back anytime with your tracking code.", time: now }
    ]
  };

  document.getElementById('desc').value = '';
  document.getElementById('cat').value = 'Select a category…';

  flashButton(btn, 'Submitted — check your Inbox', '#5D8C6B');

  var result = document.getElementById('reportResult');
  result.hidden = false;
  result.innerHTML =
    '<div class="code-result show" style="display:block; margin-top:22px;">' +
    'Your tracking code: <span>' + code + '</span>' +
    '<button class="btn btn-outline" style="display:block; margin-top:12px; width:100%;" onclick="showPage(event,\'inbox\'); setTimeout(function(){ openCase(\'' + code + '\'); }, 50);">Open in Inbox</button>' +
    '</div>';
}

function flashButton(btn, msg, color){
  var original = btn.textContent;
  btn.textContent = msg;
  btn.style.background = color;
  setTimeout(function(){ btn.textContent = original; btn.style.background = ''; }, 2600);
}

function trackReport(){
  var code = document.getElementById('code').value.trim().toUpperCase();
  var result = document.getElementById('codeResult');
  if(!code){
    result.textContent = 'Enter a tracking code above to continue.';
  } else {
    result.innerHTML = 'Opening ' + code + ' in your Inbox…';
    setTimeout(function(){
      showPage(null, 'inbox');
      openCase(code);
    }, 400);
  }
  result.classList.add('show');
}

/* ================= INBOX ================= */
var INBOX_CASES = {
  'CIE-7X4K-92': {
    code:'CIE-7X4K-92', category:'Harassment', status:'review',
    messages:[
      { from:'you', text:"I wanted to report repeated unwanted messages from a classmate. It's been happening for about two weeks.", time:'3 days ago' },
      { from:'team', text:"Thank you for trusting us with this. We've logged your report and it's now with a trained reviewer. Could you share roughly when the messages started, if you're comfortable?", time:'2 days ago' }
    ]
  },
  'CIE-3B2P-14': {
    code:'CIE-3B2P-14', category:'Online / digital harassment', status:'replied',
    messages:[
      { from:'you', text:"Someone has been posting about me online without my consent.", time:'6 days ago' },
      { from:'team', text:"We understand, and we're glad you reported this. A reviewer has reached out to the platform's safety team. We'll update you here as soon as we hear back.", time:'5 days ago' },
      { from:'you', text:"Thank you. Is there anything I should do in the meantime?", time:'4 days ago' },
      { from:'team', text:"Try to keep screenshots as evidence, and avoid engaging directly. We'll follow up within 2 business days.", time:'4 days ago' }
    ]
  },
  'CIE-9Q1M-77': {
    code:'CIE-9Q1M-77', category:'Other safeguarding concern', status:'resolved',
    messages:[
      { from:'you', text:"I had a concern about a situation in one of my classes.", time:'3 weeks ago' },
      { from:'team', text:"Thanks for flagging this. We looked into it with the department and appropriate steps have been taken.", time:'2 weeks ago' },
      { from:'you', text:"That's a relief to hear, thank you.", time:'2 weeks ago' },
      { from:'team', text:"Anytime. This case is now marked resolved — feel free to reopen it here if anything changes.", time:'2 weeks ago' }
    ]
  }
};

var CURRENT_CASE = null;
var INBOX_FILTER = 'all';

var STATUS_LABEL = { received:'Received', review:'Under review', replied:'Replied', resolved:'Resolved' };
var STATUS_CLASS = { received:'status-received', review:'status-review', replied:'status-replied', resolved:'status-resolved' };

function setInboxFilter(btn, filter){
  document.querySelectorAll('#inboxFilters button').forEach(function(b){ b.classList.remove('active'); });
  btn.classList.add('active');
  INBOX_FILTER = filter;
  renderInboxList();
}

function renderInboxList(){
  var list = document.getElementById('inboxList');
  if(!list) return;
  var codes = Object.keys(INBOX_CASES);
  var filtered = codes.filter(function(c){
    var status = INBOX_CASES[c].status;
    if(INBOX_FILTER === 'all') return true;
    if(INBOX_FILTER === 'resolved') return status === 'resolved';
    if(INBOX_FILTER === 'active') return status !== 'resolved';
    return true;
  });

  if(filtered.length === 0){
    list.innerHTML = '<p style="font-size:13px; color:var(--grey-soft); padding:12px 4px;">No cases in this view yet.</p>';
    return;
  }

  list.innerHTML = filtered.map(function(code){
    var c = INBOX_CASES[code];
    var last = c.messages[c.messages.length - 1];
    var selected = CURRENT_CASE === code ? ' selected' : '';
    return '<button class="inbox-item' + selected + '" onclick="openCase(\'' + code + '\')">' +
      '<div class="inbox-item-top">' +
        '<span class="inbox-item-code">' + code + '</span>' +
        '<span class="status-pill ' + STATUS_CLASS[c.status] + '">' + STATUS_LABEL[c.status] + '</span>' +
      '</div>' +
      '<div class="inbox-item-cat">' + c.category + '</div>' +
      '<div class="inbox-item-snippet">' + last.text + '</div>' +
    '</button>';
  }).join('');
}

function openCaseFromInput(){
  var code = document.getElementById('inboxCode').value.trim().toUpperCase();
  if(!code) return;
  openCase(code);
}

function openCase(code){
  code = code.trim().toUpperCase();
  if(!INBOX_CASES[code]){
    INBOX_CASES[code] = {
      code: code, category:'General inquiry', status:'received',
      messages:[
        { from:'team', text:"We couldn't find an existing case for this code, so we've opened a fresh one for you. If you meant to continue a previous report, double-check the code and try again.", time:'Just now' }
      ]
    };
  }
  CURRENT_CASE = code;
  document.getElementById('inboxEmpty').hidden = true;
  document.getElementById('inboxThread').hidden = false;

  var c = INBOX_CASES[code];
  document.getElementById('threadCode').textContent = c.code;
  document.getElementById('threadCat').textContent = c.category;
  var statusEl = document.getElementById('threadStatus');
  statusEl.textContent = STATUS_LABEL[c.status];
  statusEl.className = 'thread-status status-pill ' + STATUS_CLASS[c.status];

  renderThreadMessages();
  renderInboxList();
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
  renderInboxList();

  setTimeout(function(){
    c.messages.push({ from:'team', text:"Got it — this has been added to your case. A reviewer will read it and respond as soon as they can.", time:'Just now' });
    c.status = 'replied';
    if(CURRENT_CASE === c.code){
      renderThreadMessages();
      var statusEl = document.getElementById('threadStatus');
      statusEl.textContent = STATUS_LABEL[c.status];
      statusEl.className = 'thread-status status-pill ' + STATUS_CLASS[c.status];
    }
    renderInboxList();
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
    q:"Under RA 9262 (Anti-VAWC Law), which of the following counts as abuse?",
    options:[
      "Only physical violence",
      "Physical, sexual, psychological, and economic abuse",
      "Only actions committed by a legal spouse",
      "Only abuse that happens inside the home"
    ],
    correct:1,
    explain:"RA 9262 covers physical, sexual, psychological, and economic abuse — and applies to a spouse, ex-spouse, or partner, even without marriage or a shared home."
  },
  {
    q:"The Safe Spaces Act (RA 11313) covers harassment that happens…",
    options:[
      "Only in physical public spaces",
      "Only at the workplace",
      "In streets, public spaces, online, and educational or workplace settings",
      "Only between strangers"
    ],
    correct:2,
    explain:"RA 11313 covers gender-based harassment in streets, public spaces, online, and educational or workplace settings — including catcalling, stalking, and online harassment."
  },
  {
    q:"Under RA 7877 (Anti-Sexual Harassment Act), harassment typically involves someone who…",
    options:[
      "Has no connection to the person affected",
      "Holds authority, influence, or moral ascendancy over them",
      "Is always a stranger met online",
      "Is always a fellow student"
    ],
    correct:1,
    explain:"RA 7877 addresses harassment by someone who holds authority, influence, or moral ascendancy — like a supervisor or teacher — over the person affected."
  },
  {
    q:"If you're not ready to share your name, what can you do on CIEcured?",
    options:[
      "You can't report at all",
      "You must wait until you're ready to be identified",
      "You can submit an anonymous report and still receive updates",
      "Anonymous reports are automatically ignored"
    ],
    correct:2,
    explain:"You can report anonymously or by name — you're always in control, and anonymous reports can still be followed up through your private tracking code."
  },
  {
    q:"If you or someone else is in immediate danger, what should you do first?",
    options:[
      "Submit a CIEcured report and wait for a reply",
      "Call 911 or your local emergency line right away",
      "Post about it online",
      "Wait until the next business day"
    ],
    correct:1,
    explain:"CIEcured isn't an emergency line. In immediate danger, calling 911 or your local emergency number comes first."
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
  document.getElementById('quizQuestion').textContent = item.q;
  document.getElementById('quizProgressFill').style.width = (((quizIndex) / QUIZ.length) * 100) + '%';
  document.getElementById('quizProgressLabel').textContent = 'Question ' + (quizIndex + 1) + ' of ' + QUIZ.length;

  var optsWrap = document.getElementById('quizOptions');
  optsWrap.innerHTML = '';
  item.options.forEach(function(opt, i){
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
  var buttons = document.querySelectorAll('#quizOptions .quiz-option');
  buttons.forEach(function(b, idx){
    b.disabled = true;
    if(idx === item.correct) b.classList.add('correct');
    else if(idx === i) b.classList.add('incorrect');
  });

  var isCorrect = (i === item.correct);
  if(isCorrect) quizScore++;
  quizAnswers.push({ correct:isCorrect, q:item.q, explain:item.explain });

  var feedback = document.getElementById('quizFeedback');
  feedback.hidden = false;
  feedback.textContent = (isCorrect ? '✅ Correct — ' : '↳ ') + item.explain;

  var nextBtn = document.getElementById('quizNextBtn');
  nextBtn.hidden = false;
  nextBtn.textContent = (quizIndex === QUIZ.length - 1) ? 'See your results' : 'Next question';
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
  if(quizScore <= 1){ title = "Let's build that knowledge together."; message = "That's alright — this stuff isn't always taught clearly. Take a look through Know Your Rights, and remember CIEcured is here whenever you're ready."; }
  else if(quizScore <= 3){ title = "You're getting there."; message = "You've got a decent handle on the basics, with a few gaps worth closing. A quick look at Know Your Rights should fill them in."; }
  else if(quizScore === 4){ title = "Solid grasp of your rights."; message = "You clearly know most of what matters here — just one detail to sharpen."; }
  else { title = "You know your rights well."; message = "That's a strong result. You understand both the protections available to you and how to act on them."; }

  document.getElementById('resultTitle').textContent = title;
  document.getElementById('resultMessage').textContent = message;

  var recap = document.getElementById('resultRecap');
  recap.innerHTML = quizAnswers.map(function(a, i){
    var cls = a.correct ? 'right' : 'wrong';
    var icon = a.correct
      ? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>'
      : '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><line x1="12" y1="8" x2="12" y2="13"/><circle cx="12" cy="16" r=".5"/></svg>';
    return '<div class="recap-row ' + cls + '">' + icon + '<span>Q' + (i+1) + ': ' + a.q + '</span></div>';
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
    return "Yes — you can submit a report anonymously. You'll still get a private tracking code so you can read replies and add details later, without ever sharing your name.";
  }
  if(/(track|code|status|inbox)/.test(lower)){
    return "You can open your Inbox and enter your tracking code to see replies and send a message. Want me to take you there?";
  }
  if(/(report|submit|file a)/.test(lower)){
    return "You can start a report from the Report a Concern section — it takes about three minutes and you choose anonymous or named. Want me to scroll you there?";
  }
  if(/(right|law|ra 9262|ra 11313|ra 7877|9262|11313|7877)/.test(lower)){
    return "The Know Your Rights section breaks down RA 9262, RA 11313, and RA 7877 in plain language. There's also a short Assess Yourself quiz if you want to check your understanding.";
  }
  if(/(quiz|assess|test my)/.test(lower)){
    return "The Assess Yourself page has 5 quick questions with instant feedback and a score at the end — no wrong turns, just a way to check your understanding.";
  }
  if(/(hi|hello|hey)/.test(lower)){
    return "Hello! You can ask me about reporting, your rights, or tracking an existing case.";
  }
  return "I might not have a perfect answer for that, but I can point you to reporting, your rights, or tracking a case — or you can use the quick replies below.";
}

/* ================= INIT ================= */
renderInboxList();
