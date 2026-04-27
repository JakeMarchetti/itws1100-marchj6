<?php
session_start();
include 'config.php';

if (!isset($_SESSION['authenticated'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password'])) {
        if ($_POST['password'] == $password) {
            $_SESSION['authenticated'] = true;
        } else {
            // Show access denied popup
            echo '<script>
                alert("Access denied");
            </script>';
        }
    }
    if (!isset($_SESSION['authenticated'])) {
        // Show password form
        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Required</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 50px; }
        form { display: inline-block; }
        input[type="password"] { padding: 10px; font-size: 16px; }
        input[type="submit"] { padding: 10px 20px; font-size: 16px; }
    </style>
</head>
<body>
    <h1>Password Required</h1>
    <form method="post">
        <label for="password">Enter Password:</label><br>
        <input type="password" name="password" id="password" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>';
        exit;
    }
}
?>