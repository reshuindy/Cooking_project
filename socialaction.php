<?php
session_start();
$action = $_GET['action'];
$recipe_id = $_GET['recipe_id'];
$user_id = $_GET['user_id'];

include('dbconnection.php');

// Checking if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if($action == 'like')
    $conn->query("INSERT INTO recipe_fav_like (`user_id`, `recipe_id`, `type`) VALUES ($user_id, $recipe_id, 'like')");
if($action == 'fav')
    $conn->query("INSERT INTO recipe_fav_like (`user_id`, `recipe_id`, `type`) VALUES ($user_id, $recipe_id, 'fav')");
    
if($action == 'unlike')
$conn->query("DELETE from recipe_fav_like where `user_id` = $user_id AND `recipe_id` = $recipe_id AND `type`='like'");
if($action == 'unfav')
$conn->query("DELETE from recipe_fav_like where `user_id` = $user_id AND `recipe_id` = $recipe_id AND `type`='fav'");
$redirectTo = isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : 'dashboard1.php'  ;
header("location: $redirectTo");
exit;