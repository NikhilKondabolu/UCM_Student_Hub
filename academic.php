<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
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
        nav {
    background-color: navy;
    padding: 20px;
    text-align: center;
}
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
        .tiles a.register {
            background-image: url('images/register.jpg');
        }
        .tiles a.carrer {
            background-image: url('images/carrer.jpg');
        }
        .tiles a.suggestion {
            background-image: url('images/suggestion.jpg');
        }
        .tiles a.information {
            background-image: url('images/information.jpg');
        }
    </style>
</head>
<body>
<nav>
    <a href="Home.php">Home</a>    
    <a href="accommodation.php" class="accommodation"><span>Accommodation</span></a>

    <a href="requestrides.php" class="requestrides"><span>Request Rides</span></a>
    <a href="providerides.php" class="providerides"><span>Provide Rides</span></a>
    <a href="calendar.php" class="calendar"><span>Rides Calendar</span></a>
    <a href="courier.php" class="courier"><span>Courier Service</span></a>
    <a href="Expenses.php" class="expenses"><span>Expense Calculator</span></a>
    <a href="CarExpenses.php" class="carmaintenance"><span>Car Maintenance Calculator</span></a>  
    <a href="logout.php">Logout</a>
</nav><main>
<h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>


<nav class="tiles">
    <a href="https://mycentral.ucmo.edu/" class="register" target="_blank"><span>Register for classes</span></a>
    <a href="career_opportunities.php" class="carrer"><span>Carrer Oppurtunities</span></a>
    <a href="Academic_suggestion.php" class="suggestion"><span>Academic Suggestion</span></a>
    <a href="https://www.ucmo.edu/offices/international-student-services/internal-resources/student/international-student-information-and-forms/index.php" class="information" target="_blank"><span>Student Information</span></a>
</nav></main>
<footer>
    <p> &copy; 2024 UCM Student Hub. All rights reserved. </p>
</footer>
</body>
</html>
