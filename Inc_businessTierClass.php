<?php
/*
* Business Logic Class
*/

class BusinessTierClass
{
    private $db;

    public function __construct()
    {
        include_once("inc_databaseClass.php");
        $this->db = new DatabaseClass();
    }

    public function getAllHistory($username)
    {
        $sql = "
            SELECT 
                l1.location AS pickup_location,
                l2.location AS dropoff_location,
                r.[datetime], r.RideType as ride_type,
                r.[seats] AS 'Seats/Weight',
                r.[price],r.RideId as ID
            FROM 
                [Rides] r inner join Users u ON r.UserId=u.UserId
            INNER JOIN 
                [Locations] l1 ON r.PickupLocationId = l1.locationid
            INNER JOIN 
                [Locations] l2 ON r.DropoffLocationId = l2.locationid 
            WHERE 
                u.[Username] = ?
            UNION
            SELECT 
                l1.location AS pickup_location,
                l2.location AS dropoff_location,
                c.[date] AS [datetime],
                'Courier' AS ride_type,
                c.weight AS 'Seats/Weight',
                c.price,c.CourierId as ID
            FROM 
                [Couriers] c inner join Users u ON c.UserId=u.UserId
            INNER JOIN 
                [Locations] l1 ON c.PickupLocationId = l1.locationid
            INNER JOIN 
                [Locations] l2 ON c.DropoffLocationId = l2.locationid 
            WHERE 
                u.[Username] = ?
        ";
        $params = array($username, $username);
        return $this->db->executeQuery($sql, $params);
    }

    public function getAllLocations()
    {
        $sql = "SELECT locationid, location FROM Locations";
        $stmt = $this->db->executeQuery($sql);
        return $stmt;
    }
    
    public function getAllLocations1()
    {
        $sql = "SELECT locationid, location, latitude, longitude FROM Locations";
        $stmt = $this->db->executeQuery($sql);
        return $stmt;
    }

    public function addCourierRequest($username, $item_type, $weight, $pickup_location, $dropoff_location, $date, $price)
    {
        $sql = "INSERT INTO Couriers (UserId, ItemType, Weight, PickupLocationId, DropoffLocationId, Date, Price) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = array("1", $item_type, $weight, $pickup_location, $dropoff_location, $date, $price);
        $stmt = $this->db->executeNonQuery($sql, $params);
        return $stmt;
    }

    public function addRide($username, $rideType, $pickup_location, $dropoff_location, $date, $available_seats, $price)
    {
        $sql = "INSERT INTO Rides (RideType, UserId, PickupLocationId, DropoffLocationId, DateTime, Seats, Price) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = array($rideType, $username, $pickup_location, $dropoff_location, $date, $available_seats, $price);
        $stmt = $this->db->executeNonQuery($sql, $params);
        return $stmt;
    }

    public function getLocationById($locationid)
    {
        $sql = "SELECT locationid, location, latitude, longitude FROM Locations WHERE locationid = ?";
        $params = array($locationid);
        $result = $this->db->executeQuery($sql, $params);
        return sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
    }

