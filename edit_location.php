<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include business tier class
include_once("inc_businessTierClass.php");
$business = new BusinessTierClass();

// Define variables and initialize with empty values
$location = $latitude = $longitude = $location_err = $latitude_err = $longitude_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $locationid = $_POST["locationid"];

    // Validate location
    if (empty(trim($_POST["location"]))) {
        $location_err = "Please enter a location.";
    } else {
        $location = trim($_POST["location"]);
    }

    // Validate latitude
    if (empty(trim($_POST["latitude"]))) {
        $latitude_err = "Please enter a latitude.";
    } elseif (!is_numeric($_POST["latitude"])) {
        $latitude_err = "Please enter a valid latitude.";
    } else {
        $latitude = trim($_POST["latitude"]);
    }

    // Validate longitude
    if (empty(trim($_POST["longitude"]))) {
        $longitude_err = "Please enter a longitude.";
    } elseif (!is_numeric($_POST["longitude"])) {
        $longitude_err = "Please enter a valid longitude.";
    } else {
        $longitude = trim($_POST["longitude"]);
    }

    // Check input errors before updating in database
    if (empty($location_err) && empty($latitude_err) && empty($longitude_err)) {
        // Update location
        if ($business->updateLocation($locationid, $location, $latitude, $longitude)) {
            header("location: managelocations.php");
            exit;
        } else {
            echo "Error updating record.";
        }
    }
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["locationid"]) && !empty(trim($_GET["locationid"]))) {
        $locationid = trim($_GET["locationid"]);

        // Retrieve location details
        $locationData = $business->getLocationById($locationid);
        if ($locationData) {
            $location = $locationData["location"];
            $latitude = $locationData["latitude"];
            $longitude = $locationData["longitude"];
        } else {
            // URL doesn't contain valid id. Redirect to error page
            header("location: error.php");
            exit;
        }
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Location</title>
    <link rel="stylesheet" href="StyleSheet.css">
</head>
<body>
<nav>
    <a href="adminhome.php">Home</a>
    <a href="manageusers.php">Manage Users</a>
    <a href="logout.php">Logout</a>
</nav>
<div class="content-container">
    <h2>Edit Location</h2>
    <p>Please edit the input values and submit to update the location.</p>
    <form action="edit_location.php" method="post">
        <div class="form-group <?php echo (!empty($location_err)) ? 'has-error' : ''; ?>">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="<?php echo $location; ?>">
            <span class="help-block"><?php echo $location_err; ?></span>
        </div></br>
        <div class="form-group <?php echo (!empty($latitude_err)) ? 'has-error' : ''; ?>">
            <label>Latitude</label>
            <input type="text" name="latitude" class="form-control" value="<?php echo $latitude; ?>">
            <span class="help-block"><?php echo $latitude_err; ?></span>
        </div></br>
        <div class="form-group <?php echo (!empty($longitude_err)) ? 'has-error' : ''; ?>">
            <label>Longitude</label>
            <input type="text" name="longitude" class="form-control" value="<?php echo $longitude; ?>">
            <span class="help-block"><?php echo $longitude_err; ?></span>
        </div></br>
        <input type="hidden" name="locationid" value="<?php echo $locationid; ?>"/>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="managelocations.php" class="btn btn-default">Cancel</a>
        </div>
    </form>
</div>
<footer>
    <p>&copy; 2024 UCM Student Hub. All rights reserved.</p>
</footer>
</body>
</html>
