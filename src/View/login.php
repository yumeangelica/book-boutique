<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
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
      max-width: 400px;
      padding: 20px;
      background-color: #f0e3ff;
      border-radius: 25px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #7d5dbd;
    }

    .btn {
      margin-top: 10px;
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

    .alert {
      margin-top: 15px;
    }

    .alert-danger {
      background-color: #ffd6d6;
      border-color: #e16c6c;
      color: #5c1e1e;
    }
  </style>
</head>

<body>
  <div class="container">
    <?php if (isset($error)) { ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
      </div>
    <?php } ?>

    <h1 class="text-center mb-4">Login</h1>
    <form action="/login" method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      <p class="mt-3">Don't have an account? <a href="/register">Register</a></p>
    </form>
  </div>
</body>

</html>