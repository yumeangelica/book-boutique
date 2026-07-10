<?php
$activeNav = $activeNav ?? '';
$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>
<a class="skip-link" href="#main-content">Skip to main content</a>
<?php if ($isLoggedIn): ?>
  <header class="site-header">
    <nav class="site-nav" aria-label="Main">
      <a class="site-nav__brand" href="/dashboard">Book Boutique <span aria-hidden="true">&#9825;</span></a>
      <ul class="site-nav__links">
        <li><a class="site-nav__link" href="/dashboard"<?= $activeNav === 'dashboard' ? ' aria-current="page"' : '' ?>>Dashboard</a></li>
        <li><a class="site-nav__link" href="/books"<?= $activeNav === 'books' ? ' aria-current="page"' : '' ?>>Books</a></li>
        <li><a class="site-nav__link" href="/account"<?= $activeNav === 'account' ? ' aria-current="page"' : '' ?>>Account</a></li>
        <li><a class="site-nav__link" href="/logout" onclick="return confirm('Are you sure you want to logout?')">Logout</a></li>
      </ul>
    </nav>
  </header>
<?php endif; ?>
