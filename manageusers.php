<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include the business tier class
include_once("Inc_businessTierClass.php");

// Instantiate the business tier class
$businessTier = new BusinessTierClass();

// Error variables
$usernameError = "";
$ageError = "";


error_reporting(E_ALL);
ini_set('display_errors', 1);
// Handle form submissions for add and delete operations
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_user'])) {
        // Add user
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $phone = trim($_POST["phone"]);
        $DOB = trim($_POST["DOB"]);
        $Address = trim($_POST["Address"]);

        // Calculate age
        $age = (int)date_diff(date_create($DOB), date_create('today'))->y;

        if ($age < 18 || $age > 100) {
            $ageError = "Age must be between 18 and 100.";
        } else {
            // Add user via business tier
            $result = $businessTier->addUser($username, $password, $phone, $DOB, $Address);

            if (is_string($result)) {
                // Error message from the business tier
                $usernameError = $result;
            } else {
                header("location: manageusers.php");
                exit;
            }
        }
    }
}

// Handle delete action
if (isset($_GET['delete'])) {
    $username = $_GET['delete'];

    // Delete user via business tier
    $result = $businessTier->deleteUser($username);

    if ($result === false) {
        die("Error deleting user.");
    }
    header("location: manageusers.php");
    exit;
}

// Fetch users for display
$users = $businessTier->fetchUsers();
if ($users === false) {
    die("Error fetching users.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="StyleSheet.css">
    <script>
        function validateForm() {
            var dob = document.forms["userForm"]["DOB"].value;
            var today = new Date();
            var birthDate = new Date(dob);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            if (age < 18 || age > 100) {
                alert("Age must be between 18 and 100.");
                return false;
            }
            return true;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to validate username via AJAX
            $('input[name="username"]').on('blur', function() {
                var username = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'validate.php',
                    data: {
                        username: username
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.username) {
                            $('span.erroru').text(response.username);
                        } else {
                            $('span.erroru').text('');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error for username validation:', textStatus, errorThrown);
                        console.error('Response:', jqXHR.responseText);
                    }
                });
            });

            // Function to validate phone number via AJAX
            $('input[name="phone"]').on('blur', function() {
                var phone = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: 'validate.php',
                    data: {
                        phone: phone
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.phone) {
                            $('span.error').text(response.phone);
                        } else {
                            $('span.error').text('');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error for phone validation:', textStatus, errorThrown);
                        console.error('Response:', jqXHR.responseText);
                    }
                });
            });
        });
    </script>
</head>

<body>
    <nav>
        <a href="adminhome.php">Home</a>
        <a href="managelocations.php">Manage Locations</a>
        <a href="logout.php">Logout</a>
    </nav>
    <div class="content-container">
        <h2>Manage Users</h2>

        <!-- Form for adding a new user -->
        
            <form name="userForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm();">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                    <span class="erroru"></span>
                    <?php if (!empty($usernameError)) : ?>
                        <span class="error"><?php echo htmlspecialchars($usernameError); ?></span>
                    <?php endif; ?>
                </div></br>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div></br>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" required>
                    <span class="error"></span>
                </div></br>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" name="DOB" class="form-control" required>
                </div></br>
                <div class="form-group">
                    <label>Address</label>
                    <textarea name="Address" class="form-control" required></textarea>
                </div></br>
                <div class="form-group">
                    <input type="submit" name="add_user" class="btn btn-primary" value="Add User">
                </div>
                <?php if (!empty($ageError)) : ?>
                    <span class="error"><?php echo htmlspecialchars($ageError); ?></span>
                <?php endif; ?>
            </form>
        <!-- Display existing users -->
        <table>
            <caption>
                <h2>Existing Users</h2>
            </caption>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>Date of Birth</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = sqlsrv_fetch_array($users, SQLSRV_FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['Username']); ?></td>
                        <td><?php echo htmlspecialchars($row['Phone']); ?></td>
                        <td><?php echo isset($row['DOB']) && $row['DOB'] !== null ? $row['DOB']->format('Y-m-d') : 'N/A'; ?></td>
                        <td><?php echo htmlspecialchars($row['Address']); ?></td>
                        <td>
                            <a href="edit_user.php?username=<?php echo urlencode($row['Username']); ?>">Edit</a>
                            <a href="manageusers.php?delete=<?php echo urlencode($row['Username']); ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <footer>
        <p>&copy; 2024 UCM Student Hub. All rights reserved.</p>
    </footer>
</body>

</html>