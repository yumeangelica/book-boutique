<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Book Boutique</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
</head>
<body>
  <div class="page-wrapper">
    <div class="card card--sm">

      <div class="page-header">
        <div class="page-header__icon">
          <i class="fas fa-book"></i>
        </div>
        <h1 class="page-header__title">Create Account</h1>
        <p class="page-header__subtitle">Join Book Boutique today</p>
      </div>

      <?php if (isset($error)): ?>
        <div class="alert alert--danger" role="alert">
          <i class="fas fa-exclamation-circle"></i>
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form action="/register" method="post" id="registerForm">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Controller\Csrf::token()) ?>">
        <div class="form-group">
          <label class="form-label" for="username">Username</label>
          <input type="text" class="form-input" id="username" name="username" placeholder="Choose a username" required
                 autocomplete="username"
                 value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input type="password" class="form-input" id="password" name="password" placeholder="Create a password" autocomplete="new-password" required>
        </div>

        <div class="pw-reqs" id="passwordRequirements">
          <div class="pw-reqs__title">Password Requirements:</div>
          <div class="pw-req invalid" id="req-length"><i class="fas fa-times"></i><span>At least 8 characters</span></div>
          <div class="pw-req invalid" id="req-uppercase"><i class="fas fa-times"></i><span>One uppercase letter (A-Z)</span></div>
          <div class="pw-req invalid" id="req-lowercase"><i class="fas fa-times"></i><span>One lowercase letter (a-z)</span></div>
          <div class="pw-req invalid" id="req-number"><i class="fas fa-times"></i><span>One number (0-9)</span></div>
          <div class="pw-req invalid" id="req-special"><i class="fas fa-times"></i><span>One special character (!@#$%^&*)</span></div>
        </div>

        <button type="submit" class="btn btn--primary btn--full btn--lg" id="submitBtn" disabled>
          <i class="fas fa-user-plus"></i> Create Account
        </button>
      </form>

      <div class="link-row">
        <p>Already have an account? <a href="/login">Sign in here</a></p>
      </div>

    </div>
  </div>

  <?php include __DIR__ . '/components/footer.php'; ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const pw = document.getElementById('password');
      const btn = document.getElementById('submitBtn');
      const form = document.getElementById('registerForm');

      const reqs = {
        length:    { el: document.getElementById('req-length'),    test: p => p.length >= 8 },
        uppercase: { el: document.getElementById('req-uppercase'), test: p => /[A-Z]/.test(p) },
        lowercase: { el: document.getElementById('req-lowercase'), test: p => /[a-z]/.test(p) },
        number:    { el: document.getElementById('req-number'),    test: p => /[0-9]/.test(p) },
        special:   { el: document.getElementById('req-special'),   test: p => /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(p) }
      };

      function validate() {
        let ok = true;
        Object.values(reqs).forEach(r => {
          const v = r.test(pw.value);
          r.el.className = 'pw-req ' + (v ? 'valid' : 'invalid');
          r.el.querySelector('i').className = 'fas fa-' + (v ? 'check' : 'times');
          if (!v) ok = false;
        });
        btn.disabled = !ok;
        return ok;
      }

      pw.addEventListener('input', validate);
      form.addEventListener('submit', function(e) {
        if (!validate()) { e.preventDefault(); }
      });
      validate();
    });
  </script>
</body>
</html>
