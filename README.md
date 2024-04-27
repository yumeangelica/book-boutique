# BookBoutique
Welcome to BookBoutique, a simple yet elegant PHP web application for managing a personal library of books. This system allows users to register, authenticate, and perform CRUD operations on their book collections, with each collection being personal and unique to the user.

## Features

- User registration and authentication.
- Personalized book management: Add, view, edit, and delete books.

## Prerequisites

- PHP 8.1 or higher
- MySQL 8.0 or higher
- Composer for managing PHP dependencies

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

5. create .env file to root directory and add the following environment variables:

```sh
- DB_HOST=localhost
- DB_USER=your_database_user
- DB_PASS=your_database_password
- DB_NAME=your_database_name
```


6. Create the database and tables:

- Execute the following SQL commands using your database management tool:

```sh

CREATE DATABASE IF NOT EXISTS `your_database_name`;
USE `your_database_name`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
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

## Running the application

To run the application from the root, use the following command:

```sh
php -S localhost:8000 -t public
```