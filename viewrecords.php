<?php
$DEBUG = false;
if ($DEBUG) {
    ini_set('display_errors', 'on');
    error_reporting(E_ALL);
}

$title = 'View Attendees';
require_once 'includes/header.php';

require_once 'db/conn.php';
$attendeeResults = $crud->getAttendees();

if ($DEBUG) {
    foreach (array_keys($attendeeResults->fetch(PDO::FETCH_ASSOC)) as $c) {
        echo $c . " ";
    }
}
?>

<table class="table">
    <thead>
        <th scope="col">#</th>
        <th scope="col">First name</th>
        <th scope="col">Last name</th>
        <th scope="col">Specialty</th>
        <th scope="col">Actions</th>
    </thead>
    <?php while ($r = $attendeeResults->fetch(PDO::FETCH_ASSOC)) { ?>
    <tr>
        <td scope="row"><?php echo $r["attendee_id"]; ?></td>
        <td><?php echo $r["firstname"]; ?></td>
        <td><?php echo $r["lastname"]; ?></td>
        <td><?php echo $r["specialty_name"]; ?></td>
        <td>
            <a href="view.php?id=<?php echo $r["attendee_id"]; ?>" class="btn btn-primary">View</a>
            <a href="edit.php?id=<?php echo $r["attendee_id"]; ?>" class="btn btn-warning">Edit</a>
            <a onclick="return confirm('Are you sure you want to delete this record?');" href="delete.php?id=<?php echo $r["attendee_id"]; ?>" class="btn btn-danger">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

<?php require_once 'includes/footer.php'; ?>