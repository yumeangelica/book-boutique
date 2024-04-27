<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      background-color: #f7f1ff;
    }

    .container {
      width: 100%;
      max-width: 600px;
      padding: 20px;
      background-color: #f0e3ff;
      border-radius: 25px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #7d5dbd;
    }

    .btn {
      font-weight: bold;
      color: #ffffff;
    }

    .btn-primary {
      background-color: #7d5dbd;
      border-color: #7d5dbd;
    }

    .btn-primary:hover {
      background-color: #a893ee;
      border-color: #7d5dbd;
    }
  </style>
</head>

<body>
  <div class="container text-center">
    <h1>Welcome to the Dashboard, <?php echo htmlspecialchars($username); ?></h1>
    <p>You are logged in.</p>
    <a class="btn btn-primary" href="/logout">Logout</a>
    <a class="btn btn-primary" href="/books">View Books</a>
  </div>
</body>

</html>