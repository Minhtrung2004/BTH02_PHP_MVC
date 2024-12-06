
<?php
function connectionDatabase($severname, $username, $password, $dbname)
{
    try {
        $conn = new PDO("mysql:host=$severname; dbname = $dbname", $username . $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("NULL" . $e->getMessage());
    }
}

$severname = "localhost";
$username = "root";
$password = "";
$dbname = "";

$conn = connectionDatabase($severname, $username, $password, $dbname);
$conn = null;
?>
