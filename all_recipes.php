<?php
session_start();
include('dbconnection.php');

// all recipes
$sql = "SELECT * FROM Recipes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Recipes</title>
    <style>
        .recipe-container {
            width: 23%;
            display: inline-block;
            margin: 1%;
            vertical-align: top;
            border: 1px solid #ccc;
            padding: 10px;
        }
        .recipe-container h3 {
            margin-top: 0;
        }
        .recipe-container p {
            margin-bottom: 5px;
        }
        .recipe-container img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>All Recipes</h1>
    
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='recipe-container'>";
            echo "<h3>" . $row['recipe_name'] . "</h3>";
            echo "<p>Country of Origin: " . $row['country_of_origin'] . "</p>";
            echo "<p>Cooking Time: " . $row['cooking_time'] . "</p>";
            echo "<p>Ingredients: " . $row['ingredients'] . "</p>";
            echo "<p>Instructions: " . $row['instructions'] . "</p>";
            echo "<img src='" . $row['picture_url'] . "' alt='Recipe Picture'>";
            echo "</div>";
        }
    } else {
        echo "No recipes found.";
    }
    ?>

    <a href="dashboard.php"><button>Back to Dashboard</button></a>
</body>
</html>
