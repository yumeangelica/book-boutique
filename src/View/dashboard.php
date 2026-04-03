<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Book Boutique</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
</head>
<body>
  <div class="page-wrapper">
    <div class="card card--md" style="text-align:center;">

      <div class="page-header">
        <div class="page-header__icon page-header__icon--round">
          <i class="fas fa-book-open"></i>
        </div>
        <h1 class="page-header__title">Welcome Back!</h1>
        <p class="page-header__subtitle">Ready to explore your book collection?</p>
        <div style="margin-top:16px;">
          <a href="/account" class="badge">
            <i class="fas fa-user"></i> <?= htmlspecialchars($username) ?>
          </a>
        </div>
      </div>

      <div class="info-box">
        <div class="info-box__title">
          <i class="fas fa-heart"></i> Your Book Boutique
        </div>
        <p style="color:var(--color-muted); font-size:0.9rem; margin:0; line-height:1.7;">
          Manage your personal library, discover new books, and keep track of your reading journey.
          Your literary adventure starts here!
        </p>
      </div>

      <div class="actions actions--center actions--mt">
        <a href="/books" class="btn btn--primary btn--lg">
          <i class="fas fa-book"></i> View Books
        </a>
        <a href="/logout" class="btn btn--secondary btn--lg" onclick="return confirm('Are you sure you want to logout?')">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>

    </div>
  </div>

  <?php include __DIR__ . '/components/footer.php'; ?>
</body>
</html>