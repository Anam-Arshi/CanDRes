<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}
require 'db.php';

$user_id = $_SESSION['user_id'];

// Fetch submissions for this user
$sql = "SELECT id, strain, species, isolate_type, experiment_type, year_of_study, study_title, is_published, created_at, status
        FROM strain_submissions
        WHERE user_id = ?
        ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$submissions = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>My Submissions</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background: linear-gradient(135deg, #eaf6fb 0%, #f9f9fb 100%);
    margin: 0;
    padding: 0;
}
.main-submissions {
    max-width: 1050px;
    margin: 52px auto 36px auto;
    padding: 32px 18px 20px 18px;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 24px -8px rgba(80,130,180,0.10);
}
.submissions-title {
    font-size: 2rem;
    font-weight: bold;
    color: #196aad;
    margin-bottom: 18px;
    text-align: center;
}
.submissions-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 1rem;
    background: #fafdff;
    border-radius: 9px;
    overflow: hidden;
    margin-bottom: 24px;
}
.submissions-table th, .submissions-table td {
    padding: 14px 13px;
    text-align: left;
}
.submissions-table th {
    background: #eaf5ff;
    color: #154877;
    font-weight: 600;
    font-size: 1.02em;
    border-bottom: 2px solid #d4e4f4;
}
.submissions-table tr {
    border-bottom: 1px solid #ebebeb;
    transition: background 0.18s;
}
.submissions-table tr:hover {
    background: #f2f6fa;
}
.submission-link {
    background: #245ba7;
    color: #fff !important;
    padding: 7px 16px;
    text-decoration: none;
    border-radius: 6px;
    transition: background 0.12s;
    font-weight: 500;
    font-size: 0.99em;
}
.submission-link:hover {
    background: #175387;
}
.no-submissions {
    text-align: center;
    font-size: 1.12rem;
    color: #728098;
    margin: 42px 0;
}
@media (max-width: 720px) {
    .main-submissions { padding: 14px 2vw 18px 2vw;}
    .submissions-table th, .submissions-table td { padding: 8px 5px;}
}

.status-approved {
    color: #16a085; font-weight: 600;
}
.status-rejected {
    color: #e74c3c; font-weight: 600;
}
.status-review,
.status-pending {
    color: #f39c12; font-weight: 600;
}

</style>
</head>
<body>
<?php include("header.php"); ?>
<main class="main">

<?php include("user_menu.php"); ?>

    <div class="submissions-title">My Submissions</div>
    <?php if (count($submissions)): ?>
        <table class="submissions-table">
            <thead>
  <tr>
    <th>#</th>
    <th>Strain</th>
    <th>Species</th>
    <th>Isolate Type</th>
    <th>Experiments</th>
    <th>Year</th>
    <th>Study Title</th>
    <th>Published</th>
    <th>Status</th>       <!-- NEW COLUMN -->
    <th>Submitted</th>
     <!-- <th>Action</th> --->
  </tr>
</thead>
<tbody>
<?php foreach($submissions as $i => $row): ?>
  <tr>
    <td><?= $i+1 ?></td>
    <td><?= htmlspecialchars($row['strain']) ?></td>
    <td><?= htmlspecialchars($row['species']) ?></td>
    <td><?= htmlspecialchars($row['isolate_type']) ?></td>
    <td><?= htmlspecialchars($row['experiment_type']) ?></td>
    <td><?= htmlspecialchars($row['year_of_study']) ?></td>
    <td><?= htmlspecialchars($row['study_title']) ?></td>
    <td><?= $row['is_published'] == "yes" || $row['is_published'] == 1 ? "Yes" : "No" ?></td>
    <td>
      <?php
        $status = $row['status'];
        $color = "gray";
        if ($status === "Approved") $color = "#16a085";
        elseif ($status === "Rejected") $color = "#e74c3c";
        elseif ($status === "Under Review" || $status === "pending") $color = "#f39c12";
      ?>
      <span style="color:<?= $color ?>; font-weight:600;"><?= htmlspecialchars($status) ?></span>
    </td>
    <td><?= date('Y-m-d', strtotime($row['created_at'] ?? '')) ?></td>
	 <!--
    <td>
      <a class="submission-link" href="view_submission.php?id=<?= $row['id'] ?>">View</a>
    </td>
	---->
  </tr>
<?php endforeach; ?>

            </tbody>
        </table>
    <?php else: ?>
        <div class="no-submissions">No submissions yet. Use the dashboard to submit your first strain!</div>
    <?php endif; ?>
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
