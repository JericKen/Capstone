<?php
include '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$result = $conn->query("SELECT * FROM bookings WHERE client_id = $id AND status = 'confirmed'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr><th>Destination</th><th>Date of Tour</th><th>End of Tour</th><th>Total Cost</th></tr>
        </thead>
        <tbody>    
            <?php while ($booking = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $booking['destination'] ?></td>
                    <td><?php echo $booking['date_of_tour'] ?></td>
                    <td><?php echo $booking['end_of_tour'] ?></td>
                    <td><?php echo $booking['total_cost'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>