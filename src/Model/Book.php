<?php

namespace Model;

class Book
{
  public static function addBook($title, $author, $isbn, $publishedYear, $userId)
  {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("INSERT INTO books (title, author, isbn, published_year, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $title, $author, $isbn, $publishedYear, $userId);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

  public static function getAllByUserId($userId)
  {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("SELECT * FROM books WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $books = [];
    while ($row = $result->fetch_assoc()) {
      $books[] = $row;
    }
    $stmt->close();
    return $books;
  }

  public static function deleteById($id, $userId)
  {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $userId);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

  public static function getById($id, $userId)
  {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("SELECT * FROM books WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result ? $result->fetch_assoc() : null;
    $stmt->close();
    return $book;
  }

  public static function updateById($id, $title, $author, $isbn, $publishedYear, $userId)
  {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("UPDATE books SET title = ?, author = ?, isbn = ?, published_year = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("sssiii", $title, $author, $isbn, $publishedYear, $id, $userId);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }
}
