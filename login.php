<?php
// Initialize the session
session_start();

// Include necessary files
include_once("Inc_businessTierClass.php");

// Initialize variables
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Create instance of BusinessTierClass
        $business = new BusinessTierClass();
        $validated_user = $business->validateUser($username, $password);

        if ($validated_user) {
            // Start a new session
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $validated_user;

            // Redirect user to the appropriate page based on username
            if ($validated_user == 'admin') {
                header("location: adminhome.php");
            } else {
                header("location: home.php");
            }
            exit;
        } else {
            $password_err = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="StyleSheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            display: block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <nav>
        <a href="HomePage.html">Home</a>
        <a href="register.php" class="register"><i class="fas fa-user-plus"></i> Register</a>
        <a href="about.html">About Us</a>
    </nav></br></br>
    <h2>Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div <?php if (!empty($username_err)) echo 'class="error"'; ?>>
            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
            <span class="error"><?php echo $username_err; ?></span>
        </div>
        <div <?php if (!empty($password_err)) echo 'class="error"'; ?>>
            <label>Password</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
            <span class="error"><?php echo $password_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
    </form>
</body>

</html>