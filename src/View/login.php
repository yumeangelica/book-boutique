<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Book Boutique</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
</head>
<body class="login-page">
  <div class="page-wrapper">
    <div class="card card--sm">

      <div class="page-header">
        <div class="page-header__icon">
          <i class="fas fa-book-open"></i>
        </div>
        <h1 class="page-header__title">Welcome Back</h1>
        <p class="page-header__subtitle">Sign in to your Book Boutique</p>
      </div>

      <?php if (isset($success)): ?>
        <div class="alert alert--success">
          <i class="fas fa-check-circle"></i>
          <?= htmlspecialchars($success) ?>
        </div>
      <?php endif; ?>

      <?php if (isset($error)): ?>
        <div class="alert alert--danger">
          <i class="fas fa-exclamation-circle"></i>
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form action="/login" method="post">
        <div class="form-group">
          <label class="form-label" for="username">Username</label>
          <input type="text" class="form-input" id="username" name="username" placeholder="Enter your username" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input type="password" class="form-input" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <button type="submit" class="btn btn--primary btn--full btn--lg">
          <i class="fas fa-sign-in-alt"></i> Sign In
        </button>
      </form>

      <div class="link-row">
        <p>Don't have an account? <a href="/register">Create one here</a></p>
      </div>

    </div>
  </div>

  <?php include __DIR__ . '/components/footer.php'; ?>
</body>
</html>