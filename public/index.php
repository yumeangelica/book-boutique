<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$request = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Parse the request to separate path from query parameters
$parsedUrl = parse_url($request);
$path = $parsedUrl['path'];
$queryParams = [];
if (isset($parsedUrl['query'])) {
  parse_str($parsedUrl['query'], $queryParams);
}

// Regex patterns for dynamic URLs
$deletePattern = '/^\/books\/delete\/(\d+)$/';
$editPattern = '/^\/books\/edit\/(\d+)$/';
$updatePattern = '/^\/books\/update\/(\d+)$/';

if (preg_match($deletePattern, $path, $matches)) {
  if ($requestMethod === 'POST') {
    $controller = new \Controller\BookController();
    $controller->delete($matches[1]);
  } else {
    header('Location: /books');
  }
  exit;
} elseif (preg_match($editPattern, $path, $matches) && $requestMethod == 'GET') {
  $controller = new \Controller\BookController();
  $controller->showEditForm($matches[1]);
  exit;
} elseif (preg_match($updatePattern, $path, $matches) && $requestMethod == 'POST') {
  $controller = new \Controller\BookController();
  $controller->update($matches[1]);
  exit;
}


switch ($path) {
  case '/':
  case '/login':
    if ($requestMethod === 'POST') {
      if (!\Controller\Csrf::validate($_POST['csrf_token'] ?? '')) {
        $error = "Invalid form submission. Please try again.";
      } else {
        $controller = new \Controller\AuthController();
        if ($controller->login($_POST['username'] ?? '', $_POST['password'] ?? '')) {
          header('Location: /dashboard');
          exit;
        } else {
          $error = "Invalid username or password.";
        }
      }
    }
    // Check if user was redirected after successful registration or account deletion
    $success = null;
    if (isset($queryParams['registered'])) {
      $success = "Registration successful! Please login with your credentials.";
    } elseif (isset($queryParams['deleted'])) {
      $success = "Your account has been successfully deleted.";
    }
    require_once __DIR__ . '/../src/View/login.php';
    break;

  case '/register':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $controller = new \Controller\AuthController();
      $controller->register();
    } else {
      require __DIR__ . '/../src/View/register.php';
    }
    break;
  case '/dashboard':
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
      header('Location: /login');
      exit;
    }
    require __DIR__ . '/../src/View/dashboard.php';
    break;
  case '/books':
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
      header('Location: /login');
      exit;
    }
    $controller = new \Controller\BookController();
    $controller->index();
    break;
  case '/books/new':
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
      header('Location: /login');
      exit;
    }
    require __DIR__ . '/../src/View/add_book.php';
    break;
  case '/books/add':
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
      header('Location: /login');
      exit;
    }
    $controller = new \Controller\BookController();
    $controller->add();
    break;
  case '/logout':
    session_unset();
    session_destroy();
    header('Location: /login');
    exit;
    break;
  case '/account':
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
      header('Location: /login');
      exit;
    }
    require __DIR__ . '/../src/View/account.php';
    break;
  case '/delete-account':
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
      header('Location: /login');
      exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $controller = new \Controller\AuthController();
      $controller->deleteAccount();
    } else {
      header('Location: /account');
      exit;
    }
    break;
  case '/change-password':
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
      header('Location: /login');
      exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $controller = new \Controller\AuthController();
      $controller->changePassword();
    } else {
      header('Location: /account');
      exit;
    }
    break;
  default:
    http_response_code(404);
    echo '404 Not Found';
    break;
}
