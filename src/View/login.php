<?php $pageTitle = 'Login'; require __DIR__ . '/components/head.php'; ?>
<body class="login-page">
  <?php require __DIR__ . '/components/header.php'; ?>
  <main class="page-wrapper" id="main-content" tabindex="-1">
    <div class="card card--sm">

      <div class="page-header">
        <div class="page-header__icon">
          <i class="fas fa-book-open" aria-hidden="true"></i>
        </div>
        <h1 class="page-header__title">Welcome Back</h1>
        <p class="page-header__subtitle">Sign in to your Book Boutique</p>
      </div>

      <?php if (isset($success)): ?>
        <div class="alert alert--success" role="status">
          <i class="fas fa-check-circle" aria-hidden="true"></i>
          <?= htmlspecialchars($success) ?>
        </div>
      <?php endif; ?>

      <?php if (isset($error)): ?>
        <div class="alert alert--danger" role="alert">
          <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form action="/login" method="post">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Controller\Csrf::token()) ?>">
        <div class="form-group">
          <label class="form-label" for="username">Username</label>
          <input type="text" class="form-input" id="username" name="username" placeholder="Enter your username" autocomplete="username" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input type="password" class="form-input" id="password" name="password" placeholder="Enter your password" autocomplete="current-password" required>
        </div>

        <button type="submit" class="btn btn--primary btn--full btn--lg">
          <i class="fas fa-sign-in-alt" aria-hidden="true"></i> Sign In
        </button>
      </form>

      <div class="link-row">
        <p>Don't have an account? <a href="/register">Create one here</a></p>
      </div>

    </div>
  </main>

  <?php include __DIR__ . '/components/footer.php'; ?>
</body>
</html>
