<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect them to the home page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: home.php");
    exit;
}

// Include BusinessTierClass
include_once("inc_businessTierClass.php");

// Create an instance of BusinessTierClass
$businessTier = new BusinessTierClass();

// Define variables and initialize with empty values
$username = $password = $confirm_password = $phone = $dob = $address = "";
$username_err = $password_err = $confirm_password_err = $phone_err = $dob_err = $address_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter an email address.";
    } elseif (!filter_var(trim($_POST["username"]), FILTER_VALIDATE_EMAIL)) {
        $username_err = "Please enter a valid email address.";
    } else {
        $username = trim($_POST["username"]);
        $username_err = $businessTier->validateUsername($username);
    }

    // Validate phone number
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter a phone number.";
    } elseif (!preg_match('/^\d{10}$/', trim($_POST["phone"]))) {
        $phone_err = "Please enter a valid 10-digit phone number.";
    } else {
        $phone = trim($_POST["phone"]);
        $phone_err = $businessTier->validatePhone($phone);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm your password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Passwords did not match.";
        }
    }

    // Validate DOB
    if (empty(trim($_POST["dob"]))) {
        $dob_err = "Please enter your date of birth.";
    } else {
        $dob = trim($_POST["dob"]);
        $currentDate = new DateTime();
        $dobDate = new DateTime($dob);
        $age = $currentDate->diff($dobDate)->y;
        if ($age < 18) {
            $dob_err = "You must be at least 18 years old.";
        } elseif ($age > 100) {
            $dob_err = "You must be less than 100 years old.";
        }
    }

    // Validate address
    if (empty(trim($_POST["address"]))) {
        $address_err = "Please enter your address.";
    } else {
        $address = trim($_POST["address"]);
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($phone_err) && empty($dob_err) && empty($address_err)) {

        // Register the user
        $register_result = $businessTier->registerUser($username, $password, $phone, $dob, $address);

        if ($register_result === true) {
            // Redirect to login page
            header("location: login.php");
            exit;
        } else {
            // Display error message
            echo $register_result;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body { font-family: Arial, sans-serif; }
        form { max-width: 300px; margin: 0 auto; }
        input[type="text"], input[type="password"], input[type="submit"], input[type="date"], input[type="email"] {
            width: 100%; padding: 10px; margin: 5px 0; display: block; border: 1px solid #ccc; box-sizing: border-box;
        }
        input[type="submit"] { background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        input[type="submit"]:hover { background-color: #45a049; }
        .error { color: red; }
    </style>
    <link rel="stylesheet" href="StyleSheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script>
        function validateForm() {
            var dob = document.getElementById("dob").value;
            var dobDate = new Date(dob);
            var today = new Date();
            var age = today.getFullYear() - dobDate.getFullYear();
            var monthDifference = today.getMonth() - dobDate.getMonth();
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < dobDate.getDate())) {
                age--;
            }
            if (age < 18) {
                alert("You must be at least 18 years old.");
                return false;
            }
            if (age > 100) {
                alert("You must be less than 100 years old.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <nav>
        <a href="Homepage.html">Home</a>     
        <a href="about.html">About Us</a>   
        <a href="login.php" class="login"><i class="fas fa-sign-in-alt"></i> Login</a>
    </nav>
    <h2>Register</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
        <div <?php echo (!empty($username_err)) ? 'class="error"' : ''; ?>>
            <label>Username (EmailId)</label>
            <input type="email" name="username" value="<?php echo htmlspecialchars($username); ?>" title="Please enter a valid email address" required>
            <span class="error"><?php echo $username_err; ?></span>
        </div></br>
        <div <?php echo (!empty($phone_err)) ? 'class="error"' : ''; ?>>
            <label>Mobile no:</label>
            <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" pattern="[0-9]{10}" title="Please enter a 10-digit phone number" required>
            <span class="error"><?php echo $phone_err; ?></span>
        </div></br>
        <div>
            <label>Date of Birth:</label>
            <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
            <span class="error"><?php echo $dob_err; ?></span>
        </div></br>
        <div>
            <label>Address: (Including City and Zipcode)</label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>" required>
        </div></br>
        <div <?php echo (!empty($password_err)) ? 'class="error"' : ''; ?>>
            <label>Password</label>
            <input type="password" name="password">
            <span class="error"><?php echo $password_err; ?></span>
        </div></br>
        <div <?php echo (!empty($confirm_password_err)) ? 'class="error"' : ''; ?>>
            <label>Confirm Password</label>
            <input type="password" name="confirm_password">
            <span class="error"><?php echo $confirm_password_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Register">
        </div>
    </form>
</body>
</html>