    public function updateLocation($locationid, $location, $latitude, $longitude)
    {
        $sql = "UPDATE Locations SET location = ?, latitude = ?, longitude = ? WHERE locationid = ?";
        $params = array($location, $latitude, $longitude, $locationid);
        try {
            $this->db->executeNonQuery($sql, $params);
            return true;
        } catch (Exception $e) {
            echo "Error updating record: " . $e->getMessage();
            return false;
        }
    }

    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM Users WHERE Username = ?";
        $params = array($username);
        $stmt = $this->db->executeQuery($sql, $params);
        return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    }

    public function updateUser($username, $password, $phone, $dob, $address)
    {
        $sql = "UPDATE Users SET Password = ?, Phone = ?, DOB = ?, Address = ? WHERE Username = ?";
        $params = array($password, $phone, $dob, $address, $username);
        try {
            $this->db->executeNonQuery($sql, $params);
            return true;
        } catch (Exception $e) {
            echo "Error updating user: " . $e->getMessage();
            return false;
        }
    }

    public function fetchRides()
    {
        $sql = "SELECT r.rideid, r.RideType, l1.location AS from_location,
                l2.location AS to_location, u.Phone AS Contact,
                FORMAT(r.[datetime], 'yyyy-MM-ddTHH:mm:ss') AS start,
                'Ride' AS type FROM Rides r
            INNER JOIN Users u ON r.UserId = u.UserId
            INNER JOIN Locations l1 ON r.PickupLocationId = l1.locationid
            INNER JOIN Locations l2 ON r.DropoffLocationId = l2.locationid";
        $stmt = $this->db->executeQuery($sql);
        return $stmt;
    }

    public function fetchCouriers()
    {
        $sql = "SELECT c.CourierId, l1.location AS from_location, u.Phone AS Contact,
                l2.location AS to_location, FORMAT(c.[date], 'yyyy-MM-ddTHH:mm:ss') AS start,
                'Courier' AS type FROM Couriers c
            INNER JOIN Users u ON c.UserId = u.UserId
            INNER JOIN Locations l1 ON c.PickupLocationId = l1.locationid
            INNER JOIN Locations l2 ON c.DropoffLocationId = l2.locationid";
        $stmt = $this->db->executeQuery($sql);
        return $stmt;
    }

    // Fetch all locations
    public function fetchLocations()
    {
        $sql = "SELECT * FROM Locations";
        $stmt = $this->db->executeQuery($sql);
        return $stmt;
    }

    // Insert a new location
    public function insertLocation($location, $latitude, $longitude, $added_by)
    {
        $sql = "INSERT INTO Locations (Location, Latitude, Longitude, AddedByUserId) VALUES (?, ?, ?, ?)";
        $params = array($location, $latitude, $longitude, $added_by);
        $stmt = $this->db->executeNonQuery($sql, $params);
        return $stmt;
    }

    // Delete a location
    public function deleteLocation($locationid)
    {
        $sql = "DELETE FROM Locations WHERE locationid = ?";
        $params = array($locationid);
        $stmt = $this->db->executeNonQuery($sql, $params);
        return $stmt;
    }

    // Fetch all users
    public function fetchUsers()
    {
        $sql = "SELECT * FROM Users";
        $stmt = $this->db->executeQuery($sql);
        return $stmt;
    }

    // Add a new user
    public function addUser($username, $password, $phone, $DOB, $address)
    {
        // Check if the username already exists
        $checkSql = "SELECT * FROM Users WHERE Username = ?";
        $params = array($username);
        $checkStmt = $this->db->executeQuery($checkSql, $params);

        if (sqlsrv_has_rows($checkStmt)) {
            return "Username already exists. Please choose a different username.";
        }

        // insertion
        $sql = "INSERT INTO Users (Username, Password, Phone, DOB, Address) VALUES (?, ?, ?, ?, ?)";
        $params = array($username, $password, $phone, $DOB, $address);
        $stmt = $this->db->executeNonQuery($sql, $params);
        return $stmt;
    }

    // Delete a user
    public function deleteUser($username)
    {
        $sql = "DELETE FROM Users WHERE Username = ?";
        $params = array($username);
        $stmt = $this->db->executeNonQuery($sql, $params);
        return $stmt;
    }

    // Method to validate username
    public function validateUsername($username)
    {
        $sql = "SELECT Username FROM Users WHERE Username = ?";
        $params = array($username);
        $stmt = $this->db->executeQuery($sql, $params);
        if (sqlsrv_has_rows($stmt)) {
            return "This username is already taken.";
        }
        return null; // No error
    }

    // Method to validate phone
    public function validatePhone($phone)
    {
        $sql = "SELECT Phone FROM Users WHERE Phone = ?";
        $params = array($phone);
        $stmt = $this->db->executeQuery($sql, $params);
        if ($stmt === false) {
            return "Error executing query.";
        }
    
        // Fetch the result
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if ($row) {
            return "This phone number is already taken.";
        }
        return null; // No error
    }

    // Method to register a new user
    public function registerUser($username, $password, $phone, $dob, $address)
    {
        // Validate username
        $username_err = $this->validateUsername($username);
        if ($username_err) {
            return $username_err; // Return the error message if username is taken
        }

        // Validate phone
        $phone_err = $this->validatePhone($phone);
        if ($phone_err) {
            return $phone_err; // Return the error message if phone is taken
        }

        // Prepare insert statement
        $sql = "INSERT INTO Users (Username, Password, Phone, DOB, Address) VALUES (?, ?, ?, ?, ?)";
        $params = array($username, password_hash($password, PASSWORD_DEFAULT), $phone, $dob, $address);
        $result = $this->db->executeNonQuery($sql, $params);

        return $result ? true : "Failed to register the user.";
    }

    // validate user credentials
    public function validateUser($username, $password)
    {
        // Prepare and execute query
        $sql = "SELECT Username, Password FROM Users WHERE Username = ?";
        $params = array($username);
        $stmt = $this->db->executeQuery($sql, $params);

        if ($stmt) {
            if (sqlsrv_has_rows($stmt)) {
                if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $hashed_password = $row["Password"];
                    if (password_verify($password, $hashed_password)) {
                        return $row["Username"];
                    }
                }
            }
        }
        return false;
    }
    public function getAverageRating() {
        $sql = "SELECT AVG(CAST(Rating AS FLOAT)) as AverageRating FROM Feedback";
        $stmt = $this->db->executeQuery($sql);
    
        if ($stmt === false) {
            return null;
        }
    
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        sqlsrv_free_stmt($stmt);
    
        return $row ? round($row['AverageRating'], 1) : 0;
    }
    public function addFeedback($name, $email, $feedback_type, $comments, $new_location_suggestion, $feature_enhancements, $rating, $username) {
        $sql = "INSERT INTO Feedback (Name, Email, FeedbackType, Comments, NewLocationSuggestion, FeatureEnhancements, Rating, Username) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $params = array($name, $email, $feedback_type, $comments, $new_location_suggestion, $feature_enhancements, $rating, $username);
    
        return $this->db->executeNonQuery($sql, $params);
    }
    //Delete ride while cancelling
    public function deleteRideOrCourier($rideId, $rideType)
{
    if ($rideType === 'Courier') {
        // If the type is 'Courier', delete from Couriers table
        $sqlDeleteCourier = "
            DELETE FROM 
                [Couriers] 
            WHERE 
                [CourierId] = ?
        ";
        $params = array($rideId);
        $result = $this->db->executeNonQuery($sqlDeleteCourier, $params);
        return $result ? true : false;
    } else {
        // If the type is 'Ride', delete from Rides table
        $sqlDeleteRide = "
            DELETE FROM 
                [Rides] 
            WHERE 
                [RideId] = ?
        ";
        $params = array($rideId);
        $result = $this->db->executeNonQuery($sqlDeleteRide, $params);
        return $result ? true : false;
    }
}

        
}
