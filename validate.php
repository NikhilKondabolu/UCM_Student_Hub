<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Include the business tier class
    include_once("Inc_businessTierClass.php");

    // Instantiate the business tier class
    $businessTier = new BusinessTierClass();

    $response = array();

    // Check if the request is for username validation
    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);
        $result = $businessTier->validateUsername($username);
        if ($result !== true) {
            $response['username'] = $result;
        } else {
            $response['username'] = '';
        }
    }

    // Check if the request is for phone validation
    if (isset($_POST['phone'])) {
        $phone = trim($_POST['phone']);
        $result = $businessTier->validatePhone($phone);
        if ($result !== true) {
            $response['phone'] = $result;
        } else {
            $response['phone'] = '';
        }
    }

    // Output the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(array("error" => $e->getMessage()));
}
?>
