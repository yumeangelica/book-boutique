<?php

namespace Model;

use mysqli;

class Database
{
  private static $connection;
  private static $initialized = false;

  public static function getConnection()
  {
    if (self::$connection === null) {
      $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../..');
      $dotenv->load();

      $host = $_ENV['DB_HOST'];
      $username = $_ENV['DB_USER'];
      $password = $_ENV['DB_PASS'];
      $database = $_ENV['DB_NAME'];

      self::$connection = new mysqli($host, $username, $password, $database);

      if (self::$connection->connect_error) {
        // Log details server-side only; never expose connection internals to the client
        error_log("Database connection failed: " . self::$connection->connect_error);
        http_response_code(500);
        exit('Service temporarily unavailable. Please try again later.');
      }

      // Initialize database tables if they don't exist (only once)
      if (!self::$initialized) {
        self::initializeTables();
        self::$initialized = true;
      }
    }
    return self::$connection;
  }

  // Convenience for the manual (non-Docker) install path; sql/init.sql is the
  // canonical schema and is used by the Docker MySQL container on first start.
  private static function initializeTables()
  {
    // Create users table if it doesn't exist
    $usersTable = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    // Execute users table creation first
    if (!self::$connection->query($usersTable)) {
        error_log("Error creating users table: " . self::$connection->error);
    }

    // Check if books table exists before creating it with foreign key
    $checkBooksTable = "SELECT 1 FROM information_schema.tables WHERE table_schema = DATABASE() AND table_name = 'books'";
    $result = self::$connection->query($checkBooksTable);

    if ($result->num_rows == 0) {
        // Create books table only if it doesn't exist
        $booksTable = "CREATE TABLE books (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            author VARCHAR(255) NOT NULL,
            isbn VARCHAR(20),
            published_year INT,
            user_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        )";

        if (!self::$connection->query($booksTable)) {
            error_log("Error creating books table: " . self::$connection->error);
        }
    }
  }

  public function close()
  {
    if (self::$connection !== null) {
      self::$connection->close();
    }
  }
}
