<?php
/**
 * Created by PhpStorm.
 * User: dom
 * Date: 3/31/15
 * Time: 9:10 PM
 */

$name = isset($_GET['name']) ? $_GET['name'] : '';
$attendance = isset($_GET['attendance']) ? $_GET['attendance'] : '';
$booking = isset($_GET['booking']) ? $_GET['booking'] : '';

$attendanceString = "";
$bookingString = "";

if ($attendance == 1) {
    $attendanceString = "Happily Accept";
} elseif ($attendance == 2) {
    $attendanceString = "Regretfully Decline";
} elseif ($attendance == 3) {
    $attendanceString = "Decide in near future";
}


if ($booking == 1) {
    $bookingString = "Apple Vacations";
} elseif ($booking == 2) {
    $bookingString = "My own travel agent";
}


$msg = "
    <p>name: $name</p>
    <p>attendance: $attendanceString</p>
    <p>booking: $bookingString</p>
";

mail("jaclynmarie.mclean@gmail.com,scandinaro@gmail.com", "Wedding RSVP", $msg);