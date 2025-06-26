<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Book Boutique</title>
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
      --success-green: #c5d4a5;
      --success-light: #f0f5e8;
      --error-red: #d4a5a5;
      --error-light: #faf0f0;
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

    .register-container {
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

    .register-container:hover {
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

    .brand-title {
      font-size: 28px;
      font-weight: 700;
      color: var(--text-dark);
      margin: 0 0 8px 0;
      letter-spacing: -0.5px;
    }

    .brand-subtitle {
      font-size: 16px;
      color: var(--text-light);
      margin: 0;
      font-weight: 400;
    }

    .form-section {
      margin-bottom: 24px;
    }

    .form-floating {
      margin-bottom: 20px;
      position: relative;
    }

    .form-floating > .form-control {
      height: 58px;
      padding: 16px 16px 8px 16px;
      border: 2px solid rgba(212, 165, 165, 0.2);
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.8);
      font-size: 16px;
      font-weight: 400;
      color: var(--text-dark);
      transition: all 0.3s ease;
    }

    .form-floating > .form-control:focus {
      border-color: var(--primary-pink);
      box-shadow: 0 0 0 4px rgba(212, 165, 165, 0.1);
      background: rgba(255, 255, 255, 0.95);
      outline: none;
    }

    .form-floating > label {
      padding: 16px;
      color: var(--text-light);
      font-weight: 500;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .form-floating > .form-control:focus ~ label,
    .form-floating > .form-control:not(:placeholder-shown) ~ label {
      color: var(--primary-pink);
      transform: scale(0.85) translateY(-14px);
    }

    .register-btn {
      width: 100%;
      height: 52px;
      background: linear-gradient(135deg, var(--primary-pink), var(--accent-pink));
      border: none;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 600;
      color: white;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      box-shadow: 0 4px 12px var(--shadow);
    }

    .register-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px var(--shadow-hover);
      background: linear-gradient(135deg, var(--accent-pink), var(--dark-pink));
    }

    .register-btn:active {
      transform: translateY(0);
    }

    .register-btn:disabled {
      background: linear-gradient(135deg, #ccc, #bbb);
      cursor: not-allowed;
      transform: none;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .password-requirements {
      margin-top: 12px;
      padding: 16px;
      background: rgba(212, 165, 165, 0.05);
      border-radius: 12px;
      border: 1px solid rgba(212, 165, 165, 0.1);
      font-size: 14px;
    }

    .requirements-title {
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 8px;
    }

    .requirement {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 4px;
      transition: all 0.3s ease;
    }

    .requirement i {
      width: 16px;
      height: 16px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      transition: all 0.3s ease;
    }

    .requirement.invalid i {
      background: #ff4757;
      color: white;
    }

    .requirement.valid i {
      background: #2ed573;
      color: white;
    }

    .requirement.invalid {
      color: #ff4757;
    }

    .requirement.valid {
      color: #2ed573;
    }

    .divider {
      text-align: center;
      margin: 24px 0;
      position: relative;
      color: var(--text-light);
      font-size: 14px;
    }

    .divider::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 0;
      right: 0;
      height: 1px;
      background: rgba(212, 165, 165, 0.2);
    }

    .divider span {
      background: rgba(255, 255, 255, 0.95);
      padding: 0 16px;
    }

    .login-link {
      text-align: center;
      margin-top: 24px;
    }

    .login-link p {
      margin: 0;
      color: var(--text-light);
      font-size: 14px;
    }

    .login-link a {
      color: var(--primary-pink);
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }

    .login-link a:hover {
      color: var(--dark-pink);
      text-decoration: underline;
    }

    .alert {
      border: none;
      border-radius: 12px;
      padding: 16px;
      margin-bottom: 24px;
      font-size: 14px;
      font-weight: 500;
    }

    .alert-danger {
      background: var(--error-light);
      color: #8b4c4c;
      border-left: 4px solid var(--error-red);
    }

    .alert-success {
      background: var(--success-light);
      color: #4c6b4c;
      border-left: 4px solid var(--success-green);
    }

    @media (max-width: 480px) {
      .register-container {
        padding: 32px 24px;
        margin: 16px;
      }

      .brand-title {
        font-size: 24px;
      }

      .brand-subtitle {
        font-size: 14px;
      }
    }

    @media (max-width: 360px) {
      .register-container {
        padding: 24px 20px;
      }
    }
  </style>
</head>

<body>
  <div class="main-content">
    <div class="register-container">
    <div class="brand-header">
      <div class="brand-icon">
        <i class="fas fa-book"></i>
      </div>
      <h1 class="brand-title">Create Account</h1>
      <p class="brand-subtitle">Join Book Boutique today</p>
    </div>

    <?php if (isset($error)): ?>
      <div class="alert alert-danger" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <?php echo htmlspecialchars($error); ?>
      </div>
    <?php endif; ?>

    <?php if (isset($_GET['success']) && $_GET['success'] === 'registered'): ?>
      <div class="alert alert-success" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        Registration successful! You can now log in.
      </div>
    <?php endif; ?>

    <form action="/register" method="post" class="form-section">
      <div class="form-floating">
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required
               value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
        <label for="username">Username</label>
      </div>

      <div class="form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        <label for="password">Password</label>
      </div>

      <div class="password-requirements" id="passwordRequirements">
        <div class="requirements-title">Password Requirements:</div>
        <div class="requirement" id="req-length">
          <i class="fas fa-times"></i>
          <span>At least 8 characters</span>
        </div>
        <div class="requirement" id="req-uppercase">
          <i class="fas fa-times"></i>
          <span>One uppercase letter (A-Z)</span>
        </div>
        <div class="requirement" id="req-lowercase">
          <i class="fas fa-times"></i>
          <span>One lowercase letter (a-z)</span>
        </div>
        <div class="requirement" id="req-number">
          <i class="fas fa-times"></i>
          <span>One number (0-9)</span>
        </div>
        <div class="requirement" id="req-special">
          <i class="fas fa-times"></i>
          <span>One special character (!@#$%^&*)</span>
        </div>
      </div>

      <button type="submit" class="register-btn">
        <i class="fas fa-user-plus"></i>
        Create Account
      </button>
    </form>

    <div class="login-link">
      <p>Already have an account? <a href="/login">Sign in here</a></p>
    </div>
  </div>
  </div>

<?php include __DIR__ . '/components/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const passwordInput = document.getElementById('password');
      const submitBtn = document.querySelector('.register-btn');
      const form = document.querySelector('form');

      // Password requirements
      const requirements = {
        length: {
          element: document.getElementById('req-length'),
          test: (password) => password.length >= 8
        },
        uppercase: {
          element: document.getElementById('req-uppercase'),
          test: (password) => /[A-Z]/.test(password)
        },
        lowercase: {
          element: document.getElementById('req-lowercase'),
          test: (password) => /[a-z]/.test(password)
        },
        number: {
          element: document.getElementById('req-number'),
          test: (password) => /[0-9]/.test(password)
        },
        special: {
          element: document.getElementById('req-special'),
          test: (password) => /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)
        }
      };

      function validatePassword() {
        const password = passwordInput.value;
        let allValid = true;

        // Check each requirement
        Object.keys(requirements).forEach(key => {
          const req = requirements[key];
          const isValid = req.test(password);

          req.element.classList.remove('valid', 'invalid');
          req.element.classList.add(isValid ? 'valid' : 'invalid');

          const icon = req.element.querySelector('i');
          icon.className = isValid ? 'fas fa-check' : 'fas fa-times';

          if (!isValid) allValid = false;
        });

        // Update submit button state
        submitBtn.disabled = !allValid;

        return allValid;
      }

      // Real-time validation
      passwordInput.addEventListener('input', validatePassword);

      // Form submission validation
      form.addEventListener('submit', function(e) {
        if (!validatePassword()) {
          e.preventDefault();
          alert('Please ensure your password meets all requirements.');
        }
      });

      // Initial validation
      validatePassword();
    });
  </script>

  <?php include __DIR__ . '/components/footer.php'; ?>
</body>

</html>