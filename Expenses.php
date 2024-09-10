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
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Created by Kondabolu -->
    <title>Expenses Calculator</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="StyleSheet.css">
    <style>
        .warning {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <nav>
        <a href="Home.php">Home</a>
        <a href="accommodation.php" class="accommodation"><span>Accommodation</span></a>
        <a href="academic.php" class="academic"><span>Academic</span></a>
        <a href="requestrides.php" class="requestrides"><span>Request Rides</span></a>
        <a href="providerides.php" class="providerides"><span>Provide Rides</span></a>
        <a href="calendar.php" class="calendar"><span>Rides Calendar</span></a>
        <a href="courier.php" class="courier"><span>Courier Service</span></a>
        <a href="CarExpenses.php" class="carmaintenance"><span>Car Maintenance Calculator</span></a>
        <a href="logout.php">Logout</a>
    </nav>
    <center>
        <h1>Expenses Form</h1></br>
        <form method="post" action="Expenses.php">
            <p>
                <label for="roommates">Please enter total number of roommates per House:</label>
                <select id="roommates" name="roommates" required>
                    <?php for ($i = 1; $i <= 9; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php echo (isset($_POST['roommates']) && $_POST['roommates'] == $i) ? 'selected' : ''; ?>>
                            <?php echo $i; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </p></br>
            <p>
                <label for="Rent">Please enter your Rent including Utilities and Internet:</label>
                <input type="number" name="Rent" min="0" value="<?php if (isset($_POST['Rent'])) echo $_POST['Rent'] ?>" title="Please enter Rent" required>
                <?php if (isset($_POST['Rent']) && $_POST['Rent'] < 350): ?>
                    <span class="warning">Average price is greater than $350</span>
                <?php endif; ?>
            </p></br>
            <p>
                <label for="Groceries">Please Enter Total Groceries cost per month:</label>
                <input type="number" name="Groceries" min="0" value="<?php if (isset($_POST['Groceries'])) echo $_POST['Groceries'] ?>" title="Please enter Total Groceries cost per month" required>
                <?php if (isset($_POST['Groceries']) && $_POST['Groceries'] < 80): ?>
                    <span class="warning">Minimum $80 is needed for healthy living</span>
                <?php endif; ?>
            </p></br>
            <p>
                <label for="Phone">Please enter your Mobile bill:</label>
                <input type="number" name="Phone" min="0" value="<?php if (isset($_POST['Phone'])) echo $_POST['Phone'] ?>" title="Please enter phone bill" required>
                <?php if (isset($_POST['Phone']) && $_POST['Phone'] < 10): ?>
                    <span class="warning">Minimum bill will be $10</span>
                <?php endif; ?>
            </p></br>
            <p>
                <label for="Rides">Please enter amount spent on your Total Rides:</label>
                <input type="number" name="Rides" min="0" value="<?php if (isset($_POST['Rides'])) echo $_POST['Rides'] ?>" title="Please enter Rides cost" required>
            </p></br>
            <p>
                <label for="miscellaneous">Please enter amount spent on any miscellaneous items:</label>
                <input type="number" name="miscellaneous" min="0" value="<?php if (isset($_POST['miscellaneous'])) echo $_POST['miscellaneous'] ?>" title="Please enter miscellaneous cost" required>
            </p></br>
            <?php
            $termarray = array("Fall", "Spring", "Summer"); // array with all terms
            ?>
            <p>
                <label for="term">Select Term:</label>
                <select name="selectterm" id="term">
                    <?php foreach ($termarray as $index => $term): ?>
                        <option value="<?php echo $index; ?>" <?php echo (isset($_POST['selectterm']) && $_POST['selectterm'] == $index) ? 'selected' : ''; ?>>
                            <?php echo $term; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </p></br>
            <p>
                <label for="number">Choose number of subjects:</label>
                <select id="number" name="number" required>
                    <?php for ($i = 0; $i <= 4; $i++): ?>
                        <option value="<?php echo $i; ?>" <?php echo (isset($_POST['number']) && $_POST['number'] == $i) ? 'selected' : ''; ?>>
                            <?php echo $i; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </p></br>
            <p>
                <input type="submit" name="Submit" value="Submit">
            </p>

            <?php
            if (isset($_POST['Submit'])) {
                // Retrieve form values
                $rent = $_POST['Rent'];
                $groceries = $_POST['Groceries'];
                $roommates = $_POST['roommates'];
                $phone = $_POST['Phone'];
                $rides = $_POST['Rides'];
                $miscellaneous = $_POST['miscellaneous'];
                $selectterm = $_POST['selectterm'];
                $number = $_POST['number'];

                $monthly_expenses = ((($rent + $groceries) / $roommates) + $phone + $rides + $miscellaneous);

                // Calculate tuition fee for selected term
                $tuition_fee = ($number * 1326);

                // Display the calculated costs
                echo "<p>Your Estimated monthly living expenses are: <b>$$monthly_expenses</b></p>";
                echo "<p>Your Estimated tuition fee for the selected term is: <b>$$tuition_fee</b></p>";
                echo "<p>Your Estimated Insurance for the selected term is: <b>$836</b></p>";
            }
            ?>
        </form>
    </center>
    <footer>
        <p> &copy; 2024 UCM Rides. All rights reserved. </p>
    </footer>
</body>

</html>