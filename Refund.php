<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refunds and Cancellations</title>
    <link rel="stylesheet" href="stylesheet.css"> 
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .form-container {
            text-align: center;
        }
        .form-container form {
            display: inline-block;
            margin-top: 20px;
        }
        button {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }  
    </style>
</head>
<body>
<nav>
            <a href="accommodation.php">Accommodation</a>
            <a href="academic.php" class="academic"><span>Academic</span></a>
            <a href="requestrides.php" class="requestrides"><span>Request Rides</span></a>
            <a href="providerides.php" class="providerides"><span>Provide Rides</span></a>
            <a href="calendar.php" class="calendar"><span>Rides Calendar</span></a>
            <a href="courier.php" class="courier"><span>Courier Service</span></a>
            <a href="Expenses.php" class="expenses"><span>Expense Calculator</span></a>
            <a href="CarExpenses.php" class="carmaintenance"><span>Car Maintenance Calculator</span></a>
            <a href="Refund.php" class="Refund"><span>Cancel Ride/Refund</span></a>
            <a href="DiscountCoupons.php" class="DiscountCoupons"><span>Discount Coupons</span></a>
            <a href="Feedback.php" class="Feedback"><span>Feedback</span></a>
        </nav>
<div class="content-container">
    <h1>Your Ride and Courier History</h1>
    
    <?php
    ob_start();
    // Start the session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the user is not logged in, if not then redirect them to the login page
    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    }
    // Include the business tier class
    include_once("Inc_businessTierClass.php");
    $businessTier = new BusinessTierClass();

    // Initialize the $history variable by fetching ride and courier history for the logged-in user
    $username = $_SESSION["username"]; 
    $history = $businessTier->getAllHistory($username);

    if ($history) {
        // Display the rides and couriers in a table
        echo '<table>';
        echo '<tr><th>Pickup Location</th><th>Dropoff Location</th><th>Date/Time</th><th>Type</th><th>Seats/Weight</th><th>Price</th><th>Cancel</th></tr>';

        while ($row = sqlsrv_fetch_array($history, SQLSRV_FETCH_ASSOC)) {
            // Display each row with the 'Cancel' button
            
            $datetime = $row['datetime'];
            if ($datetime instanceof DateTime) {
                $datetime = $datetime->format('Y-m-d H:i:s'); // Format to a string
            }
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['pickup_location']) . '</td>';
            echo '<td>' . htmlspecialchars($row['dropoff_location']) . '</td>';
            echo '<td>' . htmlspecialchars($datetime) . '</td>';
            echo '<td>' . htmlspecialchars($row['ride_type']) . '</td>';
            echo '<td>' . htmlspecialchars($row['Seats/Weight']) . '</td>';
            echo '<td>' . htmlspecialchars($row['price']) . '</td>';
            if (strtotime($datetime) > time()) {
                echo '<td>
                        <form method="post" action="refund.php">
                            <input type="hidden" name="ride_id" value="' . htmlspecialchars($row['ID']) . '">
                            <input type="hidden" name="ride_type" value="' . htmlspecialchars($row['ride_type']) . '">
                            <select name="cancel_reason">
                                <option value="Reason 1">Changed Plan</option>
                                <option value="Reason 2">Price too high</option>
                                <option value="Reason 3">Getting Late</option>
                                <option value="Reason 4">Found better Ride</option>
                                <option value="Reason 5">Wrong Booking</option>
                            </select>
                            <button type="submit" name="cancel_ride">Cancel</button>
                        </form>
                      </td>';
            } else {
                echo '<td>Cannot Cancel</td>';
            }
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No ride or courier history found.</p>';
    }

    // validate form submission
    if (isset($_POST['cancel_ride'])) {
        $ride_id = $_POST['ride_id'];
        $ride_type = $_POST['ride_type'];
        $cancel_reason = $_POST['cancel_reason'];

        // Call the business tier method to delete the ride or courier
        $result = $businessTier->deleteRideOrCourier($ride_id, $ride_type);

        // refund message
        if ($result) {
            if ($cancel_reason == "Reason 1") {
                header("Refresh:0");
                echo "<script>alert('Your refund will be credited back.');</script>";
            } else {
               header("Refresh:0");
               echo"<script>alert('Sorry, the reason is inappropriate.');</script>";
            }
        } else {
            echo "<p>Failed to cancel the ride or courier.</p>";
        }
    }
    ?>

</div>

</body>
</html>
