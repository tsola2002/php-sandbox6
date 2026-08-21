<?php
require_once 'header.php';
?>
<div class="text-center">
    <h1>Welcome to Robin's Nest</h1>
    <?php if ($loggedin): ?>
        <p>Hello <?= htmlspecialchars($user) ?>, you are logged in!</p>
    <?php else: ?>
        <p>Please sign up or log in to continue.</p>
    <?php endif; ?>
</div>
<footer class="text-center mt-5">
    <p>Web App from Learning PHP MySQL & JavaScript</a></i></p>
</footer>
</div>
</body>
</html>