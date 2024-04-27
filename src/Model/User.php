<?php

namespace Model;

class User
{
  public static function verifyCredentials($username, $password)
  {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("SELECT id, username, password_hash FROM Users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
      if (password_verify($password, $row['password_hash'])) {
        return $row;  // Return the entire row from the database table which contains all the user information
      }
    }
    $stmt->close();
    return false;
  }

  public static function create($username, $hashed_password)
  {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("INSERT INTO Users (username, password_hash) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashed_password);

    $result = $stmt->execute();

    $stmt->close();
    return $result;
  }
}
