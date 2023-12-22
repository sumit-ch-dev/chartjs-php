<?php
// Database connection parameters
$servername = "localhost:3306";
$username = "summy";
$password = "Password@1234#";
$database = "demo_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM weather_data ORDER BY recorded_at DESC LIMIT 15";
$result = $conn->query($sql);

$sql2 = "SELECT * FROM temperature_data LIMIT 12";
$result2 = $conn->query($sql2);

$sql3 = "SELECT * FROM humidity_data LIMIT 12";
$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
    $labels3 = [];
    $humidityData3 = [];
    while ($row3 = $result3->fetch_assoc()) {
        $labels3[] = $row3["month"];
        $humidityData3[] = $row3["humidity"];
    }
} else {
    echo "No humidity data found.";
}

// print result2 at the console
// print_r($result2);

if ($result2->num_rows > 0) {
    $labels2 = [];
    $temperatureData2 = [];
    while ($row2 = $result2->fetch_assoc()) {
        $labels2[] = $row2["month"];
        $temperatureData2[] = $row2["temperature"];
    }
} else {
    echo "No temperature data found.";
}

if ($result->num_rows > 0) {
    // Prepare data for Chart.js
    $labels = [];
    $temperatureData = [];
    $humidityData = [];

    while ($row = $result->fetch_assoc()) {
        $labels[] = $row["recorded_at"];
        $temperatureData[] = $row["temperature"];
        $humidityData[] = $row["humidity"];
    }
} else {
    echo "No weather data found.";
}
$conn->close();
