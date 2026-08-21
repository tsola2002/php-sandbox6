<?php
require_once 'header.php';
if (!$loggedin) die("</div></body></html>");

$view = isset($_GET['view']) ? sanitizeString($_GET['view']) : $user;

$name1 = $name2 = $name3 = "";
if ($view == $user) {
    $name1 = $name2 = "Your";
    $name3 = "You are";
} else {
    $name1 = "<a href='members.php?view=$view&r=$randstr'>$view</a>'s";
    $name2 = "$view's";
    $name3 = "$view is";
}

$followers = [];
$following = [];
$stmt = queryMysql("SELECT friend FROM friends WHERE user = ?", [$view]);
while ($row = $stmt->fetch()) $followers[] = $row['friend'];

$stmt = queryMysql("SELECT user FROM friends WHERE friend = ?", [$view]);
while ($row = $stmt->fetch()) $following[] = $row['user'];

$mutual = array_intersect($followers, $following);
$followers = array_diff($followers, $mutual);
$following = array_diff($following, $mutual);

$friends = false;

echo "<div class='mb-3'>";
if (count($mutual)) {
    echo "<h5>$name2 Mutual Friends</h5><ul class='list-group mb-3'>";
    foreach ($mutual as $friend) echo "<li class='list-group-item'><a href='members.php?view=$friend&r=$randstr'>$friend</a></li>";
    echo "</ul>";
    $friends = true;
}
if (count($followers)) {
    echo "<h5>$name2 Followers</h5><ul class='list-group mb-3'>";
    foreach ($followers as $friend) echo "<li class='list-group-item'><a href='members.php?view=$friend&r=$randstr'>$friend</a></li>";
    echo "</ul>";
    $friends = true;
}
if (count($following)) {
    echo "<h5>$name3 Following</h5><ul class='list-group mb-3'>";
    foreach ($following as $friend) echo "<li class='list-group-item'><a href='members.php?view=$friend&r=$randstr'>$friend</a></li>";
    echo "</ul>";
    $friends = true;
}

if (!$friends) echo "<p>No friends yet.</p>";
?>