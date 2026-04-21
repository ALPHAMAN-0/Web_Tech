<?php
session_start();

if (!isset($_SESSION['user'])) {
 header('Location: index.html');
 exit();
}

$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head>
 <title>Dashboard</title>
</head>
<body>

<h2>Welcome, <?php echo $user; ?></h2>

<p>You are logged in using a session variable.</p>

<a href="logout.php">Logout</a>

</body>
</html>