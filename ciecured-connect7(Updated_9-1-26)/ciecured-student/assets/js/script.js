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
  document.getElementById('nameField').hidden = (btn.textContent !== 'Named');
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
  var incidentDate = document.getElementById('incidentDate').value;
  var location = document.getElementById('location').value.trim();
  var password = document.getElementById('reportPassword').value;
  var isNamed = !document.getElementById('nameField').hidden;
  var displayName = isNamed ? document.getElementById('displayName').value.trim() : '';

  if(!cat || cat.indexOf('Select') === 0){
    flashButton(btn, 'Please choose a category', '#C9584F');
    return;
  }

  if(password.length < 4){
    flashButton(btn, 'Please set a password (4+ characters)', '#C9584F');
    return;
  }

  var code = genCode();
  var now = 'Just now';
  INBOX_CASES[code] = {
    code: code,
    category: cat,
    status: 'received',
    location: location || '—',
    incidentDate: incidentDate || '',
    displayName: displayName || '',
    messages: [
      { from:'you', text: desc || '(No description provided)', time: now },
      { from:'team', text:"Thanks for reaching out. We've received your report and a trained reviewer will follow up here soon. You can check back anytime with your tracking code and password.", time: now }
    ]
  };

  // This browser tab already knows the password, since it's the one
  // that just set it — save it so re-opening this case doesn't ask again.
  sessionStorage.setItem('pw_' + code, password);

  // Also send this report to the shared admin backend, using the
  // same tracking code, so staff can see it on their dashboard.
  var reportBody = 'code=' + encodeURIComponent(code) + '&category=' + encodeURIComponent(cat) + '&message=' + encodeURIComponent(desc || '(No description provided)') + '&password=' + encodeURIComponent(password);
  fetch('save_report.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: reportBody
  });

  document.getElementById('desc').value = '';
  document.getElementById('cat').value = 'Select a category…';
  document.getElementById('location').value = '';
  document.getElementById('incidentDate').value = '';
  document.getElementById('displayName').value = '';
  document.getElementById('reportPassword').value = '';

  flashButton(btn, 'Submitted — check your Inbox', '#5D8C6B');

  showCodeModal(code);
}

// Shows the tracking-code popup right after a report is submitted,
// reminding the student to save the code and remember their password.
function showCodeModal(code){
  document.getElementById('modalCodeValue').textContent = code;

  var openInboxBtn = document.getElementById('modalOpenInboxBtn');
  openInboxBtn.onclick = function(){
    closeCodeModal();
    showPage(null, 'inbox');
  };

  document.getElementById('codeModal').hidden = false;
}

function closeCodeModal(){
  document.getElementById('codeModal').hidden = true;
}

function flashButton(btn, msg, color){
  var original = btn.textContent;
  btn.textContent = msg;
  btn.style.background = color;
  setTimeout(function(){ btn.textContent = original; btn.style.background = ''; }, 2600);
}

function trackReport(){
  var code = document.getElementById('code').value.trim().toUpperCase();
  var password = document.getElementById('codePassword').value;
  var result = document.getElementById('codeResult');
  if(!code){
    result.textContent = 'Enter a tracking code above to continue.';
  } else if(!password){
    result.textContent = 'Enter your password too.';
  } else {
    result.innerHTML = 'Opening ' + code + ' in your Inbox…';
    setTimeout(function(){
      showPage(null, 'inbox');
      openCase(code, password);
    }, 400);
  }
  result.classList.add('show');
}

/* ================= INBOX ================= */
// Cases are no longer pre-loaded with sample data — every real case
// comes from the server once the student enters their code and
// password. This object just holds whatever case is currently open.
var INBOX_CASES = {};

var CURRENT_CASE = null;

var STATUS_LABEL = { received:'Received', review:'Under review', replied:'Replied', resolved:'Resolved' };
var STATUS_CLASS = { received:'status-received', review:'status-review', replied:'status-replied', resolved:'status-resolved' };

function openCaseFromInput(){
  var code = document.getElementById('inboxCode').value.trim().toUpperCase();
  var password = document.getElementById('inboxPassword').value;
  if(!code) return;
  openCase(code, password);
}

