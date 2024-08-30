<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include_once("Inc_businessTierClass.php");
$business = new BusinessTierClass();

// Fetch booking history for the logged-in user
$username = $_SESSION["username"];
$stmt = $business->getAllHistory($username);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Booking History</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<nav>
    <a href="home.php">Home</a>
    <a href="accommodation.php" class="accommodation"><span>Accommodation</span></a>
    <a href="academic.php" class="academic"><span>Academic</span></a>
    <a href="requestrides.php" class="requestrides"><span>Request Rides</span></a>
    <a href="providerides.php" class="providerides"><span>Provide Rides</span></a>
    <a href="calendar.php" class="calendar"><span>Rides Calendar</span></a>
    <a href="courier.php" class="courier"><span>Courier Service</span></a>
    <a href="Expenses.php" class="expenses"><span>Expense Calculator</span></a>
    <a href="CarExpenses.php" class="carmaintenance"><span>Car Maintenance Calculator</span></a>
    <a href="logout.php">Logout</a>
</nav>
<br><br>
<main>
<h2>Booking History</h2>

<table>
    <tr>
        <th>Ride Type</th>
        <th>Pickup Location</th>
        <th>Dropoff Location</th>
        <th>Date and Time</th>
        <th>Seats/Weight</th>
        <th>Price</th>
    </tr>
    <?php
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['ride_type'] . "</td>";
        echo "<td>" . $row['pickup_location'] . "</td>";
        echo "<td>" . $row['dropoff_location'] . "</td>";
        echo "<td>" . $row['datetime']->format('Y-m-d H:i:s') . "</td>";
        echo "<td>" . $row['Seats/Weight'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "</tr>";
    }
    sqlsrv_free_stmt($stmt);
    ?>
</table></main>
<footer>
    <p>&copy; 2024 UCM Student Hub. All rights reserved.</p>
</footer>
</body>
</html>
