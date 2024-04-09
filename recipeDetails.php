<?php
// database connection
include('dbconnection.php');

// Checking if recipe ID is provided
if(isset($_GET['id'])) {
    // Get recipe ID
    $recipeId = $_GET['id'];

    // Fetching recipe details from the database
    $sql = "SELECT * FROM Recipes WHERE id = $recipeId";
    $result = $conn->query($sql);

    // recipe details
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h3>" . $row['recipe_name'] . "</h3>";
        echo "<p>Country of Origin: " . $row['country_of_origin'] . "</p>";
        echo "<p>Cooking Time: " . $row['cooking_time'] . "</p>";
        echo "<p>Ingredients: " . $row['ingredients'] . "</p>";
        echo "<p>Instructions: " . $row['instructions'] . "</p>";
        echo "<img src='" . $row['picture_url'] . "' alt='Recipe Picture'>";
    } else {
        echo "Recipe not found.";
    }
} else {
    echo "Recipe ID not provided.";
}
?>
