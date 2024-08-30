<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is not logged in, if not then redirect them to the login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include_once("Inc_businessTierClass.php");
$business = new BusinessTierClass();

// Initialize $locations as an empty array
$locations = array();

// Fetch locations from the database
$stmt = $business->getAllLocations1();

if ($stmt) {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $locations[] = $row;
    }
    sqlsrv_free_stmt($stmt);
} else {
    die("Error fetching locations: " . print_r(sqlsrv_errors(), true));
}

// Check if form is submitted
if (isset($_POST['request_ride'])) {
    $username = $_SESSION["username"];
    $RideType = "Request";
    $pickup_location = $_POST["pickup_location"];
    $dropoff_location = $_POST["dropoff_location"];
    $date = $_POST["date"];
    $available_seats = $_POST["available_seats"];
    $price = $_POST["price"];
    $coupon = $_POST["coupon"];

    $date = date("Y-m-d H:i:s", strtotime($date));

    // Apply discount if coupon is valid
    if ($coupon === "STUDENT10") {
        $price = $price * 0.90; // Apply 10% discount

    }

    // Insert ride into database
    $stmt = $business->addRide("1", $RideType, $pickup_location, $dropoff_location, $date, $available_seats, $price);

    if ($stmt === false) {
        die("Error adding ride: " . print_r(sqlsrv_errors(), true));
    } else {
        echo "<script>alert('Ride posted successfully!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <center><title>Request a Ride</title>
    <link rel="stylesheet" type="text/css" href="StyleSheet.css">
    <script>
        function calculateDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Radius of the Earth in kilometers
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = 
                0.5 - Math.cos(dLat)/2 + 
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * 
                (1 - Math.cos(dLon))/2;

            return R * 2 * Math.asin(Math.sqrt(a));
        }

        function displayPrice() {
    const pickupLocation = document.getElementById('pickup_location');
    const dropoffLocation = document.getElementById('dropoff_location');
    const availableSeats = document.getElementById('available_seats').value;
    const coupon = document.getElementById('coupon').value;

    const locations = <?php echo json_encode($locations); ?>;
    const pickup = locations.find(location => location.locationid == pickupLocation.value);
    const dropoff = locations.find(location => location.locationid == dropoffLocation.value);

    if (pickup && dropoff) {
        const distance = calculateDistance(pickup.latitude, pickup.longitude, dropoff.latitude, dropoff.longitude);
        const pricePerMile = 1.5; // Example price per mile
        let price = distance * pricePerMile * availableSeats;
        let price1 = price; // Initialize price1 with the same value as price

        // Apply discount if coupon is valid
        if (coupon === "STUDENT10") {
            price1 = price * 0.90; // Apply 10% discount
        } else if (coupon !== '') {
            alert("Invalid Coupon");
        }

        document.getElementById('distance').innerText = `Distance: ${distance.toFixed(2)} Miles`;
        document.getElementById('price').value = price1.toFixed(2); // Store the price to be sent in form submission

        // Display the prices
        if (coupon === "STUDENT10") {
            document.getElementById('priceb').innerText = `Price before discount: $${price.toFixed(0)}`;
        }
        document.getElementById('price_display').innerText = `Price: $${price1.toFixed(0)}`;
        document.getElementById('Compare').innerText = `Price for Uber/Lyft will be: $${(price * 1.25).toFixed(0)}`;
        
        document.getElementById('request_ride_button').style.display = 'block';
    } else {
        document.getElementById('distance').innerText = `Invalid locations selected.`;
        document.getElementById('price_display').innerText = `Unable to calculate price.`;
        document.getElementById('request_ride_button').style.display = 'none';
    }
}


        function validateDate() {
            const dateInput = document.getElementById('date');
            const today = new Date().toISOString().split('T')[0];
            if (dateInput.value < today) {
                alert("Please select a future date.");
                dateInput.value = '';
            }
        }

        function updateDropDowns() {
            const pickupLocation = document.getElementById('pickup_location');
            const dropoffLocation = document.getElementById('dropoff_location');
            const selectedPickup = pickupLocation.value;

            for (let option of dropoffLocation.options) {
                option.disabled = (option.value === selectedPickup);
            }

            if (dropoffLocation.value === selectedPickup) {
                dropoffLocation.value = ""; // Reset if currently selected value is disabled
            }

            // Only recalculate the price when the button is clicked
            document.getElementById('request_ride_button').style.display = 'none';
        }

        window.onload = function() {
            // No automatic price display on page load
        };
    </script>
</head>
<body>
<nav>
    <a href="home.php">Home</a>
    <a href="accommodation.php" class="accommodation"><span>Accommodation</span></a>
    <a href="academic.php" class="academic"><span>Academic</span></a>
    <a href="providerides.php" class="providerides"><span>Provide Rides</span></a>
    <a href="calendar.php" class="calendar"><span>Rides Calendar</span></a>
    <a href="courier.php" class="courier"><span>Courier Service</span></a>
    <a href="Expenses.php" class="expenses"><span>Expense Calculator</span></a>
    <a href="CarExpenses.php" class="carmaintenance"><span>Car Maintenance Calculator</span></a>
    <a href="logout.php">Logout</a>
</nav>
<br><br>
<p>
    Previous booking history: <a href="history.php">Click here</a>
</p><br>
<center><h2>Request a Ride</h2></center>
<center>
<form method="post" action="requestrides.php">
    <label for="pickup_location">From:</label><br>
    <select id="pickup_location" name="pickup_location" onchange="updateDropDowns()">
        <option value="">Select a location</option>
        <?php if (!empty($locations)): ?>
            <?php foreach ($locations as $location): ?>
                <option value="<?php echo $location['locationid']; ?>"><?php echo $location['location']; ?></option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="">No locations available</option>
        <?php endif; ?>
    </select><br><br>

    <label for="dropoff_location">To:</label><br>
    <select id="dropoff_location" name="dropoff_location">
        <option value="">Select a location</option>
        <?php if (!empty($locations)): ?>
            <?php foreach ($locations as $location): ?>
                <option value="<?php echo $location['locationid']; ?>"><?php echo $location['location']; ?></option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="">No locations available</option>
        <?php endif; ?>
    </select><br><br>

    <label for="date">Date:</label><br>
    <input type="datetime-local" id="date" name="date" required onchange="validateDate()"><br><br>

    <label for="available_seats">Number of Passengers:</label><br>
    <input type="number" id="available_seats" name="available_seats" min="1" max="6" value="1"><br><br>
    
    <label for="coupon">Coupon Code:  <a href="DiscountCoupons.php" target="_blank">Get Coupon</a></label><br>
    <input type="text" id="coupon" name="coupon" placeholder="Enter coupon code"><br><br>

    <button type="button" onclick="displayPrice()">Click to get price</button>
    <br><br>

    <div id="distance"></div>
    <div id="price_display"></div>
    <div id="priceb"></div>
    <div id="Compare"></div>
    
    <input type="hidden" id="price" name="price"><br><br>

    <div id="request_ride_button" style="display: none;">
        <input type="submit" name="request_ride" value="Request Ride">
    </div>
</form></center>
<footer>
    <p>&copy; 2024 UCM Student Hub. All rights reserved.</p>
</footer>
</body>
</html>
