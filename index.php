<?php
$servername = "md412.wedos.net";
$username = "a369235_shorter";
$password = "Qwsw9KEU";
$dbname = "d369235_shorter";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the short URL key from the query parameter
$shortUrlKey = $_GET['key'] ?? '';

if (!empty($shortUrlKey)) {
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT long_url FROM url_store WHERE short_url_key = ?");
    $stmt->bind_param("s", $shortUrlKey);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($longUrl);
        $stmt->fetch();
        header("Location: " . $longUrl);
        exit();
    } else {
        echo "URL not found";
    }
    $stmt->close();
} else {
    echo "Invalid short URL key";
}

$conn->close();
?>
