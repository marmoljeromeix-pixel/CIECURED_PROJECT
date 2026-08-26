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
 * Same shape as before (tracking code, category, status, message
 * thread) — only where the data comes from has changed. When MySQL
 * is wired in, only reports_lib.php needs to change.
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
        <svg viewBox="0 0 24 24" fill="none"><path d="M12 2L20 6V11C20 16 16.5 20 12 22C7.5 20 4 16 4 11V6L12 2Z" fill="white" fill-opacity="0.95"/></svg>
      </span>
      <span>
        CIEcured
        <small>Admin</small>
      </span>
    </a>
    <div class="admin-header-actions">
      <a href="../ciecured-student/index.php">View student site</a>
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
          <input class="admin-search" id="adminSearch" type="text" placeholder="Search by code or category…" oninput="renderList()">
          <button class="btn btn-outline" type="button" onclick="refreshCases()" title="Check for new reports">Refresh</button>
        </div>
        <div class="inbox-filters" id="adminFilters">
          <button class="active" onclick="setFilter(this,'all')">All</button>
          <button onclick="setFilter(this,'received')">New</button>
          <button onclick="setFilter(this,'review')">In progress</button>
          <button onclick="setFilter(this,'resolved')">Resolved</button>
        </div>
        <div class="inbox-list" id="adminList"></div>
      </div>

      <div class="inbox-thread-col">
        <div class="inbox-empty" id="adminEmpty">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 4h16v12H7l-3 3V4z"/></svg>
          <h3>No report selected</h3>
          <p>Pick a report from the list to read the thread and respond.</p>
          <p class="admin-empty-sub">Replies are sent to the student's private tracking inbox.</p>
        </div>

        <div class="inbox-thread" id="adminThread" hidden>
          <div class="thread-header">
            <div>
              <span class="thread-code" id="threadCode">CIE-XXXX-XX</span>
              <span class="thread-cat" id="threadCat">Category</span>
            </div>
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
            <button class="btn btn-primary" type="submit">Send</button>
          </form>
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

var currentCode = null;
var currentFilter = 'all';

/* ================= stats ================= */
function renderStats(){
  var codes = Object.keys(CASES);
  var total = codes.length;
  var received = codes.filter(function(c){ return CASES[c].status === 'received'; }).length;
  var review   = codes.filter(function(c){ return CASES[c].status === 'review' || CASES[c].status === 'replied'; }).length;
  var resolved = codes.filter(function(c){ return CASES[c].status === 'resolved'; }).length;

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

  var codes = Object.keys(CASES).filter(function(code){
    var c = CASES[code];
    var matchesFilter =
      currentFilter === 'all' ||
      (currentFilter === 'review' && (c.status === 'review' || c.status === 'replied')) ||
      c.status === currentFilter;
    var matchesSearch = !search || code.toLowerCase().indexOf(search) > -1 || c.category.toLowerCase().indexOf(search) > -1;
    return matchesFilter && matchesSearch;
  });

  // Newest / most recently touched first isn't tracked precisely in this
  // mockup, so we just keep received (needs attention) cases on top.
  codes.sort(function(a, b){
    var order = { received:0, review:1, replied:2, resolved:3 };
    return order[CASES[a].status] - order[CASES[b].status];
  });

  if(codes.length === 0){
    list.innerHTML = '<p style="font-size:13px; color:var(--grey-soft); padding:12px 4px;">No reports match this view.</p>';
    return;
  }

  list.innerHTML = codes.map(function(code){
    var c = CASES[code];
    var last = c.messages[c.messages.length - 1];
    var selected = currentCode === code ? ' selected' : '';
    return '<button class="inbox-item' + selected + '" onclick="openCase(\'' + code + '\')">' +
      '<div class="inbox-item-top">' +
        '<span class="inbox-item-code">' + code + '</span>' +
        '<span class="status-pill ' + STATUS_CLASS[c.status] + '">' + STATUS_LABEL[c.status] + '</span>' +
      '</div>' +
      '<div class="inbox-item-cat">' + c.category + '</div>' +
      '<div class="inbox-item-snippet">' + escapeHtml(last.text) + '</div>' +
    '</button>';
  }).join('');
}

/* ================= thread ================= */
function openCase(code){
  currentCode = code;
  document.getElementById('adminEmpty').hidden = true;
  document.getElementById('adminThread').hidden = false;

  var c = CASES[code];
  document.getElementById('threadCode').textContent = code;
  document.getElementById('threadCat').textContent = c.category;
  document.getElementById('threadSubmitted').textContent = c.submitted;
  document.getElementById('statusSelect').value = c.status;

  renderMessages();
  renderList();
}

function renderMessages(){
  var c = CASES[currentCode];
  var wrap = document.getElementById('threadMessages');
  wrap.innerHTML = c.messages.map(function(m){
    var cls = m.from === 'staff' ? 'msg-you' : 'msg-team';
    var who = m.from === 'staff' ? 'You (staff)' : 'Student';
    return '<div class="msg ' + cls + '"><strong style="display:block; font-size:10.5px; text-transform:uppercase; letter-spacing:.03em; opacity:.75; margin-bottom:4px;">' + who + '</strong>' + escapeHtml(m.text) + '<span class="msg-time">' + m.time + '</span></div>';
  }).join('');
  wrap.scrollTop = wrap.scrollHeight;
}

function changeStatus(newStatus){
  if(!currentCode) return;
  CASES[currentCode].status = newStatus;
  renderList();
  renderStats();

  var body = 'code=' + encodeURIComponent(currentCode) + '&status=' + encodeURIComponent(newStatus);
  fetch('update_report.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: body });
}

function sendReply(e){
  e.preventDefault();
  if(!currentCode) return;
  var input = document.getElementById('threadReplyInput');
  var text = input.value.trim();
  if(!text) return;

  var codeAtSend = currentCode;
  var body = 'code=' + encodeURIComponent(codeAtSend) + '&reply=' + encodeURIComponent(text);
  fetch('update_report.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: body })
    .then(function(r){ return r.json(); })
    .then(function(data){
      if(data.error) return;
      CASES[codeAtSend] = data;
      if(currentCode === codeAtSend){
        document.getElementById('statusSelect').value = data.status;
        renderMessages();
      }
      renderList();
      renderStats();
    });

  input.value = '';
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
      if(currentCode && CASES[currentCode]){
        document.getElementById('statusSelect').value = CASES[currentCode].status;
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
