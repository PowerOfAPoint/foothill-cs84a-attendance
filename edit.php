<?php
$DEBUG = false;
if ($DEBUG) {
    ini_set('display_errors', 'on');
    error_reporting(E_ALL);
}

$title = 'Edit Record';
require_once 'includes/header.php';
require_once 'db/conn.php';

if (!isset($_GET["id"])) {
    // echo "<h1 class='text-danger'>Cannot find attendee id. Please check details and try again.</h1>";
    include "includes/errormessage.php";
    header("Location: viewrecords.php");
} else {
    $attendee = $crud->getAttendeeDetails($_GET["id"]);
    $specialties = $crud->getSpecialties();
    $institutions = $crud->getInstitutions();

    if ($DEBUG) {
        foreach (array_keys($attendee) as $c) {
            echo "$c ";
        }
    }

    ?>

<h1 class="text-center">Edit Record</h1>

<form method="post" action="editpost.php">
    <input type="hidden" name="id" value="<?php echo $attendee["attendee_id"]; ?>">
    <div class="mb-3">
        <label for="firstname" class="form-label">First Name</label>
        <input type="text" class="form-control" id="firstname" name="firstname"
            value="<?php echo $attendee["firstname"]; ?>">
    </div>
    <div class="mb-3">
        <label for="lastname" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="lastname" name="lastname"
            value="<?php echo $attendee["lastname"]; ?>">
    </div>
    <div class="mb-3">
        <label for="dob" class="form-label">Date of Birth</label>
        <input type="text" class="form-control" id="dob" name="dob"
            value="<?php echo $attendee["dob"]; ?>">

    </div>
    <div class="mb-3">
        <label for="specialty" class="form-label">Area of Expertise</label>
        <select id="specialty" name="specialty" class="form-select" aria-label="Select an Area of Expertise">
            <?php while ($r = $specialties->fetch(PDO::FETCH_ASSOC)) {?>
            <option
                value="<?php echo $r['specialty_id']; ?>"
                <?php
                if ($r["specialty_id"] == $attendee["specialty_id"]) {
                    echo "selected";
                }
                ?>
            >
                <?php echo $r['name']; ?>
            </option>
            <?php }?>
        </select>
    </div>
    <div class="mb-3">
        <label for="institution" class="form-label">Institution</label>
        <select id="institution" name="institution" class="form-select" aria-label="Select an institution">
            <?php while ($r = $institutions->fetch(PDO::FETCH_ASSOC)) {?>
            <option
                value="<?php echo $r['institution_id']; ?>"
                <?php
                if ($r["institution_id"] == $attendee["institution_id"]) {
                    echo "selected";
                }
                ?>
            >
                <?php echo $r['name']; ?>
            </option>
            <?php }?>
        </select>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
            value="<?php echo $attendee["email"]; ?>">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Contact Phone Number</label>
        <input type="tel" class="form-control" id="phone" name="phone" aria-describedby="phoneHelp"
            value="<?php echo $attendee["phone"]; ?>">
        <div id="phoneHelp" class="form-text">We'll never share your number with anyone else.</div>
    </div>
    <div class="d-grid gap-2">
        <button type="submit" name="submit" class="btn btn-success" value="Submit">Save changes</button>
    </div>
</form>

<?php }

require_once 'includes/footer.php'; ?>