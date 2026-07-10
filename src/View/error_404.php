<?php $pageTitle = 'Page Not Found'; require __DIR__ . '/components/head.php'; ?>
<body>
  <?php require __DIR__ . '/components/header.php'; ?>
  <main class="page-wrapper" id="main-content" tabindex="-1">
    <div class="card card--sm text-center">

      <div class="page-header">
        <div class="page-header__icon">
          <i class="fas fa-compass" aria-hidden="true"></i>
        </div>
        <h1 class="page-header__title">Page Not Found</h1>
        <p class="page-header__subtitle">The page you are looking for does not exist or has been moved.</p>
      </div>

      <div class="actions actions--center actions--mt">
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
          <a href="/dashboard" class="btn btn--primary btn--lg">
            <i class="fas fa-home" aria-hidden="true"></i> Back to Dashboard
          </a>
        <?php else: ?>
          <a href="/login" class="btn btn--primary btn--lg">
            <i class="fas fa-sign-in-alt" aria-hidden="true"></i> Go to Login
          </a>
        <?php endif; ?>
      </div>

    </div>
  </main>

  <?php include __DIR__ . '/components/footer.php'; ?>
</body>
</html>
