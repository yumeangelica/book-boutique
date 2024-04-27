<?php

namespace Controller;

use Model\User;

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

    if ($username && $password) {
      // Encrypt the password
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // Create the user
      $result = User::create($username, $hashed_password);

      if ($result) {
        // Redirect to login page or dashboard
        header('Location: /login');
      } else {
        // Handle error, user creation failed
        $error = "User registration failed.";
        require __DIR__ . '/../View/register.php';
      }
    }
  }
}
