<?php
// Handle error messages
$error = null;
$errorType = $_GET['error'] ?? null;
if ($errorType == '1') {
  $error = "Failed to add book. Please try again.";
} elseif ($errorType == '2') {
  $error = "Title and Author are required fields.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Book - Book Boutique</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
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
    }

    * {
      box-sizing: border-box;
    }

    html {
      background: linear-gradient(135deg, var(--light-pink) 0%, var(--secondary-pink) 100%);
      min-height: 100%;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: linear-gradient(135deg, var(--light-pink) 0%, var(--secondary-pink) 100%);
      min-height: 100vh;
      margin: 0;
      padding: 20px;
      position: relative;
      overflow-x: hidden;
      display: flex;
      flex-direction: column;
    }

    .main-content {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .add-book-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      padding: 40px;
      width: 100%;
      max-width: 560px;
      box-shadow:
        0 20px 40px var(--shadow),
        0 0 0 1px rgba(255, 255, 255, 0.5);
      border: 1px solid rgba(212, 165, 165, 0.2);
      position: relative;
      z-index: 1;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .add-book-container:hover {
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
      font-size: 28px;
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

    .form-section {
      margin-bottom: 24px;
    }

    .form-floating {
      margin-bottom: 20px;
      position: relative;
    }

    .form-floating>.form-control {
      height: 58px;
      padding: 16px 16px 8px 16px;
      border: 2px solid rgba(212, 165, 165, 0.2);
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.8);
      font-size: 16px;
      font-weight: 400;
      color: var(--text-dark);
      transition: all 0.3s ease;
    }

    .form-floating>.form-control:focus {
      border-color: var(--primary-pink);
      box-shadow: 0 0 0 4px rgba(212, 165, 165, 0.1);
      background: rgba(255, 255, 255, 0.95);
      outline: none;
    }

    .form-floating>.form-control.is-valid {
      border-color: var(--success-green);
      box-shadow: 0 0 0 4px rgba(197, 212, 165, 0.1);
    }

    .form-floating>.form-control.is-invalid {
      border-color: #d4a5a5;
      box-shadow: 0 0 0 4px rgba(212, 165, 165, 0.2);
    }

    .invalid-feedback {
      display: block;
      width: 100%;
      margin-top: 0.25rem;
      font-size: 0.875em;
      color: #8b4c4c;
    }

    .form-floating>label {
      padding: 16px;
      color: var(--text-light);
      font-weight: 500;
      font-size: 14px;
      transition: all 0.3s ease;
    }

    .form-floating>.form-control:focus~label,
    .form-floating>.form-control:not(:placeholder-shown)~label {
      color: var(--primary-pink);
      transform: scale(0.85) translateY(-14px);
    }

    .form-actions {
      display: flex;
      gap: 16px;
      margin-top: 32px;
      flex-wrap: wrap;
    }

    .btn {
      height: 52px;
      border: none;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      text-decoration: none;
      flex: 1;
      min-width: 140px;
    }

    .btn-success {
      background: linear-gradient(135deg, var(--success-green), #a8c48a);
      color: white;
      box-shadow: 0 4px 12px rgba(197, 212, 165, 0.3);
    }

    .btn-success:hover {
      background: linear-gradient(135deg, #a8c48a, #8fb070);
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(197, 212, 165, 0.4);
      color: white;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--primary-pink), var(--accent-pink));
      color: white;
      box-shadow: 0 4px 12px var(--shadow);
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, var(--accent-pink), var(--dark-pink));
      transform: translateY(-1px);
      box-shadow: 0 6px 20px var(--shadow-hover);
      color: white;
    }

    .btn:active {
      transform: translateY(0);
    }

    @media (max-width: 640px) {
      .add-book-container {
        padding: 32px 24px;
        margin: 16px;
      }

      .page-title {
        font-size: 24px;
      }

      .form-actions {
        flex-direction: column;
      }

      .btn {
        width: 100%;
      }
    }

    @media (max-width: 360px) {
      .add-book-container {
        padding: 24px 20px;
      }
    }
  </style>
