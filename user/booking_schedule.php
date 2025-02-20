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
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="booking_schedule.css">
</head>
<body>
    <p class="head">Confirmed Booking</p>
    <table>
        <thead>
            <tr><th>Destination</th><th>Date of Tour</th><th>End of Tour</th><th>Total Cost</th><th colspan="2">Payment</th></tr>
        </thead>
        <tbody>    
            <?php while ($booking = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $booking['destination'] ?></td>
                    <td><?php echo $booking['date_of_tour'] ?></td>
                    <td><?php echo $booking['end_of_tour'] ?></td>
                    <td><p class="total-cost"><?php echo $booking['total_cost'] ?></p></td>
                    <td><p class="full-payment" data-cost="<?php echo $booking['total_cost']?>">Full</p></td>
                    <td><p class="partial-payment" data-cost="<?php echo $booking['total_cost']?>">Partial</p></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div>Amount: <span class="amount"></span></div>

    <script src="booking_schedule.js"></script>
</body>
</html>