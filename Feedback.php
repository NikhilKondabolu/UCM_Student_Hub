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
// Check if form is submitted
if (isset($_POST['submit_feedback'])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $feedback_type = $_POST["feedback_type"];
    $comments = $_POST["comments"];
    $new_location_suggestion = $_POST["new_location_suggestion"];
    $feature_enhancements = $_POST["feature_enhancements"];
    $rating = $_POST["rating"];
    $username = $_POST["username"];

    // Insert feedback into the database
    $stmt = $business->addFeedback($name, $email, $feedback_type, $comments, $new_location_suggestion, $feature_enhancements, $rating, $username);

    if ($stmt === false) {
        die("Error submitting feedback: " . print_r(sqlsrv_errors(), true));
    } else {
        echo "<script>alert('Thank you for your feedback!');</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback</title>
    <link rel="stylesheet" type="text/css" href="StyleSheet.css">
</head>
<body>
    <nav>
        <a href="home.php">Home</a>
        <a href="accommodation.php" class="accommodation"><span>Accommodation</span></a>
        <a href="academic.php" class="academic"><span>Academic</span></a>
        <a href="providerides.php" class="providerides"><span>Provide Rides</span></a>
        <a href="requestrides.php" class="requestrides"><span>Request Rides</span></a>
        <a href="calendar.php" class="calendar"><span>Rides Calendar</span></a>
        <a href="courier.php" class="courier"><span>Courier Service</span></a>
        <a href="Expenses.php" class="expenses"><span>Expense Calculator</span></a>
        <a href="CarExpenses.php" class="carmaintenance"><span>Car Maintenance Calculator</span></a>
        <a href="logout.php">Logout</a>
    </nav>
    <br><br>
    <div class="container">
        <center>
            <h2>Feedback</h2>
            <p><strong>Rating:</strong> <span style="color: gold;">&#9733;&#9733;&#9733;&#9733;&#9734;</span> <?php echo $business->getAverageRating(); ?>/5</p>
        </center>
        <center>
            <form method="post" action="Feedback.php">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="feedback_type">Feedback Type:</label>
                <select id="feedback_type" name="feedback_type" required>
                    <option value="General">General</option>
                    <option value="Bug">Bug Report</option>
                    <option value="Feature">Feature Request</option>
                </select><br><br>

                <label for="comments">Comments:</label><br>
                <textarea id="comments" name="comments" rows="4" cols="50" required></textarea><br><br>

                <label for="new_location_suggestion">Suggest a New Location:</label><br>
                <textarea id="new_location_suggestion" name="new_location_suggestion" rows="2" cols="50"></textarea><br><br>

                <label for="feature_enhancements">Feature Enhancements:</label><br>
                <textarea id="feature_enhancements" name="feature_enhancements" rows="2" cols="50"></textarea><br><br>

                <label for="rating">App Rating (1-5):</label>
                <input type="number" id="rating" name="rating" min="1" max="5" required><br><br>

                <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">

                <input type="submit" name="submit_feedback" value="Submit Feedback">
            </form>
            <br><br>
        </center>
    </div>
    <footer>
        <p>&copy; 2024 UCM Student Hub. All rights reserved.</p>
    </footer>
</body>
</html>
