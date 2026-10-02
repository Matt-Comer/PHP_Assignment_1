<?php
    // Connect to the database
    require_once('database.php');
    // Retrieve the tattoo ID
    $tattoo_id = filter_input(INPUT_POST, 'tattooID', FILTER_VALIDATE_INT);
    // Select the tattoo
    $query = 'SELECT * FROM tatoos
              WHERE tattooID = :tattooID';
    // Prepare the query
    $statement = $db->prepare($query);
    // Bind the tattoo ID
    $statement->bindValue(':tattooID', $tattoo_id);
    // Execute the query
    $statement->execute();
    // Fetch the tattoo
    $tattoo = $statement->fetch();
    // Close the statement
    $statement->closeCursor();
    // Select all artists
    $query = 'SELECT * FROM artists
              ORDER BY artistName';
    // Prepare the query
    $statement = $db->prepare($query);
    // Execute the query
    $statement->execute();
    // Fetch all the artists
    $artists = $statement->fetchAll();
    // Close the statement
    $statement->closeCursor();
?>
<!-- Adds the header to the page -->
<?php include('header.php'); ?>

<main>
    <!-- Displays the update tattoo heading -->
    <h2>Update Tattoo</h2>
    <!-- Displays the update tattoo form -->
    <form action="update_tattoo.php" method="post" id="update_tattoo_form" enctype="multipart/form-data">
        <input type="hidden" name="tattooID" value="<?php echo $tattoo['tattooID']; ?>">
        <input type="hidden" name="existingImage" value="<?php echo htmlspecialchars($tattoo['imageName']); ?>">
        <label for="artistID">Artist Name:</label>
        <select name="artistID" id="artistID" required>
            <!-- Loops through each artist record -->
            <?php foreach ($artists as $artist) : ?>
                <option
                    value="<?php echo $artist['artistID']; ?>"
                    <?php if ($artist['artistID'] == $tattoo['artistID']) echo 'selected'; ?>
                >
                    <?php echo htmlspecialchars($artist['artistName']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="tattooStyle">Tattoo Style:</label>
        <input
            type="text"
            name="tattooStyle"
            id="tattooStyle"
            value="<?php echo htmlspecialchars($tattoo['tattooStyle']); ?>"
            required
        >
        <label for="description">Description:</label>
        <input
            type="text"
            name="description"
            id="description"
            value="<?php echo htmlspecialchars($tattoo['description']); ?>"
            required
        >
        <label for="price">Price:</label>
        <input
            type="number"
            name="price"
            id="price"
            min="0"
            step="0.01"
            value="<?php echo $tattoo['price']; ?>"
            required
        >
        <label for="file1">Tattoo Image:</label>
        <input type="file" name="file1" id="file1" accept="image/png, image/jpeg">
        <button type="submit">Update Tattoo</button>
    </form>
</main>

<!-- Adds the footer to the page -->
<?php include('footer.php'); ?>