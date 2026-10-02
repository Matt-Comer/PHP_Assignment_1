<?php
// Connect to the database
require_once('database.php');
// Select all artists from the artists table
$query = 'SELECT * FROM artists ORDER BY artistName';
// Prepare the query
$statement = $db->prepare($query);
// Execute the query
$statement->execute();
// Fetch all the results
$artists = $statement->fetchAll();
// Close the statement
$statement->closeCursor();
?>
<!-- Adds the header to the page -->
<?php include('header.php'); ?>
<main>
    <!-- Displays the add tattoo heading -->
    <h2>Add Tattoo</h2>
    <!-- Displays the add tattoo form -->
    <form action="add_tattoo.php" method="post" id="add_tattoo_form" enctype="multipart/form-data">
        <label for="artistID">Artist Name:</label>
        <select name="artistID" id="artistID" required>
            <!-- Loops through each artist record -->
            <?php foreach ($artists as $artist) : ?>
                <option value="<?php echo $artist['artistID']; ?>">
                    <?php echo htmlspecialchars($artist['artistName']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="tattooStyle">Tattoo Style:</label>
        <input type="text" name="tattooStyle" id="tattooStyle" required>
        <label for="description">Description:</label>
        <input type="text" name="description" id="description" required>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" min="0" step="0.01" required>
        <label for="file1">Tattoo Image:</label>
        <input type="file" name="file1" id="file1" accept="image/png, image/jpeg" required>
        <button type="submit">Add Tattoo</button>
    </form>
</main>
<!-- Adds the footer to the page -->
<?php include('footer.php'); ?>