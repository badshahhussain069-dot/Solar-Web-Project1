
<?php
include 'config.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$system_size = $_POST['system_size'];

$sql = "INSERT INTO bookings(name,email,phone,city,system_size)
VALUES('$name','$email','$phone','$city','$system_size')";

if(mysqli_query($conn, $sql)){
    echo "<h1>Booking Submitted Successfully!</h1>";
    echo "<a href='index.php'>Go Back</a>";
} else {
    echo mysqli_error($conn);
}
?>
