<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$pageTitle = 'Dashboard';
require __DIR__ . '/components/head.php';
?>
<body>
  <?php $activeNav = 'dashboard'; require __DIR__ . '/components/header.php'; ?>
  <main class="page-wrapper" id="main-content" tabindex="-1">
    <div class="card card--md text-center">

      <div class="page-header">
        <div class="page-header__icon page-header__icon--round">
          <i class="fas fa-book-open" aria-hidden="true"></i>
        </div>
        <h1 class="page-header__title">Welcome Back!</h1>
        <p class="page-header__subtitle">Ready to explore your book collection?</p>
        <div class="mt-16">
          <a href="/account" class="badge">
            <i class="fas fa-user" aria-hidden="true"></i> <?= htmlspecialchars($username) ?>
          </a>
        </div>
      </div>

      <div class="info-box">
        <div class="info-box__title">
          <i class="fas fa-heart" aria-hidden="true"></i> Your Book Boutique
        </div>
        <p class="info-box__text">
          Manage your personal library, discover new books, and keep track of your reading journey.
          Your literary adventure starts here!
        </p>
      </div>

      <div class="actions actions--center actions--mt">
        <a href="/books" class="btn btn--primary btn--lg">
          <i class="fas fa-book" aria-hidden="true"></i> View Books
        </a>
        <a href="/logout" class="btn btn--secondary btn--lg" onclick="return confirm('Are you sure you want to logout?')">
          <i class="fas fa-sign-out-alt" aria-hidden="true"></i> Logout
        </a>
      </div>

    </div>
  </main>

  <?php include __DIR__ . '/components/footer.php'; ?>
</body>
</html>
