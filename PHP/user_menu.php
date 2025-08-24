<!-- file: user_menu.php -->
<?php if (isset($_SESSION['user_id'])): ?>
<div style="min-width: 200px; margin-left: 20px; position: relative;">
  <div class="dropdown">
    <button class="dropdown-toggle">
      Hi, <?= htmlspecialchars($_SESSION['name']) ?> ▼
    </button>
    <div class="dropdown-menu">
      <a href="my_profile.php" style="<?= basename($_SERVER['PHP_SELF']) === 'my_profile.php' ? 'font-weight:bold; color:#2980b9;' : '' ?>">My Profile</a>
      <a href="my_submissions.php" style="<?= basename($_SERVER['PHP_SELF']) === 'my_submissions.php' ? 'font-weight:bold; color:#2980b9;' : '' ?>">My Submissions</a>
      <a href="index.php?logout=1" style="color:#c0392b;">Logout</a>
    </div>
  </div>
</div>
<?php endif; ?>
<style>
    
  .dropdown {
  position: relative;
  display: inline-block;
  font-family: sans-serif;
}

.dropdown-toggle {
  background-color: #2980b9;
  color: white;
  padding: 12px 18px;
  font-size: 1rem;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.dropdown-toggle:hover {
  background-color: #1c5980;
}

.dropdown-menu {
  display: none;
  position: absolute;
  right: 0;
  top: 110%;
  background-color: white;
  min-width: 160px;
  box-shadow: 0 6px 12px rgba(0,0,0,0.1);
  border-radius: 6px;
  z-index: 1000;
  padding: 10px 0;
}

.dropdown-menu a {
  color: #333;
  padding: 10px 20px;
  text-decoration: none;
  display: block;
}

.dropdown-menu a:hover {
  background-color: #f1f1f1;
}

/* Show menu on toggle */
.dropdown.active .dropdown-menu {
  display: block;
}
</style>