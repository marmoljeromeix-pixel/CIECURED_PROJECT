<?php
/**
 * CIEcured — Admin dashboard.
 *
 * Still a front-end mockup in the sense that there's no login and no
 * real database yet — but $CASES is no longer hardcoded. It's read
 * from the same shared store the student site writes to
 * (ciecured-data/reports.json via reports_lib.php), so a report a
 * student submits on the student site shows up here, and a reply
 * sent from here shows up in the student's tracking inbox.
 *
 * Each report is keyed by the student's TUP ID (category, status,
 * message thread). When MySQL is wired in, only reports_lib.php
 * needs to change.
 */

require __DIR__ . '/../ciecured-data/reports_lib.php';

$CASES = hydrate_all(load_reports());

// Small counts for the stat cards up top.
$total = 0;
$received = 0;
$review = 0;
$resolved = 0;

foreach ($CASES as $case) {
    $total = $total + 1;

    if ($case['status'] == 'received') {
        $received = $received + 1;
    }
    if ($case['status'] == 'review' || $case['status'] == 'replied') {
        $review = $review + 1;
    }
    if ($case['status'] == 'resolved') {
        $resolved = $resolved + 1;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin — CIEcured</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css">
<link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>

<!-- ============ TOP BAR ============ -->
<header class="admin-header">
  <div class="wrap">
    <a href="index.php" class="admin-brand">
      <span class="logo-mark">
        <img src="assets/img/logo.png" alt="CIEcured logo">
      </span>
      <span>
        CIEcured
        <small>Admin</small>
      </span>
    </a>
    <div class="admin-header-actions">
      <span class="admin-role-pill">
        <span class="avatar">GD</span>
        <span>GAD Reviewer</span>
      </span>
    </div>
  </div>
</header>

<main class="admin-main">
  <div class="wrap">

    <div class="admin-page-head">
      <div>
        <h1>Reports Dashboard</h1>
        <p>Every case submitted through CIEcured, in one place.</p>
      </div>
    </div>

    <!-- ============ STATS ============ -->
    <div class="stat-grid">
      <div class="stat-card accent">
        <div class="stat-label">Total reports</div>
        <div class="stat-value" id="statTotal"><?= $total ?></div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Newly received</div>
        <div class="stat-value" id="statReceived"><?= $received ?></div>
      </div>
      <div class="stat-card">
        <div class="stat-label">In progress</div>
        <div class="stat-value" id="statReview"><?= $review ?></div>
      </div>
      <div class="stat-card">
        <div class="stat-label">Resolved</div>
        <div class="stat-value" id="statResolved"><?= $resolved ?></div>
      </div>
    </div>

    <!-- ============ LIST + THREAD ============ -->
    <div class="inbox-grid">

      <div class="inbox-list-col">
        <div class="admin-toolbar">
          <input class="admin-search" id="adminSearch" type="text" placeholder="Search by TUP ID or category…" oninput="renderList()">
          <button class="btn btn-outline" type="button" onclick="refreshCases()" title="Check for new reports">Refresh</button>
        </div>
        <div class="admin-toolbar">
          <select class="status-select" id="sortSelect" onchange="renderList()" style="width:100%;">
            <option value="priority">Sort: needs attention first</option>
            <option value="newest">Sort: newest first</option>
            <option value="oldest">Sort: oldest first</option>
            <option value="category">Sort: category (A–Z)</option>
            <option value="status">Sort: unresolved first</option>
          </select>
        </div>
        <div class="inbox-filters" id="adminFilters">
          <button class="active" onclick="setFilter(this,'all')">All</button>
          <button onclick="setFilter(this,'received')">New</button>
          <button onclick="setFilter(this,'review')">In progress</button>
          <button onclick="setFilter(this,'resolved')">Resolved</button>
          <button onclick="setFilter(this,'urgent')">Urgent</button>
        </div>
        <div class="inbox-list" id="adminList"></div>
      </div>

      <div class="inbox-thread-col">
        <div class="inbox-thread" id="adminThread" hidden>
          <div class="thread-header">
            <div>
              <span class="thread-code" id="threadTupId">TUPM-YY-NNNN</span>
              <span class="thread-cat" id="threadCat">Category</span>
              <span class="thread-name" id="threadName">—</span>
            </div>
            <button type="button" class="btn btn-outline urgent-toggle" id="urgentToggleBtn" onclick="toggleUrgent()">Flag as urgent</button>
            <select class="status-select" id="statusSelect" onchange="changeStatus(this.value)">
              <option value="received">Received</option>
              <option value="review">Under review</option>
              <option value="replied">Replied</option>
              <option value="resolved">Resolved</option>
            </select>
          </div>
          <div class="thread-messages" id="threadMessages"></div>
          <form class="thread-reply" id="threadReplyForm" onsubmit="sendReply(event)">
            <textarea id="threadReplyInput" placeholder="Reply to this student…" rows="2"></textarea>
            <button class="btn btn-primary" type="submit" id="threadSendBtn">Send</button>
          </form>
          <span id="replyStatus" class="reply-status"></span>
          <div class="thread-meta-note">Submitted <span id="threadSubmitted">—</span> · Only trained, verified staff can view this thread.</div>
        </div>
      </div>

    </div>
  </div>
</main>

<script>
/* ================= mock case data (mirrors the PHP $CASES above) ================= */
var CASES = <?= json_encode($CASES) ?>;

var STATUS_LABEL = { received:'Received', review:'Under review', replied:'Replied', resolved:'Resolved' };
var STATUS_CLASS = { received:'status-received', review:'status-review', replied:'status-replied', resolved:'status-resolved' };

var currentTupId = null;
var currentFilter = 'all';

/* ================= unread tracking ================= */
// Remembers how many messages staff have already seen for each
// report, so we can tell when a student has sent something new.
function getSeenCount(tupId){
  var stored = localStorage.getItem('seen_' + tupId);
  if(stored === null){
    return 0;
  }
  return parseInt(stored, 10);
}

function setSeenCount(tupId, count){
  localStorage.setItem('seen_' + tupId, String(count));
}

function hasUnread(tupId){
  var c = CASES[tupId];
  if(!c || !c.messages || c.messages.length === 0){
    return false;
  }

  var seen = getSeenCount(tupId);
  if(c.messages.length <= seen){
    return false;
  }

  var lastMessage = c.messages[c.messages.length - 1];
  return lastMessage.from === 'student';
}

/* ================= stats ================= */
function renderStats(){
  var tupIds = Object.keys(CASES);
  var total = tupIds.length;
  var received = tupIds.filter(function(c){ return CASES[c].status === 'received'; }).length;
  var review   = tupIds.filter(function(c){ return CASES[c].status === 'review' || CASES[c].status === 'replied'; }).length;
  var resolved = tupIds.filter(function(c){ return CASES[c].status === 'resolved'; }).length;

  document.getElementById('statTotal').textContent = total;
  document.getElementById('statReceived').textContent = received;
  document.getElementById('statReview').textContent = review;
  document.getElementById('statResolved').textContent = resolved;
}

/* ================= list ================= */
function setFilter(btn, filter){
  document.querySelectorAll('#adminFilters button').forEach(function(b){ b.classList.remove('active'); });
  btn.classList.add('active');
  currentFilter = filter;
  renderList();
}

function renderList(){
  var list = document.getElementById('adminList');
  var search = document.getElementById('adminSearch').value.trim().toLowerCase();

  var tupIds = Object.keys(CASES).filter(function(tupId){
    var c = CASES[tupId];
    var matchesFilter =
      currentFilter === 'all' ||
      (currentFilter === 'review' && (c.status === 'review' || c.status === 'replied')) ||
      (currentFilter === 'urgent' && c.urgent === true) ||
      c.status === currentFilter;
    var matchesSearch = !search || tupId.toLowerCase().indexOf(search) > -1 || c.category.toLowerCase().indexOf(search) > -1;
    return matchesFilter && matchesSearch;
  });

  // Reports with a new, unread student message always go first,
  // no matter which sort mode is picked below — staff shouldn't
  // have to hunt for those.
  var sortMode = document.getElementById('sortSelect').value;

  tupIds.sort(function(a, b){
    var unreadA = hasUnread(a) ? 0 : 1;
    var unreadB = hasUnread(b) ? 0 : 1;
    if(unreadA !== unreadB){
      return unreadA - unreadB;
    }

    if(sortMode === 'newest'){
      return CASES[b].submitted_at - CASES[a].submitted_at;
    }
    if(sortMode === 'oldest'){
      return CASES[a].submitted_at - CASES[b].submitted_at;
    }
    if(sortMode === 'category'){
      return CASES[a].category.localeCompare(CASES[b].category);
    }
    if(sortMode === 'status'){
      var resolvedA = CASES[a].status === 'resolved' ? 1 : 0;
      var resolvedB = CASES[b].status === 'resolved' ? 1 : 0;
      return resolvedA - resolvedB;
    }

    // Default ("needs attention"): received cases first, then
    // review/replied, then resolved last.
    var order = { received:0, review:1, replied:2, resolved:3 };
    return order[CASES[a].status] - order[CASES[b].status];
  });

  if(tupIds.length === 0){
    list.innerHTML = '<p style="font-size:13px; color:var(--grey-soft); padding:12px 4px;">No reports match this view.</p>';
    return;
  }

  list.innerHTML = tupIds.map(function(tupId){
    var c = CASES[tupId];
    var last = c.messages[c.messages.length - 1];
    var selected = currentTupId === tupId ? ' selected' : '';

    var unreadBadge = '';
    if(hasUnread(tupId)){
      unreadBadge = '<span class="unread-dot" title="New message from student"></span>';
    }

    var urgentBadge = '';
    if(c.urgent){
      urgentBadge = '<span class="urgent-badge">Urgent</span>';
    }

    var nameText = c.display_name ? escapeHtml(c.display_name) : 'Anonymous';

    return '<button class="inbox-item' + selected + '" onclick="openCase(\'' + tupId + '\')">' +
      '<div class="inbox-item-top">' +
        '<span class="inbox-item-code">' + unreadBadge + tupId + '</span>' +
        urgentBadge +
        '<span class="status-pill ' + STATUS_CLASS[c.status] + '">' + STATUS_LABEL[c.status] + '</span>' +
      '</div>' +
      '<div class="inbox-item-cat">' + c.category + ' · ' + nameText + '</div>' +
      '<div class="inbox-item-snippet">' + escapeHtml(last.text) + '</div>' +
    '</button>';
  }).join('');
}

/* ================= thread ================= */
function openCase(tupId){
  currentTupId = tupId;
  document.getElementById('adminThread').hidden = false;

  var c = CASES[tupId];
  document.getElementById('threadTupId').textContent = tupId;
  document.getElementById('threadCat').textContent = c.category;
  document.getElementById('threadName').textContent = c.display_name ? c.display_name : 'Anonymous';
  document.getElementById('threadSubmitted').textContent = c.submitted;
  document.getElementById('statusSelect').value = c.status;
  updateUrgentButton();

  // Opening the case means staff has now seen its latest messages.
  setSeenCount(tupId, c.messages.length);

  var statusEl = document.getElementById('replyStatus');
  statusEl.textContent = '';
  statusEl.className = 'reply-status';

  renderMessages();
  renderList();
}

// Shows whether the currently open case is flagged urgent, and lets
// staff turn that flag on or off.
function updateUrgentButton(){
  var btn = document.getElementById('urgentToggleBtn');
  var c = CASES[currentTupId];
  var isUrgent = c && c.urgent === true;

  if(isUrgent){
    btn.textContent = 'Urgent — remove flag';
    btn.classList.add('urgent-active');
  } else {
    btn.textContent = 'Flag as urgent';
    btn.classList.remove('urgent-active');
  }
}

function toggleUrgent(){
  if(!currentTupId) return;

  var c = CASES[currentTupId];
  var newUrgent = !(c.urgent === true);
  c.urgent = newUrgent;

  updateUrgentButton();
  renderList();

  var body = 'tup_id=' + encodeURIComponent(currentTupId) + '&urgent=' + (newUrgent ? '1' : '0');
  fetch('update_report.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: body });
}

function renderMessages(){
  var c = CASES[currentTupId];
  var wrap = document.getElementById('threadMessages');
  wrap.innerHTML = c.messages.map(function(m){
    var cls = m.from === 'staff' ? 'msg-you' : 'msg-team';
    var who = m.from === 'staff' ? 'You (staff)' : 'Student';
    return '<div class="msg ' + cls + '"><strong style="display:block; font-size:10.5px; text-transform:uppercase; letter-spacing:.03em; opacity:.75; margin-bottom:4px;">' + who + '</strong>' + escapeHtml(m.text) + '<span class="msg-time">' + m.time + '</span></div>';
  }).join('');
  wrap.scrollTop = wrap.scrollHeight;
}

function changeStatus(newStatus){
  if(!currentTupId) return;

  var resolutionNote = '';

  if(newStatus === 'resolved'){
    resolutionNote = prompt('This case will be marked resolved. Type a message for the student — they will see it as a popup when they open this case.');

    // If staff cancels or leaves it blank, don't change the status.
    if(resolutionNote === null || resolutionNote.trim() === ''){
      document.getElementById('statusSelect').value = CASES[currentTupId].status;
      return;
    }
    resolutionNote = resolutionNote.trim();
  }

  CASES[currentTupId].status = newStatus;
  if(resolutionNote !== ''){
    CASES[currentTupId].resolution_note = resolutionNote;
  }
  renderList();
  renderStats();

  var body = 'tup_id=' + encodeURIComponent(currentTupId) + '&status=' + encodeURIComponent(newStatus) + '&resolution_note=' + encodeURIComponent(resolutionNote);
  fetch('update_report.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: body });
}

function sendReply(e){
  e.preventDefault();
  if(!currentTupId) return;

  var input = document.getElementById('threadReplyInput');
  var text = input.value.trim();
  if(text === '') return;

  var sendBtn = document.getElementById('threadSendBtn');
  var statusEl = document.getElementById('replyStatus');
  var tupIdAtSend = currentTupId;

  sendBtn.disabled = true;
  sendBtn.textContent = 'Sending…';
  statusEl.textContent = '';
  statusEl.className = 'reply-status';

  var body = 'tup_id=' + encodeURIComponent(tupIdAtSend) + '&reply=' + encodeURIComponent(text);

  fetch('update_report.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: body })
    .then(function(response){
      return response.json();
    })
    .then(function(data){
      sendBtn.disabled = false;
      sendBtn.textContent = 'Send';

      if(data.error){
        statusEl.textContent = 'Could not send. Please try again.';
        statusEl.className = 'reply-status error';
        return;
      }

      CASES[tupIdAtSend] = data;
      setSeenCount(tupIdAtSend, data.messages.length);
      input.value = '';
      statusEl.textContent = 'Sent';
      statusEl.className = 'reply-status sent';

      if(currentTupId === tupIdAtSend){
        document.getElementById('statusSelect').value = data.status;
        renderMessages();
      }
      renderList();
      renderStats();
    })
    .catch(function(){
      sendBtn.disabled = false;
      sendBtn.textContent = 'Send';
      statusEl.textContent = 'Could not send. Please try again.';
      statusEl.className = 'reply-status error';
    });
}

function escapeHtml(str){
  var div = document.createElement('div');
  div.textContent = str;
  return div.innerHTML;
}

/* ================= pull in new reports from the shared store ================= */
function refreshCases(){
  fetch('get_reports.php')
    .then(function(r){ return r.json(); })
    .then(function(data){
      CASES = data;
      renderStats();
      renderList();
      if(currentTupId && CASES[currentTupId]){
        document.getElementById('statusSelect').value = CASES[currentTupId].status;
        updateUrgentButton();
        renderMessages();
      }
    });
}

/* ================= init ================= */
renderStats();
renderList();
setInterval(refreshCases, 10000);
</script>

</body>
</html>
