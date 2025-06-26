<?php
// Footer component with dynamic year
$currentYear = date('Y');
?>

<footer class="app-footer">
  <div class="footer-content">
    <p>&copy; 2023 - <?= $currentYear ?> yumeangelica.github.io. All Rights Reserved.</p>
  </div>
</footer>

<style>
.app-footer {
  margin-top: 40px;
  padding: 20px 0;
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  width: 100%;
  flex-shrink: 0;
}

.footer-content {
  text-align: center;
  margin: 0;
  padding: 0 20px;
}

.footer-content p {
  margin: 0;
  font-size: 12px;
  color: var(--text-light, #8b6b6b);
  font-weight: 400;
  letter-spacing: 0.3px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .app-footer {
    margin-top: 30px;
    padding: 16px 0;
  }

  .footer-content p {
    font-size: 11px;
  }
}
</style>
