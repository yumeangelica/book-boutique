<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Books - Book Boutique</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary-pink: #d4a5a5;
      --secondary-pink: #f2d6d6;
      --light-pink: #faf5f5;
      --accent-pink: #c49494;
      --dark-pink: #b18a8a;
      --text-dark: #6b4c4c;
      --text-light: #8b6b6b;
      --shadow: rgba(212, 165, 165, 0.2);
      --shadow-hover: rgba(212, 165, 165, 0.3);
      --success-green: #c5d4a5;
      --success-light: #f0f5e8;
      --error-red: #d4a5a5;
      --error-light: #faf0f0;
    }

    * {
      box-sizing: border-box;
    }

    html {
      background:
        radial-gradient(circle at 20% 50%, rgba(212, 165, 165, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(212, 165, 165, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(212, 165, 165, 0.06) 0%, transparent 50%),
        linear-gradient(135deg, var(--light-pink) 0%, var(--secondary-pink) 100%);
      min-height: 100%;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background:
        radial-gradient(circle at 20% 50%, rgba(212, 165, 165, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(212, 165, 165, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 40% 80%, rgba(212, 165, 165, 0.06) 0%, transparent 50%),
        linear-gradient(135deg, var(--light-pink) 0%, var(--secondary-pink) 100%);
      min-height: 100vh;
      margin: 0;
      padding: 20px;
      position: relative;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px) rotate(0deg); }
      50% { transform: translateY(-20px) rotate(2deg); }
    }

    .books-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      padding: 40px;
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      box-shadow:
        0 20px 40px var(--shadow),
        0 0 0 1px rgba(255, 255, 255, 0.5);
      border: 1px solid rgba(212, 165, 165, 0.2);
      position: relative;
      z-index: 1;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .books-container:hover {
      transform: translateY(-2px);
      box-shadow:
        0 25px 50px var(--shadow-hover),
        0 0 0 1px rgba(255, 255, 255, 0.6);
    }

    .page-header {
      text-align: center;
      margin-bottom: 32px;
    }

    .brand-icon {
      width: 64px;
      height: 64px;
      background: linear-gradient(135deg, var(--primary-pink), var(--accent-pink));
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 16px;
      box-shadow: 0 8px 16px var(--shadow);
    }

    .brand-icon i {
      font-size: 28px;
      color: white;
    }

    .page-title {
      font-size: 32px;
      font-weight: 700;
      color: var(--text-dark);
      margin: 0 0 8px 0;
      letter-spacing: -0.5px;
    }

    .page-subtitle {
      font-size: 16px;
      color: var(--text-light);
      margin: 0;
      font-weight: 400;
    }

    .alert {
      border: none;
      border-radius: 12px;
      padding: 16px;
      margin-bottom: 24px;
      font-size: 14px;
      font-weight: 500;
    }

    .alert-success {
      background: var(--success-light);
      color: #4c6b4c;
      border-left: 4px solid var(--success-green);
    }

    .alert-danger {
      background: var(--error-light);
      color: #8b4c4c;
      border-left: 4px solid var(--error-red);
    }

    .table-container {
      background: rgba(255, 255, 255, 0.6);
      border-radius: 16px;
      padding: 24px;
      margin-bottom: 24px;
      border: 1px solid rgba(212, 165, 165, 0.1);
      overflow-x: auto;
    }

    .table {
      margin: 0;
      border-collapse: separate;
      border-spacing: 0;
      width: 100%;
    }

    .table th {
      background: linear-gradient(135deg, var(--secondary-pink), var(--light-pink));
      color: var(--text-dark);
      font-weight: 600;
      padding: 16px;
      border: none;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .table th:first-child {
      border-top-left-radius: 12px;
    }

    .table th:last-child {
      border-top-right-radius: 12px;
    }

    .table td {
      padding: 16px;
      border: none;
      border-bottom: 1px solid rgba(212, 165, 165, 0.1);
      color: var(--text-dark);
      font-size: 14px;
    }

    .table tbody tr:hover {
      background-color: rgba(212, 165, 165, 0.05);
    }

    .table tbody tr:last-child td {
      border-bottom: none;
    }

    .table tbody tr:last-child td:first-child {
      border-bottom-left-radius: 12px;
    }

    .table tbody tr:last-child td:last-child {
      border-bottom-right-radius: 12px;
    }

    .action-buttons {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    .btn {
      border: none;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 600;
      padding: 8px 16px;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }

    .btn-edit {
      background: linear-gradient(135deg, var(--primary-pink), var(--accent-pink));
      color: white;
    }

    .btn-edit:hover {
      background: linear-gradient(135deg, var(--accent-pink), var(--dark-pink));
      transform: translateY(-1px);
      color: white;
    }

    .btn-delete {
      background: linear-gradient(135deg, #e5a5a5, #d49494);
      color: white;
    }

    .btn-delete:hover {
      background: linear-gradient(135deg, #d49494, #c08080);
      transform: translateY(-1px);
      color: white;
    }

    .bottom-actions {
      display: flex;
      gap: 16px;
      justify-content: center;
      flex-wrap: wrap;
      margin-top: 24px;
    }

    .btn-large {
      min-width: 160px;
      height: 48px;
      font-size: 16px;
      padding: 12px 24px;
      border-radius: 12px;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--primary-pink), var(--accent-pink));
      color: white;
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, var(--accent-pink), var(--dark-pink));
      transform: translateY(-1px);
      color: white;
    }

    .btn-success {
      background: linear-gradient(135deg, var(--success-green), #a8c48a);
      color: white;
    }

    .btn-success:hover {
      background: linear-gradient(135deg, #a8c48a, #8fb070);
      transform: translateY(-1px);
      color: white;
    }

    .empty-state {
      text-align: center;
      padding: 60px 20px;
      color: var(--text-light);
    }

    .empty-state i {
      font-size: 64px;
      color: var(--primary-pink);
      margin-bottom: 16px;
    }

    .empty-state h3 {
      font-size: 24px;
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 8px;
    }

    .empty-state p {
      font-size: 16px;
      margin-bottom: 24px;
    }

    @media (max-width: 768px) {
      .books-container {
        padding: 24px 20px;
        margin: 16px;
      }

      .page-title {
        font-size: 28px;
      }

      .table-container {
        padding: 16px;
        margin-bottom: 20px;
      }

      .table th,
      .table td {
        padding: 12px 8px;
        font-size: 12px;
      }

      .bottom-actions {
        flex-direction: column;
        align-items: center;
      }

      .btn-large {
        width: 100%;
        max-width: 300px;
      }
    }

    @media (max-width: 480px) {
      .action-buttons {
        flex-direction: column;
        gap: 4px;
      }

      .btn {
        width: 100%;
        justify-content: center;
      }
    }
  </style>
</head>

<body>
  <div class="books-container">
    <div class="page-header">
      <div class="brand-icon">
        <i class="fas fa-book"></i>
      </div>
      <h1 class="page-title">Book Collection</h1>
      <p class="page-subtitle">Manage your personal library</p>
    </div>

    <?php if (!empty($successMessage)) : ?>
      <div class="alert alert-success" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <?= htmlspecialchars($successMessage) ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($errorMessage)) : ?>
      <div class="alert alert-danger" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>
        <?= htmlspecialchars($errorMessage) ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($books)) : ?>
      <div class="table-container">
        <table class="table">
          <thead>
            <tr>
              <th><i class="fas fa-book me-1"></i>Title</th>
              <th><i class="fas fa-user me-1"></i>Author</th>
              <th><i class="fas fa-barcode me-1"></i>ISBN</th>
              <th><i class="fas fa-calendar me-1"></i>Year</th>
              <th><i class="fas fa-cogs me-1"></i>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($books as $book) : ?>
              <tr>
                <td><strong><?= htmlspecialchars($book['title']) ?></strong></td>
                <td><?= htmlspecialchars($book['author']) ?></td>
                <td><code><?= $book['isbn'] ? htmlspecialchars($book['isbn']) : '<em class="text-muted">N/A</em>' ?></code></td>
                <td><?= $book['published_year'] ? htmlspecialchars($book['published_year']) : '<em class="text-muted">N/A</em>' ?></td>
                <td>
                  <div class="action-buttons">
                    <a href="/books/edit/<?= $book['id'] ?>" class="btn btn-edit">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="/books/delete/<?= $book['id'] ?>" class="btn btn-delete"
                       onclick="return confirm('Are you sure you want to delete this book?')">
                      <i class="fas fa-trash"></i> Delete
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php else : ?>
      <div class="empty-state">
        <i class="fas fa-book-open"></i>
        <h3>No Books Yet</h3>
        <p>Your library is empty. Start building your collection by adding your first book!</p>
      </div>
    <?php endif; ?>

    <div class="bottom-actions">
      <a href="/dashboard" class="btn btn-primary btn-large">
        <i class="fas fa-arrow-left me-1"></i>
        Back to Dashboard
      </a>
      <a href="/books/new" class="btn btn-success btn-large">
        <i class="fas fa-plus me-1"></i>
        Add New Book
      </a>
    </div>
  </div>

  <?php include __DIR__ . '/components/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>