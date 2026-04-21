<?php
session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === 'admin' && $password === '1234') {
 $_SESSION['user'] = $username;
 $_SESSION['start_time'] = time();

 header('Location: dashboard.php');
 exit();
}

echo 'Invalid login';