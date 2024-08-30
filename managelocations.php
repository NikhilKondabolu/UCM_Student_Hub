<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include the business tier class
include_once("Inc_businessTierClass.php");

// Instantiate the business tier class
$serverName = "localhost";
$connectionOptions = array(
    "Database" => "UCM_Student_Hub",
    "Uid" => "app",
    "PWD" => "password"
);
$businessTier = new BusinessTierClass($serverName, $connectionOptions);

// Define variables and initialize with empty values
$location = $latitude = $longitude = "";
$location_err = $latitude_err = $longitude_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate location
    if (empty(trim($_POST["location"]))) {
        $location_err = "Please enter a location.";
    } else {
        $location = trim($_POST["location"]);
    }

    // Validate latitude
    if (empty(trim($_POST["latitude"]))) {
        $latitude_err = "Please enter a latitude.";
    } elseif (!is_numeric($_POST["latitude"]) || $_POST["latitude"] < -90 || $_POST["latitude"] > 90) {
        $latitude_err = "Please enter a valid latitude between -90 and 90.";
    } else {
        $latitude = trim($_POST["latitude"]);
    }

    // Validate longitude
    if (empty(trim($_POST["longitude"]))) {
        $longitude_err = "Please enter a longitude.";
    } elseif (!is_numeric($_POST["longitude"]) || $_POST["longitude"] < -180 || $_POST["longitude"] > 180) {
        $longitude_err = "Please enter a valid longitude between -180 and 180.";
    } else {
        $longitude = trim($_POST["longitude"]);
    }

    // Check input errors before inserting in database
    if (empty($location_err) && empty($latitude_err) && empty($longitude_err)) {
        // Insert location
        $added_by = "1";  // Assuming you store UserId in session

        $result = $businessTier->insertLocation($location, $latitude, $longitude, $added_by);

        if ($result === false) {
            echo "Error inserting location.";
        } else {
            header("location: managelocations.php");
            exit;
        }
    }
}

// Fetch locations from the database
$locations = $businessTier->fetchLocations();
if ($locations === false) {
    die("Error fetching locations.");
}

// Handle deletion
if (isset($_GET['delete'])) {
    $locationid = $_GET['delete'];
    $result = $businessTier->deleteLocation($locationid);

    if ($result === false) {
        die("Error deleting location.");
    }
    header("location: managelocations.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Locations</title>
    <link rel="stylesheet" href="StyleSheet.css">
</head>

<body>
    <nav>
        <a href="adminhome.php">Home</a>
        <a href="manageusers.php">Manage Users</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="content-container">
        <h2>Manage Locations</h2>
        <p>Please fill this form to add a new location.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($location_err)) ? 'has-error' : ''; ?>">
                <label>Location</label>
                <input type="text" name="location" class="form-control" value="<?php echo htmlspecialchars($location); ?>">
                <span class="help-block"><?php echo $location_err; ?></span>
            </div></br>
            <div class="form-group <?php echo (!empty($latitude_err)) ? 'has-error' : ''; ?>">
                <label>Latitude</label>
                <input type="text" name="latitude" class="form-control" value="<?php echo htmlspecialchars($latitude); ?>">
                <span class="help-block"><?php echo $latitude_err; ?></span>
            </div></br>
            <div class="form-group <?php echo (!empty($longitude_err)) ? 'has-error' : ''; ?>">
                <label>Longitude</label>
                <input type="text" name="longitude" class="form-control" value="<?php echo htmlspecialchars($longitude); ?>">
                <span class="help-block"><?php echo $longitude_err; ?></span>
            </div></br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>

    <div class="content-container">
        <table>
            <caption>
                <h2>Locations List</h2>
            </caption>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Location</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Added By</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = sqlsrv_fetch_array($locations, SQLSRV_FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['LocationId']); ?></td>
                        <td><?php echo htmlspecialchars($row['Location']); ?></td>
                        <td><?php echo htmlspecialchars($row['Latitude']); ?></td>
                        <td><?php echo htmlspecialchars($row['Longitude']); ?></td>
                        <td><?php echo htmlspecialchars($row['AddedByUserId']); ?></td>
                        <td>
                            <a href="edit_location.php?locationid=<?php echo htmlspecialchars($row['LocationId']); ?>">Edit</a>
                            <a href="managelocations.php?delete=<?php echo htmlspecialchars($row['LocationId']); ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <footer>
        <p>&copy; 2024 UCM Student Hub. All rights reserved.</p>
    </footer>
</body>

</html>