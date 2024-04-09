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
$sql = "SELECT * FROM Recipes";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="logo.png" alt="Recipe Sharing Website Logo">
        </div>
        <div class="topnav">
            <div class="right-links">
                <div class="dropdown">
                    <button class="dropbtn">Profile<i class="fa fa-caret-down"></i></button>
                    <div class="dropdown-content">
                        <a href="my_recipes.php?user_id=<?php echo $_SESSION['user_id']; ?>">My Recipes</a>
                        <a href="#">Favorites</a>
                        <a href="logout.php">Logout</a>
                    </div>
                </div>
                <a href="PostRecipe.html">Post a Recipe</a>
                
            </div>
        </div>
    </header>

    <div class="search-container">
        <form action="search.php" method="GET">
            <input type="text" placeholder="Find your recipes.." name="search">
            <button type="submit">Search</button>
        </form>
    </div>
    
    <div class="recipes-container">
        <?php
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
            echo "No recipes submitted yet.";
        }
        ?>
    </div>

    <footer>
        <!-- Footer content here -->
    </footer>
</body>
</html>
