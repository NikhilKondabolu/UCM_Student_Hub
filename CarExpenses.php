<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}


if (isset($_POST["submit_car_expenses"])) {
    $miles_driven = $_POST["miles_driven"];
    $year = $_POST["year"];
    $ratio = $_POST["ratio"];
    $fuel_price = $_POST["fuel_price"];
    $insurance_cost = $_POST["insurance_cost"];

    // Calculate expenses
    $annual_insurance = $insurance_cost * 12;
    $fuel_expense = 0;
    if ($miles_driven == 'Upto 10,000 Miles') {
        $fuel_expense = 10000 * $fuel_price / $ratio;
    } elseif ($miles_driven == '10,000 to 15,000 Miles') {
        $fuel_expense = 12500 * $fuel_price / $ratio;
    } else {
        $fuel_expense = 15000 * $fuel_price / $ratio;
    }

    // Annual maintenance cost
    $annual_maintenance = $year == '2015 or above' ? 25 * 12 : 35 * 12;

    // Total annual expense
    $total_expense = $annual_insurance + $fuel_expense + $annual_maintenance;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Maintenance Calculator</title>
    <link rel="stylesheet" href="StyleSheet.css">
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .slider {
            width: 100%;
        }

        .slider-value {
            text-align: center;
        }
    </style>
    <script>
        function synchronizeFuelPriceInputs() {
            var slider = document.getElementById('fuel_price_slider');
            var input = document.getElementById('fuel_price');
            input.value = slider.value;
            slider.oninput = function() {
                input.value = this.value;
            }
            input.oninput = function() {
                slider.value = this.value;
            }
        }
        window.onload = synchronizeFuelPriceInputs;
    </script>
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
    <a href="Expenses.php" class="expenses"><span>Expense Calculator</span></a>
        <a href="logout.php">Logout</a>
    </nav>
    <p><a href="CarMaintenanceChecklist.php">Click here for Car Maintenance Checklist</a></p>
    <div class="container">
        <h1>Car Maintenance Calculator/Car Buying Guide</h1>
        <form method="post" action="CarExpenses.php">
            <div class="form-group">
                <label for="miles_driven">Miles Driven Annually:</label><br>
                <select id="miles_driven" name="miles_driven" required>
                    <option value="Upto 10,000 Miles">Upto 10,000 Miles</option>
                    <option value="10,000 to 15,000 Miles">10,000 to 15,000 Miles</option>
                    <option value="More than 15,000 Miles">More than 15,000 Miles</option>
                </select>
            </div>
            <div class="form-group">
                <label>Year:</label><br>
                <input type="radio" id="year_below" name="year" value="2014 or below" required>
                <label for="year_below">2014 or below</label><br>
                <input type="radio" id="year_above" name="year" value="2015 or above" required>
                <label for="year_above">2015 or above</label>
            </div>
            <div class="form-group">
                <label for="ratio">City/Highway Driving Ratio:</label><br>
                <input type="range" class="slider" id="ratio" name="ratio" min="1" max="100" value="50" oninput="this.nextElementSibling.value = this.value">
                <output>50</output>%
            </div>
            <div class="form-group">
                <label for="fuel_price">Fuel Price per Gallon:</label><br>
                <input type="range" class="slider" id="fuel_price_slider" name="fuel_price_slider" min="1" max="10" step="0.1" value="3" oninput="document.getElementById('fuel_price').value = this.value">
                <input type="number" id="fuel_price" name="fuel_price" min="1" max="10" step="0.1" value="3" oninput="document.getElementById('fuel_price_slider').value = this.value">
            </div>
            <div class="form-group">
                <label for="insurance_cost">Insurance Cost per Month:</label><br>
                <input type="number" id="insurance_cost" name="insurance_cost" min="0" required>
            </div>
            <button type="submit" name="submit_car_expenses">Calculate</button>
            <button type="reset" name="reset">Reset</button>
        </form>

        <?php if (isset($_POST["submit_car_expenses"])) : ?>
            <h2>Estimated Annual Expenses</h2>
            <p>Annual Insurance Cost: $<?php echo number_format($annual_insurance, 2); ?></p>
            <p>Annual Fuel Expense: $<?php echo number_format($fuel_expense, 2); ?></p>
            <p>Annual Maintenance Cost: $<?php echo number_format($annual_maintenance, 2); ?></p>
            <p>Total Annual Expense: $<?php echo number_format($total_expense, 2); ?></p>

            <h2>Additional Information</h2>
            <form method="post" action="CarExpenses.php">
                <input type="hidden" name="total_expense" value="<?php echo $total_expense; ?>">
                <div class="form-group">
                    <label>Number of Persons Benefiting from Car:</label><br>
                    <input type="checkbox" id="upto_2" name="benefit_persons" value="upto_2">
                    <label for="upto_2">Up to 2</label><br>
                    <input type="checkbox" id="more_than_2" name="benefit_persons" value="more_than_2">
                    <label for="more_than_2">More than 2</label>
                </div>
                <button type="submit" name="submit_benefit_persons">Submit</button>
            </form>
        <?php endif; ?>

        <?php if (isset($_POST["submit_benefit_persons"])) : ?>
            <h2>Car Ownership Recommendation</h2>
            <?php
            $benefit_persons = $_POST["benefit_persons"];
            if ($benefit_persons == "upto_2") {
                echo "<p>It's good not to buy a car, as the car expenses are high and a used car might get unexpected issues which might cause more spending.</p>";
            } else {
                echo "<p>Excellent! Having a car is a good choice for you.</p>";
            }
            ?>
        <?php endif; ?>
    </div>
    <footer>
        <p>&copy; 2024 UCM Student Hub. All rights reserved.</p>
    </footer>
</body>

</html>