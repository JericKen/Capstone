<?php
include '../config.php';

if (isset($_GET['booking_id']) && isset($_GET['total_cost'])) {
    $id = $_GET['booking_id'];
    $total_cost = $_GET['total_cost'];
}

$confirmed = 'confirmed';

$stmt = $conn->prepare('UPDATE bookings SET status = ?, total_cost = ? WHERE booking_id = ?');
$stmt->bind_param('sdi', $confirmed, $total_cost, $id);

if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
}

header("Location: admin_dashboard.php");
exit();
?>