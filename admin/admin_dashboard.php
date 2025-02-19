<?php
include '../config.php';

$result = $conn->query("SELECT * FROM bookings WHERE status = 'pending'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
    <title>Document</title>
</head>
<body class="center-column">
    <p>Booking Requests</p>
    <table class="container">
        <thead>
            <tr>
                <th>Date of Tour</th>
                <th>Destination</th>
                <th>Pick-up Point</th>
                <th>Number of Days</th>
                <th>Number of Buses</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($booking = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($booking['date_of_tour']); ?></td>
                    <td><?php echo htmlspecialchars($booking['destination']); ?></td>
                    <td><?php echo htmlspecialchars($booking['pickup_point']); ?></td>
                    <td><?php echo htmlspecialchars($booking['number_of_days']); ?></td>
                    <td><?php echo htmlspecialchars($booking['number_of_buses']); ?></td>
                    <td><a href="#" class="btnConfirm" 
                            data-buses="<?php echo $booking['number_of_buses']; ?>" 
                            data-days="<?php echo $booking['number_of_days']; ?>"
                            data-id="<?php echo $booking['booking_id']; ?>">Confirm</a></td>
                    <td><a href="#">Decline</a></td>
                </tr>
            <?php endwhile;?>
        </tbody>
    </table>

    <div class="payment-calculator center-row">
        <form action="confirm_booking.php" id="formCalculator" method="GET">
            <label for="">Distance (KM)</label>
            <input type="number" name="distance" id="distance">

            <label for="">Diesel Price</label>
            <input type="number" step="0.01" name="diesel" id="diesel">
        
            <label for="">Toll Fees</label>
            <input type="number" name="number_of_buses" id="tollFees">
        
            <label for="">Number of buses</label>
            <input type="number" name="number_of_buses" id="numberOfBus">
        
            <label for="">Number of days</label>
            <input type="number" name="number_of_days" id="numberOfDays">
        
            <input type="hidden" name="booking_id" id="bookingID">
            <input type="hidden" name="total_cost" id="totalFees">

            <div>
                Total Cost: <span id="totalCost">₱0.00</span>
            </div>

            <div class="buttons">
                <button type="button" id="getTotalCost">Compute</button>
                <button type="submit" id="confirm">Confirm</button>
                <button type="button" id="cancel">Cancel</button>
            </div>
        </form>


    </div>
    
    <script src="admin_script.js"></script>
</body>
</html>