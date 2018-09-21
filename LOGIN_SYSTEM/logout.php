<?php
session_start();
session_unset();

$_SESSION = array();
// Destroy the session.
session_destroy();
// Redirect to login page
header("location: home.html");
// the script execution is not terminated. Setting another header alone is not enough to redirect.
exit;
?>
