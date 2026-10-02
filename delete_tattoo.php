<?php
    // Connect to the database
    require_once('database.php');
    // Retrieve the tattoo ID
    $tattoo_id = filter_input(INPUT_POST, 'tattooID', FILTER_VALIDATE_INT);
    // Delete the tattoo
    if ($tattoo_id != false) {
        $query = 'DELETE FROM tatoos
                  WHERE tattooID = :tattooID';
        // Prepare the query
        $statement = $db->prepare($query);
        // Bind the tattoo ID
        $statement->bindValue(':tattooID', $tattoo_id);
        // Execute the query
        $statement->execute();
        // Close the statement
        $statement->closeCursor();
    }
    // Return to the tattoo gallery
    header('Location: index.php');
    die();
?>