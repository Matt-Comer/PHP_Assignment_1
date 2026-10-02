<?php
    session_start();
    // Retrieve data from the form
    $tattoo_id = filter_input(INPUT_POST, 'tattooID', FILTER_VALIDATE_INT);
    $artist_id = filter_input(INPUT_POST, 'artistID', FILTER_VALIDATE_INT);
    $tattoo_style = filter_input(INPUT_POST, 'tattooStyle');
    $description = filter_input(INPUT_POST, 'description');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $existing_image = filter_input(INPUT_POST, 'existingImage');
    $image = $_FILES['file1'];
    // Connect to the database
    require_once('database.php');
    // Add the image functions
    require_once('image_util.php');
    // Set the image folder
    $base_dir = 'images/';
    // Validate the tattoo data
    if ($tattoo_id == null || $artist_id == null || $tattoo_style == null ||
        $description == null || $price == null) {
        $_SESSION['add_error'] = 'Invalid tattoo data. Check all fields and try again.';
        $url = 'add_error.php';
        header('Location: ' . $url);
        die();
    }
    // Keep the existing image
    $image_name = $existing_image;
    // Upload a new image if one was selected
    if ($image && $image['error'] == UPLOAD_ERR_OK) {
        $original_filename = basename($image['name']);
        $upload_path = $base_dir . $original_filename;
        move_uploaded_file($image['tmp_name'], $upload_path);
        // Create the resized images
        process_image($base_dir, $original_filename);
        // Create the thumbnail filename
        $dot_pos = strpos($original_filename, '.');
        $name_100 = substr($original_filename, 0, $dot_pos) . '_100' . substr($original_filename, $dot_pos);
        $image_name = $name_100;
    }
    // Update the tattoo
    $query = 'UPDATE tatoos
              SET artistID = :artistID,
                  tattooStyle = :tattooStyle,
                  description = :description,
                  price = :price,
                  imageName = :imageName
              WHERE tattooID = :tattooID';
    // Prepare the query
    $statement = $db->prepare($query);
    // Bind the tattoo data
    $statement->bindValue(':artistID', $artist_id);
    $statement->bindValue(':tattooStyle', $tattoo_style);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':imageName', $image_name);
    $statement->bindValue(':tattooID', $tattoo_id);
    // Execute the query
    $statement->execute();
    // Close the statement
    $statement->closeCursor();
    // Redirect to the confirmation page
    $_SESSION['tattooDescription'] = $description;
    $url = 'update_tattoo_confirmation.php';
    header('Location: ' . $url);
    die();
?>