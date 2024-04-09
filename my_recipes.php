<?php
session_start();
include('dbconnection.php');

// Checking if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetching user ID from query parameter
$user_id = $_GET['user_id'];

// Fetching recipes submitted by the user
$sql = "SELECT * FROM Recipes WHERE user_id = $user_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Recipes</title>
    
</head>
<body>
    <h1>My Recipes</h1>

    <div class="recipes-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Displaying each recipe
                
                echo "<div class='recipe-icon'>";
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
    </div>

    
</body>
</html>
