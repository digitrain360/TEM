<?php
$servername = "dtemdm01.mysql.database.azure.com";
$username = "temdbmadm@dtemdm01";
$password = "waheguru@1112";
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::MYSQL_ATTR_SSL_CA => '/SSL/BaltimoreCyberTrustRoot.crt',
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
);

try {
    $conn = new PDO("mysql:host=$servername;port=3306;dbname=dtemdb01", $username, $password, $options);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    var_dump($conn->query("SHOW STATUS LIKE 'Ssl_cipher';")->fetchAll());
    $conn = null;
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
?>