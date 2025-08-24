<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

require 'db.php';
$id = $_POST['id'];
$action = $_POST['action'];

if ($action === 'approve') {
    $stmt = $pdo->prepare("UPDATE submissions SET status = 'approved' WHERE id = ?");
    $stmt->execute([$id]);
    // Move to final_data table
    $copy = $pdo->prepare("INSERT INTO approved_data (user_id, data) SELECT user_id, data FROM submissions WHERE id = ?");
    $copy->execute([$id]);
} elseif ($action === 'reject') {
    $stmt = $pdo->prepare("UPDATE submissions SET status = 'rejected' WHERE id = ?");
    $stmt->execute([$id]);
} elseif ($action === 'correction') {
    $stmt = $pdo->prepare("UPDATE submissions SET status = 'needs_correction' WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: admin_submissions.php");
exit();
?>