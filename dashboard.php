<?php
session_start();
include('dbconnection.php');

// Checking if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// all recipes submitted by the user
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM Recipes WHERE user_id = $user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <h2>Your Submitted Recipes</h2>
    <header>
    <div class="logo">
        <img src="logo.png" alt="Recipe Sharing Website Logo">
    </div>
    <div class="topnav">
        <div class="right-links">
            <a href="PostRecipe.html">Post a Recipe</a>
            <div class="dropdown">
                <button class="dropbtn">Profile</button>
                <div class="dropdown-content">
                    <a href="#">My Recipes</a>
                    <a href="#">Favorites</a>
                    <a href="#">Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>

    
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h3>" . $row['recipe_name'] . "</h3>";
            echo "<p>Country of Origin: " . $row['country_of_origin'] . "</p>";
            echo "<p>Cooking Time: " . $row['cooking_time'] . "</p>";
            echo "<p>Ingredients: " . $row['ingredients'] . "</p>";
            echo "<p>Instructions: " . $row['instructions'] . "</p>";
            echo "<img src='" . $row['picture_url'] . "' alt='Recipe Picture' style='max-width: 200px;'>";
            echo "</div>";
        }
    } else {
        echo "No recipes submitted yet.";
    }
    ?>
    
    <a href="all_recipes.php"><button>View All Recipes</button></a>

    <?php include('PostRecipe.html'); ?>
</body>
</html>
