<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Book - Book Boutique</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
  <link href="/css/style.css" rel="stylesheet">
</head>
<body>
  <div class="page-wrapper">
    <div class="card card--md">

      <div class="page-header">
        <div class="page-header__icon">
          <i class="fas fa-edit"></i>
        </div>
        <h1 class="page-header__title">Edit Book</h1>
        <p class="page-header__subtitle">Update book information</p>
      </div>

      <form action="/books/update/<?= $book['id'] ?>" method="post" id="bookForm">
        <div class="form-group">
          <label class="form-label" for="title"><i class="fas fa-book"></i> Title *</label>
          <input type="text" class="form-input" id="title" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="author"><i class="fas fa-user"></i> Author *</label>
          <input type="text" class="form-input" id="author" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
        </div>

        <div class="form-group">
          <label class="form-label" for="isbn"><i class="fas fa-barcode"></i> ISBN</label>
          <input type="text" class="form-input" id="isbn" name="isbn" value="<?= $book['isbn'] ? htmlspecialchars($book['isbn']) : '' ?>">
          <div class="invalid-feedback" id="isbn-feedback" style="display:none;">
            Please enter a valid ISBN-10 or ISBN-13 format.
          </div>
        </div>

        <div class="form-group">
          <label class="form-label" for="published_year"><i class="fas fa-calendar"></i> Published Year</label>
          <input type="number" class="form-input" id="published_year" name="published_year"
                 value="<?= $book['published_year'] ? htmlspecialchars($book['published_year']) : '' ?>"
                 min="1000" max="<?= date('Y') ?>">
        </div>

        <div class="actions actions--mt">
          <button type="submit" class="btn btn--success btn--lg" style="flex:1;">
            <i class="fas fa-save"></i> Update Book
          </button>
          <a href="/books" class="btn btn--secondary btn--lg" style="flex:1;">
            <i class="fas fa-times"></i> Cancel
          </a>
        </div>
      </form>

    </div>
  </div>

  <?php include __DIR__ . '/components/footer.php'; ?>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const isbn = document.getElementById('isbn');
      const feedback = document.getElementById('isbn-feedback');
      const form = document.getElementById('bookForm');
      const title = document.getElementById('title');
      const author = document.getElementById('author');

      function validateISBN(val) {
        const clean = val.replace(/[^0-9X]/gi, '');
        if (!clean) return true;
        if (clean.length === 10) {
          const digits = clean.slice(0,9);
          const check = clean.slice(9).toUpperCase();
          if (!/^\d{9}$/.test(digits)) return false;
          let sum = 0;
          for (let i = 0; i < 9; i++) sum += parseInt(digits[i]) * (10-i);
          const r = sum % 11;
          const exp = r === 0 ? '0' : (r === 1 ? 'X' : (11-r).toString());
          return check === exp;
        }
        if (clean.length === 13) {
          if (!/^\d{13}$/.test(clean)) return false;
          let sum = 0;
          for (let i = 0; i < 12; i++) sum += parseInt(clean[i]) * (i%2===0?1:3);
          return parseInt(clean[12]) === (10-(sum%10))%10;
        }
        return false;
      }

      isbn.addEventListener('input', function() {
        const v = validateISBN(this.value);
        this.classList.toggle('is-valid', v && this.value.trim() !== '');
        this.classList.toggle('is-invalid', !v);
        feedback.style.display = v ? 'none' : 'block';
      });

      form.addEventListener('submit', function(e) {
        title.value = title.value.trim();
        author.value = author.value.trim();
        isbn.value = isbn.value.trim();
        if (!validateISBN(isbn.value)) { e.preventDefault(); isbn.focus(); }
      });
    });
  </script>
</body>
</html>