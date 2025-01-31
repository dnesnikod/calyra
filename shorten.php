<?php
$servername = "servername";
$username = "username";
$password = "password";
$dbname = "dbname";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $longUrl = $conn->real_escape_string($_POST["longUrl"]);
    $alias = $conn->real_escape_string($_POST["alias"]);

    if (empty($alias)) {
        $shortUrlKey = substr(md5(time() . rand()), 0, 6); // Generate a 6-character random string
    } else {
        // Ensure custom alias does not already exist
        $sqlCheck = "SELECT long_url FROM url_store WHERE short_url_key = '$alias'";
        $resultCheck = $conn->query($sqlCheck);
        if ($resultCheck->num_rows > 0) {
            echo "Error: Alias already in use.";
            exit();
        }
        $shortUrlKey = $alias;
    }

    $sql = "INSERT INTO url_store (short_url_key, long_url) VALUES ('$shortUrlKey', '$longUrl')";
    if ($conn->query($sql) === TRUE) {
        $shortUrl = "https://calyra.karelbara.cz/" . $shortUrlKey;
        echo $shortUrl;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
