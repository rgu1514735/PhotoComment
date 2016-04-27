<?php
define('DB_SERVER', 'us-cdbr-azure-west-c.cloudapp.net');
define('DB_USERNAME', 'b6934f47b40a4f');
define('DB_PASSWORD', 'c5573120');
define('DB_DATABASE', 'acsm_e5a83a0f62d38b4');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

?>
