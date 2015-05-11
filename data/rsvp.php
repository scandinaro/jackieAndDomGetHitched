<?php
/**
 * Created by PhpStorm.
 * User: dom
 * Date: 3/31/15
 * Time: 9:10 PM
 */

require_once '/usr/share/php/aws/credentials.php';
require 'includes/aws/aws-autoloader.php';

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
    <p>Name: $name</p>
    <p>Attendance: $attendanceString</p>
    <p>Booking Method: $bookingString</p>
";

use Aws\Ses\SesClient;

$client = SesClient::factory(array(
    'key'    => AWS_KEY,
    'secret' => AWS_SECRET,
    'region' => 'us-east-1'
));

$emailSentId = $client->sendEmail(array(
    // Source is required
    'Source' => 'scandinaro@gmail.com',
    // Destination is required
    'Destination' => array(
        'ToAddresses' => array(
            'scandinaro@gmail.com',
            'jaclynmarie.mclean@gmail.com'
        )
    ),
    // Message is required
    'Message' => array(
        // Subject is required
        'Subject' => array(
            // Data is required
            'Data' => 'Wedding RSVP',
            'Charset' => 'UTF-8',
        ),
        // Body is required
        'Body' => array(
            'Text' => array(
                // Data is required
                'Data' => strip_tags($msg),
                'Charset' => 'UTF-8',
            ),
            'Html' => array(
                // Data is required
                'Data' => $msg,
                'Charset' => 'UTF-8',
            ),
        ),
    ),
    'ReplyToAddresses' => array('scandinaro@gmail.com'),
    'ReturnPath' => 'scandinaro@gmail.com'
));
