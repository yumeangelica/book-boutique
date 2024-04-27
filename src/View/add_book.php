<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Add New Book</title>
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

    h2 {
      margin-bottom: 20px;
      color: #7d5dbd;
    }

    .form-group {
      margin-bottom: 25px;
    }

    .form-control {
      border-color: #bda6ff;
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

    .btn {
      margin-top: 20px;
      transition: background-color 0.3s ease;
    }

    .btn:hover {
      background-color: #bda6ff;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center">Add New Book</h2>
        <form action="/books/add" method="post">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>
          <div class="form-group">
            <label for="author">Author</label>
            <input type="text" class="form-control" id="author" name="author" required>
          </div>
          <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" id="isbn" name="isbn" required>
          </div>
          <div class="form-group">
            <label for="published_year">Published Year</label>
            <input type="number" class="form-control" id="published_year" name="published_year">
          </div>
          <button type="submit" class="btn btn-success">Add Book</button>
        </form>
        <a href="/books" class="btn btn-primary">Back to Book List</a>
      </div>
    </div>
  </div>
</body>

</html>