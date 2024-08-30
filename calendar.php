<?php
// Start the session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is not logged in, if not then redirect them to the login page
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
    <title>Rides and Couriers Calendar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.4/main.min.css" rel="stylesheet">
    <link rel="stylesheet" href="StyleSheet.css">
    <style>
        .container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 20px;
        }
        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        #calendar {
            max-width: 1600px;
            margin: 0 auto;
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
    <a href="courier.php" class="courier"><span>Courier Service</span></a>
    <a href="Expenses.php" class="expenses"><span>Expense Calculator</span></a>
    <a href="CarExpenses.php" class="carmaintenance"><span>Car Maintenance Calculator</span></a>     
    <a href="logout.php">Logout</a>
</nav>
<div class="container">
    <h1>Rides and Couriers Calendar (Click to Book)</h1>
    <div id="calendar"></div>
</div>


<!-- Load FullCalendar scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.4/main.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.4/locales-all.min.js"></script>

<!-- Calendar script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: 'fetch_events.php',
        eventDidMount: function(info) {
            // Set color based on event type
            if (info.event.extendedProps.type === 'Ride') {
                info.el.style.backgroundColor = 'blue';
                info.el.style.borderColor = 'blue';
            } else if (info.event.extendedProps.type === 'Courier') {
                info.el.style.backgroundColor = 'green';
                info.el.style.borderColor = 'green';
            }
        },
        eventContent: function(arg) {
            let italicEl = document.createElement('span');
            italicEl.innerHTML = arg.event.extendedProps.type.charAt(0).toUpperCase() + arg.event.extendedProps.type.slice(1);
            let arrayOfDomNodes = [italicEl];
            return { domNodes: arrayOfDomNodes };
        },
        eventClick: function(info) {
            alert('Type: ' + info.event.extendedProps.type + '\nFrom: ' + info.event.extendedProps.from_location + '\nTo: ' + info.event.extendedProps.to_location + '\nContact: ' + info.event.extendedProps.Contact);
        }
    });

    calendar.render();
});
</script>
</body>
</html>
