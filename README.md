# BookBoutique
Welcome to BookBoutique, a simple yet elegant PHP web application for managing a personal library of books. This system allows users to register, authenticate, and perform CRUD operations on their book collections, with each collection being personal and unique to the user.

## Features

- User registration and authentication.
- Personalized book management: Add, view, edit, and delete books.

## Prerequisites

- PHP 8.1 or higher
- MySQL 8.0 or higher
- Composer for managing PHP dependencies
- Homebrew (optional) for installing MySQL on macOS

## Installation

1. Clone the repository
```sh
git clone https://github.com/yumeangelica/book-boutique.git
```


2. Navigate to the project directory:
```sh
cd book-boutique
```


3. Install dependencies with Composer:
```sh
composer install
```

4. Create a .env file in the root directory

Create a .env file in the root directory of your project. This file will store sensitive database connection settings separate from your main codebase, enhancing security. Add the following lines to configure your database connection:

```sh
- DB_HOST=localhost
- DB_USER=your_database_user
- DB_PASS=your_database_password
- DB_NAME=your_database_name
```

Ensure that each variable is correctly set according to your local or production database server settings.

5. Ensure the database server is running

Before proceeding with the database setup, make sure that your MySQL server is active. For macOS users who installed MySQL using Homebrew, you can start the MySQL service with the following command:

```sh
brew services start mysql
```

This step ensures that the MySQL database is running and ready to connect, preventing errors during the database creation and table setup.

6. Create the database and tables:

Execute the following SQL commands within your database management tool or MySQL command line to set up the necessary database structure:

```sh

CREATE DATABASE IF NOT EXISTS `your_database_name`;
USE `your_database_name`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `isbn` varchar(20) NOT NULL,
  `published_year` int(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

After setting up the database and tables, verify that the connections and structure are working as expected by inserting a test record or using a database inspection tool.


## Running the application

To run the application from the root directory, use the following command:

```sh
php -S localhost:8000 -t public
```

You can now access the application by visiting `http://localhost:8000` in your web browser.
