<?php

namespace Controller;

use Model\Book;

class BookController
{
  public function index()
  {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
      header('Location: /login');
      exit;
    }
    $userId = $_SESSION['user_id'];
    $books = Book::getAllByUserId($userId);
    require_once __DIR__ . '/../View/books.php';
  }

  public function add()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $title = $_POST['title'] ?? null;
      $author = $_POST['author'] ?? null;
      $isbn = $_POST['isbn'] ?? null;
      $publishedYear = $_POST['published_year'] ?? null;
      $userId = $_SESSION['user_id'] ?? null;

      if ($title && $author && $isbn && $publishedYear && $userId) {
        $result = Book::addBook($title, $author, $isbn, $publishedYear, $userId);
        if ($result) {
          header('Location: /books');
          exit;
        } else {
          header('Location: /books/');
          exit;
        }
      } else {
        header('Location: /books/');
        exit;
      }
    }
  }

  public function delete($id)
  {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
      header('Location: /login');
      exit;
    }

    $result = Book::deleteById($id);
    if ($result) {
      header('Location: /books');
    } else {
      header('Location: /books');
    }
    exit;
  }

  public function showEditForm($id)
  {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
      header('Location: /login');
      exit;
    }

    $book = Book::getById($id);
    if ($book) {
      require_once __DIR__ . '/../View/edit_book.php';
    } else {
      header('Location: /books?error=notfound');
      exit;
    }
  }

  public function update($id)
  {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
      header('Location: /login');
      exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $title = $_POST['title'] ?? null;
      $author = $_POST['author'] ?? null;
      $isbn = $_POST['isbn'] ?? null;
      $publishedYear = $_POST['published_year'] ?? null;

      if ($title && $author && $isbn && $publishedYear) {
        $result = Book::updateById($id, $title, $author, $isbn, $publishedYear);
        if ($result) {
          header('Location: /books');
          exit;
        } else {
          header('Location: /books/edit/' . $id . '?error=updatefailed');
          exit;
        }
      } else {
        header('Location: /books/edit/' . $id . '?error=requiredfields');
        exit;
      }
    }
  }
}
