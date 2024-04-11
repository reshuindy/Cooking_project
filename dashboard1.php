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
$sql = "SELECT * FROM Recipes order by id desc";
$favoritePage = false;

if(array_key_exists('my-favorite-recipe', $_GET)) {
    $favoritePage = true;
    // $conn->query("SELECT recipe_id FROM recipe_fav_like where recipe_fav_like.user_id=$user_id");
    $sql = "SELECT Recipes.* FROM Recipes left join recipe_fav_like on recipes.id = recipe_fav_like.recipe_id 
    where recipe_fav_like.user_id=$user_id and recipe_fav_like.type='fav' order by id desc";
}
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>.like-button{ display: inline-block; width: 100px; float: left; } .fav-button { display: inline-block; width: 60px; float: right; }</style>
</head>
<body>
    <header>
        <div class="logo">
           <a href="dashboard1.php"> <img src="logo.png" alt="Recipe Sharing Website Logo"></a>
        </div>
        <div class="topnav">
            <div class="right-links">
                <div class="dropdown">
                    <button class="dropbtn">Profile<i class="fa fa-caret-down"></i></button>
                    <div class="dropdown-content">
                        <a href="my_recipes.php?user_id=<?php echo $_SESSION['user_id']; ?>">My Recipes</a>
                        <a href="dashboard1.php?my-favorite-recipe">Favorites</a>
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
                echo "<img src='" . $row['picture_url'] . "' alt='Recipe Picture' style='max-width: 200px;'><br />";

                $resultLike = $conn->query("SELECT * FROM recipe_fav_like WHERE recipe_id=".$row['id']." AND type='like'");
                $likes = $resultLike->num_rows;
                $likedAlready = false;
                $isFavourite = false;
                while ($rowLike = $resultLike->fetch_assoc()) {
                    if($rowLike['user_id'] == $user_id) {
                        $likedAlready = true;
                        break;
                    } ;
                }
                $resultFav = $conn->query("SELECT id FROM recipe_fav_like WHERE recipe_id=".$row['id']." AND type='fav' AND user_id=".$user_id);
                $isFavourite = $resultFav->num_rows;
                ?>
                <!-- <input type="button" value="Like" id="like_<?php echo $row['id']; ?>" class="like" style="<?php if($likedAlready){ echo "color: #ffa449;"; } ?>" />&nbsp;(<span id="likes_<?php echo $row['id']; ?>"><?php echo $likes; ?></span>)&nbsp;
                <input type="button" value="Fav" id="fav_<?php echo $row['id']; ?>" class="fav" style="<?php if($isFavourite){ echo "color: #ffa449;"; } ?>" />&nbsp;(<span id="fav_<?php echo $row['id']; ?>"><?php echo $isFavourite; ?></span>) -->
                <?php if ($likedAlready) { ?> 
                <a  href="socialaction.php?action=unlike&recipe_id=<?php echo $row['id'] ?>&user_id=<?php echo $user_id ?>" class="like-button"> <i class="bi bi-hand-thumbs-up-fill"></i> (<?php echo $likes; ?>) </a> 
                <?php } ?>
                <?php if (!$likedAlready) { ?> 
                <a  href="socialaction.php?action=like&recipe_id=<?php echo $row['id'] ?>&user_id=<?php echo $user_id ?>" class="like-button"> <i class="bi bi-hand-thumbs-up"></i> (<?php echo $likes; ?>) </a>
                <?php } ?>
                
                <?php if ($isFavourite) { ?><a  href="socialaction.php?action=unfav&recipe_id=<?php echo $row['id'] ?>&user_id=<?php echo $user_id ?>" class="fav-button"> <i class="bi bi-heart-fill"></i></a> <?php } ?>
                <?php  if (!$isFavourite) { ?><a  href="socialaction.php?action=fav&recipe_id=<?php echo $row['id'] ?>&user_id=<?php echo $user_id ?>" class="fav-button"> <i class="bi bi-heart"></i></a> <?php } ?>

                <?php
                echo "<br/></div>";
            }
        } else {
            if($favoritePage)
            echo "<h4>No recipe marked as favorite.</h4> <a href='dashboard1.php'><i>&raquo; List of Recipes</i></a>";
        else
            echo "No recipes submitted yet.";
        }
        ?>
    </div>

    <footer>
        <!-- Footer content here -->
    </footer>
</body>
</html>
