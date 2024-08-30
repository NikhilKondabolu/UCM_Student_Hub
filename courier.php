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

// Fetch locations from the database
$stmt = $business->getAllLocations();
$locations = array();

if ($stmt) {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $locations[] = $row;
    }
    sqlsrv_free_stmt($stmt);
} else {
    die("Error fetching locations: " . print_r(sqlsrv_errors(), true));
}

// Item types
$item_types = ["Documents", "Food Items", "Clothes", "Electronic Gadgets", "Others"];

// Check if form is submitted
if (isset($_POST['request_courier'])) {
    $username = $_SESSION["username"];
    $item_type = $_POST["item_type"];
    $weight = $_POST["weight"];
    $pickup_location = $_POST["pickup_location"];
    $dropoff_location = $_POST["dropoff_location"];
    $date = $_POST["date"];
    $price = $_POST["price"];

    $stmt = $business->addCourierRequest($username, $item_type, $weight, $pickup_location, $dropoff_location, $date, $price);

    if ($stmt === false) {
        die("Error adding courier request: " . print_r(sqlsrv_errors(), true));
    } else {
        echo "<script>alert('Courier request posted successfully! If anyone is travelling this route, they will reach out to you.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post Courier Request</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script>
        function calculatePrice() {
            const weight = document.getElementById('weight').value;
            const pricePerPound = 1.5; // Example price per pound
            const price = weight * pricePerPound;

            document.getElementById('price_display').innerText = `Price: $${price.toFixed(2)}`;
            document.getElementById('price').value = price.toFixed(2);
        }

        function updateDropoffOptions() {
            const pickup = document.getElementById('pickup_location').value;
            const dropoffSelect = document.getElementById('dropoff_location');
            const options = dropoffSelect.options;

            for (let i = 0; i < options.length; i++) {
                options[i].disabled = options[i].value === pickup;
            }
        }

        function validateForm() {
            const weight = document.getElementById('weight').value;
            const date = new Date(document.getElementById('date').value);
            const today = new Date();

            if (weight < 0) {
                alert("Weight cannot be negative.");
                return false;
            }

            if (date < today) {
                alert("Date cannot be a past date.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
<nav>
    <a href="home.php">Home</a>
    <a href="accommodation.php" class="accommodation"><span>Accommodation</span></a>
    <a href="academic.php" class="academic"><span>Academic</span></a>
    <a href="requestrides.php" class="requestrides"><span>Request Rides</span></a>
    <a href="providerides.php" class="providerides"><span>Provide Rides</span></a>
    <a href="calendar.php" class="calendar"><span>Rides Calendar</span></a>
    
    <a href="Expenses.php" class="expenses"><span>Expense Calculator</span></a>
    <a href="CarExpenses.php" class="carmaintenance"><span>Car Maintenance Calculator</span></a>
    <a href="logout.php">Logout</a>
</nav>
<br><br><main><center>
<p>
    Previous booking history: <a href="history.php">Click here</a>
</p><br>
<h2>Request a Courier</h2>

<form method="post" action="courier.php" onsubmit="return validateForm()">
    <label for="item_type">Type of Item:</label><br>
    <select id="item_type" name="item_type" required>
        <?php foreach ($item_types as $item_type): ?>
            <option value="<?php echo $item_type; ?>"><?php echo $item_type; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="weight">Weight (lbs):</label><br>
    <input type="number" id="weight" name="weight" min="0" required oninput="calculatePrice()"><br><br>

    <label for="pickup_location">From:</label><br>
    <select id="pickup_location" name="pickup_location" required onchange="updateDropoffOptions()">
        <?php foreach ($locations as $location): ?>
            <option value="<?php echo $location['locationid']; ?>"><?php echo $location['location']; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="dropoff_location">To:</label><br>
    <select id="dropoff_location" name="dropoff_location" required>
        <?php foreach ($locations as $location): ?>
            <option value="<?php echo $location['locationid']; ?>"><?php echo $location['location']; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="date">Approximate Date:</label><br>
    <input type="date" id="date" name="date" required><br><br>

    <div id="price_display"></div>
    <input type="hidden" id="price" name="price"><br><br>

    <input type="submit" name="request_courier" value="Post Courier Request">
</form></center></main>
<footer>
    <p>&copy; 2024 UCM Student Hub. All rights reserved.</p>
</footer>
</body>
</html>
