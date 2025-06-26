<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Book Boutique</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-pink: #d4a5a5;
      --secondary-pink: #f2d6d6;
      --light-pink: #faf5f5;
      --accent-pink: #c49494;
      --dark-pink: #b18a8a;
      --text-dark: #6b4c4c;
      --text-light: #8b6b6b;
      --shadow: rgba(212, 165, 165, 0.2);
      --shadow-hover: rgba(212, 165, 165, 0.3);
    }

    * {
      box-sizing: border-box;
    }

    html {
      background: linear-gradient(135deg, var(--light-pink) 0%, var(--secondary-pink) 100%);
      min-height: 100%;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: linear-gradient(135deg, var(--light-pink) 0%, var(--secondary-pink) 100%);
      min-height: 100vh;
      margin: 0;
      padding: 20px;
      position: relative;
      overflow-x: hidden;
      display: flex;
      flex-direction: column;
    }

    .main-content {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      padding: 40px;
      width: 100%;
      max-width: 440px;
      box-shadow:
        0 20px 40px var(--shadow),
        0 0 0 1px rgba(255, 255, 255, 0.5);
      border: 1px solid rgba(212, 165, 165, 0.2);
      position: relative;
      z-index: 1;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .login-container:hover {
      transform: translateY(-2px);
      box-shadow:
        0 25px 50px var(--shadow-hover),
        0 0 0 1px rgba(255, 255, 255, 0.6);
    }

    .brand-header {
      text-align: center;
      margin-bottom: 32px;
    }

    .brand-icon {
      width: 64px;
      height: 64px;
      background: linear-gradient(135deg, var(--primary-pink), var(--accent-pink));
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 16px;
      box-shadow: 0 8px 16px var(--shadow);
    }

    .brand-icon i {
      font-size: 28px;
      color: white;
    }

    h1 {
      color: var(--text-dark);
      font-weight: 600;
      font-size: 28px;
      margin: 0 0 8px 0;
      letter-spacing: -0.5px;
    }

    .subtitle {
      color: var(--text-light);
      font-size: 16px;
      margin: 0;
      font-weight: 400;
    }

    .form-group {
      margin-bottom: 24px;
      position: relative;
    }

    .form-label {
      color: var(--text-dark);
      font-weight: 500;
      font-size: 14px;
      margin-bottom: 8px;
      display: block;
    }

    .form-control {
      width: 100%;
      padding: 14px 16px;
      border: 2px solid var(--secondary-pink);
      border-radius: 12px;
      font-size: 16px;
      font-weight: 400;
      background: rgba(255, 255, 255, 0.8);
      color: var(--text-dark);
      transition: all 0.3s ease;
      backdrop-filter: blur(10px);
    }

    .form-control:focus {
      border-color: var(--primary-pink);
      box-shadow: 0 0 0 4px rgba(212, 165, 165, 0.15);
      outline: none;
      background: rgba(255, 255, 255, 0.95);
    }

    .form-control::placeholder {
      color: var(--text-light);
      opacity: 0.7;
    }

    .btn {
      font-weight: 600;
      font-size: 16px;
      padding: 14px 24px;
      border-radius: 12px;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      width: 100%;
      margin-top: 8px;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--primary-pink), var(--accent-pink));
      color: white;
      box-shadow: 0 4px 12px var(--shadow);
    }

    .btn-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px var(--shadow-hover);
      background: linear-gradient(135deg, var(--accent-pink), var(--dark-pink));
    }

    .btn-primary:active {
      transform: translateY(0);
    }

    .alert {
      border-radius: 12px;
      border: none;
      padding: 16px 20px;
      margin-bottom: 24px;
      font-weight: 500;
      font-size: 14px;
      backdrop-filter: blur(10px);
    }

    .alert-success {
      background: rgba(134, 239, 172, 0.2);
      color: #065f46;
      border: 1px solid rgba(134, 239, 172, 0.3);
    }

    .alert-danger {
      background: rgba(252, 165, 165, 0.2);
      color: #7f1d1d;
      border: 1px solid rgba(252, 165, 165, 0.3);
    }

    .register-link {
      text-align: center;
      margin-top: 24px;
      padding-top: 24px;
      border-top: 1px solid var(--secondary-pink);
    }

    .register-link p {
      color: var(--text-light);
      margin: 0;
      font-size: 14px;
    }

    .register-link a {
      color: var(--primary-pink);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .register-link a:hover {
      color: var(--accent-pink);
      text-decoration: underline;
    }

    /* Responsive Design */
    @media (max-width: 576px) {
      body {
        padding: 16px;
      }

      .login-container {
        padding: 32px 24px;
        border-radius: 20px;
      }

      h1 {
        font-size: 24px;
      }

      .brand-icon {
        width: 56px;
        height: 56px;
        margin-bottom: 12px;
      }

      .brand-icon i {
        font-size: 24px;
      }

      .form-control {
        padding: 12px 14px;
        font-size: 16px; /* Prevents zoom on iOS */
      }

      .btn {
        padding: 12px 20px;
        font-size: 15px;
      }
    }

    @media (max-width: 400px) {
      .login-container {
        padding: 24px 20px;
      }

      .form-group {
        margin-bottom: 20px;
      }
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
      :root {
        --light-pink: #2a1f1f;
        --secondary-pink: #3a2a2a;
        --text-dark: #e5d5d5;
        --text-light: #c5b5b5;
      }

      body {
        background: linear-gradient(135deg, #1a1515 0%, #2a1f1f 100%);
      }

      .login-container {
        background: rgba(42, 31, 31, 0.95);
      }
    }
  </style>
</head>

<body>
  <div class="main-content">
    <div class="login-container">
    <div class="brand-header">
      <div class="brand-icon">
        <i class="fas fa-book-open"></i>
      </div>
      <h1>Welcome Back</h1>
      <p class="subtitle">Sign in to your Book Boutique account</p>
    </div>

    <?php if (isset($success)) { ?>
      <div class="alert alert-success" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <?php echo htmlspecialchars($success); ?>
      </div>
    <?php } ?>

    <?php if (isset($error)) { ?>
      <div class="alert alert-danger" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <?php echo htmlspecialchars($error); ?>
      </div>
    <?php } ?>

    <form action="/login" method="post">
      <div class="form-group">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
      </div>

      <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
      </div>

      <button type="submit" class="btn btn-primary">
        <i class="fas fa-sign-in-alt"></i>
        Sign In
      </button>
    </form>

    <div class="register-link">
      <p>Don't have an account? <a href="/register">Create one here</a></p>
    </div>
  </div>
  </div>

<?php include __DIR__ . '/components/footer.php'; ?>
</body>

</html>