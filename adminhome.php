<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="StyleSheet.css">
    <style>
        .tiles {
            display: flex;
            flex-wrap: wrap;

        }
        .tiles a {
            display: block;
            width: 200px;
            height: 200px;
            margin: 10px;
            background-size: cover;
            background-position: center;
            text-decoration: none;
            color: white;
            text-align: center;
            line-height: 200px;
            font-size: 18px;
            font-weight: bold;
            position: relative;
        }
        .tiles a::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }
        .tiles a span {
            position: relative;
            z-index: 1;
        }
        .tiles a.manageusers {
            background-image: url('images/manageusers.jpg');
        }
        .tiles a.managelocations {
            background-image: url('images/managelocations.jpg');
        }
        .container {
         flex: 1;
        }
    </style>
</head>
<body>
<nav>
        <a href="adminHome.php">Home</a>      
        <a href="logout.php">Logout</a>
    </nav>
    <div class="container">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>

<nav class="tiles">
<a href="manageusers.php" class="manageusers"><span>Manage Users</span></a>
<a href="managelocations.php" class="managelocations"><span>Manage Locations</span></a>
    </nav></div>
    <footer>
        <p> &copy; 2024 UCM Student Hub. All rights reserved. </p>
    </footer>
</body>
</html>
