<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Books - Book Boutique</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
</head>
<body>
  <div class="page-wrapper page-wrapper--top">
    <div class="card card--xl">

      <div class="page-header">
        <div class="page-header__icon">
          <i class="fas fa-book"></i>
        </div>
        <h1 class="page-header__title">Book Collection</h1>
        <p class="page-header__subtitle">Manage your personal library</p>
      </div>

      <?php if (!empty($successMessage)): ?>
        <div class="alert alert--success" role="status"><i class="fas fa-check-circle"></i> <?= htmlspecialchars($successMessage) ?></div>
      <?php endif; ?>
      <?php if (!empty($errorMessage)): ?>
        <div class="alert alert--danger" role="alert"><i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($errorMessage) ?></div>
      <?php endif; ?>

      <?php if (!empty($books)): ?>
        <div class="table-wrap">
          <table class="table">
            <thead>
              <tr>
                <th><i class="fas fa-book"></i> Title</th>
                <th><i class="fas fa-user"></i> Author</th>
                <th><i class="fas fa-barcode"></i> ISBN</th>
                <th><i class="fas fa-calendar"></i> Year</th>
                <th><i class="fas fa-cog"></i> Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($books as $book): ?>
                <tr>
                  <td><strong><?= htmlspecialchars($book['title']) ?></strong></td>
                  <td><?= htmlspecialchars($book['author']) ?></td>
                  <td><?php if ($book['isbn']): ?><code><?= htmlspecialchars($book['isbn']) ?></code><?php else: ?><span class="muted">N/A</span><?php endif; ?></td>
                  <td><?= $book['published_year'] ? htmlspecialchars($book['published_year']) : '<span class="muted">N/A</span>' ?></td>
                  <td>
                    <div class="row-actions">
                      <a href="/books/edit/<?= (int) $book['id'] ?>" class="btn btn--primary btn--xs" aria-label="Edit <?= htmlspecialchars($book['title']) ?>">
                        <i class="fas fa-edit"></i> Edit
                      </a>
                      <form action="/books/delete/<?= (int) $book['id'] ?>" method="post" class="inline-form"
                            onsubmit="return confirm('Are you sure you want to delete this book?')">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\Controller\Csrf::token()) ?>">
                        <button type="submit" class="btn btn--danger btn--xs" aria-label="Delete <?= htmlspecialchars($book['title']) ?>">
                          <i class="fas fa-trash"></i> Delete
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="empty">
          <div class="empty__icon"><i class="fas fa-book-open"></i></div>
          <div class="empty__title">No Books Yet</div>
          <p class="empty__text">Your library is empty. Start by adding your first book!</p>
        </div>
      <?php endif; ?>

      <div class="actions actions--center actions--mt">
        <a href="/dashboard" class="btn btn--secondary btn--lg">
          <i class="fas fa-arrow-left"></i> Dashboard
        </a>
        <a href="/books/new" class="btn btn--success btn--lg">
          <i class="fas fa-plus"></i> Add New Book
        </a>
      </div>

    </div>
  </div>

  <?php include __DIR__ . '/components/footer.php'; ?>
</body>
</html>
