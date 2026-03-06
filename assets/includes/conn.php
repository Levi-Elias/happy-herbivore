<?php
// $servername = "localhost";
// $dbname = "kiosk";
// $username = "root";
// $password = "";

$servername = "localhost";
$dbname = "u240669_kiosk";
$username = "u240669_kiosk";
$password = "DeHQpF5p9KQgrPph7zgj";


try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>