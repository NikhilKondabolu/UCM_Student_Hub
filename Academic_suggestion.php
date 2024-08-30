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
    <title>Accommodation</title>
    <link rel="stylesheet" href="StyleSheet.css">
    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .accommodation-content {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<nav>
    <a href="Home.php">Home</a>
    <a href="logout.php">Logout</a>
</nav>
</br></br>
<h1>Fill the form below to get Academic suggestion</h1><br>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prereq = isset($_POST['selectPrereq']) ? $_POST['selectPrereq'] : '';
    $course = isset($_POST['selectCourse']) ? $_POST['selectCourse'] : '';
    $semester = isset($_POST['selectSemester']) ? $_POST['selectSemester'] : '';
    
    if ($prereq == 'NO' && ($course == 'CIS' || $course == 'BDA') && $semester == 'Fall') {
        $message = "As you don't have a prerequisite and you started your Master's in Fall, if you take 3 courses in each semester and start your CPT from next Fall. Or you can request for readings as 4th course in either of the next 2 semesters and start your OPT from next Fall.";
    } elseif ($prereq == 'YES' && ($course == 'CIS' || $course == 'BDA') && $semester == 'Fall') {
        $message = "As you have a prerequisite and you started your Master's in Fall, if you take 3 courses in 1st semester and request for a 4th course in either of the next 2 semesters and start your CPT from next Fall.";
    } elseif ($prereq == 'NO' && ($course == 'CIS' || $course == 'BDA') && $semester == 'Spring') {
        $message = "As you don't have a prerequisite and you started your Master's in Spring, if you take 3 courses in each semester and start your CPT from next Spring. Or you can request for readings as 4th course in either of the next 2 semesters and start your OPT from next Spring.";
    } elseif ($prereq == 'YES' && ($course == 'CIS' || $course == 'BDA') && $semester == 'Spring') {
        $message = "As you have a prerequisite and you started your Master's in Spring, if you take 3 courses in 1st semester and request for a 4th course in either of the next 2 semesters and start your CPT from next Spring.";
    } elseif ($prereq == 'NO' && ($course == 'CIS' || $course == 'BDA') && $semester == 'Summer') {
        $message = "As you don't have a prerequisite and you started your Master's in Summer, if you take 3 courses in each semester and start your CPT from next Summer. Or you can request for readings as 4th course in either of the next 2 semesters and start your OPT from next Summer.";
    } elseif ($prereq == 'YES' && ($course == 'CIS' || $course == 'BDA') && $semester == 'Summer') {
        $message = "As you have a prerequisite and you started your Master's in Summer, if you take 3 courses in 1st semester and request for a 4th course in either of the next 2 semesters and start your CPT from next Summer.";
    } elseif ($prereq == 'NO' && $course == 'CS' && $semester == 'Fall') {
        $message = "As you don't have a prerequisite and you started your Master's in Fall, you take 3 courses in each semester and start your CPT from next Fall. Or you can request for 4th course in either of the next 2 semesters and start your OPT from next Fall.";
    } elseif ($prereq == 'YES' && $course == 'CS' && $semester == 'Fall') {
        $message = "As you have a prerequisite and you started your Master's in Fall, if you take 3 courses in 1st semester and request for a 4th course in either of the next 2 semesters and start your CPT from next Fall.";
    } elseif ($prereq == 'NO' && $course == 'CS' && $semester == 'Spring') {
        $message = "As you don't have a prerequisite and you started your Master's in Spring, if you take 3 courses in each semester and start your CPT from next Spring. Or you can request for  4th course in either of the next 2 semesters and start your OPT from next Spring.";
    } elseif ($prereq == 'YES' && $course == 'CS' && $semester == 'Spring') {
        $message = "As you have a prerequisite and you started your Master's in Spring, if you take 3 courses in 1st semester and request for a 4th course in either of the next 2 semesters and start your CPT from next Spring.";
    } elseif ($prereq == 'NO' && $course == 'CS' && $semester == 'Summer') {
        $message = "As you don't have a prerequisite and you started your Master's in Summer, if you take 3 courses in each semester and start your CPT from next Summer. Or you can request for     4th course in either of the next 2 semesters and start your OPT from next Summer.";
    } elseif ($prereq == 'YES' && $course == 'CS' && $semester == 'Summer') {
        $message = "As you have a prerequisite and you started your Master's in Summer, if you take 3 courses in 1st semester and request for a 4th course in either of the next 2 semesters and start your CPT from next Summer.";
    } else {
        $message = "Please select valid options.";
    }
}
?>

<div class="container">
    <form method="post" action="Academic_suggestion.php">
        <?php
        $Prereqarray = array("YES", "NO");
        $Coursearray = array("CS", "CIS", "BDA");
        $semesterarray = array("Fall", "Spring", "Summer");
        ?>
        <p>
            <label for="Prereq">Select Prerequisite:</label>
            <select name="selectPrereq" id="Prereq">
                <?php
                foreach ($Prereqarray as $index => $value) {
                    echo '<option value="' . $value . '"' . (isset($_POST['selectPrereq']) && $_POST['selectPrereq'] == $value ? ' selected' : '') . '>' . $value . '</option>';
                }
                ?>
            </select>
        </p><br>
        <p>
            <label for="Course">Select Course:</label>
            <select name="selectCourse" id="Course">
                <?php
                foreach ($Coursearray as $index => $value) {
                    echo '<option value="' . $value . '"' . (isset($_POST['selectCourse']) && $_POST['selectCourse'] == $value ? ' selected' : '') . '>' . $value . '</option>';
                }
                ?>
            </select>
        </p><br>
        <p>
            <label for="Semester">Select Semester:</label>
            <select name="selectSemester" id="Semester">
                <?php
                foreach ($semesterarray as $index => $value) {
                    echo '<option value="' . $value . '"' . (isset($_POST['selectSemester']) && $_POST['selectSemester'] == $value ? ' selected' : '') . '>' . $value . '</option>';
                }
                ?>
            </select>
        </p><br>
        <p><input type="submit" name="Submit" value="Submit"></p>
    </form>

    <?php
    if (isset($message)) {
        echo '<p>' . $message . '</p>';
    }
    ?>
</div>

<footer>
    <p>&copy; 2024 UCM Student Hub. All rights reserved.</p>
</footer>
</body>
</html>
