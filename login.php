<?php
$DEBUG = false;
if ($DEBUG) {
    ini_set('display_errors', 'on');
    error_reporting(E_ALL);
}

session_start();

$title = "User Login";

require_once "db/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = strtolower(trim($_POST["user"]));
    $pwd = $_POST["pwd"];
    $pwd_hash = md5("$pwd$username");

    $result = $user->getUser($username, $pwd_hash);
    if (!$result) {
        echo "<div class='alert alert-danger'>Username and/or password is incorrect</div>";
    } else {
        $_SESSION["username"] = $username;
        $_SESSION["id"] = $result["id"];
        header("Location: index.php");
    }
}

require_once "includes/header.php";
?>

<h1 class="text-center">
    <?php echo $title ?>
</h1>
<form
    action="<?php echo htmlentities($_SERVER["PHP_SELF"]); // Redirect to the page itself?>"
    method="post">
    <table class="table table-sm table-borderless">
        <tr>
            <td><label for="user">Username:</label></td>
            <td><input type="text" name="user" class="form-control" id="user" value="<?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo $_POST["user"];
            } // If the server sent a POST request when accessing the page, then show the previously inputted username
            ?>">
            </td>
        </tr>
        <tr>
            <td><label for="pwd">Password:</label></td>
            <td><input type="password" name="pwd" class="form-control" id="pwd"></td>
        </tr>
    </table>
    <div class="d-grid gap-2">
        <button type="submit" name="login" class="btn btn-primary" value="Login">Login</button>
    </div>
    <br>

</form>

<?php
include_once "includes/footer.php";
?>