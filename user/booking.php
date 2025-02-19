<?php
include '../config.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $dateOfTour = $_POST['date_of_tour'];
    $destination = $_POST['destination'];
    $pickupPoint = $_POST['pickup_point'];
    $numberOfDays = $_POST['number_of_days'];
    $numberOfBuses = $_POST['number_of_buses'];

    $endOfTour = new DateTime($dateOfTour);
    $endOfTour->add(new DateInterval("P{$numberOfDays}D"));
    $stringDate = $endOfTour->format("Y-m-d");

    $stmt = $conn->prepare("INSERT INTO bookings (date_of_tour, end_of_tour, destination, pickup_point, number_of_days, number_of_buses, client_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiii", $dateOfTour, $stringDate, $destination, $pickupPoint, $numberOfDays, $numberOfBuses, $id);
    
    if ($stmt->execute()) {
        header("Location: booking.php");
        exit();
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();

    if (isset($_GET['success'])) {
        $message = "Booking request submitted successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

    <div class="header">
        <a href="#">My Past Trips</a>
        <a href="booking_schedule.php?id=1">My Schedule</a>
    </div>
    
    <div class="container center-column">
        <p>Request a Quote</p>
        <form action="" method="POST" class="center-row">
            <input type="hidden" name="id" value="1">
            <div class="input">
                <label for="date_of_tour">Date of Tour:</label>
                <input type="date" name="date_of_tour" id="date_of_tour" required>
            </div>
            <div class="input">
                <label for="destination">Destination</label>
                <input type="text" name="destination" id="destination" required>
            </div>
            <div class="input">
                <label for="pickup_point">Pick-up point</label>
                <input type="text" name="pickup_point" id="pickup_point" required>
            </div>
            <div class="input">
                <label for="number_of_days">Number of days</label>
                <input type="text" name="number_of_days" id="number_of_days" required>
            </div>
            <div class="input">
                <label for="number_of_buses">Number of buses</label>
                <input type="text" name="number_of_buses" id="number_of_buses" required>
            </div>

            <button type="submit">Book</button>
        </form>

        
    </div>

</body>
</html>