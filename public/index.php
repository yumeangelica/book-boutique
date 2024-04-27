<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$request = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Regex patterns for dynamic URLs
$deletePattern = '/^\/books\/delete\/(\d+)$/';
$editPattern = '/^\/books\/edit\/(\d+)$/';
$updatePattern = '/^\/books\/update\/(\d+)$/';

if (preg_match($deletePattern, $request, $matches) && $requestMethod == 'GET') {
  $controller = new \Controller\BookController();
  $controller->delete($matches[1]);
  exit;
} elseif (preg_match($editPattern, $request, $matches) && $requestMethod == 'GET') {
  $controller = new \Controller\BookController();
  $controller->showEditForm($matches[1]);
  exit;
} elseif (preg_match($updatePattern, $request, $matches) && $requestMethod == 'POST') {
  $controller = new \Controller\BookController();
  $controller->update($matches[1]);
  exit;
}


switch ($request) {
  case '/':
  case '/login':
    if ($requestMethod === 'POST') {
      $controller = new \Controller\AuthController();
      if ($controller->login($_POST['username'], $_POST['password'])) {
        $_SESSION['logged_in'] = true;
        header('Location: /dashboard');
        exit;
      } else {
        $error = "Invalid username or password.";
      }
    }
    require_once __DIR__ . '/../src/View/login.php';
    break;

  case '/register':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $controller = new \Controller\AuthController();
      $controller->register();
    } else {
      require __DIR__ . '/../src/View/register.html';
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
    require __DIR__ . '/../src/View/add_book.html';
    break;
  case '/books/add':
    $controller = new \Controller\BookController();
    $controller->add();
    break;
  case '/books/edit/(\d+)':
    $controller = new \Controller\BookController();
    $controller->showEditForm($matches[1]);
    break;
  case '/books/update/(\d+)':
    $controller = new \Controller\BookController();
    $controller->update($matches[1]);
    break;
  case '/logout':
    session_unset();
    session_destroy();
    header('Location: /login');
    exit;
    break;
  default:
    http_response_code(404);
    echo '404 Not Found';
    break;
}
