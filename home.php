<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="StyleSheet.css">
    <style>
        .tiles {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .tiles a {
            display: block;
            width: 200px;
            height: 200px;
            margin: 10px;
            background-size: cover;
            background-position: center;
            text-decoration: none;
            color: white;
            text-align: center;
            line-height: 200px;
            font-size: 18px;
            font-weight: bold;
            position: relative;
        }

        .tiles a::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .tiles a span {
            position: relative;
            z-index: 1;
        }

        .tiles a.accommodation {
            background-image: url('images/accommodation.jpg');
        }

        .tiles a.academic {
            background-image: url('images/academic.jpg');
        }

        .tiles a.requestrides {
            background-image: url('images/requestrides.jpg');
        }

        .tiles a.providerides {
            background-image: url('images/providerides.jpg');
        }

        .tiles a.calendar {
            background-image: url('images/calendar.jpg');
        }

        .tiles a.courier {
            background-image: url('images/courier.jpg');
        }

        .tiles a.expenses {
            background-image: url('images/expenses.jpg');
        }

        .tiles a.carmaintenance {
            background-image: url('images/carmaintenance.jpg');
        }
        .tiles a.DiscountCoupons {
            background-image: url('images/Discount.jpeg');
        }
        .tiles a.Feedback {
            background-image: url('images/Feedback.jpeg');
        }
        .tiles a.Refund {
            background-image: url('images/Refund.jpg');
        }
        
    </style>
</head>

<body>
    <main>
        <nav>
            <a href="Home.php">Home</a>
            <a href="logout.php">Logout</a>
        </nav>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>


        <nav class="tiles">
            <a href="accommodation.php" class="accommodation"><span>Accommodation</span></a>
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
    </main>
    <footer>
        <p> &copy; 2024 UCM Student Hub. All rights reserved. </p>
    </footer>
</body>

</html>