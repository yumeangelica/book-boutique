<?php

namespace Controller;

use Model\Book;

class BookController
{
  private function requireAuthenticated()
  {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || !isset($_SESSION['user_id'])) {
      header('Location: /login');
      exit;
    }

    return (int) $_SESSION['user_id'];
  }

  public function index()
  {
    $userId = $this->requireAuthenticated();
    $books = Book::getAllByUserId($userId);
    $errorMessage = null;
    if (isset($_GET['error']) && $_GET['error'] === 'notfound') {
      $errorMessage = "Book not found.";
    } elseif (isset($_GET['error']) && $_GET['error'] === 'invalidform') {
      $errorMessage = "Invalid form submission. Please try again.";
    }
    require_once __DIR__ . '/../View/books.php';
  }

  public function add()
  {
    $userId = $this->requireAuthenticated();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: /books/new');
      exit;
    }

    if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
      $error = "Invalid form submission. Please try again.";
      require __DIR__ . '/../View/add_book.php';
      return;
    }

    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $isbn = trim($_POST['isbn'] ?? '');
    $publishedYear = trim($_POST['published_year'] ?? '');
    $validation = $this->validateBookInput($title, $author, $isbn, $publishedYear);

    if (!$validation['valid']) {
      $error = implode(' ', $validation['errors']);
      require __DIR__ . '/../View/add_book.php';
      return;
    }

    $result = Book::addBook($title, $author, $validation['isbn'], $validation['publishedYear'], $userId);
    if ($result) {
      header('Location: /books');
      exit;
    }

    $error = "Failed to add book. Please try again.";
    require __DIR__ . '/../View/add_book.php';
  }

  public function delete($id)
  {
    $userId = $this->requireAuthenticated();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: /books');
      exit;
    }

    if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
      header('Location: /books?error=invalidform');
      exit;
    }

    Book::deleteById($id, $userId);
    header('Location: /books');
    exit;
  }

  public function showEditForm($id)
  {
    $userId = $this->requireAuthenticated();

    $book = Book::getById($id, $userId);
    if ($book) {
      require_once __DIR__ . '/../View/edit_book.php';
    } else {
      header('Location: /books?error=notfound');
      exit;
    }
  }

  public function update($id)
  {
    $userId = $this->requireAuthenticated();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      header('Location: /books/edit/' . $id);
      exit;
    }

    $book = Book::getById($id, $userId);
    if (!$book) {
      header('Location: /books?error=notfound');
      exit;
    }

    if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
      $error = "Invalid form submission. Please try again.";
      require __DIR__ . '/../View/edit_book.php';
      return;
    }

    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $isbn = trim($_POST['isbn'] ?? '');
    $publishedYear = trim($_POST['published_year'] ?? '');
    $validation = $this->validateBookInput($title, $author, $isbn, $publishedYear);

    $book = [
      'id' => (int) $id,
      'title' => $title,
      'author' => $author,
      'isbn' => $isbn,
      'published_year' => $publishedYear,
    ];

    if (!$validation['valid']) {
      $error = implode(' ', $validation['errors']);
      require __DIR__ . '/../View/edit_book.php';
      return;
    }

    $result = Book::updateById($id, $title, $author, $validation['isbn'], $validation['publishedYear'], $userId);
    if ($result) {
      header('Location: /books');
      exit;
    }

    $error = "Failed to update book. Please try again.";
    require __DIR__ . '/../View/edit_book.php';
  }

  private function validateBookInput($title, $author, $isbn, $publishedYear)
  {
    $errors = [];

    if ($title === '') {
      $errors[] = "Title is required.";
    } elseif (strlen($title) < 2 || strlen($title) > 255) {
      $errors[] = "Title must be between 2 and 255 characters.";
    }

    if ($author === '') {
      $errors[] = "Author is required.";
    } elseif (strlen($author) < 2 || strlen($author) > 255) {
      $errors[] = "Author must be between 2 and 255 characters.";
    }

    $isbn = $isbn === '' ? null : $isbn;
    if ($isbn !== null && !$this->isValidIsbn($isbn)) {
      $errors[] = "Please enter a valid ISBN-10 or ISBN-13.";
    }

    $publishedYear = $publishedYear === '' ? null : $publishedYear;
    if ($publishedYear !== null) {
      $currentYear = (int) date('Y');
      if (!ctype_digit($publishedYear) || (int) $publishedYear < 1000 || (int) $publishedYear > $currentYear) {
        $errors[] = "Published year must be between 1000 and {$currentYear}.";
      } else {
        $publishedYear = (int) $publishedYear;
      }
    }

    return [
      'valid' => empty($errors),
      'errors' => $errors,
      'isbn' => $isbn,
      'publishedYear' => $publishedYear,
    ];
  }

  private function isValidIsbn($isbn)
  {
    $clean = strtoupper(preg_replace('/[^0-9X]/i', '', $isbn));

    if (strlen($clean) === 10) {
      $digits = substr($clean, 0, 9);
      $check = substr($clean, 9, 1);
      if (!preg_match('/^\d{9}$/', $digits)) {
        return false;
      }

      $sum = 0;
      for ($i = 0; $i < 9; $i++) {
        $sum += (int) $digits[$i] * (10 - $i);
      }

      $remainder = $sum % 11;
      $expected = $remainder === 0 ? '0' : ($remainder === 1 ? 'X' : (string) (11 - $remainder));
      return $check === $expected;
    }

    if (strlen($clean) === 13) {
      if (!preg_match('/^\d{13}$/', $clean)) {
        return false;
      }

      $sum = 0;
      for ($i = 0; $i < 12; $i++) {
        $sum += (int) $clean[$i] * ($i % 2 === 0 ? 1 : 3);
      }

      return (int) $clean[12] === (10 - ($sum % 10)) % 10;
    }

    return false;
  }
}
