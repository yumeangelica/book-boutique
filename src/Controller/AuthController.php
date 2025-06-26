<?php

namespace Controller;

use Model\User;
use Exception;

class AuthController
{
  public function login($username, $password)
  {
    $user = User::verifyCredentials($username, $password);
    if ($user) {
      $_SESSION['logged_in'] = true;
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['username'] = $user['username'];
      header('Location: /dashboard');
      exit;
    } else {
      $error = "Invalid username or password.";
      require __DIR__ . '/../View/login.php';
      return false;
    }
  }


  public function register()
  {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;
    $error = null;

    if ($username && $password) {
      // Validate password strength
      $passwordValidation = $this->validatePasswordStrength($password);
      if (!$passwordValidation['valid']) {
        $error = $passwordValidation['message'];
        require __DIR__ . '/../View/register.php';
        return;
      }

      // Check if username already exists
      if (User::usernameExists($username)) {
        $error = "Username already exists. Please choose a different username.";
        require __DIR__ . '/../View/register.php';
        return;
      }

      // Encrypt the password
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      try {
        // Create the user
        $result = User::create($username, $hashed_password);

        if ($result) {
          // Redirect to login page with success message
          header('Location: /login?registered=1');
          exit;
        } else {
          $error = "User registration failed. Please try again.";
        }
      } catch (Exception $e) {
        // Handle any database errors
        $error = "Registration failed due to a database error. Please try again.";
        error_log("Registration error: " . $e->getMessage());
      }
    } else {
      $error = "Please provide both username and password.";
    }

    // If we reach here, there was an error
    require __DIR__ . '/../View/register.php';
  }

  private function validatePasswordStrength($password)
  {
    $errors = [];

    // At least 8 characters
    if (strlen($password) < 8) {
      $errors[] = "at least 8 characters";
    }

    // At least one uppercase letter
    if (!preg_match('/[A-Z]/', $password)) {
      $errors[] = "one uppercase letter";
    }

    // At least one lowercase letter
    if (!preg_match('/[a-z]/', $password)) {
      $errors[] = "one lowercase letter";
    }

    // At least one number
    if (!preg_match('/[0-9]/', $password)) {
      $errors[] = "one number";
    }

    // At least one special character
    if (!preg_match('/[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]/', $password)) {
      $errors[] = "one special character (!@#$%^&*)";
    }

    if (empty($errors)) {
      return ['valid' => true, 'message' => ''];
    } else {
      $message = "Password must contain: " . implode(', ', $errors) . ".";
      return ['valid' => false, 'message' => $message];
    }
  }

  public function deleteAccount()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /login');
      exit;
    }

    $userId = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Validate that password was provided
    if (empty($confirmPassword)) {
      $error = "Password confirmation is required to delete your account.";
      require __DIR__ . '/../View/account.php';
      return;
    }

    try {
      // Verify the provided password matches the user's current password
      $user = User::verifyCredentials($username, $confirmPassword);
      if (!$user) {
        $error = "Incorrect password. Please enter your current password to confirm account deletion.";
        require __DIR__ . '/../View/account.php';
        return;
      }

      // Delete the user (this will cascade delete books due to foreign key constraint)
      $result = User::deleteById($userId);

      if ($result) {
        // Destroy session
        session_unset();
        session_destroy();

        // Redirect to login with success message
        header('Location: /login?deleted=1');
        exit;
      } else {
        $error = "Failed to delete account. Please try again.";
        require __DIR__ . '/../View/account.php';
      }
    } catch (Exception $e) {
      $error = "An error occurred while deleting your account. Please try again.";
      require __DIR__ . '/../View/account.php';
    }
  }

  public function changePassword()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: /login');
      exit;
    }

    $userId = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Validate all fields are provided
    if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
      $error = "All password fields are required.";
      require __DIR__ . '/../View/account.php';
      return;
    }

    // Verify new password and confirmation match
    if ($newPassword !== $confirmPassword) {
      $error = "New password and confirmation do not match.";
      require __DIR__ . '/../View/account.php';
      return;
    }

    // Validate new password strength
    $passwordValidation = $this->validatePasswordStrength($newPassword);
    if (!$passwordValidation['valid']) {
      $error = $passwordValidation['message'];
      require __DIR__ . '/../View/account.php';
      return;
    }

    try {
      // Verify current password
      $user = User::verifyCredentials($username, $currentPassword);
      if (!$user) {
        $error = "Current password is incorrect.";
        require __DIR__ . '/../View/account.php';
        return;
      }

      // Check if new password is different from current password
      if (password_verify($newPassword, $user['password_hash'])) {
        $error = "New password must be different from your current password.";
        require __DIR__ . '/../View/account.php';
        return;
      }

      // Hash new password
      $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

      // Update password in database
      $result = User::updatePassword($userId, $newHashedPassword);

      if ($result) {
        $success = "Password successfully changed!";
        require __DIR__ . '/../View/account.php';
      } else {
        $error = "Failed to update password. Please try again.";
        require __DIR__ . '/../View/account.php';
      }
    } catch (Exception $e) {
      $error = "An error occurred while changing your password. Please try again.";
      require __DIR__ . '/../View/account.php';
    }
  }
}
