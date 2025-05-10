<?php
include 'config.php';
if ($_SESSION['user']['is_admin'] != 1) die("Acesso negado.");

$id = $_GET['id'];
$conn->query("UPDATE usuarios SET is_banned = 1 WHERE id = $id");
header("Location: admin.php");
