<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Access denied.");
}

// Get all pending + approved + rejected submissions
$sql = "SELECT ss.*, u.name, u.email 
        FROM strain_submissions ss 
        JOIN users u ON ss.user_id = u.id 
        ORDER BY ss.submitted_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Submissions</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; }
        th { background: #2980b9; color: #fff; }
        .actions a {
            margin-right: 10px;
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 4px;
            color: #fff;
        }
        .view-btn { background-color: #27ae60; }
        .approve-btn { background-color: #2980b9; }
        .reject-btn { background-color: #c0392b; }
    </style>
</head>
<body>
<h2>Admin Dashboard - Submissions</h2>
<table>
    <tr>
        <th>#</th>
        <th>Strain</th>
        <th>Submitted By</th>
        <th>Status</th>
        <th>Submitted At</th>
        <th>Actions</th>
    </tr>
    <?php
    $sr = 1;
    while ($row = $result->fetch_assoc()):
    ?>
    <tr>
        <td><?= $sr++ ?></td>
        <td><?= htmlspecialchars($row['strain']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?> (<?= htmlspecialchars($row['name']) ?>)</td>
        <td><?= ucfirst($row['status']) ?></td>
        <td><?= $row['submitted_at'] ?></td>
        <td class="actions">
            <a class="view-btn" href="view_submission.php?id=<?= $row['id'] ?>">View</a>
            <?php if ($row['status'] == 'pending'): ?>
                <a class="approve-btn" href="handle_submission.php?id=<?= $row['id'] ?>&action=approve">Approve</a>
                <a class="reject-btn" href="handle_submission.php?id=<?= $row['id'] ?>&action=reject" onclick="return confirm('Reject this submission?')">Reject</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
