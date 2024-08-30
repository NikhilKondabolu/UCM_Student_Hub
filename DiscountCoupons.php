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
    <title>Discount</title>
    <link rel="stylesheet" href="StyleSheet.css">
    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .accommodation-content {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<nav>
    <a href="Home.php">Home</a>
    <a href="requestrides.php" class="requestrides"><span>Request Rides</span></a>
            <a href="providerides.php" class="providerides"><span>Provide Rides</span></a>
            <a href="courier.php" class="courier"><span>Courier Service</span></a>
    <a href="logout.php">Logout</a>
</nav>
</br></br>
<h1>Signup for promotions to get the discount Coupon</h1><br>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prereq = isset($_POST['selectPrereq']) ? $_POST['selectPrereq'] : '';
    
    if ($prereq == 'YES') {
        $message = "STUDENT10";
    }
    else{
        $message = "Sorry! We cant provide you with the coupon code";
    }
}
?>

<div class="container">
    <form method="post" action="DiscountCoupons.php">
        <?php
        $Prereqarray = array("YES", "NO");
        ?>
        <p>
            <label for="Prereq">Agree:</label>
            <select name="selectPrereq" id="Prereq">
                <?php
                foreach ($Prereqarray as $index => $value) {
                    echo '<option value="' . $value . '"' . (isset($_POST['selectPrereq']) && $_POST['selectPrereq'] == $value ? ' selected' : '') . '>' . $value . '</option>';
                }
                ?>
            </select>
        </p><br>
        <br>
        <p><input type="submit" name="Submit" value="Submit"></p>
    </form>

    <?php
    if (isset($message)) {
        echo '<h1><b><p>' . $message . '</p></b><h1>';
    }
    ?>
</div>

<footer>
    <p>&copy; 2024 UCM Student Hub. All rights reserved.</p>
</footer>
</body>
</html>
