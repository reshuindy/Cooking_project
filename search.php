<?php
session_start();
include('dbconnection.php');

// Checking if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Calling the handleSearch function if search query is submitted
if (isset($_GET['search'])) {
    handleSearch();
}

// Defining the handleSearch function
function handleSearch() {
    global $conn;

    // search parameter
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

    // SQL query for searching recipes based on the name
    $sql = "SELECT * FROM Recipes WHERE recipe_name LIKE '%$searchTerm%'";

    // search
    $result = $conn->query($sql);

    // search results
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
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
        echo "No recipes found.";
    }
}
?>
