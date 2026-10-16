<?php
    // Connect to the database
    require_once('database.php');
    // Retrieve the  tattoo ID
    $tattoo_id = filter_input(INPUT_POST, 'tattooID', FILTER_VALIDATE_INT);
    // Return to the gallery if the ID is invalid
    if (!$tattoo_id) {
        header('Location: index.php');
        exit();
    }
    // Select the tattoo and its artist
    $query = 'SELECT t.tattooID,
                     a.artistName,
                     t.tattooStyle,
                     t.description,
                     t.price,
                     t.imageName
              FROM tatoos AS t
              JOIN artists AS a
                  ON t.artistID = a.artistID
              WHERE t.tattooID = :tattooID';
    // Prepare the  query
    $statement = $db->prepare($query);
    // Bind the tattoo ID
    $statement->bindValue(':tattooID', $tattoo_id);
    // Execute the query
    $statement->execute();
    // Fetch the tattoo
    $tattoo = $statement->fetch();
    // Close the statement
    $statement->closeCursor();
    // Stop if the tattoo was  not found
    if (!$tattoo) {
        echo 'Tattoo not found.';
        exit();
    } 
    // Set the larger image  filename
    $image_name_400 = '';
    // Convert the thumbnail filename to the larger version
    if (!empty($tattoo['imageName'])) {
        // Separate the filename and extension
        $image_name = $tattoo['imageName'];
        $dot_position = strrpos($image_name, '.');
        $base_name = substr($image_name, 0, $dot_position);
        $extension = substr($image_name, $dot_position);
        // Remove the thumbnail ending
        if (str_ends_with($base_name, '_100')) {
            $base_name = substr($base_name, 0, -4);
        }
        // Build the larger image filename
        $image_name_400 = $base_name . '_400' . $extension;
    }
?>
<!-- Adds the header to the page -->
<?php include('header.php'); ?>
<main>
    <!-- Displays the tattoo details heading -->
    <h2>Tattoo Details</h2>
    <!-- Displays the larger image at 400 pixels high -->
    <?php if (!empty($image_name_400)) : ?>
        <img
            src="<?php echo htmlspecialchars('images/' . $image_name_400); ?>"
            alt="<?php echo htmlspecialchars($tattoo['description']); ?>"
            height="400"
        >
    <?php else : ?>
        <p>No image</p>
    <?php endif; ?>
    <!-- Displays the tattoo  information -->
    <p><strong>Artist Name:</strong> <?php echo htmlspecialchars($tattoo['artistName']); ?></p>
    <p><strong>Tattoo Style:</strong> <?php echo htmlspecialchars($tattoo['tattooStyle']); ?></p>
    <p><strong>Description:</strong> <?php echo htmlspecialchars($tattoo['description']); ?></p>
    <p><strong>Price:</strong> $<?php echo number_format($tattoo['price'], 2); ?></p>
    <!-- Returns to the tattoo gallery -->
    <p><a href="index.php">View Tattoo Gallery</a></p>
</main>
<!-- Adds the footer to the page -->
<?php include('footer.php'); ?>