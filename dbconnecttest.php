<?php
$servername = "dtemdm01.mysql.database.azure.com";
$username = "temappuser@dtemdm01";
$password = "waheguru@1112";

try {
    $conn = new PDO("mysql:host=$servername;dbname=dbtemd01", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>