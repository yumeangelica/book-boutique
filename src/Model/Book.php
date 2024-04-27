<?php

namespace Model;

class Book
{
  public static function getAll()
  {
    $conn = Database::getConnection();
    $result = $conn->query("SELECT * FROM Books");
    $books = [];
    while ($row = $result->fetch_assoc()) {
      $books[] = $row;
    }
    return $books;
  }

  public static function addBook($title, $author, $isbn, $publishedYear, $userId)
  {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("INSERT INTO Books (title, author, isbn, published_year, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $title, $author, $isbn, $publishedYear, $userId);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

  public static function getAllByUserId($userId)
  {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("SELECT * FROM Books WHERE user_id = ?");
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

  public static function deleteById($id)
  {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("DELETE FROM Books WHERE id = ?");
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }

  public static function getById($id)
  {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("SELECT * FROM Books WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result) {
      return $result->fetch_assoc();
    }
    $stmt->close();
    return null;
  }

  public static function updateById($id, $title, $author, $isbn, $publishedYear)
  {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("UPDATE Books SET title = ?, author = ?, isbn = ?, published_year = ? WHERE id = ?");
    $stmt->bind_param("sssii", $title, $author, $isbn, $publishedYear, $id);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
  }
}
