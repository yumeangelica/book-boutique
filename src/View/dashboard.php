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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Book Boutique</title>
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

    .dashboard-container {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      padding: 40px;
      width: 100%;
      max-width: 600px;
      box-shadow:
        0 20px 40px var(--shadow),
        0 0 0 1px rgba(255, 255, 255, 0.5);
      border: 1px solid rgba(212, 165, 165, 0.2);
      position: relative;
      z-index: 1;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      text-align: center;
    }

    .dashboard-container:hover {
      transform: translateY(-2px);
      box-shadow:
        0 25px 50px var(--shadow-hover),
        0 0 0 1px rgba(255, 255, 255, 0.6);
    }

    .welcome-header {
      margin-bottom: 32px;
    }

    .brand-icon {
      width: 80px;
      height: 80px;
      background: linear-gradient(135deg, var(--primary-pink), var(--accent-pink));
      border-radius: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      box-shadow: 0 8px 16px var(--shadow);
    }

    .brand-icon i {
      font-size: 36px;
      color: white;
    }

    .welcome-title {
      font-size: 32px;
      font-weight: 700;
      color: var(--text-dark);
      margin: 0 0 8px 0;
      letter-spacing: -0.5px;
    }

    .welcome-subtitle {
      font-size: 18px;
      color: var(--text-light);
      margin: 0 0 16px 0;
      font-weight: 400;
    }

    .username-badge {
      display: inline-block;
      background: linear-gradient(135deg, var(--secondary-pink), var(--light-pink));
      color: var(--text-dark);
      padding: 8px 20px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 16px;
      border: 2px solid rgba(212, 165, 165, 0.3);
      text-decoration: none;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .username-badge:hover {
      background: linear-gradient(135deg, var(--primary-pink), var(--secondary-pink));
      color: var(--text-dark);
      transform: translateY(-1px);
      box-shadow: 0 4px 8px var(--shadow);
      text-decoration: none;
    }

    .action-buttons {
      display: flex;
      gap: 16px;
      margin-top: 32px;
      flex-wrap: wrap;
      justify-content: center;
    }

    .action-btn {
      min-width: 160px;
      height: 52px;
      border: none;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 600;
      color: white;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      text-decoration: none;
      flex: 1;
      max-width: 200px;
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--primary-pink), var(--accent-pink));
      box-shadow: 0 4px 12px var(--shadow);
    }

    .btn-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px var(--shadow-hover);
      background: linear-gradient(135deg, var(--accent-pink), var(--dark-pink));
      color: white;
    }

    .btn-secondary {
      background: linear-gradient(135deg, var(--text-light), var(--text-dark));
      box-shadow: 0 4px 12px rgba(139, 107, 107, 0.2);
    }

    .btn-secondary:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(139, 107, 107, 0.3);
      background: linear-gradient(135deg, var(--text-dark), #5a4040);
      color: white;
    }

    .stats-section {
      margin: 32px 0;
      padding: 24px;
      background: rgba(212, 165, 165, 0.05);
      border-radius: 16px;
      border: 1px solid rgba(212, 165, 165, 0.1);
    }

    .stats-title {
      font-size: 18px;
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 16px;
    }

    .stats-text {
      color: var(--text-light);
      font-size: 16px;
      line-height: 1.6;
    }

    @media (max-width: 640px) {
      .dashboard-container {
        padding: 32px 24px;
        margin: 16px;
      }

      .welcome-title {
        font-size: 28px;
      }

      .welcome-subtitle {
        font-size: 16px;
      }

      .action-buttons {
        flex-direction: column;
        align-items: center;
      }

      .action-btn {
        width: 100%;
        max-width: none;
      }
    }

    @media (max-width: 480px) {
      .dashboard-container {
        padding: 24px 20px;
      }

      .brand-icon {
        width: 64px;
        height: 64px;
      }

      .brand-icon i {
        font-size: 28px;
      }
    }
  </style>
</head>

<body>
  <div class="main-content">
    <div class="dashboard-container">
    <div class="welcome-header">
      <div class="brand-icon">
        <i class="fas fa-book-open"></i>
      </div>
      <h1 class="welcome-title">Welcome Back!</h1>
      <p class="welcome-subtitle">Ready to explore your book collection?</p>
      <a href="/account" class="username-badge">
        <i class="fas fa-user me-1"></i>
        <?php echo htmlspecialchars($username); ?>
      </a>
    </div>

    <div class="stats-section">
      <h3 class="stats-title">
        <i class="fas fa-chart-line me-2"></i>
        Your Book Boutique
      </h3>
      <p class="stats-text">
        Manage your personal library, discover new books, and keep track of your reading journey.
        Your literary adventure starts here!
      </p>
    </div>

    <div class="action-buttons">
      <a href="/books" class="action-btn btn-primary">
        <i class="fas fa-books"></i>
        View Books
      </a>
      <a href="/logout" class="action-btn btn-secondary" onclick="return confirmLogout()">
        <i class="fas fa-sign-out-alt"></i>
        Logout
      </a>
    </div>
  </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

  <script>
    function confirmLogout() {
      return confirm('Are you sure you want to logout?');
    }
  </script>

  <?php include __DIR__ . '/components/footer.php'; ?>
</body>

</html>