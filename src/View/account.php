<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$error = isset($error) ? $error : '';
$success = isset($success) ? $success : '';
$pageTitle = 'Account Settings';
require __DIR__ . '/components/head.php';
?>
<body>
  <?php $activeNav = 'account'; require __DIR__ . '/components/header.php'; ?>
  <main class="page-wrapper" id="main-content" tabindex="-1">
    <div class="card card--sm">

      <div class="page-header">
        <div class="page-header__icon page-header__icon--round">
          <i class="fas fa-user" aria-hidden="true"></i>
        </div>
        <h1 class="page-header__title">Account Settings</h1>
      </div>

      <?php if ($error): ?>
        <div class="alert alert--danger" role="alert"><i class="fas fa-exclamation-triangle" aria-hidden="true"></i> <?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <?php if ($success): ?>
        <div class="alert alert--success" role="status"><i class="fas fa-check-circle" aria-hidden="true"></i> <?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <div class="info-box">
        <div class="info-box__title"><i class="fas fa-user-circle" aria-hidden="true"></i> Account Information</div>
        <div class="info-box__row">
          <span class="info-box__label">Username</span>
          <span class="info-box__value"><?= htmlspecialchars($username) ?></span>
        </div>
        <div class="info-box__row">
          <span class="info-box__label">Status</span>
          <span class="info-box__value">Active</span>
        </div>
      </div>

      <div class="actions actions--stack">
        <button type="button" class="btn btn--primary btn--full" onclick="toggleSection('pwSection', this)" aria-controls="pwSection" aria-expanded="false">
          <i class="fas fa-key" aria-hidden="true"></i> Change Password
        </button>

        <!-- Password Change -->
        <div id="pwSection" class="collapse-section collapse-section--neutral" aria-hidden="true">
          <form method="POST" action="/change-password" id="pwForm">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Controller\Csrf::token()) ?>">
            <div class="form-group">
              <label class="form-label" for="current_password">Current Password</label>
              <input type="password" id="current_password" name="current_password" class="form-input" autocomplete="current-password" required>
            </div>
            <div class="form-group">
              <label class="form-label" for="new_password">New Password</label>
              <input type="password" id="new_password" name="new_password" class="form-input" autocomplete="new-password" required>
            </div>

            <div class="pw-reqs">
              <div class="pw-reqs__title">Password Requirements:</div>
              <div class="pw-req invalid" id="lengthReq"><i class="fas fa-times" aria-hidden="true"></i><span>At least 8 characters</span><span class="sr-only pw-req__state">not met</span></div>
              <div class="pw-req invalid" id="uppercaseReq"><i class="fas fa-times" aria-hidden="true"></i><span>One uppercase letter</span><span class="sr-only pw-req__state">not met</span></div>
              <div class="pw-req invalid" id="lowercaseReq"><i class="fas fa-times" aria-hidden="true"></i><span>One lowercase letter</span><span class="sr-only pw-req__state">not met</span></div>
              <div class="pw-req invalid" id="numberReq"><i class="fas fa-times" aria-hidden="true"></i><span>One number</span><span class="sr-only pw-req__state">not met</span></div>
              <div class="pw-req invalid" id="specialReq"><i class="fas fa-times" aria-hidden="true"></i><span>One special character</span><span class="sr-only pw-req__state">not met</span></div>
              <p class="sr-only" id="pwStatus" aria-live="polite"></p>
            </div>

            <div class="form-group">
              <label class="form-label" for="confirm_password">Confirm New Password</label>
              <input type="password" id="confirm_password" name="confirm_password" class="form-input" autocomplete="new-password" required>
              <div id="matchMsg" class="match-msg" aria-live="polite"></div>
            </div>

            <button type="submit" class="btn btn--primary btn--full" id="pwBtn">
              <i class="fas fa-key" aria-hidden="true"></i> Update Password
            </button>
            <button type="button" class="btn btn--secondary btn--full mt-8" onclick="toggleSection('pwSection')">
              <i class="fas fa-times" aria-hidden="true"></i> Cancel
            </button>
          </form>
        </div>

        <button type="button" class="btn btn--danger btn--full" onclick="toggleSection('delSection', this)" aria-controls="delSection" aria-expanded="false">
          <i class="fas fa-trash-alt" aria-hidden="true"></i> Delete Account
        </button>

        <!-- Delete Confirmation -->
        <div id="delSection" class="collapse-section collapse-section--danger" aria-hidden="true">
          <p class="danger-note">
            <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>
            This action cannot be undone. All your books will be permanently deleted.
          </p>
          <form method="POST" action="/delete-account">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Controller\Csrf::token()) ?>">
            <div class="form-group">
              <label class="form-label form-label--danger" for="delete_confirm_password">Enter your password to confirm:</label>
              <input type="password" id="delete_confirm_password" name="confirm_password" class="form-input" autocomplete="current-password" required>
            </div>
            <button type="submit" class="btn btn--danger btn--full">
              <i class="fas fa-trash-alt" aria-hidden="true"></i> Permanently Delete Account
            </button>
            <button type="button" class="btn btn--secondary btn--full mt-8" onclick="toggleSection('delSection')">
              <i class="fas fa-times" aria-hidden="true"></i> Cancel
            </button>
          </form>
        </div>
      </div>

    </div>
  </main>

  <?php include __DIR__ . '/components/footer.php'; ?>

  <script>
    function toggleSection(id, trigger) {
      const section = document.getElementById(id);
      const isOpen = section.classList.toggle('show');
      section.setAttribute('aria-hidden', String(!isOpen));
      const control = trigger || document.querySelector(`[aria-controls="${id}"]`);
      if (control) {
        control.setAttribute('aria-expanded', String(isOpen));
      }
    }

    const np = document.getElementById('new_password');
    const cp = document.getElementById('confirm_password');
    const msg = document.getElementById('matchMsg');
    const status = document.getElementById('pwStatus');
    const pwForm = document.getElementById('pwForm');

    function setReq(id, ok) {
      const el = document.getElementById(id);
      el.className = 'pw-req ' + (ok ? 'valid' : 'invalid');
      el.querySelector('i').className = 'fas fa-' + (ok ? 'check' : 'times');
      el.querySelector('.pw-req__state').textContent = ok ? 'met' : 'not met';
      return ok;
    }

    function validatePw() {
      const p = np.value;
      let met = 0;
      if (setReq('lengthReq', p.length >= 8)) met++;
      if (setReq('uppercaseReq', /[A-Z]/.test(p))) met++;
      if (setReq('lowercaseReq', /[a-z]/.test(p))) met++;
      if (setReq('numberReq', /[0-9]/.test(p))) met++;
      if (setReq('specialReq', /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(p))) met++;
      status.textContent = met + ' of 5 password requirements met';
      checkMatch();
      return met === 5;
    }

    function checkMatch() {
      const p = np.value, c = cp.value;
      if (!c) { msg.textContent = ''; msg.className = 'match-msg'; return false; }
      if (p === c) { msg.textContent = '✓ Passwords match'; msg.className = 'match-msg match'; return true; }
      msg.textContent = '✗ Passwords do not match'; msg.className = 'match-msg no-match';
      return false;
    }

    np.addEventListener('input', validatePw);
    cp.addEventListener('input', checkMatch);

    pwForm.addEventListener('submit', function(e) {
      // Server re-validates; this only prevents an obviously invalid round trip
      if (!validatePw()) { e.preventDefault(); np.focus(); return; }
      if (np.value !== cp.value) { e.preventDefault(); cp.focus(); }
    });
  </script>
</body>
</html>
