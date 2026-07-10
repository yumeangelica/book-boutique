<?php $pageTitle = 'Register'; require __DIR__ . '/components/head.php'; ?>
<body>
  <?php require __DIR__ . '/components/header.php'; ?>
  <main class="page-wrapper" id="main-content" tabindex="-1">
    <div class="card card--sm">

      <div class="page-header">
        <div class="page-header__icon">
          <i class="fas fa-book" aria-hidden="true"></i>
        </div>
        <h1 class="page-header__title">Create Account</h1>
        <p class="page-header__subtitle">Join Book Boutique today</p>
      </div>

      <?php if (isset($error)): ?>
        <div class="alert alert--danger" role="alert">
          <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form action="/register" method="post" id="registerForm">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Controller\Csrf::token()) ?>">
        <div class="form-group">
          <label class="form-label" for="username">Username</label>
          <input type="text" class="form-input" id="username" name="username" placeholder="Choose a username" required
                 autocomplete="username" minlength="3" maxlength="50" pattern="[A-Za-z0-9_.\-]+"
                 title="Letters, numbers, dots, hyphens and underscores only"
                 value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input type="password" class="form-input" id="password" name="password" placeholder="Create a password" autocomplete="new-password" required>
        </div>

        <div class="pw-reqs" id="passwordRequirements">
          <div class="pw-reqs__title">Password Requirements:</div>
          <div class="pw-req invalid" id="req-length"><i class="fas fa-times" aria-hidden="true"></i><span>At least 8 characters</span><span class="sr-only pw-req__state">not met</span></div>
          <div class="pw-req invalid" id="req-uppercase"><i class="fas fa-times" aria-hidden="true"></i><span>One uppercase letter (A-Z)</span><span class="sr-only pw-req__state">not met</span></div>
          <div class="pw-req invalid" id="req-lowercase"><i class="fas fa-times" aria-hidden="true"></i><span>One lowercase letter (a-z)</span><span class="sr-only pw-req__state">not met</span></div>
          <div class="pw-req invalid" id="req-number"><i class="fas fa-times" aria-hidden="true"></i><span>One number (0-9)</span><span class="sr-only pw-req__state">not met</span></div>
          <div class="pw-req invalid" id="req-special"><i class="fas fa-times" aria-hidden="true"></i><span>One special character (!@#$%^&*)</span><span class="sr-only pw-req__state">not met</span></div>
          <p class="sr-only" id="pwStatus" aria-live="polite"></p>
        </div>

        <button type="submit" class="btn btn--primary btn--full btn--lg" id="submitBtn">
          <i class="fas fa-user-plus" aria-hidden="true"></i> Create Account
        </button>
      </form>

      <div class="link-row">
        <p>Already have an account? <a href="/login">Sign in here</a></p>
      </div>

    </div>
  </main>

  <?php include __DIR__ . '/components/footer.php'; ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const pw = document.getElementById('password');
      const form = document.getElementById('registerForm');
      const status = document.getElementById('pwStatus');

      const reqs = {
        length:    { el: document.getElementById('req-length'),    test: p => p.length >= 8 },
        uppercase: { el: document.getElementById('req-uppercase'), test: p => /[A-Z]/.test(p) },
        lowercase: { el: document.getElementById('req-lowercase'), test: p => /[a-z]/.test(p) },
        number:    { el: document.getElementById('req-number'),    test: p => /[0-9]/.test(p) },
        special:   { el: document.getElementById('req-special'),   test: p => /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(p) }
      };

      function validate() {
        let met = 0;
        Object.values(reqs).forEach(r => {
          const v = r.test(pw.value);
          r.el.className = 'pw-req ' + (v ? 'valid' : 'invalid');
          r.el.querySelector('i').className = 'fas fa-' + (v ? 'check' : 'times');
          r.el.querySelector('.pw-req__state').textContent = v ? 'met' : 'not met';
          if (v) met++;
        });
        status.textContent = met + ' of 5 password requirements met';
        return met === 5;
      }

      pw.addEventListener('input', validate);
      form.addEventListener('submit', function(e) {
        // Server re-validates; this only prevents an obviously invalid round trip
        if (!validate()) { e.preventDefault(); pw.focus(); }
      });
    });
  </script>
</body>
</html>
