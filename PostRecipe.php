<?php
session_start();
include('dbconnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipeName = $_POST['recipeName'];
    $countryOfOrigin = $_POST['country'];
    $cookingTime = $_POST['cookingTime'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $userId = $_SESSION['user_id'];

    // File upload handling
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Checking if image file is an actual image or fake image
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Checking file size
    if ($_FILES["picture"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allowing certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Checking if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        print_r($_FILES["picture"]["tmp_name"]);
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            $pictureUrl = $target_file;

            // Preparing the SQL statement
            $stmt = $conn->prepare("INSERT INTO Recipes (user_id, recipe_name, country_of_origin, cooking_time, ingredients, instructions, picture_url) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssiss", $userId, $recipeName, $countryOfOrigin, $cookingTime, $ingredients, $instructions, $pictureUrl);

            if ($stmt->execute()) {
                echo "Recipe posted successfully.";
                // Redirecting to recipe page or dashboard
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
