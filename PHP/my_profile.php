<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require 'db.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT name, email, role, facility_name, department, facility_type FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// Handle POST update submission
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $facility_name = $_POST['facility_name'];
    $department = $_POST['department'];
    $facility_type = $_POST['facility_type'];
    $email = $_POST['email'];

    $update_sql = "UPDATE users SET name=?, facility_name=?, department=?, facility_type=?, email=? WHERE id=?";
    $update_stmt = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($update_stmt, "sssssi", $name, $facility_name, $department, $facility_type, $email, $user_id);
    if (mysqli_stmt_execute($update_stmt)) {
        $success = "Profile updated successfully.";
        // Refresh data
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
    } else {
        $success = "Update failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>My Profile</title>
    <style>
        /* Scoped profile styles */
       /*  body.profile-page {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 30px;
        } */
        .profile-container {
            background: white;
            max-width: 600px;
            margin: 25px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .profile-container h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }
        .profile-container label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #34495e;
        }
        .profile-container input[type="text"],
        .profile-container input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1.5px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        .profile-container input[type="text"]:focus,
        .profile-container input[type="email"]:focus {
            border-color: #2980b9;
            outline: none;
        }
        .profile-container button {
            padding: 12px 20px;
            background-color: #2980b9;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        .profile-container button:hover {
            background-color: #1c5980;
        }
        .profile-container .success-message {
            color: green;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .details-container{
            display:flex;
        }
		
		
.profile-main-wrap {
  max-width: 900px;
  margin: 48px auto 24px auto;
  display: flex;
  align-items: flex-start;
  gap: 38px;
  background: none;
}
.profile-sidebar {
  min-width: 220px;
  max-width: 250px;
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 4px 20px -8px rgba(80,130,180,0.10);
  padding: 35px 22px 28px 22px;
  text-align: center;
  margin-bottom: 24px;
}
.profile-avatar {
  width: 68px;
  height: 68px;
  border-radius: 50%;
  background: linear-gradient(135deg, #3186ce 60%, #59a9d2 100%);
  color: #fff;
  font-size: 2.4rem;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 14px;
  font-weight: 700;
  box-shadow: 0 2px 10px rgba(80,140,200,0.10);
}
.profile-username {
  font-weight: 700;
  font-size: 1.1rem;
  color: #2176b3;
  margin-bottom: 5px;
}
.profile-role {
  color: #798fae;
  font-size: 0.98rem;
  margin-bottom: 14px;
}
.profile-sidebar hr {
  border: none;
  border-top: 1px solid #f2f5fb;
  margin: 18px 0 10px 0;
}
.profile-card-main {
  flex: 1;
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 4px 32px -12px rgba(80,80,140,0.09);
  padding: 38px 32px 30px 32px;
  min-width: 300px;
}
.profile-card-main h2 {
  text-align: center;
  color: #205882;
  font-size: 1.38rem;
  margin-bottom: 19px;
}
.success-message {
  color: #23bb23;
  text-align: center;
  margin-bottom: 22px;
  font-weight: 600;
  font-size: 1.04rem;
  letter-spacing: 0.2px;
}
.profile-form {
  width: 100%;
  margin: 0 auto;
}
.profile-form-row {
  display: flex;
  gap: 20px;
  margin-bottom: 18px;
  flex-wrap: wrap;
}
.profile-form-group {
  flex: 1 1 180px;
  display: flex;
  flex-direction: column;
}
.profile-form-group label {
  font-weight: 600;
  color: #34495e;
  margin-bottom: 7px;
  font-size: 0.97rem;
}
.profile-form-group input {
  background: #f8fbfd;
  border: 1.5px solid #cedaea;
  border-radius: 7px;
  font-size: 1rem;
  padding: 10px 14px;
  margin-bottom: 1px;
  transition: border-color 0.2s, background 0.2s;
}
.profile-form-group input:focus {
  border-color: #3a72b4;
  outline: none;
  background: #eaf4fd;
}
.profile-update-btn {
  padding: 14px 0;
  background: linear-gradient(90deg, #196aad 70%, #2680b9 100%);
  color: white;
  font-weight: 700;
  font-size: 1.08rem;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  letter-spacing: 0.04em;
  width: 100%;
  margin-top: 14px;
  transition: background 0.18s;
  box-shadow: 0 2px 6px rgba(100,140,180,.08);
}
.profile-update-btn:hover { background: #185792; }
/* Responsive styles */
@media (max-width: 900px) {
  .profile-main-wrap { flex-direction: column; gap: 12px; max-width: 97vw; }
  .profile-sidebar { margin: 0 auto; }
  .profile-card-main { padding: 22px 5vw 22px 5vw; }
  .profile-form-row { flex-direction: column; gap: 0; }
}
@media (max-width:530px) {
  .profile-card-main { padding: 6vw 2vw 18px 2vw; }
}

    </style>
</head>
<body class="profile-page">
<?php include("header.php"); ?>
<main class="main">
  <div class="profile-main-wrap">
    <!-- Sidebar/Menu -->
    <aside class="profile-sidebar">
      <div class="profile-avatar">
        <?= strtoupper(substr($user['name'], 0, 1)); ?>
      </div>
      <div class="profile-username"><?= htmlspecialchars($user['name']) ?></div>
      <div class="profile-role"><?= htmlspecialchars(ucfirst($user['role'])) ?></div>
      <hr>
      <?php include("user_menu.php"); ?>
    </aside>
    <!-- Main Profile Card -->
    <section class="profile-card-main">
      <h2>Update Your Profile</h2>
      <?php if ($success): ?>
        <div class="success-message"><?= htmlspecialchars($success) ?></div>
      <?php endif; ?>

      <form method="POST" class="profile-form" novalidate>
        <div class="profile-form-row">
          <div class="profile-form-group">
            <label for="name">Name *</label>
            <input id="name" type="text" name="name" required
                value="<?= htmlspecialchars($user['name']) ?>" placeholder="e.g., Dr. Jane Doe" />
          </div>
          <div class="profile-form-group">
            <label for="email">Email Address *</label>
            <input id="email" type="email" name="email" required
                value="<?= htmlspecialchars($user['email']) ?>" placeholder="your.email@example.com" />
          </div>
        </div>
        <div class="profile-form-row">
          <div class="profile-form-group">
            <label for="facility_name">Name of Facility *</label>
            <input id="facility_name" type="text" name="facility_name" required
                value="<?= htmlspecialchars($user['facility_name']) ?>" placeholder="e.g., ICMR-NIRRCH" />
          </div>
          <div class="profile-form-group">
            <label for="department">Department *</label>
            <input id="department" type="text" name="department" required
                value="<?= htmlspecialchars($user['department']) ?>" placeholder="e.g., Biomedical Informatics Center" />
          </div>
        </div>
        <div class="profile-form-row">
          <div class="profile-form-group">
            <label for="facility_type">Facility Type *</label>
            <input id="facility_type" type="text" name="facility_type" required
                value="<?= htmlspecialchars($user['facility_type']) ?>" placeholder="e.g., Hospital, Research Lab" />
          </div>
        </div>
        <button type="submit" class="profile-update-btn">Update Profile</button>
      </form>
    </section>
  </div>
</main>

<?php include("foot.php"); ?>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.querySelector('.dropdown-toggle');
    const dropdown = document.querySelector('.dropdown');

    if (toggle && dropdown) {
      toggle.addEventListener('click', function () {
        dropdown.classList.toggle('active');
      });

      document.addEventListener('click', function (e) {
        if (!dropdown.contains(e.target)) {
          dropdown.classList.remove('active');
        }
      });
    }
  });
</script>

</body>
</html>
