<?php

$DEBUG = false;
if ($DEBUG) {
    ini_set('display_errors', 'on');
    error_reporting(E_ALL);
}

require_once 'db/conn.php';

$submit_btn_data = $_POST['submit'];

if (isset($submit_btn_data)) {
    $attendee_id = $_POST['id'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $specialty = $_POST['specialty'];
    $institution = $_POST['institution'];

    $isSuccess = $crud->updateAttendee($attendee_id, $fname, $lname, $dob, $email, $phone, $specialty, $institution);

    if ($isSuccess) {
        header("Location: viewrecords.php");
    } else {
        // echo '<h1 class="text-center text-danger">There was an error in updating.</h1>';
        include "includes/errormessage.php";
    }
} else {
    // echo '<h1 class="text-center text-danger">There was an error in processing.</h1>';
    include "includes/errormessage.php";
    header("Location: viewrecords.php");
}
