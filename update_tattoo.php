<?php
    // Start the session
    session_start();
    // Retrieve data from the form
    $tattoo_id = filter_input(INPUT_POST, 'tattooID', FILTER_VALIDATE_INT);
    $artist_id = filter_input(INPUT_POST, 'artistID', FILTER_VALIDATE_INT);
    $tattoo_style = filter_input(INPUT_POST, 'tattooStyle');
    $description = filter_input(INPUT_POST, 'description');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $image = $_FILES['file1'];
    // Connect to the database
    require_once('database.php');
    // Add the image functions
    require_once('image_util.php');
    // Set the image folder
    $base_dir = 'images/';
    // Validate the tattoo data
    if (!$tattoo_id || !$artist_id || $tattoo_style == null ||
        $description == null || $price === null || $price === false || $price < 0) {
        $_SESSION['add_error'] = 'Invalid tattoo data. Check all fields and try again.';
        header('Location: add_error.php');
        die();
    }
    // Get the existing image from the database
    $query = 'SELECT imageName FROM tatoos WHERE tattooID = :tattooID';
    $statement = $db->prepare($query);
    $statement->bindValue(':tattooID', $tattoo_id);
    $statement->execute();
    $tattoo = $statement->fetch();
    $statement->closeCursor();
    // Return to the gallery if the tattoo was not found
    if (!$tattoo) {
        header('Location: index.php');
        die();
    }
    // Keep the existing image unless a replacement is uploaded
    $existing_image = $tattoo['imageName'];
    $image_name = $existing_image;
    // Stop if the replacement could not be uploaded
    if ($image['error'] != UPLOAD_ERR_OK && $image['error'] != UPLOAD_ERR_NO_FILE) {
        $_SESSION['add_error'] = 'The image could not be uploaded. Try again.';
        header('Location: add_error.php');
        die();
    }
    // Upload a new image if one was selected
    if ($image['error'] == UPLOAD_ERR_OK) {
        // Give the replacement a unique name to avoid overwriting other images
        $original_filename = uniqid('tattoo_') . '_' . basename($image['name']);
        $upload_path = $base_dir . $original_filename;
        // Stop if the file could not be saved
        if (!move_uploaded_file($image['tmp_name'], $upload_path)) {
            $_SESSION['add_error'] = 'The image could not be saved. Try again.';
            header('Location: add_error.php');
            die();
        }
        // Create the resized images
        process_image($base_dir, $original_filename);
        // Create the thumbnail filename using the final dot
        $dot_pos = strrpos($original_filename, '.');
        $image_name = substr($original_filename, 0, $dot_pos) . '_100' .
                      substr($original_filename, $dot_pos);
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
    $statement->closeCursor();
    // Clean up the old image only when it was replaced
    if (!empty($existing_image) && $existing_image != $image_name) {
        // Check whether another tattoo still uses the old image
        $query = 'SELECT COUNT(*) FROM tatoos WHERE imageName = :imageName';
        $statement = $db->prepare($query);
        $statement->bindValue(':imageName', $existing_image);
        $statement->execute();
        $image_count = $statement->fetchColumn();
        $statement->closeCursor();
        // Separate the old filename and extension
        $old_filename = basename($existing_image);
        $dot_pos = strrpos($old_filename, '.');
        $old_base = substr($old_filename, 0, $dot_pos);
        $old_extension = substr($old_filename, $dot_pos);
        // Remove the thumbnail ending
        if (str_ends_with($old_base, '_100')) {
            $old_base = substr($old_base, 0, -4);
        }
        // Preserve placeholders  and images still used by another tattoo
        if ($image_count == 0 && strtolower($old_base) != 'placeholder') {
            // List the  original and both resized versions
            $old_images = [
                $old_base . $old_extension,
                $old_base . '_100' . $old_extension,
                $old_base . '_400' . $old_extension
            ];
            // Delete neach old image if it exists
            foreach ($old_images as $old_image) {
                $old_path = $base_dir . $old_image;
                if (is_file($old_path)) {
                    unlink($old_path);
                }
            }
        }
    }
    // Redirect to the confirmation page
    $_SESSION['tattooDescription'] = $description;
    header('Location: update_tattoo_confirmation.php');
    die();
?>