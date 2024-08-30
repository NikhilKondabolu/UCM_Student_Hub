<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include the business tier class
include_once("inc_businessTierClass.php");

// Instantiate the business tier class
$businessTier = new BusinessTierClass();

// Get username from query string
$username = $_GET['username'];

// Fetch user data from database
$user = $businessTier->getUserByUsername($username);

// Define variables and initialize with empty values
$password = $phone = $dob = $address = "";
$password_err = $phone_err = $dob_err = $address_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } else {
        $password = password_hash(trim($_POST["password"]), PASSWORD_DEFAULT);
    }

    // Validate phone
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter a phone number.";
    } else {
        $phone = trim($_POST["phone"]);
    }

    // Validate date of birth
    if (empty(trim($_POST["dob"]))) {
        $dob_err = "Please enter a date of birth.";
    } else {
        $dob = trim($_POST["dob"]);
    }

    // Validate address
    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter an address.";
    } else {
        $address = trim($_POST["address"]);
    }

    // Check input errors before updating in database
    if (empty($password_err) && empty($phone_err) && empty($dob_err) && empty($address_err)) {
        // Update the user
        if ($businessTier->updateUser($username, $password, $phone, $dob, $address)) {
            header("location: manageusers.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="StyleSheet.css">
</head>
<body>
<nav>
    <a href="adminhome.php">Home</a>
    <a href="managelocations.php">Manage Locations</a>
    <a href="logout.php">Logout</a>
</nav>
<div class="content-container">
    <h2>Edit User</h2>
    <p>Please fill this form to edit the user.</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?username=" . $username; ?>" method="post">
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div></br>
        <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
            <span class="help-block"><?php echo $phone_err; ?></span>
        </div></br>
        <div class="form-group <?php echo (!empty($dob_err)) ? 'has-error' : ''; ?>">
            <label>Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="<?php echo $dob; ?>">
            <span class="help-block"><?php echo $dob_err; ?></span>
        </div></br>
        <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
            <label>Address</label>
            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
            <span class="help-block"><?php echo $address_err; ?></span>
        </div></br>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
        </div>
    </form>
</div>
<footer>
    <p>&copy; 2024 UCM Student Hub. All rights reserved.</p>
</footer>
</body>
</html>
