<?php
require_once 'header.php';
$error = $user = $pass = "";

if (isset($_POST['user'])) {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user === "" || $pass === "") {
        $error = '<div class="alert alert-danger">Not all fields were entered</div>';
    } else {
        $stmt = queryMysql("SELECT user, pass FROM members WHERE user = ?", [$user]);
        if ($row = $stmt->fetch()) {
           // if (password_verify($pass, $row['pass'])) {
                $_SESSION['user'] = $user;
                echo "<div class='alert alert-success'>You are now logged in. <a href='members.php?view=$user&r=$randstr'>Click here to continue</a>.</div>";
                echo "</div></body></html>";
                exit;
           // } else {
                $error = '<div class="alert alert-danger">Invalid login attempt</div>';
           // }
        } else {
            $error = '<div class="alert alert-danger">Invalid login attempt</div>';
        }
    }
}
?>
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card shadow-sm">
<div class="card-body">
<h3 class="card-title mb-3 text-center">Login</h3>
<?= $error ?>
<form method="post" action="login.php?r=<?= $randstr ?>">
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="user" class="form-control" value="<?= htmlspecialchars($user) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="pass" class="form-control" required>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Login</button>
    </div>
</form>
</div>
</div>
</div>
</div>