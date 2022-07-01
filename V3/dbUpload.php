<?php 
//The admin name and password are handled by siteground. DB name doensn't enclude labels.
$serverName = "localhost";
$dbAdminName = "root";
$dbAdminPassword = "";
$dbName = "dbkcvnjkmbk2du";
$dbConnection = mysqli_connect($serverName, $dbAdminName, $dbAdminPassword, $dbName);
mysqli_set_charset($dbConnection, 'utf8mb4');


if( $dbConnection->connect_error ){
    die("The connection with the database failed: " . $dbConnection->connect_error );
}




 ?>