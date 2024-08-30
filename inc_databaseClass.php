<?php
/*
* Database Class
* Created by Kondabolu
*/

class DatabaseClass
{
    public $conn;
    
    public function executeQuery($sql, $params = [])
    {
        include("dbConfig.php");
        global $conn;
        $conn = sqlsrv_connect($serverName, $connectionOptions);
        if ($conn === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        $stmt = sqlsrv_query($conn, $sql, $params);
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        //$conn = null;
        return $stmt;
    }

    public function executeNonQuery($sql, $params = []) {
        include("dbConfig.php");
        $this->conn = sqlsrv_connect($serverName, $connectionOptions);
        if (empty($params)) {
            $stmt = sqlsrv_query($this->conn, $sql);
        } else {
            $stmt = sqlsrv_prepare($this->conn, $sql, $params);
        }

        if ($stmt === false) {
            $error = 'Failed to prepare statement: ' . print_r(sqlsrv_errors(), true);
            $this->logError($error);
            throw new Exception($error);
        }

        if (!sqlsrv_execute($stmt)) {
            $error = 'Failed to execute statement: ' . print_r(sqlsrv_errors(), true);
            $this->logError($error);
            throw new Exception($error);
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($this->conn);
        return true;
    }

    private function logError($error) {
        // Implement your logging mechanism here
        error_log($error);
    }

}
