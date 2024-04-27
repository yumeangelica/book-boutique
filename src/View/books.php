<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Books</title>
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
      max-width: 800px;
      padding: 20px;
      background-color: #f0e3ff;
      border-radius: 25px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    h1 {
      color: #7d5dbd;
    }

    .btn {
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #bda6ff;
    }

    .custom-add-button-purple {
      background-color: #bda6ff;
      border-color: #7d5dbd;
    }

    .custom-add-button-purple:hover {
      background-color: #a893ee;
      border-color: #7d5dbd;
      color: #ffffff;
    }

    .custom-delete-button-red {
      background-color: #e55050;
      border-color: #ff7676;
    }

    .custom-delete-button-red:hover {
      background-color: #b23e3e;
      border-color: #ff5959;
      color: #ffffff;
    }

    .btn-success {
      background-color: #bda6ff;
      border-color: #7d5dbd;
      font-weight: bold;
    }

    .btn-primary {
      background-color: #7d5dbd;
      border-color: #7d5dbd;
      font-weight: bold;
    }

    .alert {
      margin-top: 15px;
    }

    .alert-success {
      background-color: #d9ffe4;
      border-color: #80c58a;
      color: #295229;
    }

    .alert-danger {
      background-color: #ffd6d6;
      border-color: #e16c6c;
      color: #5c1e1e;
    }

    .table {
      background-color: #f9f9f9;
      border-radius: 15px;
      overflow: hidden;
    }

    th,
    td {
      border: none;
      padding: 10px;
    }

    th {
      background-color: #e3d4ff;
      color: #7d5dbd;
    }

    tbody tr:nth-child(even) {
      background-color: #f4f4f4;
    }
  </style>
</head>

<body>
  <div class="container text-center">
    <h1>Books</h1>

    <?php if (!empty($successMessage)) : ?>
      <div class="alert alert-success" role="alert"><?= $successMessage ?></div>
    <?php endif; ?>

    <?php if (!empty($errorMessage)) : ?>
      <div class="alert alert-danger" role="alert"><?= $errorMessage ?></div>
    <?php endif; ?>

    <?php if (!empty($books)) : ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Published Year</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($books as $book) : ?>
            <tr>
              <td><?= htmlspecialchars($book['title']) ?></td>
              <td><?= htmlspecialchars($book['author']) ?></td>
              <td><?= htmlspecialchars($book['isbn']) ?></td>
              <td><?= htmlspecialchars($book['published_year']) ?></td>
              <td>
                <a href="/books/edit/<?= $book['id'] ?>" class="btn btn-info custom-add-button-purple">Edit</a>
                <a href="/books/delete/<?= $book['id'] ?>" class="btn btn-danger custom-delete-button-red">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else : ?>
      <p>No books found.</p>
    <?php endif; ?>

    <a href="/dashboard" class="btn btn-primary mt-3">Go Back</a>
    <a href="/books/new" class="btn btn-success mt-3">Add New Book</a>
  </div>
</body>

</html>