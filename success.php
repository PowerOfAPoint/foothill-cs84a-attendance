<?php
$DEBUG = false;
if ($DEBUG) {
    ini_set('display_errors', 'on');
    error_reporting(E_ALL);
}

$title = 'Success';
require_once 'includes/header.php';
require_once 'db/conn.php';

$submit_btn_data = $_POST['submit'];
if ($DEBUG) {
    echo '<h1 class="text-center text-success">In success.php the submit button data is: ' . $submit_btn_data . '.</h1>';
}
if (isset($submit_btn_data)) {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $specialty = $_POST['specialty'];
    $institution = $_POST['institution'];

    $isSuccess = $crud->insertAttendees($fname, $lname, $dob, $email, $phone, $specialty, $institution);

    if ($isSuccess) {
        // echo '<h1 class="text-center text-success">You Have Been Registered!</h1>';
        include "includes/successmessage.php";
    } else {
        // echo '<h1 class="text-center text-danger">There was an error in processing.</h1>';
        include "includes/errormessage.php";
    }
} else {
    // echo '<h1 class="text-center text-danger">There was an error in processing.</h1>';
    include "includes/errormessage.php";
    header("Location: viewrecords.php");
}
?>

<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">
            <?php
                echo $_POST['firstname'] . " " . $_POST['lastname'];
            ?>
        </h5>
        <h6 class="card-subtitle mb-2 text-body-secondary">
            <?php
            echo "specialty_id: " . $_POST['specialty'] . "<br>";
            echo "institution_id: " . $_POST['institution'];
            ?>
        </h6>
        <p class="card-text">Date Of Birth:
            <?php
            echo $_POST['dob'];
            ?>
        </p>
        <p class="card-text">Email Address:
            <?php
            echo $_POST['email'];
            ?>
        </p>
        <p class="card-text">Contact Number:
            <?php
            echo $_POST['phone'];
            ?>
        </p>
    </div>
</div>
<?php require_once 'includes/footer.php'; ?>