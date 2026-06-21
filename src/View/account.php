<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$error = isset($error) ? $error : '';
$success = isset($success) ? $success : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Settings - Book Boutique</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
</head>
<body>
  <div class="page-wrapper">
    <div class="card card--sm">

      <div class="page-header">
        <div class="page-header__icon page-header__icon--round">
          <i class="fas fa-user"></i>
        </div>
        <h1 class="page-header__title">Account Settings</h1>
      </div>

      <?php if ($error): ?>
        <div class="alert alert--danger" role="alert"><i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <?php if ($success): ?>
        <div class="alert alert--success" role="status"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <div class="info-box">
        <div class="info-box__title"><i class="fas fa-user-circle"></i> Account Information</div>
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
          <i class="fas fa-key"></i> Change Password
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
              <div class="pw-req invalid" id="lengthReq"><i class="fas fa-times"></i><span>At least 8 characters</span></div>
              <div class="pw-req invalid" id="uppercaseReq"><i class="fas fa-times"></i><span>One uppercase letter</span></div>
              <div class="pw-req invalid" id="lowercaseReq"><i class="fas fa-times"></i><span>One lowercase letter</span></div>
              <div class="pw-req invalid" id="numberReq"><i class="fas fa-times"></i><span>One number</span></div>
              <div class="pw-req invalid" id="specialReq"><i class="fas fa-times"></i><span>One special character</span></div>
            </div>

            <div class="form-group">
              <label class="form-label" for="confirm_password">Confirm New Password</label>
              <input type="password" id="confirm_password" name="confirm_password" class="form-input" autocomplete="new-password" required>
              <div id="matchMsg" class="match-msg" aria-live="polite"></div>
            </div>

            <button type="submit" class="btn btn--primary btn--full" id="pwBtn" disabled>
              <i class="fas fa-key"></i> Update Password
            </button>
            <button type="button" class="btn btn--secondary btn--full" onclick="toggleSection('pwSection')" style="margin-top:8px;">
              <i class="fas fa-times"></i> Cancel
            </button>
          </form>
        </div>

        <a href="/dashboard" class="btn btn--secondary btn--full">
          <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>

        <button type="button" class="btn btn--danger btn--full" onclick="toggleSection('delSection', this)" aria-controls="delSection" aria-expanded="false">
          <i class="fas fa-trash-alt"></i> Delete Account
        </button>

        <!-- Delete Confirmation -->
        <div id="delSection" class="collapse-section collapse-section--danger" aria-hidden="true">
          <p style="color:var(--color-danger); font-weight:600; font-size:0.85rem; margin-bottom:14px;">
            <i class="fas fa-exclamation-triangle"></i>
            This action cannot be undone. All your books will be permanently deleted.
          </p>
          <form method="POST" action="/delete-account">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Controller\Csrf::token()) ?>">
            <div class="form-group">
              <label class="form-label" for="delete_confirm_password" style="color:var(--color-danger);">Enter your password to confirm:</label>
              <input type="password" id="delete_confirm_password" name="confirm_password" class="form-input" autocomplete="current-password" required>
            </div>
            <button type="submit" class="btn btn--danger btn--full">
              <i class="fas fa-trash-alt"></i> Permanently Delete Account
            </button>
            <button type="button" class="btn btn--secondary btn--full" onclick="toggleSection('delSection')" style="margin-top:8px;">
              <i class="fas fa-times"></i> Cancel
            </button>
          </form>
        </div>
      </div>

      <div class="link-row" style="margin-top:28px;">
        <a href="/logout" onclick="return confirm('Are you sure you want to logout?')">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>

    </div>
  </div>

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
    const cur = document.getElementById('current_password');
    const btn = document.getElementById('pwBtn');
    const msg = document.getElementById('matchMsg');

    function setReq(id, ok) {
      const el = document.getElementById(id);
      el.className = 'pw-req ' + (ok ? 'valid' : 'invalid');
      el.querySelector('i').className = 'fas fa-' + (ok ? 'check' : 'times');
    }

    function validatePw() {
      const p = np.value;
      setReq('lengthReq', p.length >= 8);
      setReq('uppercaseReq', /[A-Z]/.test(p));
      setReq('lowercaseReq', /[a-z]/.test(p));
      setReq('numberReq', /[0-9]/.test(p));
      setReq('specialReq', /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(p));
      checkMatch();
    }

    function checkMatch() {
      const p = np.value, c = cp.value;
      if (!c) { msg.textContent = ''; msg.className = 'match-msg'; }
      else if (p === c) { msg.textContent = '✓ Passwords match'; msg.className = 'match-msg match'; }
      else { msg.textContent = '✗ Passwords do not match'; msg.className = 'match-msg no-match'; }
      updateBtn();
    }

    function updateBtn() {
      const p = np.value;
      btn.disabled = !(p.length >= 8 && /[A-Z]/.test(p) && /[a-z]/.test(p) && /[0-9]/.test(p)
        && /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(p) && p === cp.value && cur.value.length > 0);
    }

    np.addEventListener('input', validatePw);
    cp.addEventListener('input', checkMatch);
    cur.addEventListener('input', updateBtn);
  </script>
</body>
</html>
