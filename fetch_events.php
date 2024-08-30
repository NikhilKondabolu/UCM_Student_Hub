<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Include the business tier class
include_once("inc_businessTierClass.php");

// Instantiate the business tier class
$businessTier = new BusinessTierClass();

try {
    // Fetch rides
    $stmt_rides = $businessTier->fetchRides();
    $events = [];

    if ($stmt_rides) {
        while ($row = sqlsrv_fetch_array($stmt_rides, SQLSRV_FETCH_ASSOC)) {
            $events[] = $row;
        }
        sqlsrv_free_stmt($stmt_rides);
    } else {
        throw new Exception("Error fetching rides: " . print_r(sqlsrv_errors(), true));
    }

    // Fetch courier requests
    $stmt_couriers = $businessTier->fetchCouriers();

    if ($stmt_couriers) {
        while ($row = sqlsrv_fetch_array($stmt_couriers, SQLSRV_FETCH_ASSOC)) {
            $events[] = $row;
        }
        sqlsrv_free_stmt($stmt_couriers);
    } else {
        throw new Exception("Error fetching couriers: " . print_r(sqlsrv_errors(), true));
    }

    // Format events
    foreach ($events as &$event) {
        if (isset($event['start'])) {
            $dateString = $event['start'];
            $date = new DateTime($dateString);
            $event['start'] = $date->format('Y-m-d\TH:i:s');
        }
    }

    // Output JSON formatted events
    header('Content-Type: application/json');
    echo json_encode($events);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
