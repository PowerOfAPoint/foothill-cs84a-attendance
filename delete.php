<?php

$DEBUG = false;
if ($DEBUG) {
    ini_set('display_errors', 'on');
    error_reporting(E_ALL);
}

require_once 'db/conn.php';

if (!$_GET["id"]) {
    // echo "<h1 class='text-danger'>Cannot find attendee id. Please check details and try again.</h1>";
    include "includes/errormessage.php";
    header("Location: viewrecords.php");
} else {
    $id = $_GET["id"];
    $result = $crud->deleteAttendee($id);

    if ($result) {
        header("Location: viewrecords.php");
    } else {
        // echo '<h1 class="text-center text-danger">There was an error in deleting.</h1>';
        include "includes/errormessage.php";
    }
}
