<?php
// file: index.php (registration + login + form + dashboard)
session_start();
include 'db.php';

// Handle registration
if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $institute_name = trim($_POST['institute_name']);
    $department = trim($_POST['department']);
    $setup = trim($_POST['setup']);
    $email = strtolower(trim($_POST['user_email']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, facility_name, department, facility_type, email, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $institute_name, $department, $setup, $email, $password);
    if ($stmt->execute()) {
        $message = "Registration successful. You can now login.";
    } else {
        $message = "Registration failed: " . $stmt->error;
    }
}


// Handle login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];
		$_SESSION['institute_name'] = $user['facility_name'];
		$_SESSION['department']= $user['department'];
		$_SESSION['setup'] = $user['facility_type'];
		$_SESSION['email'] = $user['email'];
		
        header("Location: login.php"); // reload to show dashboard
        exit;
    } else {
        $message = "Invalid credentials.";
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Research Portal - Login/Register</title>
<style>
/*
html, body {
  min-height: 100%;
  background: linear-gradient(135deg, #eaf6fb 0%, #f9f9fb 100%);
  font-family: 'Segoe UI', Arial, sans-serif;
  margin: 0;
  padding: 0;
}
*/

.h1 {
  text-align: center;
  margin: 32px 0 46px;
  color: #2c3e50;
  font-size: 2.1rem;
  letter-spacing: .5px;
}

.container {
  box-shadow: 0 10px 36px -10px rgba(50,50,93,0.12), 0 1.5px 3px 0 rgba(0,0,0,0.13);
  border-radius: 14px;
  background: #fff;
  overflow: hidden;
  margin: 45px auto 24px;
  max-width: 920px;
  display: flex;
}

.form-side {
  padding: 48px 40px;
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.form-side.register {
  background: linear-gradient(135deg, #83bbe7 0%, #59a9d2 100%);
  color: #fff;
}

.form-side.login {
  background: #fff;
}

.form-side h2 {
  font-size: 2rem;
  margin-bottom: 32px;
  letter-spacing: 1px;
}

.form-group {
  margin-bottom: 22px;
  display: flex;
  flex-direction: column;
}

.form-group label {
  font-size: 1.03rem;
  font-weight: 600;
  margin-bottom: 6px;
}

.form-group input[type=text],
.form-group input[type=email],
.form-group input[type=password],
.form-group textarea {
  border-radius: 7px;
  border: 1.5px solid #cedaea;
  background: #f8fbfd;
  font-size: 1rem;
  padding: 11px 12px;
  transition: border-color 0.2s, background 0.2s;
  width: 100%;
  box-sizing: border-box;
  margin-bottom: 2px;
}

.form-group input:focus,
.form-group textarea:focus {
  border-color: #3a72b4;
  outline: none;
  background: #eaf4fd;
}

.button {
  padding: 13px;
  margin-top: 8px;
  background: linear-gradient(90deg, #196aad 70%, #2680b9 100%);
  color: white;
  font-weight: 700;
  font-size: 1.07rem;
  border: none;
  border-radius: 7px;
  cursor: pointer;
  letter-spacing: 0.03em;
  box-shadow: 0 2px 8px rgba(50,100,150,0.03);
  transition: background 0.15s;
}
.button:hover {
  background: #194770;
}

.required { color: #ffeb66; font-size: 1.1em; }

.message {
  text-align: center;
  margin: 16px 0 22px;
  color: #e74c3c;
  font-weight: 600;
  font-size: 1.08rem;
  letter-spacing: 0.3px;
}

/* Dropdown styles */
.dropdown {
  position: relative;
  display: inline-block;
  font-family: inherit;
}

.dropdown-toggle {
  background-color: #2980b9;
  color: white;
  padding: 12px 18px;
  font-size: 1rem;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  min-width: 140px;
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
  box-shadow: 0 6px 16px rgba(0,0,0,0.10);
  border-radius: 8px;
  z-index: 1000;
  padding: 10px 0;
}
.dropdown-menu a {
  color: #333;
  padding: 10px 20px;
  text-decoration: none;
  display: block;
  border-radius: 3px;
}
.dropdown-menu a:hover {
  background-color: #f5f7fa;
}
.dropdown.active .dropdown-menu {
  display: block;
}

/* Username header for dashboard */
.username{
  text-align:left;
  font-family:verdana;
  font-size: 1.28rem;
  color: #17517d;
  font-weight: 500;
  margin-bottom: 16px;
}

/* Responsive */
@media (max-width: 850px) {
  .container { flex-direction: column; max-width: 97vw; }
  .form-side { padding: 30px 18px 30px 18px; }
}

/* Add a gentle shadow to panel */
@media (max-width: 600px) {
  .form-side { padding: 20px 7vw; }
  .container { box-shadow: 0 2.5px 12px -7px rgba(50,50,93,0.10); }
}

.dashboard-center {
  max-width: 1300px;
  margin: 12px auto 36px;
  /* 
  background: #fff;
  box-shadow: 0 4px 32px -12px rgba(80,80,140,0.10); */
  border-radius: 15px;
  padding: 36px 30px 38px 30px;
  display: flex;
  flex-direction: column;
  align-items: center;

}

.dashboard-header {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 30px;
  gap: 28px;
}

.username {
  font-size: 1.43rem;
  color: #165b8b;
  font-weight: 500;
  letter-spacing: 0.1px;
  margin: 0;
}

.dashboard-content {
  width: 100%;
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  align-items: center;
}

/* Admin button (optional) */
.admin-btn {
  display: inline-block;
  margin-top: 20px;
  padding: 14px 26px;
  background: #2980b9;
  color: #fff;
  text-decoration: none;
  border-radius: 8px;
  font-weight: 600;
  letter-spacing: 0.06rem;
  font-size: 1.15em;
  transition: background .18s;
}
.admin-btn:hover { background: #17496D; }

/* Adjust the dropdown for this layout */
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-toggle {
  background-color: #2680b9;
  color: white;
  padding: 10px 20px;
  font-size: 1rem;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 500;
  box-shadow: 0 2px 6px rgba(110,120,160,0.07);
}
.dropdown-toggle:hover {
  background-color: #165b8b;
}
.dropdown-menu {
  display: none;
  position: absolute;
  right: 0; /* aligns right edge with button */
  top: 110%;
  background-color: white;
  min-width: 180px;
  box-shadow: 0 6px 18px rgba(33,80,120,0.12);
  border-radius: 8px;
  z-index: 1000;
  padding: 13px 0;
}
.dropdown-menu a {
  color: #222;
  padding: 13px 24px;
  text-decoration: none;
  display: block;
  border-radius: 3px;
  font-size: 1.05em;
}
.dropdown-menu a:hover {
  background-color: #f5f7fa;
  color: #165b8b;
}
.dropdown.active .dropdown-menu {
  display: block;
}

/* Small devices */
@media (max-width: 700px) {
  .dashboard-center {
    max-width: 98vw;
    padding: 18px 3vw 24px 3vw;
  }
  .dashboard-header {
    flex-direction: column;
    gap: 12px;
    margin-bottom: 16px;
    align-items: flex-start;
  }
  .dashboard-content { padding: 0; }
}

</style>
</head>
<body>
 <?php
include("header.php");
?>
<main class="main">
<!-- <h1>Submission portal</h1> -->

<?php if (!isset($_SESSION['user_id'])): ?>
  <div class="container">
    <section class="form-side register">
  <h2>Create Account</h2>
  <form method="POST">
    <div class="form-group">
      <label for="name">Name <span class="required">*</span></label>
      <input type="text" id="name" name="name" required placeholder="e.g., Dr. Jane Doe">
    </div>
    <div class="form-group">
      <label for="institute_name">Name of Facility <span class="required">*</span></label>
      <input type="text" id="institute_name" name="institute_name" required placeholder="e.g., ICMR-NIRRCH">
    </div>
    <div class="form-group">
      <label for="department">Department <span class="required">*</span></label>
      <input type="text" id="department" name="department" required placeholder="e.g., Biomedical Informatics Center">
    </div>
    <div class="form-group">
      <label for="setup">Facility Type <span class="required">*</span></label>
      <input type="text" id="setup" name="setup" required placeholder="e.g., Hospital, Research Lab">
    </div>
    <div class="form-group">
      <label for="user_email">Email Address <span class="required">*</span></label>
      <input type="email" id="user_email" name="user_email" required placeholder="your.email@example.com">
    </div>
    <div class="form-group">
      <label for="passwordReg">Password <span class="required">*</span></label>
      <input type="password" id="passwordReg" name="password" required placeholder="Enter password" />
    </div>
    <button name="register" type="submit" class="button">Register</button>
  </form>
</section>

    <section class="form-side login">
  <h2>Login</h2>
  <form method="POST">
    <div class="form-group">
      <label for="emailLogin">Email</label>
      <input id="emailLogin" name="email" type="email" required placeholder="example@domain.com" />
    </div>
    <div class="form-group">
      <label for="passwordLogin">Password</label>
      <input id="passwordLogin" name="password" type="password" required placeholder="Enter password" />
    </div>
    <button name="login" type="submit" class="button">Login</button>
  </form>
</section>

  </div>
  
  <?php if (!empty($message)): ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>

<?php else: ?>

  <div class="dashboard-center">
    <div class="dashboard-header">
      <h2 class="username">Welcome, <?= htmlspecialchars($_SESSION['name']) ?></h2>
      <div class="dropdown">
        <button class="dropdown-toggle">Account Info ▼</button>
        <div class="dropdown-menu">
          <?php if ($_SESSION['role'] === 'user'): ?>
            <a href="my_profile.php">My Profile</a>
            <a href="my_submissions.php">My Submissions</a>
          <?php endif; ?>
          <a href="?logout=1" style="color:#c0392b;">Logout</a>
        </div>
      </div>
    </div>
    <div class="dashboard-content">
      <?php if ($_SESSION['role'] === 'user'): ?>
        <?php include("user_data.php"); ?>
      <?php elseif ($_SESSION['role'] === 'admin'): ?>
        <a href="admin_submissions.php" class="admin-btn">View Submissions</a>
      <?php endif; ?>
    </div>
  </div>

<?php endif; ?>

</main>
<?php include("foot.php"); ?>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.querySelector('.dropdown-toggle');
    const dropdown = document.querySelector('.dropdown');

    toggle.addEventListener('click', function () {
      dropdown.classList.toggle('active');
    });

    // Close dropdown if clicked outside
    document.addEventListener('click', function (e) {
      if (!dropdown.contains(e.target)) {
        dropdown.classList.remove('active');
      }
    });
  });
</script>

</body>
</html>