function openCase(code, password){
  code = code.trim().toUpperCase();

  // If we already checked this password earlier in this browser tab
  // (e.g. right after submitting, or opening it once already), reuse
  // it so the student isn't asked again and again.
  if(!password){
    password = sessionStorage.getItem('pw_' + code) || '';
  }

  if(!password){
    showInboxError('Enter your tracking code and password to open this case.');
    return;
  }

  var body = 'code=' + encodeURIComponent(code) + '&password=' + encodeURIComponent(password);
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

      // Correct code and password — remember it for this tab, and
      // build the local case from what the server sent back.
      sessionStorage.setItem('pw_' + code, password);

      var messages = [];
      for(var i = 0; i < data.messages.length; i++){
        var serverMessage = data.messages[i];
        var localFrom = serverMessage.from === 'student' ? 'you' : 'team';
        messages.push({ from: localFrom, text: serverMessage.text, time: serverMessage.time });
      }

      INBOX_CASES[code] = {
        code: code,
        category: data.category,
        status: data.status,
        resolutionNote: data.resolution_note || '',
        messages: messages
      };

      showCaseThread(code);

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
function showCaseThread(code){
  CURRENT_CASE = code;
  document.getElementById('inboxLockedSection').hidden = true;
  document.getElementById('inboxContentSection').hidden = false;

  var c = INBOX_CASES[code];
  document.getElementById('threadCode').textContent = c.code;
  document.getElementById('threadCat').textContent = c.category;
  document.getElementById('threadLocation').textContent = c.location || '';
  document.getElementById('threadDate').textContent = c.incidentDate ? new Date(c.incidentDate).toLocaleString() : '';
  var statusEl = document.getElementById('threadStatus');
  statusEl.textContent = STATUS_LABEL[c.status];
  statusEl.className = 'thread-status status-pill ' + STATUS_CLASS[c.status];

  renderThreadMessages();
}

// Resets the Inbox page back to its locked state, so code and
// password are required again next time it's opened.
function lockInbox(){
  CURRENT_CASE = null;
  document.getElementById('inboxLockedSection').hidden = false;
  document.getElementById('inboxContentSection').hidden = true;
  document.getElementById('inboxCode').value = '';
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
  var replyBody = 'code=' + encodeURIComponent(CURRENT_CASE) + '&text=' + encodeURIComponent(text) + '&password=' + encodeURIComponent(password);
  fetch('student_reply.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: replyBody
  });

  setTimeout(function(){
    c.messages.push({ from:'team', text:"Got it — this has been added to your case. A reviewer will read it and respond as soon as they can.", time:'Just now' });
    c.status = 'replied';
    if(CURRENT_CASE === c.code){
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
    explain:"RA 11313 (Safe Spaces Act) explicitly covers gender-based harassment in streets, public spaces, online, and educational or workplace settings — including between peers, not just strangers."
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
    explain:"Moving to safety first and reaching out to a trusted person, teacher, or the GAD office keeps the student safe while opening the door to support — there's no obligation to confront anyone directly."
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
    explain:"RA 7877 (Anti-Sexual Harassment Act) addresses harassment by someone who holds authority, influence, or moral ascendancy — like a supervisor, adviser, or professor — over the person affected."
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
    explain:"Power gaps make these situations hard to navigate alone. Saving details when it's safe to, and reaching out for confidential support, keeps options open without requiring a direct confrontation."
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
    explain:"RA 11313 (Safe Spaces Act) explicitly names online spaces as one of its four covered settings, alongside streets, public spaces, and educational or workplace settings."
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
    explain:"Saving evidence and blocking or muting are valid, safe first steps. There's no obligation to engage with or respond to the person sending it."
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
    explain:"RA 9262 covers physical, sexual, psychological, and economic abuse committed by a spouse, ex-spouse, or partner — even without marriage or a shared home. Psychological pressure from a partner falls within its scope."
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
    explain:"Real consent has to be freely given. Pressure, guilt-tripping, or persistence can make it difficult or impossible to give consent freely — and someone can change their mind at any point, even after saying yes."
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
    explain:"The Safe Spaces Act frames gender-based harassment as a public accountability issue, not just a private dispute — which is part of why bystanders reporting or supporting someone they've witnessed being harassed is meaningful, even without confronting anyone."
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
    explain:"You don't have to confront anyone directly to help. A quiet check-in, or helping someone reach support or the right reporting channel, can make a real difference — safely."
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
  quizAnswers.push({ correct:isCorrect, q:item.q, explain:item.explain, answer:item.options[item.correct], userAnswer:item.options[i] });

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
  if(quizScore <= 2){ title = "Let's build that knowledge together."; message = "That's alright — this stuff isn't always taught clearly. Take a look through Know Your Rights, and remember CIEcured is here whenever you're ready."; }
  else if(quizScore <= 5){ title = "You're getting there."; message = "You've got a decent handle on the basics, with a few gaps worth closing. A quick look at Know Your Rights should fill them in."; }
  else if(quizScore <= 7){ title = "Solid grasp of your rights."; message = "You clearly know most of what matters here — just a few details to sharpen."; }
  else if(quizScore <= 9){ title = "You know your rights well."; message = "That's a strong result. You understand both the protections available to you and how to act on them."; }
  else { title = "You know your rights inside and out."; message = "A perfect score. You clearly understand the laws, the scenarios, and what to do in each one."; }

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
      body += '<div class="recap-your">Your answer: ' + a.userAnswer + '</div>';
    }
    body += '<div class="recap-correct">Correct answer: ' + a.answer + '</div>';
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
