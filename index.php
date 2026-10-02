<?php 
    // Connect to the database
    require_once('database.php');
    // Select tatoos with their related artist
    $query = 'SELECT t.tattooID,
                     a.artistName,
                     t.tattooStyle,
                     t.description,
                     t.price,
                     t.imageName
              FROM tatoos AS t
              JOIN artists AS a
                  ON t.artistID = a.artistID
              ORDER BY t.tattooID';
    // Prepare the query
    $statement = $db->prepare($query);
    // Execute the query
    $statement->execute();
    // Fetch all the results
    $tatoos = $statement->fetchAll();
    // Close the statement
    $statement->closeCursor();
?>
<!-- Adds the header to the page -->
<?php include('header.php'); ?>
<main>
    <!-- Displays the tattoo list heading -->
    <h2>Tattoo Gallery</h2>
    <!-- Displays the add tattoo link -->
    <p><a href="add_tattoo_form.php">Add Tattoo</a></p>
    <!-- Displays the tattoo information -->
    <table>
        <tr>
            <th>Image</th>
            <th>Artist Name</th>
            <th>Tattoo Style</th>
            <th>Description</th>
            <th>Price</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <!-- Loops through each tattoo record -->
        <?php foreach ($tatoos as $tattoo) : ?>
        <tr>
            <td>
                <!-- Displays the image if one has been uploaded -->
                <?php if (!empty($tattoo['imageName'])) : ?>
                    <img
                        src="<?php echo htmlspecialchars('./images/' . $tattoo['imageName']); ?>"
                        alt="<?php echo htmlspecialchars($tattoo['description']); ?>"
                    >
                <?php else : ?>
                    No image
                <?php endif; ?>
            </td>
            <!-- Displays the tattoo data -->
            <td><?php echo htmlspecialchars($tattoo['artistName']); ?></td>
            <td><?php echo htmlspecialchars($tattoo['tattooStyle']); ?></td>
            <td><?php echo htmlspecialchars($tattoo['description']); ?></td>
            <td>$<?php echo number_format($tattoo['price'], 2); ?></td>
            <td>
                <!-- Deletes the selected tattoo -->
                <form action="delete_tattoo.php" method="post">
                    <input
                        type="hidden"
                        name="tattooID"
                        value="<?php echo $tattoo['tattooID']; ?>"
                    >
                    <button type="submit">Delete</button>
                </form>
            </td>
            <td>
                <!-- Opens the selected tattoo for updating -->
                <form action="update_tattoo_form.php" method="post">
                    <input
                        type="hidden"
                        name="tattooID"
                        value="<?php echo $tattoo['tattooID']; ?>"
                    >
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
<!-- Adds the footer to the page -->
<?php include('footer.php'); ?>