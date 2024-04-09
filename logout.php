<?php
session_start(); // Resuming the existing session

$_SESSION = array();

session_destroy();

// Redirecting to login page
header('Location: index.html');
exit;
?>