</head>

<body>
  <div class="main-content">
    <div class="add-book-container">
    <div class="page-header">
      <div class="brand-icon">
        <i class="fas fa-book-medical"></i>
      </div>
      <h2 class="page-title">Add New Book</h2>
      <p class="page-subtitle">Expand your personal library</p>
    </div>

    <?php if ($error): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <?= htmlspecialchars($error) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>

    <form action="/books/add" method="post" class="form-section">
      <div class="form-floating">
        <input type="text" class="form-control" id="title" name="title" placeholder="Book Title" required>
        <label for="title"><i class="fas fa-book me-1"></i>Title</label>
      </div>

      <div class="form-floating">
        <input type="text" class="form-control" id="author" name="author" placeholder="Author Name" required>
        <label for="author"><i class="fas fa-user me-1"></i>Author</label>
      </div>

      <div class="form-floating">
        <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN Number" pattern="[\d\-\s\x]*"
          title="Enter ISBN-10 or ISBN-13 format">
        <label for="isbn"><i class="fas fa-barcode me-1"></i>ISBN</label>
        <div class="invalid-feedback" id="isbn-feedback">
          Please enter a valid ISBN format:<br>
          • ISBN-10: 0-596-52068-X<br>
          • ISBN-13: 978-0-596-52068-7<br>
          • Also accepted: 9780596520687 (without dashes)<br>
          • Leave empty if unknown (optional field)
        </div>
      </div>

      <div class="form-floating">
        <input type="number" class="form-control" id="published_year" name="published_year" placeholder="Publication Year" min="1000" max="<?= date('Y') ?>">
        <label for="published_year"><i class="fas fa-calendar me-1"></i>Published Year</label>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-success">
          <i class="fas fa-plus"></i>
          Add Book
        </button>
        <a href="/books" class="btn btn-primary">
          <i class="fas fa-arrow-left"></i>
          Back to Books
        </a>
      </div>
    </form>
  </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

  <script>
    // Comprehensive form validation
    document.addEventListener('DOMContentLoaded', function () {
      const publishedYearInput = document.getElementById('published_year');
      const titleInput = document.getElementById('title');
      const authorInput = document.getElementById('author');
      const isbnInput = document.getElementById('isbn');
      const form = document.querySelector('form');

      // ISBN validation function
      function validateISBN(isbn) {
        // Remove all non-digit characters except X
        const cleanISBN = isbn.replace(/[^0-9X]/gi, '');

        // Check if empty (optional field)
        if (!cleanISBN) return true;

        // Check ISBN-10 format
        if (cleanISBN.length === 10) {
          const digits = cleanISBN.slice(0, 9);
          const checkChar = cleanISBN.slice(9).toUpperCase();

          // Validate digits
          if (!/^\d{9}$/.test(digits)) return false;

          // Calculate check digit
          let sum = 0;
          for (let i = 0; i < 9; i++) {
            sum += parseInt(digits[i]) * (10 - i);
          }
          const remainder = sum % 11;
          const expectedCheck = remainder === 0 ? '0' : (remainder === 1 ? 'X' : (11 - remainder).toString());

          return checkChar === expectedCheck;
        }

        // Check ISBN-13 format
        if (cleanISBN.length === 13) {
          if (!/^\d{13}$/.test(cleanISBN)) return false;

          // Calculate check digit
          let sum = 0;
          for (let i = 0; i < 12; i++) {
            sum += parseInt(cleanISBN[i]) * (i % 2 === 0 ? 1 : 3);
          }
          const checkDigit = (10 - (sum % 10)) % 10;

          return parseInt(cleanISBN[12]) === checkDigit;
        }

        return false;
      }

      // Text validation function
      function validateText(text, fieldName) {
        const trimmed = text.trim();

        if (!trimmed) {
          return { valid: false, message: `${fieldName} is required` };
        }

        if (trimmed.length < 2) {
          return { valid: false, message: `${fieldName} must be at least 2 characters long` };
        }

        if (trimmed.length > 255) {
          return { valid: false, message: `${fieldName} must be less than 255 characters` };
        }

        // Check for invalid patterns
        const invalidPatterns = [
          /^[_\-\s]+$/,  // Only underscores, dashes, spaces
          /^\.+$/,       // Only dots
          /^\d+$/,       // Only numbers
          /^[^\w\s]+$/   // Only special characters
        ];

        for (let pattern of invalidPatterns) {
          if (pattern.test(trimmed)) {
            return { valid: false, message: `${fieldName} contains invalid characters only` };
          }
        }

        return { valid: true, message: '' };
      }

      // Add validation to each field
      function addFieldValidation(input, validator, errorMessage) {
        input.addEventListener('input', function () {
          this.classList.remove('is-invalid', 'is-valid');

          const isValid = validator(this.value);

          if (isValid === true || (typeof isValid === 'object' && isValid.valid)) {
            this.classList.add('is-valid');
            this.setCustomValidity('');
          } else {
            this.classList.add('is-invalid');
            const message = typeof isValid === 'object' ? isValid.message : errorMessage;
            this.setCustomValidity(message);
          }
        });
      }

      // Title validation
      addFieldValidation(titleInput, (value) => validateText(value, 'Title'), 'Please enter a valid title');

      // Author validation
      addFieldValidation(authorInput, (value) => validateText(value, 'Author'), 'Please enter a valid author name');

      // ISBN validation
      addFieldValidation(isbnInput, validateISBN, 'Please enter a valid ISBN-10 or ISBN-13');

      // Published year validation
      addFieldValidation(publishedYearInput, function (value) {
        if (value === '') return true; // Optional field

        const numValue = parseInt(value);
        const min = parseInt(publishedYearInput.getAttribute('min'));
        const max = parseInt(publishedYearInput.getAttribute('max'));

        return !isNaN(numValue) && numValue >= min && numValue <= max;
      }, 'Please enter a valid publication year');

      // Form submit validation
      form.addEventListener('submit', function (e) {
        let hasErrors = false;

        // Validate all fields
        const fields = [
          { input: titleInput, validator: (value) => validateText(value, 'Title') },
          { input: authorInput, validator: (value) => validateText(value, 'Author') },
          { input: isbnInput, validator: validateISBN },
          {
            input: publishedYearInput, validator: function (value) {
              if (value === '') return true;
              const numValue = parseInt(value);
              const min = parseInt(publishedYearInput.getAttribute('min'));
              const max = parseInt(publishedYearInput.getAttribute('max'));
              return !isNaN(numValue) && numValue >= min && numValue <= max;
            }
          }
        ];

        fields.forEach(field => {
          const result = field.validator(field.input.value);
          field.input.classList.remove('is-invalid', 'is-valid');

          if (result === true || (typeof result === 'object' && result.valid)) {
            field.input.classList.add('is-valid');
            field.input.setCustomValidity('');
          } else {
            field.input.classList.add('is-invalid');
            const message = typeof result === 'object' ? result.message : 'Invalid input';
            field.input.setCustomValidity(message);
            hasErrors = true;
          }
        });

        // Trim text fields
        titleInput.value = titleInput.value.trim();
        authorInput.value = authorInput.value.trim();
        isbnInput.value = isbnInput.value.trim();

        if (hasErrors) {
          e.preventDefault();
          // Focus on first invalid field
          const firstInvalid = form.querySelector('.is-invalid');
          if (firstInvalid) firstInvalid.focus();
        }
      });
    });
  </script>

  <?php include __DIR__ . '/components/footer.php'; ?>
</body>

</html>