<?php
$DEBUG = false;
if ($DEBUG) {
    ini_set('display_errors', 'on');
    error_reporting(E_ALL);
}

$title = 'View Record';
require_once 'includes/header.php';
require_once 'db/conn.php';

if (!isset($_GET["id"])) {
    echo "<h1 class='text-danger'>Cannot find attendee id. Please check details and try again.</h1>";
} else {
    $result = $crud->getAttendeeDetails($_GET["id"]);

    if ($DEBUG) {
        foreach (array_keys($result) as $c) {
            echo "$c ";
        }
    }

    ?>

<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">
            <?php echo $result['firstname'] . " " . $result['lastname']; ?>
        </h5>
        <p class="card-text">
            <?php echo "Specialty: " . $result['specialty_name']; ?>
        </p>
        <p class="card-text">
            <?php echo "Institution: " . $result['institution_name']; ?>
        </p>
        <p class="card-text">Date Of Birth:
            <?php echo $result['dob']; ?>
        </p>
        <p class="card-text">Email Address:
            <?php echo $result['email']; ?>
        </p>
        <p class="card-text">Contact Number:
            <?php echo $result['phone']; ?>
        </p>
    </div>
</div>
<br>
<div>
    <a href="viewrecords.php" class="btn btn-info">Back to records</a>
    <a href="edit.php?id=<?php echo $result["attendee_id"]; ?>" class="btn btn-warning">Edit</a>
    <a onclick="return confirm('Are you sure you want to delete this record?');" href="delete.php?id=<?php echo $result["attendee_id"]; ?>" class="btn btn-danger">Delete</a>
</div>

<?php }

require_once 'includes/footer.php';
?>