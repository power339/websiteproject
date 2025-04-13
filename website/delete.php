<?php
require 'db.php';

// Handle deletion (soft delete)
if (isset($_POST['delete'])) {
  $id = (int)$_POST['id'];
  $type = $_POST['type'];
  $table = $type === 'file' ? 'files' : 'posts';
  $conn->query("UPDATE $table SET deleted_at = NOW() WHERE id = $id");
  header("Location: dashboard.php");
  exit();
}
?>
