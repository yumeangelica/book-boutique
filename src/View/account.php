<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$error = isset($error) ? $error : '';
$success = isset($success) ? $success : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Settings - Book Boutique</title>
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
      --danger: #dc3545;
      --danger-light: #f8d7da;
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

    .account-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      padding: 40px;
      width: 100%;
      max-width: 500px;
      box-shadow:
        0 20px 40px var(--shadow),
        0 0 0 1px rgba(255, 255, 255, 0.5);
      border: 1px solid rgba(212, 165, 165, 0.2);
      position: relative;
      z-index: 1;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .account-container:hover {
      transform: translateY(-2px);
      box-shadow:
        0 25px 50px var(--shadow-hover),
        0 0 0 1px rgba(255, 255, 255, 0.6);
    }

    .header {
      text-align: center;
      margin-bottom: 32px;
    }

    .user-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, var(--primary-pink), var(--accent-pink));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      box-shadow: 0 8px 16px var(--shadow);
    }

    .user-icon i {
      font-size: 36px;
      color: white;
    }

    h1 {
      color: var(--text-dark);
      font-size: 28px;
      font-weight: 700;
      margin: 0;
    }

    .account-info {
      background: rgba(212, 165, 165, 0.1);
      border-radius: 16px;
      padding: 24px;
      margin-bottom: 24px;
      border: 1px solid rgba(212, 165, 165, 0.2);
    }

    .account-info h3 {
      color: var(--text-dark);
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 16px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .info-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 0;
      border-bottom: 1px solid rgba(212, 165, 165, 0.15);
    }

    .info-item:last-child {
      border-bottom: none;
    }

    .info-label {
      color: var(--text-light);
      font-weight: 500;
      font-size: 14px;
    }

    .info-value {
      color: var(--text-dark);
      font-weight: 600;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--primary-pink), var(--accent-pink));
      border: none;
      border-radius: 12px;
      padding: 12px 24px;
      font-weight: 600;
      font-size: 14px;
      color: white;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      width: 100%;
      justify-content: center;
      margin-bottom: 12px;
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, var(--accent-pink), var(--dark-pink));
      transform: translateY(-1px);
      box-shadow: 0 8px 16px var(--shadow);
      color: white;
    }

    .btn-danger {
      background: linear-gradient(135deg, var(--danger), #c82333);
      border: none;
      border-radius: 12px;
      padding: 12px 24px;
      font-weight: 600;
      font-size: 14px;
      color: white;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      width: 100%;
      justify-content: center;
      margin-bottom: 12px;
    }

    .btn-danger:hover {
      background: linear-gradient(135deg, #c82333, #a71e2a);
      transform: translateY(-1px);
      box-shadow: 0 8px 16px rgba(220, 53, 69, 0.3);
      color: white;
    }

    .btn-secondary {
      background: rgba(212, 165, 165, 0.1);
      border: 1px solid rgba(212, 165, 165, 0.3);
      border-radius: 12px;
      padding: 12px 24px;
      font-weight: 600;
      font-size: 14px;
      color: var(--text-dark);
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      width: 100%;
      justify-content: center;
      margin-bottom: 12px;
      text-decoration: none;
    }

    .btn-secondary:hover {
      background: rgba(212, 165, 165, 0.2);
      transform: translateY(-1px);
      box-shadow: 0 4px 8px var(--shadow);
      color: var(--text-dark);
    }

    .alert {
      border-radius: 12px;
      padding: 16px;
      margin-bottom: 20px;
      border: none;
      font-weight: 500;
    }

    .alert-danger {
      background: var(--danger-light);
      color: var(--danger);
    }

    .alert-success {
      background: #d4edda;
      color: #155724;
    }

    .password-change-form {
      display: none;
      margin-top: 16px;
      padding: 20px;
      background: rgba(212, 165, 165, 0.05);
      border-radius: 12px;
      border: 1px solid rgba(212, 165, 165, 0.2);
    }

    .password-change-form.show {
      display: block;
    }

    .password-change-form .form-control {
      border-radius: 8px;
      border: 1px solid rgba(212, 165, 165, 0.3);
      padding: 10px;
      font-size: 14px;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
      width: 100%;
    }

    .password-change-form .form-control:focus {
      outline: none;
      border-color: var(--primary-pink);
      box-shadow: 0 0 0 2px var(--shadow);
    }

    .password-change-form .form-group {
      margin-bottom: 16px;
    }

    .password-change-form .password-requirements {
      margin: 12px 0;
      padding: 12px;
      background: rgba(255, 255, 255, 0.5);
      border-radius: 8px;
      border: 1px solid rgba(212, 165, 165, 0.2);
      font-size: 13px;
    }

    .password-change-form .requirements-title {
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 8px;
      font-size: 14px;
    }

    .password-change-form .requirement {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 4px;
      transition: all 0.3s ease;
    }

    .password-change-form .requirement i {
      width: 16px;
      height: 16px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 10px;
      transition: all 0.3s ease;
    }

    .password-change-form .requirement.invalid i {
      background: #ff4757;
      color: white;
    }

    .password-change-form .requirement.valid i {
      background: #2ed573;
      color: white;
    }

    .password-change-form .requirement.invalid {
      color: #ff4757;
    }

    .password-change-form .requirement.valid {
      color: #2ed573;
    }

    #passwordMatchMessage {
      font-weight: 500;
    }

    #passwordMatchMessage.match {
      color: #2ed573;
    }

    #passwordMatchMessage.no-match {
      color: #ff4757;
    }

    .delete-confirmation {
      display: none;
      margin-top: 16px;
      padding: 16px;
      background: rgba(220, 53, 69, 0.1);
      border-radius: 8px;
      border: 1px solid rgba(220, 53, 69, 0.3);
    }

    .delete-confirmation.show {
      display: block;
    }

    .confirmation-text {
      color: var(--danger);
      font-weight: 500;
      margin-bottom: 12px;
    }

    .password-confirmation .form-control {
      border-radius: 8px;
      border: 1px solid rgba(220, 53, 69, 0.3);
      padding: 10px;
      font-size: 14px;
      transition: border-color 0.3s ease;
    }

    .password-confirmation .form-control:focus {
      outline: none;
      border-color: var(--danger);
      box-shadow: 0 0 0 2px rgba(220, 53, 69, 0.2);
    }

    .password-confirmation small {
      color: var(--danger);
      font-size: 12px;
      font-weight: 500;
    }

    /* Responsive design */
    @media (max-width: 768px) {
      body {
        padding: 10px;
      }

      .account-container {
        padding: 24px;
        max-width: 100%;
      }

      h1 {
        font-size: 24px;
      }
    }
  </style>
