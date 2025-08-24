<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];
    $stmt = $pdo->prepare("INSERT INTO submissions (user_id, data, status) VALUES (?, ?, 'pending')");
    $stmt->execute([$_SESSION['user_id'], $data]);
    header("Location: my_submissions.php");
    exit();
}
?>