</head>

<body>
  <div class="main-content">
    <div class="account-container">
    <div class="header">
      <div class="user-icon">
        <i class="fas fa-user"></i>
      </div>
      <h1>Account Settings</h1>
    </div>

    <?php if ($error): ?>
      <div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?>
      </div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($success); ?>
      </div>
    <?php endif; ?>

    <div class="account-info">
      <h3><i class="fas fa-user-circle"></i> Account Information</h3>
      <div class="info-item">
        <span class="info-label">Username:</span>
        <span class="info-value"><?php echo htmlspecialchars($username); ?></span>
      </div>
      <div class="info-item">
        <span class="info-label">Account Status:</span>
        <span class="info-value">Active</span>
      </div>
    </div>

    <button class="btn-primary" onclick="togglePasswordChange()">
      <i class="fas fa-key"></i>
      Change Password
    </button>

    <!-- Password Change Form -->
    <div id="passwordChangeForm" class="password-change-form">
      <form method="POST" action="/change-password" id="changePasswordForm">
        <div class="form-group">
          <label for="current_password" style="color: var(--text-dark); font-weight: 500; margin-bottom: 8px; display: block;">Current Password</label>
          <input type="password" id="current_password" name="current_password" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="new_password" style="color: var(--text-dark); font-weight: 500; margin-bottom: 8px; display: block;">New Password</label>
          <input type="password" id="new_password" name="new_password" class="form-control" required>
        </div>

        <div class="password-requirements">
          <div class="requirements-title">Password Requirements:</div>
          <div class="requirement invalid" id="lengthReq">
            <i class="fas fa-times"></i>
            <span>At least 8 characters</span>
          </div>
          <div class="requirement invalid" id="uppercaseReq">
            <i class="fas fa-times"></i>
            <span>One uppercase letter</span>
          </div>
          <div class="requirement invalid" id="lowercaseReq">
            <i class="fas fa-times"></i>
            <span>One lowercase letter</span>
          </div>
          <div class="requirement invalid" id="numberReq">
            <i class="fas fa-times"></i>
            <span>One number</span>
          </div>
          <div class="requirement invalid" id="specialReq">
            <i class="fas fa-times"></i>
            <span>One special character</span>
          </div>
        </div>

        <div class="form-group">
          <label for="confirm_password" style="color: var(--text-dark); font-weight: 500; margin-bottom: 8px; display: block;">Confirm New Password</label>
          <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
          <div id="passwordMatchMessage" style="margin-top: 8px; font-size: 13px;"></div>
        </div>

        <button type="submit" class="btn-primary" id="changePasswordBtn" disabled>
          <i class="fas fa-key"></i>
          Update Password
        </button>
        <button type="button" class="btn-secondary" onclick="togglePasswordChange()">
          <i class="fas fa-times"></i>
          Cancel
        </button>
      </form>
    </div>

    <a href="/dashboard" class="btn-secondary">
      <i class="fas fa-arrow-left"></i>
      Back to Dashboard
    </a>

    <button class="btn-danger" onclick="toggleDeleteConfirmation()">
      <i class="fas fa-trash-alt"></i>
      Delete Account
    </button>

    <!-- Delete Account Confirmation -->
    <div id="deleteConfirmation" class="delete-confirmation">
      <div class="confirmation-text">
        <i class="fas fa-exclamation-triangle"></i>
        This action cannot be undone. All your books will be permanently deleted.
      </div>
      <form method="POST" action="/delete-account">
        <div class="password-confirmation">
          <label for="confirm_password_delete" style="color: var(--danger); font-weight: 500; margin-bottom: 8px; display: block;">
            Enter your password to confirm:
          </label>
          <input type="password" id="confirm_password_delete" name="confirm_password" class="form-control" required>
          <small>This action will permanently delete your account and all associated data.</small>
        </div>
        <button type="submit" class="btn-danger" style="margin-top: 12px;">
          <i class="fas fa-trash-alt"></i>
          Permanently Delete Account
        </button>
        <button type="button" class="btn-secondary" onclick="toggleDeleteConfirmation()" style="margin-top: 4px;">
          <i class="fas fa-times"></i>
          Cancel
        </button>
      </form>
    </div>

    <div style="text-align: center; margin-top: 24px;">
      <a href="#" onclick="confirmLogout()" style="color: var(--text-light); text-decoration: none; font-size: 14px;">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </div>
  </div>
  </div>

  <script>
    function togglePasswordChange() {
      const form = document.getElementById('passwordChangeForm');
      form.classList.toggle('show');

      if (!form.classList.contains('show')) {
        // Reset form when hiding
        document.getElementById('changePasswordForm').reset();
        resetPasswordRequirements();
        document.getElementById('passwordMatchMessage').textContent = '';
        document.getElementById('changePasswordBtn').disabled = true;
      }
    }

    function toggleDeleteConfirmation() {
      const confirmation = document.getElementById('deleteConfirmation');
      confirmation.classList.toggle('show');
    }

    function confirmLogout() {
      if (confirm('Are you sure you want to logout?')) {
        window.location.href = '/logout';
      }
    }

    // Password validation logic
    const newPasswordInput = document.getElementById('new_password');
    const confirmPasswordInput = document.getElementById('confirm_password');
    const changePasswordBtn = document.getElementById('changePasswordBtn');

    function validatePassword() {
      const password = newPasswordInput.value;

      // Length requirement
      const lengthReq = document.getElementById('lengthReq');
      if (password.length >= 8) {
        lengthReq.classList.remove('invalid');
        lengthReq.classList.add('valid');
        lengthReq.querySelector('i').className = 'fas fa-check';
      } else {
        lengthReq.classList.remove('valid');
        lengthReq.classList.add('invalid');
        lengthReq.querySelector('i').className = 'fas fa-times';
      }

      // Uppercase requirement
      const uppercaseReq = document.getElementById('uppercaseReq');
      if (/[A-Z]/.test(password)) {
        uppercaseReq.classList.remove('invalid');
        uppercaseReq.classList.add('valid');
        uppercaseReq.querySelector('i').className = 'fas fa-check';
      } else {
        uppercaseReq.classList.remove('valid');
        uppercaseReq.classList.add('invalid');
        uppercaseReq.querySelector('i').className = 'fas fa-times';
      }

      // Lowercase requirement
      const lowercaseReq = document.getElementById('lowercaseReq');
      if (/[a-z]/.test(password)) {
        lowercaseReq.classList.remove('invalid');
        lowercaseReq.classList.add('valid');
        lowercaseReq.querySelector('i').className = 'fas fa-check';
      } else {
        lowercaseReq.classList.remove('valid');
        lowercaseReq.classList.add('invalid');
        lowercaseReq.querySelector('i').className = 'fas fa-times';
      }

      // Number requirement
      const numberReq = document.getElementById('numberReq');
      if (/[0-9]/.test(password)) {
        numberReq.classList.remove('invalid');
        numberReq.classList.add('valid');
        numberReq.querySelector('i').className = 'fas fa-check';
      } else {
        numberReq.classList.remove('valid');
        numberReq.classList.add('invalid');
        numberReq.querySelector('i').className = 'fas fa-times';
      }

      // Special character requirement
      const specialReq = document.getElementById('specialReq');
      if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) {
        specialReq.classList.remove('invalid');
        specialReq.classList.add('valid');
        specialReq.querySelector('i').className = 'fas fa-check';
      } else {
        specialReq.classList.remove('valid');
        specialReq.classList.add('invalid');
        specialReq.querySelector('i').className = 'fas fa-times';
      }

      checkPasswordMatch();
      updateSubmitButton();
    }

    function checkPasswordMatch() {
      const password = newPasswordInput.value;
      const confirmPassword = confirmPasswordInput.value;
      const message = document.getElementById('passwordMatchMessage');

      if (confirmPassword === '') {
        message.textContent = '';
        message.className = '';
        return;
      }

      if (password === confirmPassword) {
        message.textContent = '✓ Passwords match';
        message.className = 'match';
      } else {
        message.textContent = '✗ Passwords do not match';
        message.className = 'no-match';
      }

      updateSubmitButton();
    }

    function updateSubmitButton() {
      const password = newPasswordInput.value;
      const confirmPassword = confirmPasswordInput.value;
      const currentPassword = document.getElementById('current_password').value;

      // Check if all requirements are met
      const allRequirementsMet =
        password.length >= 8 &&
        /[A-Z]/.test(password) &&
        /[a-z]/.test(password) &&
        /[0-9]/.test(password) &&
        /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password) &&
        password === confirmPassword &&
        currentPassword.length > 0;

      changePasswordBtn.disabled = !allRequirementsMet;
    }

    function resetPasswordRequirements() {
      const requirements = ['lengthReq', 'uppercaseReq', 'lowercaseReq', 'numberReq', 'specialReq'];
      requirements.forEach(id => {
        const req = document.getElementById(id);
        req.classList.remove('valid');
        req.classList.add('invalid');
        req.querySelector('i').className = 'fas fa-times';
      });
    }

    // Event listeners
    newPasswordInput.addEventListener('input', validatePassword);
    confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    document.getElementById('current_password').addEventListener('input', updateSubmitButton);
  </script>

  <?php include __DIR__ . '/components/footer.php'; ?>
</body>

</html>
